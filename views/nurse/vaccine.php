<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Patients</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Patients</li>
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
          <table id="patient_table" class="table table-bordered table-striped">
            <thead>
              <th>Child's Name</th>
              <th>Sex</th>
              <th>Birthdate</th>
              <th>Mother's Name</th>
              <th>Father's Name</th>
              <th>Details</th>
              <th>Tools</th>
            </thead>
            <tbody>
              <?php if ($this->count($this->data) > 0): ?>
                <?php foreach ($this->data as $record): ?>
                  <tr>
                    <td><?php echo $record['child_name']; ?></td>
                    <td><?php echo $this->get_sex($record['sex']); ?></td>
                    <td><?php echo $record['birthdate']?></td>
                    <td><?php echo $record['mother_name']?></td>
                    <td><?php echo $record['father_name']?></td>
                    <td style="width: 5%;" class="text-center">
                      <a href="<?php echo URL ?>nurse/immunization/<?php echo $record['immunization_record_id']; ?>" title="Click to view detail"><i class="fa fa-bars"></i></a>
                    </td>
                    <td>
                      <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $record['immunization_record_id']; ?>" id="edit"><i class="fa fa-edit"></i></button>
                      <button class="btn btn-danger btn-sm delete btn-flat" data-id="<?php echo $record['immunization_record_id']; ?>" id="delete"><i class="fa fa-trash"></i></button>
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
        Immunization Details
        <button type="button" class="btn btn-flat pull-right" aria-label="Close" title="Close" id="close"><span aria-hidden="true">&times;</span></button>
      </h3>
      <form class="form-horizontal" id="patient_form" enctype="multipart/form-data">
        <div class="form-group">
          <div class="col-lg-12">
            <label for="child_name" class="control-label">Child's Name</label>
            <input type="text" class="form-control" id="child_name" name="child_name" required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-lg-12">
            <label for="mother_name" class="control-label">Mother's Name</label>
            <input type="text" class="form-control" id="mother_name" name="mother_name">
          </div>
        </div>

        <div class="form-group">
          <div class="col-lg-12">
            <label for="father_name" class="control-label">Father's Name</label>
            <input type="text" class="form-control" id="father_name" name="father_name" required>
          </div>
        </div>

        <div class="form-group">
          <div class="col-lg-12">
            <label for="address" class="control-label">Address</label>
            <textarea class="form-control" name="address" id="address" required></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-lg-12">
            <label for="birth_place" class="control-label">Birth Place</label>
            <textarea class="form-control" name="birth_place" id="birth_place" required></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-lg-12">
            <div class="date">
              <label for="datepicker_add" class="control-label">Birthdate</label>
              <input type="date" class="form-control" id="birthdate" max="<?php echo date('Y-m-d'); ?>" name="birthdate" required>
            </div>
          </div>
        </div>

        <div class="form-group">
          <div class="col-lg-12">
            <label for="birth_height" class="control-label">Birth Height</label>
            <input type="text" class="form-control" id="birth_height" name="birth_height" required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-lg-12">
            <label for="birth_weight" class="control-label">Birth Weight</label>
            <input type="text" class="form-control" id="birth_weight" name="birth_weight" required>
          </div>
        </div>
        <div class="form-group">
          <div class="col-lg-12">
            <label for="gender" class="control-label">Sex</label>
            <select class="form-control" name="gender" id="sex" required>
              <option value="" selected>- Select -</option>
              <option value="1">Male</option>
              <option value="2">Female</option>
            </select>
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
