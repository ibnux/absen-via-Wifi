<?php
/**
 * ABSENSI Wifi Created by Ibnu Maksum
 */
session_start();

header('Access-Control-Allow-Origin: *');
date_default_timezone_set("Asia/Jakarta");
error_reporting(E_ERROR);

include "vendor/autoload.php";
include "config.php";
include "function.php";

use Medoo\Medoo;

//DATABASE Connection
$_db = new Medoo([
	// required
	'database_type' => 'mysql',
	'database_name' => $db_name,
	'server' => $db_host,
	'username' => $db_user,
    'password' => $db_pass
]);

$_bulan = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

//Parsing URL
$_path = array_values(array_filter(explode("/",parse_url($_SERVER['REQUEST_URI'])['path'])));
$_jml = count($_path);

$tpl = new League\Plates\Engine('template');

$tpl->addData(['bulan'=>$_bulan,'company_name'=>$company_name]);

//foo/bar.php
if(file_exists($modul = "modules/".$_path[0]."/".$_path[1].".php")){
    $tpl->addData(['crumbs' => $crumbs=[$_path[0],$_path[1]]]);
    unset($_path[0],$_path[1]);
    $_path = array_values($_path);
    include $modul;
//foo/foo.php
}else if(file_exists($modul = "modules/".$_path[0]."/".$_path[0].".php")){
    $tpl->addData(['crumbs' => $crumbs=[$_path[0]]]);
    unset($_path[0]);
    $_path = array_values($_path);
    include $modul;
    die();
//foo.php
}else if(file_exists($modul = "modules/".$_path[0].".php")){
    $tpl->addData(['crumbs' => $crumbs=[$_path[0]]]);
    unset($_path[0]);
    $_path = array_values($_path);
    include $modul;
    die();
}else{
    include "modules/home.php";
}