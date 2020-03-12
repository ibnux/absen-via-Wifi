<?php $this->layout('template', ['title' => 'Report']);

function hoursandmins($time, $format = '%02d:%02d'){
    if ($time < 1) {
        return;
    }
    $hours = floor($time / 60);
    $minutes = ($time % 60);
    return sprintf($format, $hours, $minutes);
}
?>

<div class="row">
    <div class="col-md-4">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
                <span class="h2 font-weight-bold mb-0"><?php echo $bulan[($m*1)-1] ?> - <?php echo $y ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card card-stats mb-4 mb-xl-0">
            <div class="card-body">
            <span class="h2 font-weight-bold mb-0"><?php echo $name; ?></span>
            </div>
        </div>
    </div>
    <div class="col-md-4">
    </div>
</div>
<br><br>
<div class="container-fluid mt--7">
    <!-- Table -->
    <div class="row">
        <div class="col">
            <div class="card shadow">
                <div class="card-header border-0">
                    <div class="table-responsive-sm">
                        <table class="table align-items-center table-sm">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col" rowspan="2"><center>Tanggal</center></th>
                                    <th scope="col" colspan="3"><center>Jam Kerja</center></th>
                                </tr>
                                <tr>
                                    <th scope="col">Datang</th>
                                    <th scope="col">Pulang</th>
                                    <th scope="col">&Sigma; Kerja</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php
                                $tanggal = cal_days_in_month(CAL_GREGORIAN, $m, $y);
                                $bulan = $m;
                                $tahun = $y;

                                for ($i=1; $i < $tanggal+1; $i++) {
                                    if($i < 10){
                                        $tgl = "0".$i."";
                                    }else{
                                        $tgl = $i;
                                    }
                                    $dates = mktime(0,0,0, $bulan, $i, $tahun);
                                    echo "<tr id=\"$tgl\">";
                                    echo '<td><center>'.$tgl.'</center></td>';

                                    if(date('w', $dates) == 0){
                                        echo "<td colspan='3'  class=\"table-danger\"><center>Minggu</center></td>";
                                    }elseif(date('w', $dates) == 6){
                                        echo "<td colspan='3' class=\"table-danger\"><center>Sabtu</center></td>";
                                    }else{
                                        $jam_masuk = $db->get('t_absen',"jam_masuk",['AND'=>['tanggal_absen'=>$tahun."-".$bulan."-".$tgl, 'user_id' => $user_id]]);
                                        if(!empty($jam_masuk)){
                                            echo "<td>".$jam_masuk."</td>";
                                        }else{
                                            echo "<td> - </td>";
                                        }
                                        $jam_keluar = $db->get('t_absen',"jam_keluar",['AND'=>['tanggal_absen'=>$tahun."-".$bulan."-".$tgl, 'user_id' => $user_id]]);
                                        if(!empty($jam_keluar)){
                                            echo "<td>".$jam_keluar."</td>";
                                        }else{
                                            echo "<td> - </td>";
                                        }
                                        $lama = abs(strtotime($jam_keluar)-strtotime($jam_masuk));
                                        // Convert $diff to minutes
                                        $tmins = $lama/60;
                                        // Get hours
                                        $hours = floor($tmins/60);
                                        // Get minutes
                                        $mins = $tmins%60;
                                        if($lama>10){
                                            if($hours>0)
                                            echo "<td>".$hours." jam ".$mins." menit</td>";
                                            else
                                            echo "<td>".$mins." menit</td>";
                                        }else{ 
                                            echo "<td> - </td>";
                                        }
                                    }
                                    echo "</tr>";
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer py-4 d-print-none" align="center">
                <a href="javascript:window.print()" class="btn btn-primary h2 font-weight-bold mb-0">Print</a>
                </div>
            </div>
        </div>
    </div>
</div>