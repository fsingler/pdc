<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Admin extends CI_Controller {
/*
 * Page d'accueil
 */
    function index() {
        $this->load->helper(array('form', 'url', 'date'));

        // Chargement de la librairie de validation des formulaires
        $this->load->library(array('form_validation', 'session'));
        
        if ($this->session->userdata('logged_in')==TRUE) redirect('admin/dashboard','location');
        else {

            // Délimiteurs de blocs pour l'affichage des erreurs
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

            // Règles des champs de formulaire
            $this->form_validation->set_rules('username', 'Utilisateur', 'required');
            $this->form_validation->set_rules('password', 'Mot de passe', 'required');

            $this->load->view('admin/header');      // Entête de la page (contient le menu principal)
            if ($this->form_validation->run() == FALSE) $this->load->view('admin/login'); // Le formulaire n'est pas rempli ou pas saisi correctement
            else { // Le fomulaire est valide
                $this->load->model('Login');
                $login = $this->Login->login($this->input->post('username'),$this->input->post('password'));

                if ($this->session->userdata('logged_in')==TRUE) {
                    $this->load->model('Blog');
                    $this->load->model('Organismes');
                    $this->load->model('Diplomes');
//                    $this->load->model('Videos');
//                    $this->load->model('Contenu');
//
//                    $data['top'] = $this->Actualites->top_actus_update();          // Chargement des actualités "à la une"
//                    $data['actus'] = $this->Actualites->dernieres_actus();  // Chargement de la liste des actualités
//                    $data['videos'] = $this->Videos->dernieres_videos();    // Chargement des vidéos
//                    $data['content'] = $this->Contenu->dernieres_pages();
                    $data['posts'] = $this->Blog->all_posts();          // Chargement des actualités
                    $data['organisme'] = $this->Organismes->affiche_orga($this->session->userdata('id_orga'));          // Chargement de l'organisme
                    $data['options'] = $this->Diplomes->options_organisme($this->session->userdata('id_orga'));
                    $data['liste_options'] = $this->Diplomes->liste_options();
                    

                    $this->load->view('admin/dashboard',$data); // Affichage de la validation du formulaire
                }
                else $this->load->view('admin/login');
            }

            $this->load->view('admin/footer');      // Le pied de page
        }
    }
 
   function logout() {
        $this->load->helper('url');
        $this->load->library('session');

        $this->session->sess_destroy();
        redirect('admin/index','location');
    }
    
    
/*
 * Tableau de bord
 */
    function dashboard() {
        $this->load->helper('url');
        $this->load->library('session');

        if ($this->session->userdata('logged_in')==FALSE) redirect('admin/index','location');
        else {
            $id_orga=$this->session->userdata('id_orga');
    //        $this->load->model('Menus'); 
            $this->load->model('Blog');
            $this->load->model('Organismes');
            $this->load->model('Diplomes');
//            $this->load->model('Videos');
//            $this->load->model('Contenu');
//
            $data['posts'] = $this->Blog->all_posts();          // Chargement des actualités
            $data['organisme'] = $this->Organismes->affiche_orga($id_orga);          // Chargement de l'organisme
            $data['options'] = $this->Diplomes->options_organisme($id_orga);
            $data['liste_options'] = $this->Diplomes->liste_options();

            $this->load->view('admin/header',$data);      // Entête de la page (contient le menu principal)
            $this->load->view('admin/dashboard',$data);
            $this->load->view('admin/footer');            // Le pied de page
        }
    }

/*
 * Modification d'un organisme
 */    
    function orga_updt($id_orga) {
        $this->load->helper(array('form', 'url', 'date'));

        // Chargement de la librairie de validation des formulaires
        $this->load->library(array('form_validation', 'session'));

        // Délimiteurs de blocs pour l'affichage des erreurs
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->session->userdata('logged_in')==FALSE) redirect('admin/index','location');
        else {
        
            // Réglages et appel du upload helper
            $config['upload_path'] ='./img/offres/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '2048';

            $this->load->library('upload', $config);

            // Règles des champs de formulaire
            $this->form_validation->set_rules('nom', 'Nom', 'required');
            $this->form_validation->set_rules('details', 'Détails', 'max_length[200]');
            $this->form_validation->set_rules('adresse1', 'Adresse', 'max_length[32000]');
            $this->form_validation->set_rules('adresse2', 'Complément d\'adresse', 'max_length[32000]');
            $this->form_validation->set_rules('code_postal', 'Code postal', 'max_length[6]');
            $this->form_validation->set_rules('ville', 'Ville', 'max_length[32000]');
            $this->form_validation->set_rules('tel', 'Téléphone', 'max_length[32000]');
            $this->form_validation->set_rules('web', 'Site web', 'max_length[150]');
            $this->form_validation->set_rules('description', 'Description', 'max_length[32000]');

            $this->load->model('Organismes');
            $data['organisme'] = $this->Organismes->affiche_orga($id_orga);
            $this->load->model('Diplomes');
            $data['options'] = $this->Diplomes->options_organisme($id_orga);
//            $data['diplomes'] = $this->Diplomes->organismes_diplomes($id_orga);
            $this->load->view('admin/header',$data);      // Entête de la page (contient le menu principal)
            if ($this->form_validation->run() == FALSE) $this->load->view('admin/orgaupdt',$data); // Le formulaire n'est pas rempli ou pas saisi correctement
            else { // Le fomulaire est valide
                if ( ! $this->upload->do_upload('image')){
                    $error = array('error' => $this->upload->display_errors());
                }
                else {
                    $data = array('upload_data' => $this->upload->data());
                }
//                $this->load->model('Db_save'); // Chargement du modèle pour l'enregistrement dans la BDD
                $this->Organismes->save_orga(); // Mise à jour de la page
                $this->load->model('Blog');
                $data['posts'] = $this->Blog->all_posts();
                $data['organisme'] = $this->Organismes->affiche_orga($id_orga);
                $data['ok'] = 'L\' organisme a bien été mis à jour';
                $this->load->view('admin/dashboard',$data); // Affichage de la validation du formulaire
            }
            $this->load->view('admin/footer');            // Le pied de page
        }
        
    }

