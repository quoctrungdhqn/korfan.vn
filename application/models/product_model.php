<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');


class Product_model extends CI_Model
{


    function __construct()
    {

        parent::__construct();
        $this->table_name = 'cp_products';

    }

    function search($keyword)
    {
        $this->db->like('title', $keyword);
        $query = $this->db->get($this->table_name);
        return $query->result();
    }

    function getAllProducts($limit, $start)
    {

        $this->db->order_by('p.id', 'DESC');

        $this->db->limit($limit, $start);


        $this->db->join('cp_products_categories c', 'p.categoryId = c.id', 'left');

        $this->db->select('p.*, c.name as catTitle');

        $result = $this->db->get($this->table_name . ' p');


        return $result->result();

    }


    function getAllProductsByCat($id)
    {

        $this->db->order_by('p.id', 'DESC');
        $this->db->where('p.published', 1);

        //$this->db->limit($limit, $start);

        $this->db->where('p.categoryId', $id);

        $this->db->join('cp_products_categories c', 'p.categoryId = c.id', 'left');

        $this->db->select('p.*, c.name as catTitle');

        $result = $this->db->get($this->table_name . ' p');


        return $result->result();

    }

    function getAllProductLimitsId_1($catid)
    {

        $this->db->order_by('p.id', 'RANDOM');
        $this->db->where('p.categoryId', $catid);
        //$this->db->where('p.categoryId in (1035, 1036, 1037, 1038)');
        $this->db->where('p.published', 1);

        $this->db->join('cp_products_categories c', 'p.categoryId = c.id', 'left');

        $this->db->select('p.*, c.name as catTitle');

        $result = $this->db->get($this->table_name . ' p');


        return $result->result();

    }

    function getAllProductLimitsId_home($catid)
    {

        $this->db->order_by('p.id', 'RANDOM');
        $this->db->limit(1);
        $this->db->where('p.categoryId', $catid);
        //$this->db->where('p.categoryId in (1035, 1036, 1037, 1038)');
        $this->db->where('p.published', 1);

        $this->db->join('cp_products_categories c', 'p.categoryId = c.id', 'left');

        $this->db->select('p.*, c.name as catTitle');

        $result = $this->db->get($this->table_name . ' p');


        return $result->result();

    }


    function getAllProductLimitsId($limit)
    {

        $this->db->order_by('p.id', 'RANDOM');

        $this->db->limit($limit);

        $this->db->where('p.categoryId in (1035, 1036, 1037, 1038)');
        $this->db->where('p.published', 1);

        $this->db->join('cp_products_categories c', 'p.categoryId = c.id', 'left');

        $this->db->select('p.*, c.name as catTitle');

        $result = $this->db->get($this->table_name . ' p');


        return $result->result();

    }

    function getAllProductLimitsByCat($id, $limit)
    {

        $this->db->order_by('p.id', 'RANDOM');

        $this->db->limit($limit);

        $this->db->where('p.categoryId', $id);
        $this->db->where('p.published', 1);

        $this->db->join('cp_products_categories c', 'p.categoryId = c.id', 'left');

        $this->db->select('p.*, c.name as catTitle');

        $result = $this->db->get($this->table_name . ' p');


        return $result->result();

    }

    function getAllProductsByCatSlug($slug)
    {

        $this->db->order_by('p.id', 'DESC');

        //$this->db->limit($limit, $start);

        $this->db->where('c.slug', $slug);

        $this->db->join('cp_products_categories c', 'p.categoryId = c.id', 'left');

        $this->db->select('p.*, c.name as catTitle');

        $result = $this->db->get($this->table_name . ' p');


        return $result->result();

    }

    function getProductHome()
    {

        $this->db->order_by('p.id', 'DESC');

        $this->db->limit('8');

        $this->db->join('cp_products_categories c', 'p.categoryId = c.id', 'left');

        $this->db->select('p.*, c.name as catTitle');

        $result = $this->db->get($this->table_name . ' p');


        return $result->result();

    }

