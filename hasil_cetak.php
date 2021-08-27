

<<table class="table table-bordered table-hover table-striped">
<thead>
    <tr class="nw">
        <th>No</th>
        <th>Hari</th>
        <th>Jam</th>
        <th>PIC</th>
        <th>Manufaktur</th>
        <th>Divisi</th>
        <th>User</th>
    </tr>
</thead>
<?php
$q = esc_field($_GET['q']);
$rows = $db->get_results("SELECT h.`nama_hari`,kls.`nama_manufaktur`,tb_jam.`nama_jam`, m.`nama_pic`, m.`jumlah_jam`, d.`nama_user`, r.`nama_divisi`, tb_jam.`nama_jam` + INTERVAL m.jumlah_jam * 45 MINUTE AS jam_selesai
FROM tb_setting k 
    INNER JOIN tb_user d ON d.`kode_user`=k.`kode_user`
    INNER JOIN tb_pic m ON m.`kode_pic`=k.`kode_pic`
    INNER JOIN tb_manufaktur kls ON kls.`kode_manufaktur`=k.`kode_manufaktur`
    INNER JOIN `tb_jadwal` j ON j.`setting` = k.`kode_setting`
    INNER JOIN tb_divisi r ON r.`kode_divisi` = d.`kode_divisi`
    INNER JOIN tb_waktu w ON w.`kode_waktu` = j.`waktu`
    INNER JOIN tb_hari h ON h.`kode_hari` = w.`kode_hari`
    INNER JOIN tb_jam ON tb_jam.`kode_jam` = w.`kode_jam`
WHERE kls.kode_manufaktur LIKE '%$q%'
ORDER BY w.`kode_hari`, w.`kode_jam`");
$nos=1;
foreach($rows as $row)
{
    if(!empty($HARI[$nos-1][$row->nama_hari]['awal']))
    {
        
        $HARI[$nos][$row->nama_hari]['awal']=date('H:i', strtotime('+45 minutes', strtotime($HARI[$nos-1][$row->nama_hari]['awal'])));
        $HARI[$nos][$row->nama_hari]['akhir']=date('H:i',strtotime('+45 minutes', strtotime($HARI[$nos][$row->nama_hari]['awal'])));
    }else{
        $HARI[$nos][$row->nama_hari]['awal']='09:00';
        $HARI[$nos][$row->nama_hari]['akhir']='09:45';
    }
    
    $nos++;
}

$no=1;
foreach($rows as $row):?>
<tr>
    <td><?=$no?></td>
    <td><?=$row->nama_hari?></td>
    <td><?=substr($HARI[$no][$row->nama_hari]['awal'], 0, 5) . ' - ' . substr($HARI[$no][$row->nama_hari]['akhir'], 0, 5)?></td>
    <td><?=$row->nama_pic?></td>
    <td><?=$row->nama_manufaktur?></td>
    <td><?=$row->nama_divisi?></td>
    <td><?=$row->nama_user?></td>
</tr>
<?php $no++;endforeach;
?>
</table>