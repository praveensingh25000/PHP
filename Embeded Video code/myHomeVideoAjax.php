<?php 
/******************************************
* @Modified on December 12,Oct  2011
* @Package: nymbee
* @Developer: Praveen Singh
* @URL : http://www.nymbee.com
********************************************/

$basedir = dirname(__FILE__) . '/../../';
include($basedir.'include/actionHeader.php');

if(isset($_SESSION['u_info']) && !isset($_REQUEST['frndid']))
{
	$user_id = $_SESSION['u_info']['user_id'];
	$sel_vedios = Video::selectLatestvedios($user_id);
	$totalVedios = Video::selectNumVedios($user_id);	
	$userdata = user::selectUserProfile($user_id);	
}
elseif(isset($_SESSION['u_info']) && isset($_REQUEST['frndid']))
{
	$user_id = $_REQUEST['frndid'];	
	include($DOC_ROOT.'/front/videos/showVideo.php');
	
	if(!empty($visible_videos_data))
	{		
		$sel_vedios= $visible_videos_data[0];			
		$totalVedios = Video::selectNumVedios($user_id);	
		$userdata = user::selectUserProfile($user_id);	
	}
}   
elseif(!isset($_SESSION['u_info'])) 
{ }

//----IF NO VEDIOS------->
if(empty($sel_vedios))
{?>
	<h2 class="pagetitle"><?=NO_NEW_VEDIOS_LANG?></h2>
<?php
}
else
{
	$res_vedioOut = VideoFile::selectVideo($sel_vedios);
	while($recAdded_vedio=mysql_fetch_assoc($res_vedioOut))
	{
		//echo "<pre>"; print_r($recAdded_vedio);die;
		
		$videoname=$recAdded_vedio['video_name'];
		$path=$recAdded_vedio['path'];
		$videoimagepath=$recAdded_vedio['image_path'];
		$videovname=trim($recAdded_vedio['video_name']);
		$replace = array(" ");
		$videvoname = str_replace($replace, "_",$videovname);		
		$user_id = $recAdded_vedio['user_id'];		
		$videoName=ucwords($recAdded_vedio['video_name']);
		$vedioDiscription = substr($recAdded_vedio['description'],0,200);
		$datauser = user::selectUserProfile($user_id);
		$name = $datauser['firstname']." ".$datauser['lastname']." ";
		$tstamp = strtotime($recAdded_vedio['added_on']);
		$time=date_diff_hour_min($tstamp); 
		$video_id =$recAdded_vedio['video_id'];

		//Allow Commenting and Rating
		if(isset($_SESSION['u_info']['user_id']) && isset($_GET['frndid'])) 
		{			
				$friend_id = $_GET['frndid'];

				if(($recAdded_vedio['comment_status'] == "Al") || ($recAdded_vedio['comment_status'] == "E")) 
				{
					$commentAllow = 1;
				}
				else 
				{
					$commentAllow = VideoFile::selectAllowedCommenting($_SESSION['u_info']['user_id'],$friend_id,$video_id);
				}

				if(($recAdded_vedio['rate_status'] == "Al") || ($recAdded_vedio['rate_status'] == "E")) 
				{
					$ratingAllow = 1;
				}
				else 
				{
				//$res_rate = VideoFile::count1($res_rate);
				$ratingAllow = VideoFile::selectAllowedRating($_SESSION['u_info']['user_id'],$friend_id,$video_id);
				}
		}
		elseif(isset($_SESSION['u_info']['user_id']) && !isset($_GET['frndid'])) 
		{
			$commentAllow = 1;
			$ratingAllow = 1;
		}
		else 
		{
			$commentAllow=0;
			$ratingAllow=0;
		}

		//rating part
		$avarage_rate_id=user::ratingCalculation($tablename='video_rates',$main_col_name='video_id',$main_col_value=$video_id);							
		$rate_image=AlbumRate::rateimage($avarage_rate_id);
?>

<!--Discription One-->
<div class="discriptiontxt">
	<h4 class="greytitle">
		<?php
		if((isset($_SESSION['u_info']))&&(!isset($_REQUEST['frndid']))) 
		{
			echo ALBUM_LATEST_LANG; 
		}
		elseif((isset($_SESSION['u_info']))&&(isset($_REQUEST['frndid'])))
		{ 
			echo $name=ucwords($userdata['firstname'].''.USER_VIDEOS); 
		}
		else 		
		{ 		
			echo MADUHAA_S_VIDEO;		
		}
		?>
	</h4>

	<div class="imagediv">
		<div class="bdrimg">
			<?php
			if((isset($_SESSION['u_info']))&&(!isset($_REQUEST['frndid']))) { ?>
				<a href="<?=$URL_SITE?>/front/user/profile.php">
				<img alt="" src="<?=$URL_SITE?>/classes/show_image.php?filename=../images/user/<?=$datauser['user_image']?>&width=57px&height=56px"></a>
			<?php
			}
			elseif((isset($_SESSION['u_info']))&&(isset($_REQUEST['frndid'])))
			{?>
				<a href="<?=$URL_SITE?>/front/user/profile.php?frndid=<?=$datauser['user_id']?>">
				<img alt="" src="<?=$URL_SITE?>/classes/show_image.php?filename=../images/user/<?=$datauser['user_image']?>&width=57px&height=56px"></a>
			<?php
			}
			?>		
		</div>
	</div>
	<div class="textmain">
		<div class="textmain1">
			<div class="textmain1L">
				<h5>
					<a href="<?=$URL_SITE?>/front/videos/viewallvideos.php?alid=<?=$video_id;if((isset($_SESSION['u_info']) && isset($_REQUEST['frndid'])) && ($_SESSION['u_info']['user_id']!=$_REQUEST['frndid'])){?>&frndid=<?php echo $_REQUEST['frndid'];}?>" class="txtblue">
						<?php									
						$fetch_name=ucwords(substr($recAdded_vedio['video_name'],0,14));		 
						if($fetch_name=='Sqwaukboxvideo')
						{										
							echo SQWUAKED_VIDEO;
						}
						else
						{									
							echo $fetch=ucwords($recAdded_vedio['video_name']);
						}
						?>
					</a>				
				</h5>
				<?php 
				if($recAdded_vedio['isEmbed']==0 && $vedioDiscription!='')
				{
					echo QUOTE_LANG.' '.$vedioDiscription.' '.QUOTE_LANG;
					echo '<br>';
				}
				?>				
				<?=$time?>
			</div>

			<!--- Rating Div Starts -->
			<div class="staricon" id="Vedio_rate_dataDiv_<?=$video_id?>"  style="display: block">
				<div class="" id="Vedio_Rate_img_<?=$video_id?>" style="display: block">
					<img src="<?=$URL_SITE?>/images/<?=$rate_image?>" alt=""/>
				</div>

				<input type="hidden" id="usr_id" value="<?=$_SESSION['u_info']['user_id']?>">

				<div class="staricon" id="Vedio_Rate_<?=$video_id?>" style="display:none">
					<input class="star_event_<?=$video_id?> {split:2}" type="radio" name="rating_video_<?=$video_id?>" value="0.5"/>
					<input class="star_event_<?=$video_id?> {split:2}" type="radio" name="rating_video_<?=$video_id?>" value="1.0"/>
					<input class="star_event_<?=$video_id?> {split:2}" type="radio" name="rating_video_<?=$video_id?>" value="1.5"/>
					<input class="star_event_<?=$video_id?> {split:2}" type="radio" name="rating_video_<?=$video_id?>" value="2.0"/>
					<input class="star_event_<?=$video_id?> {split:2}" type="radio"	name="rating_video_<?=$video_id?>" value="2.5"/>
					<input class="star_event_<?=$video_id?> {split:2}" type="radio" name="rating_video_<?=$video_id?>" value="3.0"/>
					<input class="star_event_<?=$video_id?> {split:2}" type="radio" name="rating_video_<?=$video_id?>" value="3.5" />
					<input class="star_event_<?=$video_id?> {split:2}" type="radio" name="rating_video_<?=$video_id?>" value="4.0"/>
					<input class="star_event_<?=$video_id?> {split:2}" type="radio" name="rating_video_<?=$video_id?>" value="4.5"/>
					<input class="star_event_<?=$video_id?> {split:2}" type="radio" name="rating_video_<?=$video_id?>" value="5.0"/>
			
					<script>jQuery(function()
					{ // wait for document to load
					jQuery("input.star_event_<?=$video_id?>").rating();
					});
					</script>
				</div>
			</div>


			<script>
			jQuery(document).ready(function(){
				jQuery("#Vedio_Recent_Rate_<?=$video_id?>").click(function(){
					jQuery("#Vedio_Rate_<?=$video_id?>").show();
					jQuery("#Vedio_Rate_img_<?=$video_id?>").hide();
				});
				
				jQuery("#Vedio_Rate_<?=$video_id?>").click(function(){
					var ratid="";
					var ratid=jQuery("input[type='radio'][name='rating_video_<?=$video_id?>']:checked").val();
					var userid=jQuery("#usr_id").val();
					var videoid="<?=$video_id?>";
				
					jQuery.ajax({
						type: "GET",
						url: "<?=$URL_SITE?>/front/videos/videoRate.php?ajax=1&rate_id="+ratid+"&usrid="+userid+"&videoid="+videoid,
							
						success: function(msg)
						{
							 jQuery("#Vedio_Rate_img_<?=$video_id?>").html(msg);
							 jQuery("#Vedio_Rate_img_<?=$video_id?>").show();
							 jQuery("#Vedio_Rate_<?=$video_id?>").hide();
						}
					});

				});
				
			});
			</script>
			<!--- Rating Div Ends -->

		 <br class="clear" />
		</div>
		<!--Photo Gallery-->
		<div class="videogalleryshow pT20">
			<!--Left-->
					<div class="videoshowing">				
						<?php
						if($recAdded_vedio['isEmbed']=='0')
						{
							//$skin_clr=$usr_color_dir['color_dir'];
							$skin_clr="default";
							?>						
							<div id='mediaspace_<?=$video_id?>'><?=REPLACE_TEXT?></div>

							<script type='text/javascript'>
								var so = new SWFObject('<?=$URL_SITE?>/images/videos/skin/player-viral.swf','mpl','100%','320','9');
								so.addParam('allowfullscreen','true');
								so.addParam('allowscriptaccess','always');
								so.addParam('wmode','opaque');
								so.addVariable('file','<?=$URL_SITE?>/images/videos/<?=$user_id?>/<?=$videvoname?>/<?=$path?>&image=preview.jpg');
								so.addVariable('image','<?=$URL_SITE?>/images/videos/<?=$user_id?>/<?=$videvoname?>/<?=$videoimagepath?>');
								so.addVariable('frontcolor','990000');
								so.addVariable('lightcolor','666666');
								so.addVariable('screencolor','EEEEEE');
								so.addVariable('skin','<?=$URL_SITE?>/js/100702-Maduhaa-<?=$skin_clr?>-v0.swf');
								so.write('mediaspace_<?=$video_id?>');
							</script>

						<?php
						}
						else
						{ 
							echo $recAdded_vedio['embedcode'];
						}
						?>						
					</div>
					
					<div class="photogalleryshowL">
						<ul>
							<li>
								<a id="likesVed_<?=$video_id?>" href="javascript:;" onclick="javascript: funlikesDislikeVedio(1,<?=$video_id?>);"><?=LIKE?></a>
							</li> 
							<li>|</li> 
							<li>
								<a id="dislikesVed_<?=$video_id?>" href="javascript:;" onclick="javascript: funlikesDislikeVedio(0,<?=$video_id?>);"><?=DISLIKE?></a>
							</li>
							<li>|</li> 							
							<?php
							if($ratingAllow=='1')
							{?>
								<li>|</li> 
								<li>
									<a href="javascript:;" id="Vedio_Recent_Rate_<?=$video_id?>"><?=RATE?></a>
								</li>
							<?php
							}
							?>
						</ul>
						<br class="clear" />
					</div>

					<script language="javascript">
					function funlikesDislikeVedio(con,video_id)
					{
						var dataAjax = "likeVedioajax="+con+"&video_id="+video_id ;

						jQuery.ajax({
							type: "POST",
							data: dataAjax,
							url:URL_SITE+"/front/videos/videoLike.php",	

							success: function(msg)
							{	
								jQuery("#likesDislikesVed_"+video_id).html(msg);
							}
						});	
					}
					</script>

					<script language="javascript">
						jQuery(document).ready(function(){
						jQuery("#commentved_<?=$video_id?>").click(function(){
							jQuery("#comment_video_container_<?=$video_id?>").slideToggle("slow");
							});
						});
					</script>
			
			<!--/Left-->
			<br class="clear" />   
					
			<!--bottom-->
			<div id="likesDislikesVed_<?=$video_id?>" class="statusresultbutton1 right">
				<!---
				created:12/8/2011
				authur:PKS
				Purpose:for likes and dislikes of vedio both for ajax request and php call
				--->
				<?php
				
				include($DOC_ROOT.'/front/videos/videoLike.php');
				?>
								
			</div>
			<!--/!bottom---->
			
		 <br class="clear" />   
		</div>
		<!--/Photo Gallery-->
		
		<!--Comments-->	
		
			<!---
			created:12/6/2011
			authur:PKS
			Purpose:for likes and dislikes of album both for ajax request and php
			--->
			<?php
			if($commentAllow=='1')
			{
				include($DOC_ROOT.'/front/videos/showVideoComments.php');
			}
			?>
					 
		<!--/Comments-->	
		
		</div>
	</div>
	<!--/Discription One-->
	<br class="clear" />  
	<?php
	}
	?>

	<!--Discription Two-->
	<?php include('recentlyCommentedvedio.php');?>                       
	<!--/Discription Two--> 
	<br class="clear" />  

	<!--Discription Three-->
	<?php include('recentlyRatedvedio.php');?>
	<br class="clear" />					 
	<!--/Discription Three-->
<?php
}
?>