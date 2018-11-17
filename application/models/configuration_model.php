<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Configuration_Model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'cp_configuration';
    }


    function getConfigurationInfoCode($code)
    {

        $result = $this->db->get_where($this->table_name, array('code' => $code));

        return $result->row();
    }

    function getConfigurationInfo($id)
    {

        $result = $this->db->get_where($this->table_name, array('id' => $id));

        return $result->row();
    }

    function getAllConfiguration()
    {
        $this->db->order_by('id', 'ASC');

        $result = $this->db->get($this->table_name);

        return $result->result();
    }

    function insertConfiguration()
    {
        $data = array(
            'title' => $this->input->post('title'),
            'code' => $this->input->post('code'),
            'value' => $this->input->post('value')
        );

        if ($this->db->insert($this->table_name, $data)) {
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

    function updateConfiguration()
    {
        $id = $this->input->post('id');
        $data = array(
            //'title' => $this->input->post('title'),
            //'code' => $this->input->post('code'),
            'value' => $this->input->post('value')
        );

        $this->db->where('id', $id);

        if ($this->db->update($this->table_name, $data)) {
            return true;
        }

        return false;
    }
}

?>