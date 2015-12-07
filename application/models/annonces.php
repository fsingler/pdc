<?php
/* Petites annonces idverre */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Annonces extends CI_Model {

    var $titre='';
    var $annonce='';
    var $date='';
    var $nom='';
    var $prenom ='';
    var $adresse='';
    var $ville='';
    var $codepostal='';
    var $tel ='';
    var $portable = '';
    var $email = '';
    
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }   
    
    function count_p_announces() {
        $db = $this->load->database('idverre', TRUE);
        $query = $db->query('SELECT COUNT(*) as count FROM petiteannonce a WHERE visible = 1 ORDER BY id DESC');
        $query = $query->result(); 
        return $query[0]->count;
    }
    function last_annonces() { 
        // Dernière petites annonces
        $db = $this->load->database('idverre', TRUE);
        $query = $db->query('SELECT a.titre,a.annonce,a.date ,a.nom ,a.prenom,a.adresse, a.ville, a.codepostal, a.tel, a.portable, a.email FROM petiteannonce a WHERE visible = 1 ORDER BY id DESC LIMIT 4');
        return $query->result();
    }

    function all_annonces($limit, $start) {
        $db = $this->load->database('idverre', TRUE);
        $db->limit($limit, $start);
        $query = $db->query('SELECT a.titre,a.annonce,a.date ,a.nom ,a.prenom,a.adresse, a.ville, a.codepostal, a.tel, a.portable, a.email FROM petiteannonce a WHERE visible = 1 ORDER BY id DESC LIMIT '.$limit.' OFFSET '.$start);
        return $query->result(); 
    }

    function lorraine_annonces() { 
        // Dernière petites annonces
        $db = $this->load->database('idverre', TRUE);
        $query = $db->query('SELECT a.ID, a.titre,a.annonce,a.date ,a.nom ,a.prenom,a.adresse, a.ville, a.codepostal, a.tel, a.portable, a.email, a.categorie FROM petiteannonce a WHERE visible = 1 and lorraine = 1 ORDER BY date DESC LIMIT 8');
        return $query->result();
    }

    function all_lorraine_annonces() { 
        // Dernière petites annonces
        $db = $this->load->database('idverre', TRUE);
        $query = $db->query('SELECT a.ID, a.titre,a.annonce,a.date ,a.nom ,a.prenom,a.adresse, a.ville, a.codepostal, a.tel, a.portable, a.email, a.categorie FROM petiteannonce a WHERE visible = 1 and lorraine = 1 ORDER BY categorie, date');
        return $query->result();
    }
}
?>
