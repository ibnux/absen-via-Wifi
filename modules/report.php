<?php

$m = (!empty($_REQUEST['bulan']))?$_REQUEST['bulan']:date('m');
$y = (!empty($_REQUEST['tahun']))?$_REQUEST['tahun']:date('Y');


echo $tpl->render("report",[
    'm' => $m,
    'y' => $y,
    'name' => ucwords(str_replace('.',' ',explode('@',$_GET['id'])[0])),
    'user_id' =>$_GET['id'],
    'db' => $_db]);