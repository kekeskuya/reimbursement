<?php
session_start();

# check apakah ada akse post dari halaman login?, jika tidak kembali kehalaman depan
if( !isset($_POST['username']) ) { header('location:index.php'); exit(); }

# set nilai default dari error,
$error = '';

require ('connection.php');

$username = trim( $_POST['username'] );
$password = trim( $_POST['password'] );


if( strlen($username) < 2 )
{
	# jika ada error dari kolom username yang kosong
	$error = 'Username tidak boleh kosong';

}else if( strlen($password) < 2 )
{
	# jika ada error dari kolom password yang kosong
	$error = 'Password Tidak boleh kosong';

}else{
	
	//print_r($_POST);exit;

	# Escape String, ubah semua karakter ke bentuk string
	$username = $koneksi->escape_string($username);
	$password = $koneksi->escape_string($password);

	# hash dengan md5
	$password = md5($password);

	# SQL command untuk memilih data berdasarkan parameter $username dan $password yang 
	# di inputkan
	$sql = "SELECT first_name,last_name,access_id,user_id FROM ult_users 
			WHERE user_name='$username' 
			AND password='$password' LIMIT 1";
    //print_r($sql);exit;
	# melakukan perintah
	$query = $koneksi->query($sql);

	# check query
	if( !$query )
	{
		die( 'Oops!! Database gagal '. $koneksi->error );
	}

	# check hasil perintah
	if( $query->num_rows == 1 )
	{	
		# jika data yang dimaksud ada
		# maka ditampilkan
		$row =$query->fetch_assoc();
		
		# data nama disimpan di session browser
		$_SESSION['user_login'] = $row['user_id'];
		$_SESSION['nama_user'] = $row['first_name'].' '.$row['last_name']; 
		$_SESSION['akses']	   = $row['access_id'];
		$url = '';
		//print_r($_SESSION);exit;
        
		
		if( $row['access_id'] == '1')
		{
			# data hak Admin di set
			$akses = 'admin';
			$_SESSION['saya_admin']= 'TRUE';
		}else{
			$akses = 'member';
			$_SESSION['saya_admin']= 'FALSE';
		}

		# menuju halaman sesuai hak akses
		//header('location:'.$url.'/'.$akses.'/index.php');
		header("Location: http://localhost/ultech/member/index.php");
		exit();

	}else{
		
		# jika data yang dimaksud tidak ada
		$error = 'Username dan Password Tidak ditemukan';
	}

}

if( !empty($error) )
{
	# simpan error pada session
	$_SESSION['error'] = $error;
	header('location:'.$url.'/login.php');
	exit();
}