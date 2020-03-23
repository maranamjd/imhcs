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
      <li role="presentation"><a href="<?php echo URL ?>doctor/history/<?php echo $this->patient['patient_id'] ?>" aria-controls="History">History</a></li>
      <li role="presentation"><a href="<?php echo URL ?>doctor/checkup/<?php echo $this->patient['patient_id'] ?>" aria-controls="Checkups">Checkups</a></li>
      <li role="presentation" class="active"><a href="<?php echo URL ?>doctor/medications/<?php echo $this->patient['patient_id'] ?>" aria-controls="Medications">Medications</a></li>
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


    <div class="col-md-9" id="main_content">
      <div class="box box-primary" id="history">
        <div class="box-header with-border">
          <h3 class="box-title">Medications</h3>
          <?php if ($this->count($this->checkups) > 0): ?>
            <span class="btn btn-primary btn-sm btn-flat pull-right" id="add"><i class="fa fa-plus"></i> New</span>
          <?php endif; ?>
        </div>
        <div class="box-body">
          <?php if ($this->count($this->medications) > 0): ?>
            <table id="patient_table" class="table table-bordered table-striped">
              <thead>
                <th>Date Requested</th>
                <th>Name</th>
                <th>Status</th>
                <th>Requested By</th>
                <th>Tools</th>
              </thead>
              <tbody>
                  <?php foreach ($this->medications as $medication): ?>
                    <tr>
                      <td><?php echo date('M d, Y', strtotime($medication['date_requested'])) ?></td>
                      <td><?php echo $medication['name']; ?></td>
                      <td><?php echo $this->status($medication['status'])?></td>
                      <td>Dr. <?php echo $this->name_format($medication['doctor']['firstname'], $medication['doctor']['lastname'], $medication['doctor']['middlename'], true); ?></td>
                      <td>
                        <?php if ($medication['status'] == 0): ?>
                          <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $medication['medication_id']; ?>" id="edit"><i class="fa fa-edit"></i></button>
                          <button class="btn btn-danger btn-sm delete btn-flat" data-id="<?php echo $medication['medication_id']; ?>" id="delete"><i class="fa fa-ban"></i></button>
                        <?php endif; ?>
                      </td>
                    </tr>
                  <?php endforeach; ?>
              </tbody>
            <?php else: ?>
              <p class="text-center">Nothing to show..</p>
            <?php endif; ?>
          </table>
        </div>
      </div>
    </div>
    <div class="col-lg-4 hidden" id="secondary_content">
      <h3>
        Request Details
        <button type="button" class="btn btn-flat pull-right" aria-label="Close" title="Close" id="close"><span aria-hidden="true">&times;</span></button>
      </h3>
      <form class="form-horizontal" id="medication_form" enctype="multipart/form-data">
        <input type="hidden" name="patient_id" id="patient_id" value="<?php echo $this->patient['patient_id'] ?>">

        <div class="form-group">
          <div class="col-lg-12">
            <label for="checkups" class="control-label">Checkups</label>
            <select class="form-control" name="checkups" id="checkups" required>
              <option value="" selected disabled>- Select -</option>
              <?php if (count($this->checkups) > 0): ?>
                <?php foreach ($this->checkups as $checkup): ?>
                  <option value="<?php echo $checkup['checkup_id'] ?>">
                    <h5><?php echo $checkup['diagnosis'] ?> - </h5>
                    <span><?php echo date("F d, Y ", strtotime($checkup['date'])) ?></span>
                  </option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-lg-12">
            <label for="medicine" class="control-label">Medicine</label>
            <select class="form-control" name="medicine" id="medicine" required>
            </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-lg-12">
            <label for="quantity" class="control-label">Quantity</label>
            <input type="number" min="1" max="100" value="1" class="form-control" id="quantity" name="quantity">
          </div>
        </div>

        <!-- <div class="form-group">
          <div class="col-lg-12">
            <label for="prescription" class="control-label">Prescription</label>
            <textarea class="form-control" name="address" id="prescription" required></textarea>
          </div>
        </div> -->

        <hr>
        <div class="pull-right">
          <input type="hidden" id="process">
          <button type="submit" class="btn btn-primary btn-flat" id="save" name="add"><i class="fa fa-save"></i> Submit</button>
        </div>
      </form>
    </div>
  </section>
</div>
