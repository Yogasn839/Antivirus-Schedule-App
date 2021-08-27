<div class="page-header">
    <h1>Setting</h1>
</div>
<div class="panel panel-default">
<div class="panel-heading">
    <form class="form-inline">
        <input type="hidden" name="m" value="setting" />
        <div class="form-group">
            <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
        </div>
        <div class="form-group">
            <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
        </div>
        <div class="form-group">
            <a class="btn btn-primary" href="?m=setting_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
        </div>
    </form>
</div>

<table class="table table-bordered table-hover table-striped">
<thead>
    <tr class="nw">
        <th>No</th>
        <th>PIC</th>
        <th>User</th>
        <th>Manufaktur</th>
        <th>Aksi</th>
    </tr>
</thead>
<?php
$q = esc_field($_GET['q']);
$rows = $db->get_results("SELECT k.`kode_setting`, k.`kode_pic`, k.`kode_manufaktur`, kls.`nama_manufaktur`, k.`kode_user`, m.`nama_pic`, d.`nama_user`	 
FROM tb_setting k 
	INNER JOIN tb_user d ON d.`kode_user`=k.`kode_user`
	INNER JOIN tb_pic m ON m.`kode_pic`=k.`kode_pic`
    INNER JOIN tb_manufaktur kls ON kls.`kode_manufaktur`=k.`kode_manufaktur`
WHERE m.nama_pic LIKE '%$q%' OR d.nama_user LIKE '%$q%' OR kls.nama_manufaktur LIKE '%$q%'
ORDER BY k.`kode_pic`, k.`kode_manufaktur`");
$no=0;

foreach($rows as $row):?>
<tr>
    <td><?=++$no ?></td>
    <td><?=$row->nama_pic?></td>
    <td><?=$row->nama_user?></td>
    <td><?=$row->nama_manufaktur?></td>
    <td class="nw">
        <a class="btn btn-xs btn-warning" href="?m=setting_ubah&ID=<?=$row->kode_setting?>"><span class="glyphicon glyphicon-edit"></span></a>
        <a class="btn btn-xs btn-danger" href="aksi.php?act=setting_hapus&ID=<?=$row->kode_setting?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
    </td>
</tr>
<?php endforeach;
?>
</table>
</div>