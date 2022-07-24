<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Vehi_Rate extends CI_Controller
{

    function __Construct()
	{
	 parent::__Construct ();
	 $this->load->database();
	 $this->load->model('Model_vehi_rate');
   }

    public function index()
    {
        $this->load->model('Model_vehi_rate');
        $data['rates']= $this->Model_vehi_rate->load_vehi_rates();
		$data['max_no']= $this->Model_vehi_rate->max_no();
        $data['types']=$this->Model_vehi_rate->select_type();
       // $data['brands']=$this->Model_vehi_model->select_brand();
        
        $this->load->view('admin/view_rate',$data);

    }
   

    public function create()
	{   

		if($this->input->post('submit')!==null){
		$vl=$this->Model_vehi_rate->save();
		
		if($vl=='ok'){
			$data = array('success' => true, 'msg'=> '<script>swal({
				title: "Success! ",
				text: "Your work has been saved!",
				icon: "success",
			   
				dangerMode: false,
			  }).then((willDelete) => {
				if (willDelete) {
				  window.location = "'.base_url().'admin/vehi_rate'.'";
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
			redirect(base_url().'admin/vehi_rate');
		}
	}


    public function edit_rate()
	{   
		$vl=$this->Model_vehi_rate->edit();
        $data['success']= $vl;
        
		echo json_encode($data);
				
	}


    public function select_brand()
	{   
		$vl=$this->Model_vehi_rate->select_brand();
        $data['success']= $vl;
        
		echo json_encode($data);
				
	}
	public function select_model()
	{   
		$vl=$this->Model_vehi_rate->select_model();
        $data['success']= $vl;
        
		echo json_encode($data);
				
	}
	public function select_register()
	{   
		$vl=$this->Model_vehi_rate->select_register();
        $data['success']= $vl;
        
		echo json_encode($data);
				
	}
	
    public function delete_rate()
	{   
		$vl=$this->Model_vehi_rate->delete();
		
		if($vl=='ok'){
			$data = array('success' => true, 'msg'=> '<script>swal({
				title: "Success! ",
				text: "Your work has been Success!",
				icon: "success",
			   
				dangerMode: false,
			  }).then((willDelete) => {
				if (willDelete) {
                    window.location = "'.base_url().'admin/view_rate'.'";
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
