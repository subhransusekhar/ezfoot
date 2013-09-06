<?php 

//Data bsse settings 
if($_SERVER['SERVER_NAME'] == 'localhost') {
	//Data bsse settings
	define( 'SERVER_NAME', 'localhost' );
	define( 'USER_NAME', 'root' );
	define( 'PASSWORD', 'password' );
	define( 'DATABASE_NAME', 'zurlin_db' );
	
} else {
	//Data bsse settings
	define( 'SERVER_NAME', 'localhost' );
	define( 'USER_NAME', '' );
	define( 'PASSWORD', '' );
	define( 'DATABASE_NAME', '' );
}