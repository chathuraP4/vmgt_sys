<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vehi_Type extends CI_Controller
{

    function __Construct()
	{
	 parent::__Construct ();
	 $this->load->database();
	 $this->load->model('Model_car_type');
   }

    public function index()
    {
        $this->load->model('Model_car_type');
        $data['types']= $this->Model_car_type->load_car_types();
		$data['max_no']= $this->Model_car_type->max_no();
        
        $this->load->view('admin/view_type',$data);

    }


    public function create()
	{   

		if($this->input->post('submit')!==null){
		$vl=$this->Model_car_type->save();
		
		if($vl=='ok'){
			$data = array('success' => true, 'msg'=> '<script>swal({
				title: "Success! ",
				text: "Your work has been saved!",
				icon: "success",
			   
				dangerMode: false,
			  }).then((willDelete) => {
				if (willDelete) {
				  window.location = "'.base_url().'admin/vehi_type'.'";
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
			redirect(base_url().'admin/vehi_type');
		}
	}


    public function edit_type()
	{   
		$vl=$this->Model_car_type->edit();
        $data['success']= $vl;
        
		echo json_encode($data);
				
	}

    public function delete_type()
	{   
		$vl=$this->Model_car_type->delete();
		
		if($vl=='ok'){
			$data = array('success' => true, 'msg'=> '<script>swal({
				title: "Success! ",
				text: "Your work has been Success!",
				icon: "success",
			   
				dangerMode: false,
			  }).then((willDelete) => {
				if (willDelete) {
                    window.location = "'.base_url().'admin/vehi_type'.'";
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
