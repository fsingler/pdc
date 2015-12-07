<?php // $Id: page.tpl.php,v 1.15.4.7 2008/12/23 03:40:02 designerbrent Exp $ ?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
        <!-- <script type="text/javascript" src="<?php echo base_url('http://use.typekit.com/gip0guq.js'); ?>"></script>
        <script type="text/javascript">try{Typekit.load();}catch(e){}</script> -->
<!--<meta http-equiv="content-type" content="text/html; charset=UTF-8" /> -->
<meta charset="utf-8">
<title>Pôle de Compétences</title>
<meta name="description" content="Pôle de compétences verre en Lorraine.">

<!-- <link rel="shortcut icon" href="<?php // echo base_url('img/favicon.gif'); ?>" type="image/x-icon" /> -->

 <link rel="stylesheet" href="<?php echo base_url('css/blueprint/screen.css'); ?>" type="text/css" media=" only screen  and (min-device-width: 480px), only projection and (min-device-width: 480px)" />
<link rel="stylesheet" href="<?php echo base_url('css/blueprint/print.css'); ?>" type="text/css" media="print" />
<!--[if lt IE 8]>
  <link rel="stylesheet" href="<?php echo base_url('css/blueprint/ie.css'); ?>" type="text/css" media="screen, projection">
<![endif]-->
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url('css/pdc.css'); ?>" />
<link rel="stylesheet" href="<?php echo base_url('css/blueprint/mobile.css'); ?>" type="text/css" media="only screen  and (max-device-width: 480px)" />
<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url('js/perfect-scrollbar.min.css'); ?>" />

<link type="text/css" rel="stylesheet" media="all" href="<?php echo base_url('css/idangerous.swiper.css'); ?>" />
<!--[if lt IE 9]>
<script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

<script type="text/javascript" src="<?php echo base_url('js/jquery.min.js'); ?>"></script>
<!-- <script type="text/javascript" src="<?php echo base_url('http://code.jquery.com/jquery-2.0.2.min.js'); ?>"></script> -->
<script type="text/javascript" src="<?php echo base_url('js/slides.js'); ?>"></script>
<script src="<?php echo base_url('js/perfect-scrollbar.min.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('js/idangerous.swiper.js'); ?>"></script>

<script type="text/javascript" src="<?php echo base_url('js/detectmobilebrowser.js'); ?>"></script>

<script>
  window.onload = function() {
  var mySwiper = new Swiper('.swiper-container',{
    //Your options here:
    mode:'horizontal',
    pagination: '.pagination_m',
  });  
}
  </script>
<script type="text/javascript">
/* Script de la barre des réseaux sociaux (#rezosocio) */
jQuery(document).ready(function($){
    // Stockage des références des différents éléments dans des variables
    rezosocio     = $('#rezosocio');
 
    // Calcul de la marge entre le haut du document et #rezosocio
    fixedLimit = rezosocio.offset().top; // - parseFloat(rezosocio.css('marginTop').replace(/auto/,0));
 
    // On déclenche un événement scroll pour mettre à jour le positionnement au chargement de la page
    $(window).trigger('scroll');
 
    $(window).scroll(function(event){
        // Valeur de défilement lors du chargement de la page
        windowScroll = $(window).scrollTop();
 
        // Mise à jour du positionnement en fonction du scroll
        if( windowScroll >= fixedLimit ){
            rezosocio.addClass('fixed');
        } else {
            rezosocio.removeClass('fixed');
        }
           // Mise à jour
        LAST_SCROLL_OFFSET = windowScroll;

    });
});
</script>

<script type="text/javascript">
/* Retour en haut de page façon scrolling */
$(function(){
  $('#linktop a').click(function() {
    $('html,body').animate({scrollTop: 0}, 800);
    return false;
  });
});
</script>

<script type="text/javascript">
//$(function(){
//      $("#slides").slides({
//        play: 5000,
//      });
//    });
</script>

<script type="text/javascript" >
function afficher_cacher(id)
{
		hideactu=$('#hideactu');
        if(document.getElementById(id).className=="hide")
        {
                document.getElementById(id).removeClass('hide');
                document.getElementById('bouton_'+id).innerHTML='Moins d\'actualités';
        }
        else
        {
                document.getElementById(id).addClass('hide');
                document.getElementById('bouton_'+id).innerHTML='Plus d\'actualités';
        }
        return true;
}
</script>

<script type="text/javascript">
    function show(bloc,lien,texte) {
    if (document.getElementById(bloc).style.display=="none") {    // Si la zone indiquée par indice est est invisible
        document.getElementById(bloc).style.display="block";      // On l'affiche
        
        document.getElementById(lien).innerHTML=texte+' <img src="<?php echo base_url('img/fleche-down.png'); ?>">';         // On affiche l'image "dépliéé"
    }
    else {                                                          // Sinon (elle est donc visible)
        document.getElementById(bloc).style.display="none";       //On la crend invisible
        document.getElementById(lien).innerHTML=texte+' <img src="<?php echo base_url('img/fleche-right.png'); ?>">';         // On affiche l'image "pliéé"
    }
//    if (document.getElementById(indice).class=="hide")  // Si la zone indiquée par indice est est invisible
//        document.getElementById(indice).removeClass('hide');  // On l'affiche
//    else document.getElementById(indice).addClass('hide');  // Sinon (elle est donc visible), on la crend invisible
    }
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-7623066-16', 'auto');
  ga('send', 'pageview');

