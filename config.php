<?php

	ob_start();

    session_start();

    date_default_timezone_set("Asia/Bangkok");

	define("NOW", date("Y-m-d h:i:s"));

	define("BASE_ADMIN", "admins/");

	define("CATPOST", "catpost");

	define("CATPRODUCT", "catproduct");

	define("POST", "post");

	define("PRODUCT", "product");

    // define('BASE_URL', 'http://ducdat.vn/');
	define('BASE_URL', 'http://ducdat.local/');
	
    define("CAPCHA_SITEKEY", "");

    define("CAPCHA_SECRET", "");



    define('DB_NAME', 'cp818601_app');



	/** MySQL database username */
	define('DB_USER', 'root');

	/** MySQL database password */
	define('DB_PASSWORD', 'root');




	/** MySQL hostname */

	define('DB_HOST', 'localhost');



	/** Database Charset to use in creating database tables. */

	define('DB_CHARSET', 'utf8');



	/** The Database Collate type. Don't change this if in doubt. */

	define('DB_COLLATE', '');



	define('ABSPATH', dirname(__FILE__) . '/');



?>