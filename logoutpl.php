<?php 
session_destroy();

echo "<script>alert('Anda telah logout');</script>";
echo "<script>window.location.href='?page=halutama';</script>";

?>