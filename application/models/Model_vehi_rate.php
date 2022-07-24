<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_vehi_rate extends CI_Model
{

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

        $sql = "SELECT * FROM `vehicle_brand` WHERE type='" . $_POST['id'] . "'";
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

        $sql = "SELECT * FROM `vehicle_model` WHERE brand='" . $_POST['id'] . "'";
        $query = $this->db->query($sql)->result();
        $option = "<select class='form-control'  id='model_id' name='model_id'>";
        $option .= "<option class='dropdown-item option1' value='0' style='color:white;' >SELECT MODEL</option>";
        foreach ($query as $row) {
            $option .= "<option class='dropdown-item' value='" . $row->id . "'>" . $row->model . "</option>";
        }
        $option .= "<select>";
        return ($option);
    }

    public function load_vehi_rates()
    {

        $sql = "SELECT 
        r.`id`,
        r.`rate`,
        r.`reg_status`,
        r.`conditions`,
        r.`v_type`,
        r.`v_brand`,
        r.`v_model`,
        t.`type`,
        m.`model`,
        b.`brand`
      FROM
        `lease_rate` r
        JOIN `vehicle_type` t ON t.`id`=r.`v_type`
        JOIN `vehicle_model` m ON m.`id`=r.`v_model`
        JOIN `vehicle_brand` b ON b.`id`=r.`v_brand`";
        $query = $this->db->query($sql)->result();

        return $query;
    }
    public function save()
    {
        $data = array(
            'v_type' => $this->input->post('type_id'),
            'v_model' => $this->input->post('model_id'),
            'v_brand' => $this->input->post('brand_id'),
            'reg_status' => $this->input->post('regst_id'),
            'conditions' => $this->input->post('condition_id'),
            'id' => $this->input->post('rate_id'),
            'rate' => $this->input->post('rate'),
        );


        
        $this->db->where('id =', $this->input->post('rate_id'));
        $lease_id = $this->db->get('lease_rate');

       if ($lease_id->num_rows() > 0 && $this->input->post('hid') == '0') {
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

        $sql = "SELECT`auto_id`, `id`, `rate`, `reg_status`, `conditions`, `v_type`, `v_brand`, `v_model` FROM `lease_rate` WHERE id='" . $_POST['id'] . "'";
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
        $sql = "SELECT MAX(id)+1 AS  max_no FROM `lease_rate`";
        $query = $this->db->query($sql)->first_row()->max_no;

        return $query;
    }
}
