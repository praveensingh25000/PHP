<?php

require '../vendor/slim/slim/Slim/Slim.php';

\Slim\Slim::registerAutoloader();
$app = new \Slim\Slim();

$db = new PDO('sqlite:db.sqlite3');

//$projectid = 11;

if(isset($_GET['cid']))
{
	$customerid = $_GET['cid'];
}
else
{
	die("Customer id not passed");
}

if(isset($_GET['pid']))
{
	$projectid = $_GET['pid'];
}
else
{
	$sql = "insert into projects(customer, image, amount) values('" . $customerid . "', '', '0')";
	$db->query($sql);
	$projectid = $db->lastInsertId();
}

//echo "Project id: " + $projectid;
//exit;end;

$defaultvalues = Array(
				0 => array('project' => $projectid, 'name' => 'Facia', 'description' => 'Front', 'items' => "", 'color' => "", 'price' => "800.00", 'scale' => "10", 'active' => 1, 'mapcode' => "50", 'qty' => "200", 'level' => "", 'rate' => "4.00", 'earlyprice' => "720.00", 'decor_type' => 1),

				1 => array('project' => $projectid, 'name' => 'Ridges', 'description' => 'Front', 'items' => "", 'color' => "", 'price' => "", 'scale' => "10", 'active' => 1, 'mapcode' => "50", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 1),

				2 => array('project' => $projectid, 'name' => 'Ridges', 'description' => 'West Side', 'items' => "", 'color' => "", 'price' => "", 'scale' => "10", 'active' => 1, 'mapcode' => "50", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 1),

				3 => array('project' => $projectid, 'name' => '1', 'description' => '2 Arched', 'items' => "", 'color' => "", 'price' => "", 'scale' => "10", 'active' => 1, 'mapcode' => "50", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 2),

				4 => array('project' => $projectid, 'name' => '2', 'description' => '2 Square', 'items' => "", 'color' => "", 'price' => "", 'scale' => "10", 'active' => 1, 'mapcode' => "50", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 2),

				5 => array('project' => $projectid, 'name' => 'Canopy', 'description' => 'Red Oak', 'items' => "", 'color' => "", 'price' => "", 'scale' => "10", 'active' => 1, 'mapcode' => "50", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 3),

				6 => array('project' => $projectid, 'name' => 'Trunk', 'description' => 'Live Oak', 'items' => "", 'color' => "", 'price' => "", 'scale' => "10", 'active' => 1, 'mapcode' => "50", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 3),

				7 => array('project' => $projectid, 'name' => '1', 'description' => '3 Hollies', 'items' => "", 'color' => "", 'price' => "", 'scale' => "10", 'active' => 1, 'mapcode' => "50", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 4),

				8 => array('project' => $projectid, 'name' => '2', 'description' => '2 Boxwoods', 'items' => "", 'color' => "", 'price' => "", 'scale' => "10", 'active' => 1, 'mapcode' => "50", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 4),

				9 => array('project' => $projectid, 'name' => 'Stakes', 'description' => 'Curved Walk', 'items' => "", 'color' => "", 'price' => "", 'scale' => "10", 'active' => 1, 'mapcode' => "50", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 5),

				10 => array('project' => $projectid, 'name' => 'Stakes', 'description' => 'Bed', 'items' => "", 'color' => "", 'price' => "250.00", 'scale' => "10", 'active' => 1, 'mapcode' => "50", 'qty' => "25", 'level' => "", 'rate' => "10.00", 'earlyprice' => "225.00", 'decor_type' => 5),

				11 => array('project' => $projectid, 'name' => 'Stakes', 'description' => 'Parkway', 'items' => "", 'color' => "", 'price' => "", 'scale' => "10", 'active' => 1, 'mapcode' => "50", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 5),

				12 => array('project' => $projectid, 'name' => 'Garland', 'description' => 'Door', 'items' => "", 'color' => "", 'price' => "", 'scale' => "10", 'active' => 1, 'mapcode' => "50", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 6),

				13 => array('project' => $projectid, 'name' => 'Garland', 'description' => 'Entry Arch 200 lights', 'items' => "", 'color' => "", 'price' => "", 'scale' => "10", 'active' => 1, 'mapcode' => "50", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 6),

				14 => array('project' => $projectid, 'name' => 'Wreaths', 'description' => '30" Prelit over Door', 'items' => "", 'color' => "", 'price' => "", 'scale' => "10", 'active' => 1, 'mapcode' => "50", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 6),

				15 => array('project' => $projectid, 'name' => 'Wreaths', 'description' => '(w/50 lights)', 'items' => "", 'color' => "", 'price' => "", 'scale' => "10", 'active' => 1, 'mapcode' => "50", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 6),

				16 => array('project' => $projectid, 'name' => 'Bows', 'description' => 'Small on Entry Garland', 'items' => "", 'color' => "", 'price' => "", 'scale' => "10", 'active' => 1, 'mapcode' => "50", 'qty' => "", 'level' => "", 'rate' => "", 'earlyprice' => "", 'decor_type' => 6)
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

	$notes		= (!empty($_POST['notes']))?nl2br(mysql_real_escape_string($_POST['notes'])):'';
	
	$db->query("INSERT INTO service_proposal (contact, apptime, installation, date_sold, daytime_decor, take_down, notes, projectid) VALUES ('".$contact."','".$appttime."', '".$installation."', '".$datesold."', '".$daytime."', '".$takedown."', '".$notes."', '".intval($projectid)."')");
	$idp = $db->lastInsertId();


	foreach($_POST['inputs'] as $decor_type => $inputs){
		foreach($inputs as $name => $names){
			foreach($names as $description => $values){

				//$color = $values['color'];
				$price = $values['pricing'];
				$scale = $values['sc'];
				$active = 1;
				//$mapcode = $values['mapcode'];
				$qty = $values['qty'];
				$level = $values['level'];
				$rate = $values['rate'];
				$earlyprice = $values['earlypricing'];
				
				$db->query("INSERT INTO layers (project, name, description, color, price, scale, active, mapcode, qty, level, rate, earlyprice, decor_type) VALUES ('".intval($projectid)."', '".$name."','".$description."', '".$price."', '".$scale."', '".$active."', '".$qty."', '".$level."', '".$rate."', '".$earlyprice."', '".$decor_type."')");
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

	//$inputs[$decor_type][$name][$description]['mapcode']	= $mapcode;
	//$inputs[$decor_type][$name][$description]['color']		= $color;
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

 <BODY style="overflow-x:hidden;overflow-y:scroll;"">
	
	<div data-clightspane="workspace" class="container-fluid clights_pane " id="clights-layers">
				
			<form method="post" action="">
			<div>
				<div style="float:left;width:40%">

					<div>
						<div>
							Name<br/>
							<?=$customerDetail['name']?>
						</div>
						<div>
							Billing Address<br/>
							<?=$customerDetail['address_1']."<br/>".$customerDetail['address_2']?>
						</div>

						<div>
							<div>
								<span style="width:30%;float:left;margin-right:10px;">City</span>
								<span style="width:30%;float:left;margin-right:10px;">ST</span>
								<span style="width:30%;float:left;margin-right:10px;">Zip</span>
							</div>
							<div>
								<span style="width:30%;float:left;margin-right:10px;"><?=$customerDetail['city']?></span>
								<span style="width:30%;float:left;margin-right:10px;"><?=$customerDetail['state']?></span>
								<span style="width:30%;float:left;margin-right:10px;"><?=$customerDetail['zip']?></span>
							</div>
						</div>

						<div>
							Phone<br/>
							<?=$customerDetail['phone']?>
						</div>						
					</div>
				</div>
				<div style="float:left;margin-left:10px;width:55%;">
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
					<div>
						<div>
							<div style="width:40%;float:left;margin-right:10px;">
								Contact:<br/>
								<input type="text" size="10"  value="<?php if(isset($proposal['contact'])){ echo $proposal['contact']; } ?>" name="contact" />
							</div>
							<div style="width:40%;float:left;margin-right:10px;">
								Appt Time<br/>
								<input type="text" size="10"  value="<?php if(isset($proposal['apptime'])){ echo $proposal['apptime']; } ?>" name="appttime" />&nbsp;<span>format: hour:min:second</span>
							</div>
						</div>
						<div style="clear:both"></div>

						<div>
							<div style="width:40%;float:left;margin-right:10px;">
								Installation:<br/>
								<input type="text" size="10"  name="installation" value="<?php if(isset($proposal['installation'])){ echo $proposal['installation']; } ?>"/>&nbsp;<span>format: YYYY-MM-DD</span>
							</div>
							<div style="width:40%;float:left;margin-right:10px;">
								Daytime Decor<br/>
								<input type="text" size="10"  name="daytime" value="<?php if(isset($proposal['daytime_decor'])){ echo $proposal['daytime_decor']; } ?>"/>&nbsp;<span>format: hour:min:second</span>
							</div>
						</div>
						<div style="clear:both"></div>

						<div>
							<div style="width:40%;float:left;margin-right:10px;">
								Date Sold:<br/>
								<input type="text" size="10"  name="datesold" value="<?php if(isset($proposal['date_sold'])){ echo $proposal['date_sold']; } ?>"/>&nbsp;<span>format: YYYY-MM-DD</span>
							</div>
							<div style="width:40%;float:left;margin-right:10px;">
								Take Down<br/>
								<input type="text" size="10"  name="takedown" value="<?php if(isset($proposal['take_down'])){ echo $proposal['take_down']; } ?>"/>&nbsp;<span>format: hour:min:second</span>
							</div>
						</div>
						<div style="clear:both"></div>
					</div>
				</div>
				<div style="clear:both"></div>
			</div>

		<hr>

				<div width="80%" border = '1' cellpadding="6">
					<div>
						<div style="width:12%;float:left;margn-right:10px;">Decor Type</div>
						<div style="width:25%;float:left;margn-right:10px;">Location/Description:</div>
						<!--<div style="width:10%;float:left;margn-right:10px;">Map Code</div>
						<div style="width:8%;float:left;margn-right:10px;">Color</div> -->
						<div style="width:8%;float:left;margn-right:10px;">Qty</div>
						<div style="width:10%;float:left;margn-right:10px;">Level</div>
						<div style="width:8%;float:left;margn-right:10px;">Rate</div>
						<div style="width:8%;float:left;margn-right:10px;">SC</div>
						<div style="width:10%;float:left;margn-right:10px;">Pricing</div>
						<div style="width:10%;float:left;margn-right:10px;">Early Pricing</div>
						<div style="clear:both"></div>
					</div>

					<div style="background-color: #414141;">
						<div><strong>Roof Lighting</strong></div>
					</div>

					<div>
						<div style="width:12%;float:left;margn-right:10px;">Facia</div>
						<div style="width:25%;float:left;margn-right:10px;">Front</div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[1]['Facia']['Front']['qty'])){ echo $inputs[1]['Facia']['Front']['qty']; } ?>" name="inputs[1][Facia][Front][qty]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[1]['Facia']['Front']['level'])){ echo $inputs[1]['Facia']['Front']['level']; } ?>" name="inputs[1][Facia][Front][level]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[1]['Facia']['Front']['rate'])){ echo $inputs[1]['Facia']['Front']['rate']; } ?>" name="inputs[1][Facia][Front][rate]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[1]['Facia']['Front']['sc'])){ echo $inputs[1]['Facia']['Front']['sc']; } ?>" name="inputs[1][Facia][Front][sc]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[1]['Facia']['Front']['pricing'])){ echo $inputs[1]['Facia']['Front']['pricing']; } ?>" name="inputs[1][Facia][Front][pricing]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[1]['Facia']['Front']['earlypricing'])){ echo $inputs[1]['Facia']['Front']['earlypricing']; } ?>" name="inputs[1][Facia][Front][earlypricing]"></div>
						<div style="clear:both"></div>
					</div>

					<div style="background-color: #414141;">
						<div style="width:12%;float:left;margn-right:10px;">Ridges</div>
						<div style="width:25%;float:left;margn-right:10px;">Front</div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[1]['Ridges']['Front']['qty'])){ echo $inputs[1]['Ridges']['Front']['qty']; } ?>" name="inputs[1][Ridges][Front][qty]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[1]['Ridges']['Front']['level'])){ echo $inputs[1]['Ridges']['Front']['level']; } ?>" name="inputs[1][Ridges][Front][level]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[1]['Ridges']['Front']['rate'])){ echo $inputs[1]['Ridges']['Front']['rate']; } ?>" name="inputs[1][Ridges][Front][rate]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[1]['Ridges']['Front']['sc'])){ echo $inputs[1]['Ridges']['Front']['sc']; } ?>" name="inputs[1][Ridges][Front][sc]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[1]['Ridges']['Front']['pricing'])){ echo $inputs[1]['Ridges']['Front']['pricing']; } ?>" name="inputs[1][Ridges][Front][pricing]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[1]['Ridges']['Front']['earlypricing'])){ echo $inputs[1]['Ridges']['Front']['earlypricing']; } ?>" name="inputs[1][Ridges][Front][earlypricing]"></div>
						<div style="clear:both"></div>
					</div>

					<div>
						<div style="width:12%;float:left;margn-right:10px;">&nbsp;</div>
						<div style="width:25%;float:left;margn-right:10px;">West Side</div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[1]['Ridges']['West Side']['qty'])){ echo $inputs[1]['Ridges']['West Side']['qty']; } ?>" name="inputs[1][Ridges][West Side][qty]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[1]['Ridges']['West Side']['level'])){ echo $inputs[1]['Ridges']['West Side']['level']; } ?>" name="inputs[1][Ridges][West Side][level]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[1]['Ridges']['West Side']['rate'])){ echo $inputs[1]['Ridges']['West Side']['rate']; } ?>" name="inputs[1][Ridges][West Side][rate]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[1]['Ridges']['West Side']['sc'])){ echo $inputs[1]['Ridges']['West Side']['sc']; } ?>" name="inputs[1][Ridges][West Side][sc]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[1]['Ridges']['West Side']['pricing'])){ echo $inputs[1]['Ridges']['West Side']['pricing']; } ?>" name="inputs[1][Ridges][West Side][pricing]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[1]['Ridges']['West Side']['earlypricing'])){ echo $inputs[1]['Ridges']['West Side']['earlypricing']; } ?>" name="inputs[1][Ridges][West Side][earlypricing]"></div>
						<div style="clear:both"></div>
					</div>

					<div style="background-color: #414141;">
						<div><strong>Windows / Features</strong></div>
					</div>

					<div>
						<div style="width:12%;float:left;margn-right:10px;">&nbsp;</div>
						<div style="width:25%;float:left;margn-right:10px;">2 Arched</div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[2][1]['2 Arched']['qty'])){ echo $inputs[2][1]['2 Arched']['qty']; } ?>" name="inputs[2][1][2 Arched][qty]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[2][1]['2 Arched']['level'])){ echo $inputs[2][1]['2 Arched']['level']; } ?>" name="inputs[2][1][2 Arched][level]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[2][1]['2 Arched']['rate'])){ echo $inputs[2][1]['2 Arched']['rate']; } ?>" name="inputs[2][1][2 Arched][rate]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[2][1]['2 Arched']['sc'])){ echo $inputs[2][1]['2 Arched']['sc']; } ?>" name="inputs[2][1][2 Arched][sc]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[2][1]['2 Arched']['pricing'])){ echo $inputs[2][1]['2 Arched']['pricing']; } ?>" name="inputs[2][1][2 Arched][pricing]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[2][1]['2 Arched']['earlypricing'])){ echo $inputs[2][1]['2 Arched']['earlypricing']; } ?>" name="inputs[2][1][2 Arched][earlypricing]"></div>
						<div style="clear:both"></div>
					</div>

					<div style="background-color: #414141;">
						<div style="width:12%;float:left;margn-right:10px;">&nbsp;</div>
						<div style="width:25%;float:left;margn-right:10px;">2 Square</div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[2][2]['2 Square']['qty'])){ echo $inputs[2][2]['2 Square']['qty']; } ?>" name="inputs[2][2][2 Square][qty]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[2][2]['2 Square']['level'])){ echo $inputs[2][2]['2 Square']['level']; } ?>" name="inputs[2][2][2 Square][level]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[2][2]['2 Square']['rate'])){ echo $inputs[2][2]['2 Square']['rate']; } ?>" name="inputs[2][2][2 Square][rate]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[2][2]['2 Square']['sc'])){ echo $inputs[2][2]['2 Square']['sc']; } ?>" name="inputs[2][2][2 Square][sc]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[2][2]['2 Square']['pricing'])){ echo $inputs[2][2]['2 Square']['pricing']; } ?>" name="inputs[2][2][2 Square][pricing]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[2][2]['2 Square']['earlypricing'])){ echo $inputs[2][2]['2 Square']['earlypricing']; } ?>" name="inputs[2][2][2 Square][earlypricing]"></div>
						<div style="clear:both"></div>
					</div>


					<div >
						<div ><strong>Tree Lighting</strong></div>
					</div>

					<div>
						<div style="width:12%;float:left;margn-right:10px;">Canopy</div>
						<div style="width:25%;float:left;margn-right:10px;">Red Oak</div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[3]['Canopy']['Red Oak']['qty'])){ echo $inputs[3]['Canopy']['Red Oak']['qty']; } ?>" name="inputs[3][Canopy][Red Oak][qty]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[3]['Canopy']['Red Oak']['level'])){ echo $inputs[3]['Canopy']['Red Oak']['level']; } ?>" name="inputs[3][Canopy][Red Oak][level]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[3]['Canopy']['Red Oak']['rate'])){ echo $inputs[3]['Canopy']['Red Oak']['rate']; } ?>" name="inputs[3][Canopy][Red Oak][rate]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[3]['Canopy']['Red Oak']['sc'])){ echo $inputs[3]['Canopy']['Red Oak']['sc']; } ?>" name="inputs[3][Canopy][Red Oak][sc]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[3]['Canopy']['Red Oak']['pricing'])){ echo $inputs[3]['Canopy']['Red Oak']['pricing']; } ?>" name="inputs[3][Canopy][Red Oak][pricing]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[3]['Canopy']['Red Oak']['earlypricing'])){ echo $inputs[3]['Canopy']['Red Oak']['earlypricing']; } ?>" name="inputs[3][Canopy][Red Oak][earlypricing]"></div>
						<div style="clear:both"></div>
					</div>

					<div style="background-color: #414141;">
						<div style="width:12%;float:left;margn-right:10px;">Trunk</div>
						<div style="width:25%;float:left;margn-right:10px;">Live Oak</div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[3]['Trunk']['Live Oak']['qty'])){ echo $inputs[3]['Trunk']['Live Oak']['qty']; } ?>" name="inputs[3][Trunk][Live Oak][qty]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[3]['Trunk']['Live Oak']['level'])){ echo $inputs[3]['Trunk']['Live Oak']['level']; } ?>" name="inputs[3][Trunk][Live Oak][level]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[3]['Trunk']['Live Oak']['rate'])){ echo $inputs[3]['Trunk']['Live Oak']['rate']; } ?>" name="inputs[3][Trunk][Live Oak][rate]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[3]['Trunk']['Live Oak']['sc'])){ echo $inputs[3]['Trunk']['Live Oak']['sc']; } ?>" name="inputs[3][Trunk][Live Oak][sc]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[3]['Trunk']['Live Oak']['pricing'])){ echo $inputs[3]['Trunk']['Live Oak']['pricing']; } ?>" name="inputs[3][Trunk][Live Oak][pricing]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[3]['Trunk']['Live Oak']['earlypricing'])){ echo $inputs[3]['Trunk']['Live Oak']['earlypricing']; } ?>" name="inputs[3][Trunk][Live Oak][earlypricing]"></div>
						<div style="clear:both"></div>
					</div>

					<div >
						<div><strong>Shrubs</strong></div>
					</div>

					<div>
						<div style="width:12%;float:left;margn-right:10px;">&nbsp;</div>
						<div style="width:25%;float:left;margn-right:10px;">3 Hollies</div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[4][1]['3 Hollies']['qty'])){ echo $inputs[4][1]['3 Hollies']['qty']; } ?>" name="inputs[4][1][3 Hollies][qty]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[4][1]['3 Hollies']['level'])){ echo $inputs[4][1]['3 Hollies']['level']; } ?>" name="inputs[4][1][3 Hollies][level]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[4][1]['3 Hollies']['rate'])){ echo $inputs[4][1]['3 Hollies']['rate']; } ?>" name="inputs[4][1][3 Hollies][rate]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[4][1]['3 Hollies']['sc'])){ echo $inputs[4][1]['3 Hollies']['sc']; } ?>" name="inputs[4][1][3 Hollies][sc]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[4][1]['3 Hollies']['pricing'])){ echo $inputs[4][1]['3 Hollies']['pricing']; } ?>" name="inputs[4][1][3 Hollies][pricing]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[4][1]['3 Hollies']['earlypricing'])){ echo $inputs[4][1]['3 Hollies']['earlypricing']; } ?>" name="inputs[4][1][3 Hollies][earlypricing]"></div>
						<div style="clear:both"></div>
					</div>

					<div>
						<div style="width:12%;float:left;margn-right:10px;">&nbsp;</div>
						<div style="width:25%;float:left;margn-right:10px;">2 Boxwoods</div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[4][2]['2 Boxwoods']['qty'])){ echo $inputs[4][2]['2 Boxwoods']['qty']; } ?>" name="inputs[4][2][2 Boxwoods][qty]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[4][2]['2 Boxwoods']['level'])){ echo $inputs[4][2]['2 Boxwoods']['level']; } ?>" name="inputs[4][2][2 Boxwoods][level]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[4][2]['2 Boxwoods']['rate'])){ echo $inputs[4][2]['2 Boxwoods']['rate']; } ?>" name="inputs[4][2][2 Boxwoods][rate]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[4][2]['2 Boxwoods']['sc'])){ echo $inputs[4][2]['2 Boxwoods']['sc']; } ?>" name="inputs[4][2][2 Boxwoods][sc]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[4][2]['2 Boxwoods']['pricing'])){ echo $inputs[4][2]['2 Boxwoods']['pricing']; } ?>" name="inputs[4][2][2 Boxwoods][pricing]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[4][2]['2 Boxwoods']['earlypricing'])){ echo $inputs[4][2]['2 Boxwoods']['earlypricing']; } ?>" name="inputs[4][2][2 Boxwoods][earlypricing]"></div>
						<div style="clear:both"></div>
					</div>

					<div style="background-color: #414141;">
						<div><strong>Ground Lighting</strong></div>
					</div>

					<div>
						<div style="width:12%;float:left;margn-right:10px;">Stakes</div>
						<div style="width:25%;float:left;margn-right:10px;">Curved Walk</div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[5]['Stakes']['Curved Walk']['qty'])){ echo $inputs[5]['Stakes']['Curved Walk']['qty']; } ?>" name="inputs[5][Stakes][Curved Walk][qty]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[5]['Stakes']['Curved Walk']['level'])){ echo $inputs[5]['Stakes']['Curved Walk']['level']; } ?>" name="inputs[5][Stakes][Curved Walk][level]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[5]['Stakes']['Curved Walk']['rate'])){ echo $inputs[5]['Stakes']['Curved Walk']['rate']; } ?>" name="inputs[5][Stakes][Curved Walk][rate]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[5]['Stakes']['Curved Walk']['sc'])){ echo $inputs[5]['Stakes']['Curved Walk']['sc']; } ?>" name="inputs[5][Stakes][Curved Walk][sc]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[5]['Stakes']['Curved Walk']['pricing'])){ echo $inputs[5]['Stakes']['Curved Walk']['pricing']; } ?>" name="inputs[5][Stakes][Curved Walk][pricing]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[5]['Stakes']['Curved Walk']['earlypricing'])){ echo $inputs[5]['Stakes']['Curved Walk']['earlypricing']; } ?>" name="inputs[5][Stakes][Curved Walk][earlypricing]"></div>
						<div style="clear:both"></div>
					</div>

					<div style="background-color: #414141;">
						<div style="width:12%;float:left;margn-right:10px;">&nbsp;</div>
						<div style="width:25%;float:left;margn-right:10px;">Bed</div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[5]['Stakes']['Bed']['qty'])){ echo $inputs[5]['Stakes']['Bed']['qty']; } ?>" name="inputs[5][Stakes][Bed][qty]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[5]['Stakes']['Bed']['level'])){ echo $inputs[5]['Stakes']['Bed']['level']; } ?>" name="inputs[5][Stakes][Bed][level]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[5]['Stakes']['Bed']['rate'])){ echo $inputs[5]['Stakes']['Bed']['rate']; } ?>" name="inputs[5][Stakes][Bed][rate]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[5]['Stakes']['Bed']['sc'])){ echo $inputs[5]['Stakes']['Bed']['sc']; } ?>" name="inputs[5][Stakes][Bed][sc]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[5]['Stakes']['Bed']['pricing'])){ echo $inputs[5]['Stakes']['Bed']['pricing']; } ?>" name="inputs[5][Stakes][Bed][pricing]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[5]['Stakes']['Bed']['earlypricing'])){ echo $inputs[5]['Stakes']['Bed']['earlypricing']; } ?>" name="inputs[5][Stakes][Bed][earlypricing]"></div>
						<div style="clear:both"></div>
					</div>

					<div>
						<div style="width:12%;float:left;margn-right:10px;">&nbsp;</div>
						<div style="width:25%;float:left;margn-right:10px;">Parkway</div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[5]['Stakes']['Parkway']['qty'])){ echo $inputs[5]['Stakes']['Parkway']['qty']; } ?>" name="inputs[5][Stakes][Parkway][qty]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[5]['Stakes']['Parkway']['level'])){ echo $inputs[5]['Stakes']['Parkway']['level']; } ?>" name="inputs[5][Stakes][Parkway][level]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[5]['Stakes']['Parkway']['rate'])){ echo $inputs[5]['Stakes']['Parkway']['rate']; } ?>" name="inputs[5][Stakes][Parkway][rate]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[5]['Stakes']['Parkway']['sc'])){ echo $inputs[5]['Stakes']['Parkway']['sc']; } ?>" name="inputs[5][Stakes][Parkway][sc]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[5]['Stakes']['Parkway']['pricing'])){ echo $inputs[5]['Stakes']['Parkway']['pricing']; } ?>" name="inputs[5][Stakes][Parkway][pricing]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[5]['Stakes']['Parkway']['earlypricing'])){ echo $inputs[5]['Stakes']['Parkway']['earlypricing']; } ?>" name="inputs[5][Stakes][Parkway][earlypricing]"></div>
						<div style="clear:both"></div>
					</div>



					<div style="background-color: #414141;">
						<div><strong>Daytime Decor</strong></div>
					</div>

					<div>
						<div style="width:12%;float:left;margn-right:10px;">Garland</div>
						<div style="width:25%;float:left;margn-right:10px;">Door</div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Garland']['Door']['qty'])){ echo $inputs[6]['Garland']['Door']['qty']; } ?>" name="inputs[6][Garland][Door][qty]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Garland']['Door']['level'])){ echo $inputs[6]['Garland']['Door']['level']; } ?>" name="inputs[6][Garland][Door][level]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Garland']['Door']['rate'])){ echo $inputs[6]['Garland']['Door']['rate']; } ?>" name="inputs[6][Garland][Door][rate]"></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Garland']['Door']['sc'])){ echo $inputs[6]['Garland']['Door']['sc']; } ?>" name="inputs[6][Garland][Door][sc]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Garland']['Door']['pricing'])){ echo $inputs[6]['Garland']['Door']['pricing']; } ?>" name="inputs[6][Garland][Door][pricing]"></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Garland']['Door']['earlypricing'])){ echo $inputs[6]['Garland']['Door']['earlypricing']; } ?>" name="inputs[6][Garland][Door][earlypricing]"></div>
						<div style="clear:both"></div>
					</div>

					<div style="background-color: #414141;">
						<div style="width:12%;float:left;margn-right:10px;">&nbsp;</div>
						<div style="width:25%;float:left;margn-right:10px;">Entry Arch 200 lights</div>

						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Garland']['Entry Arch 200 lights']['qty'])){ echo $inputs[6]['Garland']['Entry Arch 200 lights']['qty']; } ?>" name="inputs[6][Garland][Entry Arch 200 lights][qty]"></div>

						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Garland']['Entry Arch 200 lights']['level'])){ echo $inputs[6]['Garland']['Entry Arch 200 lights']['level']; } ?>" name="inputs[6][Garland][Entry Arch 200 lights][level]"></div>

						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Garland']['Entry Arch 200 lights']['rate'])){ echo $inputs[6]['Garland']['Entry Arch 200 lights']['rate']; } ?>" name="inputs[6][Garland][Entry Arch 200 lights][rate]"></div>

						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Garland']['Entry Arch 200 lights']['sc'])){ echo $inputs[6]['Garland']['Entry Arch 200 lights']['sc']; } ?>" name="inputs[6][Garland][Entry Arch 200 lights][sc]"></div>

						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Garland']['Entry Arch 200 lights']['pricing'])){ echo $inputs[6]['Garland']['Entry Arch 200 lights']['pricing']; } ?>" name="inputs[6][Garland][Entry Arch 200 lights][pricing]"></div>

						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Garland']['Entry Arch 200 lights']['earlypricing'])){ echo $inputs[6]['Garland']['Entry Arch 200 lights']['earlypricing']; } ?>" name="inputs[6][Garland][Entry Arch 200 lights][earlypricing]"></div>
						<div style="clear:both"></div>
					</div>

					<div>
						<div style="width:12%;float:left;margn-right:10px;">Wreaths</div>
						<div style="width:25%;float:left;margn-right:10px;">30" Prelit over Door</div>
						

						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Wreaths']['30" Prelit over Door']['qty'])){ echo $inputs[6]['Wreaths']['30" Prelit over Door']['qty']; } ?>" name='inputs[6][Wreaths][30" Prelit over Door][qty]'></div>

						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Wreaths']['30" Prelit over Door']['level'])){ echo $inputs[6]['Wreaths']['30" Prelit over Door']['level']; } ?>" name='inputs[6][Wreaths][30" Prelit over Door][level]'></div>

						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Wreaths']['30" Prelit over Door']['rate'])){ echo $inputs[6]['Wreaths']['30" Prelit over Door']['rate']; } ?>" name='inputs[6][Wreaths][30" Prelit over Door][rate]'></div>

						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Wreaths']['30" Prelit over Door']['sc'])){ echo $inputs[6]['Wreaths']['30" Prelit over Door']['sc']; } ?>" name='inputs[6][Wreaths][30" Prelit over Door][sc]'></div>

						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Wreaths']['30" Prelit over Door']['pricing'])){ echo $inputs[6]['Wreaths']['30" Prelit over Door']['pricing']; } ?>" name='inputs[6][Wreaths][30" Prelit over Door][pricing]'></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Wreaths']['30" Prelit over Door']['earlypricing'])){ echo $inputs[6]['Wreaths']['30" Prelit over Door']['earlypricing']; } ?>" name='inputs[6][Wreaths][30" Prelit over Door][earlypricing]'></div>
						<div style="clear:both"></div>
					</div>

					<div style="background-color: #414141;">
						<div style="width:12%;float:left;margn-right:10px;">&nbsp;</div>
						<div style="width:25%;float:left;margn-right:10px;">(w/50 lights)</div>
						
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Wreaths']['(w/50 lights)']['qty'])){ echo $inputs[6]['Wreaths']['(w/50 lights)']['qty']; } ?>" name='inputs[6][Wreaths][(w/50 lights)][qty]'></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Wreaths']['(w/50 lights)']['level'])){ echo $inputs[6]['Wreaths']['(w/50 lights)']['level']; } ?>" name='inputs[6][Wreaths][(w/50 lights)][level]'></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Wreaths']['(w/50 lights)']['rate'])){ echo $inputs[6]['Wreaths']['(w/50 lights)']['rate']; } ?>" name='inputs[6][Wreaths][(w/50 lights)][rate]'></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Wreaths']['(w/50 lights)']['sc'])){ echo $inputs[6]['Wreaths']['(w/50 lights)']['sc']; } ?>" name='inputs[6][Wreaths][(w/50 lights)][sc]'></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Wreaths']['(w/50 lights)']['pricing'])){ echo $inputs[6]['Wreaths']['(w/50 lights)']['pricing']; } ?>" name='inputs[6][Wreaths][(w/50 lights)][pricing]'></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Wreaths']['(w/50 lights)']['earlypricing'])){ echo $inputs[6]['Wreaths']['(w/50 lights)']['earlypricing']; } ?>" name='inputs[6][Wreaths][(w/50 lights)][earlypricing]'></div>
						<div style="clear:both"></div>
					</div>

					<div>
						<div style="width:12%;float:left;margn-right:10px;">Bows</div>
						<div style="width:25%;float:left;margn-right:10px;">Small on Entry Garland</div>
						
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Bows']['Small on Entry Garland']['qty'])){ echo $inputs[6]['Bows']['Small on Entry Garland']['qty']; } ?>" name='inputs[6][Bows][Small on Entry Garland][qty]'></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Bows']['Small on Entry Garland']['level'])){ echo $inputs[6]['Bows']['Small on Entry Garland']['level']; } ?>" name='inputs[6][Bows][Small on Entry Garland][level]'></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Bows']['Small on Entry Garland']['rate'])){ echo $inputs[6]['Bows']['Small on Entry Garland']['rate']; } ?>" name='inputs[6][Bows][Small on Entry Garland][rate]'></div>
						<div style="width:8%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Bows']['Small on Entry Garland']['sc'])){ echo $inputs[6]['Bows']['Small on Entry Garland']['sc']; } ?>" name='inputs[6][Bows][Small on Entry Garland][sc]'></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Bows']['Small on Entry Garland']['pricing'])){ echo $inputs[6]['Bows']['Small on Entry Garland']['pricing']; } ?>" name='inputs[6][Bows][Small on Entry Garland][pricing]'></div>
						<div style="width:10%;float:left;margn-right:10px;"><input type="text" style="width:60px"  value="<?php if(isset($inputs[6]['Bows']['Small on Entry Garland']['earlypricing'])){ echo $inputs[6]['Bows']['Small on Entry Garland']['earlypricing']; } ?>" name='inputs[6][Bows][Small on Entry Garland][earlypricing]'></div>
						<div style="clear:both"></div>
					</div>

					<div>
						<div style="">Instructions / Notes: (These would not print for customer)<br/></div>
					</div>

					<div>
						<div style=""><textarea rows="4" name="notes" cols="15"><?php if(isset($proposal['notes'])){ echo stripslashes($proposal['notes']); } ?></textarea><br/></div>
					</div>


					<div class="modal-footer clights_pane">
						<a class="btn btn-danger clights_caps" href="dealerDownloadPDF.php?projectid=<?php echo $projectid; ?>">Save Quote As PDF</a>
						<input type="submit" name="save" value="Save" class="btn btn-success clights_caps"/>
					</div>
			</form>
		</div>
  
 </BODY>
</HTML>

