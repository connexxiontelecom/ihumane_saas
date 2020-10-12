<?php
defined('BASEPATH') or exit('No direct script access allowed');
?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
	<meta content="IHUMANE" name="description" />
	<meta content="Connexxion Group" name="author" />

	<title>IHUMANE</title>
	<!-- General CSS Files -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fontawesome/css/all.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/offline/css/offline-language-english.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/offline/css/offline-theme-slide.css">
	<!-- Template CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">
  <style>
    .login-bg-2 { background-image: url("<?php echo base_url() ?>assets/img/unsplash/login-bg-2.jpg"); }
    .login-bg-3 { background-image: url("<?php echo base_url() ?>assets/img/unsplash/login-bg-3.jpg"); }
    .login-bg-4 { background-image: url("<?php echo base_url() ?>assets/img/unsplash/login-bg-4.jpg"); }
    .login-bg-5 { background-image: url("<?php echo base_url() ?>assets/img/unsplash/login-bg-5.jpg"); }
    .login-bg-6 { background-image: url("<?php echo base_url() ?>assets/img/unsplash/login-bg-6.jpg"); }
	#partitioned {
		padding-left: 15px;
		letter-spacing: 42px;
		border: 0;
		background-image: linear-gradient(to left, black 70%, rgba(255, 255, 255, 0) 0%);
		background-position: bottom;
		background-size: 50px 1px;
		background-repeat: repeat-x;
		background-position-x: 35px;
		width: 220px;
		min-width: 220px;
	}

	#divInner{
		left: 0;
		position: sticky;
	}

	#divOuter{
		width: 190px;
		overflow: hidden;
	}
	}
  </style>
</head>

<body>

<div id="app">
	<section class="section">
		<div class="container mt-5">
			<div class="row">
				<div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
					<div class="login-brand">
						<img src="<?php echo base_url() ?>/assets/img/ihumane-logo-2.png" width="100" class="shadow-light rounded-circle">
					</div>

					<div class="card card-primary">
						<div class="card-header"><h4>A Reset Token Sent to Your Email</h4></div>

						<div class="card-body">
							<p class="text-muted">Please Enter The Token:</p>
							<form method="POST" action="<?php echo site_url('reset_password'); ?>">
								<div class="form-group">
									<input type="hidden" name="<?php echo $csrf_name; ?>" value="<?php echo $csrf_hash; ?>" />
									<div id="divOuter" style="margin-left: 20%">
										<div id="divInner">
											<input id="partitioned" name="entered_token" type="text" maxlength="5" />
											<input type="hidden" name="official_email" value="<?php echo $email; ?>">
										</div>
									</div>
								</div>

								<div class="form-group">
									<button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
										Reset Password
									</button>
								</div>
							</form>
						</div>
					</div>
					<div class="simple-footer">
						Copyright &copy; <a href="https://telecom.connexxiongroup.com" target="_blank">Connexxion Telecom</a>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>



	<!-- General JS Scripts -->
	<script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
	<script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>
	<script src="<?php echo base_url(); ?>assets/modules/offline/js/offline.min.js"></script>

	<!-- Template JS File -->
	<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
	<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
	<script>
		$('title').html('Welcome - IHUMANE');

		$(document).ready(function() {

			var obj = document.getElementById('partitioned');
			obj.addEventListener('keydown', stopCarret);
			obj.addEventListener('keyup', stopCarret);

			function stopCarret() {
				if (obj.value.length > 3){
					setCaretPosition(obj, 3);
				}
			}

			function setCaretPosition(elem, caretPos) {
				if(elem != null) {
					if(elem.createTextRange) {
						var range = elem.createTextRange();
						range.move('character', caretPos);
						range.select();
					}
					else {
						if(elem.selectionStart) {
							elem.focus();
							elem.setSelectionRange(caretPos, caretPos);
						}
						else
							elem.focus();
					}
				}
			}


			setInterval(timestamp, 1000);
			let today = new Date();
			let curHr = today.getHours();
      let bgImages = [ 'login-bg-2', 'login-bg-3', 'login-bg-4', 'login-bg-5', 'login-bg-6' ];
      let randomNumber = Math.floor(Math.random() * bgImages.length);
      let randomImage = bgImages[randomNumber];
      $('.bg').addClass(randomImage);
      if (curHr < 12) {
				$('.greeting').html('Good Morning')
			} else if (curHr < 18) {
				$('.greeting').html('Good Afternoon')
			} else {
				$('.greeting').html('Good Evening')
			}
		});

		function timestamp() {
			$.ajax({
				url: '<?php echo site_url('timestamp') ?>',
				success: function(data) {
					$('#timestamp').html(data);
				}
			})
		}
	</script>

</body>

</html>
