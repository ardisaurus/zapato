<?php
Class Gudang extends CI_Controller{
    
    var $API ="";
    
    function __construct() {
        parent::__construct();
        $this->API="http://localhost/zapato_server/index.php";
        if($this->session->userdata('level')!='admin'){
            redirect('login');
        }
    }
    
    // menampilkan data gudang
    function index(){
        $data['gudang'] = json_decode($this->curl->simple_get($this->API.'/gudang'));
        $data['title']='Daftar gudang';
        $data['page']='gudang/list';
        $this->load->view('admin/dashboard',$data);
        $this->session->unset_userdata('id_gudang');
    }

    // insert data mahasiswa
    function create(){
        if(isset($_POST['submit'])){
            $this->form_validation->set_rules('nama', 'nama', 'trim|required|min_length[5]|max_length[50]');
            $this->form_validation->set_rules('alamat', 'alamat', 'trim|required|min_length[11]');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('peringatan', validation_errors());
                $data['title']='Tambah gudang';
                $data['page']='gudang/create';
                $this->load->view('admin/dashboard',$data);
            }else{
                $data = array(
                'id_gudang'       =>  $this->input->post('id_gudang'),
                'nama'      =>  $this->input->post('nama'),
                'alamat'       =>  $this->input->post('alamat'));
                $insert =  $this->curl->simple_post($this->API.'/gudang', $data, array(CURLOPT_BUFFERSIZE => 10)); 
                if($insert)
                {
                    $this->session->set_flashdata('hasil','Insert Data Berhasil');
                }else{
                    $this->session->set_flashdata('hasil','Insert Data Gagal');
                }
                    redirect('admin/gudang');
                }
        }else{
            $data['title']='Tambah gudang';
            $data['page']='gudang/create';
            $this->load->view('admin/dashboard',$data);
        }
    }
    
    // edit data gudang
    function edit(){
        if(isset($_POST['submit'])){
                $this->form_validation->set_rules('nama', 'nama', 'trim|required|min_length[2]|max_length[50]');
                $this->form_validation->set_rules('alamat', 'alamat', 'trim|required|min_length[11]');
                if ($this->form_validation->run() == FALSE)
                {
                    $this->session->set_flashdata('peringatan', validation_errors());
                    redirect('admin/gudang/edit/'. $this->session->userdata('id_gudang'));
                    $params = array('id_gudang'=>  $this->uri->segment(4));
                    $data['gudang'] = json_decode($this->curl->simple_get($this->API.'/gudang',$params));
                }else{
                    $data = array(
                            'id_gudang'     => $this->input->post('id_gudang'),
                            'nama'          => $this->input->post('nama'),
                            'alamat'    => $this->input->post('alamat'));
                    $update =  $this->curl->simple_put($this->API.'/gudang', $data, array(CURLOPT_BUFFERSIZE => 10)); 
                    if($update)
                    {
                        $this->session->set_flashdata('hasil','Update Data Berhasil');
                    }else
                    {
                       $this->session->set_flashdata('hasil','Update Data Gagal');
                    }
                    redirect('admin/gudang');
                }
            }else{
                $params = array('id_gudang'=>  $this->uri->segment(4));
                $this->session->set_userdata('id_gudang',$this->uri->segment(4));
                $data['gudang'] = json_decode($this->curl->simple_get($this->API.'/gudang',$params));
                if ($data['gudang']) {            
                    $data['title']='Ubah gudang';
                    $data['page']='gudang/edit';
                    $this->load->view('admin/dashboard',$data);                                
                }else{
                    redirect('login');
                }
            }
    }            
    
    // delete data gudang
    function delete($id_gudang){
        if(empty($id_gudang)){
            redirect('gudang');
        }else{
            $delete =  $this->curl->simple_delete($this->API.'/gudang', array('id_gudang'=>$id_gudang), array(CURLOPT_BUFFERSIZE => 10)); 
            if($delete)
            {
                $this->session->set_flashdata('hasil','Delete Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Delete Data Gagal');
            }
            redirect('admin/gudang');
        }
    }

