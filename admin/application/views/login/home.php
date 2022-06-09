

    <section id="main-content" class="home" style="height: auto;">
    <section class="wrapper">
    <div class="adminApproval">
    <div class="row state-overview">
    <div class="col-lg-3 col-sm-6">
    <section class="panel">
    <div class="symbol terques">
    <i class="fa fa-users"></i>
    </div>
    <div class="value">
    <h1 class="count">
    <?php if($users_count)
    echo $users_count;
    else 
    {?> 0 <?php } ?>
    </h1>
    <p><?= lang("USERS");?></p>
    </div>
    </section>
    </div>
    <div class="col-lg-3 col-sm-6">
    <section class="panel">
    <div class="symbol red">
    <i class="fa fa-unlock"></i>
    </div>
    <div class="value">
    <h1 class=" count2">
    <?php if($job_count)
    echo $job_count;
    else 
    {?> 0 <?php } ?>
    </h1>
    <p><?= lang("JOBS");?></p>
    </div>
    </section>
    </div>
    <div class="col-lg-3 col-sm-6">
    <section class="panel">
    <div class="symbol yellow">
    <i class="fa fa-paperclip"></i>
    </div>
    <div class="value">
    <h1 class=" count3">
    <?php if($resumes_count)
    echo $resumes_count;
    else 
    {?> 0 <?php } ?>
    </h1>
    <p><?= lang("RESUMES");?></p>
    </div>
    </section>
    </div>
    <div class="col-lg-3 col-sm-6">
    <section class="panel">
    <div class="symbol blue">
    <i class="fa fa-desktop"></i>
    </div>
    <div class="value">
    <h1 class=" count4">
    <?php if($company_count)
    echo $company_count;
    else 
    {?> 0 <?php } ?>
    </h1>
    <p><?= lang("COMPANIES");?></p>
    </div>
    </section>
    </div>
    </div>
    <!--state overview end-->

    <!-- tables -->
    <div class="col-lg-12" >
        <div class="col-lg-5">
        <div class="panel-body progress-panel">
            
            <div class="task-progress">
                <h1><?= lang("LATEST_COMPANIES");?></h1>
            </div>
        </div>
            <table class="table table-hover">
                <tbody id="users">
                    <tr>
                        <th></th><th><?= lang("COMPANY_LIST");?></th>
                    </tr>
                        <?php
                        $i =1 ;
                        foreach($companies_data as $v){
                        if($i <= 5 ) {

                        ?>
                        <tr>
                            <td><?= $i; ?></td>
                            <td><?= $v["company_name"];?></td>
                        </tr>
                        <?php  }$i++;
                        } ?>
                </tbody>
            </table>
        </div>
    <div class="col-lg-7">
    <div class="panel-body progress-panel">
    <div class="task-progress">
    <h1><?= lang("LATEST_JOBS");?></h1>
    </div>
    </div>
    <table class="table table-hover">
    <tbody id="jobs">
    <tr><th></th><th><?= lang("JOB_ORDER_NUMBER");?></th>
                <th><?= lang("JOB_POSITION");?></th></tr>
    <?php
    $i =1 ;
    foreach($job_data as $v){
    if($i <= 5 ) {

    ?>   <tr>
    <td><?= $i; ?></td>
    <td>JON-<?= $v["formID"];?></td>
    <td><?= $v["position"]; ?></td>
    </tr>
    <?php  }$i++;
    } ?>

    </tbody>
    </table>
    </div>
    </div>
    <!-- ****** -->
    <!-- tables -->
    <div class="col-lg-12">
    <div class="col-lg-6">
    <div class="panel-body progress-panel">
    <div class="task-progress">
    <h1><?= lang("LATEST_RESUMES");?></h1>
    </div>
    </div>
    <table class="table table-hover">
    <tbody id="resumes">
    <tr><th></th><th><?= lang("APPLICANT_RESUMES");?></th></tr>
    <?php
    $i =1 ;
    foreach($resumes_data as $v){

    if($v["apply_from"] == "M")
    {
    $filename = str_replace("resumes/","",$v["filepath"]);

    }elseif($v["apply_from"] == "B")
    {
    $filename = str_replace("bulkupload/","",$v["filepath"]);
    }

    if($i <= 5 ) {

    ?>   <tr>
    <td><?= $i; ?></td>
    <td><a target='_blank' href="<?= base_url().$v["filepath"];?>"><?= $filename;?></a>
    </td></tr>
    <?php  }$i++;
    } ?>

    </tbody>
    </table>
    </div>
    </div>
    </div>
    </section>
    </section>

   
  