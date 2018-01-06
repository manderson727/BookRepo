<?php

	require("page.php");

	$homepage = new Page();

	$homepage->content = "<form action='/Anderson/php/processfeedback.php' method='POST'>
							<table style='border: 0px;''>
								<tr>
									<td>Your name:</td>
									<td><input type='text' name='name' size='50' maxlength='50' /></td>
								</tr>
								<tr>
									<td>Your email address:</td>
									<td><input type='text' name='email' size='50' maxlength='50' /></td>
								</tr>
								<tr>
									<td>Your feedback</td>
									<td><input type='text' name='feedback' size='50' style='height:50px; maxlength='5'0' /></td>
								</tr>
								<tr>
									<td colspan='2' style='text-align: center;''><input type='submit' value='Submit Feedback' /></td>
								</tr>
							</table>
						</form>	";

	$homepage->Display();
	
?>



































