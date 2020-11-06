<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/utils/CheckUserUtil.php'?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/utils/FileUtil.php'?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<script type = "text/javascript">
	document.title= 'Edit Story | VinaEnter Edu';
	
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Chỉnh sửa truyện</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
								<?php
									if(isset($_GET['id'])){
											$storyId = $_GET['id'];
									}
									$sqlStory = "SELECT * FROM story WHERE story_id = {$storyId}";
									$resultStory = $mysqli -> query($sqlStory);
									$arStory = mysqli_fetch_assoc($resultStory);
									$nameOld = $arStory['name'];
									$catIdOld = $arStory['cat_id'];
									$previewOld = $arStory['preview_text'];
									$detailOld = $arStory['detail_text'];
									$pictureOld = $arStory['picture'];
									if(isset($_POST['submit'])){
										$name = $_POST['name'];
										$cat_id = $_POST['catId'];
										$preview_text = $_POST['preview_text'];
										$detail_text = $_POST['detail_text'];
										$arFile=$_FILES['picture'];
										$fileName=$arFile['name'];
										if($fileName!=''){
										//doi ten file anh
											$fileName=renameFile($fileName);
											$tmpName=$arFile['tmp_name'];
											$pathUpload= $_SERVER['DOCUMENT_ROOT'].'/'.DIR_UPLOAD.'/'.$fileName;
											move_uploaded_file($tmpName,$pathUpload);
											$sqlEditStory= "UPDATE story SET name='{$name}',cat_id='{$cat_id}',preview_text='{$preview_text}',
											detail_text='{$detail_text}',picture = '{$fileName}' WHERE story_id='{$storyId}'";
											echo $sqlEditStory;
										}else{
											if($pictureOld!=''){
												$sqlEditStory= "UPDATE story SET name='{$name}',cat_id='{$cat_id}',preview_text='{$preview_text}',
												detail_text='{$detail_text}',picture = '{$pictureOld}' WHERE story_id='{$storyId}'";
											}else{
												$sqlEditStory= "UPDATE story SET name='{$name}',cat_id='{$cat_id}',preview_text='{$preview_text}',
												detail_text='{$detail_text}' WHERE story_id='{$storyId}'";
											}
											
										}
										
										$arEditStory = $mysqli->query($sqlEditStory);
										if($arEditStory){
											//echo $sqlEditStory;
											header('Location:/admin/story?msg=success');
											}
										else{
											$nameOld = $name;
											$previewOld=$preview_text;
											$detailOld=$detail_text;
											$catIdOld = $catId;
										}
										
									
									}
								?>
                                <form role="form" action="" enctype="multipart/form-data" method="post" name="frmEdit">
                                    <div class="form-group">
                                        <label>Tên truyện</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $nameOld;?>"/>
                                    </div>

                                    <div class="form-group">
                                        <label>Danh mục truyện</label>
                                        <select class="form-control" name="catId">
											<?php
												$sqlCat = "SELECT cat_id, name FROM cat ";
												$resultCat = $mysqli -> query($sqlCat);
												$selected = "";
												while($arCats = mysqli_fetch_assoc($resultCat)){
													$itemCatId = $arCats['cat_id'];
													$nameCat = $arCats['name'];
													if($catIdOld == $itemCatId){
														$selected = "selected = 'selected'";
													}else{
														$selected = "";
													}
												
											?>
                                                <option <?php echo $selected;?> value="<?php echo $catIdOld;?>"><?php echo $nameCat;?></option>
												<?php }?>   
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="picture" />
										<img src="/templates/story/images/<?php echo $pictureOld;?>" />
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" rows="3" name="preview_text" value="<?php echo $previewOld;?>"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết</label>
                                        <textarea id="editor1" class="form-control" rows="5" name="detail_text" value="<?php echo $detailOld?>"></textarea>
                                    </div>
									<script type = "text/javascript">
											CKEDITOR.replace( 'editor1',
											{
												filebrowserBrowseUrl: '/library/ckfinder/ckfinder.html',
												filebrowserImageBrowseUrl: '/library/ckfinder/ckfinder.html?type=Images',
												filebrowserUploadUrl: '/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
												filebrowserImageUploadUrl: '/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
											});
									</script>

                                    <button type="submit" name="submit" class="btn btn-success btn-md">Sửa</button>
                                </form>
								<script>
									$(document).ready(function(){
										$('.frmEdit').validate({
											rules:{
												name:{
													required: true
												},
												cat_id:{
													required: true
												},
												preview_text:{
													required: true
												},
												detail_text:{
													required: true
												}
											},
											messages:{
												name:{
													required: "Vui lòng nhập tên truyện"
												},
												cat_id:{
													required: "Vui lòng chọn danh mục truyện"
												},
												preview_text:{
													required: "Vui lòng nhập mô tả"
												},
												detail_text:{
													required: "Vui lòng nhập chi tiết"
												}
											}
										});
									});
								</script>


                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Form Elements -->
            </div>
        </div>
        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>