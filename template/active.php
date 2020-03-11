<?php $this->layout('template', ['title' => 'Active Users']);
?>
<table class="table table-striped table-bordered table-hover table-sm">
    <thead>
        <tr>
            <th><abbr title="Position">#</abbr></th>
            <th><a href="active.php?sort=name">Name</a></th>
            <th>Address</th>
            <th>Mac</th>
            <th><a href="active.php?sort=bytes-out">Download</a></th>
            <th>Upload</th>
            <th>Uptime</th>
        </tr>
    </thead>
    <tbody>
        <?php 
            $n=1;
            foreach($users as $user){ ?>
            <tr>
                <th><?php echo $n; $n++; ?></th>
                <td><?=$user['user']?></td>
                <td><?=$user['address']?></td>
                <td><?=$user['mac-address']?></td>
                <td><?=sizeit($user['bytes-out'])?></td>
                <td><?=sizeit($user['bytes-in'])?></td>
                <td><?=$user['uptime']?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>