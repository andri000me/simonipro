<?php
class Koordinator_model extends CI_Model {

    // query view all data plotting
    public function get_all_plotting_pembimbing() {
        return $this->db->get('plotting')->result_array();
    }

}