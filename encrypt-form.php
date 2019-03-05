<?php include('inc/header.php'); ?>
	<div class="container">
		<div class="title">
			<h1>Encrypt</h1>
		</div>
		<?php 
			if(isset($_GET['msg'])){
				echo '<div id="error" class="alert alert-danger error" role="alert">'.
		  				$_GET['msg'].'</div>';
			}
		 ?>
		<div class="content">
			<form action="encrypt.php" method="post" enctype = "multipart/form-data">
				<div class="form-group">
					<label>Algorithms</label>
					<select onchange="mySelectEncrypt();" class="form-control algorithms" name="algorithms" id="algorithms">
						<option value="1">DES</option>
						<option value="2">AES</option>
						<option value="3">RSA</option>
					</select>
				</div>
				<div class="form-group" id="publicKey" style="display: none">
					<label>Choose Public Key to Encrypt (2048 bit)</label>
					<input type="file" name="publicFile" class="form-control-file">
				</div>
				<div class="form-group" id="privateKey" style="display: none">
					<label>Choose Private Key to Sign (2048 bit)</label>
					<input type="file" name="privateFile" class="form-control-file">
				</div>
				<div class="form-group" id="file" style="padding-top: 30px;">
					<label>Choose file to Encrypt</label>
					<input type="file" name="file" class="form-control-file">
				</div>
				<div class="button" style="padding-top: 30px;">
					<input type="submit" name="btn_submit" value="Encrypt" class="btn btn-primary">
					<a type="cancel" class="btn btn-danger" href="index.php">Cancel</a>
				</div>
			</form>
		</div>
	</div>
<?php include('inc/footer.php'); ?>
