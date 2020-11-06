<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/utils/CheckUserUtil.php'?>
<script type = "text/javascript">
	document.title= 'Delete Story | VinaEnter Edu';
	
</script>
<?php
	if(isset($_GET['id'])){
		//lấy id từ form
		$storyId = $_GET['id'];
		//delete file
		$sqlGetStory = "SELECT picture FROM story WHERE story_id ={$storyId}";
		$resultGetStory = $mysqli -> query($sqlGetStory);
		$arStory = mysqli_fetch_assoc($resultGetStory);
		$oldPicture = $arStory['picture'];
		if(!empty($oldPicture)){  //kiểm tra có tồn tại file ko
			$pathUpload = $_SERVER['DOCUMENT_ROOT'].'/'.DIR_UPLOAD.'/'.$oldPicture;
			unlink($pathUpload); // xóa file
		}
		//handle insert database
		$sqlDelStory = "DELETE FROM story WHERE story_id ={$storyId}";
		$resultDelStory = $mysqli -> query($sqlDelStory);
		if($resultDelStory){
			//echo "Thêm danh mục thành công";
			header('location: /admin/story?msg=success');
		}else{
			echo "Có lỗi trong quá trình xóa, vui lòng kiểm tra lại";
		}
	}else{
		header('location:/');
	}
?>

<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>