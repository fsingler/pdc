<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Forms extends CI_Controller {
/*
 * Page de recherche
 */
    function index() {
        $this->load->helper('url');

        $this->load->model('Menus'); 
        $this->load->model('Actualites');
//        $this->load->model('Videos');
//        $this->load->model('Contenu');
        $this->load->model('Recherche');
        
        $data['menu'] = $this->Menus->pages_menu();         // Chargement du menu principal
        $data['top'] = $this->Actualites->top_actus();      // Chargement des actualités "à la une"
//        $data['actus'] = $this->Actualites->liste_actus();  // Chargement de la liste des actualités
//        $data['videos'] = $this->Videos->videos_accueil();  // Chargement des vidéos
        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        $data['dlfooter'] = $this->Menus->dl_footer();        // Liens de téléchargement du pied de page
        
        
        $this->load->view('header',$data);      // Entête de la page (contient le menu principal)
        $this->load->view('actus_top',$data);   // Actualités "à la une"
//        $this->load->view('videos',$data);      // Les vidéos
//        $this->load->view('liste_actus',$data); // La liste des actualités
        $this->load->view('footer',$data);            // Le pied de page
    }

    
    function recherche() {
        $this->load->helper('url');

        $this->load->model('Menus'); 
//        $this->load->model('Actualites');
//        $this->load->model('Videos');
//        $this->load->model('Contenu');
        $this->load->model('Recherche');
        
        $data['menu'] = $this->Menus->pages_menu();         // Chargement du menu principal
        $data['actus'] = $this->Recherche->recherche_actus($this->input->post('search'));
        $data['pages'] = $this->Recherche->recherche_pages($this->input->post('search'));
        $data['categories'] = $this->Menus->menu_top();
//        $data['top'] = $this->Actualites->top_actus();      // Chargement des actualités "à la une"
//        $data['actus'] = $this->Actualites->liste_actus();  // Chargement de la liste des actualités
//        $data['videos'] = $this->Videos->videos_accueil();  // Chargement des vidéos
        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        $data['dlfooter'] = $this->Menus->dl_footer();        // Liens de téléchargement du pied de page
        
        
        $this->load->view('header',$data);      // Entête de la page (contient le menu principal)
        $this->load->view('search_result',$data); // Resultats des recherches
        
//        $this->load->view('actus_top',$data);   // Actualités "à la une"
//        $this->load->view('videos',$data);      // Les vidéos
//        $this->load->view('liste_actus',$data); // La liste des actualités
        $this->load->view('footer',$data);            // Le pied de page
    }

    function newsletter_inscription() {
        $this->load->helper(array('form', 'url', 'date', 'file'));
        $this->load->library(array('form_validation','email'));
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        $config['protocol'] = 'sendmail';
//        $config['mailpath'] = 'C:\wamp\sendmail\sendmail.exe';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);

        $this->load->model('Menus'); 
        
        $data['menu'] = $this->Menus->pages_menu();         // Chargement du menu principal
        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        $data['dlfooter'] = $this->Menus->dl_footer();        // Liens de téléchargement du pied de page
         
        $this->form_validation->set_rules('inscript', 'Email', 'required|valid_email');
        
        $this->load->view('header',$data);      // Entête de la page (contient le menu principal)
 //       echo $this->email->print_debugger();
        if ($this->form_validation->run() == FALSE) $this->load->view('newsletter_error',$data); // Le formulaire n'est pas rempli ou pas saisi correctement
        else {
            $data['email']=$this->input->post('inscript');
            $this->email->from('webmaster@cerfav.fr', 'cerfav.fr');
            $this->email->to('fanny.guenzi@cerfav.fr'); 
//          $this->email->cc('another@another-example.com'); 
//          $this->email->bcc('them@their-example.com'); 
            $this->email->subject('Inscription Newsletter Cerfav');
            $this->email->message("Nouvelle insciption à la newsletter !\n".$this->input->post('inscript'));	
            $this->email->send();

            $this->load->view('newsletter_valid',$data);
            
            $datefile=mdate("%d/%m/%Y %H:%i");
            if ( ! write_file('./log/newsletter.csv', "$datefile;".$this->input->post('inscript')."\n",'a+')) {
                 echo 'Ecriture du fichier impossible';
            }
            
        }
        $this->load->view('footer',$data);            // Le pied de page
    }
    
    function contact() {
        $this->load->helper(array('form', 'url', 'date', 'file'));
        $this->load->library(array('form_validation','email'));
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        $config['protocol'] = 'sendmail';
//        $config['mailpath'] = 'C:\wamp\sendmail\sendmail.exe';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);

        $this->load->model('Menus'); 
        
        $data['menu'] = $this->Menus->pages_menu();         // Chargement du menu principal
        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        $data['dlfooter'] = $this->Menus->dl_footer();        // Liens de téléchargement du pied de page
         
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('nom', 'Nom', 'required|max_length[100]');
        $this->form_validation->set_rules('prenom', 'Prénom', 'required|max_length[100]');
        $this->form_validation->set_rules('adresse', 'Adresse', 'max_length[100]');
        $this->form_validation->set_rules('cp', 'Code postal', 'max_length[100]');
        $this->form_validation->set_rules('ville', 'Ville', 'max_length[100]');
        $this->form_validation->set_rules('tel', 'Téléphone', 'max_length[30]');
        $this->form_validation->set_rules('portable', 'Portable', 'max_length[30]');
//        $this->form_validation->set_rules('fax', 'Fax', 'max_length[30]');
        $this->form_validation->set_rules('nationalite', 'Nationalité', 'max_length[100]');
        $this->form_validation->set_rules('age', 'Age', 'max_length[3]');
        $this->form_validation->set_rules('statut', 'Statut', 'max_length[100]');
        $this->form_validation->set_rules('parcours', 'Parcours scolaire', 'max_length[32000]');
        $this->form_validation->set_rules('projet', 'Projet à l\'issue de la formation', 'max_length[32000]');
        $this->form_validation->set_rules('technique', 'Techniques verrières qui vous intéressent', 'max_length[32000]');
        $this->form_validation->set_rules('formations', 'Formations envisagées', 'max_length[32000]');
        $this->form_validation->set_rules('demande', 'Votre demande', 'max_length[32000]');

        $this->load->view('header',$data);      // Entête de la page (contient le menu principal)
 //       echo $this->email->print_debugger();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('form_contact',$data); // Le formulaire n'est pas rempli ou pas saisi correctement
        }
        else {
            $data['email']=$this->input->post('inscript');
            $this->email->from('webmaster@cerfav.fr', 'cerfav.fr');
            $this->email->to('annabelle.babel@cerfav.fr'); 
//          $this->email->cc('another@another-example.com'); 
//          $this->email->bcc('them@their-example.com'); 
            $this->email->subject('Demande de renseignements depuis cerfav.fr');
            $message="Coordonnées\n\n".$this->input->post('nom')." ".$this->input->post('prenom')."\n".$this->input->post('adresse')."\n".$this->input->post('cp')." ".$this->input->post('ville')."\nTél : ".$this->input->post('tel')."\nPortable : ".$this->input->post('portable')."\nE-mail : ".$this->input->post('email')."\n";
            $message.="\nRenseignements complémentaires\n\nNationalité : ".$this->input->post('nationalite')."\nAge : ".$this->input->post('age')."\nStatut : ".$this->input->post('statut')."\n";
            $message.="Parcours scolaire :\n".$this->input->post('parcours')."\n\n";
            $message.="Projet à l'issue de la formation :\n".$this->input->post('projet')."\n\n";
            $message.="Techniques verrières :\n".$this->input->post('technique')."\n\n";
            $message.="Type de formation envisagée :\n".$this->input->post('formations')."\n\n";
            $message.="Demandes :\n".$this->input->post('demande')."\n\n";
            $this->email->message($message);	
            $this->email->send();
            
            $datefile=mdate("Reçu le %d/%m/%Y à %H:%i");
            if ( ! write_file('./log/contact.txt', "\n\n--------------------------------------\n\n$datefile\n\n".$message,'a+')) {
                 echo 'Ecriture du fichier impossible';
            }
            
            $this->load->view('form_contact_valid',$data);
        }
        $this->load->view('footer',$data);            // Le pied de page
        
    }

    function sablage() {
        $this->load->helper(array('form', 'url', 'date','file'));
        $this->load->library(array('form_validation','email'));
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        // Réglages et appel du upload helper
        $config['upload_path'] ='./img/mails/';
        $config['allowed_types'] = 'tif|tiff|gif|jpg|png|pdf|svg|ai|eps';
        $config['max_size']	= '2048';

        $this->load->library('upload', $config);
        
        
        $config['protocol'] = 'sendmail';
//        $config['mailpath'] = 'C:\wamp\sendmail\sendmail.exe';
        $config['charset'] = 'utf-8';
        $config['wordwrap'] = TRUE;
        $this->email->initialize($config);

        $this->load->model('Menus'); 
        
        $data['menu'] = $this->Menus->pages_menu();         // Chargement du menu principal
        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        $data['dlfooter'] = $this->Menus->dl_footer();        // Liens de téléchargement du pied de page
         
        $this->form_validation->set_rules('email', 'E-mail', 'required|valid_email');
        $this->form_validation->set_rules('entreprise', 'Entreprise', 'required|max_length[100]');
        $this->form_validation->set_rules('nom', 'Nom', 'required|max_length[100]');
        $this->form_validation->set_rules('prenom', 'Prénom', 'required|max_length[100]');
        $this->form_validation->set_rules('adresse', 'Adresse', 'required|max_length[100]');
        $this->form_validation->set_rules('cp', 'Code postal', 'required|max_length[100]');
        $this->form_validation->set_rules('ville', 'Ville', 'required|max_length[100]');
        $this->form_validation->set_rules('tel', 'Téléphone', 'max_length[30]');
        $this->form_validation->set_rules('dimensions', 'Dimensions du pochoir de sablage', 'required|max_length[100]');
        $this->form_validation->set_rules('nombre', 'Nombre de pochoirs', 'required|max_length[5]');
        $this->form_validation->set_rules('sens', 'Sens du pochoir', 'required');
        $this->form_validation->set_rules('dessin', 'Le pochoir est-il comme sur le dessin', 'required');
        $this->form_validation->set_rules('utilisation', 'Utilisation du pochoir', 'required');
        $this->form_validation->set_rules('commentaire', 'Commentaire', 'max_length[32000]');
        $this->form_validation->set_rules('pj', 'Pièce jointe', 'max_length[500]');
        $this->form_validation->set_rules('type_fichier', 'Type de fichier', 'max_length[50]');
       
        $this->load->view('header',$data);      // Entête de la page (contient le menu principal)
 //       echo $this->email->print_debugger();
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('form_sablage',$data); // Le formulaire n'est pas rempli ou pas saisi correctement
        }
        else {
            if ( ! $this->upload->do_upload('pj')){
                    $error = array('error' => $this->upload->display_errors());
                }
                else {
                    $data = array('upload_data' => $this->upload->data());
                }
            
            $data['email']=$this->input->post('inscript');
            $this->email->from('webmaster@cerfav.fr', 'cerfav.fr');
            $this->email->to('philippe.laurent@cerfav.fr'); 
//          $this->email->cc('another@another-example.com'); 
//          $this->email->bcc('them@their-example.com'); 
            $this->email->subject('Réalisation de pochoirs de sablage');

            $upload_data = $this->upload->data();
            $attach=$config['upload_path'].$upload_data['file_name'];
            if ($upload_data['file_name']<>'') $this->email->attach($attach);
                
            $message="Coordonnées\n----------\n\n".$this->input->post('entreprise')."\n".$this->input->post('nom')." ".$this->input->post('prenom')."\n".$this->input->post('adresse')."\n".$this->input->post('cp')." ".$this->input->post('ville')."\nTél : ".$this->input->post('tel')."\nE-mail : ".$this->input->post('email')."\n";
            $message.="\n\nPochoir\n-------\n\nDimensions : ".$this->input->post('dimensions')."\nNombre : ".$this->input->post('nombre')."\nSens : ".$this->input->post('sens')."\n";
            $message.="Le pochoir est comme sur le dessin : ".$this->input->post('dessin')."\nUtilisé pour : ".$this->input->post('utilisation')."\n\n";
            $message.="Commentaire :\n".$this->input->post('commentaire')."\n\n";
            $message.="Pièce jointe\n------------\n\n";
            $message.="Fichier : http://www.cerfav.fr/img/mails/".$upload_data['file_name']."\n";
            $message.="Type de fichier : ".$this->input->post('type_fichier')."\n\n";
            $this->email->message($message);

            $this->email->send();
            
            $datefile=mdate("Reçu le %d/%m/%Y à %H:%i");
            if ( ! write_file('./log/sablage.txt', "\n\n--------------------------------------\n\n$datefile\n\n".$message,'a+')) {
                 echo 'Ecriture du fichier impossible';
            }
            
            $this->load->view('form_sablage_valid',$data);
        }
        $this->load->view('footer',$data);            // Le pied de page
        
    }

}
?>