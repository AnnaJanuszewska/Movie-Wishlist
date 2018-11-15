<?php
include('header.php');

require("mysqli_connect.php");

$q = "SELECT id, title, dir, year, star FROM movies ORDER BY title ASC";

$r = @mysqli_query($dbc, $q);

$num = mysqli_num_rows($r);

if($num > 0) {
	echo "<p>There are currently <span id='number'> $num </span> movies on your wishlist.</p>";
	echo "
	<table class='table'>
		<thead class='thead-dark'>
			<tr>
				<th scope='col'>Title</th>
				<th scope='col'>Director</th>
				<th scope='col'>Year</th>
				<th scope='col'>Starring</th>
				<th scope='col'>Edit</th>
				<th scope='col'>Delete</th>
			</tr>
		</thead>";
		

	while($row = mysqli_fetch_array($r, MYSQLI_ASSOC)) {
		echo "
		<tbody>
			<tr>
				<td>".$row['title']."</th>
				<td>".$row['dir']."</td>
				<td>".$row['year']."</td>
				<td>".$row['star']."</td>
				<td><a href='edit_movie.php?id=".$row['id']."'>Edit Movie</a></td>
				<td><a href='delete_movie.php?id=".$row['id']."'>Delete Movie</a></td>
			</tr>

		</tbody>";
		}
		echo "</table>";
	} else {
		echo "<p>There are currently no movies on your list:</p>";
}

mysqli_close($dbc);
include('footer.php');
?>