</script>

</head>

<body>
<div class="container">

	<div id="rezosocio">
<!--		<a href="http://facebook.com/cerfav.fr" target="blank"><img src="<?php echo base_url('img/logo-facebook.png'); ?>" alt="Facebook Cerfav" /></a><br />
		<a href="http://twitter.com/cerfav" target="blank"><img src="<?php echo base_url('img/logo-twitter.png'); ?>" alt="Twitter Cerfav" /></a><br />
		<a href="https://plus.google.com/118341117850472094174" rel="publisher" target="blank"><img src="<?php echo base_url('img/logo-googplus.png'); ?>" alt="G+ Cerfav" /></a><br />
		<a href="http://www.cerfav.fr/rss.xml" target="blank"><img src="<?php echo base_url('img/logo-RSS.png'); ?>" alt="RSS Cerfav" /></a><br />
		<a href="<?php echo base_url('informations/85-contacts.html'); ?>"><img src="<?php echo base_url('img/logo-contact.png'); ?>" alt="E-mail Cerfav, Formations verre" /></a><br />
		<div id="linktop"><a href="#top"><img src="<?php echo base_url('img/logo-retour-haut.png'); ?>" alt="Retour en haut de page" /></a></div> -->
	</div>

  <header>
	<div class="span-24 last topcontainer">
<!--	<p>Actualité</p> -->
	</div>

	<div class="span-10">
   <h1 id="logo">
<!--           <a href="<?php echo base_url(); ?>" title="Pôle de Compétences">
            Cerfav.fr
          </a> -->
    </h1>
    </div>
    <div class="span-8 iconrezsoc">

    </div>
    <div class="span-6 last formtop">
<!--        <p>
                <a href="http://facebook.com/cerfav.fr" target="blank"><img src="<?php echo base_url('img/logo-facebook-black.png'); ?>"></a>
	    	<a href="http://twitter.com/cerfav" target="blank"><img src="<?php echo base_url('img/logo-twitter-black.png'); ?>"></a>
	    	<a href="https://plus.google.com/118341117850472094174" rel="publisher" target="blank"><img src="<?php echo base_url('img/logo-googplus-black.png'); ?>"></a>
	    	<a href="http://www.cerfav.fr/rss.xml" target="blank"><img src="<?php echo base_url('img/logo-RSS-black.png'); ?>"></a>
	    	<a href="<?php echo base_url('informations/85-contacts.html'); ?>"><img src="<?php echo base_url('img/logo-contact-black.png'); ?>"></a>

        </p>
		<p>
                    <?php
                    echo '<form name="recherche" action="'.base_url('forms/recherche').'" method="POST">';
                    echo '<input type="text" name="search" class="recherche" value="Rechercher" onclick="if(this.value==\'Rechercher\')this.value=\'\';">';
                    //echo '<input type="image" class="bouton_recherche" src="'.base_url('img/logo-recherche.png').'" alt="Rechercher">';
                    echo '</form>';
                    ?>
                </p> -->
        <div style="height: 73px;"></div>
    </div>
  </header>

<!-- Menu principal -->
<nav>
<div class="span-24 last" id="navmenu">
<ul class="level1">
    <li id="formmenu" class="navmenuform colorform"><a href="<?php echo base_url(); ?>">Accueil</a></li>
    <li id="formmenu" class="navmenuform colorform"><a href="<?php echo base_url('annonces'); ?>">Petites annonces Lorraine</a></li>
    <li id="formmenu" class="navmenuform colorform"><a href="<?php echo base_url('accueil/qui_sommes_nous'); ?>">Qui sommes-nous</a></li>
    <li id="formmenu" class="navmenuform colorform"><a href="<?php echo base_url('accueil/panorama'); ?>">Panorama</a></li>
</ul>

<!--
<div class="span-7 last" id="navmenu2">
<ul>
	<li class="navmenulien2lg"><a href="http://www.idverre.net/voir/idverreinfos/index/index.php">Magazine<br>ID Verre Infos</a></li>
	<li class="navmenulien1lg"><a href="http://www.cerfav.fr/fablab">Fablab</a></li>
	<li class="navmenulien1lg"><a href="<?php echo base_url('agenda'); ?>">Agenda</a></li>
</ul>
</div> -->
</nav>
<!-- Fin du menu -->

<header class="top">
    <div class="span-10 entete"><a href="<?php echo base_url(); ?>" title="Pôle de Compétences"><h1>Pôle de Compétences<br />Verre</h1></a></div>
    <div class="span-7 entete"><a href="<?php echo base_url(); ?>" title="Pôle de Compétences"><h2>Ressources <br />& Qualifications</h2></a></div>
    <div class="span-7 last entete"><a href="<?php echo base_url(); ?>" title="Pôle de Compétences"><h2>Offres de <br />formations</h2></a></div>
</header>


<div class="span-24 last allpages">

<!-- début de la grille -->
<div class="grilleform2">

