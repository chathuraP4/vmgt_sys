<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class model_vehicle extends CI_Model {

	function __Construct()
	{
	 parent::__Construct ();
	 $this->load->database();
	 $this->max_no= $this->max_no();
   }

	
	public function getAll()
	{
		// $result = $this->db->get('vehicles');
		$this->db->select('vehicles.*,vehicle_type.type,vehicle_brand.brand,vehicle_model.model');
        $this->db->from('vehicles');
		$this->db->join('vehicle_type','vehicle_type.id=vehicles.type_id');
		$this->db->join('vehicle_brand','vehicle_brand.id=vehicles.brand_id');
		$this->db->join('vehicle_model','vehicle_model.id=vehicles.model_id');

        $result = $this->db->get();
		return $result->result_array();
	}

	public function getAllByManufacturer()
	{
		// $result = $this->db->get('vehicles');
		$this->db->select('*,vehicle_brand.brand as manufacturer_name, COUNT(brand_id) as total');
        $this->db->from('vehicles');
        $this->db->join('vehicle_brand', 'vehicle_brand.id = vehicles.brand_id','inner');
        // $this->db->join('models', 'models.id = vehicles.model_id', 'inner');
        $this->db->group_by('brand_id');
        $this->db->order_by('total', 'desc'); 
        $result = $this->db->get();
		return $result->result_array();
	}

	public function getAllByManufacturerSold()
	{
		// $result = $this->db->get('vehicles');
		$this->db->select('*,vehicle_brand.brand as manufacturer_name, COUNT(brand_id) as total');
        $this->db->from('vehicles');
        $this->db->where('status', 'sold');
        $this->db->join('vehicle_brand', 'vehicle_brand.id = vehicles.brand_id','inner');
        // $this->db->join('models', 'models.id = vehicles.model_id', 'inner');
        $this->db->group_by('brand_id');
        $this->db->order_by('total', 'desc'); 
        $result = $this->db->get();
		return $result->result_array();
	}

    public function customerList()
	{
		$this->db->select('customer.*,vehicles.*,vehicle_brand.brand as manufacturer_name,vehicle_model.model as model_name');
                $this->db->from('customer');
                $this->db->join('vehicles', 'customer.vehicle_id = vehicles.vehicle_id','inner');
                $this->db->join('vehicle_brand', 'vehicle_brand.id = vehicles.brand_id','inner');
                $this->db->join('vehicle_model', 'vehicle_model.id = vehicles.model_id', 'inner');

                $result = $this->db->get();
                //echo $this->db->last_query();
		return $result->result_array();
	}
        
	public function get($v_id)
	{
		$this->db->where('vehicle_id', $v_id);
		$result = $this->db->get('vehicles');
		return $result->row_array();
	}
    

    public function sell($v_id,$cf_name,$cl_name,$c_email,$s_price,$c_mobile,$w_start,$w_end,$payment_type,$c_pass)
	{
				
		$data = array(
               'status' => 'sold',
               'selling_price' => $s_price,
               'sold_date' => $w_start
            );
		$this->db->where('vehicle_id', $v_id);
		$this->db->update('vehicles', $data); 
		
		$datac = array(
               'vehicle_id' => $v_id,
               'cf_name' => $cf_name,
               'cl_name' => $cl_name,
               'c_email' => $c_email,
               'c_mobile' => $c_mobile,
               'w_start' => $w_start,
               'w_end' => $w_end,
               'payment_type' => $payment_type,
               'c_pass' => $c_pass
            );
		$this->db->insert('customer', $datac);
	}

	public function delete($id)
	{
		$this->db->where('vehicle_id', $id);
		$this->db->delete('vehicles');
	}
        
    public function deletecustomer($c_id, $v_id)
	{
		$this->db->where('c_id', $c_id);
		$this->db->delete('customer'); 
                
        $data = array(
       'status' => 'available',
       'selling_price' => NULL,
       'sold_date' => NULL
        );
		$this->db->where('vehicle_id', $v_id);
		$this->db->update('vehicles', $data);
	}

	public function get_vehicle_by_month(){
        $this->db->select('*, MONTH(add_date) as month,  YEAR(add_date) as year, SUM(buying_price) as b_price, SUM(selling_price) as s_price');
        $this->db->from('vehicles');
        $this->db->group_by('month');
        $query = $this->db->get();
        return $query->result();
    }

// ---------------------------------------------------------------------------------
	public function getvtypes(){

        $sql="SELECT * FROM `vehicle_type`";
        $query = $this->db->query($sql)->result();
        
        $option="<option class='dropdown-item' value='' >SELECT TYPE</option>";
        foreach($query as $row){
            $option.="<option class='dropdown-item' value='".$row->id."'>".$row->type."</option>"; 
        }
        return ($option);
		
	}

	public function load_brands(){

        $sql="SELECT * FROM `vehicle_brand` WHERE type='".$_POST['type']."'";
        $query = $this->db->query($sql)->result();
        
        $option="<option class='dropdown-item option1' value='0'>SELECT BRAND</option>";
        foreach($query as $row){
            $option.="<option class='dropdown-item' value='".$row->id."'>".$row->brand."</option>"; 
        }
        return ($option);
		
	}

	public function load_models(){

        $sql="SELECT * FROM `vehicle_model` WHERE brand='".$_POST['brand']."'";
        $query = $this->db->query($sql)->result();
        
        $option="<option class='dropdown-item option1' value='0' >SELECT MODEL</option>";
        foreach($query as $row){
            $option.="<option class='dropdown-item' value='".$row->id."'>".$row->model."</option>"; 
        }
        return ($option);
		
	}

	public function create(){


		$this->load->helper('url');

		$config['upload_path'] = 'uploads/vehicles';
		$config['allowed_types'] = 'jpg|png|gif';
		$config['max_size'] = 1024 * 8;
		$config['encrypt_name'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);



		if (!$this->upload->do_upload('file'))
		{
			$file_error = "true";
			$msg = $this->upload->display_errors();
			$file_name = "";
		}
		else
		{
			$file_error = "false";
			$file_data = $this->upload->data();
			$file_name = $file_data['file_name'];
		}

		



		$data = array(
			'vehicle_id'=> $this->max_no(),
			'type_id'=> $this->input->post('vtype'),
            'brand_id'=> $this->input->post('vbrand'),
            'model_id'=> $this->input->post('vmodel'),
            'category'=> $this->input->post('category'),
            'fuel_type'=> $this->input->post('fuel_type'), 
			'buying_price'=> $this->input->post('b_price'),
			'selling_price'=> $this->input->post('b_price'),
			'mileage'=> $this->input->post('sell_price'),
			'color'=> $this->input->post('colors'),
			'add_date'=> date("Y-m-d"),
			'sold_date'=> null,
            'status'=> $this->input->post('status'),
			'registration_year'=> $this->input->post('registration_year'),
            'insurance_id'=> $this->input->post('insurance_id'),
            'gear'=> $this->input->post('gear'),
			'doors'=> $this->input->post('doors'),           
            'seats'=> $this->input->post('seats'),
			'image'=> base_url().'uploads/vehicles/'.$file_name,
            'tank'=> $this->input->post('tank'),
            'engine_no'=> $this->input->post('e_no'),
			'chesis_no'=> $this->input->post('c_no'),
			);

		
			$insert =$this->db->insert('vehicles', $data);
			if($file_error == "true"){
				return "img_insert_fail";
			}else if($insert){
				return "ok";
			}else{
				$d="insert_fail";
				return $d;
			}
		
	}



	public function max_no()
    {
        $sql = "SELECT IFNULL(MAX(vehicle_id),0)+1 AS  max_no FROM `vehicles`";
        $query = $this->db->query($sql)->first_row()->max_no;

        return $query;
    }

}