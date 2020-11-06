<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/utils/CheckUserUtil.php'?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<script type = "text/javascript">
	document.title= ' Edit Cat | VinaEnter Edu';
	
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm danh mục</h2>
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
									$catId = 0;
									$name = "";
									
									if(isset($_GET['id'])){
										$catId = $_GET['id'];
									}
									
									$sqlCat = "SELECT cat_id, name FROM cat WHERE cat_id = {$catId}";
									$resultCat = $mysqli -> query($sqlCat);
									$arCat = mysqli_fetch_assoc($resultCat);
									$nameOld = $arCat['name'];
									
									if(isset($_POST['submit'])){
										$name = $_POST['name'];
										$sqlEditCat = "UPDATE cat SET name='{$name}' WHERE cat_id={$catId}";
										$resultEditCat = $mysqli -> query($sqlEditCat);
										if($resultEditCat){
											//echo "Thêm danh mục thành công";
											header('location: /admin/cat?msg=success');
										}else{
											$nameOld = $name;
											echo "Có lỗi trong quá trình sửa, vui lòng kiểm tra lại";
										}
									}
									
									
								?>
                                <form role="form" action="" method="POST">
                                    <div class="form-group">
                                        <label>Tên danh mục tin</label>
                                        <input type="text" name="name" class="form-control" value="<?php echo $nameOld;?>" />
                                    </div>

                                   
                                    <button type="submit" name="submit" class="btn btn-success btn-md">Sửa</button>
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