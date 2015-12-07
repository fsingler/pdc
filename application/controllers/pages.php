<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pages extends CI_Controller {
/*
 * Page d'accueil des actualités
 */
    function index() {
        $this->load->helper('url');

        $this->load->model('Menus');
        $this->load->model('Actualites');
        
        $data['menu'] = $this->Menus->pages_menu();
        $data['actus'] = $this->Actualites->liste_actus();
        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        $data['dlfooter'] = $this->Menus->dl_footer();        // Liens de téléchargement du pied de page
        
        $this->load->view('header',$data);
        $this->load->view('liste_actus',$data);
        $this->load->view('footer',$data);
    }
/*
 * Affichage d'une page (redirection de l'URL dans config/routes.php)
 */    
    function page($id_page) {
        $this->load->helper('url');
        
        $this->load->model('Menus');
        $this->load->model('Contenu');

        $data['menu'] = $this->Menus->pages_menu();
        $data['content'] = $this->Contenu->affiche_page($id_page);
        $data['encarts'] = $this->Contenu->encarts($id_page);
        $data['path_img'] = 'content';
        $data['pg'] = $id_page;
        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        $data['dlfooter'] = $this->Menus->dl_footer();        // Liens de téléchargement du pied de page

        $this->load->view('header',$data);
//        $this->load->view('breadcrumb');
        $this->load->view('article',$data);
        $this->load->view('social');
        $this->load->view('footer',$data);
    }
}
?>