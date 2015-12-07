<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| DATABASE CONNECTIVITY SETTINGS
| -------------------------------------------------------------------
| This file will contain the settings needed to access your database.
|
| For complete instructions please consult the 'Database Connection'
| page of the User Guide.
|
| -------------------------------------------------------------------
| EXPLANATION OF VARIABLES
| -------------------------------------------------------------------
|
|	['hostname'] The hostname of your database server.
|	['username'] The username used to connect to the database
|	['password'] The password used to connect to the database
|	['database'] The name of the database you want to connect to
|	['dbdriver'] The database type. ie: mysql.  Currently supported:
				 mysql, mysqli, postgre, odbc, mssql, sqlite, oci8
|	['dbprefix'] You can add an optional prefix, which will be added
|				 to the table name when using the  Active Record class
|	['pconnect'] TRUE/FALSE - Whether to use a persistent connection
|	['db_debug'] TRUE/FALSE - Whether database errors should be displayed.
|	['cache_on'] TRUE/FALSE - Enables/disables query caching
|	['cachedir'] The path to the folder where cache files should be stored
|	['char_set'] The character set used in communicating with the database
|	['dbcollat'] The character collation used in communicating with the database
|				 NOTE: For MySQL and MySQLi databases, this setting is only used
| 				 as a backup if your server is running PHP < 5.2.3 or MySQL < 5.0.7
|				 (and in table creation queries made with DB Forge).
| 				 There is an incompatibility in PHP with mysql_real_escape_string() which
| 				 can make your site vulnerable to SQL injection if you are using a
| 				 multi-byte character set and are running versions lower than these.
| 				 Sites using Latin-1 or UTF-8 database character set and collation are unaffected.
|	['swap_pre'] A default table prefix that should be swapped with the dbprefix
|	['autoinit'] Whether or not to automatically initialize the database.
|	['stricton'] TRUE/FALSE - forces 'Strict Mode' connections
|							- good for ensuring strict SQL while developing
|
| The $active_group variable lets you choose which connection group to
| make active.  By default there is only one group (the 'default' group).
|
| The $active_record variables lets you determine whether or not to load
| the active record class
*/

$active_group = 'default';
$active_record = TRUE;

/* Paramètres OVH *
$db['ovh']['hostname'] = 'mysql51-64.pro';
$db['ovh']['username'] = 'cerfavweb';
$db['ovh']['password'] = 'vSsn5tyayh28';
$db['ovh']['database'] = 'cerfavweb';
$db['ovh']['dbdriver'] = 'mysqli';
$db['ovh']['dbprefix'] = 'cerfav_';
$db['ovh']['pconnect'] = TRUE;
$db['ovh']['db_debug'] = TRUE;
$db['ovh']['cache_on'] = FALSE;
$db['ovh']['cachedir'] = '';
$db['ovh']['char_set'] = 'utf8';
$db['ovh']['dbcollat'] = 'utf8_general_ci';
$db['ovh']['swap_pre'] = '';
$db['ovh']['autoinit'] = TRUE;
$db['ovh']['stricton'] = FALSE;
/**/

/* Paramètres local */
$db['default']['hostname'] = 'localhost';
$db['default']['username'] = 'root';
$db['default']['password'] = '';
$db['default']['database'] = 'pdc';
$db['default']['dbdriver'] = 'mysqli';
$db['default']['dbprefix'] = '';
$db['default']['pconnect'] = TRUE;
$db['default']['db_debug'] = TRUE;
$db['default']['cache_on'] = FALSE;
$db['default']['cachedir'] = '';
$db['default']['char_set'] = 'utf8';
$db['default']['dbcollat'] = 'utf8_general_ci';
$db['default']['swap_pre'] = '';
$db['default']['autoinit'] = TRUE;
$db['default']['stricton'] = FALSE;

/* Paramètres cerfav */
$db['cerfav']['hostname'] = 'localhost';
$db['cerfav']['username'] = 'cerfav';
$db['cerfav']['password'] = 'CEUNEDV';
$db['cerfav']['database'] = 'cerfav2';
$db['cerfav']['dbdriver'] = 'mysqli';
$db['cerfav']['dbprefix'] = 'cerfav_';
$db['cerfav']['pconnect'] = TRUE;
$db['cerfav']['db_debug'] = TRUE;
$db['cerfav']['cache_on'] = FALSE;
$db['cerfav']['cachedir'] = '';
$db['cerfav']['char_set'] = 'utf8';
$db['cerfav']['dbcollat'] = 'utf8_general_ci';
$db['cerfav']['swap_pre'] = '';
$db['cerfav']['autoinit'] = TRUE;
$db['cerfav']['stricton'] = FALSE;

/* Paramètres idverre */
$db['idverre']['hostname'] = 'localhost';
$db['idverre']['username'] = 'idverre';
$db['idverre']['password'] = 'pgd8kst6';
$db['idverre']['database'] = 'idverre';
$db['idverre']['dbdriver'] = 'mysqli';
$db['idverre']['dbprefix'] = '';
$db['idverre']['pconnect'] = TRUE;
$db['idverre']['db_debug'] = TRUE;
$db['idverre']['cache_on'] = FALSE;
$db['idverre']['cachedir'] = '';
$db['idverre']['char_set'] = 'utf8';
$db['idverre']['dbcollat'] = 'utf8_general_ci';
$db['idverre']['swap_pre'] = '';
$db['idverre']['autoinit'] = TRUE;
$db['idverre']['stricton'] = FALSE;

/* Paramètres formation */
$db['formation']['hostname'] = 'localhost';
$db['formation']['username'] = 'formation';
$db['formation']['password'] = 'CEUNEDV';
$db['formation']['database'] = 'formation';
$db['formation']['dbdriver'] = 'mysqli';
$db['formation']['dbprefix'] = '';
$db['formation']['pconnect'] = TRUE;
$db['formation']['db_debug'] = TRUE;
$db['formation']['cache_on'] = FALSE;
$db['formation']['cachedir'] = '';
$db['formation']['char_set'] = 'utf8';
$db['formation']['dbcollat'] = 'utf8_general_ci';
$db['formation']['swap_pre'] = '';
$db['formation']['autoinit'] = TRUE;
$db['formation']['stricton'] = FALSE;

/* End of file database.php */
/* Location: ./application/config/database.php */