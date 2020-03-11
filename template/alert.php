<?php $this->layout('template', ['title' => 'Alert']) ?>

<div class="row">
    <div class="col-sm-4">
    </div>
    <div class="col-sm-4">
        
        <div class="card bg-<?=$msgType?>">
            <div class="card-body blockquote mb-0 ">
                <?=$msg?>
            </div>
            <div class="card-footer">
            <center><a href="<?=$url?>" role="button" class="btn btn-dark">click here</a></center>
            </div>
        </div>
        <meta http-equiv="refresh" content="1; url=<?=$url?>">
        <br>
        <div class="progress bg-warning" style="height: 2px;">
        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%"></div>
        </div>
    </div>
    <div class="col-sm-4">
    </div>
</div>