/*
 * Ajout d'une option de diplôme
 */    
    function option_add($id_orga) {
        $this->load->helper(array('form', 'url', 'date'));

        // Chargement de la librairie de validation des formulaires
        $this->load->library(array('form_validation', 'session'));

        // Délimiteurs de blocs pour l'affichage des erreurs
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->session->userdata('logged_in')==FALSE) redirect('admin/index','location');
        else {
            // Règles des champs de formulaire
            $this->form_validation->set_rules('option', 'Option', 'required');
            $this->form_validation->set_rules('textes_officiels', 'Lien vers les textes officiels', 'max_length[245]');
            $this->form_validation->set_rules('metier_inma', 'Intitulé INMA', 'max_length[145]');
            $this->form_validation->set_rules('lien_inma', 'Lien fiche métier INMA', 'max_length[145]');
            $this->form_validation->set_rules('texte', 'Texte complémentaire', 'max_length[32000]');

            $this->load->model('Organismes');
            $data['organisme'] = $this->Organismes->affiche_orga($id_orga);
            $this->load->model('Diplomes');
            $data['options'] = $this->Diplomes->options_organisme($id_orga);
            $data['diplomes'] = $this->Diplomes->liste_diplomes();
//            $data['diplomes'] = $this->Diplomes->organismes_diplomes($id_orga);
            $this->load->view('admin/header',$data);      // Entête de la page (contient le menu principal)
            if ($this->form_validation->run() == FALSE) $this->load->view('admin/optionadd',$data); // Le formulaire n'est pas rempli ou pas saisi correctement
            else { // Le fomulaire est valide
                $this->Diplomes->option_add(); // Ajout du diplôme
                $this->load->model('Blog');
                $data['posts'] = $this->Blog->all_posts();
                $data['liste_options'] = $this->Diplomes->liste_options();
                $data['ok'] = 'Le diplôme a été ajouté';
                $this->load->view('admin/dashboard',$data); // Affichage de la validation du formulaire
            }
            $this->load->view('admin/footer');            // Le pied de page
            
        }
        
    }

