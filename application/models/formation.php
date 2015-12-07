<?php
/* Pages de contenu */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formation extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }   

    function techniques() { // Toutes les techniques
        $DB1 = $this->load->database('formation', TRUE);
        $DB1->order_by('ordre');
        $query = $DB1->get('modules_tech');
        return $query->result();        
    }
    
    function liste_modules() { // Tous les modules
        $DB1 = $this->load->database('formation', TRUE);
        $DB1->select('m.code, m.intitule, m.intitule_web, m.objectifs, m.public, m.formateur, m.nom_img, m.date_prev_mois, m.annee, m.date_a_determiner, m.code_cycle, m.lieu, m.duree, m.lieninterne, m.lienexterne, f.nom, f.prenom, d.date_debut, d.date_fin');
        $DB1->where('m.code = d.code_module');
        $DB1->where('m.num_formateur_web = f.id');
        $DB1->where('m.form_tech !=','');
        $DB1->or_where('m.form_art !=','');
        $DB1->order_by('d.date_debut');
        $DB1->from ('modules m, modules_dates d, users f');
        $query = $DB1->get();
        return $query->result();        
    }
    
/*
    function modules_cal($mois,$annee) { // Calendrier des modules, sur un mois et une année donnée
        $DB1 = $this->load->database('formation', TRUE);
        $DB1->select('m.code, m.intitule, m.intitule_web, m.objectifs, m.public, m.formateur, m.nom_img, m.date_prev_mois, m.annee, m.date_a_determiner, m.code_cycle, m.lieu, m.duree, m.lieninterne, m.lienexterne, f.nom, f.prenom, d.date_debut, d.date_fin, t.nom as nom_tech, t.id as id_tech');
        $DB1->select("date_format(d.date_debut, ('%d/%m/%Y')) AS datedebut");
        $DB1->select("date_format(d.date_fin, ('%d/%m/%Y')) AS datefin");
        $DB1->where("MONTH(d.date_debut) = $mois");
        $DB1->where("YEAR(d.date_debut) = $annee");
        $DB1->where('m.code = d.code_module');
        $DB1->where('m.num_formateur_web = f.id');
        $DB1->where('m.form_tech !=','');
        $DB1->where('m.techniques = t.id');
//        $DB1->or_where('m.form_art !=','');
        $DB1->order_by('d.date_debut');
        $DB1->from ('modules m, modules_dates d, users f, modules_tech t');
        $query = $DB1->get();
        return $query->result();        
    }
*/
    
    function modules_cal_tech($mois,$annee,$tech) { // Calendrier des modules, sur un mois et une année donnée, selon une technique (passer $tech à 'all' pour toutes les techniques
        $DB1 = $this->load->database('formation', TRUE);
        $DB1->select('m.code, m.intitule, m.intitule_web, m.objectifs, m.public, m.formateur, m.nom_img, m.date_prev_mois, m.annee, m.date_a_determiner, m.code_cycle, m.lieu, m.duree, m.lieninterne, m.lienexterne, f.nom, f.prenom, d.date_debut, d.date_fin, t.nom as nom_tech, t.id as id_tech');
        $DB1->select("date_format(d.date_debut, ('%d/%m/%Y')) AS datedebut");
        $DB1->select("date_format(d.date_fin, ('%d/%m/%Y')) AS datefin");
        $DB1->where("MONTH(d.date_debut) = $mois");
        $DB1->where("YEAR(d.date_debut) = $annee");
        $DB1->where('m.code = d.code_module');
        $DB1->where('m.num_formateur_web = f.id');
        $DB1->where('m.form_tech !=','');
        if ($tech<>'all') {
            if (is_array($tech)) {
                $DB1->where('m.techniques',$tech[0]);
//                $requete="m.techniques = $tech[0]";
                for($i=1;$i<sizeof($tech);$i++) $DB1->or_where('m.techniques',$tech[$i]); //$requete=$requete." or m.techniques = $tech[$i] ";
//                $DB1->where($requete);
//                echo $requete;
//                print_r($tech);
            }
            else $DB1->where("m.techniques = $tech");
        }
        $DB1->where('m.techniques = t.id');
//        $DB1->or_where('m.form_art !=','');
        $DB1->order_by('d.date_debut');
        $DB1->from ('modules m, modules_dates d, users f, modules_tech t');
        $query = $DB1->get();
        return $query->result();        
    }

    function cycles() {
        $DB1 = $this->load->database('formation', TRUE);
        $DB1->select('*');
        $DB1->select("date_format(date_debut, ('%d/%m/%Y')) AS datedebut");
        $DB1->select("date_format(date_fin, ('%d/%m/%Y')) AS datefin");
        $DB1->where('date_fin > CURDATE()');
        $DB1->order_by('date_debut');
        $query = $DB1->get('cycles');
        return $query->result();
    }
    
    function cycle_detail($id_cycle) {
        $DB1 = $this->load->database('formation', TRUE);
        $DB1->select('*');
        $DB1->select("date_format(date_debut, ('%d')) AS jourcycledebut");
        $DB1->select("date_format(date_debut, ('%c')) AS moiscycledebut");
        $DB1->select("date_format(date_debut, ('%Y')) AS anneecycledebut");
        $DB1->select("date_format(date_fin, ('%d')) AS jourcyclefin");
        $DB1->select("date_format(date_fin, ('%c')) AS moiscyclefin");
        $DB1->select("date_format(date_fin, ('%Y')) AS anneecyclefin");
        $DB1->where('code',$id_cycle);
        $query = $DB1->get('cycles');
        return $query->result();
    }
    
    function cycle_modules($id_cycle) {
        $DB1 = $this->load->database('formation', TRUE);
        $DB1->select('m.code, m.intitule, m.intitule_web, m.objectifs, m.public, m.formateur, m.nom_img, m.date_prev_mois, m.annee, m.date_a_determiner, m.code_cycle, m.lieu, m.duree, m.lieninterne, m.lienexterne, f.nom, f.prenom, d.date_debut, d.date_fin');
        $DB1->select("date_format(d.date_debut, ('%d/%m/%Y')) AS datedebut");
        $DB1->select("date_format(d.date_fin, ('%d/%m/%Y')) AS datefin");
        $DB1->where('m.code = d.code_module');
        $DB1->where('m.num_formateur_web = f.id');
        $DB1->where('m.code = c.code_module');
        $DB1->where("c.code_cycle = '$id_cycle'");
        $DB1->distinct('m.code');
        $DB1->order_by('d.date_debut');
        $DB1->from ('modules m, modules_dates d, modules_cycles c, users f');
        $query = $DB1->get();
        return $query->result();        
    }

}
?>
