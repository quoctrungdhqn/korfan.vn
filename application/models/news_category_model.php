<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class News_Category_Model extends CI_Model {

	function __construct()
    {
        parent::__construct();
        $this->table_name = 'cp_categories';
    }
	
	
	function get_items_info($catid)
	{
		
		$result = $this->db->get_where($this->table_name, array('id' => $catid));
		
		return $result->row();
	}
	function get_items_num()
	{
		$result = $this->db->get($this->table_name);
		
		return $result->num_rows();
	}
	
	function get_all_items()
	{
		$this->db->order_by('lft', 'ASC');
		
		$result = $this->db->get($this->table_name);
		
		return $result->result();
	}
	
	
	function getAllNew_TC($id)
	{

		$this->db->order_by('lft', 'ASC');

		$this->db->where('Id',$id);
		
		$this->table_name.'.state = 1 ';
		$result = $this->db->get($this->table_name);
		return $result->result();

	}
	
	function getAllNew()
	{

		$this->db->order_by('lft', 'ASC');

		$this->db->where('Id = 1015');
		$this->table_name.'.state = 1 ';
		$result = $this->db->get($this->table_name);
		return $result->result();

	}
	
	
	function getAllNew_KN()
	{

		$this->db->order_by('lft', 'ASC');

		$this->db->where('Id = 1019');
		$this->table_name.'.state = 1 ';
		$result = $this->db->get($this->table_name);
		return $result->result();

	}
	
	function get_sub_category($id)
	{
		$this->db->select('id');
		$this->db->order_by('lft', 'ASC');
		$this->db->where('parents', $id);
		$result = $this->db->get($this->table_name);
		return $result->result();
	}
	
	function get_sub_items($parent)
	{
		$this->db->select('lft, rgt');
		$this->db->where('id', $parent);
		
		$query = $this->db->get($this->table_name);
		
		$result = $query->row();
		$this->db->select('id');
		$this->db->where(array('lft > ' => $result->lft, 'rgt < ' => $result->rgt));
		$query = $this->db->get($this->table_name);
		
		$result = $query->result();
		
		if(count($result) > 0)
		{
			foreach($result as $item)
			{
				$data[] = $item->id;
			}
		}
		else
		{
			return 0;
		}
		
		return $data;
		
	}
	function getProductsSlug($slug)
	{

		$result = $this->db->get_where($this->table_name, array('alias'=> $slug));



		return $result->row();

	}
	
}
?>