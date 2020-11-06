<?php
	//$mysqli = new mysqli('host_name','username','password','database_name');
	// tạo đối tượng mysqli: kết nối đến mysql
	$mysqli = new mysqli('localhost','root','','bstory');
	//set utf-8: hiển thị và cập nhật được tiếng việt
	$mysqli -> set_charset('utf8');
	if(mysqli_connect_error()){
		echo 'Có lỗi kết nối database:'.mysqli_connect_errno();
	}
?>