<?php
/* Les vidéos */
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Videos extends CI_Model {

   function videos_accueil() {
        // Dimensions des vidéos
        $largeur='516';
        $hauteur='288';
        
        $this->db->order_by('id_video','desc');
        $query = $this->db->get('videos', 3);
        
        $videos=array();
        
        foreach ($query->result() as $row) {
            switch ($row->origine) {
                case 'youtube' : // Vidéo hébergée sur Youtube
                    $videos[$row->id_video]['lien']=$row->lien;
                    $videos[$row->id_video]['titre']=$row->titre;
                    $videos[$row->id_video]['image']='http://img.youtube.com/vi/'.$row->lien.'/0.jpg';
                    $videos[$row->id_video]['embed']='<iframe width="'.$largeur.'" height="'.$hauteur.'" src="http://www.youtube.com/embed/'.$row->lien.'" frameborder="0" allowfullscreen></iframe>';
                    
                    break;
                case 'vimeo' : // Vidéo hebergée sur Vimeo
                    $videos[$row->id_video]['lien']=$row->lien;
                    $videos[$row->id_video]['titre']=$row->titre;
                    $idvimeo=$row->lien;
                    $datavid = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$idvimeo.php"));
                    $videos[$row->id_video]['image']=$datavid[0]['thumbnail_small'];
                    $videos[$row->id_video]['embed']='<iframe src="http://player.vimeo.com/video/'.$row->lien.'" width="'.$largeur.'" height="'.$hauteur.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';

                    break;
                case 'flickr' : // Diaporama Flickr
                    $videos[$row->id_video]['lien']=$row->lien;
                    $videos[$row->id_video]['titre']=$row->titre;

                    $pos1=strpos($row->lien,'/sets/');
                    $pos2=strpos($row->lien,'/show/with/');

                    $album=substr($row->lien,$pos1+6,$pos2-$pos1-6);
                    $photo=substr($row->lien,$pos2+11,-1);

                    $videos[$row->id_video]['image']='';
                    $videos[$row->id_video]['embed']='<object width="'.$largeur.'" height="'.$hauteur.'"> <param name="flashvars" value="offsite=true&lang=fr-fr&page_show_url=%2Fphotos%2F27807374%40N05%2Fsets%2F'.$album.'%2Fshow%2Fwith%2F'.$photo.'%2F&page_show_back_url=%2Fphotos%2F27807374%40N05%2Fsets%2F'.$album.'%2Fwith%2F'.$photo.'%2F&set_id='.$album.'&jump_to='.$photo.'"></param> <param name="movie" value="http://www.flickr.com/apps/slideshow/show.swf?v=140556"></param> <param name="allowFullScreen" value="true"></param><embed type="application/x-shockwave-flash" src="http://www.flickr.com/apps/slideshow/show.swf?v=140556" allowFullScreen="true" flashvars="offsite=true&lang=fr-fr&page_show_url=%2Fphotos%2F27807374%40N05%2Fsets%2F'.$album.'%2Fshow%2Fwith%2F'.$photo.'%2F&page_show_back_url=%2Fphotos%2F27807374%40N05%2Fsets%2F'.$album.'%2Fwith%2F'.$photo.'%2F&set_id='.$album.'&jump_to='.$photo.'" width="'.$largeur.'" height="'.$hauteur.'"></embed></object>';
            }
        }
        //$videos['start']=
        return $videos;
    }

   function videos_liste() {
        // Dimensions des vidéos
        $largeur='640';
        $hauteur='360';
        
        $this->db->order_by('id_video','desc');
        $query = $this->db->get('videos');
        
        $videos=array();
        
        foreach ($query->result() as $row) {
            switch ($row->origine) {
                case 'youtube' : // Vidéo hébergée sur Youtube
                    $videos[$row->id_video]['id_video']=$row->id_video;
                    $videos[$row->id_video]['origine']=$row->origine;
                    $videos[$row->id_video]['lien']=$row->lien;
                    $videos[$row->id_video]['titre']=$row->titre;
                    $videos[$row->id_video]['legende']=$row->legende;
                    $videos[$row->id_video]['image']='http://img.youtube.com/vi/'.$row->lien.'/0.jpg';
                    $videos[$row->id_video]['embed']='<iframe width="'.$largeur.'" height="'.$hauteur.'" src="http://www.youtube.com/embed/'.$row->lien.'" frameborder="0" allowfullscreen></iframe>';
                    
                    break;
                case 'vimeo' : // Vidéo hebergée sur Vimeo
                    $videos[$row->id_video]['id_video']=$row->id_video;
                    $videos[$row->id_video]['origine']=$row->origine;
                    $videos[$row->id_video]['lien']=$row->lien;
                    $videos[$row->id_video]['titre']=$row->titre;
                    $videos[$row->id_video]['legende']=$row->legende;
                    $idvimeo=$row->lien;
                    $datavid = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$idvimeo.php"));
                    $videos[$row->id_video]['image']=$datavid[0]['thumbnail_small'];
                    $videos[$row->id_video]['embed']='<iframe src="http://player.vimeo.com/video/'.$row->lien.'" width="'.$largeur.'" height="'.$hauteur.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';

                    break;
                case 'flickr' : // Diaporama Flickr
                    $videos[$row->id_video]['id_video']=$row->id_video;
                    $videos[$row->id_video]['origine']=$row->origine;
                    $videos[$row->id_video]['lien']=$row->lien;
                    $videos[$row->id_video]['legende']=$row->legende;
                    $videos[$row->id_video]['titre']=$row->titre;
                    $pos1=strpos($row->lien,'/sets/');
                    $pos2=strpos($row->lien,'/show/with/');

                    $album=substr($row->lien,$pos1+6,$pos2-$pos1-6);
                    $photo=substr($row->lien,$pos2+11,-1);

                    $videos[$row->id_video]['image']='';
                    $videos[$row->id_video]['embed']='<object width="'.$largeur.'" height="'.$hauteur.'"> <param name="flashvars" value="offsite=true&lang=fr-fr&page_show_url=%2Fphotos%2F27807374%40N05%2Fsets%2F'.$album.'%2Fshow%2Fwith%2F'.$photo.'%2F&page_show_back_url=%2Fphotos%2F27807374%40N05%2Fsets%2F'.$album.'%2Fwith%2F'.$photo.'%2F&set_id='.$album.'&jump_to='.$photo.'"></param> <param name="movie" value="http://www.flickr.com/apps/slideshow/show.swf?v=140556"></param> <param name="allowFullScreen" value="true"></param><embed type="application/x-shockwave-flash" src="http://www.flickr.com/apps/slideshow/show.swf?v=140556" allowFullScreen="true" flashvars="offsite=true&lang=fr-fr&page_show_url=%2Fphotos%2F27807374%40N05%2Fsets%2F'.$album.'%2Fshow%2Fwith%2F'.$photo.'%2F&page_show_back_url=%2Fphotos%2F27807374%40N05%2Fsets%2F'.$album.'%2Fwith%2F'.$photo.'%2F&set_id='.$album.'&jump_to='.$photo.'" width="'.$largeur.'" height="'.$hauteur.'"></embed></object>';
            }
        }
        //$videos['start']=
        return $videos;
    }

   function dernieres_videos() {
        
        $this->db->order_by('id_video','desc');
        $query = $this->db->get('videos',5);
        
        $videos=array();
        
        foreach ($query->result() as $row) {
            switch ($row->origine) {
                case 'youtube' : // Vidéo hébergée sur Youtube
                    $videos[$row->id_video]['id_video']=$row->id_video;
                    $videos[$row->id_video]['origine']=$row->origine;
                    $videos[$row->id_video]['lien']=$row->lien;
                    $videos[$row->id_video]['titre']=$row->titre;
                    $videos[$row->id_video]['image']='http://img.youtube.com/vi/'.$row->lien.'/0.jpg';
                    
                    break;
                case 'vimeo' : // Vidéo hebergée sur Vimeo
                    $videos[$row->id_video]['id_video']=$row->id_video;
                    $videos[$row->id_video]['origine']=$row->origine;
                    $videos[$row->id_video]['lien']=$row->lien;
                    $videos[$row->id_video]['titre']=$row->titre;
                    $idvimeo=$row->lien;
                    $datavid = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$idvimeo.php"));
                    $videos[$row->id_video]['image']=$datavid[0]['thumbnail_small'];

                    break;
                case 'flickr' : // Diaporama Flickr
                    $videos[$row->id_video]['id_video']=$row->id_video;
                    $videos[$row->id_video]['origine']=$row->origine;
                    $videos[$row->id_video]['lien']=$row->lien;
                    $videos[$row->id_video]['titre']=$row->titre;
                    $videos[$row->id_video]['image']='';
            }
        }
        //$videos['start']=
        return $videos;
    }

    function get_video($id_video) {
        // Dimensions des vidéos
        $largeur='516';
        $hauteur='288';

        $query = $this->db->get_where('videos', array('id_video' => $id_video));
        
        $videos=array();
        
        foreach ($query->result() as $row) {
            switch ($row->origine) {
                case 'youtube' : // Vidéo hébergée sur Youtube
                    $videos[$row->id_video]['id_video']=$row->id_video;
                    $videos[$row->id_video]['origine']=$row->origine;
                    $videos[$row->id_video]['lien']=$row->lien;
                    $videos[$row->id_video]['titre']=$row->titre;
                    $videos[$row->id_video]['legende']=$row->legende;
                    $videos[$row->id_video]['image']='http://img.youtube.com/vi/'.$row->lien.'/0.jpg';
                    $videos[$row->id_video]['embed']='<iframe width="'.$largeur.'" height="'.$hauteur.'" src="http://www.youtube.com/embed/'.$row->lien.'" frameborder="0" allowfullscreen></iframe>';
                    
                    break;
                case 'vimeo' : // Vidéo hebergée sur Vimeo
                    $videos[$row->id_video]['id_video']=$row->id_video;
                    $videos[$row->id_video]['origine']=$row->origine;
                    $videos[$row->id_video]['lien']=$row->lien;
                    $videos[$row->id_video]['titre']=$row->titre;
                    $videos[$row->id_video]['legende']=$row->legende;
                    $idvimeo=$row->lien;
                    $datavid = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$idvimeo.php"));
                    $videos[$row->id_video]['image']=$datavid[0]['thumbnail_small'];
                    $videos[$row->id_video]['embed']='<iframe src="http://player.vimeo.com/video/'.$row->lien.'" width="'.$largeur.'" height="'.$hauteur.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';

                    break;
                case 'flickr' : // Diaporama Flickr
                    $videos[$row->id_video]['id_video']=$row->id_video;
                    $videos[$row->id_video]['origine']=$row->origine;
                    $videos[$row->id_video]['lien']=$row->lien;
                    $videos[$row->id_video]['titre']=$row->titre;
                    $videos[$row->id_video]['legende']=$row->legende;

                    $pos1=strpos($row->lien,'/sets/');
                    $pos2=strpos($row->lien,'/show/with/');

                    $album=substr($row->lien,$pos1+6,$pos2-$pos1-6);
                    $photo=substr($row->lien,$pos2+11,-1);

                    $videos[$row->id_video]['image']='';
                    $videos[$row->id_video]['embed']='<object width="'.$largeur.'" height="'.$hauteur.'"> <param name="flashvars" value="offsite=true&lang=fr-fr&page_show_url=%2Fphotos%2F27807374%40N05%2Fsets%2F'.$album.'%2Fshow%2Fwith%2F'.$photo.'%2F&page_show_back_url=%2Fphotos%2F27807374%40N05%2Fsets%2F'.$album.'%2Fwith%2F'.$photo.'%2F&set_id='.$album.'&jump_to='.$photo.'"></param> <param name="movie" value="http://www.flickr.com/apps/slideshow/show.swf?v=140556"></param> <param name="allowFullScreen" value="true"></param><embed type="application/x-shockwave-flash" src="http://www.flickr.com/apps/slideshow/show.swf?v=140556" allowFullScreen="true" flashvars="offsite=true&lang=fr-fr&page_show_url=%2Fphotos%2F27807374%40N05%2Fsets%2F'.$album.'%2Fshow%2Fwith%2F'.$photo.'%2F&page_show_back_url=%2Fphotos%2F27807374%40N05%2Fsets%2F'.$album.'%2Fwith%2F'.$photo.'%2F&set_id='.$album.'&jump_to='.$photo.'" width="'.$largeur.'" height="'.$hauteur.'"></embed></object>';
            }
        }
        //$videos['start']=
        return $videos;

    }

   function liste_videos_date($ordre,$sens) {

        $this->db->order_by($ordre,$sens);
        $query = $this->db->get('videos');
        
        $videos=array();
        
        foreach ($query->result() as $row) {
            switch ($row->origine) {
                case 'youtube' : // Vidéo hébergée sur Youtube
                    $videos[$row->id_video]['id_video']=$row->id_video;
                    $videos[$row->id_video]['origine']=$row->origine;
                    $videos[$row->id_video]['lien']=$row->lien;
                    $videos[$row->id_video]['titre']=$row->titre;
                    $videos[$row->id_video]['image']='http://img.youtube.com/vi/'.$row->lien.'/0.jpg';
                    $videos[$row->id_video]['date_saisie']=$row->date_saisie;
                    break;
                case 'vimeo' : // Vidéo hebergée sur Vimeo
                    $videos[$row->id_video]['id_video']=$row->id_video;
                    $videos[$row->id_video]['origine']=$row->origine;
                    $videos[$row->id_video]['lien']=$row->lien;
                    $videos[$row->id_video]['titre']=$row->titre;
                    $idvimeo=$row->lien;
                    $datavid = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$idvimeo.php"));
                    $videos[$row->id_video]['image']=$datavid[0]['thumbnail_small'];
                    $videos[$row->id_video]['date_saisie']=$row->date_saisie;
                    break;
                case 'flickr' : // Diaporama Flickr
                    $videos[$row->id_video]['id_video']=$row->id_video;
                    $videos[$row->id_video]['origine']=$row->origine;
                    $videos[$row->id_video]['lien']=$row->lien;
                    $videos[$row->id_video]['titre']=$row->titre;
                    $videos[$row->id_video]['date_saisie']=$row->date_saisie;
                    $videos[$row->id_video]['image']='';
            }
        }
        //$videos['start']=
        return $videos;
    }

    function sup_video($id_video) {
        $query = $this->db->delete('videos', array('id_video' => $id_video));
        //return $query->result();
    }
    
}
?>
