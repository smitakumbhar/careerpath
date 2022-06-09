<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="ROBOTS" content="NOINDEX"  />
<title><?php echo $page_title?></title>
<?php include('css/css.php'); ?>


<script type="text/JavaScript">
function reallylogout()
{
	
	if(confirm('<?php echo lang("LOGOUT_MESSAGE"); ?>'))
		return true;
	else
		return false;
}
</script>
   <?php //include('js_old/js1.php'); ?>  
   <?php include('js/js.php'); ?>  
</head>

    <body>
    	<?php 
				$this->load->view('header'); 
				$this->load->view('sidebar'); 
				
         ?>
        <section id="container" style="background-color:white;height:auto;" >
            
            <?php 
				if(isset($view_file)) {$this->load->view($view_file);}
					
             ?>

        </section>
        
       <?php 
				$this->load->view('footer_home'); 
				
         ?>
   
   	<?php include('js/js1.php'); ?> 
     </body>
     
</html>
