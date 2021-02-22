<?php
/**
 * Created by PhpStorm.
 * User: rOKz
 * Date: 5/3/2019
 * Time: 1:21 PM
 */
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');

 ini_set('error_reporting', E_STRICT);
 require_once APPPATH."third_party/PHPExcel.php";

 class Excel extends PHPExcel {

     public function __construct() {
         parent::__construct();
     }

 }

