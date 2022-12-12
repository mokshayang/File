<?php
include_once "base.php";
$id=$_GET['id'];

$file=find('upload',$id);
unlink("../upload/".$file['file_name']);//刪除檔案要放在刪除資庫前面

del("upload",$id);//刪除資料庫

// header("location:../upload.php");
// to("../upload.php");
?>