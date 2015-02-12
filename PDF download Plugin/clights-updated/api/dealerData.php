<?php
require '../vendor/slim/slim/Slim/Slim.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$db = new PDO('sqlite:db.sqlite3');

$projectid = 11;

$sth = $db->prepare('SELECT * FROM layers where project = ?');
$sth->execute(array(
	0 => intval($projectid)
));
$res = $sth->fetchAll(PDO::FETCH_CLASS);


$inputs = array();
foreach($res as $key => $values){
	$projectid	= $values->project;
	$color		= $values->color;
	$price		= $values->price;
	$scale		= $values->scale;
	$active		= $values->active;
	$mapcode	= $values->mapcode;
	$qty		= $values->qty;
	$level		= $values->level;
	$rate		= $values->rate;
	$earlyprice = $values->earlyprice;
	$description = $values->description;
	$name		= $values->name;
	$decor_type	= $values->decor_type;

	$inputs[$decor_type][$name][$description]['mapcode']	= $mapcode;
	$inputs[$decor_type][$name][$description]['color']		= $color;
	$inputs[$decor_type][$name][$description]['qty']		= $qty;
	$inputs[$decor_type][$name][$description]['level']		= $level;
	$inputs[$decor_type][$name][$description]['rate']		= $rate;
	$inputs[$decor_type][$name][$description]['sc']			= $scale;
	$inputs[$decor_type][$name][$description]['pricing']	= $price;
	$inputs[$decor_type][$name][$description]['earlypricing'] = $earlyprice;
}

$sth = $db->prepare('SELECT * FROM service_proposal WHERE projectid = ? LIMIT 1;');
$sth->execute(array(
	0 => intval($projectid)
));
$proposal = $sth->fetch();


$sthProjects = $db->prepare('SELECT * FROM projects where id = ?');
$sthProjects->execute(array(
	0 => intval($projectid)
));
$projectDetail = $sthProjects->fetch();


$customerid = $projectDetail['customer'];
$sthCustomers = $db->prepare('SELECT * FROM customers where id = ?');
$sthCustomers->execute(array(
	0 => intval($customerid)
));
$customerDetail = $sthCustomers->fetch();

