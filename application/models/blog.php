<?php
/* Pages de contenu */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Blog extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }   

    function last_posts(){
        $this->db->where('publie',1);
        $this->db->where('date >','CURDATE()',FALSE);
        $this->db->order_by('ordre');
        $query = $this->db->get('blog',7,1);
        return $query->result();
    }

    function last_post(){
        $this->db->where('publie',1);
        $this->db->where('date >','CURDATE()',FALSE);
        $this->db->order_by('ordre');
        $query = $this->db->get('blog',1);
        return $query->result();
    }
    
    function affiche_post($id_post) {
        $this->db->where('id_post', $id_post);
//        $this->db->from('organismes');
        $query = $this->db->get('blog');
        return $query->result();
    }
    
    function all_posts() {
        $this->db->where('publie',1);
        $this->db->order_by('ordre');
        $query = $this->db->get('blog');
        return $query->result();
    }

    function all_unpublish_posts() {
        $this->db->order_by('ordre');
        $query = $this->db->get('blog');
        return $query->result();
    }

    function add_post() {
        $upload_data = $this->upload->data();
        if ($upload_data['file_name'] != '') $this->db->set('image', $upload_data['file_name']);
        //$this->db->set('image', $this->input->post('image'));
        else $this->db->set('image', $this->input->post('defimage'));
        
        $this->db->set('titre', $this->input->post('titre'));
        $this->db->set('texte', $this->input->post('texte'));
        $this->db->set('date', $this->input->post('date'));
//        $this->db->set('image', $this->input->post('image'));
        $this->db->set('publie', 0);
        $this->db->insert('blog');
        return $this->db->insert_id();
    }

    function updt_post() {
        $upload_data = $this->upload->data();
        if ($upload_data['file_name'] != '') $this->db->set('image', $upload_data['file_name']);
        //$this->db->set('image', $this->input->post('image'));
        elseif ($this->input->post('defimage')!='') $this->db->set('image', $this->input->post('defimage'));
        
        $this->db->set('titre', $this->input->post('titre'));
        $this->db->set('texte', $this->input->post('texte'));
        $this->db->set('date', $this->input->post('date'));
        //$this->db->set('image', $this->input->post('image'));
        $this->db->where('id_post', $this->input->post('id_post'));
        $this->db->update('blog'); 
    }
    
    function publish_post() {
        $this->db->set('publie', 1);
//        $this->db->set('date', date("Y-m-d"));
        $this->db->where('id_post', $this->input->post('id_post'));
        $this->db->update('blog'); 
    }

    function sup_post($id_post) {
        $this->db->set('publie', 0);
//        $this->db->set('date', date("Y-m-d"));
        $this->db->where('id_post', $id_post);
        $this->db->update('blog'); 
    }
    
}
?>
