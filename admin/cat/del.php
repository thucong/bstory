<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/utils/CheckUserUtil.php'?>
<script type = "text/javascript">
	document.title= ' Delete Cat | VinaEnter Edu';
	
</script>
<?php
	if(isset($_GET['id'])){
		//lấy id từ form
		$catId = $_GET['id'];
		$sqlDelCat = "DELETE FROM cat WHERE cat_id ={$catId}";
		$resultDelCat = $mysqli -> query($sqlDelCat);
		if($resultDelCat){
			//echo "Thêm danh mục thành công";
			header('location: /admin/cat?msg=success');
		}else{
			echo "Có lỗi trong quá trình xóa, vui lòng kiểm tra lại";
		}
	}else{
		header('location:/');
	}
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>