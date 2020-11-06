<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/utils/CheckUserUtil.php'?>
<script type = "text/javascript">
	document.title= ' Delete User | VinaEnter Edu';
	
</script>
<?php
	$id = $_GET['id'];
	$query2 = "SELECT *  FROM users WHERE id = {$id}";
	$ketqua2 = $mysqli->query($query2);
	$arUser = mysqli_fetch_assoc($ketqua2);
	if($arUser['username'] == 'admin' && $_SESSION['arUser']['username'] != 'admin'){
		header("location:index.php?msg=Bạn không có quyền xóa admin");
		die();
	}
	$query = "DELETE FROM users WHERE id = {$id}";
	$ketqua = $mysqli->query($query);
	if($ketqua){
		header("location:index.php?msg=Xóa thành công");
		die();
	}else{
		echo "Có lỗi khi xóa người dùng";
		die();
	}
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>