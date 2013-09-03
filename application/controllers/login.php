<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {
	

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	function __construct(){
        parent::__construct();
	}
	public function index($data = array())
	{
		$flash_data = $this->session->flashdata('message');
		if ($flash_data)
		{
		    $data['message'] = $this->load->vars($flash_data);
		}
		
		$user = $this->session->userdata('username');
		// print_r($user); exit;
		
		if(empty($user)){
			$this->load->view('login', $data);
		}
		else {
			$this->load->view('general/header');
			$this->load->view('dashboard');
			$this->load->view('general/footer');
		}
		
	}
	function dologin(){
		$data = array();
		$this->load->model('M_login');
		$user = $this->M_login->login($_POST['username'], md5($_POST['password']));
		if(count($user) == 1){
			$data = '';
			// print_r($user);exit;
			$userdata = array(
	           'username'  => $user[0]['username'],
	           'level'     => $user[0]['level'],
	           'logged_in' => TRUE
			);
			$this->session->set_userdata($userdata); 
		}
		else{
			$data = 'Wrong username and/or password.';
			// $this->load->view('login', $data);
			// $this->index($data);
			$this->session->set_flashdata('message', $data);
		}
		redirect(base_url());
		
	}
	
	function logout(){
		$this->session->unset_userdata('username');
		redirect(base_url());
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */