<!--header start-->
      <header class="header white-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="<?php echo base_url();?>home/index" class="logo" ><img src="<?php echo base_url();?>images/logo.png" width="85%" /></a>
            <!--logo end-->

            <div class="top-nav ">
            <ul class="nav pull-right top-menu">
              
             
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                       
                        <span class="username"><?php echo @$_SESSION['user_name']; ?></span>
                        <b class="caret"></b>
                    </a>
                    <ul class="dropdown-menu extended logout">
                        <div class="log-arrow-up"></div>
                  <li><a href="<?php echo base_url();?>login/logout"><i class="fa fa-key"></i> Log Out</a></li>
                    </ul>
                </li>
                
            </ul>
        </div>
        </header>
      <!--header end-->
