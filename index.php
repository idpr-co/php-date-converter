<?php
include_once("jdf.php");
include_once("gm.php");


$action = $_REQUEST['action'];


if($action == "getToday"){
	$res = array();
	
	$res["miladi"][] = date("Y/m/d" , time());
	$res["shamsi"][] = jdate("Y/m/d" , time());
	
	$gamari = gregorian_to_ghamari($res["miladi"][0]);
	$res["gamari"][] = $gamari[0]."/".$gamari[1]."/".$gamari[2];
	
	echo json_encode($res);
	
}elseif($action == "convertShamsiDate"){
	$date = explode("/",$_REQUEST['date']);
		
	$miladi = jalali_to_gregorian($date[0] , $date[1] , $date[2]);
	$gamari = gregorian_to_ghamari($miladi[0],$miladi[1],$miladi[2]);
	$res = array();
	
	$res["miladi"][] = array("year" => $miladi[0], "month" => $miladi[1], "day" => $miladi[2]);
	$res["gamari"][] = array("year" => $gamari[0], "month" => $gamari[1], "day" => $gamari[2]);
	
	echo json_encode($res);
}elseif($action == "convertMiladiDate"){
	$date = explode("/",$_REQUEST['date']);
	
	$shamsi = gregorian_to_jalali($date[0] , $date[1] , $date[2]);
	$gamari = gregorian_to_ghamari($date[0] , $date[1] , $date[2]);
	$res = array();
	
	$res["shamsi"][] = array("year" => $shamsi[0], "month" => $shamsi[1], "day" => $shamsi[2]);
	$res["gamari"][] = array("year" => $gamari[0], "month" => $gamari[1], "day" => $gamari[2]);
	
	echo json_encode($res);
}elseif($action == "convertGamariDate"){
	$date = explode("/",$_REQUEST['date']);
	
	$miladi = ghamari_to_gregorian($date[0] , $date[1] , $date[2]);
	$shamsi = gregorian_to_jalali($miladi[0] ,$miladi[1] ,$miladi[2]);
	
	$res = array();
	
	$res["miladi"][] = array("year" => $miladi[0], "month" => $miladi[1], "day" => $miladi[2]);
	$res["shamsi"][] = array("year" => $shamsi[0], "month" => $shamsi[1], "day" => $shamsi[2]);
	
	echo json_encode($res);
}
