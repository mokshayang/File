<?php
include_once "base.php";

if($_FILES['file_name']['error']==0){
    //$_FILES['file_name']['name']為路徑名稱，必須存入變數才能使用
    $file_str_array=explode(".",$_FILES['file_name']['name']);
    // $sub=(array_pop(explode(".",$_FILES['file_name']['name'])));
    $sub=array_pop($file_str_array);//array_pop(必須是array)
    $file_name=date("Y-m-d h-i-s").".".$sub;//自定義檔案名稱
    // move_uploaded_file($_FILES['file_name']['tmp_name'],"../upload/".$_FILES['file_name']['name']);原始
    move_uploaded_file($_FILES['file_name']['tmp_name'],"../upload/".$file_name);//檔案移動
    //採用 deinition function ::
    insert('upload',['description'=>$_POST['description'],
                     'size'=>$_FILES['file_name']['size'],
                     'type'=>$_FILES['file_name']['type'],
                     'file_name'=>$file_name]);

    $description=$_POST['description']." Description";
    echo $description;
    echo "<br>";
    echo $file_name;
    echo "<br>";
    echo $_FILES['file_name']['size']." bytes";//bytes
    echo "<br>";
    echo $_FILES['file_name']['type'];
    echo "<br>";
    
    header("location:../upload.php?upload=success");



}else{
    echo "上傳失敗，請聯絡管理員 !";
}

?>