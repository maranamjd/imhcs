<header class="main-header">
    <!-- Logo -->
    <a href="<?php echo URL ?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>I</b>M</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>IsidroMendoza</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo URL ?>system/uploads/img/<?php echo $this->info['user']['image'] ?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $this->name_format($this->info['details']['firstname'], $this->info['details']['lastname'], $this->info['details']['middlename'], true); ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="<?php echo URL ?>public/img/<?php echo $this->info['user']['image'] ?>" class="img-circle" alt="User Image">

                <p>
                  <?php echo $this->name_format($this->info['details']['firstname'], $this->info['details']['lastname'], $this->info['details']['middlename']); ?>
                  <small><?php echo $this->info['user']['user_id'] ?></small>
                </p>
              </li>
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#profile" data-toggle="modal" class="btn btn-default btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="<?php echo URL ?>user/logout" class="btn btn-default btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  <aside class="main-sidebar">
      <!-- sidebar: style can be found in sidebar.less -->
      <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
          <div class="pull-left image">
            <img src="<?php echo URL ?>system/uploads/img/<?php echo $this->info['user']['image'] ?>" class="img-circle" alt="User Image">
          </div>
          <div class="pull-left info">
            <p><?php echo $this->name_format($this->info['details']['firstname'], $this->info['details']['lastname'], $this->info['details']['middlename'], true); ?></p>
            <a><i class="fa fa-circle text-success"></i>Administrator</a>
          </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">

          <li class="<?php echo ($this->page == "index") ? 'active' : '' ?>"><a href="<?php echo URL ?>admin"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>

          <li class="treeview <?php echo ($this->page == "doctor" || $this->page == "nurse" || $this->page == "laboratorist" || $this->page == "pharmacist") ? 'active' : '' ?>">
           <a href="#">
             <i class="fa fa-users"></i>
             <span>User Management</span>
             <span class="pull-right-container">
               <i class="fa fa-angle-left pull-right"></i>
             </span>
           </a>
           <ul class="treeview-menu">
             <li class="<?php echo ($this->page == "doctor") ? 'active' : '' ?>"><a href="<?php echo URL ?>admin/doctor"><i class="fa fa-user-md"></i> Doctors</a></li>
             <li class="<?php echo ($this->page == "nurse") ? 'active' : '' ?>"><a href="<?php echo URL ?>admin/nurse"><i class="fa fa-female"></i> Nurse</a></li>
             <li class="<?php echo ($this->page == "laboratorist") ? 'active' : '' ?>"><a href="<?php echo URL ?>admin/laboratorist"><i class="fa fa-plus-square"></i> Laboratorist</a></li>
             <li class="<?php echo ($this->page == "pharmacist") ? 'active' : '' ?>"><a href="<?php echo URL ?>admin/pharmacist"><i class="fa fa-flask"></i> Pharmacist</a></li>
           </ul>
         </li>

           <li class="treeview <?php echo ($this->page == "medicine" || $this->page == "category" || $this->page == "lab") ? 'active' : '' ?>">
            <a href="#">
              <i class="fa fa-gear"></i>
              <span>Maintenance</span>
              <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
            </a>
            <ul class="treeview-menu">
              <li class="<?php echo ($this->page == "medicine") ? 'active' : '' ?>"><a href="<?php echo URL ?>admin/medicine"><i class="fa fa-medkit"></i> Medicines</a></li>
              <li class="<?php echo ($this->page == "category") ? 'active' : '' ?>"><a href="<?php echo URL ?>admin/category"><i class="fa fa-list-alt"></i> Categories</a></li>
              <li class="<?php echo ($this->page == "lab") ? 'active' : '' ?>"><a href="<?php echo URL ?>admin/lab"><i class="fa fa-list-alt"></i> Laboratory Test</a></li>
            </ul>
          </li>

          <li class="<?php echo ($this->page == "report") ? 'active' : '' ?>"><a href="<?php echo URL ?>admin/report"><i class="fa fa-line-chart"></i> <span>Report</span></a></li>
          <li class="<?php echo ($this->page == "configuration") ? 'active' : '' ?>"><a href="<?php echo URL ?>admin/configuration"><i class="fa fa-database"></i> <span>System Configurations</span></a></li>


        </ul>
      </section>

    </aside>
