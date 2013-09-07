<?php 
/* site config*/ 
define( 'SITE_NAME', 'ezfoot');
define( 'SITE_SLOGAN', 'Shorten your URL');
define( 'COPY_RIGHT', 'Pietas Labs');
define( 'COPY_RIGHT_URL', 'http://www.pietaslabs.com');
define( 'ITEM_PER_PAGE', 20);

if($_SERVER['SERVER_NAME'] == 'localhost' ) {
	define( 'ROOT_DIR', 'zurl' );
	define( 'SITE_URL', 'http://localhost/'.ROOT_DIR.'/' );
	define( 'SITE_URL_LINK', 'http://localhost/'.ROOT_DIR .'/');
} else if($_SERVER['SERVER_NAME'] == 'dev.ezfoot' ) {
	define( 'ROOT_DIR', '' );
	define( 'SITE_URL', 'http://dev.ezfoot/'.ROOT_DIR );
	define( 'SITE_URL_LINK', 'http://dev.ezfoot/'.ROOT_DIR );
} else if($_SERVER['SERVER_NAME'] == 'www.ezfoot' ) {
	define( 'ROOT_DIR', '' );
	define( 'SITE_URL', 'http://www.ezfoot/'.ROOT_DIR );
	define( 'SITE_URL_LINK', 'http://www.ezfoot/'.ROOT_DIR );
} else {
	define( 'ROOT_DIR', '' );
	define( 'SITE_URL', 'http://ezfoot/'.ROOT_DIR );
	define( 'SITE_URL_LINK', 'http://ezfoot/'.ROOT_DIR );
}

define( 'SITE_MAINTENANCE', 'maintenance' );