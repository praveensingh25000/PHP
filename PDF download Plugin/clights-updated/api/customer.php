<?php
$db = new PDO('sqlite:db.sqlite3');

//$sth = $db->prepare('SELECT * FROM projects WHERE customer = ? LIMIT 1;');
//$sth->execute(array(
//	0 => intval($id)
//));
//$res = $sth->fetchAll(PDO::FETCH_CLASS);

$sth = $db->prepare('SELECT * FROM layers LIMIT 1');
$sth->execute();
$res = $sth->fetchAll(PDO::FETCH_CLASS);

//echo "<pre>";
//print_r($res);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
 <HEAD>
  <TITLE> New Document </TITLE>
  <META NAME="Generator" CONTENT="EditPlus">
  <META NAME="Author" CONTENT="">
  <META NAME="Keywords" CONTENT="">
  <META NAME="Description" CONTENT="">
 </HEAD>

 <BODY>

	<h1>DECORATING SERVICE PROPOSAL</h2>

	<form>
		<table width="80%" border = '1'>
			<tr>
				<th>Contact:</th>
				<td><input type="text" name="contact" /></td>
				<th>Appt Time</th>
				<td><input type="text" name="appttime" /></td>
			</tr>
			<tr>
				<th>Installation</th>
				<td><input type="text" name="installation" /></td>
				<th>Daytime Decor</th>
				<td><input type="text" name="daytime" /></td>
			</tr>
			<tr>
				<th>Date Sold</th>
				<td><input type="text" name="datesold" /></td>
				<th>Take Down</th>
				<td><input type="text" name="takedown" /></td>
			</tr>
		</table>
		<br/><br/>

		<table width="80%" border = '1'>
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
				<th colspan="10">Roof Lighting</th>
			</tr>

			<tr>
				<td>Facia</td>
				<td>Front</td>
				<td><input type="text" value="" name="inputs[1][Facia][Front][mapcode]"></td>
				<td><input type="text" value="" name="inputs[1][Facia][Front][location]"></td>
				<td><input type="text" value="" name="inputs[1][Facia][Front][color]"></td>
				<td><input type="text" value="" name="inputs[1][Facia][Front][qty]"></td>
				<td><input type="text" value="" name="inputs[1][Facia][Front][level]"></td>
				<td><input type="text" value="" name="inputs[1][Facia][Front][rate]"></td>
				<td><input type="text" value="" name="inputs[1][Facia][Front][sc]"></td>
				<td><input type="text" value="" name="inputs[1][Facia][Front][pricing]"></td>
				<td><input type="text" value="" name="inputs[1][Facia][Front][earlypricing]"></td>
			</tr>

			<tr>
				<td>Ridges</td>
				<td>Front</td>
				<td><input type="text" value="" name="inputs[1][Ridges][Front][mapcode]"></td>
				<td><input type="text" value="" name="inputs[1][Ridges][Front][location]"></td>
				<td><input type="text" value="" name="inputs[1][Ridges][Front][color]"></td>
				<td><input type="text" value="" name="inputs[1][Ridges][Front][qty]"></td>
				<td><input type="text" value="" name="inputs[1][Ridges][Front][level]"></td>
				<td><input type="text" value="" name="inputs[1][Ridges][Front][rate]"></td>
				<td><input type="text" value="" name="inputs[1][Ridges][Front][sc]"></td>
				<td><input type="text" value="" name="inputs[1][Ridges][Front][pricing]"></td>
				<td><input type="text" value="" name="inputs[1][Ridges][Front][earlypricing]"></td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td>West Side</td>
				<td><input type="text" value="" name="inputs[1][Ridges][West Side][mapcode]"></td>
				<td><input type="text" value="" name="inputs[1][Ridges][West Side][location]"></td>
				<td><input type="text" value="" name="inputs[1][Ridges][West Side][color]"></td>
				<td><input type="text" value="" name="inputs[1][Ridges][West Side][qty]"></td>
				<td><input type="text" value="" name="inputs[1][Ridges][West Side][level]"></td>
				<td><input type="text" value="" name="inputs[1][Ridges][West Side][rate]"></td>
				<td><input type="text" value="" name="inputs[1][Ridges][West Side][sc]"></td>
				<td><input type="text" value="" name="inputs[1][Ridges][West Side][pricing]"></td>
				<td><input type="text" value="" name="inputs[1][Ridges][West Side][earlypricing]"></td>
			</tr>

			<tr>
				<th colspan="10">Windows / Features</th>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td>2 Arched</td>
				<td><input type="text" value="" name="inputs[2][1][2 Arched][mapcode]"></td>
				<td><input type="text" value="" name="inputs[2][1][2 Arched][location]"></td>
				<td><input type="text" value="" name="inputs[2][1][2 Arched][color]"></td>
				<td><input type="text" value="" name="inputs[2][1][2 Arched][qty]"></td>
				<td><input type="text" value="" name="inputs[2][1][2 Arched][level]"></td>
				<td><input type="text" value="" name="inputs[2][1][2 Arched][rate]"></td>
				<td><input type="text" value="" name="inputs[2][1][2 Arched][sc]"></td>
				<td><input type="text" value="" name="inputs[2][1][2 Arched][pricing]"></td>
				<td><input type="text" value="" name="inputs[2][1][2 Arched][earlypricing]"></td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td>2 Square</td>
				<td><input type="text" value="" name="inputs[2][2][2 Square][mapcode]"></td>
				<td><input type="text" value="" name="inputs[2][2][2 Square][location]"></td>
				<td><input type="text" value="" name="inputs[2][2][2 Square][color]"></td>
				<td><input type="text" value="" name="inputs[2][2][2 Square][qty]"></td>
				<td><input type="text" value="" name="inputs[2][2][2 Square][level]"></td>
				<td><input type="text" value="" name="inputs[2][2][2 Square][rate]"></td>
				<td><input type="text" value="" name="inputs[2][2][2 Square][sc]"></td>
				<td><input type="text" value="" name="inputs[2][2][2 Square][pricing]"></td>
				<td><input type="text" value="" name="inputs[2][2][2 Square][earlypricing]"></td>
			</tr>


			<tr>
				<th colspan="10">Tree Lighting</th>
			</tr>

			<tr>
				<td>Canopy</td>
				<td>Red Oak</td>
				<td><input type="text" value="" name="inputs[3][Canopy][Red Oak][mapcode]"></td>
				<td><input type="text" value="" name="inputs[3][Canopy][Red Oak][location]"></td>
				<td><input type="text" value="" name="inputs[3][Canopy][Red Oak][color]"></td>
				<td><input type="text" value="" name="inputs[3][Canopy][Red Oak][qty]"></td>
				<td><input type="text" value="" name="inputs[3][Canopy][Red Oak][level]"></td>
				<td><input type="text" value="" name="inputs[3][Canopy][Red Oak][rate]"></td>
				<td><input type="text" value="" name="inputs[3][Canopy][Red Oak][sc]"></td>
				<td><input type="text" value="" name="inputs[3][Canopy][Red Oak][pricing]"></td>
				<td><input type="text" value="" name="inputs[3][Canopy][Red Oak][earlypricing]"></td>
			</tr>

			<tr>
				<td>Trunk</td>
				<td>Live Oak</td>
				<td><input type="text" value="" name="inputs[3][Trunk][Live Oak][mapcode]"></td>
				<td><input type="text" value="" name="inputs[3][Trunk][Live Oak][location]"></td>
				<td><input type="text" value="" name="inputs[3][Trunk][Live Oak][color]"></td>
				<td><input type="text" value="" name="inputs[3][Trunk][Live Oak][qty]"></td>
				<td><input type="text" value="" name="inputs[3][Trunk][Live Oak][level]"></td>
				<td><input type="text" value="" name="inputs[3][Trunk][Live Oak][rate]"></td>
				<td><input type="text" value="" name="inputs[3][Trunk][Live Oak][sc]"></td>
				<td><input type="text" value="" name="inputs[3][Trunk][Live Oak][pricing]"></td>
				<td><input type="text" value="" name="inputs[3][Trunk][Live Oak][earlypricing]"></td>
			</tr>

			<tr>
				<th colspan="10">Shrubs</th>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td>3 Hollies</td>
				<td><input type="text" value="" name="inputs[4][1][3 Hollies][mapcode]"></td>
				<td><input type="text" value="" name="inputs[4][1][3 Hollies][location]"></td>
				<td><input type="text" value="" name="inputs[4][1][3 Hollies][color]"></td>
				<td><input type="text" value="" name="inputs[4][1][3 Hollies][qty]"></td>
				<td><input type="text" value="" name="inputs[4][1][3 Hollies][level]"></td>
				<td><input type="text" value="" name="inputs[4][1][3 Hollies][rate]"></td>
				<td><input type="text" value="" name="inputs[4][1][3 Hollies][sc]"></td>
				<td><input type="text" value="" name="inputs[4][1][3 Hollies][pricing]"></td>
				<td><input type="text" value="" name="inputs[4][1][3 Hollies][earlypricing]"></td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td>2 Boxwoods</td>
				<td><input type="text" value="" name="inputs[4][2][2 Boxwoods][mapcode]"></td>
				<td><input type="text" value="" name="inputs[4][2][2 Boxwoods][location]"></td>
				<td><input type="text" value="" name="inputs[4][2][2 Boxwoods][color]"></td>
				<td><input type="text" value="" name="inputs[4][2][2 Boxwoods][qty]"></td>
				<td><input type="text" value="" name="inputs[4][2][2 Boxwoods][level]"></td>
				<td><input type="text" value="" name="inputs[4][2][2 Boxwoods][rate]"></td>
				<td><input type="text" value="" name="inputs[4][2][2 Boxwoods][sc]"></td>
				<td><input type="text" value="" name="inputs[4][2][2 Boxwoods][pricing]"></td>
				<td><input type="text" value="" name="inputs[4][2][2 Boxwoods][earlypricing]"></td>
			</tr>

			<tr>
				<th colspan="10">Ground Lighting</th>
			</tr>

			<tr>
				<td>Stakes</td>
				<td>Curved Walk</td>
				<td><input type="text" value="" name="inputs[5][Stakes][Curved Walk][mapcode]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Curved Walk][location]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Curved Walk][color]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Curved Walk][qty]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Curved Walk][level]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Curved Walk][rate]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Curved Walk][sc]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Curved Walk][pricing]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Curved Walk][earlypricing]"></td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td>Bed</td>
				<td><input type="text" value="" name="inputs[5][Stakes][Bed][mapcode]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Bed][location]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Bed][color]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Bed][qty]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Bed][level]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Bed][rate]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Bed][sc]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Bed][pricing]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Bed][earlypricing]"></td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td>Parkway</td>
				<td><input type="text" value="" name="inputs[5][Stakes][Parkway][mapcode]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Parkway][location]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Parkway][color]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Parkway][qty]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Parkway][level]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Parkway][rate]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Parkway][sc]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Parkway][pricing]"></td>
				<td><input type="text" value="" name="inputs[5][Stakes][Parkway][earlypricing]"></td>
			</tr>



			<tr>
				<th colspan="10">Daytime Decor</th>
			</tr>

			<tr>
				<td>Garland</td>
				<td>Door</td>
				<td><input type="text" value="" name="inputs[6][Garland][Door][mapcode]"></td>
				<td><input type="text" value="" name="inputs[6][Garland][Door][location]"></td>
				<td><input type="text" value="" name="inputs[6][Garland][Door][color]"></td>
				<td><input type="text" value="" name="inputs[6][Garland][Door][qty]"></td>
				<td><input type="text" value="" name="inputs[6][Garland][Door][level]"></td>
				<td><input type="text" value="" name="inputs[6][Garland][Door][rate]"></td>
				<td><input type="text" value="" name="inputs[6][Garland][Door][sc]"></td>
				<td><input type="text" value="" name="inputs[6][Garland][Door][pricing]"></td>
				<td><input type="text" value="" name="inputs[6][Garland][Door][earlypricing]"></td>
			</tr>

			<tr>
				<td>&nbsp;</td>
				<td>Entry Arch 200 lights</td>
				<td><input type="text" value="" name="inputs[6][Garland][Entry Arch 200 lights][mapcode]"></td>
				<td><input type="text" value="" name="inputs[6][Garland][Entry Arch 200 lights][location]"></td>
				<td><input type="text" value="" name="inputs[6][Garland][Entry Arch 200 lights][color]"></td>
				<td><input type="text" value="" name="inputs[6][Garland][Entry Arch 200 lights][qty]"></td>
				<td><input type="text" value="" name="inputs[6][Garland][Entry Arch 200 lights][level]"></td>
				<td><input type="text" value="" name="inputs[6][Garland][Entry Arch 200 lights][rate]"></td>
				<td><input type="text" value="" name="inputs[6][Garland][Entry Arch 200 lights][sc]"></td>
				<td><input type="text" value="" name="inputs[6][Garland][Entry Arch 200 lights][pricing]"></td>
				<td><input type="text" value="" name="inputs[6][Garland][Entry Arch 200 lights][earlypricing]"></td>
			</tr>

			<tr>
				<td>Wreaths</td>
				<td>30" Prelit over Door</td>
				<td><input type="text" value="" name='inputs[6][Wreaths][30" Prelit over Door][mapcode]'></td>
				<td><input type="text" value="" name='inputs[6][Wreaths][30" Prelit over Door][location]'></td>
				<td><input type="text" value="" name='inputs[6][Wreaths][30" Prelit over Door][color]'></td>
				<td><input type="text" value="" name='inputs[6][Wreaths][30" Prelit over Door][qty]'></td>
				<td><input type="text" value="" name='inputs[6][Wreaths][30" Prelit over Door][level]'></td>
				<td><input type="text" value="" name='inputs[6][Wreaths][30" Prelit over Door][rate]'></td>
				<td><input type="text" value="" name='inputs[6][Wreaths][30" Prelit over Door][sc]'></td>
				<td><input type="text" value="" name='inputs[6][Wreaths][30" Prelit over Door][pricing]'></td>
				<td><input type="text" value="" name='inputs[6][Wreaths][30" Prelit over Door][earlypricing]'></td>
			</tr>

			<tr>
				<td>Wreaths</td>
				<td>(w/50 lights)</td>
				<td><input type="text" value="" name='inputs[6][Wreaths][(w/50 lights)][mapcode]'></td>
				<td><input type="text" value="" name='inputs[6][Wreaths][(w/50 lights)][location]'></td>
				<td><input type="text" value="" name='inputs[6][Wreaths][(w/50 lights)][color]'></td>
				<td><input type="text" value="" name='inputs[6][Wreaths][(w/50 lights)][qty]'></td>
				<td><input type="text" value="" name='inputs[6][Wreaths][(w/50 lights)][level]'></td>
				<td><input type="text" value="" name='inputs[6][Wreaths][(w/50 lights)][rate]'></td>
				<td><input type="text" value="" name='inputs[6][Wreaths][(w/50 lights)][sc]'></td>
				<td><input type="text" value="" name='inputs[6][Wreaths][(w/50 lights)][pricing]'></td>
				<td><input type="text" value="" name='inputs[6][Wreaths][(w/50 lights)][earlypricing]'></td>
			</tr>

			<tr>
				<td>Bows</td>
				<td>Small on Entry Garland</td>
				<td><input type="text" value="" name='inputs[6][Bows][Small on Entry Garland][mapcode]'></td>
				<td><input type="text" value="" name='inputs[6][Bows][Small on Entry Garland][location]'></td>
				<td><input type="text" value="" name='inputs[6][Bows][Small on Entry Garland][color]'></td>
				<td><input type="text" value="" name='inputs[6][Bows][Small on Entry Garland][qty]'></td>
				<td><input type="text" value="" name='inputs[6][Bows][Small on Entry Garland][level]'></td>
				<td><input type="text" value="" name='inputs[6][Bows][Small on Entry Garland][rate]'></td>
				<td><input type="text" value="" name='inputs[6][Bows][Small on Entry Garland][sc]'></td>
				<td><input type="text" value="" name='inputs[6][Bows][Small on Entry Garland][pricing]'></td>
				<td><input type="text" value="" name='inputs[6][Bows][Small on Entry Garland][earlypricing]'></td>
			</tr>

			
		</table>

  
 </BODY>
</HTML>

