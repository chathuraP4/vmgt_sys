<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_vehi_lease extends CI_Model
{

        function __Construct()
	{
	 parent::__Construct ();
	 $this->load->database();
	 $this->max_no= $this->max_no();
   }

    public function select_type()
    {

        $sql = "SELECT * FROM `vehicle_type`";
        $query = $this->db->query($sql)->result();
        $option = "<select class='form-control'  id='type_id' name='type_id'>";
        $option .= "<option class='dropdown-item option1' value='0' style='color:white;' >SELECT TYPE</option>";
        foreach ($query as $row) {
            $option .= "<option class='dropdown-item' value='" . $row->id . "'>" . $row->type . "</option>";
        }
        $option .= "<select>";
        return ($option);
    }

    public function select_brand()
    {

        $sql = "SELECT * FROM `vehicle_brand` WHERE type='".$_POST['id']."'";
        $query = $this->db->query($sql)->result();
        $option = "<select class='form-control'  id='brand_id' name='brand_id'>";
        $option .= "<option class='dropdown-item option1' value='0' style='color:white;' >SELECT BRAND</option>";
        foreach ($query as $row) {
            $option .= "<option class='dropdown-item' value='" . $row->id . "'>" . $row->brand . "</option>";
        }
        $option .= "<select>";
        return ($option);
    }
    public function select_model()
    {

        $sql = "SELECT * FROM `vehicle_model` WHERE brand='".$_POST['id']."'";
        $query = $this->db->query($sql)->result();
        $option = "<select class='form-control'  id='model_id' name='model_id'>";
        $option .= "<option class='dropdown-item option1' value='0' style='color:white;' >SELECT MODEL</option>";
        foreach ($query as $row) {
            $option .= "<option class='dropdown-item' value='" . $row->id . "'>" . $row->model . "</option>";
        }
        $option .= "<select>";
        return ($option);
    }
    public function load_vehi_leases()
    {

        $sql = "SELECT r.`id`, r.`rate`, IF(r.`reg_status`='1','Register','Unregister') AS reg_status, IF(r.`conditions`='1','Brand New','Recondition')AS conditions, r.`v_type`, r.`v_brand`, r.`v_model`,t.`type`,b.`brand`,m.`model`
        FROM `lease_rate` r
        JOIN `vehicle_type` t ON t.`id`=r.v_type
        JOIN `vehicle_brand` b ON b.`id`=r.v_brand
        JOIN `vehicle_model` m ON m.`id`=r.v_model";
        $query = $this->db->query($sql)->result();

        return $query;
    }
    public function save()
    {
        $data = array(
            'v_type' => $this->input->post('type_id'),
            'v_brand' => $this->input->post('brand_id'),
            'v_model' => $this->input->post('model_id'),
            'reg_status' => $this->input->post('register'),
            'conditions' => $this->input->post('condition'),
            'id' => $this->max_no,
            'rate' => $this->input->post('lease_rate'),
        );

        $this->db->where('v_type =', $this->input->post('type_id'));
        $this->db->where('v_brand =', $this->input->post('brand_id'));
        $this->db->where('v_model =', $this->input->post('model_id'));
        $this->db->where('reg_status =', $this->input->post('register'));
        $this->db->where('conditions =', $this->input->post('condition'));
        $lease_un = $this->db->get('lease_rate');

        if ($lease_un->num_rows() > 0) {
            $d = "already_exist";
            return $d;
        } else {
            if ($this->input->post('hid') == '0') {
                $success = $this->db->insert('lease_rate', $data);
            } else {
                $this->db->where('id', $this->input->post('lease_id'));
                $success = $this->db->update('lease_rate', $data);
            }
            if ($success) {
                return "ok";
            } else {
                $d = "insert_fail";
                return $d;
            }
        }
    }


    public function edit()
    {

        $sql = "SELECT `id`, `rate`, `reg_status`, `conditions`, `v_type`, `v_brand`, `v_model` FROM `lease_rate` WHERE id='" . $_POST['id'] . "'";
        $query = $this->db->query($sql)->result();

        return $query;
    }

    public function delete()
    {

        $this->db->where('id', $_POST['id']);
        $success = $this->db->delete('lease_rate');

        if ($success) {
            return "ok";
        } else {
            $d = "delete_fail";
            return $d;
        }
    }


    public function max_no()
    {
        $sql = "SELECT ifnull(MAX(id),0)+1 AS  max_no FROM `lease_rate`";
        $query = $this->db->query($sql)->first_row()->max_no;

        return $query;
    }
}
