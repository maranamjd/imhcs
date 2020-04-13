
<!-- Content Wrapper. Contains page content -->
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
    <div class="row">
      <div class="col-lg-12">

        <?php if ($this->count($this->low_stock) >= 1): ?>
        <a href="<?php echo URL ?>admin/inventory" title="click to view">
        <div class="alert alert-warning">
        <h4>Warning!</h4>
        There are medicine/s that are low on stock!!
        </div>
        </a>
        <?php endif; ?>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-user-md"></i></span>
            <div class="info-box-content">
              <a href="doctor.php">
              <span class="info-box-text">Doctor</span>
              <?php echo $this->data['doctor'] ?>
              </a>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-female"></i></span>
            <div class="info-box-content">
              <a href="patient.php">
              <span class="info-box-text">Nurse</span>
              <?php echo $this->data['nurse'] ?>
              </a>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-wheelchair"></i></span>
            <div class="info-box-content">
              <a href="patient.php">
              <span class="info-box-text">Patient</span>
              <?php echo $this->data['patient'] ?>
              </a>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-plus-square"></i></span>
            <div class="info-box-content">
              <a href="patient.php">
              <span class="info-box-text">Pharmacist</span>
              <?php echo $this->data['pharmacist'] ?>
              </a>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-olive"><i class="fa fa-flask"></i></span>
            <div class="info-box-content">
              <a href="patient.php">
              <span class="info-box-text">Laboratorist</span>
              <?php echo $this->data['laboratorist'] ?>
              </a>
            </div>
          </div>
        </div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-medkit"></i></span>
            <div class="info-box-content">
              <a href="patient.php">
              <span class="info-box-text">Medicines</span>
              <?php echo $this->data['medicine'] ?>
              </a>
            </div>
          </div>
        </div>
      </div>

      <div class="col-lg-12">
        <div class="col-lg-6">
          <div class="box">
            <div class="box-header with-border">
              graph
            </div>
            <div class="box-body">
              <canvas id="graph"></canvas>
            </div>
          </div>
        </div>
      </div>

    </div>

  </section>
</div>



<!-- right col -->
