<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?php
session_start();
if(!isset($_SESSION['user'])) header('location:Login.php');

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<style>
a { text-decoration: none; color:#0099FF;}
a:hover { text-decoration:underline;
			color:#F00;}
#submit{
		height:30px;
		border:1px solid;
		background-color:#09F;
		font-weight:bold;
		color:#FFF;
	}
#submit:hover{
		background-color:#FFF;
		color:#F00;
	}
</style>
</head>

<body>
<?php require_once('connect.php');
	$user=$_SESSION['user'];
	$ID=$_GET['Sua'];
				$q=mysqli_query($conn,"select * from taikhoan where user='$user'");
				$num=mysqli_fetch_array($q);
			if($num!=0)
				echo "Xin chào: ".$num['hoten']." - đăng nhập vào hệ thống";
	?>
    <br><a href="Logout.php" style="font-size:18px; font-weight:bold">Thoát khỏi hệ thống</a> - <a href="hienthi.php" style="font-size:18px; font-weight:bold">Danh sách yêu cầu</a>
    <form method="post">
    <?php
		$sql=mysqli_query($conn,"select * from ruttien where ID='$ID'");
		$number=mysqli_fetch_array($sql);
		if($number!=0)
		{
			$stk=$number['stk'];
			$tien=$number['money'];
			$stknhan=$number['stknhan'];
			$tenngnhan=$number['tenngnhan'];
			$hinhthuc=$number['hinhthuc'];
			$nganhang=$number['nganhang'];
			$chinhanh=$number['chinhanh'];
			$ghichu=$number['ghichu'];
		}
	?>
	 <table width="450" style="margin:auto; border-style:ridge;" >
    	<tr>
        	<th  colspan="2" style="font-size:15px; color:#0099FF" align="left"> CẬP NHẬT YÊU CẦU RÚT TIỀN KHỎI VÍ </th>
        </tr>
        <tr>
        	<td colspan="2" bgcolor="#66FFFF"><marquee style="color:#000; font-weight:bold; marquee-speed:fast">Số tiền cần rút phải >=10,000đ và <= Số dư trong tài khoản của bạn và số làm tròn đến 1,000đ</marquee></td>
        </tr>
        <tr>
        	<th style="color:#0033FF; width:180px; padding-left:10px" align="left">Số tiền cần rút</th>
            <td><input type="number" name="tien" size="20px" value="<?php echo $tien;?>"/></td>
        </tr>
        <tr>
        <th style="color:#0033FF; width:180px; padding-left:10px; padding-top:0px" align="left">Hình thức</th>
            <td><input type="radio" name="hinhthuc" value="Tiền mặt" <?php if($hinhthuc=="Tiền mặt") echo "checked"; ?>/> Tiền mặt<br />
            <input type="radio" name="hinhthuc" value="Chuyển khoản" <?php if($hinhthuc=="Chuyển khoản") echo "checked"; ?> /> Chuyển khoản</td>
        </tr>
        <tr>
        <th style="color:#0033FF; width:180px; padding-left:10px" align="left">Ngân hàng</th>
            <td><select name="nganhang">
				<option value="" selected="selected"></option>
				<?php $q1=mysqli_query($conn,"select * from nganhang	");
			while($num1=mysqli_fetch_array($q1))
		{?>
        	<option value="<?php echo $num1['nganhang'];?>" <?php if($nganhang==$num1['nganhang']) echo "selected"; ?>><?php echo $num1['nganhang'];?></option>
            <?php
			
		}?>
        </select></td>
        </tr>
        <tr>
        <th style="color:#0033FF; width:180px; padding-left:10px" align="left">Chi nhánh</th>
            <td><select name="chinhanh">
			<option value="" selected="selected"></option>
			<?php $q2=mysqli_query($conn,"select * from chinhanh");
			while($num2=mysqli_fetch_array($q2))
		{?>
        	<option value="<?php echo $num2['chinhanh'];?>" <?php if($chinhanh==$num2
			['chinhanh']) echo "selected"; ?>><?php echo $num2['chinhanh'];?></option>
            <?php
			
		}?>
        </select></td>
        </tr>
        <tr>
        <th style="color:#0033FF; width:180px; padding-left:10px" align="left">Số tài khoản nhận</th>
            <td><input type="text" name="stknhan" size="30px" value="<?php echo $stknhan;?>"/></td>
        </tr>
        <tr>
        <th style="color:#0033FF; width:180px; padding-left:10px" align="left">Tên người nhận</th>
            <td><input type="text" name="tenngnhan" size="30px" value="<?php echo $tenngnhan;?>"/></td>
        </tr>
        <tr>
        <th style="color:#0033FF; width:180px; padding-left:10px" align="left">Ghi chú</th>
            <td><textarea name="ghichu" cols="32" rows="3"><?php echo $ghichu;?></textarea></td>
        </tr>
        <tr>
        <th style="color:#0033FF; width:180px; padding-left:10px" align="left">Mật khẩu ví điện tử</th>
            <td><input type="password" name="OTP" size="20px"/></td>
        </tr>
        <tr align="center">
            <td colspan="2"><input type="submit"  id="submit" name="rut" value="Cập nhật yêu cầu rút tiền"/></td>
        </tr>
     </table>
  	</form>
    <?php
		if(isset($_POST['rut']))
		{
			$user=$_SESSION['user'];
			$tien=$_POST['tien'];
			$stknhan=$_POST['stknhan'];
			$tenngnhan=$_POST['tenngnhan'];
			$hinhthuc=$_POST['hinhthuc'];
			$nganhang= $_POST['nganhang'];
			$chinhanh=$_POST['chinhanh'];
			$ghichu=$_POST['ghichu'];
			$OTP=$_POST['OTP'];
			$stk=$num['stk'];
			
			if($OTP== $num['OTP'])
			{
				if($hinhthuc=="Tiền mặt")
				{
					require_once('connect.php');
					if(($tien <= ($num['money']-10000)) && ($tien >= 10000) && ($tien % 1000 == 0))
					{
						$q3=mysqli_query($conn,"Update ruttien set stk='$stk',stknhan='',tenngnhan='',nganhang='',chinhanh='',hinhthuc='$hinhthuc',money='$tien',ghichu='$ghichu' where ID='$ID'");
						if($q3) 
							echo"<script> alert('Cập nhật yêu cầu rút tiền thành công')</script>";
						else echo"<script> alert('Cập nhật yêu cầu rút tiền không thành công')</script>";
					} else echo "<script> alert('Số tiền cần rút phải >=10,000đ và <= Số dư trong tài khoản của bạn và số làm tròn đến 1,000đ')</script>";
						
				}
				if($hinhthuc=="Chuyển khoản")
				{
					require_once('connect.php');
	
					if(($tien <= ($num['money']-10000)) && ($tien >= 10000) && ($tien % 1000 == 0))
					{
						if($stknhan!="" && $tenngnhan!="" && $nganhang!="" && $chinhanh!="")
						{
							$q5=mysqli_query($conn,"select * from taikhoan where stk='$stknhan' and nganhang='$nganhang' and chinhanh='$chinhanh'");
							$num5=mysqli_fetch_array($q5);
							if($num5!=0)
							{
								$q4=mysqli_query($conn,"Update ruttien set stk='$stk',stknhan='$stknhan',tenngnhan='$tenngnhan',nganhang='$nganhang',chinhanh='$chinhanh',hinhthuc='$hinhthuc',money='$tien', ghichu='$ghichu' where ID='$ID'");
								if($q4) 
									echo"<script> alert('Cập nhật yêu cầu rút tiền thành công')</script>";
								else echo"<script> alert('Cập nhật yêu cầu rút tiền không thành công')</script>";
							}
							else echo "<script> alert('Vui lòng nhập đúng ngân hàng, chi nhánh, số tài khoản của người nhận tiền!!!')</script>";
						 } else echo"<script> alert('Không được để trống số tài khoản nhận, tên người nhận, ngân hàng hoặc chi nhánh!!!')</script>";
					} else echo "<script> alert('Số tiền cần rút phải >=10,000đ và <= Số dư trong tài khoản của bạn và số làm tròn đến 1,000đ')</script>";		
				}
			}
			else echo "<script> alert('Mã giao dịch không đúng!!!')</script>";
			
		}
		if(isset($_POST['home']))
			header('location:hienthi.php');
	?>
</body>
</html>