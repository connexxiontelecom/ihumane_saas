<?php
  include(APPPATH.'/views/stylesheet.php');
  $CI =& get_instance();
  $CI->load->model('hr_configurations');
?>

<body>
<div id="app">
	<div class="main-wrapper">
		<div class="navbar-bg"></div>
		<?php include(APPPATH.'/views/topbar.php'); ?>
		<?php include(APPPATH.'/views/sidebar.php'); ?>
		<div class="main-content">
			<section class="section">
				<div class="section-header">
          <div class="section-header-back">
            <a href="<?php echo site_url('query_employee').'/'.$employee->employee_id; ?>" class="btn btn-icon"><i class="fas fa-arrow-left"></i></a>
          </div>
					<h1>View Query</h1>
					<div class="section-header-breadcrumb">
						<div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
						<div class="breadcrumb-item active"><a href="<?php echo site_url('employee'); ?>">Manage Employees</a></div>
						<div class="breadcrumb-item active"><a href="<?php echo site_url('query_employee').'/'.$employee->employee_id; ?>">Employee Queries</a></div>
						<div class="breadcrumb-item">View Query</div>
					</div>
				</div>
				<div class="section-body">
					<h2 class="section-title">All About Viewing Queries</h2>
					<p class="section-lead">You can view details of and respond to queries here</p>
					<div class="row">
						<div class="col-12">
							<div class="card">
								<div class="card-header">
									<h4>Query Thread</h4>
                  <?php if($query->query_status == 1):  ?>
                    <div class="card-header-action">
                      <a href="<?php echo site_url('close_query').'/'.$query->query_id ?>"  class="btn btn-icon icon-left btn-danger">
                        <i class="fa fa-times"></i> Close Query
                      </a>
                    </div>
                  <?php endif; ?>
								</div>
								<div class="card-body">
									<div class="tickets">
										<div class="ticket-items" id="ticket-items">
											<div class="ticket-item active">
												<div class="ticket-title">
													<h4><?php echo $query->query_subject; ?></h4>
												</div>
												<div class="ticket-desc">
													<div><?php echo $employee->employee_first_name." ".$employee->employee_last_name; ?></div>
													<div class="bullet"></div>
													<div><?php echo date('F j, Y', strtotime($query->query_date));  ?></div>
												</div>
											</div>
										</div>
										<div class="ticket-content">
											<div class="ticket-header">
												<div class="ticket-sender-picture img-shadow">
													<img src="<?php echo base_url(); ?>uploads/employee_passports/<?php echo $employee->employee_passport; ?>" alt="image">
												</div>
												<div class="ticket-detail">
													<div class="ticket-title">
														<h4><?php echo $query->query_subject; ?></h4>
													</div>
													<div class="ticket-info">
														<div class="font-weight-600"><?php echo $employee->employee_first_name." ".$employee->employee_last_name; ?></div>
														<div class="bullet"></div>
														<div class="text-primary font-weight-600"><?php echo date('F j, Y', strtotime($query->query_date)) ?></div>
														<div class="bullet"></div>
														<?php if($query->query_status == 1): ?>
                              <div class="text-success font-weight-600">Open</div>
                            <?php elseif ($query->query_status == 0):?>
                              <div class="text-danger font-weight-600">Closed</div>
                            <?php endif;?>
													</div>
												</div>
											</div>
											<div class="ticket-description">
												<?php echo $query->query_body; ?>
												<div class="ticket-divider"></div>
                        <div id="query">
												<?php
												if(!empty($responses)):
													foreach ($responses as $response): ?>
												<div class="row">
													<?php if($response->query_response_responder_id == 0): ?>
													<div class="col-10 col-md-10 col-lg-10 offset-2">
                            <div class="card card-primary">
                              <div class="card-body">
                                <div class="d-flex w-100 justify-content-between">
                                  <h5 class="mb-1">You</h5>
                                  <small><?php echo timespan(strtotime($response->query_response_date), now('Africa/Lagos'), 2)?> ago</small>
                                </div>
                                <p class="mb-1"><?php echo $response->query_response_body; ?></p>
                                <small><?php echo date('F j, Y g:i:s a', strtotime($response->query_response_date));?></small>
                              </div>
                            </div>
													</div>
													<?php else: ?>
													<div class="col-10 col-md-10 col-lg-10">
														<div class="card card-warning">
															<div class="card-body">
                                <div class="list-group">
                                  <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1"><?php echo $employee->employee_first_name?></h5>
                                    <small><?php echo timespan(strtotime($response->query_response_date), now('Africa/Lagos'), 2)?> ago</small>
                                  </div>
                                  <p class="mb-1"><?php echo $response->query_response_body; ?></p>
                                  <small><?php echo date('F j, Y g:i:s a', strtotime($response->query_response_date));?></small>
                                </div>
															</div>
														</div>
													</div>
													<?php endif; ?>
												</div>
												<?php endforeach;
												endif;
												?>
                      </div>
												<?php if($query->query_status == 1):  ?>
												<div class="ticket-form">
													<form action="" data-persist="garlic" id="response_form" method="post">
														<div class="form-group">
															<textarea class="form-control" id="query_response" name="query_response" placeholder="Type a reply ..."></textarea>
															<input type="hidden" name="query_id" id="query_id" value="<?php echo $query->query_id; ?>">

															<input type="hidden" name="tenant_id" id="tenant_id"  value="<?php echo $tenant_id;?>" />
														</div>
														<div class="form-group text-right">
															<button type="button" id="response_button" class="btn btn-primary btn-lg">
																Reply
															</button>
														</div>
													</form>
												</div>
												<?php endif; ?>
											</div>
										</div>
									</div>
                </div>
                <div class="card-footer text-right bg-whitesmoke">
                  <button onclick="location.href='<?php echo site_url('query_employee').'/'.$employee->employee_id;?>'" class="btn btn-danger" type="button">Go Back</button>
                </div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>
	</div>
</div>
<?php include(APPPATH.'/views/footer.php'); ?>
<?php include(APPPATH.'/views/js.php'); ?>
</body>
</html>

<script>
  $('title').html('View Query - IHUMANE')

  $(document).ready(function(){
		setInterval(timestamp, 1000);
		function timestamp() {
			$("#query").load(location.href + " #query");
		}
		$("#response_button").click(function(e){
			e.preventDefault();

			let query_id = $("#query_id").val();
			let query_response = $("#query_response").val();
			let query_responder_id = 0;
			let tenant_id = $("#tenant_id").val();

			$.ajax({
				type: "GET",
				url: '<?php echo site_url('new_response'); ?>',
				data: {query_id:query_id,query_response:query_response, query_responder_id:query_responder_id, tenant_id:tenant_id},
				success:function(data)
				{
					document.getElementById('query_response').value = " ";
					$("#query").load(location.href + " #query");
				},
				error:function()
				{
					alert(this.error);

					//console.log(this.error);
				}
			});
		});
	});
</script>
