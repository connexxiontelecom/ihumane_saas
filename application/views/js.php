		<?php
		defined('BASEPATH') OR exit('No direct script access allowed');
		?>
		<!-- General JS Scripts -->
		<script src="<?php echo base_url(); ?>assets/modules/jquery.min.js"></script>

		<script src="<?php echo base_url(); ?>assets/modules/popper.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/tooltip.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/bootstrap/js/bootstrap.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/nicescroll/jquery.nicescroll.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/moment.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/stisla.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/garlic.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/push_notification.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/parsleyjs/parsley.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/offline/js/offline.min.js"></script>

		<script src="<?php echo base_url(); ?>assets/js/stis.js"></script>
		<script src="https://js.paystack.co/v1/inline.js"></script>
		<!-- JS Libraies -->
		<script src="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/prism/prism.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/sticky-kit.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/dropzonejs/min/dropzone.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/modules/dropzone/dist/dropzone.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/cleave-js/dist/cleave.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/cleave-js/dist/addons/cleave-phone.ng.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/bootstrap-daterangepicker/daterangepicker.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/bootstrap-timepicker/js/bootstrap-timepicker.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/select2/dist/js/select2.full.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.playSound.js"></script>
		<?php
			if (
				$this->uri->segment(1) != 'edit_employee_salary_structure' &&
				$this->uri->segment(1) != 'setup_salary_structure' &&
				$this->uri->segment(1) != 'new_employee' &&
				$this->uri->segment(1) != 'new_variational_payment' &&
				$this->uri->segment(1) != 'recall_month' &&
				$this->uri->segment(1) != 'emolument' &&
				$this->uri->segment(1) != 'deduction' &&
				$this->uri->segment(1) != 'pay_order' &&
				$this->uri->segment(1) != 'new_loan' &&
				$this->uri->segment(1) != 'edit_loan' &&
				$this->uri->segment(1) != 'new_user' &&
				$this->uri->segment(1) != 'manage_user' &&
				$this->uri->segment(1) != 'new_payment_definition' &&
				$this->uri->segment(1) != 'edit_payment_definition' &&
				$this->uri->segment(1) != 'new_salary_allowance' &&
				$this->uri->segment(1) != 'edit_salary_allowance' &&
				$this->uri->segment(1) != 'payroll_month_year' &&
				$this->uri->segment(1) != 'new_employee_appraisal' &&
				$this->uri->segment(1) != 'query_employee' &&
				$this->uri->segment(1) != 'new_specific_memo' &&
				$this->uri->segment(1) != 'new_employee_transfer' &&
				$this->uri->segment(1) != 'new_employee_leave' &&
				$this->uri->segment(1) != 'new_employee_training' &&
				$this->uri->segment(1) != 'request_leave' &&
				$this->uri->segment(1) != 'pay_slip' &&
				$this->uri->segment(1) != 'my_new_loan' &&
				$this->uri->segment(1) != 'job_role'
			):
		?>
			<script src="<?php echo base_url(); ?>assets/modules/jquery-selectric/jquery.selectric.min.js"></script>
		<?php endif;?>
		<script src="<?php echo base_url(); ?>assets/modules/printThis.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/fullcalendar/fullcalendar.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/modules/datatables/jquery.dataTables.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/modules/datatables/dataTables.bootstrap4.min.js"></script>
		<!-- Buttons examples -->
		<script src="<?php echo base_url(); ?>/assets/modules/datatables/dataTables.buttons.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/modules/datatables/buttons.bootstrap4.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/modules/datatables/jszip.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/modules/datatables/pdfmake.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/modules/datatables/vfs_fonts.js"></script>
		<script src="<?php echo base_url(); ?>/assets/modules/datatables/buttons.html5.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/modules/datatables/buttons.print.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/modules/datatables/buttons.colVis.min.js"></script>
		<!-- Responsive examples -->
		<script src="<?php echo base_url(); ?>/assets/modules/datatables/dataTables.responsive.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/modules/datatables/responsive.bootstrap4.min.js"></script>
		<script src="<?php echo base_url(); ?>/assets/modules/datatables/datatables.init.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/sweetalert/sweetalert.min.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/upload-preview/assets/js/jquery.uploadPreview.min.js"></script>
    <?php if($this->uri->segment(1) == '' || $this->uri->segment(1) == 'home'):?>
      <!-- Dashboard charts-->
      <script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script>
      <!-- <script src="--><?php //echo base_url(); ?><!--assets/js/page/index-0.js"></script>-->
    <?php endif;?>
		<!-- Template JS File -->
		<script src="<?php echo base_url(); ?>assets/js/scripts.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/custom.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/ajaxmask.js"></script>
		<script src="<?php echo base_url(); ?>assets/js/jquery.timer.js"></script>
		<script src="<?php echo base_url(); ?>assets/modules/visual-countdown-timer/js/script.js"></script>
