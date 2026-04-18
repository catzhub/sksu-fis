<?php

		//start session on web page
		session_start();

		//config.php

		// //Include Google Client Library for PHP autoload file
		// require_once 'vendor/autoload.php';

		// //Make object of Google API Client for call Google API
		// $google_client = new Google_Client();


		// //Set the OAuth 2.0 Client ID
		// $google_client->setClientId('463114917800-bohj3g4t50t5kaurnlbodr5bdnv9n68j.apps.googleusercontent.com');

		// //Set the OAuth 2.0 Client Secret key
		// $google_client->setClientSecret('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');

		// //Set the OAuth 2.0 Redirect URI
		// $google_client->setRedirectUri('http://localhost/myprofile/verify.php');
		// // http://www.sksu-orms.net/researchub/verify.php

		// // to get the email and profile 
		// $google_client->addScope('email');

		// $google_client->addScope('profile');

		/* Detect environment */

if ($_SERVER['HTTP_HOST'] == 'localhost') {

  // LOCAL
  define('BASE_URL', 'http://localhost/inspire');

} else {

  // ONLINE
  define('BASE_URL', 'https://sksu-orms.net/inspire');

}



?>