/*
 * Modification d'une option de diplôme
 */    
    function option_updt($id_option,$id_orga) {
        $this->load->helper(array('form', 'url', 'date'));

        // Chargement de la librairie de validation des formulaires
        $this->load->library(array('form_validation', 'session'));

        // Délimiteurs de blocs pour l'affichage des erreurs
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->session->userdata('logged_in')==FALSE) redirect('admin/index','location');
        else {
            // Règles des champs de formulaire
            $this->form_validation->set_rules('option', 'Option', 'required');
            $this->form_validation->set_rules('textes_officiels', 'Lien vers les textes officiels', 'max_length[245]');
            $this->form_validation->set_rules('metier_inma', 'Intitulé INMA', 'max_length[145]');
            $this->form_validation->set_rules('lien_inma', 'Lien fiche métier INMA', 'max_length[145]');
            $this->form_validation->set_rules('texte', 'Texte complémentaire', 'max_length[32000]');

            $this->load->model('Organismes');
            $data['organisme'] = $this->Organismes->affiche_orga($id_orga);
            $this->load->model('Diplomes');
            $data['option'] = $this->Diplomes->affiche_option($id_option);
            $data['diplomes'] = $this->Diplomes->liste_diplomes();
//            $data['diplomes'] = $this->Diplomes->organismes_diplomes($id_orga);
            $this->load->view('admin/header',$data);      // Entête de la page (contient le menu principal)
            if ($this->form_validation->run() == FALSE) $this->load->view('admin/optionupdt',$data); // Le formulaire n'est pas rempli ou pas saisi correctement
            else { // Le fomulaire est valide
                $this->Diplomes->option_updt(); // Ajout du diplôme
                $this->load->model('Blog');
                $data['posts'] = $this->Blog->all_posts();
                $data['options'] = $this->Diplomes->options_organisme($id_orga);
                $data['liste_options'] = $this->Diplomes->liste_options();
                $data['ok'] = 'Le diplôme a été modifié';
                $this->load->view('admin/dashboard',$data); // Affichage de la validation du formulaire
            }
            $this->load->view('admin/footer');            // Le pied de page
            
        }
        
    }
    
/*
 * Suppression d'une option de diplôme
 */
    function option_suppr($id_option,$id_orga) {
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library('session');

        if ($this->session->userdata('logged_in')==FALSE) redirect('admin/index','location');
        else {
            $this->load->model('Diplomes');
            $data['options'] = $this->Diplomes->option_suppr($id_option,$id_orga);
            $this->load->view('admin/header',$data);      // Entête de la page (contient le menu principal)
                $this->load->model('Organismes');
                $data['organisme'] = $this->Organismes->affiche_orga($id_orga);
                $this->load->model('Diplomes');
                $data['options'] = $this->Diplomes->options_organisme($id_orga);
                $data['liste_options'] = $this->Diplomes->liste_options();
                $this->load->model('Blog');
                $data['posts'] = $this->Blog->all_posts();
                $data['ok'] = 'Diplôme supprimé';
                $this->load->view('admin/dashboard',$data); // Affichage de la validation du formulaire
            $this->load->view('admin/footer');            // Le pied de page

            //redirect('/admin/listeactus');
        }
    }

