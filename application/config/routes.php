<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
        
if($detect->isMobile()){
    $route['default_controller'] = "accueil/mobile";
    $route['actus'] = "accueil";
}else{
   $route['default_controller'] = "accueil"; 
}

$route['404_override'] = '/Accueil';
$route['actus/(:num)-(:any)'] = 'actus/actu/$1/$2';
$route['actus/(:any)'] = 'actus/actu_cat/$1';
$route['agenda'] = 'actus/agenda';

$route['ressources/(:any)'] = 'ressources/all_p_annonces';
$route['innovation'] = 'pages/page/20';
$route['culture'] = 'pages/page/69';

$route['organisme/(:num)-(:any)'] = 'accueil/organisme/$1/$2';
$route['ressource/(:num)-(:any)'] = 'accueil/ressource/$1/$2';
$route['blog/(:num)-(:any)'] = 'accueil/blog/$1/$2';
$route['annonces'] = 'accueil/annonces';

$route['formation/(:num)-(:any)'] = 'pages/page/$1/$2';
$route['innovation/(:num)-(:any)'] = 'pages/page/$1/$2';
$route['culture/(:num)-(:any)'] = 'pages/page/$1/$2';
$route['informations/(:num)-(:any)'] = 'pages/page/$1/$2';

$route['innovation/formulaire-pochoir-masque-sablage'] = 'forms/sablage';
$route['formation/formulaire-contact'] = 'forms/contact';
//$route['vid/(:num)'] = 'index.php?vid=$1';
$route['revelor'] = 'pages/page/87';

// $route['formations/stages'] = 'stages';

/* End of file routes.php */
/* Location: ./application/config/routes.php */