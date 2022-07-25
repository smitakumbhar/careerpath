      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse"  style="width:17%">

            <?php
            $rights = new RightsModel();
            $admin_rights=$rights->checkAdminRights();
      ?>

              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
                <?php if(in_array(1,$admin_rights)) {?>
                  <li>
                      <a class="active" href="<?php echo base_url();?>home/index">
                          <i class="fa fa-dashboard"></i>
                          <span>Dashboard</span>
                      </a>
                  </li><br>
                <?php }?>

                   <?php if(in_array(2,$admin_rights)) {?>
                   <li class="sub-menu">
                      <a href="<?php echo base_url();?>rights/index">
                          <i class="fa fa-cogs"></i>
                          <span><?= lang("ADMIN_MANAGEMENT");?></span>
                      </a>
                      <ul class="sub">
                          <li><a href="<?php echo base_url();?>rights/add"><?php echo lang("ADD_ADMIN_USER"); ?></a></li>
                          <li><a  href="<?php echo base_url();?>user/index/nosearch"><?php echo lang("VIEW_ADMIN_USERS"); ?></a></li>
                      </ul>
                   <?php }?>   
                  </li>
                    <?php if(in_array(6,$admin_rights)) {?>    
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
                   <?php }?>
   <?php if(in_array(10,$admin_rights)) {?>       
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

<li><a href="<?php echo base_url();?>search/folder_index/nosearch"><?= lang("SEARCH");?></a></li>

<li><a href="<?php echo base_url();?>email/resume_list/nosearch"><?= lang("SEND_EMAIL");?></a></li>

         
          </ul>
      </li>
       <?php }?>
        <?php if(in_array(14,$admin_rights)) {?> 
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
</li><?php }?>
<?php if(in_array(18,$admin_rights)) {?> 
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
<?php }?>
<?php if(in_array(19,$admin_rights)) {?> 

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
 <?php }?>                 
   
         
 <?php if(in_array(28,$admin_rights)) {?> 
                  
<li>
    <a href="<?php echo base_url();?>form/formdownloads">
      <i class="fa fa-download"></i>
      <span><?= lang("DOWNLOAD_FORMS");?></span>
    </a>
</li>
<?php }?> 
  
              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
      <!--sidebar end-->