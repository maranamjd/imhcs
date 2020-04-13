<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<title><?php echo strtoupper(SYSTEM_NAME) ?></title>
      <link rel="icon" href="<?php echo URL ?>public/img/sabsung.png">
    	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    	<link rel="stylesheet" href="<?php echo URL ?>bower_components/bootstrap/dist/css/bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo URL ?>bower_components/font-awesome/css/font-awesome.min.css">
    	<link rel="stylesheet" href="<?php echo URL ?>bower_components/Ionicons/css/ionicons.min.css">
      <link rel="stylesheet" href="<?php echo URL ?>dist/css/AdminLTE.min.css">
      <link rel="stylesheet" href="<?php echo URL ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
      <link rel="stylesheet" href="<?php echo URL ?>dist/css/skins/_all-skins.min.css">
      <!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> -->
      <?php
      if (isset($this->css)) {
        foreach ($this->css as $css) {
          echo "<link href='".URL."views/".$css."' rel='stylesheet' />";
        }
      }
      ?>
  </head>
  <body class="<?php echo (Session::get('user_type') !== null) ? 'hold-transition skin-blue sidebar-mini' : 'hold-transition login-page' ?>">
    <div class="wrapper">
