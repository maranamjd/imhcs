<header class="main-header">
    <!-- Logo -->
    <a href="index2.html" class="logo">
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
                <img src="<?php echo URL ?>public/img/unknown.png" class="img-circle" alt="User Image">

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
            <a><i class="fa fa-circle text-success"></i>Doctor</a>
          </div>
        </div>

        <ul class="sidebar-menu" data-widget="tree">

          <li class="<?php echo ($this->page == "index") ? 'active' : '' ?>"><a href="<?php echo URL ?>doctor"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
          <li class="<?php echo ($this->page == "patient") ? 'active' : '' ?>"><a href="<?php echo URL ?>doctor/patient"><i class="fa fa-wheelchair"></i> <span>Patient</span></a></li>
          <li class="<?php echo ($this->page == "medication") ? 'active' : '' ?>"><a href="<?php echo URL ?>doctor/medication"><i class="fa fa-tablet"></i> <span>Medication</span></a></li>
          <li class="<?php echo ($this->page == "laboratory") ? 'active' : '' ?>"><a href="<?php echo URL ?>doctor/laboratory"><i class="fa fa-flask"></i> <span>Laboratory</span></a></li>
          <li class="<?php echo ($this->page == "vaccine") ? 'active' : '' ?>"><a href="<?php echo URL ?>doctor/vaccine"><i class="fa fa-medkit"></i> <span>Vaccine</span></a></li>
          <li class="<?php echo ($this->page == "referral") ? 'active' : '' ?>"><a href="<?php echo URL ?>doctor/referral"><i class="fa fa-medkit"></i> <span>Referral</span></a></li>
          <li class="<?php echo ($this->page == "report") ? 'active' : '' ?>"><a href="<?php echo URL ?>doctor/report"><i class="fa fa-file"></i> <span>Report</span></a></li>

        </ul>
      </section>

    </aside>
