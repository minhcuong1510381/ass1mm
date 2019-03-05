<?php include('inc/header.php'); ?>
	<div class="container">
		<div class="title">
			<h1>Decrypt</h1>
		</div>
		<?php 
			if(isset($_GET['msg'])){
				echo '<div id="error" class="alert alert-danger error" role="alert">'.
		  				$_GET['msg'].'</div>';
			}
		 ?>
		<div class="content">
			<form action="decrypt.php" method="post" enctype = "multipart/form-data">
				<div class="form-group">
					<label>Algorithms</label>
					<select onchange="mySelect();" class="form-control algorithms" name="algorithms" id="algorithms">
						<option value="1">DES</option>
						<option value="2">AES</option>
						<option value="3">RSA</option>
					</select>
				</div>
				<div class="form-group" id="keyInput">
					<label>Enter your key</label>
					<input type="text" name="key" class="form-control key">
				</div>
				<div class="form-group" id="file">
					<label>Choose file decrypt</label>
					<input type="file" name="file" class="form-control-file">
				</div>
				<div class="button" id="button">
					<input type="submit" name="btn_submit" value="Decrypt" class="btn btn-primary">
					<a type="cancel" class="btn btn-danger" href="index.php">Cancel</a>
				</div>
			</form>
		</div>
	</div>
	<script>
		setTimeout(function() {
		    $('#error').fadeOut('fast');
		}, 2000);
		function mySelect(){
			var algorithmsID = document.getElementById('algorithms').value;

			if(algorithmsID == 3){
				$("#keyInput").css("display", "none");
				$("#file").css("padding-top","30px");
				$("#button").css("padding-top","30px");
			}
			else{
				$("#keyInput").css("display", "block");
				$("#file").css("padding-top","0");
				$("#button").css("padding-top","0");
			}
		}
	</script>
<?php include('inc/footer.php'); ?>
