<?php
/* Pages de contenu */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Organismes extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }   

    function liste_orga(){
        $this->db->order_by('ordre');
        $query = $this->db->get('organismes');
        return $query->result();
    }
    
    function affiche_orga($id_orga) {
        $this->db->where('id_orga', $id_orga);
//        $this->db->from('organismes');
        $query = $this->db->get('organismes');
        return $query->result();
    }
    
    function save_orga() {
        $this->db->set('nom', $this->input->post('nom'));
        $this->db->set('details', $this->input->post('details'));
        $this->db->set('adresse1', $this->input->post('adresse1'));
        $this->db->set('adresse2', $this->input->post('adresse2'));
        $this->db->set('code_postal', $this->input->post('code_postal'));
        $this->db->set('ville', $this->input->post('ville'));
        $this->db->set('tel', $this->input->post('tel'));
        $this->db->set('web', $this->input->post('web'));
        $this->db->set('description', $this->input->post('description'));

        $upload_data = $this->upload->data();
        if ($upload_data['file_name'] != '') $this->db->set('image', $upload_data['file_name']);
        
        $this->db->where('id_orga', $this->input->post('id_orga'));
        $this->db->update('organismes'); 
    }

   
}
?>
