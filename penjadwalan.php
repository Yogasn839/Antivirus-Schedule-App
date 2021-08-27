<div class="page-header">
    <h1>Penjadwalan</h1>
</div>
<?php
$success = true;
$a = 10;
$b = 25;

if(isset($_GET['num_kromosom'])) {
    $num_kromosom = $_GET['num_kromosom'];
    if($num_kromosom<$a || $num_kromosom>500) {
        print_msg("Masukkan jumlah kromosom dari $a sampai 500");
        $success = false;
    }   
    
    $max_generation = $_GET['max_generation'];
    if($max_generation<$b || $max_generation>500) {
        print_msg("Masukkan maksimal generasi dari $b sampai 500");
        $success = false;
    } 
} else {
    $num_kromosom = $a;
    $max_generation = $b;
}
?>
<div class="row">
    <div class="col-md-6">
        <form action="?">
            <input type="hidden" name="m" value="penjadwalan" />
            <div class="form-group">
                <label>Jumlah Kromosom Dibangkitkan</label>
                <input class="form-control" type="text" name="num_kromosom" value="<?=$num_kromosom?>" />
                <p class="help-block">Masukkan antara <?=$a?>-500</p>
            </div>
            <div class="form-group">
                <label>Jumlah Generasi</label>
                <input class="form-control" type="text" name="max_generation" value="<?=$max_generation?>" />
                <p class="help-block">Masukkan antara <?=$b?>-500</p>
            </div>
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="debug" /> Tampilkan proses algoritma
                </label>
            </div>
            <button class="btn btn-primary">Generate Jadwal</button> 
            <?php if($success && isset($_GET['num_kromosom'])) :?>
            <a class="btn btn-success" href="?m=hasil" target="_blank">Lihat Jadwal</a>
            <?php endif ?>           
        </form>
    </div>
</div>
<?php
include 'assets/ag.php';

if($success && isset($_GET['num_kromosom'])) {
    echo '<hr />';
    
    $arrdivisi =  $db->get_results("SELECT kode_divisi, nama_divisi FROM tb_divisi ORDER BY kode_divisi ");
    $arrWaktu = $db->get_results("SELECT w.`kode_waktu`, w.`kode_hari`, w.`kode_jam`, h.`nama_hari`, j.`nama_jam`
    FROM tb_waktu w INNER JOIN tb_hari h ON h.`kode_hari`=w.`kode_hari` INNER JOIN tb_jam j ON j.`kode_jam`=w.`kode_jam`
    ORDER BY w.`kode_waktu`;");
    $arrKuliah = $db->get_results("SELECT k.`kode_setting`, k.`kode_pic`, k.`kode_manufaktur`, k.`kode_user`, m.`nama_pic`, m.`jumlah_jam`, d.`nama_user`	 
    FROM tb_setting k 
    	LEFT JOIN tb_user d ON d.`kode_user`=k.`kode_user`
    	LEFT JOIN tb_pic m ON m.`kode_pic`=k.`kode_pic`
    ORDER BY k.`kode_setting` ;");
    
    $ag = new AG($arrWaktu, $arrdivisi, $arrKuliah);
    $ag->num_crommosom = $num_kromosom;
    $ag->debug = $_GET['debug'];
    $ag->generate();
}
?>