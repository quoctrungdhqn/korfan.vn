<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_group_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'cp_users_groups';
    }

    function getAllUserGroup()
    {

        $query = $this->db->get($this->table_name);

        foreach ($query->result_array() as $row) {
            $data[$row['id']] = $row['groupName'];
        }
        return $data;
    }

}

?>