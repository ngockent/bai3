<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
	session_start();
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Login</title>
</head>

<body>
	<form method="post" style="margin:auto;" enctype="multipart/form-data" action="Login.php">
	<table width="400" height="200" style="margin:auto; border-style:ridge;background:#FF0" >
    	<tr>
        	<th style="font-size:18px;font-weight:bold; color:#F00"> ĐĂNG NHẬP HỆ THỐNG </th>
        </tr>
        <tr>
        	<td style="padding-left:100px">Nhập Tên Đăng Nhập</td>
        </tr>
        <tr>
            <td style="padding-left:100px"><input type="text" name="user" size="30"/></td>
        </tr>
        <tr>
        	<td style="padding-left:100px">Nhập Mật Khẩu </td></tr><tr>
            <td style="padding-left:100px"><input type="password" name="pass" size="30"/></td>
        </tr>
        <tr>
        	<td align="center"><input type="submit" name="OK" value="Đăng nhập" /></td>
        </tr>
    </table>
</form>
	<?php
	require_once('connect.php');
		if(isset($_POST['OK']))
		{ 
			$user=$_POST['user'];
			$pass=$_POST['pass'];
			$q=mysqli_query($conn,"select * from taikhoan where user='$user' and pass='$pass'");
			$num=mysqli_num_rows($q);
			if($num!=0)
			{
				$_SESSION['user']=$user;

				header('location:hienthi.php');
			}
			else echo "Tài khoản hoặc mật khẩu không chính xác";
		}

	?>	
</body>
</html>