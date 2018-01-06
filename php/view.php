<?php
//TODO: MIDTERM - Create a php file to be used in a require() function. Chapter 5

		//create short variable name
		$document_root = $_SERVER['DOCUMENT_ROOT'];

		//TODO: READ CSV FILE
		$books = file("$document_root/Anderson/files/books.csv");

		//Count how many elements in array
		$number_of_books = count($books);

		//If no books, display message
		if ($number_of_books == 0) {
			echo "<p><strong>No books in repository.<br/>
			Please try again later.</strong></p>";
		}

		//TODO: USE CSV FILE
		for ($i=0; $i<$number_of_books; $i++) {
			//Explode function to break out each field per record
			$line = explode("\t", $books[$i]);

			echo "<div style='height: 100px;'>";
			echo "<img style='float: left;margin-right: 10px;' src='/Anderson/images/" . @$line[5] . "'/>";
			echo "<span><b>ISBN:</b>" . @$line[1] . "</span><br/>";
			echo "<span><b>Author:</b>" . @$line[2] . "</span><br/>";
			echo "<span><b>Year:</b>" . @$line[3] . "</span><br/>";
			echo "<span><b>Publisher:</b>" . @$line[4] . "</span><br/>";
			echo "</div>";
			echo "<br/>";

		}
?>