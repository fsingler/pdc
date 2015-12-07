<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Actus extends CI_Controller {
    /*
     * Page d'accueil des actualités
     */

    function index() {
        $this->load->helper('url');

        $this->load->model('Menus');
        $this->load->model('Actualites');

        $data['menu'] = $this->Menus->pages_menu();
        $data['menu_actus'] = $this->Menus->menu_top();

        $data['actus'] = $this->Actualites->all_actus();
        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        $data['dlfooter'] = $this->Menus->dl_footer();        // Liens de téléchargement du pied de page

        $this->load->view('header', $data);

        $this->load->view('liste_actus_all', $data);
        $this->load->view('footer', $data);
    }

    /*
     * Affichage d'une actualité (redirection de l'URL dans config/routes.php)
     */

    function actu($id_actu) {
        $this->load->helper('url');
        $detect = new Mobile_Detect;
        $this->load->model('Menus');
        $this->load->model('Actualites');

        $data['menu'] = $this->Menus->pages_menu();
        $data['content'] = $this->Actualites->affiche_actu($id_actu);
        $data['cat'] = $this->Actualites->get_cat($data['content'][0]->id_cat);
        $data['cat'] = $data['cat'][0]->categorie;
        $data['path_img'] = 'actus';
        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        $data['dlfooter'] = $this->Menus->dl_footer();        // Liens de téléchargement du pied de page

        $this->load->view('header', $data);
//        $this->load->view('breadcrumb');
        if ($detect->isMobile()) {
            $this->load->view('m_actualite', $data);
        } else {
            $this->load->view('actualite', $data);
            $this->load->view('social');
        }

        $this->load->view('footer', $data);
    }

    function actu_cat($id_cat) {
        $this->load->helper('url');

        $this->load->model('Menus');
        $this->load->model('Actualites');

        $data['menu'] = $this->Menus->pages_menu();
        $data['menu_actus'] = $this->Menus->categories_actus();
        $data['actus'] = $this->Actualites->cat_actus($id_cat);
        //       $data['path_img'] = 'actus';
        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        $data['dlfooter'] = $this->Menus->dl_footer();        // Liens de téléchargement du pied de page

        $this->load->view('header', $data);
        $this->load->view('liste_actus_all', $data);
        $this->load->view('footer', $data);
    }

    function agenda() {
        $this->load->helper('url');
        $this->load->helper('date');
        $this->load->library('dateutils');

        $this->load->model('Menus');
        $this->load->model('Actualites');

        $data['menu'] = $this->Menus->pages_menu();
        $data['menu_actus'] = $this->Menus->categories_actus();
        $data['actus'] = $this->Actualites->liste_actus_agenda();
        //       $data['path_img'] = 'actus';
        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        $data['dlfooter'] = $this->Menus->dl_footer();        // Liens de téléchargement du pied de page

        $this->load->view('header', $data);
        $this->load->view('liste_actus_agenda', $data);
        $this->load->view('footer', $data);
    }

}

?>