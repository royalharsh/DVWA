<?php

if( isset( $_GET[ 'Login' ] ) ) {
	// Connect
	$conn = mysqli_connect( $_DVWA[ 'db_server' ], $_DVWA[ 'db_user' ], $_DVWA[ 'db_password' ] );
	// Sanitise username input
	$user = $_GET[ 'username' ];
	$user = mysqli_real_escape_string( $conn, $user );
	// Sanitise password input
	$pass = $_GET[ 'password' ];
	$pass = mysqli_real_escape_string( $conn, $pass );
	$pass = md5( $pass );

	// Check the database
	$query  = "SELECT * FROM `users` WHERE user = '$user' AND password = '$pass';";
	$result = mysqli_query( $conn, $query ) or die( '<pre>' . mysqli_error() . '</pre>' );

	if( $result && mysqli_num_rows( $result ) == 1 ) {
		// Get users details
		$avatar = mysqli_result( $result, 0, "avatar" );

		// Login successful
		$html .= "<p>Welcome to the password protected area {$user}</p>";
		$html .= "<img src=\"{$avatar}\" />";
	}
	else {
		// Login failed
		sleep( 2 );
		$html .= "<pre><br />Username and/or password incorrect.</pre>";
	}

	mysqli_close();
}

?>
