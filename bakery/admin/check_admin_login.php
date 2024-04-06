<?php 

if(!isset($_SESSION['level'])) {
	header('location:../index.php');
	exit;
}