<?php include_once 'templates/story/inc/header.php'; ?>
<?php
	//tổng số dòng
	$queryTSD = "SELECT COUNT(*) AS TSD FROM Story";
	$resultTSD = $mysqli->query($queryTSD);
	$arTmp = mysqli_fetch_assoc($resultTSD);
	$tongSoDong = $arTmp['TSD'];
	//số truyện 
	$row_count = ROW_COUNT;
	//tổng số trang
	$tongSoTrang = ceil($tongSoDong/$row_count);
	//trang hiện tại
	$current_page = 1;
	if(isset($_GET['page'])){
		$current_page = $_GET['page'];
	}
	//offset
	$offset = ($current_page - 1) * $row_count;
	
			
?>
<div class="content_resize">
  <div class="mainbar">
    <?php 
		$query = "SELECT * FROM STORY ORDER BY story_id DESC LIMIT {$offset},{$row_count}";
		$ketqua = $mysqli->query($query);
		while($arStory = mysqli_fetch_assoc($ketqua)){
			$storyId = $arStory['story_id'];
			$date_create = $arStory['created_at'];
			$counter = $arStory['counter'];
			$picture = $arStory['picture'];
			$preview_text = $arStory['preview_text'];
			$name = $arStory['name'];
			$urlSeo= '/detail/'.utf8ToLatin($name).'-'.$storyId.'.html';
			
	?>
    <div class="article">
      <h2><a href="<?php echo $urlSeo;?>"><?php echo $name;?></a></h2>
      <p class="infopost">Ngày đăng: <?php echo $date_create?>. Lượt đọc: <?php echo $counter;?></p>
      <div class="clr"></div>
      <div class="img">
		<?php 
			if($picture != ''){
		?>
	  <img src="templates/story/images/<?php echo $picture;?>" width="161" height="192" alt="" class="fl" /></div>
			<?php }?>
      <div class="post_content">
        <p><?php echo $preview_text;?></p>
        <p class="spec"><a href="<?php echo $urlSeo;?>" class="rm">Chi tiết</a></p>
      </div>
		
      <div class="clr"></div>
    </div>
		<?php }?>
    <p class="pages"><small>Trang <?php echo $current_page;?> của <?php echo $tongSoTrang;?></small>
		<?php 
			for($i = 1;$i <= $tongSoTrang; $i++){
		?>
			<?php 
				if($i == $current_page){
			?>
				<span><?php echo $current_page;?></span>
			<?php 
				}else{
					$urlPage= 'page'.'/'.$i;
			?>
				<a href="<?php echo $urlPage;?>"><?php echo $i;?></a>
				<?php
				}
				?>
			<?php }?>
		

		<a href="#">&raquo;</a>
	</p>
  </div>
  <div class="sidebar">
  <?php include_once 'templates/story/inc/leftbar.php'; ?>
  </div>
  <div class="clr"></div>
</div>
<?php include_once 'templates/story/inc/footer.php'; ?>
