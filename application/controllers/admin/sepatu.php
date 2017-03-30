<?php
Class Sepatu extends CI_Controller{
    
    var $API ="";
    
    function __construct() {
        parent::__construct();
        $this->API="http://localhost/zapato_server/index.php";
    }
    
    // menampilkan data sepatu
    function index(){
        if($this->session->userdata('level')=='admin'){
            $data['sepatu'] = json_decode($this->curl->simple_get($this->API.'/sepatu'));
            $data['title']='Daftar Sepatu';
            $data['page']='sepatu/list';
            $this->load->view('admin/dashboard',$data);
        }else{
            redirect('login');
        }
    }

    // insert data mahasiswa
    function create(){
        if($this->session->userdata('level')=='admin'){
            if(isset($_POST['submit'])){
                $this->form_validation->set_rules('brand', 'Brand', 'trim|required|min_length[2]|max_length[50]');
                $this->form_validation->set_rules('model', 'Model', 'trim|required|min_length[2]|max_length[50]');               
                $this->form_validation->set_rules('harga', 'Harga', 'trim|required|min_length[6]|max_length[12]|numeric');
                if ($this->form_validation->run() == FALSE)
                {
                    $data['title']='Tambah Sepatu';
                    $data['page']='sepatu/create';
                    $this->load->view('admin/dashboard',$data);
                }else{
                    $data = array(
                        'id_sepatu'       =>  $this->input->post('id_sepatu'),
                        'brand'      =>  $this->input->post('brand'),
                        'model'       =>  $this->input->post('model'),
                        'harga'=>  $this->input->post('harga'),
                        'foto'=>  $this->input->post('foto'),
                        'kategori'    =>  $this->input->post('kategori'));
                    $insert =  $this->curl->simple_post($this->API.'/sepatu', $data, array(CURLOPT_BUFFERSIZE => 10)); 
                    if($insert)
                    {
                        $this->session->set_flashdata('hasil','Insert Data Berhasil');
                    }else
                    {
                       $this->session->set_flashdata('hasil','Insert Data Gagal');
                    }
                    redirect('admin/sepatu');
                }
            }else{
                $data['title']='Tambah Sepatu';
                $data['page']='sepatu/create';
                $this->load->view('admin/dashboard',$data);
            }
        }else{
            redirect('login');
        }
    }
    
    // edit data sepatu
    function edit(){
        if($this->session->userdata('level')=='admin'){
            if(isset($_POST['submit'])){
                $this->form_validation->set_rules('brand', 'Brand', 'trim|required|min_length[2]|max_length[50]');
                $this->form_validation->set_rules('model', 'Model', 'trim|required|min_length[2]|max_length[50]');               
                $this->form_validation->set_rules('harga', 'Harga', 'trim|required|min_length[6]|max_length[12]|numeric');
                if ($this->form_validation->run() == FALSE)
                {
                   $this->session->set_flashdata('peringatan', validation_errors());
                    redirect('admin/sepatu/edit/'. $this->session->userdata('id_sepatu'));
                    $params = array('id_sepatu'=>  $this->uri->segment(4));
                    $data['sepatu'] = json_decode($this->curl->simple_get($this->API.'/sepatu',$params));
                }else{
                    $data = array(
                            'id_sepatu'     => $this->input->post('id_sepatu'),
                            'brand'          => $this->input->post('brand'),
                            'model'    => $this->input->post('model'),
                            'kategori'        => $this->input->post('kategori'),
                            'harga'=>  $this->input->post('harga'));
                    $update =  $this->curl->simple_put($this->API.'/sepatu', $data, array(CURLOPT_BUFFERSIZE => 10)); 
                    if($update)
                    {
                        $this->session->set_flashdata('hasil','Update Data Berhasil');
                    }else
                    {
                       $this->session->set_flashdata('hasil','Update Data Gagal');
                    }
                    redirect('admin/sepatu');
                }
            }else{
                $params = array('id_sepatu'=>  $this->uri->segment(4));
                $this->session->set_userdata('id_sepatu',$this->uri->segment(4));
                $data['sepatu'] = json_decode($this->curl->simple_get($this->API.'/sepatu',$params));
                if ($data['sepatu']) {            
                    $data['title']='Ubah Sepatu';
                    $data['page']='sepatu/edit';
                    $this->load->view('admin/dashboard',$data);                    
                }else{
                    redirect('login');
                }
            }
        }else{
            redirect('login');
        }
    }
    
    // delete data sepatu
    function delete($id_sepatu){
        if(empty($id_sepatu)){
            redirect('admin/sepatu');
        }else{
            $delete =  $this->curl->simple_delete($this->API.'/sepatu', array('id_sepatu'=>$id_sepatu), array(CURLOPT_BUFFERSIZE => 10)); 
            if($delete)
            {
                $this->session->set_flashdata('hasil','Delete Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Delete Data Gagal');
            }
            redirect('admin/sepatu');
        }
    }
}