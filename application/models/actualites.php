<?php
/* Actualités de la pâge d'accueil */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Actualites extends CI_Model {

    var $titre='';
    var $date_debut='';
    var $date_fin='';
    var $resume='';
    var $image='';
    var $categorie=0;
    
    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }   

    function all_actus() { // Liste de toutes les actualités
        //$query = $this->db->get('actualites', 12);
        $query = $this->db->query('SELECT a.id_actu,a.titre,a.date_debut,a.date_fin,a.resume,a.image,a.entete,c.id_cat,c.categorie FROM '. $this->db->dbprefix('actualites') .' a,'. $this->db->dbprefix('categories') .' c where a.id_cat=c.id_cat and a.entete>=0 and date_fin>CURDATE() order by a.date_saisie desc');
        return $query->result();
    }

    function liste_actus() { // Liste des actualités
        //$query = $this->db->get('actualites', 12);
        $query = $this->db->query('SELECT a.id_actu,a.titre,a.date_debut,a.date_fin,a.resume,a.image,a.entete,c.id_cat,c.categorie FROM '. $this->db->dbprefix('actualites') .' a,'. $this->db->dbprefix('categories') .' c where a.id_cat=c.id_cat and a.entete>=0 and date_fin>CURDATE() order by a.date_saisie desc limit 9');
        return $query->result();
    }
    
    function cat_actus($cat) { // Liste des actualités par catégorie
        //$query = $this->db->get('actualites', 12);
        $query = $this->db->query('SELECT a.id_actu,a.titre,a.date_debut,a.date_fin,a.resume,a.image,a.entete,c.id_cat,c.categorie FROM '. $this->db->dbprefix('actualites') .' a,'. $this->db->dbprefix('categories') .' c where c.categorie="'.strtolower($cat).'" and a.id_cat=c.id_cat and a.entete>=0 and date_fin>CURDATE() order by a.date_saisie desc');
        return $query->result();
    }

    function top_actus() { // Liste simple des actus du haut
        $query = $this->db->query('SELECT id_actu,titre,image,entete,date_debut,date_fin FROM '. $this->db->dbprefix('actualites') .' WHERE entete>0 order by entete limit 4');
        return $query->result();
    }

    function top_actus_update() { // Les actus de haut de page sur l'accueil, avec mise à jour en cas d'actu périmée
        $topactus=array(1,2,3,4);
        
        foreach($topactus as $entete) {
            $this->db->where('entete',$entete);
            $this->db->where('date_fin >','CURDATE()',FALSE);
            $count = $this->db->count_all_results('actualites');
            if ($count==0) {
                $this->db->select('id_actu');
                $this->db->where('entete',0);
                $this->db->where('date_fin >','CURDATE()',FALSE);
                $this->db->order_by('date_saisie');
                $this->db->limit(1);
                $queryupdt = $this->db->get('actualites');
                foreach ($queryupdt->result() as $row) {
                    $this->db->update('actualites', array('entete' => $entete), array('id_actu' => $row->id_actu));
                }
            }
            $query = $this->db->query("SELECT id_actu,titre,image,entete,date_debut,date_fin FROM ". $this->db->dbprefix('actualites') ." WHERE entete='$entete' and date_fin>CURDATE()");
            $top_actu[$entete]=$query->result();
        }
        return $top_actu;
    }

    function affiche_actu($id_actu) {
        $query = $this->db->query("SELECT * FROM ". $this->db->dbprefix('actualites') ." WHERE id_actu=$id_actu");
        return $query->result();
    }
    
    function dernieres_actus() {
        $this->db->order_by('date_saisie', 'desc');
        $query = $this->db->get('actualites', 10);
        return $query->result();
    }

    function liste_actus_date($ordre,$sens) {
        $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('actualites')." a, ".$this->db->dbprefix('categories')." c WHERE a.id_cat=c.id_cat order by $ordre $sens");
        return $query->result();
    }
    
    function liste_actus_agenda() {
        $query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('actualites')." a, ".$this->db->dbprefix('categories')." c WHERE a.agenda=1 and a.id_cat=c.id_cat and date_fin>CURDATE() order by date_fin");
        return $query->result();
    }

    function get_actu($id_actu) {
        $query = $this->db->get_where('actualites', array('id_actu' => $id_actu));
        return $query->result();
    }
    
    function get_cat($id_cat) {
        $query = $this->db->query("SELECT categorie FROM ".$this->db->dbprefix('categories')." c WHERE $id_cat=c.id_cat");
        return $query->result();
    }
    function sup_actu($id_actu) {
        $query = $this->db->delete('actualites', array('id_actu' => $id_actu));
        //return $query->result();
    }
}
?>
