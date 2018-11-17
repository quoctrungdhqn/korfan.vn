<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Custom_model extends CI_Model {

	function __construct()
    {
        parent::__construct();
        $this->table_name = 'cp_custom';
    }
	
	function getAllCustom()
	{
		$this->db->order_by('id', 'DESC');			
		$this->db->select('*');
		$result = $this->db->get($this->table_name);
		
		return $result->result();
	}
	
	function getCustomInfo($id)
	{
		$result = $this->db->get_where($this->table_name, array('id' => $id));
		
		return $result->row();
	}
    
    function getCustomInfoBySlug($slug)
	{
		$result = $this->db->get_where($this->table_name, array('slug' => $slug));
		
		return $result->row();
	}
	
	function getCustomNum()
	{
		$result = $this->db->get($this->table_name);
		
		return $result->num_rows();
	}
	

	function insertCustom()
	{
		$user = $this->session->userdata('userLogged');
		$data = array(			
			'title' => $this->input->post('title'),
			'slug' => mb_strtolower(url_title(removesign($this->input->post('title')))),			
			'content' => $this->input->post('content'),
			'state' => $this->input->post('state')
		);
		
		if($this->db->insert($this->table_name, $data))
		{
			return true;
		}
		
		return false;
	}
	
	function updateCustom()
	{
		$user = $this->session->userdata('userLogged');
		$id = $this->input->post('id');
		$data = array(			
			'title' => $this->input->post('title'),
			'slug' => mb_strtolower(url_title(removesign($this->input->post('title')))),						
			'content' => $this->input->post('content'),
            'state' => $this->input->post('state')
		);
		
		$this->db->where('id', $id);
		
		if($this->db->update($this->table_name, $data))
		{
			return true;
		}
		
		return false;
	}
	
	function updateState($id, $state)
	{
		$this->db->where('id' , $id);
		$data = array('state' => $state);
		
		if($this->db->update($this->table_name, $data))
		{
			return true;
		}
		
		return false;
	}
	
	function updateFeatured($id, $featured)
	{
		$this->db->where('id' , $id);
		$data = array('featured' => $featured);
		
		if($this->db->update($this->table_name, $data))
		{
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
		}
		catch(Exeption $e)
		{
			return false;
		}
	}
	
	function deleteItem($id)
	{
		$this->db->where("id", $id);
		
		try {
			$this->db->delete($this->table_name);
			
			return true;
		}
		catch(Exeption $e)
		{
			return false;
		}
	}
    
}
?>