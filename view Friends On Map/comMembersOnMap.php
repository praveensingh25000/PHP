<?php
/******************************************
* @Modified on August 08, 2012
* @Package: Maduhaa
* @Developer: Praveen Singh
* @URL : http://www.maduhaa.com
********************************************/

//File is for displaying friends on map in a particular radius--------//
$basedir = dirname(__FILE__) . '/../../';
include($basedir.'/include/header.php');

ini_set("display_errors","2");
ERROR_REPORTING(E_ALL);	

$u_info=$_SESSION['u_info'];

if(empty($u_info))
{
	header('Location:'.$URL_SITE.'/indexNew.php');
}

$u_info=$_SESSION['u_info'];
$user_id=$u_info['user_id'];

if(!isset($_GET['cmid']))
{
	header('Location:'.$URL_SITE.'/front/community/viewAllCommunities.php');	
}
else
{
	$cmid=$_GET['cmid'];	
}
?>

<div class="containerleft">
<?php include($DOC_ROOT.'/include/leftNavLoged.php');?>
</div>

<!-- <script type="text/javascript" src="http://maps.google.com/maps?file=api&v=2&key=<?php echo $googleMapKey; ?>"></script> -->

<script src="https://maps.googleapis.com/maps/api/js?sensor=false&key=<?php echo $googleMapKey; ?>"></script>

<script type="text/javascript"> 	
	
	//<![CDATA[
	// this variable will collect the html which will eventually be placed in the side_bar 
	var side_bar_html = ""; 

	// arrays to hold copies of the markers and html used by the side_bar 
	// because the function closure trick doesnt work there 
	var gmarkers = []; 

	// global "map" variable
	var map = null;
	// A function to create the marker and set up the event window function 
	function createMarker(latlng, name, html,imagename,userid) {

		var contentString = '<div style="width:100% !important; padding-top:5px;padding-bottom:5px;"><div style="width:20%;float:left;"><div style="width:30px;height:25px;border:1px solid #d6d6d6;padding:2px;text-align:center;margin:auto;"><a href="'+URL_SITE+'/front/user/profile.php?frndid='+userid+'"><img src="'+URL_SITE+'/classes/show_image.php?filename=../images/user/'+imagename+'&width=30&height=25" alt="" /></a></div></div><div class="width:80%;float:left;"><a href="'+URL_SITE+'/front/user/profile.php?frndid='+userid+'">' + name + '<\/a>&nbsp;&nbsp;&nbsp;<p>'+html+'</p></div></div><div style="clear:both;"></div>'
		
		var marker = new google.maps.Marker({
			position: latlng,
			map: map,
			zIndex: Math.round(latlng.lat()*-100000)<<5
		});

		google.maps.event.addListener(marker, 'click', function() {
			infowindow.setContent(contentString); 
			infowindow.open(map,marker);
		});
		// save the info we need to use later for the side_bar
		gmarkers.push(marker);
		// add a line to the side_bar html
		
		//side_bar_html += '<b>'+name+'</b>&nbsp;&nbsp;<a href="javascript:myclick(' + (gmarkers.length-1) + ')">' + html + '<\/a><br>';

		//side_bar_html += '<h4><img src="" alt=""><a href="javascript:myclick(' + (gmarkers.length-1) + ')">' + name + '<\/a>&nbsp;&nbsp;&nbsp;'+html+'</h4>';
		
		return marker;
	}
 
	// This function picks up the click and opens the corresponding info window
	function myclick(i) {
	  google.maps.event.trigger(gmarkers[i], "click");
	}

	
	function initialize()
	{
		// create the map
		
		var myOptions = {
			zoom: 10,
			center: new google.maps.LatLng(0,0),
			mapTypeControl: true,
			mapTypeControlOptions: {style: google.maps.MapTypeControlStyle.DROPDOWN_MENU},
			navigationControl: true,
			mapTypeId: google.maps.MapTypeId.ROADMAP
		}

		map = new google.maps.Map(document.getElementById("map_canvas"),myOptions);

		google.maps.event.addListener(map, 'click', function() { infowindow.close();	});
		
		// Read the data from example.xml
		downloadUrl("ComMembersOnMapXml.php?cmid=<?php echo $cmid ?>", function(doc) {

			var xmlDoc = xmlParse(doc);
			var markers = xmlDoc.documentElement.getElementsByTagName("marker");
			for (var i = 0; i < markers.length; i++)
			{
				// obtain the attribues of each marker
				var lat = parseFloat(markers[i].getAttribute("lat"));
				var lng = parseFloat(markers[i].getAttribute("lng"));
				var point = new google.maps.LatLng(lat,lng);
				var html = markers[i].getAttribute("address");
				var label = markers[i].getAttribute("name");
				var imagename = markers[i].getAttribute("imagename");
				var userid = markers[i].getAttribute("userid");
				// create the marker
				var marker = createMarker(point,label,html,imagename,userid);

				var side_bar_html= '<div style="width:100% !important; padding-top:5px;padding-bottom:5px;"><div style="width:20%;float:left;"><div style="width:30px;height:25px;border:1px solid #d6d6d6;padding:2px;text-align:center;margin:auto;"><a href="javascript:myclick(' + (gmarkers.length-1) + ')"><img src="'+URL_SITE+'/classes/show_image.php?filename=../images/user/'+imagename+'&width=30&height=25" alt="" /></a></div></div><div class="width:80%;float:left;"><a href="javascript:myclick(' + (gmarkers.length-1) + ')">' + label + '<\/a>&nbsp;&nbsp;&nbsp;<p>'+html+'</p></div></div><div style="clear:both;"></div>';

				jQuery('#community_sidebar').append(side_bar_html);

				if(i == 0)
				{
					map.setCenter(new google.maps.LatLng(lat,lng));
					draw(marker);
				}
			}

			

			// put the assembled side_bar_html contents into the side_bar div
		});
		jQuery('#community_sidebar').empty();
		
	}
 
	var infowindow = new google.maps.InfoWindow({ 
		size: new google.maps.Size(150,50)
	});
	
	//calling Function initialize
	$(document).ready(function() {	initialize(); });
	    
	function draw(marker)
	{
		var givenQuality =80;
		var circle = new google.maps.Circle({
			map: map,
			radius: 20*1000 
		});
		circle.bindTo('center', marker, 'position');
	}	

	function setAllMap(map) 
	{
        for (var i = 0; i < gmarkers.length; i++)
		{
          gmarkers[i].setMap(map);
        }
     }

    // This Javascript is based on code provided by the
    // Community Church Javascript Team
    // http://www.bisphamchurch.org.uk/   
    // http://econym.org.uk/gmap/
    // from the v2 tutorial page at:
    // http://econym.org.uk/gmap/basic3.htm 
	//]]>


