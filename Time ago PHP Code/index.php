<?php
function time_stamp($session_time){
	$time_difference = time() - $session_time ;

	$seconds = $time_difference ;
	$minutes = round($time_difference / 60 );
	$hours   = round($time_difference / 3600 );
	$days    = round($time_difference / 86400 );
	$weeks   = round($time_difference / 604800 );
	$months  = round($time_difference / 2419200 );
	$years   = round($time_difference / 29030400 );
	
	// Seconds
	if($seconds <= 60){
		echo "$seconds seconds ago";
	}//Minutes
	else if($minutes <=60){

		if($minutes==1){
			echo "one minute ago";
		}else{
			echo "$minutes minutes ago";
		}

	}//Hours
	else if($hours <=24){
		if($hours==1){
			echo "one hour ago";
		}else{
			echo "$hours hours ago";
		}
	}//Days
	else if($days <= 7){
		if($days==1){
			echo "one day ago";
		}else{
			echo "$days days ago";
		}
	}//Weeks
	else if($weeks <= 4){
		if($weeks==1){
			echo "one week ago";
		}else{
			echo "$weeks weeks ago";
		}
	}//Months
	else if($months <=12){
		if($months==1){
			echo "one month ago";
		}else{
			echo "$months months ago";
		}
	}//Years
	else{
		if($years==1){
			echo "one year ago";
		}else{
			echo "$years years ago";
		}
	}
}

$session_time ="1264326122";
//$session_time=time();
echo time_stamp($session_time);
?>