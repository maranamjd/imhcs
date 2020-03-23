<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Patient Info</h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo URL ?>doctor"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo URL ?>doctor/patient"> Patient</a></li>
    <li class="active"><?php echo Helper::name_format($this->patient['firstname'], $this->patient['lastname'], $this->patient['middlename'], true); ?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div style="margin-bottom: 1em;">
    <ul class="nav nav-tabs" role="tablist">
      <li role="presentation" class="active"><a href="<?php echo URL ?>doctor/history/<?php echo $this->patient['patient_id'] ?>" aria-controls="History">History</a></li>
      <li role="presentation"><a href="<?php echo URL ?>doctor/checkup/<?php echo $this->patient['patient_id'] ?>" aria-controls="Checkups">Checkups</a></li>
      <li role="presentation"><a href="<?php echo URL ?>doctor/medications/<?php echo $this->patient['patient_id'] ?>" aria-controls="Medications">Medications</a></li>
      <li role="presentation"><a href="<?php echo URL ?>doctor/labs/<?php echo $this->patient['patient_id'] ?>" aria-controls="Labs">Labs</a></li>
    </ul>
  </div>
  <div class="row">
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-body box-profile">
          <h3 class="profile-username text-center"><?php echo Helper::name_format($this->patient['firstname'], $this->patient['lastname'], $this->patient['middlename'], true); ?></h3>
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Patient Id</b> <a class="pull-right"><?php echo $this->patient['patient_id'] ?></a>
            </li>
            <li class="list-group-item">
              <b>Sex</b> <a class="pull-right"><?php echo Helper::get_sex($this->patient['sex']) ?></a>
            </li>
            <li class="list-group-item">
              <b>Birth Date</b> <a class="pull-right"><?php echo date('F d, Y', strtotime($this->patient['birthdate'])) ?></a>
            </li>
            <li class="list-group-item">
              <b>Age</b> <a class="pull-right"><?php echo Helper::get_age($this->patient['birthdate']) ?></a>
            </li>
          </ul>
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Other Info</h3>
        </div>
        <div class="box-body">
          <strong><i class="fa fa-phone margin-r-5"></i> Contact</strong>
          <p class="text-muted"><?php echo $this->patient['contact_info'] ?></p>
          <hr>
          <strong><i class="fa fa-map-marker margin-r-5"></i> Address</strong>
          <p class="text-muted"><?php echo $this->patient['address'] ?></p>
        </div>
      </div>
    </div>


    <div class="col-md-9">


      <div class="box box-primary" id="history">
        <div class="box-header with-border">
          <h3 class="box-title">History</h3>
        </div>
        <div class="box-body">
          <div id="timeline">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading_checkup">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_checkup" aria-expanded="true" aria-controls="collapseOne">
                    <h4 class="panel-title">
                      Checkups
                    </h4>
                  </a>
                </div>
                <div id="collapse_checkup" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                    <?php if (count($this->checkups) > 0): ?>
                      <?php foreach ($this->checkups as $checkup): ?>
                        <div style="line-height: 1em; margin: 1em 0;">
                          <p><b><?php echo date('F d, Y', strtotime($checkup['date'])) ?></b>: <?php echo $checkup['diagnosis'] ?> <b>(<?php echo $checkup['notes'] ?>)</b></p>
                        </div>
                      <?php endforeach; ?>
                    <?php else: ?>
                      Nothing to show...
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading_medication">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_medication" aria-expanded="true" aria-controls="collapseOne">
                    <h4 class="panel-title">
                      Medications
                    </h4>
                  </a>
                </div>
                <div id="collapse_medication" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                    <?php if (count($this->medications) > 0): ?>
                      <?php foreach ($this->medications as $medication): ?>
                        <div style="line-height: 1em; margin: 1em 0;">
                          <p><b><?php echo date('F d, Y', strtotime($medication['date_requested'])) ?></b>: <?php echo $medication['name'] ?></p>
                          <!-- <p><h6 class="text-muted"><b>Doctor:</b> <?php echo $this->name_format($checkup['doctor']['firstname'], $checkup['doctor']['lastname'], $checkup['doctor']['middlename'], true) ?></h6></p> -->
                        </div>
                      <?php endforeach; ?>
                    <?php else: ?>
                      Nothing to show...
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <div class="panel panel-default">
                <div class="panel-heading" role="tab" id="heading_laboratory">
                  <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_laboratory" aria-expanded="true" aria-controls="collapseOne">
                    <h4 class="panel-title">
                      Laboratories
                    </h4>
                  </a>
                </div>
                <div id="collapse_laboratory" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                  <div class="panel-body">
                    <?php if (count($this->laboratories) > 0): ?>
                      <?php foreach ($this->laboratories as $laboratory): ?>
                        <div style="line-height: 1em; margin: 1em 0;">
                          <p><b><?php echo date('F d, Y', strtotime($laboratory['date_requested'])) ?></b>: <?php echo $laboratory['description'] ?></p>
                          <!-- <p><h6 class="text-muted"><b>Doctor:</b> <?php echo $this->name_format($checkup['doctor']['firstname'], $checkup['doctor']['lastname'], $checkup['doctor']['middlename'], true) ?></h6></p> -->
                        </div>
                      <?php endforeach; ?>
                    <?php else: ?>
                      Nothing to show...
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
