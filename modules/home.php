<?php
//print_r($services);

$hadir = array_unique($_db->select("t_absen","user_id",array("tanggal_absen"=>date("Y-m-d"))));
$semua = $_db->select("t_users","user_id");
$jml = count($semua);

echo $tpl->render("home",['hadir' => $hadir,'semua'=>$semua,'jml'=>$jml]);