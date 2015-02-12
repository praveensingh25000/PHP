<?php

require '../vendor/slim/slim/Slim/Slim.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$db = new PDO('sqlite:db.sqlite3');

$projectid = 11;


$defaultvalues = Array(
				0 => array('project' => $projectid, 'name' => 'Facia', 'description' => 'Front', 'items' => "", 'color' => "TR", 'price' => "800.00", 'scale' => "", 'active' => 1, 'mapcode' => "1", 'qty' => "200", 'level' => "", 'rate' => "4.00", 'earlyprice' => "720.00", 'decor_type' => 1),

				1 => array('project' => $projectid, 'name' => 'Ridges', 'description' => 'Front', 'items' => "", 'color' => "TR", 'price' => "", 'scale' => "", 'active' => 1, 'mapcode' => "2", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 1),

				2 => array('project' => $projectid, 'name' => 'Ridges', 'description' => 'West Side', 'items' => "", 'color' => "", 'price' => "", 'scale' => "", 'active' => 1, 'mapcode' => "", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 1),

				3 => array('project' => $projectid, 'name' => '1', 'description' => '2 Arched', 'items' => "", 'color' => "C", 'price' => "", 'scale' => "", 'active' => 1, 'mapcode' => "3", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 2),

				4 => array('project' => $projectid, 'name' => '2', 'description' => '2 Square', 'items' => "", 'color' => "C", 'price' => "", 'scale' => "", 'active' => 1, 'mapcode' => "4", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 2),

				5 => array('project' => $projectid, 'name' => 'Canopy', 'description' => 'Red Oak', 'items' => "", 'color' => "C", 'price' => "", 'scale' => "", 'active' => 1, 'mapcode' => "5", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 3),

				6 => array('project' => $projectid, 'name' => 'Trunk', 'description' => 'Live Oak', 'items' => "", 'color' => "C", 'price' => "", 'scale' => "", 'active' => 1, 'mapcode' => "6", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 3),

				7 => array('project' => $projectid, 'name' => '1', 'description' => '3 Hollies', 'items' => "", 'color' => "C", 'price' => "", 'scale' => "", 'active' => 1, 'mapcode' => "7", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 4),

				8 => array('project' => $projectid, 'name' => '2', 'description' => '2 Boxwoods', 'items' => "", 'color' => "C", 'price' => "", 'scale' => "", 'active' => 1, 'mapcode' => "8", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 4),

				9 => array('project' => $projectid, 'name' => 'Stakes', 'description' => 'Curved Walk', 'items' => "", 'color' => "TR", 'price' => "", 'scale' => "", 'active' => 1, 'mapcode' => "9", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 5),

				10 => array('project' => $projectid, 'name' => 'Stakes', 'description' => 'Bed', 'items' => "", 'color' => "TR", 'price' => "250.00", 'scale' => "", 'active' => 1, 'mapcode' => "10", 'qty' => "25", 'level' => "", 'rate' => "10.00", 'earlyprice' => "225.00", 'decor_type' => 5),

				11 => array('project' => $projectid, 'name' => 'Stakes', 'description' => 'Parkway', 'items' => "", 'color' => "", 'price' => "", 'scale' => "", 'active' => 1, 'mapcode' => "", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 5),

				12 => array('project' => $projectid, 'name' => 'Garland', 'description' => 'Door', 'items' => "", 'color' => "", 'price' => "", 'scale' => "", 'active' => 1, 'mapcode' => "1", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 6),

				13 => array('project' => $projectid, 'name' => 'Garland', 'description' => 'Entry Arch 200 lights', 'items' => "", 'color' => "C", 'price' => "", 'scale' => "", 'active' => 1, 'mapcode' => "11", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 6),

				14 => array('project' => $projectid, 'name' => 'Wreaths', 'description' => '30" Prelit over Door', 'items' => "", 'color' => "C", 'price' => "", 'scale' => "", 'active' => 1, 'mapcode' => "12", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 6),

				15 => array('project' => $projectid, 'name' => 'Wreaths', 'description' => '(w/50 lights)', 'items' => "", 'color' => "", 'price' => "", 'scale' => "", 'active' => 1, 'mapcode' => "", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 6),

				16 => array('project' => $projectid, 'name' => 'Bows', 'description' => 'Small on Entry Garland', 'items' => "", 'color' => "R", 'price' => "", 'scale' => "", 'active' => 1, 'mapcode' => "13", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 6)
			);

if(isset($_POST['save'])){

	$db->query("delete from layers where project = '".intval($projectid)."'");

	$db->query("delete from service_proposal where projectid = '".intval($projectid)."'");

	$contact		= (!empty($_POST['contact']))?$_POST['contact']:'';
	$appttime		= (!empty($_POST['appttime']))?$_POST['appttime']:'';
	$installation	= (!empty($_POST['installation']))?date('Y-m-d', strtotime($_POST['installation'])):'';
	$daytime		= (!empty($_POST['daytime']))?$_POST['daytime']:'';
	$datesold		= (!empty($_POST['datesold']))?date('Y-m-d', strtotime($_POST['datesold'])):'';
	$takedown		= (!empty($_POST['takedown']))?$_POST['takedown']:'';

	$db->query("INSERT INTO service_proposal (contact, apptime, installation, date_sold, daytime_decor, take_down, projectid) VALUES ('".$contact."','".$appttime."', '".$installation."', '".$datesold."', '".$daytime."', '".$takedown."', '".intval($projectid)."')");
	$idp = $db->lastInsertId();


	foreach($_POST['inputs'] as $decor_type => $inputs){
		foreach($inputs as $name => $names){
			foreach($names as $description => $values){

				$color = $values['color'];
				$price = $values['pricing'];
				$scale = $values['sc'];
				$active = 1;
				$mapcode = $values['mapcode'];
				$qty = $values['qty'];
				$level = $values['level'];
				$rate = $values['rate'];
				$earlyprice = $values['earlypricing'];
				
				$db->query("INSERT INTO layers (project, name, description, color, price, scale, active, mapcode, qty, level, rate, earlyprice, decor_type) VALUES ('".intval($projectid)."', '".$name."','".$description."', '".$color."', '".$price."', '".$scale."', '".$active."', '".$mapcode."','".$qty."', '".$level."', '".$rate."', '".$earlyprice."', '".$decor_type."')");
				$id = $db->lastInsertId();
			}
		}
	}

}


