<?php

	class Page {

		public $content;
		public $title = "Anderson's Books";
		//public $keywords = "keywords";

		public $buttons = array("<img src='../images/bookrepo.png' />" => "index.html",
								"Home" => "../php/index.php",
								"Create Book" => "../php/books.php",
								"View Books" => "../php/viewbooks.php",
								"Search Books" => "../php/search.php",
								"Logout" => "../php/logout.php");

		public $buttons2 = array("<img src='../images/bookrepo.png' />" => "index.html",
								"Home" => "../php/index.php",
								"Register" => "../php/register_form.php",
								"Login" => "../php/login.php");

		public function _set($name, $value)
		{
			$this->$name = $value;			
		}


		public function Display() 
		{
			echo "<html>\n<head>\n";
			$this-> DisplayTitle();
			$this-> DisplayStyles();
			echo "</head>\n<body>\n";
			$this-> DisplayHeader();
			$this-> DisplayMenu($this->buttons);
			echo "<div class='maincontent'>";

				echo $this->content;

			echo "</div>";
			$this-> DisplayFooter();
			echo "</body>\n</html>\n";
		}

		public function DisplayUnAuth() 
		{
			echo "<html>\n<head>\n";
			$this-> DisplayTitle();
			$this-> DisplayStyles();
			echo "</head>\n<body>\n";
			$this-> DisplayHeader();
			$this-> DisplayMenu($this->buttons2);
			echo "<div class='maincontent'>";

				echo $this->content;

			echo "</div>";
			$this-> DisplayFooter();
			echo "</body>\n</html>\n";
		}

		public function DisplayBooks()
		{
			echo "<html>\n<head>\n";
			$this-> DisplayTitle();
			$this-> DisplayStyles();
			echo "</head>\n<body>\n";
			$this-> DisplayHeader();
			$this-> DisplayMenu($this->buttons);
			echo "<div class='maincontent'>";

				$db = new mysqli('localhost', 'Admin626', '', 'test626');

				if (mysqli_connect_errno()) {
					echo '<p>Error: Could not connect to database.<br/>
					Please try again later.</p>';
					exit;
				}

				$query = "SELECT ISBN, Author, Title, Year, Publisher, Price, Image FROM Books";

				$stmt = $db->prepare($query);
				$stmt->execute();
				$stmt->store_result();

				$stmt->bind_result($isbn, $author, $title, $year, $publisher, $price, $image);

				echo "<p>Number of books found: ".$stmt->num_rows."</p>";

				while($stmt->fetch()) {
					echo "<div class='books'>";
					echo "<img style='float: left;margin-right: 10px;' src='../images/" . $image . "'/>";
					echo "<span><b>ISBN:</b>" . $isbn . "</span><br/>";
					echo "<span><b>Author:</b>" . $author . "</span><br/>";
					echo "<span><b>Year:</b>" . $year . "</span><br/>";
					echo "<span><b>Publisher:</b>" . $publisher . "</span><br/>";
					echo "<br /><b>Price:</b> \$".number_format($price,2);
					echo "</div>";
				}

				$stmt->free_result();
				$db->close();

			echo "</div>";
			$this-> DisplayFooter();
			echo "</body>\n</html>\n";
		}

		public function SearchResults()
		{

			$searchtype = $_POST['searchtype'];
			$searchterm = trim($_POST['searchterm']);

			echo "<html>\n<head>\n";
			$this-> DisplayTitle();
			//$this-> DisplayKeywords();
			$this-> DisplayStyles();
			echo "</head>\n<body>\n";
			$this-> DisplayHeader();
			$this-> DisplayMenu($this->buttons);
			echo "<div class='maincontent'>";

				if (!$searchtype || !$searchterm) {
					echo '<p>You have not entered search details.<br/>
					Please go back and try again.</p>';
					exit;
				}

				switch($searchtype) {
					case 'Title':
					case 'Author':
					case 'ISBN':
					case 'Year':
					case 'Publisher':
					case 'Price':
						break;
					default:
						echo '<p>That is not a valid search type. <br/>
						Please go back and try again.</p>';
						exit;
				}

				$db = new mysqli('localhost', 'Admin626', '', 'test626');

				if (mysqli_connect_errno()) {
					echo '<p>Error: Could not connect to database.<br/>
					Please try again later.</p>';
					exit;
				}

				$query = "SELECT ISBN, Author, Title, Year, Publisher, Price, Image
						  FROM Books WHERE $searchtype = ?";

				$stmt = $db->prepare($query);
				$stmt->bind_param('s', $searchterm);
				$stmt->execute();
				$stmt->store_result();

				$stmt->bind_result($isbn, $author, $title, $year, $publisher, $price, $image);

				echo "<p>Number of books found: ".$stmt->num_rows."</p>";

				while($stmt->fetch()) {
					echo "<div class='books'>";
					echo "<img style='float: left;margin-right: 10px;' src='../images/" . $image . "'/>";
					echo "<span><b>ISBN:</b>" . $isbn . "</span><br/>";
					echo "<span><b>Author:</b>" . $author . "</span><br/>";
					echo "<span><b>Year:</b>" . $year . "</span><br/>";
					echo "<span><b>Publisher:</b>" . $publisher . "</span><br/>";
					echo "<br /><b>Price:</b> \$".number_format($price,2);
					echo "</div>";
				}

				$stmt->free_result();
				$db->close();

			echo "</div>";
			$this-> DisplayFooter();
			echo "</body>\n</html>\n";
		}

		public function CreateBooks()
		{

			if (!isset($_POST['ISBN']) || !isset($_POST['Author'])  
									   || !isset($_POST['Title']) 
									   || !isset($_POST['Year'])  
									   || !isset($_POST['Publisher'])  
									   || !isset($_POST['Price']) 
									   || !isset($_POST['Image'])
				)  {
						echo "<p>You have not entered all the requiered details.<br />
						Please go back and try again.</p>";
						exit;
					}

			$isbn = $_POST['ISBN'];
			$author = $_POST['Author'];
			$title = $_POST['Title'];
			$year = $_POST['Year'];
			$publisher = $_POST['Publisher'];
			$price = $_POST['Price'];
			$price = doubleval($price);
			$image = $_POST['Image'];
			$date = date('H:i, jS F Y');

			echo "<html>\n<head>\n";
			$this-> DisplayTitle();
			//$this-> DisplayKeywords();
			$this-> DisplayStyles();
			echo "</head>\n<body>\n";
			$this-> DisplayHeader();
			$this-> DisplayMenu($this->buttons);
			echo "<div class='maincontent'>";

				@$db = new mysqli('localhost', 'Admin626', '', 'Test626');

				if (mysqli_connect_errno()) {
					echo '<p>Error: Could not connect to database.<br/>
					Please try again later.</p>';
					exit;
				}

				$query = "INSERT INTO Books VALUES (?, ?, ?, ?, ?, ?, ?)";
				$stmt = $db->prepare($query);
				$stmt->bind_param('sssssds', $isbn, $author, $title, $year, $publisher, $price, $image);
				$stmt->execute();

				if ($stmt->affected_rows >0) {
					echo "<p>Book inserted into the database.</p>";
				} else {
					echo "<p>An error has occurred.<br/>
						  The item was not added.</p>";
				}

				$db->close();		

			echo "</div>";
			$this-> DisplayFooter();
			echo "</body>\n</html>\n";
		}

		public function DisplayFeedback()
		{

			$name = trim($_POST['name']);
			$email = trim($_POST['email']);
			$feedback = trim($_POST['feedback']);

			$toaddress = "andersm3@student.lasalle.edu";
			$subject = "Feedback from Book Repo";

			$mailcontent = "Customer name: ".str_replace("\r\n", "", $name)."\n".
						   "Customer email: ".str_replace("\r\n", "", $email)."\n".
						   "Customer comments:\n".str_replace("\r\n", "", $feedback)."\n";

			$fromaddress = "From: BookRepo@bookrepo.com";

			mail($toaddress, $subject, $mailcontent, $fromaddress);

			echo "<html>\n<head>\n";
			$this-> DisplayTitle();
			//$this-> DisplayKeywords();
			$this-> DisplayStyles();
			echo "</head>\n<body>\n";
			$this-> DisplayHeader();
			$this-> DisplayMenu($this->buttons);
			echo "<div class='maincontent'>";

						echo "<h1>Feedback Submitted</h1>";
						echo "<p>Your feedback has been sent.</p>";

			echo "</div>";
			$this-> DisplayFooter();
			echo "</body>\n</html>\n";
		}

		public function DisplayTitle()
		{
			echo "<title>".$this->title."</title>";
		}

		public function DisplayKeywords()
		{
			echo "<meta name='keywords' content='".$this->keywords."'/>";
		}

		public function DisplayStyles()
		{
			?>
			<link href="../css/styles.css" type="text/css" rel="stylesheet">
			<?php
		}

		public function DisplayHeader()
		{
			?>
			<!-- Page Header -->
			<header>
			</header>
			<?php
		}

		public function DisplayMenu($buttons)
		{
				echo "<!-- menu -->
				<ul class='menu'>";

				$i = 1;

				while (list($name, $url) = each($buttons)) {
					$this->DisplayButton($i, $name, $url, true);
						//!$this->IsURLCurrentPage($url));

					$i = $i + 1;
				}

				echo "</ul>\n";
		}

		public function IsURLCurrentPage($url)
		{
			if(strpos($_SERVER['PHP_SELF'],$url)===false)
			{
				return false;
			}
			else
			{
				return true;
			}
		}

		public function DisplayButton($i, $name,$url,$active=true)
		{
			if($active) 
			{
				if($i == 1) {
					?> 
					<li class="menuitem1">
						<a href="<?=$url?>">
							<span class="menutext"><?=$name?></span>
						</a>
					</li>

					<?php 
				} 
				else 
				{ 
					?>
					<div class="menuitem">
						<a href="<?=$url?>">
							<span class="menutext"><?=$name?></span>
						</a>
					</div>
			<?php
				}
			}
		}

		public function DisplayFooter()
		{
			?>
			<!-- page footer -->
			<footer class="footer">
				<p>&copy; Anderson's Books</p>
				</footer>
				<?php
		}

		public function display_registration_form() {
			echo "<html>\n<head>\n";
			$this-> DisplayTitle();
			$this-> DisplayStyles();
			echo "</head>\n<body>\n";
			$this-> DisplayHeader();
			$this-> DisplayMenu($this->buttons2);
			echo "<div class='maincontent'>";
		?>

		 <form method="post" action="register_new.php">

		 <div class="formblock">
		    <h2>Register Now</h2>

		    <p><label for="email">Email Address:</label><br/>
		    <input type="email" name="email" id="email" 
		      size="30" maxlength="100" required /></p>

		    <p><label for="username">Preferred Username <br>(max 16 chars):</label><br/>
		    <input type="text" name="username" id="username" 
		      size="16" maxlength="16" required /></p>

		    <p><label for="passwd">Password <br>(between 6 and 16 chars):</label><br/>
		    <input type="password" name="passwd" id="passwd" 
		      size="16" maxlength="16" required /></p>

		    <p><label for="passwd2">Confirm Password:</label><br/>
		    <input type="password" name="passwd2" id="passwd2" 
		      size="16" maxlength="16" required /></p>


		    <button type="submit">Register</button>

		   </div>

		  </form>
		<?php

			echo "</div>";
			$this-> DisplayFooter();
			echo "</body>\n</html>\n";
		}

public function display_login_form() {
			echo "<html>\n<head>\n";
			$this-> DisplayTitle();
			$this-> DisplayStyles();
			echo "</head>\n<body>\n";
			$this-> DisplayHeader();
			$this-> DisplayMenu($this->buttons2);
			echo "<div class='maincontent'>";
		?>

		  <p><a href="register_form.php">Not a member?</a></p>
		  <form method="post" action="member.php">

		  <div class="formblock">
		    <h2>Members Log In Here</h2>

		    <p><label for="username">Username:</label><br/>
		    <input type="text" name="username" id="username" /></p>

		    <p><label for="passwd">Password:</label><br/>
		    <input type="password" name="passwd" id="passwd" /></p>

		    <button type="submit">Log In</button>
		  </div>

		 </form>
		<?php

			echo "</div>";
			$this-> DisplayFooter();
			echo "</body>\n</html>\n";
		}









		public function DisplayBooksOld()
		{
			echo "<html>\n<head>\n";
			$this-> DisplayTitle();
			//$this-> DisplayKeywords();
			$this-> DisplayStyles();
			echo "</head>\n<body>\n";
			$this-> DisplayHeader();
			$this-> DisplayMenu($this->buttons);
			echo "<div class='maincontent'>";
				//create short variable name
				$document_root = $_SERVER['DOCUMENT_ROOT'];

				//TODO: READ CSV FILE
				$books = file("../files/books.csv");
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

					echo "<div class='books'>";
					echo "<img style='float: left;margin-right: 10px;' src='../images/" . @$line[5] . "'/>";
					echo "<span><b>ISBN:</b>" . @$line[1] . "</span><br/>";
					echo "<span><b>Author:</b>" . @$line[2] . "</span><br/>";
					echo "<span><b>Year:</b>" . @$line[3] . "</span><br/>";
					echo "<span><b>Publisher:</b>" . @$line[4] . "</span><br/>";
					echo "</div>";

				}
			echo "</div>";
			$this-> DisplayFooter();
			echo "</body>\n</html>\n";
		}

		public function SearchBooksOLD()
		{
			$keyword = $_POST['keyword'];

			echo "<html>\n<head>\n";
			$this-> DisplayTitle();
			//$this-> DisplayKeywords();
			$this-> DisplayStyles();
			echo "</head>\n<body>\n";
			$this-> DisplayHeader();
			$this-> DisplayMenu($this->buttons);
			echo "<div class='maincontent'>";
				//create short variable name
				$document_root = $_SERVER['DOCUMENT_ROOT'];
				//TODO: USE CSV FILE
				$books = file("../files/books.csv");

				//Count how many elements in array
				$number_of_books = count($books);

				//If no orders, display message
				if ($number_of_books == 0) {
					echo "<p><strong>No books found.<br/>
					Please try again later.</strong></p>";
				}

				//TODO: USE CSV FILE
				for ($i=0; $i<$number_of_books; $i++) {
					//Set strings to lower case for search case insensitive
					if(strpos(strtolower($books[$i]), strtolower($keyword))) {
						//Use explode function to break out fields per record
						$line = explode("\t", $books[$i]);

						echo "<div style='height: 100px;'>";
						echo "<img style='float: left;margin-right: 10px;' src='../images/" . @$line[5] . "'/>";
						echo "<span><b>ISBN:</b>" . @$line[1] . "</span><br/>";
						echo "<span><b>Author:</b>" . @$line[2] . "</span><br/>";
						echo "<span><b>Year:</b>" . @$line[3] . "</span><br/>";
						echo "<span><b>Publisher:</b>" . @$line[4] . "</span><br/>";
						echo "</div>";
						echo "<br/>";
					}
				}
			echo "</div>";
			$this-> DisplayFooter();
			echo "</body>\n</html>\n";
		}

		public function CreateBooksOLD()
		{
			// create short variable names
			$booktitle = $_POST['booktitle'];
			$isbn = $_POST['isbn'];
			$author = $_POST['author'];
			$pubyear = $_POST['pubyear'];
			$publisher = preg_replace('/\t|\R/',' ',$_POST['publisher']);
			$image = $_POST['image'];
			$document_root = $_SERVER['DOCUMENT_ROOT'];
			$date = date('H:i, jS F Y');

			echo "<html>\n<head>\n";
			$this-> DisplayTitle();
			//$this-> DisplayKeywords();
			$this-> DisplayStyles();
			echo "</head>\n<body>\n";
			$this-> DisplayHeader();
			$this-> DisplayMenu($this->buttons);
			echo "<div class='maincontent'>";

				echo "<p>Book Created at " . date('H:i, jS F Y') . "</p>";

				$outputstring = "\n".$booktitle."\t".$isbn."\t".$author."\t".$pubyear."\t".$publisher."\t".$image;

				//open file for appending
				@$fp = fopen("../files/books.csv", 'ab');

				flock($fp, LOCK_EX);

				if (!$fp) {
					echo "<p><strong>Your book could not be processed at this time. Please try again later.</strong></p>";
					exit;
				}

				fwrite($fp, $outputstring, strlen($outputstring));
				flock($fp, LOCK_UN);
				fclose($fp);

				echo "<p>Book created.</p>";

			echo "</div>";
			$this-> DisplayFooter();
			echo "</body>\n</html>\n";
		}
	}
?>



































