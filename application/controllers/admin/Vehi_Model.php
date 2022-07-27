<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vehi_Model extends CI_Controller
{

    function __Construct()
	{
	 parent::__Construct ();
	 $this->load->database();
	 $this->load->model('Model_vehi_model');
   }

    public function index()
    {
        $this->load->model('Model_vehi_model');
        $data['models']= $this->Model_vehi_model->load_vehi_models();
		$data['max_no']= $this->Model_vehi_model->max_no();
        $data['types']=$this->Model_vehi_model->select_type();
       // $data['brands']=$this->Model_vehi_model->select_brand();
        
        $this->load->view('admin/view_model',$data);

    }
   

    public function create()
	{   

		if($this->input->post('submit')!==null){
		$vl=$this->Model_vehi_model->save();
		
		if($vl=='ok'){
			$data = array('success' => true, 'msg'=> '<script>swal({
				title: "Success! ",
				text: "Your work has been saved!",
				icon: "success",
			   
				dangerMode: false,
			  }).then((willDelete) => {
				if (willDelete) {
				  window.location = "'.base_url().'admin/vehi_model'.'";
				} 
			  }); </script>');
		}else if($vl=='already_exist'){
			$data = array('success' => false, 'typ'=>true, 'msg'=> "<script>swal({
				title: 'Oops! already exists',
				
				icon: 'error',
				
				dangerMode: true,
			});</script>");
		}else{
			$data = array('success' => false, 'typ'=>true, 'msg'=> "<script>swal({
				title: 'Oops! Your work not success!',
				
				icon: 'error',
				
				dangerMode: true,
			});</script>");
		}

		echo json_encode($data);
		
		}else{
			redirect(base_url().'admin/vehi_model');
		}
	}


    public function edit_model()
	{   
		$vl=$this->Model_vehi_model->edit();
        $data['success']= $vl;
        
		echo json_encode($data);
				
	}


    public function select_brand()
	{   
		$vl=$this->Model_vehi_model->select_brand();
        $data['success']= $vl;
        
		echo json_encode($data);
				
	}

    public function delete_model()
	{   
		$vl=$this->Model_vehi_model->delete();
		
		if($vl=='ok'){
			$data = array('success' => true, 'msg'=> '<script>swal({
				title: "Success! ",
				text: "Your work has been Success!",
				icon: "success",
			   
				dangerMode: false,
			  }).then((willDelete) => {
				if (willDelete) {
                    window.location = "'.base_url().'admin/vehi_model'.'";
				} 
			  }); </script>');
		}else{
			$data = array('success' => false, 'typ'=>true, 'msg'=> "<script>swal({
				title: 'Oops! Your Work has Not Done',
				
				icon: 'error',
				
				dangerMode: true,
			});</script>");
		}

		echo json_encode($data);
		
		
	}



}
