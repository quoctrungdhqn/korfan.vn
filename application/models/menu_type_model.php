<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menu_Type_Model extends CI_Model {

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'cp_menus_type';
    }

    function get_all_items()
    {
        $this->db->order_by('id', 'ASC');
        $this->db->select('a.*');
        $result = $this->db->get($this->table_name.' a');

        return $result->result();
    }

    function get_items_info($id)
    {
        $this->db->order_by('a.id', 'DESC');
        $this->db->select('a.*');
        $this->db->where("a.id", $id);
        $result = $this->db->get($this->table_name.' a');

        return $result->row();
    }
    function insert()
    {

        $data = array(
            'name' => $this->input->post('name'),
            'state' => $this->input->post('state')

        );

        if($this->db->insert($this->table_name, $data))
        {
            return true;
        }

        return false;
    }
    function update()
    {
        $id = $this->input->post('id');
        $data = array(
            'name' => $this->input->post('name'),
            'state' => $this->input->post('state')

        );
        $this->db->where('id', $id);
        if($this->db->update($this->table_name, $data))
        {
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
        }
        catch(Exeption $e)
        {
            return false;
        }
    }

}
?>