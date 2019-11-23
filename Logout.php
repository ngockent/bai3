
<?php
session_start();
// Xóa đi một biến Session
unset($_SESSION['user']);
//Xóa toàn bộ Session
session_destroy();
header('location:Login.php');
?>
