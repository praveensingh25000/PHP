<?php
session_start();//----------Created By Ashish Gupta------------------------//
include("../../include/myconn.php");
//----------------------------------------------------//
include($DOC_ROOT.'/classes/user/userClass.php');
include($DOC_ROOT.'/classes/user/communityClass.php'); 

$u_info=@$_SESSION['u_info'];

if(empty($u_info))
{
	header('Location:'.$URL_SITE.'/index.php');
}

$login_id=$u_info['user_id'];
$cmid=$_GET['cmid'];

//-------------function to parse strings to xml-----------// 
function parseToXML($htmlStr) 
{ 
  $xmlStr=str_replace('<','&lt;',$htmlStr); 
  $xmlStr=str_replace('>','&gt;',$xmlStr); 
  $xmlStr=str_replace('"','&quot;',$xmlStr); 
  $xmlStr=str_replace("'",'&#39;',$xmlStr); 
  $xmlStr=str_replace("&",'&amp;',$xmlStr); 
  return $xmlStr; 
}

$com_member_res=Community::selectCommunityId($cmid);
$total_com_member = mysql_num_rows($com_member_res);

//Start XML file, echo parent node
header("Content-type: text/xml");
echo "<?xml version='1.0' encoding='ISO-8859-1'?>";
echo "<markers>\n";

if($total_com_member>0)
{
	while($row=mysql_fetch_assoc($com_member_res))
	{
		$member_id=$row['user_id'];
		
		//function to select user's information from markers table...
		$query=user::viewMarkerDetails($member_id);
		$row1=mysql_fetch_assoc($query);		
		
		if(!empty($row1['hometown']) && !empty($row1['state']) && !empty($row1['country']))
		{
			$address=$row1['hometown'].",".$row1['state'].",".$row1['country'];
			$user=user::selectUserProfile($row1['id']);
			
			if(!empty($user))
			{
				if($user['user_image']!='')
				{
					$imagename=$user['user_image'];	
				}
				else
				{
					$imagename='nophoto.jpg';	
				}	
			
				if($login_id==$user['user_id'])
				{
					$name=$user['firstname'].' '.$user['lastname']."(Me)";
				}
				else
				{
					$name=$user['firstname'].' '.$user['lastname'];
				}
			}

			$latitude=$row1['lat'];
			$longitude=$row1['lng'];

			echo '<marker ';
			echo 'userid="' .parseToXML($row1['id']).'" ';
			echo 'address="' .parseToXML($address).'" ';
			echo 'name="' .parseToXML($name).'" ';
			echo 'imagename="' .parseToXML($imagename).'" ';
			echo 'lat="' .parseToXML($latitude).'" ';
			echo 'lng="' .parseToXML($longitude).'"';
			echo "/>";
		}
	}	
} 

 // End XML file
echo "</markers>\n";
?>