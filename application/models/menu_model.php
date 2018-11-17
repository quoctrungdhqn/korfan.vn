<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Menu_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'cp_menus';
    }

    public function all()
    {
        return $this->db->get($this->table_name)
            ->result_array();
    }

    public function get_by_menu_type($id)
    {
        $result = $this->db->get_where($this->table_name, array('id_menutype' => $id));
        return $result->result_array();
    }

    function get_slug($slug)
    {

        $result = $this->db->get_where($this->table_name, array('slug' => $slug));

        return $result->row();
    }

    function get_info($id)
    {

        $result = $this->db->get_where($this->table_name, array('id' => $id));

        return $result->row();
    }

    function get_no_parent()
    {

        $result = $this->db->get_where($this->table_name, array('parent' => NULL));

        return $result->result_array();
    }

    function insert()
    {
        if ($this->input->post('parent') == "") {
            $parent = NULL;
        } else {
            $parent = $this->input->post('parent');
        }
        $data = array(
            'name' => $this->input->post('name'),
            'slug' => $this->input->post('slug'),
            'number' => $this->input->post('number'),
            'id_menutype' => $this->input->post('id_menutype'),
            'link_type' => $this->input->post('menu_type'),
            'parent' => $parent,
            'state' => $this->input->post('state'),
            'seo_description' => $this->input->post('seo_description'),
            'seo_keyword' => $this->input->post('seo_keyword')
        );

        if ($this->db->insert($this->table_name, $data)) {
            return true;
        }

        return false;
    }

    function update()
    {
        $id = $this->input->post('id');
        if ($this->input->post('parent') == "") {
            $parent = NULL;
        } else {
            $parent = $this->input->post('parent');
        }
        $data = array(
            'name' => $this->input->post('name'),
            'slug' => $this->input->post('slug'),
            'id_menutype' => $this->input->post('id_menutype'),
            'link_type' => $this->input->post('menu_type'),
            'number' => $this->input->post('number'),
            'parent' => $parent,
            'state' => $this->input->post('state'),
            'seo_description' => $this->input->post('seo_description'),
            'seo_keyword' => $this->input->post('seo_keyword')
        );
        $this->db->where('id', $id);
        if ($this->db->update($this->table_name, $data)) {
            return true;
        }

        return false;
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

    /**
     * Ham nay tra lai tat cac cac Menu con
     */
    public function getSubcategory($parent_id = NULL)
    {

        $select = $this->table_name . ' .* ';
        $this->db->select($select);
        $this->db->from($this->table_name);
        //$where  = $this->table_name.'.state = 1 ';
        $where = $this->table_name . '.parent = ' . $parent_id;
        //$where  = $this->table_name.'.id <> 1000';
        $this->db->where($where);
        //$this->db->order_by($this->table_name.'.published', 'desc');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $result = $query->result_array();


    }

    public function getParents()
    {

        $select = $this->table_name . ' .* ';
        $this->db->select($select);
        $this->db->from($this->table_name);
        //$where  = $this->table_name.'.state = 1 ';
        $where = $this->table_name . '.parent IS NULL';
        //$where  = $this->table_name.'.id <> 1000';
        $this->db->where($where);
        //$this->db->order_by($this->table_name.'.published', 'desc');
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        return $result = $query->result_array();


    }
}