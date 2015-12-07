<?php
/* Actualités de la pâge d'accueil */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Db_save extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }   

/*
 * Pages
 */

    function add_page() { // Ajout d'une nouvelle page
        $this->db->set('titre', $this->input->post('titre'));
        $this->db->set('titre_nav', $this->input->post('titre_nav'));
        $this->db->set('resume', $this->input->post('resume'));
        $this->db->set('texte', $this->input->post('texte'));
        $this->db->set('alt_image', $this->input->post('alt_image'));
        $this->db->set('url', $this->input->post('url'));
        $this->db->set('id_cat', $this->input->post('id_cat'));
        $this->db->set('parent', $this->input->post('parent'));
        if ($this->input->post('parent')>0) {
            if ($this->input->post('ordre')==0) $ordre=1;
            else $ordre=$this->input->post('ordre');
        }
        else $ordre=0;
        $this->db->set('ordre', $ordre);
        if ($this->input->post('menu')=='TRUE') $menu=1;
        else $menu=0;
        $this->db->set('menu', $menu);
        $upload_data = $this->upload->data();
        $this->db->set('image', $upload_data['file_name']);
        
        $this->db->set('date_saisie',  standard_date('DATE_W3C', time()));
        
        $this->db->insert('pages'); 
    }
    
    function update_page() { // Modification d'une page
        $this->db->set('titre', $this->input->post('titre'));
        $this->db->set('titre_nav', $this->input->post('titre_nav'));
        $this->db->set('resume', $this->input->post('resume'));
        $this->db->set('texte', $this->input->post('texte'));
        $this->db->set('alt_image', $this->input->post('alt_image'));
        $this->db->set('url', $this->input->post('url'));
        $this->db->set('id_cat', $this->input->post('id_cat'));
        $this->db->set('parent', $this->input->post('parent'));
        if ($this->input->post('parent')>0) {
            if ($this->input->post('ordre')==0) $ordre=1;
            else $ordre=$this->input->post('ordre');
        }
        else $ordre=$this->input->post('ordre');
        $this->db->set('ordre', $ordre);
        if ($this->input->post('menu')=='TRUE') $menu=1;
        else $menu=0;
        $this->db->set('menu', $menu);
        if ($this->input->post('supprimage')==1) $this->db->set('image', '');
        else {
            $upload_data = $this->upload->data();
            if ($upload_data['file_name']) $this->db->set('image', $upload_data['file_name']);
        }
        
        $this->db->set('date_saisie',  standard_date('DATE_W3C', time()));

        $this->db->where('id_page', $this->input->post('id_page'));
        
        $this->db->update('pages'); 
    }

/*
 * Encarts des pages
 */
    function add_encart() { // Modification d'une page
        $this->db->set('titre', $this->input->post('titre'));
        $this->db->set('texte', $this->input->post('texte'));
        $this->db->set('id_page', $this->input->post('id_page'));
        if ($this->input->post('ordre')==0) $ordre=1;
        else $ordre=$this->input->post('ordre');
        $this->db->set('ordre', $ordre);

        $this->db->insert('pages_encarts'); 
    }
    
    function update_encart() { // Modification d'une page
        $this->db->set('titre', $this->input->post('titre'));
        $this->db->set('texte', $this->input->post('texte'));
        $this->db->set('id_page', $this->input->post('id_page'));
        if ($this->input->post('ordre')==0) $ordre=1;
        else $ordre=$this->input->post('ordre');
        $this->db->set('ordre', $ordre);
   
        $this->db->where('id_encart', $this->input->post('id_encart'));
        
        $this->db->update('pages_encarts'); 
    }

/*
 * Modification de l'ordre des pages
 */    
    function update_order () {
        $this->db->set('ordre', $this->input->post('ordresouspage'));
        $this->db->where('id_page', $this->input->post('id_souspage'));
        $this->db->update('pages'); 
    }

/*
 * Actualités
 */    
    
    function add_actu() { // Ajout d'une nouvelle actualité
        $this->db->set('titre', $this->input->post('titre'));
        $this->db->set('date_debut', $this->input->post('date_debut'));
        $this->db->set('date_fin', $this->input->post('date_fin'));
        $this->db->set('resume', $this->input->post('resume'));
        $this->db->set('texte', $this->input->post('texte'));
        $this->db->set('alt_image', $this->input->post('alt_image'));
        $this->db->set('entete', $this->input->post('entete'));
        $this->db->set('id_cat', $this->input->post('id_cat'));
        $this->db->set('agenda', $this->input->post('agenda'));

        $upload_data = $this->upload->data();
        $this->db->set('image', $upload_data['file_name']);
        
        $this->db->set('date_saisie',  standard_date('DATE_W3C', time()));

        $this->db->insert('actualites'); 
    }
    
    function update_actu() { // Modification d'une actualité
        $this->db->set('titre', $this->input->post('titre'));
        $this->db->set('date_debut', $this->input->post('date_debut'));
        $this->db->set('date_fin', $this->input->post('date_fin'));
        $this->db->set('resume', $this->input->post('resume'));
        $this->db->set('texte', $this->input->post('texte'));
        $this->db->set('alt_image', $this->input->post('alt_image'));
        $this->db->set('entete', $this->input->post('entete'));
        $this->db->set('id_cat', $this->input->post('id_cat'));
        $this->db->set('agenda', $this->input->post('agenda'));

        $upload_data = $this->upload->data();
        if ($upload_data['file_name']) $this->db->set('image', $upload_data['file_name']);
        
        $this->db->set('date_saisie',  standard_date('DATE_W3C', time()));

        $this->db->where('id_actu', $this->input->post('id_actu'));
        
        $this->db->update('actualites'); 
    }

/*
 * Vidéos / médias
 */

    function add_video() { // Ajout d'une nouvelle vidéo
        $this->db->set('titre', $this->input->post('titre'));
        $this->db->set('origine', $this->input->post('origine'));
        $this->db->set('lien', $this->input->post('lien'));
        $this->db->set('legende', $this->input->post('legende'));
        $this->db->set('date_saisie',  standard_date('DATE_W3C', time()));

        
        $this->db->insert('videos'); 
    }
    
    function update_video() { // Modification d'une vidéo
        $this->db->set('titre', $this->input->post('titre'));
        $this->db->set('origine', $this->input->post('origine'));
        $this->db->set('lien', $this->input->post('lien'));
        $this->db->set('legende', $this->input->post('legende'));
        $this->db->set('date_saisie',  standard_date('DATE_W3C', time()));

        $this->db->where('id_video', $this->input->post('id_video'));
        
        $this->db->update('videos'); 
    }

}
?>
