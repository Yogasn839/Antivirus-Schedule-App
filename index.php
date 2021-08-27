<?php
include'functions.php';
if(empty($_SESSION['login']))
    header("location:login.php");
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <link rel="icon" href="favicon.ico"/>

    <title>AG</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="assets/css/general.css" rel="stylesheet"/>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>           
  </head>
  <body>
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="?"></a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
          <ul class="nav navbar-nav">
            <li class="dropdown">
              <a href="?m=waktu" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Setting Waktu <span class="caret"></span></a>
              <ul class="dropdown-menu">
                <li><a href="?m=waktu"><span class="glyphicon glyphicon-pushpin"></span> Data Waktu</a></li>
                <li><a href="?m=hari"><span class="glyphicon glyphicon-pushpin"></span> Hari</a></li>
                <li><a href="?m=jam"><span class="glyphicon glyphicon-pushpin"></span> Jam</a></li>
              </ul>
            </li>   
            <li class="dropdown">
              <a href="?m=setting" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Setting Jadwal <span class="caret"></span></a>
              <ul class="dropdown-menu">           
                <li><a href="?m=setting"><span class="glyphicon glyphicon-stats"></span> Setting</a></li>      
                <li><a href="?m=user"><span class="glyphicon glyphicon-star"></span> User</a></li>      
                <li><a href="?m=pic"><span class="glyphicon glyphicon-star"></span> PIC</a></li>  
                <li><a href="?m=manufaktur"><span class="glyphicon glyphicon-star"></span> Manufaktur</a></li>
              </ul>
            </li>                      
            <li><a href="?m=divisi"><span class="glyphicon glyphicon-flash"></span> Divisi</a></li>            
            <li class="dropdown">
              <a href="?m=penjadwalan" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"> Penjadwalan <span class="caret"></span></a>
              <ul class="dropdown-menu">           
                <li><a href="?m=penjadwalan"><span class="glyphicon glyphicon-stats"></span> Generate Jadwal</a></li>      
                <li><a href="?m=hasil"><span class="glyphicon glyphicon-star"></span> Hasil Jadwal</a></li>
              </ul>
            </li>        
            <li><a href="?m=password"><span class="glyphicon glyphicon-lock"></span> Password</a></li>
            <li><a href="aksi.php?act=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>
            <!--<li><a href="http://tugasakhir.web.id"><span class="glyphicon glyphicon-shopping-cart"></span> Beli</a></li>-->         
          </ul>          
        </div>
    </nav>
    <div class="container">
    <?php
        if(file_exists($mod.'.php'))
            include $mod.'.php';
        else
            include 'home.php';
    ?>
    </div>
    <footer class="footer" style="background-color: #437d54">
      <div class="container">
        <p style="color: #fff">Copyright  @ Ahzafani Media &copy; <?=date('Y')?></p>
      </div>
    </footer>
</html>