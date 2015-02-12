<?php
$user_id = $u_info['id'];

if(isset($_POST['getVideo']))
{
	if(isset($_POST['embedcode']))
	{			
		$inputembbedcode = $_POST['embedcode'];
		if(($_POST['embedcode'])==NULL);
		$nullembededmsg="Please try right url";
	}

	if($_POST['embedtype'] == '1')
	{
		list($imagelink, $vediolink, $embedcode) = videoEmbed::embebvideo($inputembbedcode);
	} 
	else
	{
		list($imagelink, $vediolink, $embedcode) = videoEmbed::embebcodewithurl($inputembbedcode);
	}
	
	//echo '<pre>';print_r($_POST);echo '</pre>'; 
	
	$videoid = videoEmbed::addvideoUrl($user_id, $vediolink, $imagelink, $embedcode,$_POST['embedtype']);

	header('Location:'.$URL_SITE.'/front/videos/viewallvideos.php');	
}
?>

<style type="text/css">
	form.addvideofrmURL label.error { display: none; }	
</style>

<!-- js for form validate -->
<script>
jQuery(document).ready(function(){  
	jQuery.metadata.setType("attr", "validate");
	jQuery("#addvideofrmURL").validate();
});
</script>

<!--Add A Vedios from url-----> 
<div class="wdthpercent100 pL50 datatable">
	
		<form method="post" action="" enctype="multipart/form-data" id="addvideofrmURL" class="addvideofrmURL">


					<div id="" class="wdthpercent100 pT15 pB15">
							<div class="wdthpercent20 left fontbld"><?=VIDEO_TITLE?>:</div>
							<div class="wdthpercent80 left"><input type="text" name="title" value="" colspan='3' class="inputalbum required" /></div>
					</div>
					<div class="clear"></div>

					<div id="" class="wdthpercent100 pT15 pB15">
							<div class="wdthpercent20 left fontbld"><?=DESCRIPTION?>:</div>
							<div class="wdthpercent80 left"><textarea rows="5" cols="20" name="description" colspan='3' class="required textareaalbum"></textarea></div>
					</div>
					<div class="clear"></div>


					<div id="" class="wdthpercent100 pT15 pB15">
							<div class="wdthpercent20 left fontbld"><?=LANG_VIDEO_URL?></div>
							<div class="wdthpercent80 left"><input type="radio" name="embedtype"  class="required " value="0" ><?=VIDEO_URL?> &nbsp;<input type="radio" name="embedtype"  value="1"  ><?=VIDEO_EMBED_CODE?></div>
					</div>
					<div class="clear"></div>


					<div id="" class="wdthpercent100 pT15 pB15">
							<div class="wdthpercent20 left fontbld"><?=LANG_VIDEO_CODE?></div>
							<div class="wdthpercent80 left"><textarea rows="5" cols="20" name="embedcode" colspan='3' class="required allow_html textareaalbum"></textarea></div>
					</div>
					
					<div class="clear"></div>


					<div id="" class="wdthpercent100 pT15 pB15">
							<div class="wdthpercent20 left fontbld"><?=TAG?>:</div>
							<div class="wdthpercent80 left"><input name="keywords" type="text"  class=""/></div>
					</div>
					<div class="clear"></div>

					<div id="" class="wdthpercent100 pT15 pB15">
							<div class="wdthpercent20 left fontbld"><?php echo SHARE_WITH;?>:</div>
							<div id="shareVideoURL" class="wdthpercent80 left">

								<input name="sharevvURL" type="radio" value="E" validate="required:true" />&nbsp;&nbsp; <?php echo ALB_EVERYONE;?><br />
								<input name="sharevvURL" type="radio" value="Al" />&nbsp;&nbsp; <?php echo ALB_ALLUSERS;?><br />
								<input name="sharevvURL" type="radio" value="S"  />&nbsp;&nbsp; <?php echo ALB_GROUPS;?><br />
								<label for="sharevvURL" class="error"><?php echo SHARE_ERROR_MESSAGE;?></label>						
							
							</div>
					</div>
					<div class="clear"></div>

					<div id="sharecommentURL" class=""></div>
					<div class="clear"></div>

					<div id="sharevideoURL" class=""></div>
					<div class="clear"></div>

					<div id="sharerateURL" class=""></div>
					<div class="clear"></div>

					<div id="sharecrateURL" class=""></div>
					<div class="clear"></div>


					<div id="" class="wdthpercent100 pT15 pB15">
							<div class="wdthpercent20 left fontbld">&nbsp;</div>
							<div class="wdthpercent80 left">
								<input type="hidden" name="getVideo">
								<input type="submit" class="bluebgbtn" name="getVideo" value="<?=SAVE?>"/>&nbsp;&nbsp;
								<a href="viewallvideos.php"><input type="button" class="bluebgbtn" value="<?=CANCEL;?>"></a>
							</div>
					</div>
					<div class="clear"></div>
		</form>
</div>
<!--/Add A Vedios from url-----> 







