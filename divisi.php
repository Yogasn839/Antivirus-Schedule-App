<div class="page-header">
    <h1>Divisi</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">        
        <form class="form-inline">
            <input type="hidden" name="m" value="divisi" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=divisi_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>Kode</th>
            <th>Nama Divisi</th>
            <th>Keterangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <?php
    $q = esc_field($_GET['q']);
    $rows = $db->get_results("SELECT * FROM tb_divisi 
    WHERE kode_divisi LIKE '%$q%' OR nama_divisi LIKE '%$q%' OR keterangan LIKE '%$q%' 
    ORDER BY kode_divisi");
    $no=0;
    foreach($rows as $row):?>
    <tr>
        <td><?=$row->kode_divisi ?></td>
        <td><?=$row->nama_divisi?></td>
        <td><?=$row->keterangan?></td>
        <td class="nw">
            <a class="btn btn-xs btn-warning" href="?m=divisi_ubah&ID=<?=$row->kode_divisi?>"><span class="glyphicon glyphicon-edit"></span></a>
            <a class="btn btn-xs btn-danger" href="aksi.php?act=divisi_hapus&ID=<?=$row->kode_divisi?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
        </td>
    </tr>
    <?php endforeach;
    ?>
    </table>
</div>