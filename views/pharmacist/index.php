
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Dashboard
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Dashboard</li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-aqua"><i class="fa fa-pills"></i></span>
        <div class="info-box-content">
          <a href="<?php echo URL ?>pharmacist/requested">
          <span class="info-box-text">Requested</span>
          <?php echo $this->data['requested'] ?>
          </a>
        </div>
      </div>
    </div>
    <div class="col-md-3 col-sm-6 col-xs-12">
      <div class="info-box">
        <span class="info-box-icon bg-green"><i class="fa fa-check"></i></span>
        <div class="info-box-content">
          <a href="<?php echo URL ?>pharmacist/completed">
          <span class="info-box-text">Completed</span>
          <?php echo $this->data['completed'] ?>
          </a>
        </div>
      </div>
    </div>
  </section>

</div>
