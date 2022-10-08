<div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
        <div class="sidebar-header">
            <?php if(session()->get("role") == 1):?>
                <h3>Admin</h3>
                <strong>AM</strong>
            <?php elseif(session()->get("role") == 2):?>
                <h3>Manager</h3>
                <strong>MG</strong>
            <?php elseif(session()->get("role") == 3):?>
                <h3>Surveyor</h3>
                <strong>SV</strong>
            <?php elseif(session()->get("role") == 5):?>
                <h3>Stock/mak_rmc User</h3>
                <strong>S/I</strong>
            <?php else:?>
                <h3>User</h3>
                <strong>UR</strong>
            <?php endif?>
        </div>

        <ul class="list-unstyled components">
            <li class="active">
                <a  href="<?php echo base_url()."/dashboard";?>">
                    <i class="fas fa-tachometer-alt"></i>
                     Dashboard
                </a>
            </li>

            <?php if(session()->get("role") == 1):?>
            <li class="active">
                <a href="#usersSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                    <i class="fas fa-users"></i>
                     Users
                </a>
                <ul class="collapse list-unstyled" id="usersSubmenu">
                    <li>
                        <a href="<?php echo base_url()."/users/create";?>"><i class="fa fa-plus" aria-hidden="true"></i> Add User</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url()."/users/manage";?>"><i class="fa fa-wrench" aria-hidden="true"></i> Manage Users</a>
                    </li>
                </ul>
            </li>
            <?php endif?>

            <?php if(session()->get("role") == 1):?>
            <li class="active">
                <a href="#motortestingSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">

                    <i class="fa fa-check" aria-hidden="true"></i>
                     Motor Testing
                </a>
                <ul class="collapse list-unstyled" id="motortestingSubmenu">
                    <li>
                        <a href="<?php echo base_url()."/motor_test/create";?>"><i class="fa fa-plus" aria-hidden="true"></i>Test Information</a>
                    </li>
                </ul>
            </li>
            <?php endif?>

        </ul>
    </nav>
    <!-- Page Content  -->
    <div id="content">

        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-light">
                    <i class="fas fa-align-left"></i>
                </button>
                <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <i class="fas fa-align-justify"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="<?php echo base_url()."/auth/logout";?>"> <i class="fa fa-power-off" aria-hidden="true"></i> Logout</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
