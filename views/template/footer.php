    <?php if (Session::get('user_type') !== null): ?>
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>All rights reserved</b>
        </div>
        <strong>Copyright &copy; 2019 <a href="">Isidro Mendoza Health Center</a></strong>
      </footer>
    <?php endif; ?>

    </div>
    <!-- wrappper -->


    <script src="<?php echo URL ?>bower_components/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo URL ?>bower_components/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="<?php echo URL ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo URL ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo URL ?>bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo URL ?>bower_components/chart.js/dist/Chart.js"></script>
    <script src="<?php echo URL ?>dist/js/adminlte.min.js"></script>
    <script>
        let url = "http://localhost/imhcs/";
    </script>
    <?php
      if (isset($this->js)) {
        foreach ($this->js as $js) {
          echo "<script src='".URL."views/".$js."'></script>";
        }
      }
    ?>
  </body>
</html>
