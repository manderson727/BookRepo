<?php

	session_start();

	require("page.php");

	if(isset($_SESSION['valid_user']))
	{
		$homepage = new Page();


		$homepage->content = "
							<form action='../php/results.php' method='post'>
							<p><strong>Choose Search Type:</strong><br />
							<select name='searchtype'>
							<option value='Author'>Author</option>
							<option value='Title'>Title</option>
							<option value='ISBN'>ISBN</option>
							<option value='Year'>Year</option>
							<option value='Publisher'>Publisher</option>
							</select>
							</p>
							<p>Enter Search Term:</strong><br/>
							<input name='searchterm' type='text' size='40'</p>
							<p><input type='submit' name='submit' value='Search'></p>
							</form>
						";

		$homepage->Display();
	}
	else
	{
		$homepage = new Page();

		$homepage->content = "<!-- page content -->
							  <h2>Welcome to Anderson's Book store!</h2>
							  <p>Browse and search for books!.</p>
							  <img height='800' width='1140' src='../images/andersonbookstore.jpg' />";

		$homepage->DisplayUnAuth();
	}
	
?>



































