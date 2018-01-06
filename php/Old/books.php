<?php

	require("page.php");

	$homepage = new Page();

	$homepage->content = "<!-- page content -->
						  <div class='maincontent'>
							<form action='/Anderson/php/createbook.php' method='POST'>
								<table style='border: 0px;'>
									<tr>
										<td>Book Title</td>
										<td><input type='text' name='booktitle' size='50' maxlength='50' /></td>
									</tr>
									<tr>
										<td>ISBN Number</td>
										<td><input type='text' name='isbn' size='50' maxlength='50' /></td>
									</tr>
									<tr>
										<td>Author's Last Name</td>
										<td><input type='text' name='author' size='50' maxlength='50' /></td>
									</tr>
									<tr>
										<td>Publication Year</td>
										<td><input type='text' name='pubyear' size='50' maxlength='50' /></td>
									</tr>
									<tr>
										<td>Publisher</td>
										<td><input type='text' name='publisher' size='50' maxlength='50' /></td>
									</tr>
									<tr>
										<td>Upload Image</td>
										<td><input type='file' name='image'></td>
									</tr>
									<tr>
										<td colspan='2' style='text-align: center;'><input type='submit' value='Submit Order' /></td>
									</tr>
								</table>
							</form>	
						  </div>";

	$homepage->Display();
	
?>



