/*
 * Ajout d'une option de diplôme
 */    
    function orga_option_add($id_orga) {
        $this->load->helper(array('form', 'url', 'date'));

        // Chargement de la librairie de validation des formulaires
        $this->load->library(array('form_validation', 'session'));

        // Délimiteurs de blocs pour l'affichage des erreurs
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->session->userdata('logged_in')==FALSE) redirect('admin/index','location');
        else {
            // Règles des champs de formulaire
            $this->form_validation->set_rules('description', 'Texte complémentaire', 'max_length[32000]');

            $this->load->model('Organismes');
            $data['organisme'] = $this->Organismes->affiche_orga($id_orga);
            $this->load->model('Diplomes');
            $data['diplomes'] = $this->Diplomes->liste_diplomes();
            $data['liste_options'] = $this->Diplomes->liste_options();
//            $data['diplomes'] = $this->Diplomes->organismes_diplomes($id_orga);
            $this->load->view('admin/header',$data);      // Entête de la page (contient le menu principal)
            if ($this->form_validation->run() == FALSE) $this->load->view('admin/orgaoptionadd',$data); // Le formulaire n'est pas rempli ou pas saisi correctement
            else { // Le fomulaire est valide
                $this->Diplomes->orga_option_add(); // Ajout du diplôme
                $this->load->model('Blog');
                $data['posts'] = $this->Blog->all_posts();
                $data['options'] = $this->Diplomes->options_organisme($id_orga);
//                $data['liste_options'] = $this->Diplomes->liste_options();
                $data['ok'] = 'Le diplôme a été ajouté';
                $this->load->view('admin/dashboard',$data); // Affichage de la validation du formulaire
            }
            $this->load->view('admin/footer');            // Le pied de page
            
        }
        
    }

/*
 * Modification d'une option de diplôme
 */    
    function orga_option_updt($id_option,$id_diplome,$id_orga) {
        $this->load->helper(array('form', 'url', 'date'));

        // Chargement de la librairie de validation des formulaires
        $this->load->library(array('form_validation', 'session'));

        // Délimiteurs de blocs pour l'affichage des erreurs
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

        if ($this->session->userdata('logged_in')==FALSE) redirect('admin/index','location');
        else {
            // Règles des champs de formulaire
//            $this->form_validation->set_rules('id_diplome', 'Diplôme', 'required');
//            $this->form_validation->set_rules('id_option', 'Option', 'required');
            $this->form_validation->set_rules('description', 'Description', 'max_length[32000]');

            $this->load->model('Organismes');
            $data['organisme'] = $this->Organismes->affiche_orga($id_orga);
            $this->load->model('Diplomes');
//            $data['option'] = $this->Diplomes->affiche_option($id_option);
            $data['diplomes'] = $this->Diplomes->liste_diplomes();
            $data['liste_options'] = $this->Diplomes->liste_options();
//            $data['diplome_option'] = $this->Diplomes->diplome_option($id_diplome,$id_option);
            $data['orga_diplome_option'] = $this->Diplomes->organisme_diplome_option($id_diplome,$id_option,$id_orga);

//            $data['diplomes'] = $this->Diplomes->organismes_diplomes($id_orga);
            $this->load->view('admin/header',$data);      // Entête de la page (contient le menu principal)
            if ($this->form_validation->run() == FALSE) $this->load->view('admin/orgaoptionupdt',$data); // Le formulaire n'est pas rempli ou pas saisi correctement
            else { // Le fomulaire est valide
                $this->Diplomes->orga_option_updt(); // Ajout du diplôme
                $this->load->model('Blog');
                $data['posts'] = $this->Blog->all_posts();
                $data['options'] = $this->Diplomes->options_organisme($id_orga);
//                $data['liste_options'] = $this->Diplomes->liste_options();
                $data['ok'] = 'Le diplôme a été modifié';
                $this->load->view('admin/dashboard',$data); // Affichage de la validation du formulaire
            }
            $this->load->view('admin/footer');            // Le pied de page
            
        }
        
    }
    
