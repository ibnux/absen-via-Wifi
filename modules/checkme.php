<?php

/**
 * This is for absen using mikrotik login
 */


$_secret = $_GET['s'];
$_user = strtolower($_GET['u']);
$_mac = strtoupper($_GET['m']);
if($_secret==$secret && !empty($_user) && !empty($_mac)){
    echo "OK";
    //proses
    if(!$_db->has("t_users",array("AND"=>array("user_id"=>$_user,"user_mac"=>$_mac)))){
        $_db->insert("t_users",array("date_added"=>date("Y-m-d H:i:s"),"last_check"=>date("Y-m-d H:i:s"),"user_id"=>$_user,"user_mac"=>$_mac));
    }else
        $_db->update("t_users",array("last_check"=>date("Y-m-d H:i:s")),array("AND"=>array("user_id"=>$_user,"user_mac"=>$_mac)));

    //proses absen
    if($_db->has("t_absen",array("AND"=>array("user_id"=>$_user,"tanggal_absen"=>date("Y-m-d")))))
        $_db->update("t_absen",
            array("jam_keluar"=>date("H:i:s"),"name"=> ucwords(str_replace('.',' ',explode('@',$_user)[0]))),
            array("AND"=>array("user_id"=>$_user,"tanggal_absen"=>date("Y-m-d")))
        );
    else
        $_db->insert("t_absen",array(
            "tanggal_absen"=>date("Y-m-d"),
            "keterangan"=>"WIFI",
            "jam_masuk"=>date("H:i:s"),
            "jam_keluar"=>date("H:i:s"),
            "user_id"=>$_user,
            "name"=> ucwords(str_replace('.',' ',explode('@',$user)[0]))
        ));
}else{
    echo "NOT OK";
}