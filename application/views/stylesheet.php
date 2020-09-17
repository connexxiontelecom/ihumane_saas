<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <meta content="IHUMANE" name="description" />
  <meta content="Connexxion Group" name="author" />
	<title>IHUMANE</title>
  <link rel="icon" href="<?php echo base_url(); ?>/assets/img/ihumane-logo-2.png">

  <style>
    /*Remove Arrows From Form Input Number Types*/
    /*For Chrome, Safari, Edge, Opera: */
    input::-webkit-outer-spin-button,
    input::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    /*For Firefox:*/
    input[type=number] {
      -moz-appearance: textfield;
    }
    /*Note, it is still possible to increment the number when you scroll inside the number input*/
  </style>

	<!-- General CSS Files -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fontawesome/css/all.min.css">

	<!-- CSS Libraries -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/chocolat/dist/css/chocolat.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/prism/prism.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/chocolat/dist/css/chocolat.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/dropzone/dist/dropzone.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/sweet-alert2/sweetalert2.min.css" type="text/css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap-daterangepicker/daterangepicker.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/select2/dist/css/select2.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/jquery-selectric/selectric.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap-timepicker/css/bootstrap-timepicker.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/fullcalendar/fullcalendar.min.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/dataTables.bootstrap4.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/buttons.bootstrap4.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/datatables/responsive.bootstrap4.min.css" type="text/css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/offline/css/offline-language-english.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/offline/css/offline-theme-slide.css">

	<!-- Template CSS -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/components.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/ajaxmask.css">

</head>

	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jqvmap.min.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jqvmap.min.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/weather-icon/css/weather-icons.min.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/weather-icon/css/weather-icons-wind.min.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/dropzonejs/dropzone.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jqvmap.min.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/flag-icon-css/css/flag-icon.min.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap-social/bootstrap-social.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap-colorpicker/dist/css/bootstrap-colorpicker.min.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/codemirror/lib/codemirror.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/codemirror/theme/duotone-dark.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/jquery-selectric/selectric.css"> -->
	<!-- <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--assets/modules/datatables/datatables.min.css"> -->
	<!-- <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--assets/modules/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css">-->
	<!-- <link rel="stylesheet" href="--><?php //echo base_url(); ?><!--assets/modules/datatables/Select-1.2.4/css/select.bootstrap4.min.css">-->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/ionicons/css/ionicons.min.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.carousel.min.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/owlcarousel2/dist/assets/owl.theme.default.min.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/izitoast/css/iziToast.min.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/izitoast/css/iziToast.min.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/jqvmap/dist/jqvmap.min.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/flag-icon-css/css/flag-icon.min.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/weather-icon/css/weather-icons.min.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/weather-icon/css/weather-icons-wind.min.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap-social/bootstrap-social.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/jquery-selectric/selectric.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/jquery-selectric/selectric.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap-tagsinput/dist/bootstrap-tagsinput.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/jquery-selectric/selectric.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/bootstrap-social/bootstrap-social.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/codemirror/lib/codemirror.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/codemirror/theme/duotone-dark.css"> -->
	<!-- <link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/summernote/summernote-bs4.css">
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/modules/chocolat/dist/css/chocolat.css"> -->
	<!-- Start GA -->
	<!-- <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-94034622-3');
	</script> -->
	<!-- /END GA -->
<!-- </head> -->

<?php
//if ($this->uri->segment(2) == "layout_transparent") {
//	$this->load->view('dist/_partials/layout-2');
//	$this->load->view('dist/_partials/sidebar-2');
//}elseif ($this->uri->segment(2) == "layout_top_navigation") {
//	$this->load->view('dist/_partials/layout-3');
//	$this->load->view('dist/_partials/navbar');
//}elseif ($this->uri->segment(2) != "auth_login" && $this->uri->segment(2) != "auth_forgot_password"&& $this->uri->segment(2) != "auth_register" && $this->uri->segment(2) != "auth_reset_password" && $this->uri->segment(2) != "errors_503" && $this->uri->segment(2) != "errors_403" && $this->uri->segment(2) != "errors_404" && $this->uri->segment(2) != "errors_500" && $this->uri->segment(2) != "utilities_contact" && $this->uri->segment(2) != "utilities_subscribe") {
//	$this->load->view('dist/_partials/layout');
//	$this->load->view('dist/_partials/sidebar');
//}
//?>


