<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class News_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'cp_articles';
    }

    function get_all_items()
    {
        $this->db->order_by('a.id', 'DESC');
        //$this->db->where('a.published = 1');
        $this->db->join('cp_categories c', 'a.id_category = c.id', 'left');
        $this->db->join('cp_users u', 'a.created_by=u.id');
        $this->db->select('a.*, c.title as catTitle, u.username');
        $result = $this->db->get($this->table_name . ' a');

        return $result->result();
    }

    function get_all_items2($limit)
    {
        $this->db->order_by('a.id', 'DESC');
        $this->db->limit($limit);
        $this->db->join('cp_categories c', 'a.id_category = c.id', 'left');
        $this->db->join('cp_users u', 'a.created_by=u.id');
        $this->db->select('a.*, c.title as catTitle, u.username');
        $result = $this->db->get($this->table_name . ' a');

        return $result->result();
    }

    function getNewInfo($catid)
    {

        $result = $this->db->get_where($this->table_name, array('id' => $catid));


        return $result->row();

    }

    public function get_all_items_cats($category = NULL, $limit, $start)
    {

        $select = $this->table_name . '.*,category_table.title as cat_title';
        $where = $this->table_name . '.published = 1 ';
        $this->db->select($select);
        $this->db->from($this->table_name);
        $this->db->join('cp_categories as category_table', 'category_table.id = ' . $this->table_name . '.id_category', 'left');
        $this->db->where($where);

        if (!empty($category)) {
            $this->db->where_in($this->table_name . '.id_category', $category);
        }

        $this->db->order_by($this->table_name . '.id', 'desc');
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $query->result();


    }


    function get_all_items_limit($limit)
    {
        $this->db->order_by('a.id', 'DESC');
        $this->db->limit($limit);
        $this->db->join('cp_categories c', 'a.id_category = c.id', 'left');
        $this->db->select('a.*, c.title as cat_title, c.alias as cat_alias');
        $result = $this->db->get($this->table_name . ' a');

        return $result->result();
    }

    function get_all_items_limit_cat($catIds, $limit, $start)
    {
        $this->db->order_by('a.id', 'DESC');
        $this->db->limit($limit, $start);

        $this->db->join('cp_categories c', 'a.id_category = c.id', 'left');
        $this->db->select('a.*, c.title as catTitle');
        $this->db->where("a.id_category IN ($catIds) and a.published = 1");
        $result = $this->db->get($this->table_name . ' a');

        return $result->result();
    }

    function getAllArticlesByCat($catIds, $limit, $start)
    {
        $this->db->order_by('a.id', 'DESC');
        $this->db->limit($limit, $start);

        $this->db->join('cp_categories c', 'a.id_category = c.id', 'left');
        $this->db->select('a.*, c.title as catTitle');
        $this->db->where("a.id_category IN ($catIds)");
        $result = $this->db->get($this->table_name . ' a');

        return $result->result();
    }

    function get_items_info($id)
    {
        $this->db->order_by('a.id', 'DESC');
        $this->db->join('cp_categories c', 'a.id_category = c.id', 'left');
        $this->db->select('a.*, c.title as cat_title');
        $this->db->where("a.id", $id);
        $result = $this->db->get($this->table_name . ' a');

        return $result->row();
    }

    function get_items_alias($alias)
    {
        $this->db->order_by('a.id', 'DESC');
        $this->db->join('cp_categories c', 'a.id_category = c.id', 'left');
        $this->db->select('a.*, c.title as cat_title, c.alias as cat_alias');
        $this->db->where("a.alias", $alias);
        $result = $this->db->get($this->table_name . ' a');

        return $result->row();
    }

    function get_items_relative($cat_id)
    {
        $this->db->order_by('a.id', 'DESC');
        $this->db->join('cp_categories c', 'a.id_category = c.id', 'left');
        $this->db->select('a.*, c.title as cat_title, c.alias as cat_alias');
        //$this->db->where("a.id_category", $cat_id);
        $result = $this->db->get($this->table_name . ' a');

        return $result->$result();
    }

    function get_items_num()
    {
        $result = $this->db->get($this->table_name);

        return $result->num_rows();
    }

    function get_items_num_cat($cat_ids)
    {
        $this->db->where("id_category IN ($cat_ids)");
        $result = $this->db->get($this->table_name);

        return $result->num_rows();
    }

    function insert($image)
    {
        $user = $this->session->userdata('userLogged');
        $data = array(
            'title' => $this->input->post('title'),
            'alias' => mb_strtolower(url_title(removesign($this->input->post('title')))),
            'detail' => $this->input->post('detail'),
            'created' => date('Y-m-d H:i:s'),
            'created_by' => $user->id,
            'images' => $image,
            'id_category' => $this->input->post('id_category'),
            'seo_title' => $this->input->post('seo_title'),
            'seo_keyword' => $this->input->post('seo_keyword'),
            'seo_description' => $this->input->post('seo_description'),
            'published' => $this->input->post('published')
        );

        if ($this->db->insert($this->table_name, $data)) {
            return true;
        }

        return false;
    }

    function updateHit($id, $hist)
    {

        $this->db->where('id', $id);

        $data = array('hits' => $hist);


        if ($this->db->update($this->table_name, $data)) {

            return true;

        }


        return false;

    }

    function update($image)
    {
        $user = $this->session->userdata('userLogged');
        $id = $this->input->post('id');
        $data = array(
            'title' => $this->input->post('title'),
            'alias' => mb_strtolower(url_title(removesign($this->input->post('title')))),
            'detail' => $this->input->post('detail'),
            'modified' => date('Y-m-d H:i:s'),
            'modified_by' => $user->id,
            'images' => $image,
            'id_category' => $this->input->post('id_category'),
            'seo_title' => $this->input->post('seo_title'),
            'seo_keyword' => $this->input->post('seo_keyword'),
            'seo_description' => $this->input->post('seo_description'),
            'published' => $this->input->post('published')
        );

        $this->db->where('id', $id);

        if ($this->db->update($this->table_name, $data)) {
            return true;
        }

        return false;
    }

    function published($id, $published)
    {
        $this->db->where('id', $id);
        $data = array('published' => $published);

        if ($this->db->update($this->table_name, $data)) {
            return true;
        }

        return false;
    }

    function delete_ids()
    {
        $ids = $this->input->post('ids');
        $this->db->where("id IN $ids");

        try {
            $this->db->delete($this->table_name);

            return true;
        } catch (Exeption $e) {
            return false;
        }
    }

    function delete($id)
    {
        $this->db->where("id", $id);

        try {
            $this->db->delete($this->table_name);

            return true;
        } catch (Exeption $e) {
            return false;
        }
    }

    function getAllProductsByCat($id)
    {

        $this->db->order_by('p.id', 'DESC');

        //$this->db->limit($limit, $start);

        $this->db->where('p.id_category', $id);

        $this->db->join('cp_categories c', 'p.id_category = c.id', 'left');

        $this->db->select('p.*');

        $result = $this->db->get($this->table_name . ' p');


        return $result->result();

    }

    function getRelativeProducts($catid, $limit)
    {
        $this->db->order_by('id', 'RANDOM');
        $this->db->limit($limit);
        $this->db->where('p.id_category', $catid);
        $this->db->join('cp_categories c', 'p.id_category = c.id', 'left');
        $this->db->select('p.*, c.title as catTitle');
        $result = $this->db->get($this->table_name . ' p');

        return $result->result();
    }
}

?>