<div class="content-wrapper">
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Medicine Supply
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Supply</li>
    </ol>
  </section>

  <section class="content">
    <div class="row">
      <div class="col-lg-12" id="main_content">
        <?php if ($this->count($this->expired) >= 1): ?>
          <div class="alert alert-warning">
            <h4>Warning!</h4>
            The following Medicine Stock are Expired!!
            <ul>
              <?php foreach ($this->expired as $medicine): ?>
                <li><h4><?php echo $medicine['stock_code'] ?> - <?php echo $medicine['name'] ?></h4></li>
              <?php endforeach; ?>
            </ul>
          </div>
        <?php endif; ?>
        <div class="box">
          <div class="box-header with-border">
          </div>
          <div class="box-body">
            <table id="main_table" class="table table-bordered table-striped">
              <thead>
                <th>Stock Code</th>
                <th>Name</th>
                <th>Stock Date</th>
                <th>Validity Period (week/s)</th>
                <th>Status</th>
                <th>Tools</th>
              </thead>
              <tbody>
                <?php if ($this->count($this->data) > 0): ?>
                  <?php foreach ($this->data as $medicine): ?>
                    <tr>
                      <td><?php echo $medicine['stock_code']; ?></td>
                      <td><?php echo $medicine['name']; ?></td>
                      <td><?php echo date('F d, Y', strtotime($medicine['date'])); ?></td>
                      <td><?php echo $medicine['validity_period']; ?></td>
                      <?php if ($this->validity_status($medicine['date'], $medicine['validity_period']) == 1): ?>
                        <td style="background-color: #ffb732">
                          Expired
                        </td>
                        <td>
                          <button class="btn btn-success btn-sm btn-md" data-id="<?php echo $medicine['med_supply_id']; ?>" id="pullout" title="Pull out"><i class="fa fa-sign-out-alt"></i></button>
                        </td>
                      <?php else: ?>
                        <td>
                          <?php echo  $this->validity_status($medicine['date'], $medicine['validity_period'])?>
                        </td>
                        <td></td>
                      <?php endif; ?>
                    </tr>
                  <?php endforeach; ?>
                <?php endif; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </section>

</div>
