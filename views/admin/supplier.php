<div class="content-wrapper">
<!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      Supplier
    </h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
      <li class="active">Supplier</li>
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
                <th>Name</th>
                <th>Address</th>
                <th>Tools</th>
              </thead>
              <tbody>
                <?php if ($this->count($this->data) > 0): ?>
                  <?php foreach ($this->data as $supplier): ?>
                    <tr>
                      <td><?php echo $supplier['name']; ?></td>
                      <td><?php echo $supplier['address']; ?></td>
                      <td>
                        <span>
                          <button class="btn btn-success btn-sm btn-md" data-id="<?php echo $supplier['supplier_id']; ?>" id="edit"><i class="fa fa-edit"></i></button>
                          <button class="btn btn-danger btn-sm btn-md" data-id="<?php echo $supplier['supplier_id']; ?>" id="delete"><i class="fa fa-trash"></i></button>
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
          Supplier
          <button type="button" class="btn btn-flat pull-right" aria-label="Close" title="Close" id="close"><span aria-hidden="true">&times;</span></button>
        </h3>
        <form class="form-horizontal" id="cateogry_form" enctype="multipart/form-data">
          <div class="form-group">
            <div class="col-lg-12">
              <label for="name" class="control-label">Name (Company)</label>
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
          </div>
          <div class="form-group">
            <div class="col-lg-12">
              <label for="address" class="control-label">Address</label>
              <textarea class="form-control" name="address" id="address" required></textarea>
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
