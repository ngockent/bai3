<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
if(!isset($_SESSION['user'])) header('location:Login.php');

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Trang chủ</title>
<style>
a { text-decoration: none; color:#0099FF;}
a:hover { text-decoration:underline;
			color:#F00;}

</style>
</head>

<body>
<form method="post">
<?php require_once('connect.php');
	$user=$_SESSION['user'];
				$q=mysqli_query($conn,"select * from taikhoan where user='$user'");
				$num=mysqli_fetch_array($q);
			if($num!=0)
				echo "Xin chào: ".$num['hoten']." - đăng nhập vào hệ thống";
	?>
<br><a href="Logout.php" style="font-size:18px;font-weight:bold">Thoát khỏi hệ thống</a> - <a href="ruttien.php" style="font-size:18px;font-weight:bold">Rút tiền</a>
<div style="width:1000px; margin:auto; color:#09F; font-size:24px; font-weight:bold" align="center">DANH SÁCH YÊU CẦU RÚT TIỀN</div>
 <table  height="auto" width="1000px" style="margin:auto" border="1" cellpadding="0" cellspacing="0">
        <tr bgcolor="#CCFF66">
    	<th height="25px"><h4>Mã giao dịch</h4></th>
        <th><h4>Hình thức</h4></th>
        <th><h4>Số tài khoản nhận</h4></th>
        <th><h4>Họ tên người nhận</h4></th>
        <th><h4>Ngân hàng</h4></th>
        <th><h4>Chi nhánh</h4></th> 
        <th><h4>Tổng tiền</h4></th>
        <th><h4>Ghi chú</h4></th>
        <th colspan="2"><h4>Tùy chọn</h4></th>
    </tr>
<?php
		$stk=$num['stk'];
		$sql=mysqli_query($conn,"select * from ruttien where stk='$stk'");
		while($num1=mysqli_fetch_array($sql))
		{?>
        	<tr>
				<td height="30px"><?php echo $num1['ID'];?></td>
                <td><?php echo $num1['hinhthuc'];?></td>
            	<td><?php echo $num1['stknhan'];?></td>
                <td><?php echo $num1['tenngnhan'];?></td>
                <td><?php echo $num1['nganhang'];?></td>
                <td><?php echo $num1['chinhanh'];?></td>
                <td><?php echo $num1['money'];?></td>
                <td><?php echo $num1['ghichu'];?></td>
                <td><a href='Xoa.php?Xoa=<?php echo $num1['ID'];?>' 
                onclick="if( confirm('Bạn có muốn xóa?')) return true; else return false;">Xóa</a></td>
                <td><a href='Sua.php?Sua=<?php echo $num1['ID'];?>'>Sửa</a></td>
            </tr>		
            <?php }?>
        </table>
    </form>
</div>
</body>
</html>