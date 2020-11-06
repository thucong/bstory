<div class="gadget">
  <h2 class="star">Danh mục truyện</h2>
  <div class="clr"></div>
  <ul class="sb_menu">
	<?php 
		$id =0;
		if(isset($_GET['id'])){
			$id = $_GET['id'];
		}
		$query = "SELECT * FROM cat";
		$ketqua = $mysqli->query($query);
		while($arCat = mysqli_fetch_assoc($ketqua)){
			$catId=$arCat['cat_id'];
			$name=$arCat['name'];
			//^cat/(.*)-([0-9]+).html$
			$urlSeo= '/cat/'.utf8ToLatin($name).'-'.$catId.'.html';
			if($id == $catId){
	?>
	
    <li><a href="<?php echo $urlSeo;?>"><span style="font-weight: bold"><?php echo $arCat['name']?></a></span></li>
			<?php }else{?>
			 <li><a href="<?php echo $urlSeo;?>"><?php echo $arCat['name']?></a></li>
		<?php }}?>
  </ul>
</div>

<div class="gadget">
  <h2 class="star"><span>Truyện mới</span></h2>
  <div class="clr"></div>
  <ul class="ex_menu">
	<?php 
		$query2 = "SELECT * FROM STORY ORDER BY story_id DESC LIMIT 3";
		$ketqua2 = $mysqli->query($query2);
		while($arStory = mysqli_fetch_assoc($ketqua2)){
			$name=$arStory['name'];
			$id=$arStory['story_id'];
			$urlSeo1= '/detail/'.utf8ToLatin($name).'-'.$id.'.html';
	?>
    <li><a href="<?php echo $urlSeo1;?>"><?php echo $arStory['name'];?></a><br />
      <?php echo $arStory['preview_text'];?></li>
		<?php }?>
  </ul>
</div>