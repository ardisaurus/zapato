<?php
Class admin_list extends CI_Controller{
    
    var $API ="";
    
    function __construct() {
        parent::__construct();
        $this->API="http://localhost/zapato_server/index.php";
    }
    
    // menampilkan data administrasi
    function index(){        
        if($this->session->userdata('level')=='outlet'){ 
            $data['administrasi'] = json_decode($this->curl->simple_get($this->API.'/administrasi'));
            $data['title']='Daftar Admin';
            $data['page']='administrasi/admin_list';
            $this->load->view('outlet/dashboard',$data);
        }else{
            redirect('login');
        }
    }
}
?>