/*
 * Suppression d'un diplôme d'organisme
 */
    function orga_option_suppr($id_option,$id_orga,$id_diplome) {
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library('session');

        if ($this->session->userdata('logged_in')==FALSE) redirect('admin/index','location');
        else {
            $this->load->model('Diplomes');
            $data['options'] = $this->Diplomes->orga_option_suppr($id_option,$id_diplome,$id_orga);
            $this->load->view('admin/header',$data);      // Entête de la page (contient le menu principal)
                $this->load->model('Organismes');
                $data['organisme'] = $this->Organismes->affiche_orga($id_orga);
                $this->load->model('Diplomes');
                $data['options'] = $this->Diplomes->options_organisme($id_orga);
                $data['liste_options'] = $this->Diplomes->liste_options();
                $this->load->model('Blog');
                $data['posts'] = $this->Blog->all_posts();
                $data['ok'] = 'Diplôme supprimé';
                $this->load->view('admin/dashboard',$data); // Affichage de la validation du formulaire
            $this->load->view('admin/footer');            // Le pied de page

            //redirect('/admin/listeactus');
        }
    }
    
/*
 * Ajout d'une actualité
 */
    function actu_add() {
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library('session');

        if ($this->session->userdata('logged_in')==FALSE) redirect('admin/index','location');
        else {

            // Chargement de la librairie de validation des formulaires
            $this->load->library('form_validation');

            // Délimiteurs de blocs pour l'affichage des erreurs
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

            // Réglages et appel du upload helper
            $config['upload_path'] ='./img/blog/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '2048';

            $this->load->library('upload', $config);


            // Règles des champs de formulaire
            $this->form_validation->set_rules('titre', 'Titre', 'required');
//            $this->form_validation->set_rules('date', 'Date', 'required');
            $this->form_validation->set_rules('resume', 'Résumé', 'max_length[32000]');
            $this->form_validation->set_rules('texte', 'Texte', 'max_length[32000]');
//            $this->form_validation->set_rules('alt_image', 'Texte image', 'max_length[100]');

            // Chargement des modeles
            $this->load->model('Blog');
            // Execution des requêtes
//            $data['post'] = $this->Blog->affiche_post($id_post);
            
            // Affichage du formulaire
            $this->load->view('admin/header');      // Entête de la page (contient le menu principal)
            if ($this->form_validation->run() == FALSE) $this->load->view('admin/actuadd'); // Le formulaire n'est pas rempli ou pas saisi correctement
            else { // Le fomulaire est valide
                if ( ! $this->upload->do_upload('image')){
                    $error = array('error' => $this->upload->display_errors());
                }
                else {
                    $data = array('upload_data' => $this->upload->data());
                }
                $id_post=$this->Blog->add_post();
                $data['post'] = $this->Blog->affiche_post($id_post);
                $this->load->view('post',$data); // Affichage de la validation du formulaire
                $this->load->view('admin/actupublish',$data);
                $this->load->view('admin/actuupdt',$data); // Affichage de la validation du formulaire
                
//                $this->Db_save->update_actu(); // Mise à jour de la page
//                $data['db']=array('type'=>'actu','action'=>'edit');
//                $this->load->view('save_success',$data); // Affichage de la validation du formulaire
            }

            $this->load->view('admin/footer');      // Le pied de page
        }
    }
    
