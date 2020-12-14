
<?php
	include(APPPATH.'/views/stylesheet.php');
	$CI =& get_instance();
	$CI->load->model('hr_configurations');
	$CI->load->model('chats');
	$CI->load->model('employees');
  $username = $this->session->userdata('user_username');
  $tenant_id = $this->users->get_user($username)->tenant_id;
?>

<body class="layout-3">
<div id="app">
	<div class="main-wrapper container">
		<div class="navbar-bg"></div>
		<?php include('header.php'); ?>
		<?php include('menu.php'); ?>
		<div class="main-content">
			<section class="section">
				<div class="section-header">
					<h1>Chat</h1>
					<div class="section-header-breadcrumb">
						<div class="breadcrumb-item active"><a href="<?php echo base_url('employee_main'); ?>">Dashboard</a></div>
						<div class="breadcrumb-item">Chat</div>
					</div>
				</div>
				<div class="section-body">
					<div class="section-title">All About Chat Engagements</div>
					<p class="section-lead">You can chat with your colleagues here</p>
					<div class="row" id="chat-tab">
					<div class="col-12 col-sm-12 col-lg-4" >
						<div class="card">
							<div class="card-header">
								<h4>All Users</h4>
							</div>
							<div class="card-body" style="height: 400px;
	overflow-y: auto;" >
								<ul class="list-unstyled list-unstyled-border">
									<?php foreach ($users as $user):
									if($user->user_type == 3 || $user->user_type == 2):
									//if(!empty($user->user_token)):
										$employee_details = @$this->employees->get_employee_by_unique($user->user_username, $tenant_id);
									if($employee_details->employee_id !== $employee_id):
									?>
								<li class="media">
									<a class="link" href="#" data-rel="<?php echo $employee_details->employee_id; ?>">
                    <div class="media">
                      <img alt="image" class="mr-3 rounded" width="30" height="30" src="<?php echo base_url(); ?>uploads/employee_passports/<?php echo $employee_details->employee_passport; ?>">
                      <div class="media-body">
                        <div class="mt-0 mb-1 font-weight-bold"><?php echo $employee_details->employee_first_name." ". $employee_details->employee_last_name; ?></div>
                      </div>
                    </div>
									</a>
								</li>
									<?php

										endif;
										//endif;
										endif;
										endforeach; ?>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-12 col-sm-12 col-lg-8">
						<div class="content-container" style="display: none">
							<?php foreach ($users as $user):
								if($user->user_type == 3 || $user->user_type == 2):
									$employee_details = @$CI->employees->get_employee_by_unique($user->user_username, $tenant_id);
										?>
									<div id="<?php echo $employee_details->employee_id; ?>">
										<div class="card chat-box" style="height: 470px">
											<div class="card-header">
												<h4>Chat with <?php echo $employee_details->employee_first_name." ". $employee_details->employee_last_name; ?></h4>
												<?php if(!empty($user->user_token)): ?>
													<div class="text-success text-small font-600-bold"><i class="fas fa-circle"></i> Online</div>
												<?php endif; ?>
												<?php if(empty($user->user_token)): ?>
													<div class="text-small font-weight-600 text-muted"><i class="fas fa-circle"></i> Offline</div>
												<?php endif; ?>
											</div>
											<div class="card-body chat-content" id="chat_contents<?php echo $employee_details->employee_id; ?>"></div>


											<div class="card-footer chat-form">
												<form onsubmit="send_message(<?php echo $employee_id; ?>, <?php echo $employee_details->employee_id; ?>)" id="<?php echo $employee_details->employee_id; ?>">
<!--													<textarea class="form-control" id="message--><?php //echo $employee_details->employee_id; ?><!--"  placeholder="Type a message ..."></textarea>-->

												<input type="text" id="message<?php echo $employee_details->employee_id; ?>" class="form-control"  placeholder="Type a message">
													<button type="button" onclick="send_message(<?php echo $employee_id; ?>, <?php echo $employee_details->employee_id; ?>)" class="btn btn-primary">
														<i class="far fa-paper-plane"></i>
													</button>
												</form>
											</div>
										</div>
									</div>
									<?php
								endif;
							endforeach; ?>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<?php include(APPPATH.'/views/footer.php'); ?>
	</div>
</div>
<?php include(APPPATH.'/views/js.php'); ?>
</body>
</html>


<script>
	$('title').html('Chat - IHUMANE')

	$(document).ready(function(){

		$(window).keydown(function(event){
			if(event.keyCode === 13) {
				event.preventDefault();
				return false;
			}
		});


		setInterval(timestamp, 1000);
		function timestamp() {
			<?php foreach ($users as $user):
			if($user->user_type == 2 || $user->user_type == 3):
			$employee_details = @$CI->employees->get_employee_by_unique($user->user_username, $tenant_id); ?>
			var sender_ids = <?php echo $employee_id; ?>;
			var reciever_ids = <?php echo $employee_details->employee_id; ?>;
			$.ajax({
				type: "GET",
				url: '<?php echo site_url('get_chats'); ?>',
				data: {sender_id:sender_ids, reciever_id:reciever_ids},
				success:function(data)
				{

				$('#chat_contents<?php echo $employee_details->employee_id; ?>').html(data);

				},
				error:function()
				{
					//alert(this.error);

				}
			});

			<?php endif;
			endforeach; ?>


		}

		$(".link").click(function(e) {
			e.preventDefault();
			$('.content-container').fadeIn('slow');
			$('#' + $(this).data('rel')).siblings().hide();
			$('#' + $(this).data('rel')).fadeIn('slow');

		});

	});

	function send_message(sender_id, reciever_id) {
			$(document).ready(function () {
				var message = document.getElementById('message'+reciever_id).value;

				$.ajax({
					type: "GET",
					url: '<?php echo site_url('send_chat'); ?>',
					data: {sender_id:sender_id, reciever_id:reciever_id, message:message},
					success:function(data)
					{
						document.getElementById('message'+reciever_id).value = "";

					},
					error:function()
					{
						// alert(this.error);

						console.log(this.error);
					}
				});

				<?php foreach ($users as $user):
				if($user->user_type == 2 || $user->user_type == 3):
				$employee_details = @$CI->employees->get_employee_by_unique($user->user_username, $tenant_id); ?>
				$.ajax({
					type: "GET",
					url: '<?php echo site_url('get_chats'); ?>',
					data: {sender_id:sender_id, reciever_id:reciever_id, message:message},
					success:function(data)
					{

						document.getElementById('chat_contents'+reciever_id).innerHTML = data;

					},
					error:function()
					{
						// alert(this.error);

						console.log(this.error);
					}
				});



				<?php endif;
				endforeach; ?>





			})


	}

</script>









