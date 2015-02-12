<?php
Class videoEmbed 
{
	function escape_data ($data)
	{
		global $con; //declares by mysql_connect global
		if (ini_get('magic_quotes_gpc')) 
		{
			$data = stripslashes($data);
		}
		return mysql_real_escape_string(trim($data), $con);
	} 

	function embebvideo($embbedcode)
	{	
		global $DOC_ROOT;
		
		$root_path = $DOC_ROOT;

		if (strstr( $embbedcode, "vimeo.com" ) )
		{
			/*Vimeo Section */
			$urlid = explode("http://vimeo.com/moogaloop.swf?clip_id", $embbedcode);
			$videoid = explode("=",$urlid[1]);
			$expvideoid = explode("&",$videoid[1]);
			$imgid = $expvideoid[0];
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));
			/*Getting url from embbed code Vimeo*/				
			$fullpath = $hash[0]['thumbnail_small'];
			$vediolink = 'http://vimeo.com/'.$imgid;
		}
		elseif(strstr( $embbedcode, "yahoo.com" ) )
		{
			//yahoo.com
			$url = explode("&", $embbedcode);
			$linkis = explode("=",$url[1]);
			$videoid = $linkis[1];
			$finalurl = explode("=",$url[4]);
			$expstring = explode("%3A", $finalurl[1]);
			/*Getting url from embbed code Yahoo*/				
			$fullpath = "http:".$expstring[1];
			$vediolink = 'http://video.yahoo.com/watch/'.$videoid;
			//echo "yahoo.com";
		}
		else if(strstr($embbedcode, "youtube.com" ) )
		{
			$url = explode("/v/", $embbedcode);
			//echo '<pre>';print_r($url);echo '</pre>';			
			//echo $url[1]."<br>";die;

			$vid = explode("\"",$url[1]);
			$vid = explode("&",$vid[0]);
			
			$vi_id =  trim(trim(substr($vid[0],0, strpos($vid[0],"?")),"/"));
			$card['thumb'] = "http://img.youtube.com/vi/".$vi_id."/2.jpg";				
			
			//Getting url from embbed code Youtube				
			$fullpath = $card['thumb'];		
			$vediolink = 'http://www.youtube.com/watch?v='.$vid[0];
		}
		else if(strstr( $embbedcode, "google.com" ) )
		{
			//$url = explode("src", $_POST['embbedcode']);
			//$url2 = explode("&", $url[1]);
			//$url3 = explode("=", $url2[0]);
			//$vediolink = 'http://video.google.com/videoplay?docid='.$url3[3].'&hl=en&emb=1';
			// $fullpath='no.jpg';
			$code = explode(" ", $embbedcode);

			$videoid_part1 = explode("=", $code[2]);
			$videoid_part2 = explode("&", $videoid_part1[2]);


			$length = strlen($code[2]);
			require_once("rsslib.php");
			$url = "http://video.google.com/videofeed?docid=".$videoid_part2[0];
			$string =  RSS_Display($url, 15, true);
			
			$arr = explode('<img src=', $string);
			$imgurl = explode(' ', $arr[1]);
			$code = explode(" ", $embbedcode);

			$length = strlen($code[2]);
			$fullpath = $imgurl[0];

			$vediolink = substr($code[2], 4 , $length);


		}

		//echo  $albumfileinsert = "insert into bmex_article_gallery set ID_article=".escape_data($articleid)." , 
		//user_id=".escape_data($user_id)." ,
		//image='".escape_data($fullpath)."' ,
		//description='".escape_data($_POST['description'])."' , embedcode='".$_POST['embbedcode']."',
		//vediolink = '".$vediolink."' , 
		//isEmbed='1'";
		//$query = mysql_query($albumfileinsert, $app_conn) or die(mysql_error()); 

		$imagelink = $fullpath;
		return array($imagelink, $vediolink, $embbedcode);	

	}

	function embebcodewithurl($inputembbedcode)
	{
		global $DOC_ROOT;
		$root_path = $DOC_ROOT;

		if(strstr($inputembbedcode, "youtube.com" ) )
		{			
			$url = explode("=", $inputembbedcode);
			$url2 = explode("&", $url[1]);

			$card['thumb'] = "http://img.youtube.com/vi/".$url2[0]."/2.jpg";				
			/*Getting url from embbed code Youtube*/				
			$fullpath = $card['thumb'];		
			$vediolink = 'http://www.youtube.com/watch?v='.$url2[0];
			$embedcode='<object width="470" height="320"><param name="movie" value="http://www.youtube.com/v/'.$url2[0].'&hl=en_US&fs=1&"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/'.$url2[0].'&hl=en_US&fs=1&" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="640" height="385"></embed></object>';

		} 
		else if(strstr( $inputembbedcode, "vimeo.com" ))
		{

			$url = explode("/", $inputembbedcode);
			$imgid=$url[3];	
			$hash = unserialize(file_get_contents("http://vimeo.com/api/v2/video/$imgid.php"));

			/*Getting url from embbed code Vimeo*/				
			$fullpath = $hash[0]['thumbnail_small'];
			$vediolink = 'http://vimeo.com/'.$imgid;

			$embedcode ='<object width="470" height="320"><param name="allowfullscreen" value="true" /><param name="allowscriptaccess" value="always" /><param name="movie" value="http://vimeo.com/moogaloop.swf?clip_id='.$imgid.'1&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=00adef&amp;fullscreen=1" /><embed src="http://vimeo.com/moogaloop.swf?clip_id='.$imgid.'&amp;server=vimeo.com&amp;show_title=1&amp;show_byline=1&amp;show_portrait=0&amp;color=00adef&amp;fullscreen=1" type="application/x-shockwave-flash" allowfullscreen="true" allowscriptaccess="always" width="400" height="225"></embed></object>';

		}
		else if(strstr( $inputembbedcode, "yahoo.com" ))
		{
			$url = explode("/", $inputembbedcode);
			$vid= $url[4];
			if(!empty($url[5])){
				$id= $url[5];
			}
			$url = $inputembbedcode;
			$page = self::get_web_page($url);
			$array = explode("image_src" , $page['content'] );
			$image = explode('"' , $array[1]);
			$fullpath = $image[2];
									
			if(!empty($id))
			{
				 $vediolink='http://video.yahoo.com/watch/'.$vid.'/'.$id;
				 $embedcode='<object width="470" height="320"><param name="movie" value="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.46" /><param name="allowFullScreen" value="true" /><param name="AllowScriptAccess" VALUE="always" /><param name="bgcolor" value="#000000" /><param name="flashVars" value="id='.$id.'&vid='.$vid.'&lang=en-us&intl=us&thumbUrl='.$fullpath.'&embed=1" /><embed src="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.46" type="application/x-shockwave-flash" width="512" height="322" allowFullScreen="true" AllowScriptAccess="always" bgcolor="#000000" flashVars="id='.$id.'&vid='.$vid.'&lang=en-us&intl=us&thumbUrl='.$fullpath.'&embed=1" ></embed></object>';
			}
			else
			{
				   $vediolink='http://video.yahoo.com/watch/'.$vid;
					$embedcode= '<object width="470" height="320"><param name="movie" value="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.46" /><param name="allowFullScreen" value="true" /><param name="AllowScriptAccess" VALUE="always" /><param name="bgcolor" value="#000000" /><param name="flashVars" value="vid='.$vid.'&lang=en-us&intl=us&thumbUrl='.$fullpath.'&embed=1" /><embed src="http://d.yimg.com/static.video.yahoo.com/yep/YV_YEP.swf?ver=2.2.46" type="application/x-shockwave-flash" width="512" height="322" allowFullScreen="true" AllowScriptAccess="always" bgcolor="#000000" flashVars="vid='.$vid.'&lang=en-us&intl=us&thumbUrl='.$fullpath.'&embed=1&ap=10513021" ></embed></object>';
			}		
		}
		else if(strstr( $inputembbedcode, "google.com" ))
		{

			$fromurl = explode("docid=" , $inputembbedcode);
			$video_id = explode("#" , $fromurl[1]);
			require_once("rsslib.php");
			$url = "http://video.google.com/videofeed?docid=".$video_id[0];
			$string =  RSS_Display($url, 15, true);
			$arr = explode('<img src=', $string);
			$imgurl = explode(' ', $arr[1]);
			//$code = explode(" ", $inputembbedcode);
			//$length = strlen($code[2]);
			$fullpath = $imgurl[0];
			$vediolink=$inputembbedcode;
			$embedcode='<embed id=VideoPlayback src=http://video.google.com/googleplayer.swf?docid='.$video_id[0].'&hl=en&fs=true style=width:400px;height:326px allowFullScreen=true allowScriptAccess=always type=application/x-shockwave-flash> </embed>';
								
		}

		$imagelink = $fullpath;
		//$albumfileinsert = "insert into bmex_article_gallery set ID_article=".escape_data($articleid)." , 
		//user_id=".escape_data($user_id)." ,
		//image='".escape_data($fullpath)."' ,
		//description='".escape_data($_POST['description'])."' , embedcode='".$embebcode."',
		//vediolink = '".$vediolink."' , 
		//isEmbed='1'";
        //$query = mysql_query($albumfileinsert, $app_conn) or die(mysql_error()); 
		//return $query;

		return array($imagelink, $vediolink, $embedcode);	
	}

	function get_web_page( $url )
	{
		$options = array(
			CURLOPT_RETURNTRANSFER => true,     // return web page
			CURLOPT_HEADER         => false,    // don't return headers
			CURLOPT_FOLLOWLOCATION => true,     // follow redirects
			CURLOPT_ENCODING       => "",       // handle all encodings
			CURLOPT_USERAGENT      => "spider", // who am i
			CURLOPT_AUTOREFERER    => true,     // set referer on redirect
			CURLOPT_CONNECTTIMEOUT => 120,      // timeout on connect
			CURLOPT_TIMEOUT        => 120,      // timeout on response
			CURLOPT_MAXREDIRS      => 10,       // stop after 10 redirects
		);
	    
		$ch      = curl_init( $url );
		curl_setopt_array( $ch, $options );
		$content = curl_exec( $ch );
		$err     = curl_errno( $ch );
		$errmsg  = curl_error( $ch );
		$header  = curl_getinfo( $ch );
		curl_close( $ch );

		$header['errno']   = $err;
		$header['errmsg']  = $errmsg;
		$header['content'] = $content;
		return $header;
	}

	function addvideoUrl($user_id, $video_link, $image_link, $embedcode,$embedtype)
	{
		$comment_status ="";
		$title= "";
		$keywords = "";
		$description="";
		$visibility ="";
		$rating_status = "";

		if(isset($_POST['title']))
			$video_name=$_POST['title'];
		if(isset($_POST['keywords']))
			$keywords=$_POST['keywords'];
		if(isset($_POST['description']))
			$description=$_POST['description'];
		if(isset($_POST['commentURL']))
			$comment_status=$_POST['commentURL'];
		if(isset($_POST['rate']))
			$rating_status=$_POST['rate'];
		if(isset($_POST['sharevvURL']))
			$visibility=$_POST['sharevvURL'];

		$sql = "insert into videos set video_name      =     '".self::escape_data($video_name) ."',
		                               keywords       =     '".self::escape_data($keywords) ."',
		                               description    =     '".self::escape_data($description) ."',
		                      	       comment_status =     '".$comment_status."',
								       visibility     =     '".$visibility."',
								       rating_status  =     '".$rating_status."',
								   	   user_id        =     '".$user_id."',
									   video_link	  =		'".self::escape_data($video_link)."',
									   image_link	  =		'".self::escape_data($image_link)."',
									   image_path	  =		'".self::escape_data($image_link)."',
									   embedcode	  =		'".$embedcode."',
									   embedtype	  =		'".$embedtype."',		
									   isEmbed		  =		'1',
									   added_on       =     now()";  

		$query = mysql_query($sql) or die('cant insert in video '.mysql_error());
        $videoid = mysql_insert_id();
		return $videoid;
	}

	function addvideoURLSquaBox($user_id,$video_link, $image_link, $embedcode)
	{
		$sql = "insert into videos set video_name='sqwaukboxvideo_".$user_id."',visibility='E',comment_status ='Al',rating_status='Al',user_id='".$user_id ."',video_link='".self::escape_data($video_link)."',image_link='".self::escape_data($image_link)."',image_path='".self::escape_data($image_link)."',embedcode='".self::escape_data($embedcode)."',isEmbed='1',added_on=now(),modified_on=''";
		$query = mysql_query($sql) or die('cant insert in video '.mysql_error());
		return mysql_insert_id();
	 }
	
	function addvideoscratch($user_id, $image_link, $friend_id_scratch, $videoid, $scrap="")
	{
		$sql = "insert into scratches set user_id='".$friend_id_scratch."', image_path='".self::escape_data($image_link)."', friend_id='".$user_id."', date=NOW(), video_id='".$videoid."',content='".self::escape_data($scrap)."', video_image='".self::escape_data($image_link)."',parent_scratch=1";
		$query = mysql_query($sql) or die('cant insert images '.mysql_error());
	}

	function editUrlVideo($video_id,$description,$embedtype,$isEmbed,$embedcode,$imagelink,$vediolink)
	{
		 $embedcode; 
		 $sql="update videos set embedcode='".self::escape_data($embedcode)."', isEmbed='".$isEmbed."', embedtype='".$embedtype."' ,description='".self::escape_data($description)."', image_link='".self::escape_data($imagelink)."', video_link='".self::escape_data($vediolink)."' where video_id='".$video_id."'";
		 return $query=mysql_query($sql) or die ('sorry unable to update');
		
	}
	//function to edit video name description,visibility status
	function editvideo($videoid,$uid)
	{
		$sql="update videos set video_name='".($_POST['videoname'])."',description='".$_POST['description']."', comment_status='".$_POST['comment']."', visibility='".$_POST['sharevv']."',keywords='".$_POST['keywords']."' ,rating_status='".$_POST['rate']."' where video_id='".$_POST['video_id']."'";
		$query=mysql_query($sql) or die ('sorry unable to update');


		if(isset($_POST['sharevcomment']) and !empty($_POST['sharevcomment']))
		{
			foreach($_POST['sharevcomment'] as $val) 
			{
				$sql = mysql_query("insert into video_visibility values('','".$videoid."','".$uid."','".$val."')");
			}
		}

		if(isset($_POST['comentgrp']) and !empty($_POST['comentgrp']))
		{
			foreach($_POST['comentgrp'] as $val) 
			{
				$sql = mysql_query("insert into video_commentstatus values('','".$videoid."','".$uid."','".$val."')");
			}
		}

		if(isset($_POST['rategrp'])and !empty($_POST['rategrp']))
		{
			foreach($_POST['rategrp'] as $val) 
			{
				$sql = mysql_query("insert into video_ratestatus values('','".$videoid."','".$uid."','".$val."')");
			}
		}

		return $query;
	}
}
?>