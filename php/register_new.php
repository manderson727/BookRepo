<?php
  require "user_auth_fns.php";

  //create short variable names
  $email=$_POST['email'];
  $username=$_POST['username'];	
  $passwd=$_POST['passwd'];
  $passwd2=$_POST['passwd2'];
  // start session which may be needed later
  // start it now because it must go before headers
  session_start();
  try   {
    // passwords not the same
    if ($passwd != $passwd2) {
      throw new Exception('The passwords you entered do not match - please go back and try again.');
    }
    // check password length is ok
    // ok if username truncates, but passwords will get
    // munged if they are too long.
    if ((strlen($passwd) < 6) || (strlen($passwd) > 16)) {
      throw new Exception('Your password must be between 6 and 16 characters. Please go back and try again.');
    }

    // attempt to register
    // this function can also throw an exception
    register($username, $email, $passwd);
    // register session variable
    $_SESSION['valid_user'] = $username;
    // provide link to members page 
    //do_html_header('Registration successful');
    //echo 'Your registration was successful!';
    require("page.php");

	$homepage = new Page();

	$homepage->content = "<!-- page content -->
						  <h2>Welcome ".$_SESSION['valid_user']." to Anderson's Book store!</h2>
						  <h2>Your registration was successful!</h2>
						  <p>Browse and search for books!.</p>
						  <img height='800' width='1140' src='../images/andersonbookstore.jpg' />";

	$homepage->Display();

    //header("Location: index.php"); /* Redirect browser */
	//exit();
    //do_html_url('member.php', 'Go to members page');
   // end page
   //do_html_footer();
  }
  catch (Exception $e) {
     //do_html_header('Problem:');
     echo $e->getMessage();
     //do_html_footer();
     exit;
  }
?>