$dealerid = $customerDetail['dealer'];
$sthDealers = $db->prepare('SELECT * FROM dealers where id = ?');
$sthDealers->execute(array(
	0 => intval($dealerid)
));
$dealerDetail = $sthDealers->fetch();
?>
<style type="text/Css">
<!--
.tablevalues
{
    border: solid 1px #000000;
    border-collapse: collapse;
	width: 100%;
}
-->
</style>
<page style="font-size: 12px">
	 <table>
		<tr>
			<td style="width: 50%">
				<table align="center" style="width: 100%">
					
					<tr>
						<td style="width: 100%">
							<img src="../img/house.jpg"  width="400"/><p>&nbsp;</p>
							<table style="border: solid 1px #000000; background: #FFFFFF; width: 100%; text-align: center;border-collapse: collapse">
								<tr>
									<th   colspan="3" style="width: 60%;border: solid 1px #000000;">
									   YOUR CUSTOM DECORATING PACKAGE
									</th>
									<th  colspan="3" style="width: 35%;background: red;color: #ffffff;border: solid 1px #000000">
									   Your Decor Options
									</th>
								</tr>
							

								<tr>
									<td style="width: 15%;border: solid 1px #000000">
									   <b>Decor Type</b>
									</td>
									<td style="width: 30%;border: solid 1px #000000">
									  <b>Location/Description</b>
									</td>
									<td style="width: 10%;border: solid 1px #000000">
									   Color
									</td>
									<td style="width: 12%;border: solid 1px #000000">
									   Pricing
									</td>
									<td style="width: 12%;background: #FF6600;color:#000000;border: solid 1px #000000">
									   <b>Early Pricing</b>
									</td>
									<td style="width: 4%;border: solid 1px #000000">
									   OK
									</td>
								</tr>

								<tr>
									<td   colspan="3" style="text-align:left;width: 60%;border-right: solid 1px #000000;background: #CCCCCC;">
									   <b>Roof Lighting</b>
									</td>
									<td   style="width: 12%;background: #CCCCCC;">
									   &nbsp;
									</td>
									<td   style="width: 12%;background: #FF6600;color:#000000;">
									   &nbsp;
									</td>
									<td   style="width: 12%;background: #CCCCCC;">
									   &nbsp;
									</td>
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;">
									   Facia
									</td>
									<td style="width: 30%;text-align:left;">
									   Front
									</td>
									<td style="width: 10%;text-align:left;">
									   <?php if(isset($inputs[1]['Facia']['Front']['color'])){ echo $inputs[1]['Facia']['Front']['color']; } ?>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;">
									   <i><b><?php if(isset($inputs[1]['Facia']['Front']['pricing'])){ echo $inputs[1]['Facia']['Front']['pricing']; } ?></b></i>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;background: #FF6600;color:#000000;">
									   <b><?php if(isset($inputs[1]['Facia']['Front']['earlypricing'])){ echo $inputs[1]['Facia']['Front']['earlypricing']; } ?></b>&nbsp;
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;">
									   Ridges
									</td>
									<td style="width: 30%;text-align:left;">
									   Front
									</td>
									<td style="width: 10%;text-align:left;">
									   <?php if(isset($inputs[1]['Ridges']['Front']['color'])){ echo $inputs[1]['Ridges']['Front']['color']; } ?>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;">
									   <i><b><?php if(isset($inputs[1]['Ridges']['Front']['pricing'])){ echo $inputs[1]['Ridges']['Front']['pricing']; } ?></b></i>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;background: #FF6600;color:#000000;">
									   <b><?php if(isset($inputs[1]['Ridges']['Front']['earlypricing'])){ echo $inputs[1]['Ridges']['Front']['earlypricing']; } ?></b>&nbsp;
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;">
									   &nbsp;
									</td>
									<td style="width: 30%;text-align:left;">
									   West Side
									</td>
									<td style="width: 10%;text-align:left;">
									   <?php if(isset($inputs[1]['Ridges']['West Side']['color'])){ echo $inputs[1]['Ridges']['West Side']['color']; } ?>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;">
									   <i><b><?php if(isset($inputs[1]['Ridges']['West Side']['pricing'])){ echo $inputs[1]['Ridges']['West Side']['pricing']; } ?></b></i>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;background: #FF6600;color:#000000;">
									   <b><?php if(isset($inputs[1]['Ridges']['West Side']['earlypricing'])){ echo $inputs[1]['Ridges']['West Side']['earlypricing']; } ?></b>&nbsp;
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
								</tr>

								<tr>
									<td   colspan="3" style="text-align:left;width: 60%;border-right: solid 1px #000000;background: #CCCCCC;">
									   <b>Windows/Features</b>
									</td>
									<td   style="width: 12%;background: #CCCCCC;">
									   &nbsp;
									</td>
									<td   style="width: 12%;background: #FF6600;color:#000000;">
									   &nbsp;
									</td>
									<td   style="width: 12%;background: #CCCCCC;">
									   &nbsp;
									</td>
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;">
									   &nbsp;
									</td>
									<td style="width: 30%;text-align:left;">
									   2 Arched
									</td>
									<td style="width: 10%;text-align:left;">
									   <?php if(isset($inputs[2][1]['2 Arched']['color'])){ echo $inputs[2][1]['2 Arched']['color']; } ?>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;">
									   <i><b><?php if(isset($inputs[2][1]['2 Arched']['pricing'])){ echo $inputs[2][1]['2 Arched']['pricing']; } ?></b></i>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;background: #FF6600;color:#000000;">
									   <b><?php if(isset($inputs[2][1]['2 Arched']['earlypricing'])){ echo $inputs[2][1]['2 Arched']['earlypricing']; } ?></b>&nbsp;
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;">
									   &nbsp;
									</td>
									<td style="width: 30%;text-align:left;">
									   2 Square
									</td>
									<td style="width: 10%;text-align:left;">
									 <?php if(isset($inputs[2][2]['2 Square']['mapcode'])){ echo $inputs[2][2]['2 Square']['color']; } ?>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;">
									   <i><b><?php if(isset($inputs[2][2]['2 Square']['pricing'])){ echo $inputs[2][2]['2 Square']['pricing']; } ?></b></i>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;background: #FF6600;color:#000000;">
									   <b><?php if(isset($inputs[2][2]['2 Square']['earlypricing'])){ echo $inputs[2][2]['2 Square']['earlypricing']; } ?></b>&nbsp;
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
								</tr>

								<tr>
									<td   colspan="3" style="text-align:left;width: 60%;border-right: solid 1px #000000;background: #CCCCCC;">
									   <b>Tree Lightning</b>
									</td>
									<td   style="width: 12%;background: #CCCCCC;">
									   &nbsp;
									</td>
									<td   style="width: 12%;background: #FF6600;color:#000000;">
									   &nbsp;
									</td>
									<td   style="width: 12%;background: #CCCCCC;">
									   &nbsp;
									</td>
								</tr>
								
								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;">
									   Canopy
									</td>
									<td style="width: 30%;text-align:left;">
									   Red Oak
									</td>
									<td style="width: 10%;text-align:left;">
									   <?php if(isset($inputs[3]['Canopy']['Red Oak']['color'])){ echo $inputs[3]['Canopy']['Red Oak']['color']; } ?>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;">
									   <i><b><?php if(isset($inputs[3]['Canopy']['Red Oak']['pricing'])){ echo $inputs[3]['Canopy']['Red Oak']['pricing']; } ?></b></i>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;background: #FF6600;color:#000000;">
									   <b><?php if(isset($inputs[3]['Canopy']['Red Oak']['earlypricing'])){ echo $inputs[3]['Canopy']['Red Oak']['earlypricing']; } ?></b>&nbsp;
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;">
									   Trunk
									</td>
									<td style="width: 30%;text-align:left;">
									   Live Oak
									</td>
									<td style="width: 10%;text-align:left;">
									   <?php if(isset($inputs[3]['Trunk']['Live Oak']['color'])){ echo $inputs[3]['Trunk']['Live Oak']['color']; } ?>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;">
									   <i><b><?php if(isset($inputs[3]['Trunk']['Live Oak']['pricing'])){ echo $inputs[3]['Trunk']['Live Oak']['pricing']; } ?></b></i>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;background: #FF6600;color:#000000;">
									   <b><?php if(isset($inputs[3]['Trunk']['Live Oak']['earlypricing'])){ echo $inputs[3]['Trunk']['Live Oak']['earlypricing']; } ?></b>&nbsp;
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
								</tr>

								<tr >
									<td   colspan="3" style="text-align:left;width: 60%;border-right: solid 1px #000000;background: #CCCCCC;">
									   <b>Shrubs</b>
									</td>
									<td   style="width: 12%;background: #CCCCCC;">
									   &nbsp;
									</td>
									<td   style="width: 12%;background: #FF6600;color:#000000;">
									   &nbsp;
									</td>
									<td   style="width: 12%;background: #CCCCCC;">
									   &nbsp;
									</td>
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;">
									   &nbsp;
									</td>
									<td style="width: 30%;text-align:left;">
									   3 Hollies
									</td>
									<td style="width: 10%;text-align:left;">
									   <?php if(isset($inputs[4][1]['3 Hollies']['color'])){ echo $inputs[4][1]['3 Hollies']['color']; } ?>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;">
									   <i><b><?php if(isset($inputs[4][1]['3 Hollies']['sc'])){ echo $inputs[4][1]['3 Hollies']['sc']; } ?></b></i>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;background: #FF6600;color:#000000;">
									   <b><?php if(isset($inputs[4][1]['3 Hollies']['pricing'])){ echo $inputs[4][1]['3 Hollies']['pricing']; } ?></b>&nbsp;
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
								</tr>

								
								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;">
									   &nbsp;
									</td>
									<td style="width: 30%;text-align:left;">
									   2 Boxwoods
									</td>
									<td style="width: 10%;text-align:left;">
									  <?php if(isset($inputs[4][2]['2 Boxwoods']['color'])){ echo $inputs[4][2]['2 Boxwoods']['color']; } ?>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;">
									   <i><b><?php if(isset($inputs[4][2]['2 Boxwoods']['pricing'])){ echo $inputs[4][2]['2 Boxwoods']['pricing']; } ?></b></i>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;background: #FF6600;color:#000000;">
									   <b><?php if(isset($inputs[4][2]['2 Boxwoods']['earlypricing'])){ echo $inputs[4][2]['2 Boxwoods']['earlypricing']; } ?></b>&nbsp;
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
								</tr>

								<tr >
									<td   colspan="3" style="text-align:left;width: 60%;border-right: solid 1px #000000;background: #CCCCCC;">
									   <b>Ground Lightning</b>
									</td>
									<td   style="width: 12%;background: #CCCCCC;">
									   &nbsp;
									</td>
									<td   style="width: 12%;background: #FF6600;color:#000000;">
									   &nbsp;
									</td>
									<td   style="width: 12%;background: #CCCCCC;">
									   &nbsp;
									</td>
								</tr>
								
								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;">
									   Stakes
									</td>
									<td style="width: 30%;text-align:left;">
									   Curved Walk
									</td>
									<td style="width: 10%;text-align:left;">
									   <?php if(isset($inputs[5]['Stakes']['Curved Walk']['color'])){ echo $inputs[5]['Stakes']['Curved Walk']['color']; } ?>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;">
									   <i><b><?php if(isset($inputs[5]['Stakes']['Curved Walk']['pricing'])){ echo $inputs[5]['Stakes']['Curved Walk']['pricing']; } ?></b></i>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;background: #FF6600;color:#000000;">
									   <b><?php if(isset($inputs[5]['Stakes']['Curved Walk']['earlypricing'])){ echo $inputs[5]['Stakes']['Curved Walk']['earlypricing']; } ?></b>&nbsp;
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;">
									   &nbsp;
									</td>
									<td style="width: 30%;text-align:left;">
									   Bed
									</td>
									<td style="width: 10%;text-align:left;">
									   <?php if(isset($inputs[5]['Stakes']['Bed']['color'])){ echo $inputs[5]['Stakes']['Bed']['color']; } ?>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;">
									   <i><b><?php if(isset($inputs[5]['Stakes']['Bed']['pricing'])){ echo $inputs[5]['Stakes']['Bed']['pricing']; } ?></b></i>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;background: #FF6600;color:#000000;">
									   <b><?php if(isset($inputs[5]['Stakes']['Bed']['earlypricing'])){ echo $inputs[5]['Stakes']['Bed']['earlypricing']; } ?></b>&nbsp;
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;">
									   &nbsp;
									</td>
									<td style="width: 30%;text-align:left;">
									   Parkway
									</td>
									<td style="width: 10%;text-align:left;">
									   <?php if(isset($inputs[5]['Stakes']['Parkway']['color'])){ echo $inputs[5]['Stakes']['Parkway']['color']; } ?>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;">
									   <i><b><?php if(isset($inputs[5]['Stakes']['Parkway']['pricing'])){ echo $inputs[5]['Stakes']['Parkway']['pricing']; } ?></b></i>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;background: #FF6600;color:#000000;">
									   <b><?php if(isset($inputs[5]['Stakes']['Parkway']['earlypricing'])){ echo $inputs[5]['Stakes']['Parkway']['earlypricing']; } ?></b>&nbsp;
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
								</tr>

								<tr>
									<td   colspan="3" style="text-align:left;width: 60%;border-right: solid 1px #000000;background: #CCCCCC;">
									   <b>Daytime Decor</b>
									</td>
									<td   style="width: 12%;background: #CCCCCC;">
									   &nbsp;
									</td>
									<td   style="width: 12%;background: #FF6600;color:#000000;">
									   &nbsp;
									</td>
									<td   style="width: 12%;background: #CCCCCC;">
									   &nbsp;
									</td>
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;">
									   Garland
									</td>
									<td style="width: 30%;text-align:left;">
									   Door
									</td>
									<td style="width: 10%;text-align:left;">
									   <?php if(isset($inputs[6]['Garland']['Door']['color'])){ echo $inputs[6]['Garland']['Door']['color']; } ?>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;">
									   <i><b><?php if(isset($inputs[6]['Garland']['Door']['pricing'])){ echo $inputs[6]['Garland']['Door']['pricing']; } ?></b></i>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;background: #FF6600;color:#000000;">
									   <b><?php if(isset($inputs[6]['Garland']['Door']['earlypricing'])){ echo $inputs[6]['Garland']['Door']['earlypricing']; } ?></b>&nbsp;
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;">
									   &nbsp;
									</td>
									<td style="width: 30%;text-align:left;">
									   Entry Arch 200 lights
									</td>
									<td style="width: 10%;text-align:left;">
									   <?php if(isset($inputs[6]['Garland']['Entry Arch 200 lights']['color'])){ echo $inputs[6]['Garland']['Entry Arch 200 lights']['color']; } ?>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;">
									   <i><b><?php if(isset($inputs[6]['Garland']['Entry Arch 200 lights']['pricing'])){ echo $inputs[6]['Garland']['Entry Arch 200 lights']['pricing']; } ?></b></i>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;background: #FF6600;color:#000000;">
									   <b><?php if(isset($inputs[6]['Garland']['Entry Arch 200 lights']['earlypricing'])){ echo $inputs[6]['Garland']['Entry Arch 200 lights']['earlypricing']; } ?></b>&nbsp;
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;">
									   Wreaths
									</td>
									<td style="width: 30%;text-align:left;">
									   30" Prelit over Door
									</td>
									<td style="width: 10%;text-align:left;">
									   <?php if(isset($inputs[6]['Wreaths']['30" Prelit over Door']['color'])){ echo $inputs[6]['Wreaths']['30" Prelit over Door']['color']; } ?>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;">
									   <i><b><?php if(isset($inputs[6]['Wreaths']['30" Prelit over Door']['pricing'])){ echo $inputs[6]['Wreaths']['30" Prelit over Door']['pricing']; } ?></b></i>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;background: #FF6600;color:#000000;">
									   <b><?php if(isset($inputs[6]['Wreaths']['30" Prelit over Door']['earlypricing'])){ echo $inputs[6]['Wreaths']['30" Prelit over Door']['earlypricing']; } ?></b>&nbsp;
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;">
									   &nbsp;
									</td>
									<td style="width: 30%;text-align:left;">
									   (w/50 lights)
									</td>
									<td style="width: 10%;text-align:left;">
									   <?php if(isset($inputs[6]['Wreaths']['(w/50 lights)']['color'])){ echo $inputs[6]['Wreaths']['(w/50 lights)']['color']; } ?>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;">
									   <i><b><?php if(isset($inputs[6]['Wreaths']['(w/50 lights)']['pricing'])){ echo $inputs[6]['Wreaths']['(w/50 lights)']['pricing']; } ?></b></i>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;background: #FF6600;color:#000000;">
									   <b><?php if(isset($inputs[6]['Wreaths']['(w/50 lights)']['earlypricing'])){ echo $inputs[6]['Wreaths']['(w/50 lights)']['earlypricing']; } ?></b>&nbsp;
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;">
									   Bows
									</td>
									<td style="width: 30%;text-align:left;">
									   Small on Entry Garland
									</td>
									<td style="width: 10%;text-align:left;">
									  <?php if(isset($inputs[6]['Bows']['Small on Entry Garland']['color'])){ echo $inputs[6]['Bows']['Small on Entry Garland']['color']; } ?>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;">
									   <i><b><?php if(isset($inputs[6]['Bows']['Small on Entry Garland']['pricing'])){ echo $inputs[6]['Bows']['Small on Entry Garland']['pricing']; } ?></b></i>&nbsp;
									</td>
									<td style="width: 12%;text-align:right;background: #FF6600;color:#000000;">
									   <b><?php if(isset($inputs[6]['Bows']['Small on Entry Garland']['earlypricing'])){ echo $inputs[6]['Bows']['Small on Entry Garland']['earlypricing']; } ?></b>&nbsp;
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;border-bottom: solid 1px #000000;">
									   &nbsp;
									</td>
									<td style="width: 30%;text-align:left;border-bottom: solid 1px #000000;">
									   &nbsp;
									</td>
									<td style="width: 10%;text-align:left;border-right: solid 1px #000000">
									   &nbsp;
									</td>
									<td style="width: 12%;text-align:right;color:#000000;border: solid 1px #000000">
									   <b>Subtotal</b>
									</td>
									<td style="width: 12%;text-align:right;background: #FF6600;color:#000000;border: solid 1px #000000">
									   <b>945.00</b>
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
									
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;border-left: solid 1px #000000;border-top: solid 1px #000000;">
									   <?=$customerDetail['name']?>
									</td>
									<td style="width: 30%;text-align:left;border-right: solid 1px #000000;border-top: solid 1px #000000;">
									   &nbsp;
									</td>
									<td style="width: 10%;text-align:left;border-right: solid 1px #000000">
									   &nbsp;
									</td>
									<td style="width: 12%;text-align:right;color:#000000;border: solid 1px #000000">
									  <b>Incentives</b>
									</td>
									<td style="width: 12%;text-align:right;color:#000000;border: solid 1px #000000">
									   <b>122.85</b>
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
									
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;border-left: solid 1px #000000;">
									   <?=$customerDetail['address_1']."<br/>".$customerDetail['address_2']?>
									</td>
									<td style="width: 30%;text-align:left;border-right: solid 1px #000000;">
									   &nbsp;
									</td>
									<td style="width: 10%;text-align:left;border-right: solid 1px #000000">
									   &nbsp;
									</td>
									<td style="width: 12%;text-align:right;color:#000000;border: solid 1px #000000">
									  <b>Subtotal</b>
									</td>
									<td style="width: 12%;text-align:right;color:#000000;border: solid 1px #000000">
									   <b>822.15</b>
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
									
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;border-left: solid 1px #000000;">
									   <?=$customerDetail['city']?>, <?=$customerDetail['state']?> <?=$customerDetail['zip']?>
									</td>
									<td style="width: 30%;text-align:left;border-right: solid 1px #000000;">
									   &nbsp;
									</td>
									<td style="width: 10%;text-align:left;border-right: solid 1px #000000">
									   &nbsp;
									</td>
									<td style="width: 12%;text-align:right;color:#000000;border: solid 1px #000000">
									  <b>Sale Tax</b>
									</td>
									<td style="width: 12%;text-align:right;color:#000000;border: solid 1px #000000">
									   <b>822.15</b>
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
									
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;border-left: solid 1px #000000;">
									   <?=$customerDetail['phone']?>
									</td>
									<td style="width: 30%;text-align:left;border-right: solid 1px #000000;">
									   &nbsp;
									</td>
									<td style="width: 10%;text-align:left;border-right: solid 1px #000000">
									   &nbsp;
									</td>
									<td style="width: 12%;text-align:right;color:#000000;border: solid 1px #000000">
									  <b>Total Due</b>
									</td>
									<td style="width: 12%;text-align:right;color:#000000;border: solid 1px #000000">
									   <b>822.15</b>
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
									
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;border-left: solid 1px #000000;">
									   &nbsp;
									</td>
									<td style="width: 30%;text-align:left;border-right: solid 1px #000000;">
									   &nbsp;
									</td>
									<td style="width: 10%;text-align:left;border-right: solid 1px #000000">
									   &nbsp;
									</td>
									<td style="width: 12%;text-align:right;color:#000000;border: solid 1px #000000">
									  <b>Deposit</b>
									</td>
									<td style="width: 12%;text-align:right;color:#000000;border: solid 1px #000000">
									   <b>0.00</b>
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
									
								</tr>

								<tr style="color:#0000FF">
									<td style="width: 10%;text-align:left;border-left: solid 1px #000000;border-bottom: solid 1px #000000;">
									   &nbsp;
									</td>
									<td style="width: 30%;text-align:left;border-right: solid 1px #000000;border-bottom: solid 1px #000000;">
									   &nbsp;
									</td>
									<td style="width: 10%;text-align:left;border-right: solid 1px #000000">
									   &nbsp;
									</td>
									<td style="width: 12%;text-align:right;color:#000000;border: solid 1px #000000">
									  <b>Balance</b>
									</td>
									<td style="width: 12%;text-align:right;color:#000000;border: solid 1px #000000">
									   <b>0.00</b>
									</td>
									<td style="width: 4%;">
									   &nbsp;
									</td>
									
								</tr>
							</table>
						</td>
					</tr>
					
				</table>
			</td>


			<td  style="background: #FFFFFF; width: 50%; text-align: left;" valign="top">
				<table style="width:100%">
					<tr>
						<td style=""><img src="../img/logo_ttl.png"  /></td>
					</tr>
					<tr>
						<td style="color:#D50000"><b>Holiday & Event Decoraters</b></td>
					</tr>
					<tr>
						<td style="width:10%;border: solid 0.5px #cccccc;text-align:left">
						<div style="text-align:left;"><b>About Your Decorating</b><br/><b>Proposal</b><br/>
						<?php if(isset($proposal['notes'])){ echo stripslashes($proposal['notes']); } ?>
						</div>
						</td>
					</tr>

					<tr>
						<td style="width:10%;">
						<div style="text-align:center;padding:5px;">
						Local Christmas Decor Provider<br/>
						<b><?=$dealerDetail['name']?></b><br/>
						<?=$dealerDetail['address_1']?>, <?=$dealerDetail['state']?>  <?=$dealerDetail['zip']?><br/>
						Phone <?=$dealerDetail['phone']?><br/>
					
						</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	 </table>
</page>