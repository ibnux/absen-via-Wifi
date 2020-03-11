<?php
use \RouterOS\Client;
use \RouterOS\Query;

// Initiate client with config object
$client = new Client([
    'host' => $mikrotik_ip,
    'user' => $mikrotik_user,
    'pass' => $mikrotik_pass,
    'port' => $mikrotik_port
]);
//Cek apakah sudah login
$request = $client->write([
    '/ip/hotspot/active/print'
,'']);

$users = $client->read();
unset($users[0]);
if($_GET['sort']=='bytes-out'){
    usort($users, function($a, $b) {
        return $b['bytes-out'] <=> $a['bytes-out'];
    });
}else{
    usort($users, function($a, $b) {
        return $a['user'] <=> $b['user'];
    });
}

echo $tpl->render("active",['users' => $users,'_db'=>$_db]);