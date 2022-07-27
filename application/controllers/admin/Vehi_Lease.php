<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vehi_Lease extends CI_Controller
{

    function __Construct()
	{
	 parent::__Construct ();
	 $this->load->database();
	 $this->load->model('Model_vehi_lease');
   }

    public function index()
    {
        $this->load->model('Model_vehi_lease');
        $data['leases']= $this->Model_vehi_lease->load_vehi_leases();
		$data['max_no']= $this->Model_vehi_lease->max_no();
        $data['types']=$this->Model_vehi_lease->select_type();
       // $data['brands']=$this->Model_vehi_model->select_brand();
        
        $this->load->view('admin/view_lease',$data);

    }
   

    public function create()
	{   

		if($this->input->post('submit')!==null){
		$vl=$this->Model_vehi_lease->save();
		
		if($vl=='ok'){
			$data = array('success' => true, 'msg'=> '<script>swal({
				title: "Success! ",
				text: "Your work has been saved!",
				icon: "success",
			   
				dangerMode: false,
			  }).then((willDelete) => {
				if (willDelete) {
				  window.location = "'.base_url().'admin/vehi_lease'.'";
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
			redirect(base_url().'admin/vehi_lease');
		}
	}


    public function edit_lease()
	{   
		$vl=$this->Model_vehi_lease->edit();
        $data['success']= $vl;
        
		echo json_encode($data);
				
	}


    public function select_brand()
	{   
		$vl=$this->Model_vehi_lease->select_brand();
        $data['success']= $vl;
        
		echo json_encode($data);
				
	}
    public function select_model()
	{   
		$vl=$this->Model_vehi_lease->select_model();
        $data['success']= $vl;
        
		echo json_encode($data);
				
	}
    public function delete_lease()
	{   
		$vl=$this->Model_vehi_lease->delete();
		
		if($vl=='ok'){
			$data = array('success' => true, 'msg'=> '<script>swal({
				title: "Success! ",
				text: "Your work has been Success!",
				icon: "success",
			   
				dangerMode: false,
			  }).then((willDelete) => {
				if (willDelete) {
                    window.location = "'.base_url().'admin/vehi_lease'.'";
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
