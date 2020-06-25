<!DOCTYPE html>
<html lang="en">
<head>

	<?php include(APPPATH.'\views\stylesheet.php');

	?>
	<!-- DataTables -->


</head>


<body class="fixed-left">
<!-- Begin page -->
<div id="app">
	<div class="main-wrapper">
		<div class="navbar-bg"></div>
		<?php include(APPPATH.'\views\topbar.php'); ?>


		<?php include(APPPATH.'\views\sidebar.php'); ?>



		<div class="main-content">
			<section class="section">
				<div class="section-header">

					<h1>Pension Administrator Setup</h1>

				</div>


				<div class="row">
					<div class="col-12 col-md-12 col-lg-12">
						<div class="card">
							<div class="card-body">
								<button class="btn btn-secondary btn-round" type="button"data-toggle="modal" data-target="#add_pension" aria-haspopup="true" aria-expanded="false" style="margin: 5vh">
									<i class="mdi mdi-new-box "></i>Add New Pension Administrator
								</button>



								<table id="datatable-buttons" class="table table-bordered table-md">
									<thead>



									<tr>
										<th>Pension Provider</th>
										<th>Action</th>

									</tr>
									</thead>


									<tbody>
									<?php if(!empty($pensions)):
										foreach($pensions as $pension):
											?>
											<tr>
												<td><?php echo $pension->pension_provider; ?></td>
												<td> <button type="button" class="btn btn-primary m-b-10 m-l-10 waves-effect waves-light" data-toggle="modal" data-target="#edit_pension<?php echo $pension->pension_id ?>">
														<i class="mdi mdi-table-edit "></i>
													</button>
													<button type="button" class="btn btn-danger m-b-10 m-l-10 waves-effect waves-light">
														<i class="mdi mdi-delete-forever "></i>
													</button></td>

											</tr>

										<?php

										endforeach;
									endif; ?>

									</tbody>
								</table>




							</div>


						</div>
					</div>




				</div>

			</section>
			<div class="modal fade" id="add_pension" tabindex="-1" role="dialog" aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLongTitle2">Add New pension</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true" class="text-dark">&times;</span>
							</button>
						</div>
						<form class="" method="post" action="<?php echo site_url('add_pension'); ?>">
							<div class="modal-body">

								<div class="form-group">
									<label>Pension Provider:</label>
									<input type="text" class="form-control"  name="pension_provider" required placeholder="Enter Name of pension"/>
								</div>


								<input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />


							</div>
							<div class="modal-footer">
								<button type="submit" class="btn btn-primary">Add New pension</button>
								<button type="reset" class="btn btn-danger ml-2" data-dismiss="modal">Close</button>
							</div>
						</form>
					</div>
				</div>
			</div>


			<?php foreach($pensions as $pension): ?>
				<div class="modal fade" id="edit_pension<?php echo $pension->pension_id ?>" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<div class="modal-header">
								<h5 class="modal-title" id="exampleModalLongTitle2">Update pension</h5>
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true" class="text-dark">&times;</span>
								</button>
							</div>
							<form class="" method="post" action="<?php echo site_url('update_pension'); ?>">
								<div class="modal-body">

									<div class="form-group">
										<label>Name of pension:</label>
										<input type="text" class="form-control"  name="pension_provider" required value="<?php echo $pension->pension_provider; ?>" placeholder="Enter Name of pension"/>
									</div>


									<input type="hidden" name="<?php echo $csrf_name;?>" value="<?php echo $csrf_hash;?>" />

									<input type="hidden" name="pension_id" value="<?php echo $pension->pension_id;?>" />


								</div>
								<div class="modal-footer">
									<button type="submit" class="btn btn-primary">Update pension</button>
									<button type="reset" class="btn btn-danger ml-2" data-dismiss="modal">Close</button>
								</div>
							</form>
						</div>
					</div>
				</div>

			<?php endforeach; ?>
		</div>
	</div>

</div>
<!-- END wrapper -->


<?php include(APPPATH.'\views\js.php'); ?>


</body>
</html>

