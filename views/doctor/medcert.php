<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Medical Certificate</h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Medical Certificate</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-lg-12" id="main_content">
      <div class="box">
        <div class="box-header with-border">
          <h4>Create new Medical Certificate</h4>
        </div>
        <div class="box-body">
          <div class="col-lg-6">
            <h4>Patient</h4>
            <form class="form-horizontal" id="medical_form" enctype="multipart/form-data">
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
                  <label for="checkups" class="control-label">Checkup</label>
                  <select class="form-control" name="checkups" id="checkups" required>=
                  </select>
                </div>
              </div>
              <hr>
              <div class="pull-right">
                <button type="submit" class="btn btn-danger btn-flat"><i class="fa fa-file"></i> Create</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</div>
