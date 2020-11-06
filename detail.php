<?php include_once 'templates/story/inc/header.php'; ?>
<?php 
	$id = $_GET['id'];
	$query = "SELECT * FROM STORY WHERE story_id = {$id}";
	$ketqua = $mysqli->query($query);
	$arStory = mysqli_fetch_assoc($ketqua);
?>
<script type = "text/javascript">
	document.title= '<?php echo $arStory["name"]?>';
	
</script>
<div class="content_resize">
  <div class="mainbar">
    <div class="article">
      <h1><?php echo $arStory['name'];?></h1>
      
      <p>Ngày đăng: <?php echo $arStory['created_at']?>. Lượt đọc: <?php echo $arStory['counter'];?></p>
      <div class="vnecontent">
          <p><?php echo $arStory['detail_text'];?></p>
          
      </div>
    </div>
    
    <div class="article">
      <h2><span>3</span> Truyện liên quan</h2>
     
      <?php 
		$queryLQ = "SELECT * FROM STORY WHERE story_id != {$id} AND cat_id = {$arStory['cat_id']} ORDER BY story_id DESC LIMIT 3";
		$ketquaLQ = $mysqli->query($queryLQ);
		while ($arStoryLQ = mysqli_fetch_assoc($ketquaLQ)){
			$name=$arStoryLQ['name'];
			$storyId=$arStoryLQ['story_id'];
			$urlSeo= '/detail/'.utf8ToLatin($name).'-'.$storyId.'.html';
	  ?>
	  <?php
		if($arStoryLQ['picture'] != ''){
	  ?>
      <div class="comment"> 
	  
	  
	  <a href="<?php echo $urlSeo;?>"><img src="/templates/story/images/<?php echo $arStoryLQ['picture'];?>" width="40" height="40" alt="" class="userpic" /></a>
		<?php }?>
        <h3><a href="<?php echo $urlSeo;?>" title=""><?php echo $name	;?></a></h3>
	
        <p></p>
      </div>
		<?php }?>
      
    </div>
	
  </div>
	<div class="sidebar">
		<?php include_once 'templates/story/inc/leftbar.php'; ?>
	</div>

  <div class="clr"></div>
</div>
<?php include_once 'templates/story/inc/footer.php'; ?>
  
