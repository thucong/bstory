<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/header.php'; ?>
<?php
	if(!isset($_SESSION['arUser']))
	{
		header('location:../auth/login.php');
	}
?>
<?php require_once $_SERVER['DOCUMENT_ROOT'].'/templates/admin/inc/leftbar.php'; ?>
<script type = "text/javascript">
	document.title= ' Search User | VinaEnter Edu';
	
</script>
<?php
		if(isset($_POST['search'])){
		$nameSearch = $_POST['nameuser'];
		echo $nameSearch;
		$sqlTSD="SELECT COUNT(*) AS TSD FROM users WHERE username LIKE '%{$nameSearch}%'";
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
                                        <input type="search" class="form-control input-sm" placeholder="Nhập tên người dùng" style="float:right; width: 300px;" name="nameuser" />
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
                                        <th>Username</th>
										<th>Fullname</th>
                                        <th width="160px">Chức năng</th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php 
										
										$query = "SELECT * FROM users WHERE username LIKE '%{$nameSearch}%'";
										$ketqua = $mysqli -> query($query);
										while($arItem = mysqli_fetch_assoc($ketqua)){
											$id = $arItem['id'];
											$username = $arItem['username'];
											$fullname = $arItem['fullname'];
											$urlDel = "/admin/user/del.php?id={$id}";
											$urlEdit = "/admin/user/edit.php?id={$id}";
									?>
                                    
                                    <tr class="gradeX">
                                        <td><?php echo $id;?></td>
                                        <td><?php echo $username;?></td>
										<td><?php echo $fullname;?></td>
                                        
                                        <td class="center">
											<?php if($username != 'admin' || $_SESSION['arUser']['username'] == 'admin'){?>
                                            <a href="edit.php?id=<?php echo $id?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
											<?php }?>
											<?php if ($username != 'admin'){?>
                                            <a href="del.php?id=<?php echo $id ;?>" title="" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa không?')"><i class="fa fa-pencil"></i> Xóa</a>
										<?php }?>
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
		$("#user-admin").addClass('active-menu');
	});
	
</script>