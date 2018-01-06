<?php
	// include function files for this application
	require 'page.php';
  	require "user_auth_fns.php";
	session_start();
	//create short variable names
	if (!isset($_POST['username']))  {
	  //if not isset -> set with dummy value 
	  $_POST['username'] = " "; 
	}
	$username = $_POST['username'];
	if (!isset($_POST['passwd']))  {
	  //if not isset -> set with dummy value 
	  $_POST['passwd'] = " "; 
	}
	$passwd = $_POST['passwd'];
	if ($username && $passwd) {
	// they have just tried logging in
	  try  {
	    login($username, $passwd);
	    // if they are in the database register the user id
	    $_SESSION['valid_user'] = $username;

			$homepage = new Page();

			$homepage->content = "<!-- page content -->
								  <h2>Welcome back, ".$_SESSION['valid_user'].", to Anderson's Book store!</h2>
								  <h2>Your registration was successful!</h2>
								  <p>Browse and search for books!.</p>
								  <img height='800' width='1140' src='../images/andersonbookstore.jpg' />";

			$homepage->Display();

	  }
	  catch(Exception $e)  {
	    // unsuccessful login

			$homepage = new Page();

			$homepage->content = "<!-- page content -->
								  <h2>Welcome to Anderson's Book store!</h2>
								  <h2>Your Login or Pass was incorrect.</h2>
								  <p>Please register <a href='../php/register_form.php'>here</a> if you don't have a user</p>
								  <p>Browse and search for books!.</p>
								  <img height='800' width='1140' src='../images/andersonbookstore.jpg' />";

			$homepage->DisplayUnAuth();
	    exit;
	  }
	}
?>