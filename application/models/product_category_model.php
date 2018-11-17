<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Product_Category_Model extends CI_Model
{

    function __construct()
    {

        parent::__construct();

        $this->table_name = 'cp_products_categories';

    }

    function getProductsCategoryInfo($catid)
    {

        $result = $this->db->get_where($this->table_name, array('id' => $catid));

        return $result->row();

    }

    function getProductsSlug($slug)
    {

        $result = $this->db->get_where($this->table_name, array('alias' => $slug));


        return $result->row();

    }

    function getAllProductsCategoriesHome()
    {

        $this->db->order_by('lft', 'ASC');

        $this->db->where('Id <> 1000');
        $this->table_name . '.state = 1 ';
        $result = $this->db->get($this->table_name);


        return $result->result();

    }

    function getParents()
    {
        $this->db->order_by('lft', 'DESC');
        $this->db->where('parents', '1000');
        $result = $this->db->get($this->table_name);

        return $result->result();
    }

    function getAllProductsCategories()
    {

        $this->db->order_by('id', 'ASC');

        $this->db->where('id <> 1000');
        $this->table_name . '.state = 1 ';
        $result = $this->db->get($this->table_name);


        return $result->result();

    }

    function getCategoryChild($parent_id)
    {

        $select = $this->table_name . ' .* ';

        $this->db->select($select);

        $this->db->from($this->table_name);

        $where = $this->table_name . '.state = 1 ';

        $where = $this->table_name . '.parents = ' . $parent_id;

        //$where = $this->table_name.'.id <> 1000';

        $this->db->where($where);

        $this->db->order_by($this->table_name . '.lft');

        $query = $this->db->get();

        return $query->result_array();

    }

    function deleteItem($id)
    {
        $where = $this->table_name . '.id = ' . $id;
        $this->db->where($where);
        try {
            $this->db->delete($this->table_name);

            return true;
        } catch (Exeption $e) {
            return false;
        }
    }

    public function menuDeQuy($parentId = 0)
    {

        $menu = '';

        $records = $this->db->select('*')
            ->where('parents', $parentId)
            ->get($this->table_name)
            ->result_array();  // Lấy record menu với tham số truyền vào là parentId

        $menu .= '<ul id="sidebar">';


        foreach ($records as $k => $v) {

            $slug = $v['slug'];

            $menu .= '<a href="' . base_url() . 'danh-muc/' . $slug . '">';

            $menu .= '<li>' . $v['name'];

            $menu .= $this->menuDeQuy($v['id']);

            $menu .= '</li>';

            $menu .= '</a>';

        }


        $menu .= '</ul>';

        return $menu;

    }

    function getProductsCategoryNum()
    {

        $result = $this->db->get($this->table_name);


        return $result->num_rows();

    }

}

?>