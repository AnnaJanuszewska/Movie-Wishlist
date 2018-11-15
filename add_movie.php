<?php
include('header.php');
?>
<h2>Add movie:</h2>

	<form action='add.php' method='post'>
		<div class='form-group row'>
			<label class='col-sm-2 col-form-label'>Title:</label>
			<div class='col-sm-10'>
				<input type='text' name='title'>
			</div>
		</div>
		<div class='form-group row'>
			<label class='col-sm-2 col-form-label'>Director:</label>
			<div class='col-sm-10'>
				<input type='text' name='dir'>
			</div>
		</div>
		<div class='form-group row'>
			<label class='col-sm-2 col-form-label'>Year:</label>
			<div class='col-sm-10'>
				<input type='number' name='year'>
			</div>
		</div>
		<div class='form-group row'>
			<label class='col-sm-2 col-form-label'>Starring:</label>
			<div class='col-sm-10'>
				<input type='text' name='star'>
			</div>
		</div>
		<div class='col-sm-10'>
			<button type='submit' class='btn btn-dark'>Submit</button>
		</div>
	</form>	

<?php
include('footer.php');
?>