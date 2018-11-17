<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Access extends CI_Controller {

	public function index()
	{		
		if( $this->session->userdata('loggedAdmin') == false)
		{
			$this->load->view('admin/admin_login');
		}
        else
        {
            redirect('admin/dashboard');
        }
	}
}