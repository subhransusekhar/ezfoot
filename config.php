<?php
/*
 * Site Configuration file
 */

session_start(); //Start the session

error_reporting(E_ALL ^ E_NOTICE);

define( 'CURRENT_DIR', str_replace('\\', '/', getcwd()) );
define( 'CLASSES_PATH', CURRENT_DIR . '/includes/classes' );
define( 'INCLUDES_PATH', CURRENT_DIR . '/includes' );
define( 'TEMPLATES_PATH', CURRENT_DIR . '/templates' );
define( 'VIEWS_PATH', CURRENT_DIR . '/views' );
define( 'CONTROLLERS_PATH', CURRENT_DIR . '/controllers' );
define( 'MODELS_PATH', CURRENT_DIR . '/models' );
define( 'UPLOADS_PATH', CURRENT_DIR . '/uploads' );
define( 'MODULES_PATH', CURRENT_DIR . '/modules' );

define( 'UPLOADS_DIR', 'uploads' );

define("OUTPUT_BUFFER_STATE","true");

//head code to be peplaced
define( 'HEAD_REPLACING_CODE', '<script>//HEAD</script>' ); //{{{HEAD}}}

//head code to be replace from 
define( 'HEAD_REPLACING_PATTERN_FROM', '/\{\{(.*?)\}\}/' );  //{{CODE}}
define( 'HEAD_REPLACING_CODE_FROM', '{{CODE}}' );  //{{CODE}}

//template setting
define( 'TEMPLATE_NAME', 'visualize' );


/*
 * global variables; 
 */
global $contollerObj;
global $actionObjs;
global $template_view;


$actionObjs = array();

require_once ( INCLUDES_PATH."/site-config.php" );
require_once ( INCLUDES_PATH."/db-config.php" );

require_once ( INCLUDES_PATH."/modules-config.php" );

//class files to include
require_once ( CLASSES_PATH."/uri.class.php" );
require_once ( CLASSES_PATH."/module.class.php" );
require_once ( CLASSES_PATH."/controller.class.php" );
require_once ( CLASSES_PATH."/sql.class.php");
require_once ( CLASSES_PATH."/zurl.class.php");
require_once ( CLASSES_PATH."/init.class.php" ); 

//create a object of the engine
$init=new Init();