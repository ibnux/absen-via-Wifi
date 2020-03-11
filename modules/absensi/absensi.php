<?php

$m = (!empty($_REQUEST['m']))?$_REQUEST['m']:date('m');
$y = (!empty($_REQUEST['y']))?$_REQUEST['y']:date('Y');


echo $tpl->render("absensi",[
    'm' => $m,
    'y' => $y,
    'db' => $_db
]);