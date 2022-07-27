<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_vehi_model extends CI_Model
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
    public function load_vehi_models()
    {

        $sql = "SELECT m.`id`,m.`model`,m.`brand`,b.`brand` AS brand_name,t.`type`
        FROM `vehicle_model` m
        JOIN `vehicle_brand` b ON b.`id`=m.`brand`
        JOIN `vehicle_type` t ON t.`id`=b.`type`";
        $query = $this->db->query($sql)->result();

        return $query;
    }
    public function save()
    {
        $data = array(
            // 'type' => $this->input->post('type_id'),
            'brand' => $this->input->post('brand_id'),
            'id' => $this->input->post('model_id'),
            'model' => $this->input->post('model_name'),
        );


        $this->db->where('model =', $this->input->post('model_name'));
        $model_name = $this->db->get('vehicle_model');

        $this->db->where('id =', $this->input->post('model_id'));
        $model_id = $this->db->get('vehicle_model');

        if ($model_name->num_rows() > 0) {
            $d = "already_exist";
            return $d;
        } else if ($model_id->num_rows() > 0 && $this->input->post('hid') == '0') {
            $d = "already_exist";
            return $d;
        } else {
            if ($this->input->post('hid') == '0') {
                $success = $this->db->insert('vehicle_model', $data);
            } else {
                $this->db->where('id', $this->input->post('model_id'));
                $success = $this->db->update('vehicle_model', $data);
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

        $sql = "SELECT`auto_no`,`id`,`model`,`brand` FROM `vehicle_model` WHERE id='" . $_POST['id'] . "'";
        $query = $this->db->query($sql)->result();

        return $query;
    }

    public function delete()
    {

        $this->db->where('id', $_POST['id']);
        $success = $this->db->delete('vehicle_model');

        if ($success) {
            return "ok";
        } else {
            $d = "delete_fail";
            return $d;
        }
    }


    public function max_no()
    {
        $sql = "SELECT ifnull(MAX(id),0)+1 AS  max_no FROM `vehicle_model`";
        $query = $this->db->query($sql)->first_row()->max_no;

        return $query;
    }
}
