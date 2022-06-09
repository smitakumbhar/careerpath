

		<style>
        	.jobf{
				width:50%;
				margin:1px auto;
               background-color: #ebebeb;

			}
			
                        .btn.btn-success.fileinput-button {
                            background-color: #6dbb4a;
                            margin-left: 2.5%;
                            margin-top: 1%;
                        }
                          #addinputtag{
                         float:left;width:74%;
                         }
                         input[type=file] {
                            margin-top: 5px;
                            margin-bottom: 5px;
                         }
                         .ui-widget-header{
                             background-color: #3c763d !important;
                         }
                         .ui-progressbar.ui-widget.ui-widget-content.ui-corner-all{
                             width: 70%;
                             margin: 0 auto;
                         }
                         #resume_name{
                              background-color: #dff0d8;
                              color: #3c763d;
                              width: 70%;
                              margin: 0 auto;
                              padding-left: 10px;

                         }
                          #resume_update_failed_name{
                                background-color: #f2dede;
                                color: #a94442;
                                width: 70%;
                                margin: 0 auto;
                                padding-left: 10px;
                         }
                          .loader {
  border: 4px solid #f3f3f3;
  border-radius: 50%;
  border-top: 4px solid #3498db;
  width: 40px;
  height: 40px;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
  float: right;
}

@-webkit-keyframes spin {
  0% { -webkit-transform: rotate(0deg); }
  100% { -webkit-transform: rotate(360deg); }
}

@keyframes spin {
  0% { transform: rotate(0deg); }
  100% { transform: rotate(360deg); }
}

        </style>
        
            <!--main content start-->
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                	<span id="back" class="redirect" title="<?= base_url() ?>view_resumelist"><< View My Desk</span><br><br>
                                    <span class="pagelbl">Add Resumes</span><br><br>
                                </header>

                                <div class="panel-body">
                                	<div class="jobf">
                                    <form  enctype="multipart/form-data" class="cmxform form-horizontal tasi-form store" id="jobForm" method="post" action="<?= base_url() ?>resume/bulk_upload">
                    <?php echo form_hidden('flag', "uploadBulk");?>
 <?php if($upload_failed!="") {?>
    <div class="formtxt star" align="center" id="valid_error"><?php echo $upload_failed?></div>
    <?php }?>
                                         <div class="col-lg-6">
                                            <label class="col-lg-10" for="company_products_services">Upload Files</label>
                                           
                                            <div class="col-lg-8" id="addinputtag" >
                                                <label id="filepath" style="margin-left:15px;"></label>
                                                <input type="file" name="file[]" multiple id="upload">
                                            </div>
                                        </div>
                <!-- ____________________ 12 june code added here____________________ -->


                                        <div class="form-group">
                                            <div class="col-lg-10">
                                                <button type="submit" class="btn sh"  style="cursor: pointer;background-color:#342f29; color:#FFF;" name="uploadbtn" onclick="return checkfile()">Upload</button>
                                            </div>
                                        </div>
                                        <?= form_error("file");?>
                                    </form>


                                    </div>
                                </div>
                              
                            </section>
                        </div>
                    </div>
                    <!-- page end-->
                </section>
            </section>
           

<script type="text/javascript">

function checkfile()
{
    if(document.getElementById("upload").files.length > 20)
    {
             alert("Upload Limit is 20 Only!!");
             return false;
    }

}
</script>
      