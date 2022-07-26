<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vehicles extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
        if ( ! $this->session->userdata('isLogin')) { 
            redirect('login');
        }
		
		$this->load->model('model_vehicle');
        $this->load->model('model_manufacturer');
        $this->load->model('model_car_model');
	}

	public function index()
	{
        $data['udata']=$this->session->userdata;
        $data['vehicles'] = $this->model_vehicle->getAll();
        $data['manufacturers'] = $this->model_manufacturer->getAllManufacturers();
        $data['models'] = $this->model_car_model->getAllModels();

        $data['vtypes'] = $this->model_vehicle->getvtypes();


        
        //$this->load->view('view_vehicle', $data); 
        $this->parser->parse('admin/view_vehicle', $data);   
    }


	public function sell()
	{
        if ($this->input->server('REQUEST_METHOD') == 'POST'){	
            $cid = $this->input->post('vehicle_id');
            $cdata['cid'] = $cid;
            if(!$this->input->post('buttonSubmits'))
    		{
    			$data['message'] = '';
                //$data['vRow'] = $this->model_vehicle->get($cid);
                $this->load->view('admin/view_sell', $cdata);
    		}
            else{
                $this->form_validation->set_rules('cf_name', 'First Name', 'required');
                $this->form_validation->set_rules('cl_name', 'Last Name', 'required');
                $this->form_validation->set_rules('c_email', 'Email', 'required|valid_email');
                $this->form_validation->set_rules('c_mobile', 'Mobile', 'required|trim');
                $this->form_validation->set_rules('s_price', 'Selling Price', 'required|numeric|greater_than[1]');
                $this->form_validation->set_rules('w_end', 'Warranty End date', 'required');
				$this->form_validation->set_rules('v_id', 'Vehicle Id', 'required');
                
                if ($this->form_validation->run() == FALSE) {
                    $data['vRow'] = $this->model_vehicle->get($cid);
                    $this->load->view('admin/view_sell', $data);
                }
                else {
                    $v_id = $this->input->post('v_id');
                    $cf_name = $this->input->post('cf_name');
                    $cl_name = $this->input->post('cl_name');
                    $c_email = $this->input->post('c_email');
                    $s_price = $this->input->post('s_price');
                    $c_mobile = $this->input->post('c_mobile');
                    $w_start = $this->input->post('w_start');
                    $w_end = $this->input->post('w_end');
                    $payment_type = $this->input->post('payment_type');
                    $c_pass = "1234";

                    $this->model_vehicle->sell($v_id,$cf_name,$cl_name,$c_email,$s_price,$c_mobile,$w_start,$w_end,$payment_type,$c_pass);
                    redirect(base_url('admin/vehicles'));
                }
            }
        }
        else {
            redirect(base_url('admin/vehicles'));
        }
	}



	public function DeleteVehicle()
	{
        if ($this->input->server('REQUEST_METHOD') == 'POST'){	
             
            $id = $this->input->post('vehicle_id');
            $this->model_vehicle->delete($id);
			//$this->session->set_flashdata('message','Vehicle Successfully Deleted.');
            redirect(base_url('admin/vehicles'));
        }
        else {
            redirect(base_url('admin/vehicles'));
	    }
    }
        
    public function DeleteCustomer()
	{	
        if ($this->input->server('REQUEST_METHOD') == 'POST'){	
            $v_id= $this->input->post('v_id');
            $c_id= $this->input->post('c_id');
               
            $this->model_vehicle->deletecustomer($c_id,$v_id);
			//$this->session->set_flashdata('message','Customer Successfully Created.');
           // $url=(base_url('admin/vehicles/soldlist'));
           redirect(base_url('admin/vehicles/soldlist'));
        }
        else{
            redirect(base_url('admin/vehicles/soldlist'));
        }
	}

    public function soldList()
    {   
        $data['cus'] = $this->model_vehicle->customerList();
        $this->load->view('admin/view_sold', $data);     
    }

// ------------------------------------------------------


public function load_brands(){
    $res['data']=$this->model_vehicle->load_brands();
    echo json_encode($res);
}


public function load_models(){
    $res['data']=$this->model_vehicle->load_models();
    echo json_encode($res);
}


public function create()
	{   

		if($this->input->post('submit')!==null){
		$vl=$this->model_vehicle->create();
		
		if($vl=='ok'){
			$data = array('success' => true, 'msg'=> '<script>swal({
				title: "Success! ",
				text: "Your work has been saved!",
				icon: "success",
			   
				dangerMode: false,
			  }).then((willDelete) => {
				if (willDelete) {
				  window.location = "'.base_url().'admin/vehicles";
				} 
			  }); </script>');
		}else if($vl=='img_insert_fail'){
			$data = array('success' => false, 'typ'=>true, 'msg'=> "<script>swal({
				title: 'Oops! Image Insert Fail',
				
				icon: 'error',
				
				dangerMode: true,
			});</script>");
		}else{
			$data = array('success' => false, 'typ'=>true, 'msg'=> "<script>swal({
				title: 'Oops! Vehicle Not Created',
				
				icon: 'error',
				
				dangerMode: true,
			});</script>");
		}

		echo json_encode($data);
		
		}else{
			redirect(base_url().'admin/vehicles');
		}
	}


}

