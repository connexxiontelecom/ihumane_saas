<!DOCTYPE html>
<html lang="en">
    <head>

		<?php include(APPPATH.'/views/stylesheet.php'); ?>

    </head>


    <body class="fixed-left">
	<div id="app">
		<section class="section">
			<div class="container mt-5">
				<div class="page-error">
					<div class="page-inner">
						<h1>Oops</h1>
						<div class="page-description">
							Your Subscription Has Expired.. Contact your Administrator.
						</div>
						<div class="page-search">

							<div class="mt-3">
								<a href="<?php echo base_url('logout') ?>">Logout</a>
							</div>

							<div class="mt-3">
								<a href="<?php echo base_url(); ?>">Home</a>
							</div>
						</div>
					</div>
				</div>
				<div class="simple-footer mt-5">
					Copyright &copy; IHumane
				</div>
			</div>
		</section>
	</div>


	<?php include(APPPATH.'/views/js.php'); ?>




	</body>
</html>
