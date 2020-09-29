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
					<h1>Manage subscriptions</h1>
          <div class="section-header-breadcrumb">
            <div class="breadcrumb-item active"><a href="<?php echo base_url(); ?>">Dashboard</a></div>
            <div class="breadcrumb-item">Manage subscriptions</div>
          </div>
				</div>
				<div class="section-body">
					<h2 class="section-title">Pricing</h2>
					<p class="section-lead">New Subscription</p>
					<input type="hidden" id="tenant_email" value="<?php echo $tenant->tenant_contact_email; ?>">
					<div class="row">
						<?php foreach ($plans as $plan):
							if($plan->plan_id != 1):
							?>


						<div class="col-12 col-md-4 col-lg-4">
							<div class="pricing">
								<div class="pricing-title">
									<?php echo $plan->plan_name; ?>
								</div>
								<div class="pricing-padding">
									<div class="pricing-price">
										<div> <span>&#8358;</span><?php echo number_format($plan->plan_price) ?></div>
										<div>Per <?php echo number_format($plan->plan_duration)." day(s)" ?></div>
									</div>
									<div class="pricing-details">
										<div class="pricing-item">
											<div class="pricing-item-icon"><i class="fas fa-check"></i></div>
											<div class="pricing-item-label"><?php echo $plan->plan_description; ?></div>
										</div>

									</div>
								</div>
								<div class="pricing-cta">


									<button type="button" onclick="subWithPaystack(<?php echo $plan->plan_id; ?>, <?php echo $plan->plan_price * 100; ?>, <?php echo $tenant->tenant_id; ?>)" class="btn btn-primary btn-lg btn-block">
										Subscribe <i class="fas fa-arrow-right"> </i>
									</button>

								</div>
							</div>
						</div>

						<?php endif; endforeach; ?>


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
  $('title').html('Manage Subscriptions - IHUMANE');
  function subWithPaystack(plan_id, plan_price, tenant_id){
  	var tenant_email = document.getElementById('tenant_email').value;
	  var handler = PaystackPop.setup({
		  key: 'pk_test_3867b2b50fe4f5d7c72a4ad9bcae7c06945c0440',
		  email: tenant_email,
		  amount: parseFloat(plan_price),
		  ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
		  metadata: {
			  custom_fields: [
				  {
					  display_name: "Mobile Number",
					  variable_name: "mobile_number",
					  value: "+2348012345678"
				  }
			  ]
		  },
		  callback: function(response){
			  $.ajax({
				  type: "POST",
				  url: '<?php echo site_url('new_subscription_a'); ?>',
				  data: {plan_id:plan_id,plan_price:plan_price, tenant_email:tenant_email, tenant_id:tenant_id, reference:response.reference},
				  success:function(data)
				  {
					  alert('success. transaction ref is ' + response.reference);
				  },
				  error:function()
				  {
					  alert(this.error);

					  //console.log(this.error);
				  }
			  });

		  },
		  onClose: function(){
			  //e.preventDefault();
			  alert('window closed');
			  //console.log('window closed');
		  }
	  });
	  handler.openIframe();
  }

</script>
