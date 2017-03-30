<?php
Class Transaksi extends CI_Controller{
    
    var $API ="";
    
    function __construct() {
        parent::__construct();
        $this->API="http://localhost/zapato_server/index.php";
        if($this->session->userdata('level')!='admin'){
            redirect('login');
        }
    }
    
    // menampilkan data transaksi
    function index(){
        $data['transaksi'] = json_decode($this->curl->simple_get($this->API.'/transaksi'));
        $data['title']='Daftar transaksi';
        $data['page']='admin/transaksi_list';
        $this->load->view('admin/dashboard',$data);
    }

    function ditolak($id_transaksi){
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
                    'status'    =>  'Ditolak');
            }            
            $update =  $this->curl->simple_put($this->API.'/transaksi', $data, array(CURLOPT_BUFFERSIZE => 10)); 
            if($update)
            {
                $this->session->set_flashdata('hasil','Update Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Update Data Gagal');
            }
            redirect('admin/transaksi');
        }
    }

    function dikonfirmasi($id_transaksi){
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
                    'status'    =>  'Dikonfirmasi');
                    $jml = $m->jml;
                    $id_gudang = $m->id_gudang;
                    $id_sepatu = $m->id_sepatu;
            }
            $params = array('id_sepatu' =>  $id_sepatu, 'id_gudang' =>  $id_gudang);
            $data['stok_gudang'] = json_decode($this->curl->simple_get($this->API.'/stok_gudang', $params));
            foreach ($data['stok_gudang'] as $m) {
                $stok = $m->stok;
            }
            if ($jml>$stok) {
                $this->session->set_flashdata('peringatan',"Stok hanya tersedia ".$stok );
                redirect('admin/transaksi');
            }else{
                $update =  $this->curl->simple_put($this->API.'/transaksi', $data, array(CURLOPT_BUFFERSIZE => 10)); 
                if($update)
                {
                    $this->session->set_flashdata('hasil','Update Data Berhasil');
                }else
                {
                   $this->session->set_flashdata('hasil','Update Data Gagal');
                }
                redirect('admin/transaksi');
            }           
        }
    }

    function dikirim($id_transaksi){
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
                    'status'    =>  'Terkirim');
                    $id_gudang=$m->id_gudang;
                    $id_sepatu=$m->id_sepatu;
                    $jml=$m->jml;
            }
            $params = array('id_sepatu' =>  $id_sepatu, 'id_gudang' =>  $id_gudang);
            $data['stok_gudang'] = json_decode($this->curl->simple_get($this->API.'/stok_gudang', $params));
            foreach ($data['stok_gudang'] as $m) {
                $datakirim = array(
                    'id_stok_gudang'       =>  $m->id_stok_gudang,
                    'id_sepatu'       =>  $m->id_sepatu,
                    'id_gudang'=>  $m->id_gudang,
                    'ukuran'       =>  $m->ukuran,
                    'stok'=>  $m->stok - $jml);
            }                  
            $update =  $this->curl->simple_put($this->API.'/transaksi', $data, array(CURLOPT_BUFFERSIZE => 10));                              
            $kirim =  $this->curl->simple_put($this->API.'/stok_gudang', $datakirim, array(CURLOPT_BUFFERSIZE => 10));
            if($update AND $kirim)
            {
                $this->session->set_flashdata('hasil','Update Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Update Data Gagal');
            }
            redirect('admin/transaksi');
        }
    }
}