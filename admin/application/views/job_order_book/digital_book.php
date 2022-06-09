<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Digital Job Order Book</title>
	<style type="text/css">	

		body{
    overflow:hidden;
}

#flipbook{
    width:900px;
    height:560px;
  
}

#flipbook .page{
    width:900px;
    height:560px;
    background-color:white;
    font-size:15px;
    text-align:left;
  
}

#flipbook .page-wrapper{
    -webkit-perspective:2000px;
    -moz-perspective:2000px;
    -ms-perspective:2000px;
    -o-perspective:2000px;
    perspective:2000px;
   
}

#flipbook .hard{
    background:#FFF !important;
    color:#333;
    -webkit-box-shadow:inset 0 0 5px #666;
    -moz-box-shadow:inset 0 0 5px #666;
    -o-box-shadow:inset 0 0 5px #666;
    -ms-box-shadow:inset 0 0 5px #666;
    box-shadow:inset 0 0 5px #666;
    font-weight:bold;
    font-family: Arial ;
}

#flipbook .odd{
    background:-webkit-gradient(linear, right top, left top, color-stop(0.95, #FFF), color-stop(1, #DADADA));
    background-image:-webkit-linear-gradient(right, #FFF 95%, #C4C4C4 100%);
    background-image:-moz-linear-gradient(right, #FFF 95%, #C4C4C4 100%);
    background-image:-ms-linear-gradient(right, #FFF 95%, #C4C4C4 100%);
    background-image:-o-linear-gradient(right, #FFF 95%, #C4C4C4 100%);
    background-image:linear-gradient(right, #FFF 95%, #C4C4C4 100%);
    -webkit-box-shadow:inset 0 0 5px #666;
    -moz-box-shadow:inset 0 0 5px #666;
    -o-box-shadow:inset 0 0 5px #666;
    -ms-box-shadow:inset 0 0 5px #666;
    box-shadow:inset 0 0 5px #666;
    
}

#flipbook .even{
    background:-webkit-gradient(linear, left top, right top, color-stop(0.95, #fff), color-stop(1, #dadada));
    background-image:-webkit-linear-gradient(left, #fff 95%, #dadada 100%);
    background-image:-moz-linear-gradient(left, #fff 95%, #dadada 100%);
    background-image:-ms-linear-gradient(left, #fff 95%, #dadada 100%);
    background-image:-o-linear-gradient(left, #fff 95%, #dadada 100%);
    background-image:linear-gradient(left, #fff 95%, #dadada 100%);
    -webkit-box-shadow:inset 0 0 5px #666;
    -moz-box-shadow:inset 0 0 5px #666;
    -o-box-shadow:inset 0 0 5px #666;
    -ms-box-shadow:inset 0 0 5px #666;
    box-shadow:inset 0 0 5px #666;
}

div.flip-control {
    width: 500px;
    text-align: left;
}

div.flip-control a {
    margin-left: 10px;
}
div.flip-control button {
    margin-top: 5px;
}

#flipbook .test{
  box-sizing: border-box;
  -moz-box-sizing: border-box;
  -webkit-box-sizing: border-box;
   border: 1px solid #969696;
   font-family: Arial;

}

</style>
	
	
</head>
<body>

	<div id="flipbook">
    <div class="hard">
       
            <img src="<?php echo base_url();?>images/logo.png" width="50%" style= "margin-top: 20px; margin-left: 100px;" />
            
         <table style="margin-top:70px;font-size: 50px;"  align="center">
            <tr><td align="center" style="font-size:70px;">JOB</td></tr>
             <tr><td style="font-size:70px;">ORDER</td></tr>
            <tr><td align="center" style="font-size:70px;">BOOK</td></tr>
        </table>
        <div style="text-align:center;margin-top:110px; font-size: 10px;font-family: arial">&copy; Copyright Careerpaths NW</div>
    </div> 
    <div class="hard"></div>
    	<?php 
       // if(is_array($_SESSION['job_data'])){ 
            foreach($_SESSION['job_data'] as $v)
			{?>
		
			<div class="test">
				<table style="margin-left: 5px;">
                    
					<tr><td><b>Job Form Id :</b> JON - <?= $v["formID"];?></td></tr>
					<tr><td><b>Position :</b> <?= $v["position"];?></td></tr>
					<tr><td><b>Job Type :</b> <?= $v["job_type"];?></td></tr>
					<tr><td><b>Industry :</b> <?= $v["industry_name"];?></td></tr>
					<tr><td><b>Added Date :</b> <?= $v["date"];?></td></tr>
					<tr><td><b>(Cons) :</b> <?= $v["cons"];?></td></tr>
					<tr><td><b>Contact Name :</b> <?= $v["contact_name"];?></td></tr>
					<tr><td><b>Contact Email : </b><?= $v["email_id"];?></td></tr>
					<tr><td><b>Title :</b> <?= $v["title"];?></td></tr>
					<tr><td><b>Company Name :</b> <?= $v["company_name"];?></td></tr>
					<tr><td><b>Location Name :</b> <?= $v["location_name"];?></td></tr>
					<tr><td><b>Department Name :</b> <?= $v["department_name"];?></td></tr>
					<tr><td><b>Cell Number / Directline :</b> <?= $v["cell_number"];?></td></tr>
					<tr><td><b>Target Clients or Vertical :</b> <?= $v["target_clients"];?></td></tr>
					<tr><td><b>Reason Position is Open :</b> <?= $v["reason_position"];?></td></tr>
					
					<tr><td><b>Years In Business :</b> <?= $v["years_in_business"];?></td></tr>
					<tr><td><b>Training Program :</b> <?= $v["training_program"];?></td></tr>

					<tr><td><b>Salary Range : </b><?= $v["salary_range"];?></td></tr>
					<tr><td><b>Total Company :</b> <?= $v["total_comp"];?></td></tr>
					<tr><td><b>Fee :</b><?= $v["fee"];?></td></tr>
					<tr><td><b>Interview Process :</b><?= $v["interview_process"];?></td></tr>
					<tr><td><b>Benifits  :</b> <?= $v["benefits"];?></td></tr>
					<tr><td><b>Car Allowance  :</b> <?= $v["car_allowance"];?></td></tr>
					<tr><td><b>Desired Candidate Profile  :</b> <?= $v["desired_candidate_profile"];?></td></tr>
					<tr><td><b>Keywords  :</b> <?= $v["keywords"];?></td></tr>

				</table>

			</div>

			<?php }?>

    <div class="hard"></div>
    <div class="hard"><div style="text-align:center;margin-top: 540px; font-size: 10px;font-family: arial">&copy; Copyright Careerpaths NW</div></div>
</div>


<div class="flip-control" style="margin-left: 250px;">
    <a href="#" id="prev"> Previous </a>
    <a href="#" id="next"> Next </a>
    <a href="<?php echo base_url();?>job/download_book" id="download"> Download Book </a>
    <a href="#" id="share" onclick="linkopen();"> Share Book </a>
    <a href="<?php echo base_url();?>job/job_order_book" id="back"> Back </a>
 </div>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>js/turn.js"></script>
	
<script type="text/javascript">
	var oTurn = $("#flipbook").turn({
    width: 900,
    height: 560,
    autoCenter: true,
    next:true
});

$("#prev").click(function(e){
    e.preventDefault();
    oTurn.turn("previous");
});

$("#next").click(function(e){
    e.preventDefault();
    oTurn.turn("next");
});

</script>
<script type="text/javascript">
   function linkopen() {
  //  event.preventDefault();
    window.open("<?php echo base_url();?>job/share_book", "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=500,left=500,width=400,height=400,margin-right=20");
    return false;
}

</script>
</body>
</html>