/**
* Returns an XMLHttp instance to use for asynchronous
* downloading. This method will never throw an exception, but will
* return NULL if the browser does not support XmlHttp for any reason.
* @return {XMLHttpRequest|Null}
*/
function createXmlHttpRequest() 
{
	try 
	{
		if (typeof ActiveXObject != 'undefined') 
		{
			return new ActiveXObject('Microsoft.XMLHTTP');
		} 
		else if (window["XMLHttpRequest"]) 
		{
			return new XMLHttpRequest();
		}
	} 
	catch (e)
	{
		changeStatus(e);
	}

	return null;
};

/**
* This functions wraps XMLHttpRequest open/send function.
* It lets you specify a URL and will call the callback if
* it gets a status code of 200.
* @param {String} url The URL to retrieve
* @param {Function} callback The function to call once retrieved.
*/
function downloadUrl(url, callback) 
{
	var status = -1;
	var request = createXmlHttpRequest();
	if (!request) {
	return false;
	}

	request.onreadystatechange = function() {
	if (request.readyState == 4) {
	 try {
	   status = request.status;
	 } catch (e) {
	   // Usually indicates request timed out in FF.
	 }
	 if ((status == 200) || (status == 0)) {
	   callback(request.responseText, request.status);
	   request.onreadystatechange = function() {};
	 }
	}
	}
	request.open('GET', url, true);
	try {
	request.send(null);
	} catch (e) {
	changeStatus(e);
	}
};

/**
 * Parses the given XML string and returns the parsed document in a
 * DOM data structure. This function will return an empty DOM node if
 * XML parsing is not supported in this browser.
 * @param {string} str XML string.
 * @return {Element|Document} DOM.
 */
function xmlParse(str) 
{
  if (typeof ActiveXObject != 'undefined' && typeof GetObject != 'undefined') {
    var doc = new ActiveXObject('Microsoft.XMLDOM');
    doc.loadXML(str);
    return doc;
  }

  if (typeof DOMParser != 'undefined') {
    return (new DOMParser()).parseFromString(str, 'text/xml');
  }

  return createElement('div', null);
}

/**
 * Appends a JavaScript file to the page.
 * @param {string} url
 */
function downloadScript(url) 
{
  var script = document.createElement('script');
  script.src = url;
  document.body.appendChild(script);
}

</script> 

<div class="containercenter wdthpercent82">
	<div class="containercentercnt ">

		<h2 class="pagetitle pT5">
			<a href="<?php echo $URL_SITE;?>/front/community/viewAllCommunities.php"><?php echo  COMMUNITY;?></a>
		</h2> 
		<br class="clear" />
		
		<div class="negmarginT pB10">
			<a class="txtblue" href="javascript:window.history.go(-1)"><?php echo BACK; ?></a></div> 
		<div class="clear"></div>

		<div class="nav">
			<ul>
				<li><a class="selected" href=" "><?php echo MEMBERS_ON_MAP;?></a></li>
			</ul>
		</div>	

		<div class="wdthpercent100">		
			<div id="" class="wdthpercent75 left pT10">
				<div id="map_canvas" style="width: 760px; height:720px; margin-right:50px;overflow:hidden">
				<h2 class="pagetitle txtcenter">Loading Map .....</h2>
				</div>	
			</div>

			<div id="" class="wdthpercent25 right">			
				
				<div id="" class="wdthpercent100">						
						<div id="" class="wdthpercent100">
							<h2 class="pagetitle pB10 noti"><?php echo COMMUNITY_MEMBERS;?></h2>	
						</div>
						<div id="" class="clear"></div>
						
						<div id="community_sidebar" class="wdthpercent100">
							<h4><?php echo COMMUNITY_MEMBERS;?>...</h4>
						</div>
										
				</div>				
			</div>
		</div>
	</div>
</div>

<?php include($basedir.'/include/footer.php'); ?>