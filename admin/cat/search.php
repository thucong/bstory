<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php
	if(!isset($_SESSION['arUser']))
	{
		header('location:../auth/login.php');
	}
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<script type = "text/javascript">
	document.title= ' Search Cat | VinaEnter Edu';
	
</script>
<?php
		
		if(isset($_POST['search'])){
		$nameSearch = $_POST['namecat'];
		echo $nameSearch;
		$sqlTSD="SELECT COUNT(*) AS TSD FROM cat WHERE name LIKE '%{$nameSearch}%'";
		$resultTSD = $mysqli->query($sqlTSD);
		$arrTmp=mysqli_fetch_assoc($resultTSD);
		$tongSoDong=$arrTmp['TSD'];
		//so truyen tren 1 trang
		$row_count=5;
		//tong so trng
		$tongSotrang=ceil($tongSoDong/$row_count);
		//trang hien tai
		$current_page=1;
		if(isset($_GET['page'])){
			$current_page=$_GET['page'];
		}
		//tinh offset
		$offset=($current_page-1)*$row_count;
	}
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Kết quả tìm kiếm</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />

        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-sm-6">
                                   
                                </div>
								
                                <div class="col-sm-6" style="text-align: right;">
                                    <form method="post" action="search.php">
                                        <input type="submit" name="search" value="Tìm kiếm" class="btn btn-warning btn-sm" style="float:right" />
                                        <input type="search" class="form-control input-sm" placeholder="Nhập tên danh mục" style="float:right; width: 300px;" name="namecat" />
                                        <div style="clear:both"></div>
                                    </form><br />
                                </div>
                            </div>
							
							<?php 
									if(isset($_GET['msg']) == SUCCESS){
										echo "Thực hiện thành công";
									}
								?>
								<?php echo 'Có '.$tongSoDong.' kết quả tìm kiếm';?>
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th width="160px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php 
										
										$sqlCat = "SELECT cat_id, name FROM cat WHERE name LIKE '%{$nameSearch}%'ORDER BY cat_id DESC";
										$resultCat = $mysqli -> query($sqlCat);
										while($arCats = mysqli_fetch_assoc($resultCat)){
											$catId = $arCats['cat_id'];
											$name = $arCats['name'];
											$urlDel = "/admin/cat/del.php?id={$catId}";
											$urlEdit = "/admin/cat/edit.php?id={$catId}";
									?>
                                    
                                    <tr class="gradeX">
                                        <td><?php echo $catId;?></td>
                                        <td><?php echo $name;?></td>
                                        
                                        <td class="center">
                                            <a href="<?php echo $urlEdit?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                            <a href="<?php echo $urlDel ;?>" title="" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i class="fa fa-pencil"></i> Xóa</a>
                                        </td>
                                    </tr>
										<?php }?>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-6">
                                   
                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                        <ul class="pagination">
                                           <?php 
											for($i=1;$i<$tongSotrang;$i++){
												$active='';
												if($i==$current_page){
													$active='active';
												}
										   ?>
                                            <li class="paginate_button <?php echo $active?>"><a href="search.php?page=<?php echo $i?>"><?php echo $i?></a></li>
											<?php 
											}
											?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
    </div>

</div>
<!-- /. PAGE INNER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/footer.php'; ?>
<script>
	$(document).ready(function(){
		$("#cat-admin").addClass('active-menu');
	});
	
</script>