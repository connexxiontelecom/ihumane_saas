<?php include(APPPATH.'/views/stylesheet.php'); ?>

<body>
<div id="app">
	<div class="main-wrapper">
		<div class="navbar-bg"></div>
		<?php include(APPPATH.'/views/topbar.php'); ?>
		<?php include(APPPATH.'/views/sidebar.php'); ?>
		<div class="main-content">
			<section class="section">
				<div class="section-header">
					<h1>Basic Configuration</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Configurations</div>
          </div>
				</div>
        <div class="section-body">
          <div class="section-title">All About Configurations</div>
          <p class="section-lead">You Can Update Configurations</p>
          <div class="row">
            <div class="col-12">
              <div class="card">
<!--                <div class="card-header">-->
<!--                <h4>All Allowances</h4>-->
<!--                  <div class="card-header-action">-->
<!--                       </div>-->
<!--                </div>-->
                <div class="card-body">
					<div class="row">
						<?php if(empty($configurations)): ?>
						<div class="col-md-9">
							<form class="needs-validation" data-persist="garlic" novalidate method="post" action="<?php echo site_url('new_options'); ?>" enctype="multipart/form-data">
								<div class="card card-primary">

									<div class="card-body">
										<div class="form-group row">

											<div class="col-sm-12">
												<label>Company Name</label><span style="color: red"> *</span>
												<input type="text" class="form-control" value="<?php echo $tenant_data->tenant_business_name; ?>"  name="company_name" required/>
												<div class="invalid-feedback">
													please fill in a valid detail
												</div>
											</div>

										</div>

										<div class="form-group row">

											<div class="col-sm-12">
												<label>Company Address</label><span style="color: red"> *</span>
												<input type="text" class="form-control"  name="company_address" required/>
												<div class="invalid-feedback">
													please fill in a valid detail
												</div>
											</div>

										</div>

										<div class="form-group row">

											<div class="col-sm-6">
												<label>Company Logo</label>
												<div class="custom-file">
													<input id="company_logo" name="company_logo" class="custom-file-input" type="file">
													<label for="company_logo" class="custom-file-label">Choose File</label>
												</div>
											</div>
										</div>


										<div class="form-group row">

											<div class="col-sm-6">
												<label>Managing Director Signature</label>
												<div class="custom-file">
													<input id="md_signature" name="md_signature" class="custom-file-input" type="file">
													<label for="md_signature" class="custom-file-label">Choose File</label>
												</div>
											</div>
										</div>

										<div class="form-group row">

											<div class="col-sm-6">
												<label>Accountant Signature</label>
												<div class="custom-file">
													<input id="accountant_signature" name="accountant_signature" class="custom-file-input" type="file">
													<label for="accountant_signature" class="custom-file-label">Choose File</label>
												</div>
											</div>
										</div>

										<div class="form-group row">

											<div class="col-sm-6">
												<label>HR Signature</label>
												<div class="custom-file">
													<input id="hr_signature" name="hr_signature" class="custom-file-input" type="file">
													<label for="hr_signature" class="custom-file-label">Choose File</label>
												</div>
											</div>
										</div>
										<input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
									</div>

									<div class="card-footer text-right bg-whitesmoke">
										<button type="submit"  class="btn btn-primary">Set Options</button>

												</div>
								</div>
							</form>
						</div>

						<?php else: ?>

							<div class="col-md-9">
								<form class="needs-validation" data-persist="garlic" novalidate method="post" action="<?php echo site_url('update_options'); ?>" enctype="multipart/form-data">
									<div class="card card-primary">

										<div class="card-body">
											<div class="form-group row">

												<div class="col-sm-12">
													<label>Company Name</label><span style="color: red"> *</span>
													<input type="text" class="form-control" value="<?php echo $configurations->configuration_company; ?>"  name="company_name" required/>
													<div class="invalid-feedback">
														please fill in a valid detail
													</div>
												</div>

											</div>

											<div class="form-group row">

												<div class="col-sm-12">
													<label>Company Address</label><span style="color: red"> *</span>
													<input type="text" class="form-control" value="<?php echo $configurations->configuration_address; ?>"  name="company_address" required/>
													<div class="invalid-feedback">
														please fill in a valid detail
													</div>
												</div>

											</div>

											<div class="form-group row">
												<div class="col-sm-6">

													<figure class="figure">
														<img src="<?php echo base_url()."/uploads/config/".$configurations->configuration_logo; ?>" alt="" width="100" height="100" class="figure-img img-fluid rounded mx-auto d-block w-80 img-thumbnail">
														<figcaption class="figure-caption">Company Logo</figcaption>
													</figure>
												</div>
												<div class="col-sm-6">
													<label>Company Logo</label>
													<div class="custom-file">
														<input id="company_logo" name="company_logo" class="custom-file-input" type="file">
														<label for="company_logo" class="custom-file-label">Choose File</label>
													</div>
												</div>
											</div>


											<div class="form-group row">
												<div class="col-sm-6">

													<figure class="figure">
														<img src="<?php echo base_url()."/uploads/config/".$configurations->configuration_md; ?>" alt="" width="100" height="100" class="figure-img img-fluid rounded mx-auto d-block w-80 img-thumbnail">
														<figcaption class="figure-caption">Md Signature</figcaption>
													</figure>
												</div>
												<div class="col-sm-6">
													<label>Managing Director Signature</label>
													<div class="custom-file">
														<input id="md_signature" name="md_signature" class="custom-file-input" type="file">
														<label for="md_signature" class="custom-file-label">Choose File</label>
													</div>
												</div>
											</div>

											<div class="form-group row">

												<div class="col-sm-6">

													<figure class="figure">
														<img src="<?php echo base_url()."/uploads/config/".$configurations->configuration_acc; ?>" alt="" width="100" height="100" class="figure-img img-fluid rounded mx-auto d-block w-80 img-thumbnail">
														<figcaption class="figure-caption">Accountant Signature</figcaption>
													</figure>
												</div>

												<div class="col-sm-6">
													<label>Accountant Signature</label>
													<div class="custom-file">
														<input id="accountant_signature" name="accountant_signature" class="custom-file-input" type="file">
														<label for="accountant_signature" class="custom-file-label">Choose File</label>
													</div>
												</div>
											</div>

											<div class="form-group row">
												<div class="col-sm-6">

													<figure class="figure">
														<img src="<?php echo base_url()."/uploads/config/".$configurations->configuration_hr; ?>" alt="" width="100" height="100" class="figure-img img-fluid rounded mx-auto d-block w-80 img-thumbnail">
														<figcaption class="figure-caption">HR Signature</figcaption>
													</figure>
												</div>
												<div class="col-sm-6">
													<label>HR Signature</label>
													<div class="custom-file">
														<input id="hr_signature" name="hr_signature" class="custom-file-input" type="file">
														<label for="hr_signature" class="custom-file-label">Choose File</label>
													</div>
												</div>
											</div>
											<input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />
										</div>

										<div class="card-footer text-right bg-whitesmoke">
											<button type="submit"  class="btn btn-primary">Update Options</button>

										</div>
									</div>
								</form>
							</div>


						<?php endif; ?>
					</div>
                </div>
                <div class="card-footer bg-whitesmoke"></div>
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
	$('title').html('App Configurations - IHUMANE')
	$(".custom-file-input").on('change', function() {
		let fileName = $(this).val().split('//').pop();
		$(this).siblings('.custom-file-label').addClass('selected').html(fileName);
	});
</script>
