<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Ressources extends CI_Controller {

    function index() {
        $this->load->helper('url');
        $this->load->model('Menus');
        $data = array('link_fb' => array(), 'actu_fablab' => array(), 'actu_avoir' => array(), 'actu_comm' => array(), 'rd' => array(), 'rech' => array(), 'veille' => array(), 'menu' => $this->Menus->pages_menu());
        $data['menu'] = $this->Menus->pages_menu();
        $url = "https://graph.facebook.com/cerfav.fr/feed?limit=1&access_token=1486915048206891|IrtgvdCYRkD5zx6VqalWiZxeOho";
        $url = file_get_contents($url);
        $url = json_decode($url);
        $url = $url->data;

        foreach ($url as $row) {
            $id = explode('_', $row->id);
            $link = 'https://facebook.com/cerfav.fr/posts/' . $id[1];
            array_push($data['link_fb'], $link);
        }
        $url = simplexml_load_file('http://www.cerfav.fr/fablab/feed/');
        $i = 0;
        foreach ($url->channel->item as $row) {
            if ($i < 5) {
                $actu['title'] = $row->title;
                $actu['description'] = $row->description;
                $actu['link'] = $row->link;
                array_push($data['actu_fablab'], $actu);
                $i++;
            }
        }

        $url = simplexml_load_file('http://www.idverre.net/rss_avoir.xml');
        $i = 0;
        foreach ($url->channel->item as $row) {
            if ($i < 3) {
                $actu['title'] = $row->title;
                $actu['description'] = $row->description;
                $actu['link'] = $row->link;
                array_push($data['actu_avoir'], $actu);
                $i++;
            }
        }

        $url = simplexml_load_file('http://www.idverre.net/rss_communication.xml');
        $i = 0;
        foreach ($url->channel->item as $row) {
            if ($i < 3) {
                $actu['title'] = $row->title;
                $actu['description'] = $row->description;
                $actu['link'] = $row->link;
                array_push($data['actu_comm'], $actu);
                $i++;
            }
        }

        $url = simplexml_load_file('http://www.idverre.net/rss_rd.xml');
        $i = 0;
        foreach ($url->channel->item as $row) {
            if ($i < 3) {
                $actu['title'] = $row->title;
                $actu['description'] = $row->description;
                $actu['link'] = $row->link;
                array_push($data['rd'], $actu);
                $i++;
            }
        }

        $url = simplexml_load_file('http://www.idverre.net/rss_rech.xml');
        $i = 0;
        foreach ($url->channel->item as $row) {
            if ($i < 3) {
                $actu['title'] = $row->title;
                $actu['description'] = $row->description;
                $actu['link'] = $row->link;
                array_push($data['rech'], $actu);
                $i++;
            }
        }

        $url = simplexml_load_file('http://www.idverre.net/rss_veille.xml');
        $i = 0;
        foreach ($url->channel->item as $row) {
            if ($i < 3) {
                $actu['title'] = $row->title;
                $actu['description'] = $row->description;
                $actu['link'] = $row->link;
                array_push($data['veille'], $actu);
                $i++;
            }
        }
        $this->load->model('Annonce_idverre');
        $data['p_annonces'] = $this->Annonce_idverre->last_annonces();


        $this->load->view('header', $data);
        $this->load->view('ressources', $data);
        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        $data['dlfooter'] = $this->Menus->dl_footer();        // Liens de téléchargement du pied de page
        $this->load->view('footer',$data);
    }

    function all_p_annonces() {

        $this->load->helper('url');
        $this->load->model('Menus');

        $data = array('p_annonces' => array(), 'menu' => $this->Menus->pages_menu());
        $this->load->model('Annonce_idverre');


        $this->load->library('pagination');
        $config['base_url'] = base_url('ressources/petites-annonces');
        $config['total_rows'] = $this->Annonce_idverre->count_p_announces();
        $config['per_page'] = 10;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        if ($this->uri->segment(3)) {
            $page = $this->uri->segment(3);
            $id = 0;
        } else {
            $page = 0;
            $id = 0;
        }
        $data['links']  = $this->pagination->create_links();
        $data['p_annonces'] = $this->Annonce_idverre->all_annonces($config["per_page"], $page);
        $this->load->view('header', $data);
        $this->load->view('petites_annonces', $data);
        $data['footer'] = $this->Menus->menu_footer();        // Liens du pied de page
        $data['dlfooter'] = $this->Menus->dl_footer();        // Liens de téléchargement du pied de page
        $this->load->view('footer',$data);
    }

}
