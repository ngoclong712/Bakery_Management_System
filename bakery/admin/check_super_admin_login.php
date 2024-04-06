<?php 

if(empty($_SESSION['level'])) {
	header('location:../index.php');
	exit;
}