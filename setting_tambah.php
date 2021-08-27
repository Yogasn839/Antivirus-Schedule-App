<div class="page-header">
    <h1>Tambah Setting</h1>
</div>
<div class="row">
    <div class="col-sm-6">
        <?php if($_POST) include'aksi.php'?>
        <form method="post" action="?m=setting_tambah">
            <div class="form-group">
                <label> PIC<span class="text-danger">*</span></label>
                <select class="form-control" name="kode_pic">
                    <option value=""></option>
                    <?=AG_get_pic_option($_POST['kode_pic'])?>
                </select>
            </div>
            <div class="form-group">
                <label>Manufaktur <span class="text-danger">*</span></label>
                <select class="form-control" name="kode_manufaktur">
                    <option value=""></option>
                    <?=AG_get_manufaktur_option($_POST['kode_manufaktur'])?>
                </select>
            </div>
            <div class="form-group">
                <label>User <span class="text-danger">*</span></label>
                <select class="form-control" name="kode_user">
                    <option value=""></option>
                    <?=AG_get_user_option($_POST['kode_user'])?>
                </select>
            </div>

            <div class="form-group">
                <button class="btn btn-primary"><span class="glyphicon glyphicon-save"></span> Simpan</button>
                <a class="btn btn-danger" href="?m=setting"><span class="glyphicon glyphicon-arrow-left"></span> Kembali</a>
            </div>
        </form>
    </div>
</div>