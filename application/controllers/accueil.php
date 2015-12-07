<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Accueil extends CI_Controller {
/*
 * Page d'accueil
 */
    function index() {
        $this->load->helper('url');
        $this->load->helper('text');
        $detect = new Mobile_Detect;

        $this->load->model('Organismes');
        $this->load->model('Diplomes');
        $this->load->model('Blog');
        $this->load->model('Annonces');
        
        $data['organismes'] = $this->Organismes->liste_orga();
        $data['diplomes'] = $this->Diplomes->liste_diplomes();
        $data['posts'] = $this->Blog->last_posts();
        $data['lastpost'] = $this->Blog->last_post();
        $data['annonces'] = $this->Annonces->lorraine_annonces();
        
        $this->load->view('header',$data);      // Entête de la page (contient le menu principal)
        if ($detect->isMobile()) {
            $this->load->view('m_actus_top', $data);     // Actualités "à la une"
            $this->load->view('m_liste_actus', $data);   // La liste des actualités
        } else {
//            $this->load->view('actus_top', $data);   // Actualités "à la une"
//            $this->load->view('videos', $data);      // Les vidéos
//            $this->load->view('liste_actus', $data); // La liste des actualités
        }
        $this->load->view('blog',$data);              // Blog
        $this->load->view('ressources',$data);        // Ressources & Qualifications
        $this->load->view('offres',$data);            // Offres de formations

        $this->load->view('annonces',$data);          // Les petites annonces
        $this->load->view('partenaires',$data);       // Logos des partenaires
        $this->load->view('footer',$data);            // Le pied de page
    }
    
    function mobile() {
        $this->load->helper('url');
        $this->load->model('Menus'); 
        $this->load->model('Actualites');
        $this->load->model('Videos');
        $data['menu'] = $this->Menus->pages_menu();         // Chargement du menu principal
        $data['top'] = $this->Actualites->top_actus();      // Chargement des actualités "à la une"
        $data['actus'] = $this->Actualites->liste_actus();  // Chargement de la liste des actualités
        $data['videos'] = $this->Videos->videos_accueil();  // Chargement des vidéos
        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        $data['dlfooter'] = $this->Menus->dl_footer();        // Liens de téléchargement du pied de page
        $this->load->view('header',$data); 
        $this->load->view('accueil_mobile');
        $this->load->view('footer',$data);  
    }
    
    
    function organisme($orga) { 
        $this->load->helper('url');
        $this->load->helper('text');
        
//        $this->load->library('dateutils');
        $detect = new Mobile_Detect;

        $this->load->model('Organismes');
        $this->load->model('Diplomes');
        
        $data['orga'] = $orga;
        $data['organisme'] = $this->Organismes->affiche_orga($orga);
        $data['options'] = $this->Diplomes->options_organisme($orga);
//        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        
        $this->load->view('header',$data);      // Entête de la page (contient le menu principal)
        if ($detect->isMobile()) {
            $this->load->view('m_actus_top', $data);     // Actualités "à la une"
            $this->load->view('m_liste_actus', $data);   // La liste des actualités
        } else {
//            $this->load->view('actus_top', $data);   // Actualités "à la une"
//            $this->load->view('videos', $data);      // Les vidéos
//            $this->load->view('liste_actus', $data); // La liste des actualités
        }
        $this->load->view('organisme',$data);            // Offres de formations
        
//        $this->load->view('annonces',$data);          // Les petites annonces
//        $this->load->view('partenaires',$data);       // Logos des partenaires
        $this->load->view('footer',$data);            // Le pied de page
        
    }
    
    function ressource($ressource) {
        $this->load->helper('url');
        $this->load->helper('text');
        
//        $this->load->library('dateutils');
        $detect = new Mobile_Detect;

        $this->load->model('Diplomes');
        $data['diplome'] = $this->Diplomes->affiche_diplome($ressource);
        $data['actus'] = $this->Diplomes->actus_diplome($ressource);
        $data['options'] = $this->Diplomes->options_diplome($ressource);
        foreach ($data['options'] as $row) {
            $data['orga_options'][$row->id_option] = $this->Diplomes->option_organismes($row->id_option);
        }
//        $data['options'] = $this->Diplomes->options_diplome($ressource);
        
//        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        
        $this->load->view('header',$data);      // Entête de la page (contient le menu principal)
        if ($detect->isMobile()) {
            $this->load->view('m_actus_top', $data);     // Actualités "à la une"
            $this->load->view('m_liste_actus', $data);   // La liste des actualités
        } else {
//            $this->load->view('actus_top', $data);   // Actualités "à la une"
//            $this->load->view('videos', $data);      // Les vidéos
//            $this->load->view('liste_actus', $data); // La liste des actualités
        }
        $this->load->view('ressource',$data);            // Offres de formations
        
//        $this->load->view('annonces',$data);          // Les petites annonces
//        $this->load->view('partenaires',$data);       // Logos des partenaires
        $this->load->view('footer',$data);            // Le pied de page
        
    }
    
    function blog($post) {
        $this->load->helper('url');
        $this->load->helper('text');
        
        $this->load->model('Blog');
        $data['post'] = $this->Blog->affiche_post($post);

        $this->load->view('header',$data);      // Entête de la page (contient le menu principal)
        $this->load->view('post',$data);        
        $this->load->view('footer',$data);      // Le pied de page
        
    }

    function annonces() {
        $this->load->helper('url');
        $this->load->helper('text');
        
        $this->load->model('Annonces');
        $data['annonces'] = $this->Annonces->all_lorraine_annonces();

        $this->load->view('header',$data);      // Entête de la page (contient le menu principal)
        $this->load->view('all_annonces',$data);        
        $this->load->view('footer',$data);      // Le pied de page
        
    }
    
    function qui_sommes_nous() {
        $this->load->helper('url');
        $this->load->helper('text');
        
        $this->load->model('Annonces');
        $data['annonces'] = $this->Annonces->all_lorraine_annonces();

        $this->load->view('header',$data);      // Entête de la page (contient le menu principal)
        $this->load->view('qui-sommes-nous');        
        $this->load->view('footer',$data);      // Le pied de page
        
    }

    function mentions_legales() {
        $this->load->helper('url');
        $this->load->helper('text');
        
        $this->load->model('Annonces');
        $data['annonces'] = $this->Annonces->all_lorraine_annonces();

        $this->load->view('header',$data);      // Entête de la page (contient le menu principal)
        $this->load->view('mentions-legales');        
        $this->load->view('footer',$data);      // Le pied de page
        
    }

    function panorama() {
        $this->load->helper('url');
        $this->load->helper('text');
        
        $this->load->model('Annonces');
        $data['annonces'] = $this->Annonces->all_lorraine_annonces();

        $this->load->view('header',$data);      // Entête de la page (contient le menu principal)
        $this->load->view('panorama');        
        $this->load->view('footer',$data);      // Le pied de page
        
    }
    
    }
?>