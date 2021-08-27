<?php
    $row = $db->get_row("SELECT * FROM tb_waktu WHERE kode_waktu='$_GET[ID]'"); 
?>
<div class="page-header">
    <h1>Ubah Waktu</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" action="?m=waktu_ubah&ID=<?=$row->kode_waktu?>">
            <div class="form-group">
                <label>Hari <span class="text-danger">*</span></label>
                <select class="form-control" name="kode_hari">
                    <option value=""></option>
                    <?=AG_get_hari_option($row->kode_hari)?>
                </select>
            </div>
            <div class="form-group">
                <label>Jam <span class="text-danger">*</span></label>
                <select class="form-control" name="kode_jam">
                    <option value=""></option>
                    <?=AG_get_jam_option($row->kode_jam)?>
                </select>
            </div>
            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=waktu"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>