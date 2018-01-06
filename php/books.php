<?php

	session_start();

	require("page.php");

	if(isset($_SESSION['valid_user']))
	{
		$homepage = new Page();

	$homepage->content = "<!-- page content -->
							<form action='../php/insert_book.php' method='POST'>
								<fieldset>
								<p><label for='ISBN' size='30'>ISBN</label>
								<input type='text' id='ISBN' name='ISBN'
								maxlength='13' size='13' /></p>

								<p><label for='Author'>Author</label>
								<input type='text' id='Author' name='Author'
								maxlength='60' size='60' /></p>

								<p><label for='Title'>Title</label>
								<input type='text' id='Title' name='Title'
								maxlength='60' size='60' /></p>

								<p><label for='Year'>Year</label>
								<input type='text' id='Year' name='Year'
								maxlength='10' size='10' /></p>

								<p><label for='Publisher'>Publisher</label>
								<input type='text' id='Publisher' name='Publisher'
								maxlength='60' size='60' /></p>

								<p><label for='Price'>Price</label>
								$ <input type='text' id='Price' name='Price'
								maxlength='7' size='7' /></p>

								<p><label for='Image'>Upload Image</label>
								<input type='file' id='Image' name='Image'
								maxlength='60' size='60' /></p>

								<p><input type='submit' value='Add New Book' /></p>
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



































