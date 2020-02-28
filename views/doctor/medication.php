<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Medication Requests</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Medications</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-lg-12" id="main_content">
      <div class="box">
        <div class="box-header with-border">
          <span class="btn btn-primary btn-sm btn-flat" id="add"><i class="fa fa-plus"></i> New</span>
        </div>
        <div class="box-body">
          <table id="medication_table" class="table table-bordered table-striped">
            <thead>
              <th>Date</th>
              <th>Patient</th>
              <th>Medicine</th>
              <th>Quantity</th>
              <th>Status</th>
              <th>Tools</th>
            </thead>
            <tbody>
              <?php if ($this->count($this->data) > 0): ?>
                <?php foreach ($this->data as $medication): ?>
                  <tr>
                    <td><?php echo date('M d, Y', strtotime($medication['date_requested'])) ?></td>
                    <td><?php echo $this->name_format($medication['firstname'], $medication['lastname'], $medication['middlename'], true); ?></td>
                    <td><?php echo $medication['medicine']; ?></td>
                    <td><?php echo $medication['quantity']; ?></td>
                    <td><?php echo $this->status($medication['status']); ?></td>
                    <td>
                      <?php if ($medication['status'] == 0): ?>
                        <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $medication['medication_id']; ?>" id="edit"><i class="fa fa-edit"></i></button>
                        <button class="btn btn-danger btn-sm delete btn-flat" data-id="<?php echo $medication['medication_id']; ?>" id="delete"><i class="fa fa-ban"></i></button>
                      <?php endif; ?>
                    </td>
                  </tr>
                <?php endforeach; ?>
              <?php endif; ?>
            </tbody>
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
        <div class="form-group">
          <div class="col-lg-12">
            <label for="patient" class="control-label">Patient</label>
            <input type="text" class="form-control" id="patient" name="patient" autocomplete="off" required>
            <input type="hidden" name="patient_id" id="patient_id">
            <div id="matches" class="card container" style="display: none">
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-lg-12">
            <label for="medicine" class="control-label">Medicine</label>
            <select class="form-control" name="medicine" id="medicine" required>
              <option value="" selected>- Select -</option>
              <?php if (count($this->medicines) > 0): ?>
                <?php foreach ($this->medicines as $medicine): ?>
                  <option value="<?php echo $medicine['med_id'] ?>"><?php echo $medicine['name'] ?></option>
                <?php endforeach; ?>
              <?php endif; ?>
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
  </div>
</section>
</div>
