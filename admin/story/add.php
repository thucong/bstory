<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/utils/CheckUserUtil.php'?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/utils/FileUtil.php'?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<script type = "text/javascript">
	document.title= 'Add Story | VinaEnter Edu';
	
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm truyện</h2>
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
									$name='';
									if(isset($_POST['submit'])){
										$name = $_POST['name'];
										$cat_id = $_POST['cat-id'];
										$preview_text = $_POST['preview_text'];
										$detail_text = $_POST['detail_text'];
										$arFile = $_FILES['picture'];
										
										$fileName = $arFile['name'];
										if($fileName != ''){
											// đổi lại file name của picture
											$fileName = renameFile($fileName);
											$tmpName = $arFile['tmp_name'];
											$pathUpload = $_SERVER['DOCUMENT_ROOT'].'/'.DIR_UPLOAD.'/'.$fileName;
											move_uploaded_file($tmpName,$pathUpload);
											
										}
										//insert into database
										$sqlAddStory = "INSERT INTO story(name, preview_text, detail_text, picture, cat_id)
										VALUES('{$name}','{$preview_text}','{$detail_text}','{$fileName}',$cat_id)";
										$resultAddStory = $mysqli->query($sqlAddStory);
										if($resultAddStory){
											header('location:/admin/story?msg=success');
										}else{
											echo "Có lỗi trong quá trình thêm, vui lòng thử lại. ";
										}
									}
								?>
                                <form role="form" action="" enctype="multipart/form-data" method="post" class="frmAdd">
                                    <div class="form-group">
                                        <label>Tên truyện</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $name;?>"/>
                                    </div>

                                    <div class="form-group">
                                        <label>Danh mục truyện</label>
                                        <select class="form-control" name="cat-id">
											<?php
												$sqlCat = "SELECT cat_id, name FROM cat ORDER BY cat_id DESC";
												$resultCat = $mysqli -> query($sqlCat);
												$selected = "";
												while($arCats = mysqli_fetch_assoc($resultCat)){
													$itemCatId = $arCats['cat_id'];
													$nameCat = $arCats['name'];
													if($cat_id == $itemCatId){
														$selected = "selected = 'selected'";
													}else{
														$selected = "";
													}
											?>
                                                <option <?php echo $selected;?> value="<?php echo $itemCatId;?>"><?php echo $nameCat;?></option>
												<?php }?>   
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="picture" />
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" rows="3" name="preview_text"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết</label>
                                        <textarea id="editor1" class="form-control" rows="5" name="detail_text"></textarea>
                                    </div>
									<script type = "text/javascript">
											CKEDITOR.replace( 'editor1',
											{
												filebrowserBrowseUrl: '/bstory/library/ckfinder/ckfinder.html',
												filebrowserImageBrowseUrl: '/bstory/library/ckfinder/ckfinder.html?type=Images',
												filebrowserUploadUrl: '/bstory/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
												filebrowserImageUploadUrl: '/bstory/library/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
											});
										</script>

                                    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
                                </form>
								<script>
									$(document).ready(function(){
										$('.frmAdd').validate({
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