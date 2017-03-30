<?php
Class administrasi extends CI_Controller{
    
    var $API ="";
    
    function __construct() {
        parent::__construct();
        $this->API="http://localhost/zapato_server/index.php";
    }
    
    // menampilkan data administrasi
    function index(){        
        if($this->session->userdata('level')=='admin'){ 
            $data['administrasi'] = json_decode($this->curl->simple_get($this->API.'/administrasi'));
            $data['title']='Daftar Pengguna';
            $data['page']='administrasi/list';
            $this->load->view('admin/dashboard',$data);
        }else{
            redirect('login');
        }
    }

    // insert data mahasiswa
    function create(){                
        if($this->session->userdata('level')=='admin'){
            if(isset($_POST['submit'])){
                $this->form_validation->set_rules('user_id', 'Id Pengguna', 'min_length[6]|max_length[25]|trim|required|alpha_dash');
                $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passwordconf]|min_length[8]|max_length[12]');
                $this->form_validation->set_rules('passwordconf', 'Konfirmasi Password', 'trim|required');
                $this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[4]|max_length[50]');               
                $this->form_validation->set_rules('telepon', 'Telepon', 'trim|required|min_length[11]|max_length[12]|numeric');                           
                $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|min_length[11]');
                if ($this->form_validation->run() == FALSE)
                {
                    $data['title']='Tambah Pengguna';
                    $data['page']='administrasi/create';
                    $this->load->view('administrasi/dashboard',$data);
                }else{
                    $params = array('user_id'=>  $this->input->post('user_id'));
                    $data['administrasi'] = json_decode($this->curl->simple_get($this->API.'/administrasi',$params)); 
                    if ($data['administrasi']) {
                        $this->session->set_flashdata('peringatan','ID pengguna telah digunakan, masukan id lain!');
                        $data['title']='Tambah Pengguna';
                        $data['page']='administrasi/create';
                        $this->load->view('administrasi/dashboard',$data);
                    }else{
                         $data = array(
                        'user_id'       =>  $this->input->post('user_id'),
                        'nama'      =>  $this->input->post('nama'),
                        'password'       =>  md5($this->input->post('password')),
                        'alamat'=>  $this->input->post('alamat'),
                        'level'=>  $this->input->post('level'),
                        'telepon'    =>  $this->input->post('telepon'));
                        $insert =  $this->curl->simple_post($this->API.'/administrasi', $data, array(CURLOPT_BUFFERSIZE => 10)); 
                        if($insert)
                        {
                            $this->session->set_flashdata('hasil','Insert Data Berhasil');
                        }else
                        {
                           $this->session->set_flashdata('hasil','Insert Data Gagal');
                        }
                        redirect('administrasi');
                    }
                }                
            }else{
                $data['title']='Tambah Pengguna';
                $data['page']='administrasi/create';
                $this->load->view('admin/dashboard',$data);
            }
        }else{
            redirect('login');
        }
    }
    
    // edit data administrasi
    function edit(){
        if(isset($_POST['submit'])){
            $this->form_validation->set_rules('user_id', 'Id Pengguna', 'min_length[6]|max_length[25]|trim|required|alpha_dash');
            $this->form_validation->set_rules('nama', 'Nama', 'trim|required|min_length[4]|max_length[50]');               
            $this->form_validation->set_rules('telepon', 'Telepon', 'trim|required|min_length[11]|max_length[12]|numeric');                           
            $this->form_validation->set_rules('alamat', 'Alamat', 'trim|required|min_length[11]');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('peringatan', validation_errors());
                redirect('administrasi/edit/'. $this->session->userdata('user_id'));
                $params = array('user_id'=>  $this->uri->segment(3));
                $data['administrasi'] = json_decode($this->curl->simple_get($this->API.'/administrasi',$params));      
            }else{
                if ($this->input->post('user_id')!=$this->session->userdata('user_id')) {
                    $params = array('user_id'=>  $this->input->post('user_id'));
                    $data['administrasi'] = json_decode($this->curl->simple_get($this->API.'/administrasi',$params));
                }                 
                if ($data['administrasi']) {
                    $this->session->set_flashdata('peringatan','ID pengguna telah digunakan, masukan id lain!');
                    redirect('administrasi/edit/'. $this->session->userdata('user_id'));
                    $params = array('user_id'=>  $this->uri->segment(3));
                    $data['administrasi'] = json_decode($this->curl->simple_get($this->API.'/administrasi',$params)); 
                }else{                    
                    $params = array('user_id'=>  $this->session->userdata('user_id'));
                    $data['administrasi'] = json_decode($this->curl->simple_get($this->API.'/administrasi',$params)); 
                    foreach ($data['administrasi'] as $m){
                        $pass=$m->password;
                    }
                    $data = array(
                       'user_id'       =>  $this->session->userdata('user_id'),
                       'id_baru'       =>  $this->input->post('user_id'),
                       'password'      =>  $pass,                       
                       'nama'          => $this->input->post('nama'),
                       'alamat'=>  $this->input->post('alamat'),
                       'telepon'        => $this->input->post('telepon'));
                    $update =  $this->curl->simple_put($this->API.'/administrasi', $data, array(CURLOPT_BUFFERSIZE => 10)); 
                    if($update)
                    {
                        $this->session->set_flashdata('hasil','Update Data Berhasil');
                        $this->session->set_userdata('user_id',$this->input->post('user_id'));
                    }else{
                        $this->session->set_flashdata('hasil','Update Data Gagal');
                    }
                    redirect('administrasi/edit/'. $this->session->userdata('user_id'));
                    $params = array('user_id'=>  $this->uri->segment(3));
                    $data['administrasi'] = json_decode($this->curl->simple_get($this->API.'/administrasi',$params));  
                }
            }
        }else{
            $params = array('user_id'=>  $this->uri->segment(3));
            if ($this->session->userdata('user_id')==$this->uri->segment(3)) {                
                $data['administrasi'] = json_decode($this->curl->simple_get($this->API.'/administrasi',$params));            
                $data['title']='Pengaturan';
                $data['page']='administrasi/edit';
                $this->load->view('administrasi/dashboard',$data);
            }else{
                redirect($this->session->userdata('level')."/welcome");
            }
        }
    }

    // edit data administrasi
    function edit_password(){
        if(isset($_POST['submit'])){
            $this->form_validation->set_rules('password', 'Password', 'trim|required|matches[passwordconf]|min_length[8]|max_length[12]');
            $this->form_validation->set_rules('passwordconf', 'Konfirmasi Password', 'trim|required');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('peringatan', validation_errors());
                redirect('administrasi/edit_password/'. $this->session->userdata('user_id'));
                $params = array('user_id'=>  $this->uri->segment(3));
                $data['administrasi'] = json_decode($this->curl->simple_get($this->API.'/administrasi',$params));  
            }else{
                $params = array('user_id'=>  $this->session->userdata('user_id'));
                $data['administrasi'] = json_decode($this->curl->simple_get($this->API.'/administrasi',$params)); 
                if ($data['administrasi']) {
                     foreach ($data['administrasi'] as $m){
                        $pass1=$m->password;
                        $pass2=md5($this->input->post('password_lama'));
                        if ($pass2==$pass1) {
                            $data = array(
                            'user_id'       =>  $this->session->userdata('user_id'),
                            'password'      =>  md5($this->input->post('password')),
                            'id_baru'       =>  $this->session->userdata('user_id'),
                            'nama'          =>  $m->nama,
                            'alamat'        =>  $m->alamat,
                            'telepon'       =>  $m->telepon);
                            $update =  $this->curl->simple_put($this->API.'/administrasi', $data, array(CURLOPT_BUFFERSIZE => 10)); 
                            if($update)
                            {
                                $this->session->set_flashdata('hasil','Password berhasil diubah');
                            }else{
                                $this->session->set_flashdata('hasil','Password gagal diubah');
                            }
                                redirect('administrasi/edit/'. $this->session->userdata('user_id'));
                        }else{
                            $this->session->set_flashdata('peringatan','Password lama salah!');
                            redirect('administrasi/edit_password/'. $this->session->userdata('user_id'));
                            $params = array('user_id'=>  $this->uri->segment(3));
                            $data['administrasi'] = json_decode($this->curl->simple_get($this->API.'/administrasi',$params));  
                        }
                    }
                }else{
                    $this->session->set_flashdata('peringatan','Error!');
                    redirect('administrasi/edit_password/'. $this->session->userdata('user_id'));
                    $params = array('user_id'=>  $this->uri->segment(3));
                    $data['administrasi'] = json_decode($this->curl->simple_get($this->API.'/administrasi',$params));    
                }
            }
        }else{
            $params = array('user_id'=>  $this->uri->segment(3));
            if ($this->session->userdata('user_id')==$this->uri->segment(3)) {                
                $data['administrasi'] = json_decode($this->curl->simple_get($this->API.'/administrasi',$params));            
                $data['title']='Pengaturan Password';
                $data['page']='administrasi/v_pengaturan_password';
                $this->load->view('administrasi/dashboard',$data);
            }else{
                redirect($this->session->userdata('level')."/welcome");
            }
        }
    }
    
    // delete data administrasi
    function delete($user_id){
        if(empty($user_id)){
            redirect('administrasi');
        }else{
            $delete =  $this->curl->simple_delete($this->API.'/administrasi', array('user_id'=>$user_id), array(CURLOPT_BUFFERSIZE => 10)); 
            if($delete)
            {
                $this->session->set_flashdata('hasil','Delete Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Delete Data Gagal');
            }
            redirect('administrasi');
        }
    }

    // delete data administrasi
    function delete_me($user_id){
        if(empty($user_id)){
            redirect('administrasi');
        }else{
            $delete =  $this->curl->simple_delete($this->API.'/administrasi', array('user_id'=>$user_id), array(CURLOPT_BUFFERSIZE => 10)); 
            if($delete)
            {
                $this->session->set_flashdata('hasil','Delete Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Delete Data Gagal');
            }
            redirect('administrasi/logout');
        }
    }

    function logout(){
        $this->session->unset_userdata('user_id');        
        $this->session->unset_userdata('level');
        redirect('login');
    }
}