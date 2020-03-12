<?php
// error_reporting(E_ALL);
// ini_set('display_errors', 1);

use \RouterOS\Client;
use \RouterOS\Query;

// Initiate client with config object
$client = new Client([
    'host' => $mikrotik_ip,
    'user' => $mikrotik_user,
    'pass' => $mikrotik_pass,
    'port' => $mikrotik_port
]);

$ip = $_REQUEST['ip'];//'10.1.70.198';
$mac = $_REQUEST['mac'];
$dst = $_REQUEST['dst'];
$user = $_REQUEST['username'];
$pass = $_REQUEST['password'];
$trial = $_REQUEST['trial'];

if(isset($_REQUEST['loginNoAbsen'])){
    // Mulai Urusan Mikrotik tanpa absen

    //Tambahkan pengguna, jika gagal, biasanya sudah ada
    $query = new Query('/ip/hotspot/user/add');
    $query
        ->add('=name=NoAbs-'.$mac)
        ->add('=password='.md5($mac))
        ->add('=profile=pegawai')
        ->add('=comment=Login Tanpa Absen');

    $client->write($query);

    // Login ke hotspot
    $query = new Query('/ip/hotspot/active/login');
    $query
        ->add('=user=NoAbs-'.$mac)
        ->add('=password='.md5($mac))
        ->add('=ip='.$ip)
        ->add('=mac-address='.$mac);

    $client->write($query);

    //Cek apakah sudah login
    $request = $client->write([
        '/ip/hotspot/active/find',
        '?address='.$ip
    ]);

    $response = $client->read();
    if(count($response)>0){
        if(!empty($dst))
        header("location: $dst");
        else
        header("location: /");
    }else{
        header("location: $trial");
    }
    die();
}

if(isset($_REQUEST['loginTamu'])){
    // Mulai Urusan Mikrotik tanpa absen

    //Tambahkan pengguna, jika gagal, biasanya sudah ada
    $query = new Query('/ip/hotspot/user/add');
    $query
        ->add('=name=Tamu-'.$mac)
        ->add('=password='.md5($mac))
        ->add('=profile=pegawai')
        ->add('=comment=Tamu');

    $client->write($query);

    // Login ke hotspot
    $query = new Query('/ip/hotspot/active/login');
    $query
        ->add('=user=Tamu-'.$mac)
        ->add('=password='.md5($mac))
        ->add('=ip='.$ip)
        ->add('=mac-address='.$mac);

    $client->write($query);

    //Cek apakah sudah login
    $request = $client->write([
        '/ip/hotspot/active/find',
        '?address='.$ip
    ]);

    $response = $client->read();
    if(count($response)>0){
        if(!empty($dst))
        header("location: $dst");
        else
        header("location: /");
    }else{
        header("location: $trial");
    }
    die();
}

//Validasi Email

ini_set('default_socket_timeout', 2);

if ($mbox=imap_open( '{'.$mail_host.':143/imap/tls/novalidate-cert}', $user, $pass )){
       //proses
        if(!$_db->has("t_users",array("AND"=>array("user_id"=>$user,"user_mac"=>$mac)))){
            $_db->insert("t_users",array("date_added"=>date("Y-m-d H:i:s"),"last_check"=>date("Y-m-d H:i:s"),"user_id"=>$user,"user_mac"=>$mac));
        }else
            $_db->update("t_users",array("last_check"=>date("Y-m-d H:i:s")),array("AND"=>array("user_id"=>$user,"user_mac"=>$mac)));

        //proses absen
        if(!$_db->has("t_absen",array("AND"=>array("user_id"=>$user,"tanggal_absen"=>date("Y-m-d")))))
            $_db->insert("t_absen",array(
            "tanggal_absen"=>date("Y-m-d"),
            "keterangan"=>"WIFI",
            "jam_masuk"=>date("H:i:s"),
            "jam_keluar"=>date("H:i:s"),
            "user_id"=>$user,
            "name"=> ucwords(str_replace('.',' ',explode('@',$user)[0]))
        ));
        imap_close($mbox);
}else{
    ini_restore('default_socket_timeout');
    echo $tpl->render("alert",['msgType' => 'danger','msg'=>'Username or Password wrong','url'=>$mikrotik_host]);
    die();
}
ini_restore('default_socket_timeout');

// Mulai Urusan Mikrotik

//Tambahkan pengguna, jika gagal, biasanya sudah ada
$query = new Query('/ip/hotspot/user/add');
$query
    ->add('=name='.$user)
    ->add('=password='.md5($user))
    ->add('=profile=pegawai')
    ->add('=email='.$user);

$client->write($query);

// Login ke hotspot
$query = new Query('/ip/hotspot/active/login');
$query
    ->add('=user='.$user)
    ->add('=password='.md5($user))
    ->add('=ip='.$ip)
    ->add('=mac-address='.$mac);

$client->write($query);

//Cek apakah sudah login
$request = $client->write([
    '/ip/hotspot/active/find',
    '?address='.$ip
]);

$response = $client->read();
if(count($response[0]['address'])>0){
    if(!empty($dst))
        header("location: $dst");
    else
        header("location: /");
}else{
    header("location: $trial");
}