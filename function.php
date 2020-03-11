<?php

function sendError($txt,$header=["HTTP/1.0 202 Accepted","Content-Type: Application/json"]){
    if(is_array($header)){
        foreach($header as $head)
        header($head);
    }else if(!empty($header))
        header($header);
    header($header);
    die(json_encode(['status'=>'failed','message'=>$txt]));
}

function sendResult($data,$header=["HTTP/1.0 200 OK","Content-Type: Application/json"]){
    if(is_array($header)){
        foreach($header as $head)
        header($head);
    }else if(!empty($header))
        header($header);
    die(json_encode(['status'=>'success','data'=>$data]));
}

function showAlert($msg, $type){
    ?><div class="alert alert-<?=$type?> alert-dismissible fade show" role="alert"><?=$msg?>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    </div><?php
}

function sizeit($bytes, $decimals = 0){
    $size = array('B','kB','MB','GB','TB','PB','EB','ZB','YB');
    $data = floor((strlen($bytes) - 1) / 3);
    return sprintf("%.{$decimals}f", $bytes / pow(1024, $data)) . @$size[$data];
}