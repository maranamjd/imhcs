<div class="content-wrapper">
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Reports
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Reports</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-12" id="main_content">
        <div class="box">
          <div class="box-header with-border">
            Reports
          </div>
          <div class="box-body">
            <div class="col-lg-6">
              <form class="form-horizontal" id="report_form" enctype="multipart/form-data">
                <div class="form-group">
                  <div class="col-lg-12">
                    <label for="name" class="control-label">Report</label>
                    <select class="form-control" name="report" id="report">
                      <option value="" selected disabled>--select--</option>
                      <option value="patient">Patients</option>
                      <option value="immunization">Immunization</option>
                      <option value="laboratory">Laboratory Tests</option>
                      <option value="medication">Medicines</option>
                    </select>
                  </div>
                </div>
                <hr>
                <div class="pull-right">
                  <button type="submit" class="btn btn-danger btn-flat" id="generate" name="generate"><i class="fa fa-file"></i> Generate</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
