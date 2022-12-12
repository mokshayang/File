<?php include_once "base.php";
//編輯檔案 要刪除原檔案 再新增
//dbSQL edit `file_name` , `size` , `type` , `description`
$file=find("upload",$_POST['id']);//先找到對應關係，一維陣列

$_POST['description'];//dbSQL
if($_FILES['file_name']['error']==0){
    //$_FILES['file_name']['name']為路徑名稱
    $file_str_array=explode(".",$_FILES['file_name']['name']);
    $sub=array_pop($file_str_array);//array_pop(必須是array)
    $file_name_array=explode(".",$file['file_name']);
    $file_name=array_shift($file_name_array).".".$sub;//edit 時候 同筆資料採用原始黨名 $file['file_name']
    if($file['file_name']!==$file_name){//如果檔名不同，則刪除舊檔案(針對附檔名)
        unlink("../upload/".$file['file_name']);
    }
    move_uploaded_file($_FILES['file_name']['tmp_name'],"../upload/".$file_name);//檔案移動
    //採用 deinition function ::
    update('upload',['description'=>$_POST['description'],
                     'size'=>$_FILES['file_name']['size'],
                     'type'=>$_FILES['file_name']['type'],
                     'file_name'=>$file_name
                    ],$_POST['id']);
                    
                }else{
                    update('upload',['description'=>$_POST['description']],$_POST['id']);
                }        
                header("location:../upload.php?upload=success");
                ?>
