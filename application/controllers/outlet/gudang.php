<?php
Class Gudang extends CI_Controller{
    
    var $API ="";
    
    function __construct() {
        parent::__construct();
        $this->API="http://localhost/zapato_server/index.php";
        if($this->session->userdata('level')!='outlet'){
            redirect('login');
        }
    }
    
    // menampilkan data gudang
    function index(){
        $data['gudang'] = json_decode($this->curl->simple_get($this->API.'/gudang'));
        $data['title']='Daftar gudang';
        $data['page']='outlet/gudang';
        $this->load->view('outlet/dashboard',$data);
        $this->session->unset_userdata('id_gudang');
    }

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
        $data['page']='outlet/stok_gudang';
        $this->load->view('outlet/dashboard',$data);     
    }

}