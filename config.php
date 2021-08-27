<?php
    error_reporting(~E_NOTICE & ~E_DEPRECATED & ~E_WARNING);
    session_start();
    
    ini_set('max_execution_time', 60 * 1);
    ini_set('memory_limit', '512M');
    
    $config["server"]='localhost';
    $config["username"]='root';
    $config["password"]='';
    $config["database_name"]='db_ag_remote';
    
    include'includes/ez_sql_core.php';
    include'includes/ez_sql_mysqli.php';
    $db = new ezSQL_mysqli($config['username'], $config['password'], $config['database_name'], $config['server']);
    include'includes/general.php';
    include'includes/paging.php';
        
    $mod = $_GET['m'];
    $act = $_GET['act'];                                             
?>