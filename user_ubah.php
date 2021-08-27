<?php
    $row = $db->get_row("SELECT * FROM tb_user WHERE kode_user='$_GET[ID]'"); 
?>
<div class="page-header">
    <h1>Ubah User</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" action="?m=user_ubah&ID=<?=$row->kode_user?>">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode" value="<?=$row->kode_user?>"/>
            </div>
            <div class="form-group">
                <label>Nama User <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=$row->nama_user?>"/>
            </div>
              <div class="form-group">
                <label>Divisi</label>
                <select class="form-control" name="divisi">
                    <?=AG_get_divisi_option($row->kode_divisi)?>
                </select>
                
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=user"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>