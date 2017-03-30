<?php
Class Transaksi extends CI_Controller{
    
    var $API ="";
    
    function __construct() {
        parent::__construct();
        $this->API="http://localhost/zapato_server/index.php";
        if($this->session->userdata('level')!='outlet'){
            redirect('login');
        }
    }
    
    // menampilkan data transaksi
    function index(){
        $params = array('user_id'=>  $this->session->userdata('user_id'));
        $data['transaksi'] = json_decode($this->curl->simple_get($this->API.'/transaksi', $params));
        $data['title']='Daftar transaksi';
        $data['page']='outlet/transaksi_list';
        $this->load->view('outlet/dashboard',$data);
    }

    // insert data mahasiswa
    function create(){
                $this->form_validation->set_rules('ukuran', 'ukuran', 'trim|required|numeric|min_length[2]|max_length[3]');
                $this->form_validation->set_rules('jml', 'jumlah', 'trim|required|numeric|max_length[5]');
                if ($this->form_validation->run() == FALSE)
                {
                    $this->session->set_flashdata('peringatan', validation_errors());
                    redirect('outlet/gudang');
                }else{
                    $jumlah=$this->input->post('jml');
                    $stok=$this->input->post('stok');
                    if ($jumlah <= $stok) {
                        $data = array(
                        'id_transaksi'       =>  $this->input->post('id_transaksi'),
                        'user_id'      =>  $this->session->userdata('user_id'),
                        'id_sepatu'       =>  $this->input->post('id_sepatu'),
                        'id_gudang'=>  $this->input->post('id_gudang'),
                        'ukuran'       =>  $this->input->post('ukuran'),
                        'jml'=>  $this->input->post('jml'),
                        'status'    =>  'Menunggu Konfirmasi');
                        $insert =  $this->curl->simple_post($this->API.'/transaksi', $data, array(CURLOPT_BUFFERSIZE => 10)); 
                        if($insert)
                        {
                            $this->session->set_flashdata('hasil','Insert Data Berhasil');
                        }else
                        {
                           $this->session->set_flashdata('hasil','Insert Data Gagal');
                        }
                        redirect('outlet/transaksi');
                    }else{
                        $this->session->set_flashdata('peringatan', 'Jumlah pesanan lebih besar dari stok yang tersedia.');
                        redirect('outlet/gudang');
                    }                    
                }
    }
    
    // edit data transaksi
    function edit(){
            if(isset($_POST['submit'])){
                $params = array('id_sepatu'       =>  $this->input->post('id_sepatu'));
                $data['stok_gudang'] = json_decode($this->curl->simple_get($this->API.'/stok_gudang', $params));
                foreach ($data['stok_gudang'] as $m) {
                    $stok=$m->stok;
                }
                $this->form_validation->set_rules('jml', 'jumlah', 'trim|required|numeric|max_length[5]');
                if ($this->form_validation->run() == FALSE)
                {
                    $this->session->set_flashdata('peringatan', validation_errors());
                    redirect('outlet/transaksi/');
                    $params = array('id_transaksi'=>  $this->uri->segment(4));
                    $data['transaksi'] = json_decode($this->curl->simple_get($this->API.'/transaksi',$params));
                }else{
                    $jml= $this->input->post('jml');
                    if ($jml>$stok) {
                        $this->session->set_flashdata('peringatan', "Jumlah pesanan lebih besar dari stok yang tersedia");
                        redirect('outlet/transaksi/');
                        $params = array('id_transaksi'=>  $this->uri->segment(4));
                        $data['transaksi'] = json_decode($this->curl->simple_get($this->API.'/transaksi',$params));
                    }else{
                        $data = array(
                            'id_transaksi'       =>  $this->input->post('id_transaksi'),
                            'user_id'      =>  $this->input->post('user_id'),
                            'id_sepatu'       =>  $this->input->post('id_sepatu'),
                            'id_gudang'=>  $this->input->post('id_gudang'),
                            'ukuran'       =>  $this->input->post('ukuran'),
                            'jml'=>  $this->input->post('jml'),
                            'status'    =>  $this->input->post('status'));
                        $update =  $this->curl->simple_put($this->API.'/transaksi', $data, array(CURLOPT_BUFFERSIZE => 10)); 
                        if($update)
                        {
                            $this->session->set_flashdata('hasil','Update Data Berhasil');
                        }else
                        {
                           $this->session->set_flashdata('hasil','Update Data Gagal');
                        }
                        redirect('outlet/transaksi');                        
                    }
                }
            }else{
                $params = array('id_transaksi'=>  $this->uri->segment(4));
                $this->session->set_userdata('id_transaksi',$this->uri->segment(4));
                $data['transaksi'] = json_decode($this->curl->simple_get($this->API.'/transaksi',$params));
                if ($data['transaksi']) {            
                    $data['title']='Ubah transaksi';
                    $data['page']='outlet/transaksi_edit';
                    $this->load->view('outlet/dashboard',$data);                    
                }else{
                    redirect('login');
                }
            }
    }

    function diterima($id_transaksi){
        if(empty($id_transaksi)){
            redirect('transaksi');
        }else{
            $params = array('id_transaksi' =>  $id_transaksi);
            $data['transaksi'] = json_decode($this->curl->simple_get($this->API.'/transaksi', $params));
            foreach ($data['transaksi'] as $m) {
                $data = array(
                    'id_transaksi'       =>  $m->id_transaksi,
                    'user_id'      =>  $m->user_id,
                    'id_sepatu'       =>  $m->id_sepatu,
                    'id_gudang'=>  $m->id_gudang,
                    'ukuran'       =>  $m->ukuran,
                    'jml'=>  $m->jml,
                    'status'    =>  'Diterima');
            }            
            $update =  $this->curl->simple_put($this->API.'/transaksi', $data, array(CURLOPT_BUFFERSIZE => 10));
            $create =  $this->curl->simple_post($this->API.'/stok_outlet', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($update AND $create)
            {
                $this->session->set_flashdata('hasil','Update Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Update Data Gagal');
            }
            redirect('outlet/transaksi');
        }
    }
    
    // delete data transaksi
    function delete($id_transaksi){
        if(empty($id_transaksi)){
            redirect('transaksi');
        }else{
            $delete =  $this->curl->simple_delete($this->API.'/transaksi', array('id_transaksi'=>$id_transaksi), array(CURLOPT_BUFFERSIZE => 10)); 
            if($delete)
            {
                $this->session->set_flashdata('hasil','Delete Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Delete Data Gagal');
            }
            redirect('outlet/transaksi');
        }
    }
}