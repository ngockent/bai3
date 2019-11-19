<?php
	session_start();
?>
<!DOCTYPE html>
<html>

<head>
	<title>bai3</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">
	<!-- <link rel="stylesheet" href="style3.css"> -->
</head>

<body>
	<?php
	include 'connect3.php';
	include 'function3.php';
	// var_dump('<pre>');
	// var_dump(hienthi($con));
	// var_dump('</pre>');
	// die;
	?>
	<div class="container">

		<form method="POST">
			<div class="row">
				<h1 style="font-style:bold;">Yêu cầu rút tiền khỏi ví</h1>
			</div>
			<div class="col">
				<div class="row">
					<label for="sotiencanrut" class="col-md-3">Số tiền cần rút</label>
					<input type="text" name="sotiencanrut" placeholder="0">
				</div>
				<div class="row">
					<label for="hinhthuc" class="col-md-3">Hình thức</label>
					<div class="col">
						<input type="radio" name="hinhthuc" checked>Tiền mặt<br>
						<input type="radio" name="hinhthuc">Chuyển khoản
					</div>
				</div>
				<div class="row">
					<label class="col-md-3">Ngân hàng</label>
					<input type="text" name="nganhang">
				</div>
				<div class="row">
					<label for="chinhanh" class="col-md-3">Chi nhánh</label>
					<select name="chinhanh">
						<?php 
							foreach(hienthi($con) as $key => $value)
							{
						?>
						<option value="<?php echo $value['DiaChiNganHang']?>"><?php echo $value['DiaChiNganHang']?></option>
						<?php }?>
					</select>					
					<!-- <input type="text" name="chinhanh" value="<?php laythongtin($con)?>"> -->
				</div>
				<div class="row">
					<label for="sotk" class="col-md-3">Số tài khoản nhận tiền</label>
					<input type="text" name="sotk">
				</div>
				<div class="row">
					<label for="tentk" class="col-md-3">Tên người nhận</label>
					<input type="text" name="tentk">
				</div>
				<div class="row">
					<label for="ghichu" class="col-md-3">Ghi chú</label>
					<textarea name="ghichu" id="" cols="30" rows="2"></textarea>
				</div>
				<div class="row">
					<label for="matkhau" class="col-md-3">Mật khẩu ví điện tử</label>
					<input type="text" name="matkhau">
				</div>
				<div class="row-md-12">
					<input type="submit" name="OK" class="btn btn-primary" value="Gửi yêu cầu rút tiền">
				</div>
			</div>
		</form>
	</div>
</body>
</html>