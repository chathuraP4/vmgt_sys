<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_vehi_brand extends CI_Model
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

    public function load_vehi_brands()
    {

        $sql = "SELECT `id`,`brand`,`type`FROM `vehicle_brand`";
        $query = $this->db->query($sql)->result();

        return $query;
    }

    public function save()
    {


        $data = array(
            'type' => $this->input->post('type_id'),
            'id' => $this->input->post('brand_id'),
            'brand' => $this->input->post('brand_name'),
        );


        $this->db->where('brand =', $this->input->post('brand_name'));
        $brand_name = $this->db->get('vehicle_brand');

        $this->db->where('id =', $this->input->post('brand_id'));
        $brand_id = $this->db->get('vehicle_brand');

        if ($brand_name->num_rows() > 0) {
            $d = "already_exist";
            return $d;
        } else if ($brand_id->num_rows() > 0 && $this->input->post('hid') == '0') {
            $d = "already_exist";
            return $d;
        } else {
            if ($this->input->post('hid') == '0') {
                $success = $this->db->insert('vehicle_brand', $data);
            } else {
                $this->db->where('id', $this->input->post('brand_id'));
                $success = $this->db->update('vehicle_brand', $data);
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

        $sql = "SELECT`auto_no`,`id`,`brand`,`type` FROM `vehicle_brand` WHERE id='" . $_POST['id'] . "'";
        $query = $this->db->query($sql)->result();

        return $query;
    }

    public function delete()
    {

        $this->db->where('id', $_POST['id']);
        $success = $this->db->delete('vehicle_brand');

        if ($success) {
            return "ok";
        } else {
            $d = "delete_fail";
            return $d;
        }
    }


    public function max_no()
    {
        $sql = "SELECT ifnull(MAX(id),0)+1 AS  max_no FROM `vehicle_brand`";
        $query = $this->db->query($sql)->first_row()->max_no;

        return $query;
    }
}
