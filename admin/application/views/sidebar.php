      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                  <li>
                      <a class="active" href="<?php echo base_url();?>home/index">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li><br>
                  <?php if($_SESSION['user_type'] == 'Super Admin'){ ?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-laptop"></i>
                          <span><?= lang("USER_MANAGEMENT");?></span>
                      </a>
                      <ul class="sub">
                          <li><a href="<?php echo base_url();?>user/add">Add User</a></li>
                          <li><a  href="<?php echo base_url();?>user/index/nosearch">View User List</a></li>
                      </ul>
                  </li>
                  <?php } ?>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-book"></i>
                          <span><?= lang("JOBS");?></span>
                      </a>
                      <ul class="sub">
                          <li><a href="<?php echo base_url();?>job/add">Add Jobs</a></li>
                          <li><a href="<?php echo base_url();?>job/index/nosearch">View Job List</a></li>
                          <li><a href="<?php echo base_url();?>job/job_order_book">Digital Job Order Book</a></li>
                      </ul>
                  </li>

      <li class="sub-menu">
          <a href="javascript:;" >
              <i class="fa fa-cogs"></i>
              <span><?= lang("RESUMES");?></span>
          </a>
          <ul class="sub">
<li><a href="<?php echo base_url();?>resume/add"><?= lang("ADD_RESUMES");?></a></li>
<li><a href="<?php echo base_url();?>desk/mydesk/nosearch"><?= lang("VIEW_MY_DESK");?></a></li>
<li><a href="<?php echo base_url();?>resume/index/nosearch"><?= lang("VIEW_RESUMES");?></a></li>


<li><a href="<?php echo base_url();?>desk/userdesk/nosearch"><?= lang("USER_DESK");?></a></li>

<li><a href="<?php echo base_url();?>resume/bulk_filelist"><?= lang("BULK_UPLOAD_LIST");?></a></li>

<li><a href="<?php echo base_url();?>search"><?= lang("SEARCH");?></a></li>
               
          </ul>
      </li>
<li class="sub-menu">
  <a href="javascript:;" >
      <i class="fa fa-tasks"></i>
      <span>Companies</span>
  </a>
  <ul class="sub">
    <li><a href="<?php echo base_url();?>company/add"><?= lang("ADD_COMPANIES");?></a></li>
    <li><a href="<?php echo base_url();?>department/add"><?= lang("ADD_DEPARTMENT");?></a></li>
    <li><a href="<?php echo base_url();?>location/add"><?= lang("ADD_LOCATION");?></a></li> 
    <li><a href="<?php echo base_url();?>industry/add"><?= lang("ADD_INDUSTRY");?></a></li>
    <li><a href="<?php echo base_url();?>company/index/nosearch"><?= lang("VIEW_COMPANY_LIST");?></a></li>
    <li><a href="<?php echo base_url();?>department/index/nosearch"><?= lang("VIEW_DEPARTMENT_LIST");?></a></li>
    <li><a href="<?php echo base_url();?>location/index/nosearch"><?= lang("VIEW_LOCATION_LIST");?></a></li> 
    
    <li><a href="<?php echo base_url();?>industry/index/nosearch"><?= lang("VIEW_INDUSTRY");?></a></li>
  </ul>
</li>
                  <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-foursquare"></i>
                          <span><?= lang("REPORTS");?></span>
                      </a>
                      <ul class="sub">
                           
                         <li><a  href="<?php echo base_url();?>report/cindex/nosearch">Company Report</a></li>
                          <li><a  href="<?php echo base_url();?>report/jindex/nosearch">Job Report</a></li>
                   

                      </ul>
                  </li>

<li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-plus-square-o"></i>
                          <span><?= lang("CANDIDATE_MASTERS");?></span>
                      </a>
                      <ul class="sub">
                          
                        <li><?php echo anchor( 'candidate/index/nosearch', lang('VIEW_CANDIDATES'));?>
                        </li>
                        <li><?php echo anchor( 'candidate/view_candidates/nosearch', lang('SEND_EMAIL'));?>
                        </li>
                          
                       </ul>
                  </li>
                  


                   <li class="sub-menu">
                      <a href="javascript:;" >
                          <i class="fa fa-share"></i>
                          <span><?= lang("MASTERS");?></span>
                      </a>
                      <ul class="sub">
                          
                         <li><?php echo anchor( 'email/index/nosearch', lang('EMAIL_TEMPLATE'));?>
                        </li>
                          
                       </ul>
                  </li>
                  
                <li>
                      <a href="<?php echo base_url();?>form/formdownloads">
                          <i class="fa fa-download"></i>
                          <span><?= lang("DOWNLOAD_FORMS");?></span>
                      </a>
                  </li>

                    <li>

                      <a href="<?php echo base_url();?>email/resume_list/nosearch">
                          <i class="fa fa-mail-reply-all"></i>
                          <span><?= lang("SEND_EMAIL");?></span>
                      </a>
                  </li>
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->