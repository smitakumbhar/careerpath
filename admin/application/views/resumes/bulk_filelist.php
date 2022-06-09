
            <section id="main-content">
                <section class="wrapper">
                    <!-- page start-->

                    <div class="row">
                        <div class="col-lg-12">
                            <section class="panel">
                                <header class="panel-heading">
                                	<span id="back" class="redirect" title="View My Desk"><< <a href="<?php echo base_url();?>resume/index/nosearch">View My Desk</a></span><br><br>
                                   
                                </header>
 <?php echo form_open('resume/bulk_filelist');?>
                <?php echo form_hidden('flag', $flag);?>
                                <div class="panel-body">
                                    <input type="submit" name="submit" value="Export Bulkupload Resumes Email List" class="btn sh" style="background-color:#342f29; color:#FFF">
                                </div>
               <?php echo form_close();?>                
                            </section>
                        </div>
                    </div>
                    <!-- page end-->
                </section>
            </section>
           