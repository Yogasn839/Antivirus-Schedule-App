<?php
require_once'functions.php';
$demo = false;

/** LOGIN */ 
if ($act=='login'){
    $user = esc_field($_POST['user']);
    $pass = esc_field($_POST['pass']);
    
    $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$user' AND pass='$pass'");
    if($row){
        $_SESSION['login'] = $row->user;
        redirect_js("index.php");
    } else{
        print_msg("Salah kombinasi username dan password.");
    }          
}
if($demo && $act != 'login'){
    echo('<script>alert("Tidak diijinkan menambah, mengubah, dan menghapus data pada versi DEMO ini!")</script>');
    if($mod=='waktu_tambah' || $mod=='waktu_ubah' || $act=='waktu_hapus')
        redirect_js("index.php?m=waktu");
    if($mod=='divisi_tambah' || $mod=='divisi_ubah' || $act=='divisi_hapus')
        redirect_js("index.php?m=divisi");
    if($mod=='relasi_tambah' || $mod=='relasi_ubah' || $act=='relasi_hapus')
        redirect_js("index.php?m=relasi");                   
}else{     
    if ($mod=='password'){
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        $pass3 = $_POST['pass3'];
        
        $row = $db->get_row("SELECT * FROM tb_admin WHERE user='$_SESSION[login]' AND pass='$pass1'");        
        
        if($pass1=='' || $pass2=='' || $pass3=='')
            print_msg('Field bertanda * harus diisi.');
        elseif(!$row)
            print_msg('Password lama salah.');
        elseif( $pass2 != $pass3 )
            print_msg('Password baru dan konfirmasi password baru tidak sama.');
        else{        
            $db->query("UPDATE tb_admin SET pass='$pass2' WHERE user='$_SESSION[login]'");                    
            print_msg('Password berhasil diubah.', 'success');
        }
    } elseif($act=='logout'){
        unset($_SESSION[login]);
        header("location:login.php");
    }
    
    /** JAM */    
    if($mod=='jam_tambah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        
        if($kode=='' || $nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        elseif($db->get_results("SELECT * FROM tb_jam WHERE kode_jam='$kode'"))
            print_msg("Kode sudah ada!");
        else{
            $db->query("INSERT INTO tb_jam (kode_jam, nama_jam) VALUES ('$kode', '$nama')");                                    
            redirect_js("index.php?m=jam");
        }                    
    } else if($mod=='jam_ubah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        
        if($kode=='' || $nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        else{
            $db->query("UPDATE tb_jam SET nama_jam='$nama'WHERE kode_jam='$_GET[ID]'");
            redirect_js("index.php?m=jam");
        }    
    } else if ($act=='jam_hapus'){
        $db->query("DELETE FROM tb_jam WHERE kode_jam='$_GET[ID]'");
        $db->query("DELETE FROM tb_waktu WHERE kode_jam='$_GET[ID]'"); 
        header("location:index.php?m=jam");
    } 
    
    /** HARI */    
    if($mod=='hari_tambah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        
        if($kode=='' || $nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        elseif($db->get_results("SELECT * FROM tb_hari WHERE kode_hari='$kode'"))
            print_msg("Kode sudah ada!");
        else{
            $db->query("INSERT INTO tb_hari (kode_hari, nama_hari) VALUES ('$kode', '$nama')");                                    
            redirect_js("index.php?m=hari");
        }                    
    } else if($mod=='hari_ubah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        
        if($kode=='' || $nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        else{
            $db->query("UPDATE tb_hari SET nama_hari='$nama'WHERE kode_hari='$_GET[ID]'");
            redirect_js("index.php?m=hari");
        }    
    } else if ($act=='hari_hapus'){
        $db->query("DELETE FROM tb_hari WHERE kode_hari='$_GET[ID]'");
        $db->query("DELETE FROM tb_waktu WHERE kode_hari='$_GET[ID]'"); 
        header("location:index.php?m=hari");
    } 
    
    /** WAKTU */
    elseif($mod=='waktu_tambah'){
        $kode_hari  = $_POST['kode_hari'];
        $kode_jam   = $_POST['kode_jam'];        
        if($kode_hari=='' || $kode_jam=='')
            print_msg("Field yang bertanda * tidak boleh kosong!");
        elseif($db->get_row("SELECT * FROM tb_waktu WHERE kode_hari='$kode_hari' AND kode_jam='$kode_jam'"))
            print_msg("Kombinasi hari dan jam sudah ada!");
        else{
            $db->query("INSERT INTO tb_waktu (kode_hari, kode_jam) VALUES ('$kode_hari', '$kode_jam')");                       
            redirect_js("index.php?m=waktu");
        }
    } else if($mod=='waktu_ubah'){
        $kode_hari  = $_POST['kode_hari'];
        $kode_jam   = $_POST['kode_jam'];  
        if($kode_hari=='' || $kode_jam=='')
            print_msg("Field yang bertanda * tidak boleh kosong!");
        elseif($db->get_row("SELECT * FROM tb_waktu WHERE kode_hari='$kode_hari' AND kode_jam='$kode_jam' AND kode_waktu<>'$_GET[ID]'"))
            print_msg("Kombinasi hari dan jam sudah ada!");
        else{
            $db->query("UPDATE tb_waktu SET kode_hari='$kode_hari', kode_jam='$kode_jam' WHERE kode_waktu='$_GET[ID]'");
            redirect_js("index.php?m=waktu");
        }
    } else if ($act=='waktu_hapus'){
        $db->query("DELETE FROM tb_waktu WHERE kode_waktu='$_GET[ID]'");
        header("location:index.php?m=waktu");
    } 


    
    /** divisi */    
    if($mod=='divisi_tambah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $keterangan = $_POST['keterangan'];
        
        if($kode=='' || $nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        elseif($db->get_results("SELECT * FROM tb_divisi WHERE kode_divisi='$kode'"))
            print_msg("Kode sudah ada!");
        else{
            $db->query("INSERT INTO tb_divisi (kode_divisi, nama_divisi, keterangan) VALUES ('$kode', '$nama', '$keterangan')");                       
            redirect_js("index.php?m=divisi");
        }                    
    } else if($mod=='divisi_ubah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $keterangan = $_POST['keterangan'];
        
        if($kode=='' || $nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        else{
            $db->query("UPDATE tb_divisi SET kode_divisi='$kode',nama_divisi='$nama', keterangan='$keterangan' WHERE kode_divisi='$_GET[ID]'");
            redirect_js("index.php?m=divisi");
        }    
    } else if ($act=='divisi_hapus'){
        $db->query("DELETE FROM tb_divisi WHERE kode_divisi='$_GET[ID]'");
        header("location:index.php?m=divisi");
    } 
    


    /** user */    
    if($mod=='user_tambah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $divisi = $_POST['divisi'];
        
        if($kode=='' || $nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        elseif($db->get_results("SELECT * FROM tb_user WHERE kode_user='$kode'"))
            print_msg("Kode sudah ada!");
        else{
            $db->query("INSERT INTO tb_user (kode_user, nama_user, keterangan,kode_divisi) VALUES ('$kode', '$nama', '','$divisi')");                       
            redirect_js("index.php?m=user");
        }                    
    } else if($mod=='user_ubah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        $divisi = $_POST['divisi'];
        
        if($kode=='' || $nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        else{
            $db->query("UPDATE tb_user SET kode_user='$kode',nama_user='$nama', kode_divisi='$divisi' WHERE kode_user='$_GET[ID]'");
            redirect_js("index.php?m=user");
        }    
    } else if ($act=='user_hapus'){
        $db->query("DELETE FROM tb_user WHERE kode_user='$_GET[ID]'");
        $db->query("DELETE FROM tb_setting WHERE kode_user='$_GET[ID]'");
        header("location:index.php?m=user");
    } 
    
    /** manufaktur */    
    elseif($mod=='manufaktur_tambah'){
        $kode  = $_POST['kode'];
        $nama   = $_POST['nama'];   
        if($kode=='' || $nama=='')
            print_msg("Field yang bertanda * tidak boleh kosong!");
        elseif($db->get_row("SELECT * FROM tb_manufaktur WHERE kode_manufaktur='$kode'"))
            print_msg("Kode manufaktur sudah ada!");
        else{
            $db->query("INSERT INTO tb_manufaktur (kode_manufaktur, nama_manufaktur) VALUES ('$kode','$nama')");                       
            redirect_js("index.php?m=manufaktur");
        }
    } else if($mod=='manufaktur_ubah'){
        $kode  = $_POST['kode'];
        $nama   = $_POST['nama']; 
        if($kode=='' || $nama=='')
            print_msg("Field yang bertanda * tidak boleh kosong!");
        elseif($db->get_row("SELECT * FROM tb_manufaktur WHERE kode_manufaktur='$kode' AND kode_manufaktur<>'$_GET[ID]'"))
            print_msg("Kode manufaktur sudah ada!");
        else{
            $db->query("UPDATE tb_manufaktur SET kode_manufaktur='$kode',nama_manufaktur='$nama' WHERE kode_manufaktur='$_GET[ID]'");
            redirect_js("index.php?m=manufaktur");
        }
    } else if ($act=='manufaktur_hapus'){
        $db->query("DELETE FROM tb_manufaktur WHERE kode_manufaktur='$_GET[ID]'");
        $db->query("DELETE FROM tb_setting WHERE kode_manufaktur='$_GET[ID]'");
        header("location:index.php?m=manufaktur");
    } 
        
    /** pic */    
    if($mod=='pic_tambah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        
        if($kode=='' || $nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        elseif($db->get_results("SELECT * FROM tb_pic WHERE kode_pic='$kode'"))
            print_msg("Kode sudah ada!");
        else{
            $db->query("INSERT INTO tb_pic (kode_pic, nama_pic, jumlah_jam) VALUES ('$kode', '$nama', 1)");                       
            redirect_js("index.php?m=pic");
        }                    
    } else if($mod=='pic_ubah'){
        $kode = $_POST['kode'];
        $nama = $_POST['nama'];
        
        if($kode=='' || $nama=='')
            print_msg("Field bertanda * tidak boleh kosong!");
        else{
            $db->query("UPDATE tb_pic SET kode_pic='$kode',nama_pic='$nama' WHERE kode_pic='$_GET[ID]'");
            redirect_js("index.php?m=pic");
        }    
    } else if ($act=='pic_hapus'){
        $db->query("DELETE FROM tb_pic WHERE kode_pic='$_GET[ID]'");
        $db->query("DELETE FROM tb_setting WHERE kode_pic='$_GET[ID]'");
        header("location:index.php?m=pic");
    }    
    
    /** setting */
    elseif($mod=='setting_tambah'){
        $kode_pic  = $_POST['kode_pic'];
        $kode_manufaktur   = $_POST['kode_manufaktur'];   
        $kode_user   = $_POST['kode_user'];        
        if($kode_pic=='' || $kode_manufaktur=='' || $kode_user=='')
            print_msg("Field yang bertanda * tidak boleh kosong!");
        elseif($db->get_row("SELECT * FROM tb_setting WHERE kode_pic='$kode_pic' AND kode_manufaktur='$kode_manufaktur' AND kode_user='$kode_user'"))
            print_msg("Sudah didaftarkan dengan kombinasi ini!!!");
        else{
            $db->query("INSERT INTO tb_setting (kode_pic, kode_manufaktur, kode_user) VALUES ('$kode_pic', '$kode_manufaktur', '$kode_user')");                       
            redirect_js("index.php?m=setting");
        }
    } else if($mod=='setting_ubah'){
        $kode_pic  = $_POST['kode_pic'];
        $kode_manufaktur   = $_POST['kode_manufaktur'];     
        $kode_user   = $_POST['kode_user']; 
        if($kode_pic=='' || $kode_manufaktur=='' || $kode_user=='')
            print_msg("Field yang bertanda * tidak boleh kosong!");
        elseif($db->get_row("SELECT * FROM tb_setting WHERE kode_pic='$kode_pic' AND kode_manufaktur='$kode_manufaktur' AND kode_user='$kode_user' AND kode_setting<>'$_GET[ID]'"))
            print_msg("Kombinasi sudah ada!");
        else{
            $db->query("UPDATE tb_setting SET kode_pic='$kode_pic', kode_manufaktur='$kode_manufaktur', kode_user='$kode_user' WHERE kode_setting='$_GET[ID]'");
            redirect_js("index.php?m=setting");
        }
    } else if ($act=='setting_hapus'){
        $db->query("DELETE FROM tb_setting WHERE kode_setting='$_GET[ID]'");
        header("location:index.php?m=setting");
    } 
}
?>
