<div class="page-header">
    <h1>Manufaktur</h1>
</div>
<div class="panel panel-default">
    <div class="panel-heading">        
        <form class="form-inline">
            <input type="hidden" name="m" value="manufaktur" />
            <div class="form-group">
                <input class="form-control" type="text" placeholder="Pencarian. . ." name="q" value="<?=$_GET['q']?>" />
            </div>
            <div class="form-group">
                <button class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Refresh</a>
            </div>
            <div class="form-group">
                <a class="btn btn-primary" href="?m=manufaktur_tambah"><span class="glyphicon glyphicon-plus"></span> Tambah</a>
            </div>
        </form>
    </div>
    <table class="table table-bordered table-hover table-striped">
    <thead>
        <tr>
            <th>Kode Manufaktur</th>
            <th>Nama Manufaktur</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <?php
    $q = esc_field($_GET['q']);
    $rows = $db->get_results("SELECT * FROM tb_manufaktur 
    WHERE kode_manufaktur LIKE '%$q%' OR nama_manufaktur LIKE '%$q%'  
    ORDER BY kode_manufaktur ASC");
    $no=0;
    foreach($rows as $row):?>
    <tr>
        <td><?=$row->kode_manufaktur ?></td>
        <td><?=$row->nama_manufaktur?></td>
        <td class="nw">
            <a class="btn btn-xs btn-warning" href="?m=manufaktur_ubah&ID=<?=$row->kode_manufaktur?>"><span class="glyphicon glyphicon-edit"></span></a>
            <a class="btn btn-xs btn-danger" href="aksi.php?act=manufaktur_hapus&ID=<?=$row->kode_manufaktur?>" onclick="return confirm('Hapus data?')"><span class="glyphicon glyphicon-trash"></span></a>
        </td>
    </tr>
    <?php endforeach;
    ?>
    </table>
</div>