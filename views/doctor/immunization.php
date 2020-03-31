<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>Immunization Record</h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo URL ?>doctor"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="<?php echo URL ?>doctor/vaccine"> Immunization</a></li>
    <li class="active"><?php echo $this->patient['child_name'] ?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-3">
      <div class="box box-primary">
        <div class="box-body box-profile">
          <h3 class="profile-username text-center"><?php echo $this->patient['child_name'] ?></h3>
          <ul class="list-group list-group-unbordered">
            <li class="list-group-item">
              <b>Sex</b> <a class="pull-right"><?php echo Helper::get_sex($this->patient['sex']) ?></a>
            </li>
            <li class="list-group-item">
              <b>Birth Date</b> <a class="pull-right"><?php echo date('F d, Y', strtotime($this->patient['birthdate'])) ?></a>
            </li>
            <li class="list-group-item">
              <b>Birth Height</b> <a class="pull-right"><?php echo $this->patient['birth_height'] ?> cm</a>
            </li>
            <li class="list-group-item">
              <b>Birth Weight</b> <a class="pull-right"><?php echo $this->patient['birth_weight'] ?> Kg</a>
            </li>
            <li class="list-group-item">
              <b>Birth Place</b> <a class="pull-right"><?php echo $this->patient['birthplace'] ?> </a>
            </li>
            <li class="list-group-item">
              <b>Age</b> <a class="pull-right"><?php echo $this->get_week($this->patient['birthdate']) ?> weeks</a>
            </li>
          </ul>
        </div>
      </div>
      <div class="box box-primary">
        <div class="box-header with-border">
          <h3 class="box-title">Other Info</h3>
        </div>
        <div class="box-body">
          <strong>Mother's Name</strong>
          <p class="text-muted"><?php echo $this->patient['mother_name'] ?></p>
          <hr>
          <strong>Father's Name</strong>
          <p class="text-muted"><?php echo $this->patient['father_name'] ?></p>
          <hr>
          <strong>Address</strong>
          <p class="text-muted"><?php echo $this->patient['address'] ?></p>
        </div>
      </div>
    </div>




    <div class="col-md-9" id="main_content">
      <div class="box box-primary" id="history">
        <div class="box-header with-border">
          <h3 class="box-title">Vaccination</h3>
          <a class="btn btn-danger btn-sm btn-flat pull-right" href="<?php echo URL ?>downloads/immunization/<?php echo $this->patient['immunization_record_id'] ?>" title="Print Immunization Record" target="_blank"><i class="fa fa-file"></i></a>
        </div>
        <div class="box-body">
          <div id="timeline">
            <?php $next_level = 0; ?>
            <?php if ($this->count($this->vaccines) > 0): ?>
              <?php foreach ($this->vaccines as $key => $vaccine): ?>
                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading_<?php echo $vaccine['vaccine_id'] ?>">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse_<?php echo $vaccine['vaccine_id'] ?>" aria-expanded="true" aria-controls="collapseOne">
                        <h4 class="panel-title">
                          <?php echo $vaccine['name'] ?>
                        </h4>
                      </a>
                    </div>
                    <div id="collapse_<?php echo $vaccine['vaccine_id'] ?>" class="panel-collapse collapse <?php echo $key == 0 ? "in" : '' ?>" role="tabpanel" aria-labelledby="headingOne">
                      <div class="panel-body">
                        <?php if ($this->count($vaccine['vaccinations']) > 0): ?>
                          <table id="patient_table" class="table table-bordered table-striped">
                            <thead>
                              <th>Doses</th>
                              <th>Date</th>
                              <th>Remarks</th>
                              <th>Administered By</th>
                            </thead>
                            <tbody>
                              <?php foreach ($vaccine['vaccinations'] as $vaccination): ?>
                                <tr>
                                  <td><?php echo $vaccination['doses']; ?></td>
                                  <td><?php echo date('M d, Y', strtotime($vaccination['date'])) ?></td>
                                  <td><?php echo $vaccination['remarks']?></td>
                                  <td><?php echo $this->name_format($vaccination['firstname'],$vaccination['lastname'],$vaccination['middlename'],true)?></td>
                                  <!-- <td>
                                    <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $vaccination['vaccination_id']; ?>" id="edit"><i class="fa fa-edit"></i></button>
                                    <button class="btn btn-danger btn-sm delete btn-flat" data-id="<?php echo $vaccination['vaccination_id']; ?>" id="delete"><i class="fa fa-ban"></i></button>
                                  </td> -->
                                </tr>
                              <?php endforeach; ?>
                            </tbody>
                          </table>
                        <?php else: ?>
                          <?php $next_level++; ?>
                          <span class="btn btn-primary btn-sm btn-flat pull-right" id="add" data-id="<?php echo $vaccine['vaccine_id'] ?>"><i class="fa fa-plus"></i> New</span>
                          <p>Nothing to show...</p>
                        <?php endif; ?>
                      </div>
                    </div>
                  </div>
                </div>
              <?php endforeach; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-4 hidden" id="secondary_content">
      <h3>
        Vaccination Details
        <button type="button" class="btn btn-flat pull-right" aria-label="Close" title="Close" id="close"><span aria-hidden="true">&times;</span></button>
      </h3>
      <form class="form-horizontal" id="lab_form" enctype="multipart/form-data">
        <input type="hidden" name="vaccine_id" id="vaccine_id">
        <input type="hidden" name="remarks" id="remark_value" value="<?php echo $this->get_next_vaccine($this->patient['vaccination_level']) ?>">
        <input type="hidden" name="next_level" id="next_level" value="<?php echo $next_level ?>">
        <input type="hidden" name="vaccination_level" id="vaccination_level" value="<?php echo $this->patient['vaccination_level'] ?>">
        <input type="hidden" name="immunization_record_id" id="immunization_record_id" value="<?php echo $this->patient['immunization_record_id'] ?>">

        <div class="form-group">
          <div class="col-lg-12">
            <label for="doses" class="control-label">Doses</label>
            <input type="number" min="1" max="100" value="1" class="form-control" id="doses" name="doses">
          </div>
        </div>

        <div class="form-group">
          <div class="col-lg-12">
            <label for="remarks" class="control-label">Remarks</label>
            <textarea class="form-control" name="remarks" id="remarks" required></textarea>
          </div>
        </div>
        <hr>
        <div class="pull-right">
          <input type="hidden" id="process">
          <button type="submit" class="btn btn-primary btn-flat" id="save" name="add"><i class="fa fa-save"></i> Save</button>
        </div>
      </form>
    </div>
  </section>
</div>
