<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Users extends CI_Controller
{

    public function loginAdmin()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        $this->load->model('User_model');

        $user = $this->User_model->checkLogin($username, $password);

        if ($user) {

            $newData = array(
                'loggedAdmin' => true,
                'userLogged' => $user
            );

            $this->session->set_userdata($newData);

            redirect('access');

        } else {
            $this->session->set_flashdata('message', 1);
            redirect('access');
        }
    }

    public function login()
    {
        $username = $this->input->post('username');
        $password = md5($this->input->post('password'));

        $this->load->model('User_model');

        $user = $this->User_model->checkLogin($username, $password);

        if ($user) {
            $newData = array(
                'loggedAdmin' => false,
                'userLogged' => $user
            );

            $this->session->set_userdata($newData);

            redirect('admin/dashboard');
        } else {
            $data = array('error' => 'Wrong username or password!');
            $this->session->set_userdata($data);
            redirect('access');
        }
    }

    public function logout()
    {
        $this->session->unset_userdata(array('loggedAdmin' => false, 'userLogged' => null));

        redirect('access');
    }
}