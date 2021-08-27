<?php
    $row = $db->get_row("SELECT * FROM tb_pic WHERE kode_pic='$_GET[ID]'"); 
?>
<div class="page-header">
    <h1>Ubah PIC</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" action="?m=pic_ubah&ID=<?=$row->kode_pic?>">
            <div class="form-group">
                <label>Kode <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="kode" value="<?=$row->kode_pic?>"/>
            </div>
            <div class="form-group">
                <label>Nama PIC <span class="text-danger">*</span></label>
                <input class="form-control" type="text" name="nama" value="<?=$row->nama_pic?>"/>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=pic"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>