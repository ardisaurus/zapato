<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	 var $API ="";
    
    function __construct() {
        parent::__construct();
        $this->API="http://localhost/zapato_server/index.php";
         if($this->session->userdata('level')!='admin'){ 
        	redirect('login');
        }
    }
	 

	public function index()
	{		
		$data['title']='Welcome';
        $data['page']='admin/v_welcome';
		$this->load->view('admin/dashboard', $data);
	}
}