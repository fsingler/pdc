<?php
/* Pages de contenu */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Images extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }   

    function all_images() {
        $this->db->order_by('id_img','desc');
        $query = $this->db->get('images');
        return $query->result();        
    }
    

   
}
?>
