<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vehi_Brand extends CI_Controller
{

    function __Construct()
	{
	 parent::__Construct ();
	 $this->load->database();
	 $this->load->model('Model_vehi_brand');
   }

    public function index()
    {
        $this->load->model('Model_vehi_brand');
        $data['brands']= $this->Model_vehi_brand->load_vehi_brands();
		$data['max_no']= $this->Model_vehi_brand->max_no();
        $data['types']=$this->Model_vehi_brand->select_type();
        
        $this->load->view('admin/view_brand',$data);

    }
   

    public function create()
	{   

		if($this->input->post('submit')!==null){
		$vl=$this->Model_vehi_brand->save();
		
		if($vl=='ok'){
			$data = array('success' => true, 'msg'=> '<script>swal({
				title: "Success! ",
				text: "Your work has been saved!",
				icon: "success",
			   
				dangerMode: false,
			  }).then((willDelete) => {
				if (willDelete) {
				  window.location = "'.base_url().'admin/vehi_brand'.'";
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
			redirect(base_url().'admin/vehi_brand');
		}
	}


    public function edit_brand()
	{   
		$vl=$this->Model_vehi_brand->edit();
        $data['success']= $vl;
        
		echo json_encode($data);
				
	}

    public function delete_brand()
	{   
		$vl=$this->Model_vehi_brand->delete();
		
		if($vl=='ok'){
			$data = array('success' => true, 'msg'=> '<script>swal({
				title: "Success! ",
				text: "Your work has been Success!",
				icon: "success",
			   
				dangerMode: false,
			  }).then((willDelete) => {
				if (willDelete) {
                    window.location = "'.base_url().'admin/vehi_brand'.'";
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
