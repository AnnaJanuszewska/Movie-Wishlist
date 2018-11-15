<?php 
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	require ('mysqli_connect.php'); 
	
	$errors = array(); 
	
	if (empty($_POST['title'])) {
		$errors[] = 'You forgot to enter title of the movie.';
	} else {
		$t = mysqli_real_escape_string($dbc, trim($_POST['title'])); 
	}
	
	if (empty($_POST['dir'])) {
		$errors[] = 'You forgot to enter director\'s name.';
	} else {
		$dir = mysqli_real_escape_string($dbc, trim($_POST['dir']));
	}
	
	if (empty($_POST['year'])) {
		$errors[] = 'You forgot to enter year of the production.';
	} else {
		$y = mysqli_real_escape_string($dbc, trim($_POST['year']));
	}
	
	if (empty($_POST['star'])) {
		$errors[] = 'You forgot to enter who is starring in this film.';
	} else {
		$s = mysqli_real_escape_string($dbc, trim($_POST['star']));
	}
	
	if (empty($errors)) {	

		$query = "INSERT INTO movies (title, dir, year, star) VALUES ('$t', '$dir', '$y', '$s')";		
		$run = @mysqli_query ($dbc, $query);
		if ($run) {
		
			include('header.php');
			echo '<h1>Thank you!</h1>
				<p>You added a new movie to your wishlist!</p><p><br /></p>';
			header("Refresh:2; URL=movies_list.php");		
			include('footer.php');
		} else {
			echo '<h1>System Error</h1>
			<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
			
			echo '<p>' . mysqli_error($dbc) . '<br /><br />Query: ' . $query . '</p>';
		}		
		mysqli_close($dbc);
	
		exit();
	} else {
		include('header.php');		
		echo '<h1>Error!</h1>
		<h4 class="error">The following error(s) occurred:</h4>';
		foreach ($errors as $msg) {
			echo "<p>&bull;&nbsp;$msg</p>";
		}
		echo '<h4>Please try again.</h4>';
		include('footer.php');
	}
	mysqli_close($dbc);
}
?>