    function getRelativeProducts($catid, $limit)
    {

        $this->db->order_by('p.id', 'DESC');

        $this->db->limit($limit);

        $this->db->where('p.categoryId', $catid);

        $this->db->join('cp_products_categories c', 'p.categoryId = c.id', 'left');

        $this->db->select('p.*, c.name as catTitle');

        $result = $this->db->get($this->table_name . ' p');


        return $result->result();

    }

    function getAllProductsNoLimit()
    {

        $this->db->order_by('p.id', 'DESC');


        $this->db->join('cp_products_categories c', 'p.categoryId = c.id', 'left');

        $this->db->select('p.*, c.name as catTitle');

        $result = $this->db->get($this->table_name . ' p');


        return $result->result();

    }


    function getProductInfo($id)
    {

        $result = $this->db->get_where($this->table_name, array('id' => $id));


        return $result->row();

    }


    function getProductSlug($slug)
    {

        $result = $this->db->get_where($this->table_name, array('alias' => $slug));


        return $result->row();

    }


    function getProductAlias($alias)
    {
        $result = $this->db->get_where($this->table_name, array('alias' => $alias));
        return $result->row();
    }


    function getProductsNum()
    {

        $result = $this->db->get($this->table_name);


        return $result->num_rows();

    }


    function insertProduct($image)
    {

        $data = array(
            'title' => $this->input->post('title'),
            'alias' => mb_strtolower(url_title(removesign($this->input->post('title')))),
            'categoryId' => $this->input->post('categoryId'),
            'image' => $image,
            'detail' => $this->input->post('detail'),
            'seo_title' => $this->input->post('seo_title'),
            'seo_description' => $this->input->post('seo_description'),
            'seo_keyword' => $this->input->post('seo_keyword'),
            'published' => $this->input->post('published')
        );


        if ($this->db->insert($this->table_name, $data)) {
            return true;
        }

        return false;
    }


    function updateProduct($image)
    {

        $id = $this->input->post('id');

        $data = array(
            'title' => $this->input->post('title'),
            'alias' => mb_strtolower(url_title(removesign($this->input->post('title')))),
            'categoryId' => $this->input->post('categoryId'),
            'image' => $image,
            'detail' => $this->input->post('detail'),
            'seo_title' => $this->input->post('seo_title'),
            'seo_description' => $this->input->post('seo_description'),
            'seo_keyword' => $this->input->post('seo_keyword'),
            'published' => $this->input->post('published')
        );

        $this->db->where('id', $id);

        if ($this->db->update($this->table_name, $data)) {
            return true;
        }

        return false;

    }


    function updateState($id, $state)
    {

        $this->db->where('id', $id);

        $data = array('state' => $state);


        if ($this->db->update($this->table_name, $data)) {

            return true;

        }


        return false;

    }


    function updateFeatured($id, $featured)
    {

        $this->db->where('id', $id);

        $data = array('featured' => $featured);


        if ($this->db->update($this->table_name, $data)) {

            return true;

        }


        return false;

    }


    function deleteIds()
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


    function deleteItem($id)
    {

        $this->db->where("id", $id);


        try {

            $this->db->delete($this->table_name);


            return true;

        } catch (Exeption $e) {

            return false;

        }

    }


    function getSearchProducts()
    {

        $cond = $this->input->post('cond');


        $this->db->like('title', $cond);


        $result = $this->db->get($this->table_name);


        return $result->result();

    }


    function getProListForDashboard()
    {

        $this->db->select('p.id, p.title, c.name as catTitle');

        $this->db->join('cp_products_categories c', 'c.id = p.categoryId');

        $this->db->order_by('p.id', 'desc');

        $this->db->limit(5);

        $query = $this->db->get($this->table_name . ' p');


        return $query->result();

    }


    function get_all()
    {


        $results = $this->db->get($this->table_name)->result();


        foreach ($results as & $result) {


            if ($result->option_value) {

                $result->option_value = explode(',', $result->option_value);

            }


        }


        return $results;


    }


    function get($id)
    {


        $results = $this->db->get_where($this->table_name, array('id' => $id))->result();

        $result = $results[0];


        if ($result->option_value) {

            $result->option_value = explode(',', $result->option_value);

        }


        return $result;

    }

}

?>