// =========================== STOK ===================================

    function stok(){
        $params = array('id_gudang'=>  $this->uri->segment(4));
        $this->session->set_userdata('id_gudang',$this->uri->segment(4));
        $data['gudang'] = json_decode($this->curl->simple_get($this->API.'/gudang',$params));
        $data['stok_gudang'] = json_decode($this->curl->simple_get($this->API.'/stok_gudang',$params));
        foreach ($data['gudang'] as $m) {
            $data['id_gud']=$m->id_gudang;
            $nama_gudang=$m->nama;
        }
            $data['title']=$nama_gudang;
            $data['page']='gudang/v_stok';
            $this->load->view('admin/dashboard',$data);      
    }
    
    function add_stok(){
        if(isset($_POST['submit'])){
            $this->form_validation->set_rules('ukuran', 'ukuran', 'trim|required|numeric|min_length[2]|max_length[3]');
            $this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required|numeric|max_length[5]');
            if ($this->form_validation->run() == FALSE)
            {
                $this->session->set_flashdata('peringatan', validation_errors());
                redirect('admin/gudang/add_stok/'.$this->session->userdata('id_gudang'));
            }else{
                $data = array(                
                'id_stok_gudang'       =>  $this->input->post('id_stok_gudang'),
                'id_gudang'       =>  $this->session->userdata('id_gudang'),
                'id_sepatu'      =>  $this->input->post('id_sepatu'),
                'stok'      =>  $this->input->post('jumlah'),
                'ukuran'       =>  $this->input->post('ukuran'));
                $insert =  $this->curl->simple_post($this->API.'/stok_gudang', $data, array(CURLOPT_BUFFERSIZE => 10)); 
                if($insert)
                {
                    $this->session->set_flashdata('hasil','Insert Data Berhasil');
                }else{
                    $this->session->set_flashdata('hasil','Insert Data Gagal');
                }
                    redirect('admin/gudang/stok/'.$this->session->userdata('id_gudang'));
            }
        }else{
            $params = array('id_gudang'=>   $this->session->userdata('id_gudang'));
            $data['gudang'] = json_decode($this->curl->simple_get($this->API.'/gudang',$params));
            if ($data['gudang']) {
                $data['sepatu'] = json_decode($this->curl->simple_get($this->API.'/sepatu'));
                $data['title']='Daftar Sepatu';
                $data['page']='gudang/sepatu';
                $this->load->view('admin/dashboard',$data);
            }else{
                redirect('login');
            }
        }
    }


    function edit_stok(){
        $this->form_validation->set_rules('jumlah', 'jumlah', 'trim|required|numeric|max_length[5]');
        if ($this->form_validation->run() == FALSE)
        {
            $this->session->set_flashdata('peringatan', validation_errors());
            redirect('admin/gudang/stok/'.$this->session->userdata('id_gudang'));
        }else{
            $data = array(
               'id_stok_gudang'     => $this->input->post('id_stok_gudang'),
               'id_gudang'     => $this->input->post('id_gudang'),
               'id_sepatu'     => $this->input->post('id_sepatu'),
               'ukuran'          => $this->input->post('ukuran'),
               'stok'    => $this->input->post('jumlah'));
            $update =  $this->curl->simple_put($this->API.'/stok_gudang', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($update)
            {
                $this->session->set_flashdata('hasil','Update Data Berhasil');
            }else{
                $this->session->set_flashdata('hasil','Update Data Gagal');
            }
            redirect('admin/gudang/stok/'.$this->session->userdata('id_gudang'));
        }
    }

    // delete data gudang
    function delete_stok($id_stok_gudang){
        if(empty($id_stok_gudang)){
            redirect('gudang');
        }else{
            $delete =  $this->curl->simple_delete($this->API.'/stok_gudang', array('id_stok_gudang'=>$id_stok_gudang), array(CURLOPT_BUFFERSIZE => 10)); 
            if($delete)
            {
                $this->session->set_flashdata('hasil','Delete Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Delete Data Gagal');
            }
            redirect('admin/gudang/stok/'.$this->session->userdata('id_gudang'));
        }
    }

// =========================== END OF STOK ============================
}