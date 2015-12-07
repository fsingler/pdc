<?php
/* Pages de contenu */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
    }   

    function login($username,$password) {
        $password=md5($password);
        
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $this->db->from('organismes');
        $nbres = $this->db->count_all_results();
        
        if ($nbres>0) {
            $login=1;
            $conditions = array('username' => $username, 'password' => $password);
            $query = $this->db->get_where('organismes', $conditions);

            foreach ($query->result() as $row) {
                $sessiondata = array('username'  => $username, 'nom' => $row->nom, 'id_orga' => $row->id_orga,'logged_in' => TRUE);
            }
            $this->session->set_userdata($sessiondata);
            
        }
        else {//$query = $this->db->query("SELECT * FROM ".$this->db->dbprefix('pages')." WHERE id_page=$id_page or parent=$id_page order by ordre");
            $login=0;
        }
        return $login;
    }
    
}
?>