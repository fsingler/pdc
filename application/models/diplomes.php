<?php
/* Pages de contenu */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Diplomes extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }   

/*
 * Séléctions dans la BDD
 */    
    
    function liste_diplomes(){
        $query = $this->db->get('diplomes');
        return $query->result();
    }

    function liste_options() { // Liste des diplômes et options
        $this->db->select('op.id_option, d.intitule, op.option, d.id_diplome, op.texte');
        $this->db->from('option_diplome op, diplomes d');
        $this->db->where('d.id_diplome = op.diplomes_id_diplome');
        $this->db->order_by('d.intitule, op.option');
        $query = $this->db->get();
        return $query->result();
    }
    
    function affiche_diplome($id_diplome) {
        $this->db->where('id_diplome', $id_diplome);
        $query = $this->db->get('diplomes');
        return $query->result();
    }
    
    function actus_diplome($id_diplome) {
        $this->db->where('diplomes_id_diplome', $id_diplome);
        $this->db->order_by('date','desc');
        $query = $this->db->get('actus_diplomes');
        return $query->result();
    }
    
    function options_diplome($id_diplome) {
        $this->db->where('diplomes_id_diplome', $id_diplome);
        $query = $this->db->get('option_diplome');
        return $query->result();
    }
    
    function affiche_option($id_option) {
        $this->db->where('id_option', $id_option);
        $query = $this->db->get('option_diplome');
        return $query->result();
    }

    function organismes_diplomes($id_orga) {
        $this->db->where('diplomes_id_diplome', $id_orga);
        $query = $this->db->get('option_diplome');
        return $query->result();
    }
    
    function option_organismes($id_option) { // Organismes enseigant une option donnée
        $this->db->select('o.id_orga, o.nom');
        $this->db->from('organismes o, organismes_diplome_option od, option_diplome op, diplomes d');
        $this->db->where('od.id_option = '.$id_option.' and od.id_option = op.id_option and od.id_orga = o.id_orga and d.id_diplome = op.diplomes_id_diplome');
        $query = $this->db->get();
        return $query->result();
    }
    
    function options_organisme($id_orga) { // Options enseignées dans un organisme donné
        $this->db->select('od.id_option, d.intitule, op.option, od.description, d.id_diplome, op.texte');
        $this->db->from('organismes o, organismes_diplome_option od, option_diplome op, diplomes d');
        $this->db->where('od.id_orga = '.$id_orga.' and od.id_option = op.id_option and od.id_orga = o.id_orga and d.id_diplome = op.diplomes_id_diplome');
        $query = $this->db->get();
        return $query->result();
    }

    function organisme_diplome_option($id_diplome,$id_option,$id_orga) {
        $this->db->where('id_orga', $id_orga);
        $this->db->where('id_diplome', $id_diplome);
        $this->db->where('id_option', $id_option);
        $query = $this->db->get('organismes_diplome_option');
        return $query->result();
    }

/*
 * Modifications de la BDD
 */    
    
    function option_add() { // Ajout d'une nouvelle option de diplôme
        $this->db->set('option', $this->input->post('option'));
        $this->db->set('textes_officiels', $this->input->post('textes_officiels'));
        $this->db->set('metier_inma', $this->input->post('metier_inma'));
        $this->db->set('lien_inma', $this->input->post('lien_inma'));
        $this->db->set('diplomes_id_diplome', $this->input->post('diplome'));
        $this->db->set('texte', $this->input->post('texte'));
//        $this->db->set('date_saisie',  standard_date('DATE_W3C', time()));
        $this->db->insert('option_diplome'); 
    }

    function option_updt() { // Modification d'une option de diplôme
        $this->db->set('option', $this->input->post('option'));
        $this->db->set('textes_officiels', $this->input->post('textes_officiels'));
        $this->db->set('metier_inma', $this->input->post('metier_inma'));
        $this->db->set('lien_inma', $this->input->post('lien_inma'));
        $this->db->set('diplomes_id_diplome', $this->input->post('diplome'));
        $this->db->set('texte', $this->input->post('texte'));
//        $this->db->set('date_saisie',  standard_date('DATE_W3C', time()));
        $this->db->where('id_option', $this->input->post('id_option'));
        $this->db->update('option_diplome'); 
    }

    function option_suppr($id_option,$id_orga) { // Suppression d'une options de diplôme
        $this->db->where('id_option',$id_option);
        $query = $this->db->delete('option_diplome');
    }

    function orga_option_add() {
        $this->db->set('description', $this->input->post('description'));
        $this->db->set('id_orga', $this->input->post('id_orga'));
        $this->db->set('id_diplome', $this->input->post('id_diplome'));
        $this->db->set('id_option', $this->input->post('id_option'));
        $this->db->insert('organismes_diplome_option'); 
    }
    
    function orga_option_updt() {
        $this->db->set('description', $this->input->post('description'));
        $this->db->where('id_orga', $this->input->post('id_orga'));
        $this->db->where('id_diplome', $this->input->post('id_diplome'));
        $this->db->where('id_option', $this->input->post('id_option'));
        $this->db->update('organismes_diplome_option'); 
    }
    
    function orga_option_suppr($id_option,$id_diplome,$id_orga) { // Suppression d'un diplôme dans un organisme
        $this->db->where('id_option',$id_option);
        $this->db->where('id_diplome',$id_diplome);
        $this->db->where('id_orga',$id_orga);
        $query = $this->db->delete('organismes_diplome_option');
    }

   
}
?>
