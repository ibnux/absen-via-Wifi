<?php $this->layout('template', ['title' => 'Kehadiran hari ini']) ?>

<div class="card">
    <h4 class="card-header" align="center"><?= date("d M Y") ?></h4>
    <div class="card-body" align="center">
        <?php
            for($n=0;$n<$jml;$n++){
                $nama = ucwords(str_replace('.',' ',explode('@',$semua[$n])[0]));
                if(!empty($nama)){

                    if(in_array($semua[$n],$hadir)){ ?>
                            <a role="button" href="/report/?id=<?=$semua[$n]?>&bulan=<?=date("m")?>&tahun=<?=date("Y")?>" class="btn btn-primary btn-sm"><?=$nama?>
                    <?php }else{ ?> 
                            <a role="button" href="/report/?id=<?=$semua[$n]?>&bulan=<?=date("m")?>&tahun=<?=date("Y")?>" class="btn btn-dark btn-sm"><?=$nama?>
                    <?php } ?></a>&nbsp;<?php
                }
        }?>
    </div>
</div>
