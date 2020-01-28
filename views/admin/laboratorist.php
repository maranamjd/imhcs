<div class="content-wrapper">
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Laboratorists
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Laboratorists</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-12" id="main_content">
        <div class="box">
          <div class="box-header with-border">
            <span class="btn btn-primary btn-sm btn-flat" id="add"><i class="fa fa-plus"></i> New</span>
          </div>
          <div class="box-body">
            <table id="main_table" class="table table-bordered table-striped">
              <thead>
                <th>User ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Contact</th>
                <th>Registered</th>
                <th>Tools</th>
              </thead>
              <tbody>
                <?php if ($this->count($this->data) > 0): ?>
                  <?php foreach ($this->data as $doctor): ?>
                    <tr>
                      <td><?php echo $doctor['user_id']; ?></td>
                      <td><?php echo Helper::name_format($doctor['firstname'], $doctor['lastname'], $doctor['middlename'], true); ?></td>
                      <td><?php echo $doctor['email']?></td>
                      <td><?php echo $doctor['contact_info']?></td>
                      <td><?php echo date('M d, Y', strtotime($doctor['created_on'])) ?></td>
                      <td>
                        <span>
                          <button class="btn btn-success btn-sm btn-md" data-id="<?php echo $doctor['id']; ?>" id="edit"><i class="fa fa-edit"></i></button>
                          <button class="btn btn-danger btn-sm btn-md" data-id="<?php echo $doctor['user_id']; ?>" id="delete"><i class="fa fa-trash"></i></button>
                        </span>
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
          User info
          <button type="button" class="btn btn-flat pull-right" aria-label="Close" title="Close" id="close"><span aria-hidden="true">&times;</span></button>
        </h3>
        <form class="form-horizontal" id="patient_form" enctype="multipart/form-data">
          <div class="form-group">
            <div class="col-lg-12">
              <label for="firstname" class="control-label">First name</label>
              <input type="text" class="form-control" id="firstname" name="firstname" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-12">
              <label for="lastname" class="control-label">Middle Name</label>
              <input type="text" class="form-control" id="middlename" name="middlename">
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-12">
              <label for="lastname" class="control-label">Lastname</label>
              <input type="text" class="form-control" id="lastname" name="lastname" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-12">
              <label for="lastname" class="control-label">Email</label>
              <input type="email" class="form-control" id="email" name="email" required>
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
              <div class="date">
                <label for="datepicker_add" class="control-label">Birthdate</label>
                <input type="date" class="form-control" id="birthdate" max="<?php echo date('Y-m-d', strtotime('-1 day', strtotime(date('Y-m-d')))); ?>" name="birthdate" required>
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-12">
              <label for="contact" class="control-label">Contact Number</label>
              <input type="text" class="form-control" id="contact_number" name="contact" required>
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
