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

      <div class="box box-primary" id="new_checkup">
        <div class="box-header with-border">
          <h3 class="box-title">Checkup Info</h3>
          <button type="button" class="btn btn-flat pull-right" aria-label="Close" title="Close" id="close"><span aria-hidden="true">&times;</span></button>
        </div>
        <div class="box-body">
          <form id="checkup_form" enctype="multipart/form-data">
            <div class="container">
              <div class="row">
                <div class="col-lg-8">
                  <div class="form-group">
                    <div class="col-lg-4">
                      <label for="blood_pressure">Blood Pressure:</label>
                      <input class="form-control" name="blood_pressure" id="blood_pressure" type="text" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-4">
                      <label for="temperature">Temperature &deg;C:</label>
                      <input class="form-control" name="temperature" id="temperature" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-4">
                      <label for="pulse_rate">Pulse Rate:</label>
                      <input class="form-control" name="pulse_rate" id="pulse_rate" type="text"  required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-4">
                      <label for="respiration_rate">Respiration Rate:</label>
                      <input class="form-control" name="respiration_rate" id="respiration_rate" type="text"  required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-4">
                      <label for="weight">Weight kg:</label>
                      <input class="form-control" name="weight"id="weight" type="number" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-4">
                      <label for="height">Height :</label>
                      <input class="form-control" name="height" id="height" type="text" required>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-8">
                      <label for="symptoms">Symptoms :</label>
                      <textarea class="form-control" name="symptoms" id="symptoms" rows="3" cols="60"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-8">
                      <label for="diagnosis">Diagnosis :</label>
                      <textarea class="form-control" name="symptoms" id="diagnosis" rows="3" cols="60"></textarea>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-lg-8">
                      <label for="notes">Notes :</label>
                      <textarea class="form-control" name="symptoms" id="notes" rows="4" cols="60"></textarea>
                    </div>
                  </div>
                  <input type="hidden" id="patient_id" value="<?php echo $this->patient['patient_id'] ?>">
                </div>
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

      <div class="box box-primary" id="history">
        <div class="box-header with-border">
          <h3 class="box-title">Checkup History</h3>
          <span title="New Checkup" class="btn btn-primary pull-right btn-sm" id="new"><i class="fa fa-plus"></i> New Checkup</span>
        </div>
        <div class="box-body">
          <div id="timeline">
            <input type="hidden" id="prescription_process">
            <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
              <?php if (count($this->checkup) > 0): ?>
                <?php foreach ($this->checkup as $key => $checkup): ?>
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="<?php echo "heading_".$checkup['checkup_id'] ?>">
                      <a role="button" data-toggle="collapse" data-parent="#accordion" href="#<?php echo "collapse_".$checkup['checkup_id'] ?>" aria-expanded="true" aria-controls="collapseOne">
                        <h4 class="panel-title">
                          <?php echo date('d M Y', strtotime($checkup['date'])) ?>
                        </h4>
                      </a>
                    </div>
                    <div id="<?php echo "collapse_".$checkup['checkup_id'] ?>" class="panel-collapse collapse <?php echo $key == 0 ? "in" : '' ?>" role="tabpanel" aria-labelledby="headingOne">
                    <div class="panel-body">
                      <ul class="timeline timeline-inverse">
                        <li class="time-label">
                          <span class="bg-blue">
                            Doctor : <?php echo Helper::name_format($checkup['doctor']['firstname'], $checkup['doctor']['lastname'], $checkup['doctor']['middlename'], true); ?>
                          </span>
                          <span class="pull-right margin-r-10">
                            <span class="btn btn-primary btn-sm" data-id="<?php echo $checkup['checkup_id'] ?>" id="edit"><i class="fa fa-pencil"></i></span>
                            <span class="btn btn-danger btn-sm" data-id="<?php echo $checkup['checkup_id'] ?>" id="delete"><i class="fa fa-trash-o"></i></span>
                          </span>
                        </li>
                        <li>
                          <i class="fa fa-child bg-blue"></i>
                          <div class="timeline-item">
                            <h3 class="timeline-header">
                              <a>Vitals</a>
                            </h3>
                            <div class="timeline-body">
                              <table class="table">
                                <tr>
                                  <th>BP</th>
                                  <th>TEMP</th>
                                  <th>PR</th>
                                  <th>RR</th>
                                  <th>WT</th>
                                  <th>HT</th>
                                </tr>
                                <tr>
                                  <td><?php echo $checkup['blood_pressure'] ?></td>
                                  <td><?php echo $checkup['temperature'] ?></td>
                                  <td><?php echo $checkup['pulse_rate'] ?></td>
                                  <td><?php echo $checkup['respiration_rate'] ?></td>
                                  <td><?php echo $checkup['weight'] ?></td>
                                  <td><?php echo $checkup['height'] ?></td>
                                </tr>
                              </table>
                            </div>
                          </li>
                          <li>
                            <i class="fa fa-flask bg-yellow"></i>
                            <div class="timeline-item">
                              <h3 class="timeline-header"><a>Symptoms</a></h3>
                              <div class="timeline-body">
                                <?php echo $checkup['symptoms'] ?>
                              </div>
                            </div>
                          </li>
                          <li>
                            <i class="fa fa-code-fork bg-aqua"></i>
                            <div class="timeline-item">
                              <h3 class="timeline-header">
                                <a>Diagnosis</a>
                              </h3>
                              <div class="timeline-body">
                                <?php echo $checkup['diagnosis'] ?>
                              </div>
                            </div>
                          </li>
                          <li class="main_prescription" id="main_prescription_<?php echo $checkup['checkup_id'] ?>">
                            <i class="fa fa-medkit bg-green"></i>
                            <div class="timeline-item">
                              <h3 class="timeline-header">
                                <a>Prescription</a>
                                <span title="New Checkup" class="btn btn-primary pull-right btn-sm" data-id="<?php echo $checkup['checkup_id'] ?>" id="new_prescription"><i class="fa fa-plus"></i></span>
                              </h3>
                              <div class="timeline-body">
                                <table class="table">
                                  <tr>
                                    <th width="5%">#</th>
                                    <th width="25%">Medicine</th>
                                    <th width="15%">No.Of Days</th>
                                    <th width="20%">When to Take</th>
                                    <th width="20%">Before Meal?</th>
                                    <th width="15%"></th>
                                  </tr>
                                  <?php foreach ($checkup['prescription'] as $key => $prescription): ?>
                                    <tr>
                                      <td><?php echo ++$key ?>.</td>
                                      <td><?php echo $prescription['name'] ?></td>
                                      <td><?php echo $prescription['no_days'] ?></td>
                                      <td><?php echo $prescription['intake_schedule'] ?></td>
                                      <td><?php echo $prescription['before_meal'] == 1 ? 'Yes' : 'No' ?></td>
                                      <td>
                                        <button class="btn btn-success btn-sm edit btn-flat" data-id="<?php echo $prescription['id']; ?>" id="prescription_edit"><i class="fa fa-edit"></i></button>
                                        <button class="btn btn-danger btn-sm delete btn-flat" data-id="<?php echo $prescription['id']; ?>" id="prescription_delete"><i class="fa fa-trash"></i></button>
                                      </td>
                                    </tr>
                                  <?php endforeach; ?>
                                </table>
                              </div>
                              <div class="timeline-body">
                                <b>Extra Note :</b>
                                <p><?php echo $checkup['notes'] ?></p>
                              </div>
                            </div>
                          </li>
                          <li class="add_prescription" id="add_prescription_<?php echo $checkup['checkup_id'] ?>">
                            <i class="fa fa-medkit bg-green"></i>
                            <div class="timeline-item">
                              <h3 class="timeline-header">
                                <a>New Prescription</a>
                                <button type="button" class="btn bg-light pull-right" aria-label="Close" title="Close" data-id="<?php echo $checkup['checkup_id'] ?>" id="close_prescription"><span aria-hidden="true">&times;</span></button>
                              </h3>
                              <div class="timeline-body">
                                <form class="prescription_form" enctype="multipart/form-data">
                                  <table class="table">
                                    <tr>
                                      <th width="5%">#</th>
                                      <th width="30%">Medicine</th>
                                      <th width="15%">No.Of Days</th>
                                      <th width="20%">When to Take</th>
                                      <th width="20%">Before Meal?</th>
                                      <th width="10%"></th>
                                    </tr>
                                    <tr>
                                      <td></td>
                                      <td>
                                        <div class="form-group">
                                          <select class="form-control" id="medicine_<?php echo $checkup['checkup_id'] ?>" name="medicine" required>
                                            <option value="">-select-</option>
                                            <?php foreach ($this->medicines as $medicine): ?>
                                              <option value="<?php echo $medicine['med_id'] ?>"><?php echo $medicine['name'] ?></option>
                                            <?php endforeach; ?>
                                          </select>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-group">
                                          <input type="number" min="1" max="100" class="form-control" id="no_days_<?php echo $checkup['checkup_id'] ?>" name="no_days" value="1" required>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-group">
                                          <select class="form-control" id="intake_schedule_<?php echo $checkup['checkup_id'] ?>" name="intake_schedule" required>
                                            <option value="">-select-</option>
                                            <option value="1-0-0">1-0-0</option>
                                            <option value="1-1-0">1-1-0</option>
                                            <option value="1-1-1">1-1-1</option>
                                            <option value="0-1-0">0-1-0</option>
                                            <option value="0-1-1">0-1-1</option>
                                            <option value="0-0-1">0-0-1</option>
                                            <option value="1-0-1">1-0-1</option>
                                          </select>
                                        </div>
                                      </td>
                                      <td>
                                        <div class="form-group">
                                          <select class="form-control" id="before_meal_<?php echo $checkup['checkup_id'] ?>" name="before_meal" required>
                                            <option value="">-select-</option>
                                            <option value="1">Yes</option>
                                            <option value="0">No</option>
                                          </select>
                                        </div>
                                      </td>
                                      <input type="hidden" name="checkup_id" value="<?php echo $checkup['checkup_id'] ?>">
                                      <td>
                                        <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
                                      </td>
                                    </tr>
                                  </table>
                                  <hr>
                                </form>
                              </div>
                            </div>
                          </li>
                        </ul>
                      </div>
                    </div>
                  </div>
                <?php endforeach; ?>
              <?php else: ?>
                <p class="text-center">Nothing to show..</p>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</div>
