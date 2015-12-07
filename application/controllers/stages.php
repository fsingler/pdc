<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Stages extends CI_Controller {
/*
 * Page d'accueil
 */
    function index() {
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','email'));
        
//        $detect = new Mobile_Detect;

        $this->load->model('Menus'); 
        $this->load->model('Formation');
        
        $data['menu'] = $this->Menus->pages_menu();         // Chargement du menu principal
        $data['techniques'] = $this->Formation->techniques();         // Recherche des techniques
        $data['cycles'] = $this->Formation->cycles();         // Recherche des cycles
//        $data['modules'] = $this->Formation->liste_modules();
        
        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        $data['dlfooter'] = $this->Menus->dl_footer();        // Liens de téléchargement du pied de page
        
        $this->load->view('header',$data);      // Entête de la page (contient le menu principal)
        $this->load->view('stages_liste',$data);
//        $this->load->view('stages_recherche',$data);
        $this->load->view('cycles',$data);
        
        $tab_mois=array (1=>'Janvier',2=>'Février',3=>'Mars',4=>'Avril',5=>'Mai',6=>'Juin',7=>'Juillet',8=>'Août',9=>'Septembre',10=>'Octobre',11=>'Novembre',12=>'Décembre');
/**/
        $annee=date('Y');
        $mois_rentree=9;
        if (date('n')>=$mois_rentree) {
            for ($m=date('n');$m<=12;$m++) {
                $data['modules'] = $this->Formation->modules_cal_tech($m,$annee,'all');
                $data['mois'] = $tab_mois[$m];
                $data['annee'] = $annee;
                $this->load->view('stages_calendrier',$data);
            }
            $annee=$annee+1;
            for ($m=1;$m<$mois_rentree;$m++) {
                $data['modules'] = $this->Formation->modules_cal_tech($m,$annee,'all');
                $data['mois'] = $tab_mois[$m];
                $data['annee'] = $annee;
                $this->load->view('stages_calendrier',$data);
            }
        }
        else {
            for ($m=date('n');$m<=12;$m++) {
                $data['modules'] = $this->Formation->modules_cal_tech($m,$annee,'all');
                $data['mois'] = $tab_mois[$m];
                $data['annee'] = $annee;
                $this->load->view('stages_calendrier',$data);
            }
        }
/**/        
//        if ($detect->isMobile()) {
//            $this->load->view('m_actus_top', $data);     // Actualités "à la une"
//            $this->load->view('m_liste_actus', $data);   // La liste des actualités
//        } else {
//            $this->load->view('actus_top', $data);   // Actualités "à la une"
//            $this->load->view('videos', $data);      // Les vidéos
//            $this->load->view('liste_actus', $data); // La liste des actualités
//        }
        
        $this->load->view('footer',$data);            // Le pied de page
    }

/*
 * Recherche par technique (1 technique en paramètre)
 */
    function rech($tech) {
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','email'));
        
//        $detect = new Mobile_Detect;

        $this->load->model('Menus'); 
        $this->load->model('Formation');
        
        $data['menu'] = $this->Menus->pages_menu();         // Chargement du menu principal
        $data['techniques'] = $this->Formation->techniques();         // Recherche des techniques
        
        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        $data['dlfooter'] = $this->Menus->dl_footer();        // Liens de téléchargement du pied de page
        
        $this->load->view('header',$data);      // Entête de la page (contient le menu principal)
        $this->load->view('stages_liste',$data);
//        $this->load->view('stages_recherche',$data);
        
        $tab_mois=array (1=>'Janvier',2=>'Février',3=>'Mars',4=>'Avril',5=>'Mai',6=>'Juin',7=>'Juillet',8=>'Août',9=>'Septembre',10=>'Octobre',11=>'Novembre',12=>'Décembre');

        $annee=date('Y');
        $mois_rentree=9;
        if (date('n')>=$mois_rentree) {
            for ($m=date('n');$m<=12;$m++) {
                $data['modules'] = $this->Formation->modules_cal_tech($m,$annee,$tech);
                $data['mois'] = $tab_mois[$m];
                $data['annee'] = $annee;
                $this->load->view('stages_calendrier',$data);
            }
            $annee=$annee+1;
            for ($m=1;$m<$mois_rentree;$m++) {
                $data['modules'] = $this->Formation->modules_cal_tech($m,$annee,$tech);
                $data['mois'] = $tab_mois[$m];
                $data['annee'] = $annee;
                $this->load->view('stages_calendrier',$data);
            }
        }
        else {
            for ($m=date('n');$m<=12;$m++) {
                $data['modules'] = $this->Formation->modules_cal_tech($m,$annee,$tech);
                $data['mois'] = $tab_mois[$m];
                $data['annee'] = $annee;
                $this->load->view('stages_calendrier',$data);
            }
        }
/**/        
//        if ($detect->isMobile()) {
//            $this->load->view('m_actus_top', $data);     // Actualités "à la une"
//            $this->load->view('m_liste_actus', $data);   // La liste des actualités
//        } else {
//            $this->load->view('actus_top', $data);   // Actualités "à la une"
//            $this->load->view('videos', $data);      // Les vidéos
//            $this->load->view('liste_actus', $data); // La liste des actualités
//        }
        
        $this->load->view('footer',$data);            // Le pied de page
    }

/*
 * Recherche par technique (plusieurs techniqu, dans le formulaire de recherche)
 */
    function rech_form() {
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','email'));
        
        $recherche_tech=$_POST['recherche_tech'];
//        $detect = new Mobile_Detect;

        $this->load->model('Menus'); 
        $this->load->model('Formation');
        
        $data['menu'] = $this->Menus->pages_menu();         // Chargement du menu principal
        $data['techniques'] = $this->Formation->techniques();         // Recherche des techniques
        
        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        $data['dlfooter'] = $this->Menus->dl_footer();        // Liens de téléchargement du pied de page
        
        $this->load->view('header',$data);      // Entête de la page (contient le menu principal)
        $this->load->view('stages_liste',$data);
//        $this->load->view('stages_recherche',$data);
        
        $tab_mois=array (1=>'Janvier',2=>'Février',3=>'Mars',4=>'Avril',5=>'Mai',6=>'Juin',7=>'Juillet',8=>'Août',9=>'Septembre',10=>'Octobre',11=>'Novembre',12=>'Décembre');

        $annee=date('Y');
        $mois_rentree=9;
        if (date('n')>=$mois_rentree) {
            for ($m=date('n');$m<=12;$m++) {
                $data['modules'] = $this->Formation->modules_cal_tech($m,$annee,$recherche_tech);
                $data['mois'] = $tab_mois[$m];
                $data['annee'] = $annee;
                $this->load->view('stages_calendrier',$data);
            }
            $annee=$annee+1;
            for ($m=1;$m<$mois_rentree;$m++) {
                $data['modules'] = $this->Formation->modules_cal_tech($m,$annee,$recherche_tech);
                $data['mois'] = $tab_mois[$m];
                $data['annee'] = $annee;
                $this->load->view('stages_calendrier',$data);
            }
        }
        else {
            for ($m=date('n');$m<=12;$m++) {
                $data['modules'] = $this->Formation->modules_cal_tech($m,$annee,$recherche_tech);
                $data['mois'] = $tab_mois[$m];
                $data['annee'] = $annee;
                $this->load->view('stages_calendrier',$data);
            }
        }
/**/        
//        if ($detect->isMobile()) {
//            $this->load->view('m_actus_top', $data);     // Actualités "à la une"
//            $this->load->view('m_liste_actus', $data);   // La liste des actualités
//        } else {
//            $this->load->view('actus_top', $data);   // Actualités "à la une"
//            $this->load->view('videos', $data);      // Les vidéos
//            $this->load->view('liste_actus', $data); // La liste des actualités
//        }
        
        $this->load->view('footer',$data);            // Le pied de page
    }
    
    function cycle($code) {
        $this->load->helper(array('form', 'url'));
        $this->load->library(array('form_validation','email'));
        
//        $detect = new Mobile_Detect;

        $this->load->model('Menus'); 
        $this->load->model('Formation');
        
        $data['menu'] = $this->Menus->pages_menu();         // Chargement du menu principal
        $data['techniques'] = $this->Formation->techniques();         // Recherche des techniques
        
        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        $data['dlfooter'] = $this->Menus->dl_footer();        // Liens de téléchargement du pied de page
        
        $this->load->view('header',$data);      // Entête de la page (contient le menu principal)

        $data['cycle'] = $this->Formation->cycle_detail($code);
        $data['modules'] = $this->Formation->cycle_modules($code);
        $this->load->view('cycle_detail',$data);
        
        $this->load->view('footer',$data);            // Le pied de page
    }
   

}
?>
