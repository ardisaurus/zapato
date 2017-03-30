<?php
Class Stok_outlet extends CI_Controller{
    
    var $API ="";
    
    function __construct() {
        parent::__construct();
        $this->API="http://localhost/zapato_server/index.php";        
        if($this->session->userdata('level')!='outlet'){
            redirect('login');
        }
    }
    
    // menampilkan data sepatu
    function index(){
            $params = array('user_id'=>  $this->session->userdata('user_id'));        
            $data['stok_outlet'] = json_decode($this->curl->simple_get($this->API.'/stok_outlet',$params));
            $data['title']='Stok Outlet';
            $data['page']='outlet/stok_outlet_list';
            $this->load->view('outlet/dashboard',$data);
    }
    
    // edit data sepatu
    function edit($id_stok_outlet){
            if(isset($_POST['submit'])){               
                $this->form_validation->set_rules('stok', 'Stok', 'trim|required|max_length[5]|numeric');
                if ($this->form_validation->run() == FALSE)
                {
                    $this->session->set_flashdata('peringatan', validation_errors());
                    redirect('outlet/stok_outlet/');
                    $data['stok_outlet'] = json_decode($this->curl->simple_get($this->API.'/stok_outlet'));
                }else{
                    
                    $params = array('$id_stok_outlet' =>  $$id_stok_outlet);
                    $data['stok_outlet'] = json_decode($this->curl->simple_get($this->API.'/stok_outlet', $params));
                    foreach ($data['stok_outlet'] as $m) {
                        $jml=$m->stok;
                    }
                    $stok=$this->input->post('stok');
                    if ($stok>$jml) {
                        $this->session->set_flashdata('peringatan', 'Nilai Stok baru harus lebih sedikit dari stok yang lama');
                        redirect('outlet/stok_outlet/');
                        $data['stok_outlet'] = json_decode($this->curl->simple_get($this->API.'/stok_outlet'));
                    }else{
                        foreach ($data['stok_outlet'] as $m) {
                            $data = array(
                                'id_stok_outlet'       =>  $m->id_stok_outlet,
                                'user_id'      =>  $m->user_id,
                                'id_sepatu'       =>  $m->id_sepatu,
                                'ukuran'       =>  $m->ukuran,
                                'stok'=>  $this->input->post('stok'));
                        }  
                        $update =  $this->curl->simple_put($this->API.'/stok_outlet', $data, array(CURLOPT_BUFFERSIZE => 10)); 
                        if($update)
                        {
                            $this->session->set_flashdata('hasil','Update Data Berhasil');
                        }else
                        {
                           $this->session->set_flashdata('hasil','Update Data Gagal');
                        }
                        redirect('outlet/stok_outlet');    
                    }                    
                }
            }else{
                    redirect('outlet/stok_outlet');
                }
    }
    
    // delete data sepatu
    function delete($id_stok_outlet){
        if(empty($id_stok_outlet)){
            redirect('outlet/stok_outlet');
        }else{
            $delete =  $this->curl->simple_delete($this->API.'/stok_outlet', array('id_stok_outlet'=>$id_stok_outlet), array(CURLOPT_BUFFERSIZE => 10)); 
            if($delete)
            {
                $this->session->set_flashdata('hasil','Delete Data Berhasil');
            }else
            {
               $this->session->set_flashdata('hasil','Delete Data Gagal');
            }
            redirect('outlet/stok_outlet');
        }
    }
}