<?php
include 'connect3.php';

function laythongtin($con)
{
    $sql = "select * from ruttien where 'id'";
    $exe = mysqli_query($con, $sql);
    $num = mysqli_fetch_array($exe);
    return $num;
}
function hienthi($con)
{
    $sql = "select * from ruttien where id";
    $exe = mysqli_query($con, $sql);
    $a = [];
    while ($num = mysqli_fetch_array($exe)){
        array_push($a,$num);
    }
    return $a;
}
?>