<?php
/* Pages de contenu */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contenu extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }   

    function affiche_page($id_page) {
        
        $this->db->where('parent', $id_page);
        $this->db->from('pages');
        $nbsp = $this->db->count_all_results();
        
        if ($nbsp==0) $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('pages')." WHERE id_page=$id_page");
        else $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('pages')." WHERE id_page=$id_page or parent=$id_page order by ordre");
//        $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('pages')." WHERE id_page=$id_page");
        
        return $query->result();
        
    }
    
    function encarts($id_page) {
        
        $conditions = array('id_page' => $id_page);
        $this->db->order_by('ordre');
        $query = $this->db->get_where('pages_encarts', $conditions);
        
        return $query->result();
    }

    function sous_pages($id_page) {
        $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('pages')." WHERE id_page=$id_page or parent=$id_page");
        return $query->result();
    }
    
    function dernieres_pages() {
        $this->db->order_by('id_page', 'desc');
        $query = $this->db->get('pages',10);
        return $query->result();
    }
    
    function liste_pages() {
        $query = $this->db->get('pages');
        return $query->result();
    }

    function liste_pages_date($ordre,$sens) {
        $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('pages')." p, ".$this->db->dbprefix('categories')." c WHERE p.id_cat=c.id_cat order by $ordre $sens");
        return $query->result();
    }

    function get_page($id_page) {
        $query = $this->db->get_where('pages', array('id_page' => $id_page));
        return $query->result();
    }

    function sous_pages_list($id_page) {
        $this->db->order_by('ordre', 'asc');
        $query = $this->db->get_where('pages', array('parent' => $id_page));
        return $query->result();
    }
    
    function sup_page($id_page) {
        $query = $this->db->delete('pages', array('id_page' => $id_page));
        //return $query->result();
    }

    function sup_encart($id_encart) {
        $query = $this->db->delete('pages_encarts', array('id_encart' => $id_encart));
        //return $query->result();
    }

   
}
?>
