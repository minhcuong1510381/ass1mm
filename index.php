<?php include('inc/header.php'); ?>
	<div class="container">
		<div class="content">
			<div class="title row">
				<div class="col-2"></div>
				<div class="col-8">
					<h1><i class="fa fa-key" aria-hidden="true"></i> Free Crypt</h1>
				</div>
			</div>
			<div class="type row">
				<div class="col-2"></div>
				<div class="col-8">
					<div class="row">
						<div class="col-4 encrypt">
							<a href="encrypt-form.php"><i class="fa fa-lock"></i><br><span>Encrypt</span></a>
						</div>
						<div class="col-4 decrypt">
							<a href="decrypt-form.php"><i class="fa fa-unlock-alt"></i><br><span>Decrypt</span></a>
						</div>
						<div class="col-4 clear">
							<a href="clear.php"><i class="fa fa-trash"></i><br><span>Clear Data</span></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
<?php include('inc/footer.php'); ?>
