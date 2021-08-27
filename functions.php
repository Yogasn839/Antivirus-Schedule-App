<?php
include 'config.php';

function AG_get_hari_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_hari, nama_hari FROM tb_hari ORDER BY kode_hari");
    foreach($rows as $row){
        if($row->kode_hari==$selected)
            $a.="<option value='$row->kode_hari' selected>[$row->kode_hari] $row->nama_hari</option>";
        else
            $a.="<option value='$row->kode_hari'>[$row->kode_hari] $row->nama_hari</option>";
    }
    return $a;
}

function AG_get_divisi_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_divisi, nama_divisi FROM tb_divisi ORDER BY kode_divisi");
    foreach($rows as $row){
        if($row->kode_divisi==$selected)
            $a.="<option value='$row->kode_divisi' selected> $row->nama_divisi</option>";
        else
            $a.="<option value='$row->kode_divisi'> $row->nama_divisi</option>";
    }
    return $a;
}

function AG_get_jam_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_jam, nama_jam FROM tb_jam ORDER BY kode_jam");
    foreach($rows as $row){
        if($row->kode_jam==$selected)
            $a.="<option value='$row->kode_jam' selected>[$row->kode_jam] $row->nama_jam</option>";
        else
            $a.="<option value='$row->kode_jam'>[$row->kode_jam] $row->nama_jam</option>";
    }
    return $a;
}

function AG_get_pic_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_pic, nama_pic FROM tb_pic ORDER BY kode_pic");
    foreach($rows as $row){
        if($row->kode_pic==$selected)
            $a.="<option value='$row->kode_pic' selected> $row->nama_pic</option>";
        else
            $a.="<option value='$row->kode_pic'> $row->nama_pic</option>";
    }
    return $a;
}

function AG_get_manufaktur_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_manufaktur, nama_manufaktur FROM tb_manufaktur ORDER BY kode_manufaktur");
    foreach($rows as $row){
        if($row->kode_manufaktur==$selected)
            $a.="<option value='$row->kode_manufaktur' selected> $row->nama_manufaktur</option>";
        else
            $a.="<option value='$row->kode_manufaktur'> $row->nama_manufaktur</option>";
    }
    return $a;
}

// function AG_get_divisi_option($selected = ''){
//     global $db;
//     $rows = $db->get_results("SELECT * FROM tb_divisi ORDER BY kode_divisi");
//     foreach($rows as $row){
//         if($row->kode_divisi==$selected)
//             $a.="<option value='$row->kode_divisi' selected> $row->nama_divisi</option>";
//         else
//             $a.="<option value='$row->kode_divisi'> $row->nama_divisi</option>";
//     }
//     return $a;
// }

function AG_get_user_option($selected = ''){
    global $db;
    $rows = $db->get_results("SELECT kode_user, nama_user FROM tb_user ORDER BY kode_user");
    foreach($rows as $row){
        if($row->kode_user==$selected)
            $a.="<option value='$row->kode_user' selected> $row->nama_user</option>";
        else
            $a.="<option value='$row->kode_user'> $row->nama_user</option>";
    }
    return $a;
}