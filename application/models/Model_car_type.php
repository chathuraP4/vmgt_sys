<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Model_car_type extends CI_Model
{



    public function load_car_types()
    {

        $sql = "SELECT`auto_no`,`id`,`type` FROM `vehicle_type`";
        $query = $this->db->query($sql)->result();

        return $query;
    }

    public function save()
    {


        $data = array(
            'id' => $this->input->post('type_id'),
            'type' => $this->input->post('type_name'),
        );



        $this->db->where('type =', $this->input->post('type_name'));
        $type_name = $this->db->get('vehicle_type');

        $this->db->where('id =', $this->input->post('type_id'));
        $type_id = $this->db->get('vehicle_type');

        if ($type_name->num_rows() > 0) {
            $d = "already_exist";
            return $d;
        } else if ($type_id->num_rows() > 0 && $this->input->post('hid') == '0') {
            $d = "already_exist";
            return $d;
        } else {
            if ($this->input->post('hid') == '0') {
                $success = $this->db->insert('vehicle_type', $data);
            } else {
                $this->db->where('id', $this->input->post('type_id'));
                $success = $this->db->update('vehicle_type', $data);
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

        $sql = "SELECT`auto_no`,`id`,`type` FROM `vehicle_type` WHERE id='" . $_POST['id'] . "'";
        $query = $this->db->query($sql)->result();

        return $query;
    }

    public function delete()
    {

        $this->db->where('id', $_POST['id']);
        $success = $this->db->delete('vehicle_type');

        if ($success) {
            return "ok";
        } else {
            $d = "delete_fail";
            return $d;
        }
    }


    public function max_no()
    {
        $sql = "SELECT ifnull(MAX(id),0)+1 AS  max_no FROM `vehicle_type`";
        $query = $this->db->query($sql)->first_row()->max_no;

        return $query;
    }
}
