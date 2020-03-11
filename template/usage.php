<?php $this->layout('template', ['title' => 'Usage']);
?>
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th><abbr title="Position">#</abbr></th>
            <th><a href="/usage/?sort=name">Name</a></th>
            <th><a href="/usage/?sort=bytes-out">Download</a></th>
            <th>Upload</th>
            <th>Uptime</th>
            <th>Komentar</th>
        </tr>
    </thead>
    <tbody>
        <?php
            $n=1;
            foreach($users as $user){ ?>
        <tr>
        <th><?php echo $n; $n++; ?></th>
        <td><?php
        if(substr($user['name'],0,6)=='NoAbs-' || substr($user['name'],0,5)=='Tamu-'){
            $email = $_db->get("t_user",
                    "email",
                    array("mac"=>str_replace('NoAbs-',"",str_replace('Tamu-',"",$user['name'])))
                );
            if(!empty($email)) $user['name'] = $email;
        }
        echo $user['name'];
        ?></td>
        <td><?=sizeit($user['bytes-out'])?></td>
        <td><?=sizeit($user['bytes-in'])?></td>
        <td><?=$user['uptime']?></td>
        <td><?=$user['comment']?></td>
        </tr>
        <?php } ?>
    </tbody>
</table>