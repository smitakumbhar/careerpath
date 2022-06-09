<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="ROBOTS" content="NOINDEX"  />
<title><?php echo $page_title?></title>
<?php include('css/css.php'); ?>
</head>
 <?php if(isset($view_file)) {$this->load->view($view_file);}?>
<br>
 <!--footer start-->
        <footer>
            <div class="text-center">
                 &copy; Copyright Careerpaths NW
              
            </div>
        </footer>
<!--footer end-->
</html>