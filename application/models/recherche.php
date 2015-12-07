<?php
/* Recherches dans le contenu du site */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recherche extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }   

    function recherche_actus($search) {
        $search='%'.$search.'%';
        //$query = $this->db->query('SELECT a.id_actu,a.titre,a.date_debut,a.date_fin,a.resume,a.image,a.entete,c.id_cat,c.categorie FROM '. $this->db->dbprefix('actualites') .' a,'. $this->db->dbprefix('categories') .' c where a.id_cat=c.id_cat and a.titre like "'.$search.'"');
        $query = $this->db->query('SELECT * FROM '. $this->db->dbprefix('actualites') .' WHERE UPPER(titre) like UPPER("'.$search.'")');
        return $query->result();
    }

    function recherche_pages($search) {
        $search='%'.$search.'%';
        //$query = $this->db->query('SELECT a.id_actu,a.titre,a.date_debut,a.date_fin,a.resume,a.image,a.entete,c.id_cat,c.categorie FROM '. $this->db->dbprefix('actualites') .' a,'. $this->db->dbprefix('categories') .' c where a.id_cat=c.id_cat and a.titre like "'.$search.'"');
        $query = $this->db->query('SELECT * FROM '. $this->db->dbprefix('pages') .' WHERE UPPER(titre) like UPPER("'.$search.'")');
        return $query->result();
    }
}
?>
