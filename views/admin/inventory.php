<div class="content-wrapper">
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Inventory
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Inventory</li>
    </ol>
  </section>

  <section class="content">

    <div class="row">
      <div class="col-lg-12" id="main_content">
        <?php if ($this->count($this->low_stock) >= 1): ?>
          <div class="alert alert-warning">
            <h4>Warning!</h4>
            These medicine/s are low on stock!!
            <ul>
              <?php foreach ($this->low_stock as $medicine): ?>
                <li><h4><?php echo $medicine['name'] ?></h4></li>
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
                <th>Name</th>
                <th>Category</th>
                <th>Stock</th>
                <th>Tools</th>
              </thead>
              <tbody>
                <?php if ($this->count($this->data) > 0): ?>
                  <?php foreach ($this->data as $medicine): ?>
                    <tr>
                      <td><?php echo $medicine['name']; ?></td>
                      <td><?php echo $medicine['description']; ?></td>
                      <?php if ($medicine['stock'] <= 100): ?>
                        <td style="background-color: #ffb732" title="Stock Quantity is low"><?php echo $medicine['stock']; ?></td>
                      <?php else: ?>
                        <td><?php echo $medicine['stock']; ?></td>
                      <?php endif; ?>
                      <td>
                        <span>
                          <button class="btn btn-primary btn-sm btn-md" data-id="<?php echo $medicine['med_id']; ?>" id="add"><i class="fa fa-plus"></i></button>
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
          Medicine info
          <button type="button" class="btn btn-flat pull-right" aria-label="Close" title="Close" id="close"><span aria-hidden="true">&times;</span></button>
        </h3>
        <form class="form-horizontal" id="medicine_form" enctype="multipart/form-data">
          <div class="form-group">
            <div class="col-lg-12">
              <label for="quantity" class="control-label">Quantity</label>
              <input type="number" class="form-control" maxlength="6" min="100" max="100000"  id="quantity" name="quantity" required>
            </div>
          </div>

          <div class="form-group">
            <div class="col-lg-12">
              <label for="supplier" class="control-label">Supplier</label>
              <select class="form-control" name="supplier" id="supplier" required>
                <option value="" selected>- Select -</option>
                <?php foreach ($this->supplier as $supplier): ?>
                  <option value="<?php echo $supplier['supplier_id'] ?>"><?php echo $supplier['name'] ?></option>
                <?php endforeach; ?>
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