/*
 * Modification d'une actualité
 */
    function actu_updt($id_post) {
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library('session');

        if ($this->session->userdata('logged_in')==FALSE) redirect('admin/index','location');
        else {

            // Chargement de la librairie de validation des formulaires
            $this->load->library('form_validation');

            // Délimiteurs de blocs pour l'affichage des erreurs
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

            // Réglages et appel du upload helper
            $config['upload_path'] ='./img/blog/';
            $config['allowed_types'] = 'gif|jpg|png';
            $config['max_size']	= '2048';

            $this->load->library('upload', $config);


            // Règles des champs de formulaire
            $this->form_validation->set_rules('titre', 'Titre', 'required');
//            $this->form_validation->set_rules('date', 'Date', 'required');
            $this->form_validation->set_rules('resume', 'Résumé', 'max_length[32000]');
            $this->form_validation->set_rules('texte', 'Texte', 'max_length[32000]');
//            $this->form_validation->set_rules('alt_image', 'Texte image', 'max_length[100]');

            // Chargement des modeles
            $this->load->model('Blog');
            // Execution des requêtes
            $data['post'] = $this->Blog->affiche_post($id_post);
            
            // Affichage du formulaire
            $this->load->view('admin/header');      // Entête de la page (contient le menu principal)
            if ($this->form_validation->run() == FALSE) $this->load->view('admin/actuupdt',$data); // Le formulaire n'est pas rempli ou pas saisi correctement
            else { // Le fomulaire est valide
                if ( ! $this->upload->do_upload('image')){
                    $error = array('error' => $this->upload->display_errors());
                }
                else {
                    $data = array('upload_data' => $this->upload->data());
                }
                $this->Blog->updt_post();
                $data['post'] = $this->Blog->affiche_post($id_post);
                $this->load->view('post',$data); // Affichage de la validation du formulaire
                $this->load->view('admin/actupublish',$data);
                $this->load->view('admin/actuupdt',$data); // Affichage de la validation du formulaire
                
//                $this->Db_save->update_actu(); // Mise à jour de la page
//                $data['db']=array('type'=>'actu','action'=>'edit');
//                $this->load->view('save_success',$data); // Affichage de la validation du formulaire
            }

            $this->load->view('admin/footer');      // Le pied de page
        }
    }
    
/*
 * Prévisualisation de l'actualité
 */    
    function actu_publish($id_post) {
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library('session');

        if ($this->session->userdata('logged_in')==FALSE) redirect('admin/index','location');
        else {

            // Chargement de la librairie de validation des formulaires
            $this->load->library('form_validation');

            // Délimiteurs de blocs pour l'affichage des erreurs
            $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
            // Chargement des modeles
            $this->load->model('Blog');
            // Affichage du formulaire
            $this->load->view('admin/header');      // Entête de la page (contient le menu principal)

            $id_orga=$this->session->userdata('id_orga');
                $this->Blog->publish_post($id_post);
                $this->load->model('Organismes');
                $this->load->model('Diplomes');

                $data['posts'] = $this->Blog->all_posts();          // Chargement des actualités
                $data['organisme'] = $this->Organismes->affiche_orga($id_orga);          // Chargement de l'organisme
                $data['options'] = $this->Diplomes->options_organisme($id_orga);
                $data['liste_options'] = $this->Diplomes->liste_options();
                $data['ok'] = 'Actualité publiée';

                $this->load->view('admin/dashboard',$data);
            

            $this->load->view('admin/footer');      // Le pied de page
        }
        
    }
    
/*
 * Suppression d'une actualité
 */
    function actu_suppr($id_post) {
        $this->load->helper(array('form', 'url', 'date'));
        $this->load->library('session');

        if ($this->session->userdata('logged_in')==FALSE) redirect('admin/index','location');
        else {
            $this->load->model('Blog');
            $this->Blog->sup_post($id_post);
            $id_orga=$this->session->userdata('id_orga');

//            $data['options'] = $this->Diplomes->orga_option_suppr($id_option,$id_diplome,$id_orga);
                $this->load->model('Organismes');
                $data['organisme'] = $this->Organismes->affiche_orga($id_orga);
                $this->load->view('admin/header',$data);      // Entête de la page (contient le menu principal)
                $this->load->model('Diplomes');
                $data['options'] = $this->Diplomes->options_organisme($id_orga);
                $data['liste_options'] = $this->Diplomes->liste_options();
                $this->load->model('Blog');
                $data['posts'] = $this->Blog->all_posts();
                $data['ok'] = 'Actualité supprimée';
                $this->load->view('admin/dashboard',$data); // Affichage de la validation du formulaire
            $this->load->view('admin/footer');            // Le pied de page
        }
    }

    
    
}
    
?>