$sth = $db->prepare('SELECT * FROM layers where project = ?');
$sth->execute(array(
	0 => intval($projectid)
));
$res = $sth->fetchAll(PDO::FETCH_CLASS);

if(count($res)<=0){
	foreach($defaultvalues as $key => $values){
			
			$projectid	= $values['project'];
			$color		= $values['color'];
			$price		= $values['price'];
			$scale		= $values['scale'];
			$active		= $values['active'];
			$mapcode	= $values['mapcode'];
			$qty		= $values['qty'];
			$level		= $values['level'];
			$rate		= $values['rate'];
			$earlyprice = $values['earlyprice'];
			$description = $values['description'];
			$name		= $values['name'];
			$decor_type	= $values['decor_type'];
					
			$db->query("INSERT INTO layers (project, name, description, color, price, scale, active, mapcode, qty, level, rate, earlyprice, decor_type) VALUES ('".intval($projectid)."', '".$name."','".$description."', '".$color."', '".$price."', '".$scale."', '".$active."', '".$mapcode."','".$qty."', '".$level."', '".$rate."', '".$earlyprice."', '".$decor_type."')");
			$id = $db->lastInsertId();
	}

	$sth = $db->prepare('SELECT * FROM layers where project = ?');
	$sth->execute(array(
		0 => intval($projectid)
	));
	$res = $sth->fetchAll(PDO::FETCH_CLASS);
}


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

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<head>
    <title></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../favicon.ico" type="image/vnd.microsoft.icon">
    <link rel="stylesheet" href="../css/bootstrap.css">
    <link rel="stylesheet" href="../css/responsive.css">
    <link rel="stylesheet" href="../css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/clights-font/style.css">
    <link rel="stylesheet" href="../css/style.css">
