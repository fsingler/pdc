<?php
/* Les menus et les listes de catégories dans l'admin */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Menus extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }   

    function menu_top() { // Menu qui n'affiche que les catégories, utilisé pour le menu des actus
        $conditions = array('menu_top' => 1);
 //       $this->db->order_by('ordre');
        $query = $this->db->get_where('categories', $conditions);
        return $query->result();
    }

    function pages_menu() { //Les pages affichées dans les menus
        $menu=array();
        $conditions = array('menu_top' => 1);
        $query = $this->db->get_where('categories', $conditions);
        foreach ($query->result() as $row) {
            //Intitulé du menu
            $menu[$row->id_cat]['menu']=$row->categorie; 
            $menu[$row->id_cat]['classe_css']=$row->classe_css; 
            // Recherche des pages liées à cette catégorie
            $conditions2 = array('id_cat' => $row->id_cat, 'menu' => 1); 
            $this->db->order_by('ordre');
            $query2 = $this->db->get_where('pages', $conditions2);
            // Les liens du menu
            foreach ($query2->result() as $row2) {
                $menu[$row->id_cat][$row2->id_page]['id_page']=$row2->id_page;
                $menu[$row->id_cat][$row2->id_page]['titre']=$row2->titre;
                $menu[$row->id_cat][$row2->id_page]['titre_nav']=$row2->titre_nav;
                $menu[$row->id_cat][$row2->id_page]['texte']=$row2->texte;
                $menu[$row->id_cat][$row2->id_page]['url']=$row2->url;
                $menu[$row->id_cat][$row2->id_page]['categorie']=$row->categorie;
                $menu[$row->id_cat][$row2->id_page]['parent']=$row2->parent;
//                $menu[$row->id_cat][$row2->id_page]['ordre']=$row2->ordre;
                $this->db->order_by('ordre');
                $query3 = $this->db->get_where('pages', array('parent' => $row2->id_page));
                foreach($query3->result() as $row3) {
                    $menu[$row->id_cat][$row2->id_page]['child'][$row3->ordre]['id']=$row3->id_page;
                    $menu[$row->id_cat][$row2->id_page]['child'][$row3->ordre]['titre']=$row3->titre_nav;
                } 
                
            }
        }
        return $menu;
    }
 
    function menu_footer() { // Menu du pied de page (Informations)
        $conditions = array('id_cat' => 6,'menu' => 1);
        $this->db->order_by('ordre');
        $query = $this->db->get_where('pages', $conditions);
        return $query->result();
    }
    
    function dl_footer() { // Liste des fichiers à télécharger dans le pied de page
        $conditions = array('footer' => 1);
        $this->db->order_by('ordre');
        $query = $this->db->get_where('telechargements', $conditions);
        return $query->result();
    }
    
    function categories() { // Menu qui n'affiche que les catégories, utilisé pour le menu des actus
//        $conditions = array('menu_top' => 1);
 //       $this->db->order_by('ordre');
        $query = $this->db->get('categories');
        return $query->result();
    }

    function categories_actus() { // Menu qui n'affiche que les catégories, utilisé pour le menu des actus
        $conditions = array('type >=' => 1, 'type <>' => 2);
 //       $this->db->order_by('ordre');
        $query = $this->db->get_where('categories', $conditions);
        return $query->result();
    }

    function categories_pages() { // Menu qui n'affiche que les catégories, utilisé pour le menu des actus
        $conditions = array('type >' => 1);
 //       $this->db->order_by('ordre');
        $query = $this->db->get_where('categories', $conditions);
        return $query->result();
    }

}
?>
