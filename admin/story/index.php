<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/utils/CheckUserUtil.php'?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<script type = "text/javascript">
	document.title= 'Story| VinaEnter Edu';
	
</script>
<?php 
	//tổng số dòng
	$queryTSD = "SELECT count(*) AS TSD FROM story";
	$resultTSD = $mysqli->query($queryTSD);
	$arTmp = mysqli_fetch_assoc($resultTSD);
	$tongSoDong = $arTmp['TSD'];
	// số truyện trên 1 trang
	$row_count = ROW_COUNT;
	//tổng số trang
	$tongSoTrang = ceil($tongSoDong/$row_count);
	//trang hiện tại
	$curent_page = 1;
	if(isset($_GET['page'])){
		$curent_page = $_GET['page'];
	}
	//offset
	$offset = ($curent_page - 1)* $row_count;
?>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Quản lý truyện</h2>
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
                                    <a href="add.php" class="btn btn-success btn-md">Thêm</a>
                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <form method="post" action="search.php">
										
                                        <input type="submit" name="search" value="Tìm kiếm" class="btn btn-warning btn-sm" style="float:right" />
                                        <input type="search" class="form-control input-sm" placeholder="Nhập tên truyện" style="float:right; width: 300px;" name="name"/>
										
                                        <div style="clear:both"></div>
                                    </form><br />
                                </div>
                            </div>

                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Danh mục</th>
                                        <th>Lượt đọc</th>
                                        <th>Hình ảnh</th>
                                        <th width="160px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
                                   <?php 
										
										$sqlStory = "SELECT s.*,c.name AS nameCat FROM story AS s INNER JOIN cat AS c ON c.cat_id = s.cat_id ORDER BY story_id DESC LIMIT {$offset},{$row_count}";
										$resultStory = $mysqli -> query($sqlStory);
										while($arStory = mysqli_fetch_assoc($resultStory)){
											$story_id = $arStory['story_id'];
											$name = $arStory['name'];
											$counter = $arStory['counter'];
											$nameCat = $arStory['nameCat'];
											$picture = $arStory['picture'];
											$urlDel = "/admin/story/del.php?id={$story_id}";
											$urlEdit = "/admin/story/edit.php?id={$story_id}";
									?>
                                    <tr class="gradeX">
                                        <td><?php echo $story_id;?></td>
                                        <td><?php echo $name;?></td>
                                        <td><?php echo $nameCat;?></td>
                                        <td class="center"><?php echo $counter;?></td>
                                        <td class="center">
											<?php if($picture != ''){?>
                                            <img src="/templates/story/images/<?php echo $picture;?>" alt="" height="80px" width="100px" />
											<?php }else{?>
											<strong>không có hình</strong>
											<?php }?>
                                        </td>
                                        <td class="center">
                                            <a href="<?php echo $urlEdit;?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                            <a href="<?php echo $urlDel;?>" title="" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="dataTables_info" id="dataTables-example_info" style="margin-top:27px">Hiển thị từ 1 đến 5 của 24 truyện</div>
                                </div>
                                <div class="col-sm-6" style="text-align: right;">
                                    <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                        <ul class="pagination">
                                            <?php
												for($i = 1; $i<=$tongSoTrang; $i++){
													$active ='';
													if($i == $curent_page){
														$active = 'active';
													}
											?>
                                            <li class="paginate_button <?php echo $active;?>" ><a href="index.php?page=<?php echo $i ;?>"><?php echo $i;?></a></li>
												<?php }?>
                                            
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
		$("#story-admin").addClass('active-menu');
	});
	
</script>