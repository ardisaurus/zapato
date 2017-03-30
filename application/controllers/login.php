<?php
Class login extends CI_Controller{
    
    var $API ="";
    
    function __construct() {
        parent::__construct();
        $this->API="http://localhost/zapato_server/index.php";
        if($this->session->userdata('user_id')){
            $level=$this->session->userdata('level');
            redirect($level.'/welcome/');
        }
    }

    function index(){
        $data['administrasi'] = json_decode($this->curl->simple_get($this->API.'/administrasi'));
        $data['title']='Login';
        $this->load->view('v_login',$data);
    }
    
    function proses(){        
            $this->form_validation->set_rules('user_id', 'Id Pengguna', 'trim|required|alpha_dash');
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[8]|max_length[12]');
            if ($this->form_validation->run() == FALSE)
            {
                $data['title']='Login';
                $this->load->view('v_login',$data);
            }else{
                $params = array('user_id'=>  $this->input->post('user_id'));
                $data['administrasi'] = json_decode($this->curl->simple_get($this->API.'/administrasi',$params)); 
                if ($data['administrasi']) {
                     foreach ($data['administrasi'] as $m){
                        $pass1=$m->password;
                        $pass2=md5($this->input->post('password'));
                        if ($pass2==$pass1) {
                            $this->session->set_userdata('user_id',$m->user_id);
                            $this->session->set_userdata('level',$m->level);
                            $level=$this->session->userdata('level');
                            redirect($level.'/welcome/');
                        }else{
                            $this->session->set_flashdata('peringatan','Password yang anda masukan salah!');
                            $data['title']='Login';
                            $this->load->view('v_login',$data);
                        }                        
                     }
                }else{
                    $this->session->set_flashdata('peringatan','ID pengguna tidak ditemukan!');
                    $data['title']='Login';
                    $this->load->view('v_login',$data);
                }
            }                
    }
}