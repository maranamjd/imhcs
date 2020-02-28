<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Laboratory Request</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Laboratory</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-lg-12" id="main_content">
      <div class="box">
        <div class="box-header with-border">
        </div>
        <div class="box-body">
          <table id="medication_table" class="table table-bordered table-striped">
            <thead>
              <th>Date Requested</th>
              <th>Patient</th>
              <th>Lab Type</th>
              <th>Notes</th>
              <th>Results</th>
              <th>Status</th>
              <th>Actions</th>
            </thead>
            <tbody>
              <?php if ($this->count($this->data) > 0): ?>
                <?php foreach ($this->data as $request): ?>
                  <tr>
                    <td><?php echo date('M d, Y', strtotime($request['date_requested'])) ?></td>
                    <td><?php echo $this->name_format($request['firstname'], $request['lastname'], $request['middlename'], true); ?></td>
                    <td><?php echo $request['laboratory']; ?></td>
                    <td><?php echo $request['note']?></td>
                    <td><?php echo $request['results']?></td>
                    <td><?php echo $this->status($request['status'])?></td>
                    <td>
                      <?php if ($request['status'] == 0): ?>
                        <button class="btn btn-primary btn-sm edit btn-flat" data-id="<?php echo $request['lab_req_id']; ?>" id="edit">Fulfill</i></button>
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
        Test Details
        <button type="button" class="btn btn-flat pull-right" aria-label="Close" title="Close" id="close"><span aria-hidden="true">&times;</span></button>
      </h3>
      <form class="form-horizontal" id="lab_form" enctype="multipart/form-data">
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
            <select class="form-control" name="medicine" id="laboratory" required>
              <option value="" selected>- Select -</option>
              <?php if (count($this->lab_tests) > 0): ?>
                <?php foreach ($this->lab_tests as $test): ?>
                  <option value="<?php echo $test['lab_id'] ?>"><?php echo $test['description'] ?></option>
                <?php endforeach; ?>
              <?php endif; ?>
            </select>
          </div>
        </div>

        <div class="form-group">
          <div class="col-lg-12">
            <label for="result" class="control-label">Results</label>
            <textarea class="form-control" name="result" id="result" required></textarea>
          </div>
        </div>
        <hr>
        <div class="pull-right">
          <input type="hidden" id="process">
          <button type="submit" class="btn btn-primary btn-flat" id="save" name="add"><i class="fa fa-save"></i> Save</button>
        </div>
      </form>
    </div>
  </div>
</section>
</div>
