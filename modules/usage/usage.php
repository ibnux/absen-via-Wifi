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
    '/ip/hotspot/user/print']);

$users = $client->read();
unset($users[0]);
if($_GET['sort']=='bytes-out'){
    usort($users, function($a, $b) {
        return $b['bytes-out'] <=> $a['bytes-out'];
    });
}else{
    usort($users, function($a, $b) {
        return $a['name'] <=> $b['name'];
    });
}

echo $tpl->render("usage",['users' => $users,'_db'=>$_db]);