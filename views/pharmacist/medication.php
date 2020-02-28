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
                        <button class="btn btn-primary btn-sm btn-flat" data-id="<?php echo $medication['medication_id']; ?>" id="fulfill">Fulfill</button>
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

    </div>
  </div>
</section>
</div>
