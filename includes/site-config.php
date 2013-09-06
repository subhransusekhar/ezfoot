<?php 
/* site config*/ 
define( 'SITE_NAME', 'Zurl.in');
define( 'SITE_SLOGAN', 'Shorten your URL');
define( 'COPY_RIGHT', 'Pietas Labs');
define( 'COPY_RIGHT_URL', 'http://www.pietaslabs.com');
define( 'ITEM_PER_PAGE', 20);

if($_SERVER['SERVER_NAME'] == 'localhost' ) {
	define( 'ROOT_DIR', 'zurl' );
	define( 'SITE_URL', 'http://localhost/'.ROOT_DIR.'/' );
	define( 'SITE_URL_LINK', 'http://localhost/'.ROOT_DIR .'/');
} else if($_SERVER['SERVER_NAME'] == 'dev.zurl.in' ) {
	define( 'ROOT_DIR', '' );
	define( 'SITE_URL', 'http://dev.zurl.in/'.ROOT_DIR );
	define( 'SITE_URL_LINK', 'http://dev.zurl.in/'.ROOT_DIR );
} else if($_SERVER['SERVER_NAME'] == 'www.zurl.in' ) {
	define( 'ROOT_DIR', '' );
	define( 'SITE_URL', 'http://www.zurl.in/'.ROOT_DIR );
	define( 'SITE_URL_LINK', 'http://www.zurl.in/'.ROOT_DIR );
} else {
	define( 'ROOT_DIR', '' );
	define( 'SITE_URL', 'http://zurl.in/'.ROOT_DIR );
	define( 'SITE_URL_LINK', 'http://zurl.in/'.ROOT_DIR );
}

define( 'SITE_MAINTENANCE', 'maintenance' );