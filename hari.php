<div class="page-header">
    <h1>Hari</h1>
</div>
<div class="panel panel-default">
<div class="panel-heading">
    <form class="form-inline">
        <input type="hidden" name="m" value="hari" />
        <div class="form-group">
            <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
        </div>
        <div class="form-group">
            <a class="btn btn-primary" href="?m=hari_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
        </div>
    </form>
</div>

<table class="table table-bordered table-hover table-striped">
<thead>
    <tr class="nw">
        <th>No</th>
        <th>Kode</th>
        <th>Hari</th>
        <th>Aksi</th>
    </tr>
</thead>
<?php
$q = esc_field($_GET['q']);
$rows = $db->get_results("SELECT *
    FROM tb_hari j
    ORDER BY j.`kode_hari`");
$no=0;

foreach($rows as $row):?>
<tr>
    <td><?=++$no ?></td>
    <td><?=$row->kode_hari?></td>
    <td><?=$row->nama_hari?></td>
    <td class="nw">
        <a class="btn btn-xs btn-warning" href="?m=hari_ubah&ID=<?=$row->kode_hari?>"><span class="glyphicon glyphicon-edit"></span></a>
        <a class="btn btn-xs btn-danger" href="aksi.php?act=hari_hapus&ID=<?=$row->kode_hari?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
    </td>
</tr>
<?php endforeach;
?>
</table>
</div>