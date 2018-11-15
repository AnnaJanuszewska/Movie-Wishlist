<?php
include('header.php');

if((isset($_GET['id'])) && (is_numeric($_GET['id']))){
	$id = $_GET['id'];
}else if((isset($_POST['id'])) && (is_numeric($_POST['id']))){
	$id = $_POST['id'];
}else{
	echo "This page has been accessed in error";
	exit();
}

require('mysqli_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$errors = array();
	
	if(empty($_POST['title'])){
		$errors[] = 'You forgot to enter title of the movie.';
	}else{
		$t = mysqli_real_escape_string($dbc, trim($_POST['title']));
	}
	
	if (empty($_POST['dir'])) {
		$errors[] = 'You forgot to enter name of the director.';
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
	
	if(empty($errors)){
		$query = "UPDATE movies SET title='$t', dir='$dir', year='$y', star='$s' WHERE id=$id LIMIT 1";
		
		$run = @mysqli_query($dbc, $query);
		
		if(mysqli_affected_rows($dbc) == 1){
			echo "<p>The movie has been edited.</p>";
			header("Refresh:2; URL=movies_list.php");
		}else{
			echo "<p>The movie could not be updated. Please try again.";
			echo "<p>".mysqli_error($dbc)."</p>";
		}
		
	}else{
		echo "<p>The following error(s) have occurred:</p>";
		foreach ($errors as $msg){
			echo "&bull;&nbsp;$msg<br>";
		}
	}
}	

$query = "SELECT title, dir, year, star FROM movies WHERE id =".$id;
$run = @mysqli_query($dbc, $query);

if(mysqli_num_rows($run) == 1){
	$row = mysqli_fetch_array($run, MYSQLI_NUM);
	echo "
	<h2>Edit movie:</h2>
	
	<form action='edit_movie.php' method='post'>
		<div class='form-group row'>
			<label class='col-sm-2 col-form-label'>Title:</label>
			<div class='col-sm-10'>
				<input type='text' name='title' value='".$row[0]."'>
			</div>
		</div>
		<div class='form-group row'>
			<label class='col-sm-2 col-form-label'>Director:</label>
			<div class='col-sm-10'>
				<input type='text' name='dir' value='".$row[1]."'>
			</div>
		</div>
		<div class='form-group row'>
			<label class='col-sm-2 col-form-label'>Year:</label>
			<div class='col-sm-10'>
				<input type='number' name='year' value='".$row[2]."'>
			</div>
		</div>
		<div class='form-group row'>
			<label class='col-sm-2 col-form-label'>Starring:</label>
			<div class='col-sm-10'>
				<input type='text' name='star' value='".$row[3]."'>
			</div>
		</div>
		<div>
			<input type='hidden' name='id' value='$id' />
		</div>
		<div class='col-sm-10'>
      <button type='submit' class='btn btn-dark'>Submit</button>
    </div>
	</form>";	
}

include('footer.php')
?>