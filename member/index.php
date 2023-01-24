<?php
session_start();
/**
 * Jika Tidak login atau sudah login tapi bukan sebagai admin
 * maka akan dibawa kembali kehalaman login atau menuju halaman yang seharusnya.
 */
/* 
if ( !isset($_SESSION['user_login']) || 
    ( isset($_SESSION['user_login']) && $_SESSION['user_login'] != 'member' ) ) {

	header('location:./../login.php');
	exit();
}
*/
?>
<!--
<h2>Hallo Member <?=$_SESSION['nama_user'];?> Apakabar ?</h2>

<a href="./../logout.php">Logout</a>
-->
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<nav class="navbar navbar-expand-lg navbar-light bg-light">


  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item active">
        <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="reimburse_page.php">Reimburse</a>
      </li>
      
      <li class="nav-item">
        <a class="nav-link disabled">Disabled</a>
      </li>
    </ul>
	
    <form class="form-inline my-2 my-lg-0">
      <p class="text-left"><h6> <?=$_SESSION['nama_user'];?></h6></p>
    </form>
  </div>
</nav>