</head>

 <BODY>
	
	<div data-clightspane="workspace" class="container-fluid clights_pane " id="clights-layers">
		<div class="row-fluid">
			
			<form method="post" action="">
			<div>
				<div style="float:left;width:40%">
					<div class="span8 clights_layers_table">
						
						<div class="row-fluid clights_tbody">
							<div class="span12">

								<div class="row-fluid clights_tr clights_selected" data-color="white_red">
									<div data-fieldname="itemName" class="clights_td">
										<div class="clights_display_field">Name</div>
									</div>
								</div>
								<div class="row-fluid clights_tr clights_selected" data-color="white_red">
									<div data-fieldname="itemName" class="clights_td">
										<div class="clights_display_field"><?=$customerDetail['name']?></div>
									</div>
								</div>

								<div class="row-fluid clights_tr clights_selected" data-color="white_red">
									<div data-fieldname="itemName" class="clights_td">
										<div class="clights_display_field">Billing Address</div>
									</div>
								</div>
								<div class="row-fluid clights_tr clights_selected" data-color="white_red">
									<div data-fieldname="itemName" class="clights_td">
										<div class="clights_display_field"><?=$customerDetail['address_1']."<br/>".$customerDetail['address_2']?></div>
									</div>
								</div>


								<div class="row-fluid clights_tr clights_selected" data-color="white_red">
									<div data-fieldname="itemName" class="clights_layer_name span3 clights_td">
										<div class="clights_display_field">City<br/><?=$customerDetail['city']?></div>
									</div>
									<div data-fieldname="itemName" class="clights_layer_name span3 clights_td">
										<div class="clights_display_field">ST<br/><?=$customerDetail['state']?></div>
									</div>
									<div data-fieldname="itemName" class="clights_layer_name span3 clights_td">
										<div class="clights_display_field">Zip<br/><?=$customerDetail['zip']?></div>
									</div>
								</div>

								<div class="row-fluid clights_tr clights_selected" data-color="white_red">
									<div data-fieldname="itemName" class="clights_layer_name span3 clights_td">
										<div class="clights_display_field"><?=$customerDetail['city']?></div>
									</div>
									<div data-fieldname="itemName" class="clights_layer_name span3 clights_td">
										<div class="clights_display_field"><?=$customerDetail['state']?></div>
									</div>
									<div data-fieldname="itemName" class="clights_layer_name span3 clights_td">
										<div class="clights_display_field"><?=$customerDetail['zip']?></div>
									</div>
								</div>

								<div class="row-fluid clights_tr clights_selected" data-color="white_red">
									<div data-fieldname="itemName" class="clights_td">
										<div class="clights_display_field">Phone<br/></div>
									</div>
								</div>
									<div class="row-fluid clights_tr clights_selected" data-color="white_red">
									<div data-fieldname="itemName" class="clights_td">
										<div class="clights_display_field"><?=$customerDetail['phone']?></div>
									</div>
								</div>

							</div>
						</div>
					</div>
				</div>
				<div style="float:left;margin-left:10px;width:55%">
					<div>
						<div style="float:left;width:45%">
							<img width="300" height="90" alt="Christmas Decor" src="../img/logo_ttl-300.png" class="pull-left"><br/>
							<p><strong>DECORATING SERVICE PROPOSAL</strong></p>
						</div>
						<div style="float:left;margin-left:10px;width:45%;text-align:center">
							<p>Your Local Service Provider:</p>
							<p><?=$dealerDetail['name']?></p>
							<p><?=$dealerDetail['address_1']?>, <?=$dealerDetail['state']?>  <?=$dealerDetail['zip']?></p>
							<p><?=$dealerDetail['phone']?></p>
							<p>info@christmasdecor.net</p>
						</div>
						<div style="clear:both"></div>
					</div>

					<div class="span8 clights_layers_table">
						<div class="row-fluid clights_tbody">
							<div class="span12">
								<div class="row-fluid clights_tr clights_selected" data-color="white_red">
									<div data-fieldname="itemName" class="clights_td">
										<div class="clights_display_field">Contact</div>
									</div>
								</div>
								<div class="row-fluid clights_tr clights_selected" data-color="white_red">
									<div data-fieldname="price" class="clights_layer_price span1 clights_td">
										<input type="text" size="10"  value="<?php if(isset($proposal['contact'])){ echo $proposal['contact']; } ?>" name="contact" />
									</div>
								</div>

								<div class="row-fluid clights_tr clights_selected" data-color="white_red">
									<div data-fieldname="itemName" class="clights_td">
										<div class="clights_display_field">Appt Time</div>
									</div>
								</div>
								<div class="row-fluid clights_tr clights_selected" data-color="white_red">
									<div data-fieldname="price" class="clights_layer_price span1 clights_td">
										<input type="text" size="10"  value="<?php if(isset($proposal['apptime'])){ echo $proposal['apptime']; } ?>" name="appttime" />
									</div>
								</div>

								<div class="row-fluid clights_tr clights_selected" data-color="white_red">
									<div data-fieldname="itemName" class="clights_td">
										<div class="clights_display_field">Installation</div>
									</div>
								</div>
								<div class="row-fluid clights_tr clights_selected" data-color="white_red">
									<div data-fieldname="price" class="clights_layer_price span1 clights_td">
									<input type="text" size="10"  name="installation" value="<?php if(isset($proposal['installation'])){ echo $proposal['installation']; } ?>"/>
									</div>
								</div>

								<div class="row-fluid clights_tr clights_selected" data-color="white_red">
									<div data-fieldname="itemName" class="clights_td">
										<div class="clights_display_field">Date Sold</div>
									</div>
								</div>
								<div class="row-fluid clights_tr clights_selected" data-color="white_red">
									<div data-fieldname="price" class="clights_layer_price span1 clights_td">
									<input type="text" size="10"  name="datesold" value="<?php if(isset($proposal['date_sold'])){ echo $proposal['date_sold']; } ?>"/>
									</div>
								</div>

								<div class="row-fluid clights_tr clights_selected" data-color="white_red">
									<div data-fieldname="itemName" class="clights_td">
										<div class="clights_display_field">Take Down</div>
									</div>
								</div>
								<div class="row-fluid clights_tr clights_selected" data-color="white_red">
									<div data-fieldname="price" class="clights_layer_price span1 clights_td">
									<input type="text" size="10"  name="takedown" value="<?php if(isset($proposal['take_down'])){ echo $proposal['take_down']; } ?>"/>
									</div>
								</div>

							</div>

						</div>
					</div>
				</div>
				<div style="clear:both"></div>
			</div>



				<table width="80%" border = '1' cellpadding="6">
					<tr>
						<th>Decor Type</th>
						<th>Location/Description:</th>
						<th>Map Code</th>
						<th>Color</th>
						<th>Qty</th>
						<th>Level</th>
						<th>Rate</th>
						<th>SC</th>
						<th>Pricing</th>
						<th>Early Pricing</th>
					</tr>

					<tr>
						<td colspan="10"><strong>Roof Lighting</strong></td>
					</tr>

					<tr>
						<td>Facia</td>
						<td>Front</td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Facia']['Front']['mapcode'])){ echo $inputs[1]['Facia']['Front']['mapcode']; } ?>" name="inputs[1][Facia][Front][mapcode]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Facia']['Front']['color'])){ echo $inputs[1]['Facia']['Front']['color']; } ?>" name="inputs[1][Facia][Front][color]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Facia']['Front']['qty'])){ echo $inputs[1]['Facia']['Front']['qty']; } ?>" name="inputs[1][Facia][Front][qty]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Facia']['Front']['level'])){ echo $inputs[1]['Facia']['Front']['level']; } ?>" name="inputs[1][Facia][Front][level]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Facia']['Front']['rate'])){ echo $inputs[1]['Facia']['Front']['rate']; } ?>" name="inputs[1][Facia][Front][rate]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Facia']['Front']['sc'])){ echo $inputs[1]['Facia']['Front']['sc']; } ?>" name="inputs[1][Facia][Front][sc]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Facia']['Front']['pricing'])){ echo $inputs[1]['Facia']['Front']['pricing']; } ?>" name="inputs[1][Facia][Front][pricing]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Facia']['Front']['earlypricing'])){ echo $inputs[1]['Facia']['Front']['earlypricing']; } ?>" name="inputs[1][Facia][Front][earlypricing]"></td>
					</tr>

					<tr>
						<td>Ridges</td>
						<td>Front</td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Ridges']['Front']['mapcode'])){ echo $inputs[1]['Ridges']['Front']['mapcode']; } ?>" name="inputs[1][Ridges][Front][mapcode]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Ridges']['Front']['color'])){ echo $inputs[1]['Ridges']['Front']['color']; } ?>" name="inputs[1][Ridges][Front][color]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Ridges']['Front']['qty'])){ echo $inputs[1]['Ridges']['Front']['qty']; } ?>" name="inputs[1][Ridges][Front][qty]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Ridges']['Front']['level'])){ echo $inputs[1]['Ridges']['Front']['level']; } ?>" name="inputs[1][Ridges][Front][level]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Ridges']['Front']['rate'])){ echo $inputs[1]['Ridges']['Front']['rate']; } ?>" name="inputs[1][Ridges][Front][rate]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Ridges']['Front']['sc'])){ echo $inputs[1]['Ridges']['Front']['sc']; } ?>" name="inputs[1][Ridges][Front][sc]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Ridges']['Front']['pricing'])){ echo $inputs[1]['Ridges']['Front']['pricing']; } ?>" name="inputs[1][Ridges][Front][pricing]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Ridges']['Front']['earlypricing'])){ echo $inputs[1]['Ridges']['Front']['earlypricing']; } ?>" name="inputs[1][Ridges][Front][earlypricing]"></td>
					</tr>

					<tr>
						<td>&nbsp;</td>
						<td>West Side</td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Ridges']['West Side']['mapcode'])){ echo $inputs[1]['Ridges']['West Side']['mapcode']; } ?>" name="inputs[1][Ridges][West Side][mapcode]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Ridges']['West Side']['color'])){ echo $inputs[1]['Ridges']['West Side']['color']; } ?>" name="inputs[1][Ridges][West Side][color]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Ridges']['West Side']['qty'])){ echo $inputs[1]['Ridges']['West Side']['qty']; } ?>" name="inputs[1][Ridges][West Side][qty]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Ridges']['West Side']['level'])){ echo $inputs[1]['Ridges']['West Side']['level']; } ?>" name="inputs[1][Ridges][West Side][level]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Ridges']['West Side']['rate'])){ echo $inputs[1]['Ridges']['West Side']['rate']; } ?>" name="inputs[1][Ridges][West Side][rate]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Ridges']['West Side']['sc'])){ echo $inputs[1]['Ridges']['West Side']['sc']; } ?>" name="inputs[1][Ridges][West Side][sc]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Ridges']['West Side']['pricing'])){ echo $inputs[1]['Ridges']['West Side']['pricing']; } ?>" name="inputs[1][Ridges][West Side][pricing]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[1]['Ridges']['West Side']['earlypricing'])){ echo $inputs[1]['Ridges']['West Side']['earlypricing']; } ?>" name="inputs[1][Ridges][West Side][earlypricing]"></td>
					</tr>

					<tr>
						<td colspan="10"><strong>Windows / Features</strong></td>
					</tr>

					<tr>
						<td>&nbsp;</td>
						<td>2 Arched</td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[2][1]['2 Arched']['mapcode'])){ echo $inputs[2][1]['2 Arched']['mapcode']; } ?>" name="inputs[2][1][2 Arched][mapcode]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[2][1]['2 Arched']['color'])){ echo $inputs[2][1]['2 Arched']['color']; } ?>" name="inputs[2][1][2 Arched][color]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[2][1]['2 Arched']['qty'])){ echo $inputs[2][1]['2 Arched']['qty']; } ?>" name="inputs[2][1][2 Arched][qty]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[2][1]['2 Arched']['level'])){ echo $inputs[2][1]['2 Arched']['level']; } ?>" name="inputs[2][1][2 Arched][level]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[2][1]['2 Arched']['rate'])){ echo $inputs[2][1]['2 Arched']['rate']; } ?>" name="inputs[2][1][2 Arched][rate]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[2][1]['2 Arched']['sc'])){ echo $inputs[2][1]['2 Arched']['sc']; } ?>" name="inputs[2][1][2 Arched][sc]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[2][1]['2 Arched']['pricing'])){ echo $inputs[2][1]['2 Arched']['pricing']; } ?>" name="inputs[2][1][2 Arched][pricing]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[2][1]['2 Arched']['earlypricing'])){ echo $inputs[2][1]['2 Arched']['earlypricing']; } ?>" name="inputs[2][1][2 Arched][earlypricing]"></td>
					</tr>

					<tr>
						<td>&nbsp;</td>
						<td>2 Square</td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[2][2]['2 Square']['mapcode'])){ echo $inputs[2][2]['2 Square']['mapcode']; } ?>" name="inputs[2][2][2 Square][mapcode]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[2][2]['2 Square']['color'])){ echo $inputs[2][2]['2 Square']['color']; } ?>" name="inputs[2][2][2 Square][color]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[2][2]['2 Square']['qty'])){ echo $inputs[2][2]['2 Square']['qty']; } ?>" name="inputs[2][2][2 Square][qty]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[2][2]['2 Square']['level'])){ echo $inputs[2][2]['2 Square']['level']; } ?>" name="inputs[2][2][2 Square][level]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[2][2]['2 Square']['rate'])){ echo $inputs[2][2]['2 Square']['rate']; } ?>" name="inputs[2][2][2 Square][rate]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[2][2]['2 Square']['sc'])){ echo $inputs[2][2]['2 Square']['sc']; } ?>" name="inputs[2][2][2 Square][sc]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[2][2]['2 Square']['pricing'])){ echo $inputs[2][2]['2 Square']['pricing']; } ?>" name="inputs[2][2][2 Square][pricing]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[2][2]['2 Square']['earlypricing'])){ echo $inputs[2][2]['2 Square']['earlypricing']; } ?>" name="inputs[2][2][2 Square][earlypricing]"></td>
					</tr>


					<tr>
						<td colspan="10"><strong>Tree Lighting</strong></td>
					</tr>

					<tr>
						<td>Canopy</td>
						<td>Red Oak</td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[3]['Canopy']['Red Oak']['mapcode'])){ echo $inputs[3]['Canopy']['Red Oak']['mapcode']; } ?>" name="inputs[3][Canopy][Red Oak][mapcode]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[3]['Canopy']['Red Oak']['color'])){ echo $inputs[3]['Canopy']['Red Oak']['color']; } ?>" name="inputs[3][Canopy][Red Oak][color]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[3]['Canopy']['Red Oak']['qty'])){ echo $inputs[3]['Canopy']['Red Oak']['qty']; } ?>" name="inputs[3][Canopy][Red Oak][qty]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[3]['Canopy']['Red Oak']['level'])){ echo $inputs[3]['Canopy']['Red Oak']['level']; } ?>" name="inputs[3][Canopy][Red Oak][level]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[3]['Canopy']['Red Oak']['rate'])){ echo $inputs[3]['Canopy']['Red Oak']['rate']; } ?>" name="inputs[3][Canopy][Red Oak][rate]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[3]['Canopy']['Red Oak']['sc'])){ echo $inputs[3]['Canopy']['Red Oak']['sc']; } ?>" name="inputs[3][Canopy][Red Oak][sc]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[3]['Canopy']['Red Oak']['pricing'])){ echo $inputs[3]['Canopy']['Red Oak']['pricing']; } ?>" name="inputs[3][Canopy][Red Oak][pricing]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[3]['Canopy']['Red Oak']['earlypricing'])){ echo $inputs[3]['Canopy']['Red Oak']['earlypricing']; } ?>" name="inputs[3][Canopy][Red Oak][earlypricing]"></td>
					</tr>

					<tr>
						<td>Trunk</td>
						<td>Live Oak</td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[3]['Trunk']['Live Oak']['mapcode'])){ echo $inputs[3]['Trunk']['Live Oak']['mapcode']; } ?>" name="inputs[3][Trunk][Live Oak][mapcode]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[3]['Trunk']['Live Oak']['color'])){ echo $inputs[3]['Trunk']['Live Oak']['color']; } ?>" name="inputs[3][Trunk][Live Oak][color]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[3]['Trunk']['Live Oak']['qty'])){ echo $inputs[3]['Trunk']['Live Oak']['qty']; } ?>" name="inputs[3][Trunk][Live Oak][qty]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[3]['Trunk']['Live Oak']['level'])){ echo $inputs[3]['Trunk']['Live Oak']['level']; } ?>" name="inputs[3][Trunk][Live Oak][level]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[3]['Trunk']['Live Oak']['rate'])){ echo $inputs[3]['Trunk']['Live Oak']['rate']; } ?>" name="inputs[3][Trunk][Live Oak][rate]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[3]['Trunk']['Live Oak']['sc'])){ echo $inputs[3]['Trunk']['Live Oak']['sc']; } ?>" name="inputs[3][Trunk][Live Oak][sc]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[3]['Trunk']['Live Oak']['pricing'])){ echo $inputs[3]['Trunk']['Live Oak']['pricing']; } ?>" name="inputs[3][Trunk][Live Oak][pricing]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[3]['Trunk']['Live Oak']['earlypricing'])){ echo $inputs[3]['Trunk']['Live Oak']['earlypricing']; } ?>" name="inputs[3][Trunk][Live Oak][earlypricing]"></td>
					</tr>

					<tr>
						<td colspan="10"><strong>Shrubs</strong></td>
					</tr>

					<tr>
						<td>&nbsp;</td>
						<td>3 Hollies</td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[4][1]['3 Hollies']['mapcode'])){ echo $inputs[4][1]['3 Hollies']['mapcode']; } ?>" name="inputs[4][1][3 Hollies][mapcode]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[4][1]['3 Hollies']['color'])){ echo $inputs[4][1]['3 Hollies']['color']; } ?>" name="inputs[4][1][3 Hollies][color]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[4][1]['3 Hollies']['qty'])){ echo $inputs[4][1]['3 Hollies']['qty']; } ?>" name="inputs[4][1][3 Hollies][qty]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[4][1]['3 Hollies']['level'])){ echo $inputs[4][1]['3 Hollies']['level']; } ?>" name="inputs[4][1][3 Hollies][level]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[4][1]['3 Hollies']['rate'])){ echo $inputs[4][1]['3 Hollies']['rate']; } ?>" name="inputs[4][1][3 Hollies][rate]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[4][1]['3 Hollies']['sc'])){ echo $inputs[4][1]['3 Hollies']['sc']; } ?>" name="inputs[4][1][3 Hollies][sc]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[4][1]['3 Hollies']['pricing'])){ echo $inputs[4][1]['3 Hollies']['pricing']; } ?>" name="inputs[4][1][3 Hollies][pricing]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[4][1]['3 Hollies']['earlypricing'])){ echo $inputs[4][1]['3 Hollies']['earlypricing']; } ?>" name="inputs[4][1][3 Hollies][earlypricing]"></td>
					</tr>

					<tr>
						<td>&nbsp;</td>
						<td>2 Boxwoods</td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[4][2]['2 Boxwoods']['mapcode'])){ echo $inputs[4][2]['2 Boxwoods']['mapcode']; } ?>" name="inputs[4][2][2 Boxwoods][mapcode]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[4][2]['2 Boxwoods']['color'])){ echo $inputs[4][2]['2 Boxwoods']['color']; } ?>" name="inputs[4][2][2 Boxwoods][color]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[4][2]['2 Boxwoods']['qty'])){ echo $inputs[4][2]['2 Boxwoods']['qty']; } ?>" name="inputs[4][2][2 Boxwoods][qty]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[4][2]['2 Boxwoods']['level'])){ echo $inputs[4][2]['2 Boxwoods']['level']; } ?>" name="inputs[4][2][2 Boxwoods][level]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[4][2]['2 Boxwoods']['rate'])){ echo $inputs[4][2]['2 Boxwoods']['rate']; } ?>" name="inputs[4][2][2 Boxwoods][rate]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[4][2]['2 Boxwoods']['sc'])){ echo $inputs[4][2]['2 Boxwoods']['sc']; } ?>" name="inputs[4][2][2 Boxwoods][sc]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[4][2]['2 Boxwoods']['pricing'])){ echo $inputs[4][2]['2 Boxwoods']['pricing']; } ?>" name="inputs[4][2][2 Boxwoods][pricing]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[4][2]['2 Boxwoods']['earlypricing'])){ echo $inputs[4][2]['2 Boxwoods']['earlypricing']; } ?>" name="inputs[4][2][2 Boxwoods][earlypricing]"></td>
					</tr>

					<tr>
						<td colspan="10"><strong>Ground Lighting</strong></td>
					</tr>

					<tr>
						<td>Stakes</td>
						<td>Curved Walk</td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Curved Walk']['mapcode'])){ echo $inputs[5]['Stakes']['Curved Walk']['mapcode']; } ?>" name="inputs[5][Stakes][Curved Walk][mapcode]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Curved Walk']['color'])){ echo $inputs[5]['Stakes']['Curved Walk']['color']; } ?>" name="inputs[5][Stakes][Curved Walk][color]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Curved Walk']['qty'])){ echo $inputs[5]['Stakes']['Curved Walk']['qty']; } ?>" name="inputs[5][Stakes][Curved Walk][qty]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Curved Walk']['level'])){ echo $inputs[5]['Stakes']['Curved Walk']['level']; } ?>" name="inputs[5][Stakes][Curved Walk][level]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Curved Walk']['rate'])){ echo $inputs[5]['Stakes']['Curved Walk']['rate']; } ?>" name="inputs[5][Stakes][Curved Walk][rate]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Curved Walk']['sc'])){ echo $inputs[5]['Stakes']['Curved Walk']['sc']; } ?>" name="inputs[5][Stakes][Curved Walk][sc]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Curved Walk']['pricing'])){ echo $inputs[5]['Stakes']['Curved Walk']['pricing']; } ?>" name="inputs[5][Stakes][Curved Walk][pricing]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Curved Walk']['earlypricing'])){ echo $inputs[5]['Stakes']['Curved Walk']['earlypricing']; } ?>" name="inputs[5][Stakes][Curved Walk][earlypricing]"></td>
					</tr>

					<tr>
						<td>&nbsp;</td>
						<td>Bed</td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Bed']['mapcode'])){ echo $inputs[5]['Stakes']['Bed']['mapcode']; } ?>" name="inputs[5][Stakes][Bed][mapcode]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Bed']['color'])){ echo $inputs[5]['Stakes']['Bed']['color']; } ?>" name="inputs[5][Stakes][Bed][color]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Bed']['qty'])){ echo $inputs[5]['Stakes']['Bed']['qty']; } ?>" name="inputs[5][Stakes][Bed][qty]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Bed']['level'])){ echo $inputs[5]['Stakes']['Bed']['level']; } ?>" name="inputs[5][Stakes][Bed][level]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Bed']['rate'])){ echo $inputs[5]['Stakes']['Bed']['rate']; } ?>" name="inputs[5][Stakes][Bed][rate]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Bed']['sc'])){ echo $inputs[5]['Stakes']['Bed']['sc']; } ?>" name="inputs[5][Stakes][Bed][sc]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Bed']['pricing'])){ echo $inputs[5]['Stakes']['Bed']['pricing']; } ?>" name="inputs[5][Stakes][Bed][pricing]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Bed']['earlypricing'])){ echo $inputs[5]['Stakes']['Bed']['earlypricing']; } ?>" name="inputs[5][Stakes][Bed][earlypricing]"></td>
					</tr>

					<tr>
						<td>&nbsp;</td>
						<td>Parkway</td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Parkway']['mapcode'])){ echo $inputs[5]['Stakes']['Parkway']['mapcode']; } ?>" name="inputs[5][Stakes][Parkway][mapcode]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Parkway']['color'])){ echo $inputs[5]['Stakes']['Parkway']['color']; } ?>" name="inputs[5][Stakes][Parkway][color]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Parkway']['qty'])){ echo $inputs[5]['Stakes']['Parkway']['qty']; } ?>" name="inputs[5][Stakes][Parkway][qty]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Parkway']['level'])){ echo $inputs[5]['Stakes']['Parkway']['level']; } ?>" name="inputs[5][Stakes][Parkway][level]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Parkway']['rate'])){ echo $inputs[5]['Stakes']['Parkway']['rate']; } ?>" name="inputs[5][Stakes][Parkway][rate]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Parkway']['sc'])){ echo $inputs[5]['Stakes']['Parkway']['sc']; } ?>" name="inputs[5][Stakes][Parkway][sc]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Parkway']['pricing'])){ echo $inputs[5]['Stakes']['Parkway']['pricing']; } ?>" name="inputs[5][Stakes][Parkway][pricing]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[5]['Stakes']['Parkway']['earlypricing'])){ echo $inputs[5]['Stakes']['Parkway']['earlypricing']; } ?>" name="inputs[5][Stakes][Parkway][earlypricing]"></td>
					</tr>



					<tr>
						<td colspan="10"><strong>Daytime Decor</strong></td>
					</tr>

					<tr>
						<td>Garland</td>
						<td>Door</td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Garland']['Door']['mapcode'])){ echo $inputs[6]['Garland']['Door']['mapcode']; } ?>" name="inputs[6][Garland][Door][mapcode]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Garland']['Door']['color'])){ echo $inputs[6]['Garland']['Door']['color']; } ?>" name="inputs[6][Garland][Door][color]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Garland']['Door']['qty'])){ echo $inputs[6]['Garland']['Door']['qty']; } ?>" name="inputs[6][Garland][Door][qty]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Garland']['Door']['level'])){ echo $inputs[6]['Garland']['Door']['level']; } ?>" name="inputs[6][Garland][Door][level]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Garland']['Door']['rate'])){ echo $inputs[6]['Garland']['Door']['rate']; } ?>" name="inputs[6][Garland][Door][rate]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Garland']['Door']['sc'])){ echo $inputs[6]['Garland']['Door']['sc']; } ?>" name="inputs[6][Garland][Door][sc]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Garland']['Door']['pricing'])){ echo $inputs[6]['Garland']['Door']['pricing']; } ?>" name="inputs[6][Garland][Door][pricing]"></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Garland']['Door']['earlypricing'])){ echo $inputs[6]['Garland']['Door']['earlypricing']; } ?>" name="inputs[6][Garland][Door][earlypricing]"></td>
					</tr>

					<tr>
						<td>&nbsp;</td>
						<td>Entry Arch 200 lights</td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Garland']['Entry Arch 200 lights']['mapcode'])){ echo $inputs[6]['Garland']['Entry Arch 200 lights']['mapcode']; } ?>" name="inputs[6][Garland][Entry Arch 200 lights][mapcode]"></td>

						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Garland']['Entry Arch 200 lights']['color'])){ echo $inputs[6]['Garland']['Entry Arch 200 lights']['color']; } ?>" name="inputs[6][Garland][Entry Arch 200 lights][color]"></td>

						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Garland']['Entry Arch 200 lights']['qty'])){ echo $inputs[6]['Garland']['Entry Arch 200 lights']['qty']; } ?>" name="inputs[6][Garland][Entry Arch 200 lights][qty]"></td>

						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Garland']['Entry Arch 200 lights']['level'])){ echo $inputs[6]['Garland']['Entry Arch 200 lights']['level']; } ?>" name="inputs[6][Garland][Entry Arch 200 lights][level]"></td>

						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Garland']['Entry Arch 200 lights']['rate'])){ echo $inputs[6]['Garland']['Entry Arch 200 lights']['rate']; } ?>" name="inputs[6][Garland][Entry Arch 200 lights][rate]"></td>

						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Garland']['Entry Arch 200 lights']['sc'])){ echo $inputs[6]['Garland']['Entry Arch 200 lights']['sc']; } ?>" name="inputs[6][Garland][Entry Arch 200 lights][sc]"></td>

						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Garland']['Entry Arch 200 lights']['pricing'])){ echo $inputs[6]['Garland']['Entry Arch 200 lights']['pricing']; } ?>" name="inputs[6][Garland][Entry Arch 200 lights][pricing]"></td>

						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Garland']['Entry Arch 200 lights']['earlypricing'])){ echo $inputs[6]['Garland']['Entry Arch 200 lights']['earlypricing']; } ?>" name="inputs[6][Garland][Entry Arch 200 lights][earlypricing]"></td>
					</tr>

					<tr>
						<td>Wreaths</td>
						<td>30" Prelit over Door</td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Wreaths']['30" Prelit over Door']['mapcode'])){ echo $inputs[6]['Wreaths']['30" Prelit over Door']['mapcode']; } ?>" name='inputs[6][Wreaths][30" Prelit over Door][mapcode]'></td>

						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Wreaths']['30" Prelit over Door']['color'])){ echo $inputs[6]['Wreaths']['30" Prelit over Door']['color']; } ?>" name='inputs[6][Wreaths][30" Prelit over Door][color]'></td>

						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Wreaths']['30" Prelit over Door']['qty'])){ echo $inputs[6]['Wreaths']['30" Prelit over Door']['qty']; } ?>" name='inputs[6][Wreaths][30" Prelit over Door][qty]'></td>

						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Wreaths']['30" Prelit over Door']['level'])){ echo $inputs[6]['Wreaths']['30" Prelit over Door']['level']; } ?>" name='inputs[6][Wreaths][30" Prelit over Door][level]'></td>

						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Wreaths']['30" Prelit over Door']['rate'])){ echo $inputs[6]['Wreaths']['30" Prelit over Door']['rate']; } ?>" name='inputs[6][Wreaths][30" Prelit over Door][rate]'></td>

						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Wreaths']['30" Prelit over Door']['sc'])){ echo $inputs[6]['Wreaths']['30" Prelit over Door']['sc']; } ?>" name='inputs[6][Wreaths][30" Prelit over Door][sc]'></td>

						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Wreaths']['30" Prelit over Door']['pricing'])){ echo $inputs[6]['Wreaths']['30" Prelit over Door']['pricing']; } ?>" name='inputs[6][Wreaths][30" Prelit over Door][pricing]'></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Wreaths']['30" Prelit over Door']['earlypricing'])){ echo $inputs[6]['Wreaths']['30" Prelit over Door']['earlypricing']; } ?>" name='inputs[6][Wreaths][30" Prelit over Door][earlypricing]'></td>
					</tr>

					<tr>
						<td>&nbsp;</td>
						<td>(w/50 lights)</td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Wreaths']['(w/50 lights)']['mapcode'])){ echo $inputs[6]['Wreaths']['(w/50 lights)']['mapcode']; } ?>" name='inputs[6][Wreaths][(w/50 lights)][mapcode]'></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Wreaths']['(w/50 lights)']['color'])){ echo $inputs[6]['Wreaths']['(w/50 lights)']['color']; } ?>" name='inputs[6][Wreaths][(w/50 lights)][color]'></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Wreaths']['(w/50 lights)']['qty'])){ echo $inputs[6]['Wreaths']['(w/50 lights)']['qty']; } ?>" name='inputs[6][Wreaths][(w/50 lights)][qty]'></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Wreaths']['(w/50 lights)']['level'])){ echo $inputs[6]['Wreaths']['(w/50 lights)']['level']; } ?>" name='inputs[6][Wreaths][(w/50 lights)][level]'></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Wreaths']['(w/50 lights)']['rate'])){ echo $inputs[6]['Wreaths']['(w/50 lights)']['rate']; } ?>" name='inputs[6][Wreaths][(w/50 lights)][rate]'></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Wreaths']['(w/50 lights)']['sc'])){ echo $inputs[6]['Wreaths']['(w/50 lights)']['sc']; } ?>" name='inputs[6][Wreaths][(w/50 lights)][sc]'></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Wreaths']['(w/50 lights)']['pricing'])){ echo $inputs[6]['Wreaths']['(w/50 lights)']['pricing']; } ?>" name='inputs[6][Wreaths][(w/50 lights)][pricing]'></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Wreaths']['(w/50 lights)']['earlypricing'])){ echo $inputs[6]['Wreaths']['(w/50 lights)']['earlypricing']; } ?>" name='inputs[6][Wreaths][(w/50 lights)][earlypricing]'></td>
					</tr>

					<tr>
						<td>Bows</td>
						<td>Small on Entry Garland</td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Bows']['Small on Entry Garland']['mapcode'])){ echo $inputs[6]['Bows']['Small on Entry Garland']['mapcode']; } ?>" name='inputs[6][Bows][Small on Entry Garland][mapcode]'></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Bows']['Small on Entry Garland']['color'])){ echo $inputs[6]['Bows']['Small on Entry Garland']['color']; } ?>" name='inputs[6][Bows][Small on Entry Garland][color]'></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Bows']['Small on Entry Garland']['qty'])){ echo $inputs[6]['Bows']['Small on Entry Garland']['qty']; } ?>" name='inputs[6][Bows][Small on Entry Garland][qty]'></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Bows']['Small on Entry Garland']['level'])){ echo $inputs[6]['Bows']['Small on Entry Garland']['level']; } ?>" name='inputs[6][Bows][Small on Entry Garland][level]'></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Bows']['Small on Entry Garland']['rate'])){ echo $inputs[6]['Bows']['Small on Entry Garland']['rate']; } ?>" name='inputs[6][Bows][Small on Entry Garland][rate]'></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Bows']['Small on Entry Garland']['sc'])){ echo $inputs[6]['Bows']['Small on Entry Garland']['sc']; } ?>" name='inputs[6][Bows][Small on Entry Garland][sc]'></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Bows']['Small on Entry Garland']['pricing'])){ echo $inputs[6]['Bows']['Small on Entry Garland']['pricing']; } ?>" name='inputs[6][Bows][Small on Entry Garland][pricing]'></td>
						<td><input type="text" size="10"  value="<?php if(isset($inputs[6]['Bows']['Small on Entry Garland']['earlypricing'])){ echo $inputs[6]['Bows']['Small on Entry Garland']['earlypricing']; } ?>" name='inputs[6][Bows][Small on Entry Garland][earlypricing]'></td>
					</tr>

					<tr>
						<td colspan="10"><input type="submit" name="save" value="Save" /></td>
						
					</tr>

					
				</table>
			</form>
		</div>
	</div>	  
 </BODY>
</HTML>

