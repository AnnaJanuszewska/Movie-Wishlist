<?php
include('header.php');
if((isset($_GET['id']))&&(is_numeric($_GET['id']))){
	$id = $_GET['id'];
}else if((isset($_POST['id']))&&(is_numeric($_POST['id']))){
	$id = $_POST['id'];
}else{
	echo "You have accessed this page in error.";
	exit();
}
require('mysqli_connect.php');
if($_SERVER['REQUEST_METHOD'] == 'POST'){
	if($_POST['check'] == 'Yes'){
		$query = "DELETE FROM movies WHERE id=$id LIMIT 1";
		$run = @mysqli_query($dbc, $query);
		
		if(mysqli_affected_rows($dbc) == 1){
			echo "<p>The movie has been deleted</p>";
			header("Refresh:2, URL=movies_list.php");
		}else{
			echo "<p>The movie could not be deleted. Please try again.</p>";
			echo "<p>".mysqli_error($dbc)."</p>";			
		}
	}else{
		echo "<p>The movie has not been deleted</p>";
		header("Refresh:2, URL=movies_list.php");
	}
}else{
	$query = "SELECT title, dir, year, star FROM movies WHERE id=$id";
	$run = @mysqli_query($dbc, $query);

	if(mysqli_num_rows($run) == 1){
		$row = mysqli_fetch_array($run, MYSQLI_NUM);
		
		echo "<p>Are you sure you want to delete this movie?</p>";
		echo "<form action='delete_movie.php' method='post'>
	

		<div class='form-check form-check-inline'>
			<input class='form-check-input' type='radio' name='check' value='Yes'>
			<label class='form-check-label'>Yes</label>
		</div>
		<div class='form-check form-check-inline'>
			<input class='form-check-input' type='radio' name='check' value='No'>
			<label class='form-check-label'>No</label>
		</div>	
		<input type='hidden' name='id' value='$id' />
		</br>
		</br>
		<div class='col-sm-10'>
			<button type='submit' class='btn btn-dark'>Submit</button>
		</div>
		</form>";
		
	}else{
		echo "This page has been accessed in error";
	}
}

include('footer.php');
?>