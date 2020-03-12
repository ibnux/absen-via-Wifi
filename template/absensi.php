<?php $this->layout('template', ['title' => 'Kehadiran hari ini']);
use Medoo\Medoo; ?>

<div class="card shadow">
    <div class="card-header border-0">
        <form method="POST" action="">
        <div class="row">
            <div class="col-lg-4">
                <div class="form-group">
                    <select class="form-control" name="m">
                        <?php
                        for($n=0;$n<count($bulan);$n++){
                            echo '<option value="'.($n+1).'" '.((($n+1)==$m)? 'selected':'').'>'.$bulan[$n].'</option>';
                        }?>
                    </select>
                </div>
            </div>
            <div class="col-lg-4">
                <input type="text" name="y" class="form-control" placeholder="Tahun" value="<?php echo $y ?>">
            </div>
            <div class="col-lg-4">
                <button name="filter" class="btn btn-primary">Submit</button>
            </div>
        </div>
        </form>
        <div class="table-responsive">
            <table class="table table-sm align-items-center table-bordered table-fullwidth">
            <thead class="thead-light">
                <tr>
                <!--<th scope="col" rowspan="2">No</th>-->
                <th>Nama</th>
                <?php
                    $tahun = $y;
                    $bulan = $m;
                    $tanggal = cal_days_in_month(CAL_GREGORIAN, $bulan, $tahun);
                    for ($i=1; $i < $tanggal+1; $i++) { 
                        echo '<th scope="col" ><center>'.$i.'</center></th>';
                    }
                ?>
                </tr>
            </thead>
            <tbody>
                <?php
                    $datas = $db->select("t_absen",["user_id"=>Medoo::raw('DISTINCT user_id')]);
                    $i = 1;
                    foreach($datas as $data)
                    {
                        $data['name'] = ucwords(str_replace('.',' ',explode('@',$data['user_id'])[0]));
                        echo "<tr>";
                        echo "<td><a href='/report/?id=".$data["user_id"]."&bulan=$bulan&tahun=$tahun&source=reports' title='Detail'>".$data["name"]."</a></td>";
                        $name = $data["name"];
                        $email = $data["user_id"];
                        for ($h=1; $h < $tanggal+1; $h++) {
                            if($h < 10){
                                $tgl = "0".$h."";
                            }else{
                                $tgl = $h;
                            }

                            $dates = mktime(0,0,0, $bulan, $h, $tahun);

                            if(date('w', $dates) == 0 || date('w', $dates) == 6){
                                echo '<td class="table-danger">';
                            }else{
                                echo "<td>";
                            }
                            $sql = "SELECT timediff(jam_masuk, jam_keluar) kerja FROM t_absen WHERE DATE(tanggal_absen) = '".$tahun."-".$bulan."-".$tgl."' AND user_id = '$email' ";
                            //echo $sql;
                            $query3 = $db->query($sql)->fetchAll();
                            $count3 = count($query3);
                            if($count3 > 0){
                                echo '<span class="badge badge-pill badge-primary">&bull;</span> </td>';
                            }else{
                                echo "</td>";
                            }
                        }
                        echo "</tr>";
                        $i++;
                    }?>
            </tbody>
            </table>
        </div>
    </div>
</div>