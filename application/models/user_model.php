<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->table_name = 'cp_users';
    }

    function checkLogin($username, $password)
    {
        $this->db->select('u.*, g.id as gId, g.role, g.groupName');
        $this->db->join('cp_users_groups g', 'g.id=u.userGroup');
        $query = $this->db->get_where('cp_users u', array('username' => $username, 'password' => $password, 'state' => 1));

        return $query->row();
    }

    function getAllUsers()
    {

        $this->db->select('u.*, g.groupName, g.role');
        $this->db->join('cp_users_groups AS g', 'u.userGroup=g.id');
        $this->db->order_by('userGroup', 'ASC');
        $query = $this->db->get('cp_users u');

        return $query->result();
    }

    function getUser($id)
    {
        $this->db->select('u.*, g.groupName, g.role');
        $this->db->where('u.userGroup = g.id AND u.id = ', $id);
        $query = $this->db->get('cp_users u, cp_users_groups AS g');

        return $query->result();
    }

    function getUserInfo($id)
    {
        $this->db->select('u.*, g.groupName, g.role');
        $this->db->where('u.userGroup = g.id AND u.id = ', $id);
        $query = $this->db->get('cp_users u, cp_users_groups AS g');

        return $query->row();
    }

    function insertUser($image)
    {
        $data = array(
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password')),
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'userGroup' => $this->input->post('userGroup'),
            'state' => $this->input->post('state'),
            'avatar' => $image,
            'createdDate' => date('d-m-Y H:i:s')
        );

        if ($this->db->insert($this->table_name, $data)) {
            return true;
        }

        return false;
    }

    function updateUser($image)
    {
        $id = $this->input->post('id');
        $password = $this->input->post('password');
        $data = array(
            'firstname' => $this->input->post('firstname'),
            'lastname' => $this->input->post('lastname'),
            'email' => $this->input->post('email'),
            'phone' => $this->input->post('phone'),
            'address' => $this->input->post('address'),
            'userGroup' => $this->input->post('userGroup'),
            'state' => $this->input->post('state'),
            'avatar' => $image
        );

        if ($password != '') {
            $data['password'] = md5($password);
        }

        $this->db->where('id', $id);
        if ($this->db->update($this->table_name, $data)) {
            return true;
        }

        return false;
    }

    function removeUser($userid)
    {
        if ($this->db->delete($this->table_name, array('id' => $userid)))
            return true;

        return false;
    }

    function getUsersListForDashBoard()
    {
        $this->db->select('id, username, firstname, lastname, createdDate');
        $this->db->order_by('id', 'desc');
        $this->db->limit(5);
        $query = $this->db->get($this->table_name);

        return $query->result();
    }
}

?>