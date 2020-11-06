<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/utils/CheckUserUtil.php'?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm ảnh</h2>
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
									
									if(isset($_POST['submit'])){
										$id = $_POST['id'];
										$pictur =$_POST['']
										$sqlAddCat = "INSERT INTO cat(name) VALUES('{$name}')";
										$resultAddCat = $mysqli -> query($sqlAddCat);
										if($resultAddCat){
											//echo "Thêm danh mục thành công";
											header('location: /admin/cat?msg=success');
										}else{
											echo "Có lỗi trong quá trình thêm, vui lòng kiểm tra lại";
										}
									}
									
									
								?>
                                <form role="form" action="" method="POST">
                                    <div class="form-group">
                                        <label>ID</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $name;?>" />
                                    </div>
									 <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="picture" />
                                    </div>
                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" rows="3" name="preview_text"></textarea>
                                    </div>
                                   
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>
                                </form>



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