<!--		<script src="--><?php //echo base_url(); ?><!--assets/js/page/components-chat-box.js"></script>-->
		<script src="<?php echo base_url(); ?>assets/js/page/modules-calendar.js"></script>
		<?php if ($this->uri->segment(1) != 'pay_slips'):?>
			<script>
				$(document).ready(function(){
					setInterval(timestamp, 7000);
					function timestamp() {
						$("#notifications").load(location.href + " #notifications");
					}
				});
			</script>
		<?php endif;?>
		<!-- <script src="<?php echo base_url(); ?>assets/modules/jquery.sparkline.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/simple-weather/jquery.simpleWeather.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jquery.vmap.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/jquery.sparkline.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jquery.vmap.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/maps/jquery.vmap.indonesia.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/jquery-ui/jquery-ui.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/owl.carousel.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/bootstrap-colorpicker/dist/js/bootstrap-colorpicker.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/codemirror/lib/codemirror.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/codemirror/mode/javascript/javascript.js"></script> -->
		<!-- <script src="--><?php //echo base_url(); ?><!--assets/modules/jquery-selectric/jquery.selectric.min.js"></script>-->
		<!-- <script src="http://maps.google.com/maps/api/js?key=AIzaSyB55Np3_WsZwUQ9NS7DP-HnneleZLYZDNw&amp;sensor=true"></script>-->
		<!-- <script src="--><?php //echo base_url(); ?><!--assets/modules/gmaps.js"></script>-->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/chart.min.js"></script> -->
		<!-- <script src="--><?php //echo base_url(); ?><!--assets/modules/datatables/datatables.min.js"></script>-->
		<!-- <script src="--><?php //echo base_url(); ?><!--assets/modules/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>-->
		<!-- <script src="--><?php //echo base_url(); ?><!--assets/modules/datatables/Select-1.2.4/js/dataTables.select.min.js"></script>-->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/jquery.sparkline.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/izitoast/js/iziToast.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/izitoast/js/iziToast.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jquery.vmap.min.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/maps/jquery.vmap.world.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/jqvmap/dist/maps/jquery.vmap.indonesia.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/jquery-pwstrength/jquery.pwstrength.min.js"></script> -->
		<!-- <script src="--><?php //echo base_url(); ?><!--assets/modules/jquery-selectric/jquery.selectric.min.js"></script>-->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script> -->
		<!-- <script src="--><?php //echo base_url(); ?><!--assets/modules/jquery-selectric/jquery.selectric.min.js"></script>-->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script> -->
		<!-- <script src="--><?php //echo base_url(); ?><!--assets/modules/jquery-selectric/jquery.selectric.min.js"></script>-->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/codemirror/lib/codemirror.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/codemirror/mode/javascript/javascript.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/modules/chocolat/dist/js/jquery.chocolat.min.js"></script> -->

		<!-- Page Specific JS File -->
		<!-- <script src="--><?php //echo base_url(); ?><!--assets/js/page/index.js"></script>-->
		<!-- <script src="--><?php //echo base_url(); ?><!--assets/js/page/index-0.js"></script>-->
		<!-- <script src="<?php echo base_url(); ?>assets/js/page/bootstrap-modal.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/js/page/components-chat-box.js"></script> -->
		<!-- <script src="--><?php //echo base_url(); ?><!--assets/js/page/components-multiple-upload.js"></script>-->
		<!-- <script src="<?php echo base_url(); ?>assets/js/page/components-statistic.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/js/page/components-table.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/js/page/components-user.js"></script> -->
		<!-- <script src="<?php echo base_url(); ?>assets/js/page/forms-advanced-forms.js"></script> -->
		<!--			<script src="--><?php //echo base_url(); ?><!--assets/js/page/gmaps-advanced-route.js"></script>-->
		<!---->
		<!--			<script src="--><?php //echo base_url(); ?><!--assets/js/page/gmaps-draggable-marker.js"></script>-->
		<!---->
		<!--			<script src="--><?php //echo base_url(); ?><!--assets/js/page/gmaps-geocoding.js"></script>-->
		<!---->
		<!--			<script src="--><?php //echo base_url(); ?><!--assets/js/page/gmaps-geolocation.js"></script>-->
		<!---->
		<!--			<script src="--><?php //echo base_url(); ?><!--assets/js/page/gmaps-marker.js"></script>-->
		<!---->
		<!--			<script src="--><?php //echo base_url(); ?><!--assets/js/page/gmaps-multiple-marker.js"></script>-->
		<!---->
		<!--			<script src="--><?php //echo base_url(); ?><!--assets/js/page/gmaps-route.js"></script>-->
		<!---->
		<!--			<script src="--><?php //echo base_url(); ?><!--assets/js/page/gmaps-simple.js"></script>-->
			<!-- <script src="<?php echo base_url(); ?>assets/js/page/modules-chartjs.js"></script> -->
			<!-- <script src="<?php echo base_url(); ?>assets/js/page/modules-datatables.js"></script> -->
			<!-- <script src="<?php echo base_url(); ?>assets/js/page/modules-ion-icons.js"></script> -->
			<!-- <script src="<?php echo base_url(); ?>assets/js/page/modules-slider.js"></script> -->
			<!-- <script src="<?php echo base_url(); ?>assets/js/page/modules-sparkline.js"></script> -->
			<!-- <script src="<?php echo base_url(); ?>assets/js/page/modules-sweetalert.js"></script> -->
			<!-- <script src="<?php echo base_url(); ?>assets/js/page/modules-toastr.js"></script> -->
			<!-- <script src="<?php echo base_url(); ?>assets/js/page/modules-vector-map.js"></script> -->
			<!-- <script src="<?php echo base_url(); ?>assets/js/page/auth-register.js"></script> -->
			<!-- <script src="<?php echo base_url(); ?>assets/js/page/features-post-create.js"></script> -->
			<!-- <script src="<?php echo base_url(); ?>assets/js/page/features-posts.js"></script> -->
			<!-- <script src="<?php echo base_url(); ?>assets/js/page/features-setting-detail.js"></script> -->
			<!-- <script src="<?php echo base_url(); ?>assets/js/page/utilities-contact.js"></script> -->

	<script>	$('.format_number').keyup(function(event) {

		// skip for arrow keys
		if(event.which >= 37 && event.which <= 40){
		event.preventDefault();
		}

		$(this).val(function(index, value) {
		value = value.replace(/,/g,'');
		return numberWithCommas(value);
		});
		});

		function numberWithCommas(x) {
		var parts = x.toString().split(".");
		parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ",");
		return parts.join(".");
		}

		</script>
		<script>
			$(document).ready(function() {
				$('form').parsley();
			});
		</script>
