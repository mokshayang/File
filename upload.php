<?php
include_once "./api/base.php";
/**
 * 1.建立表單
 * 2.建立處理檔案程式
 * 3.搬移檔案
 * 4.顯示檔案列表
 */

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>檔案上傳</title>
    <link rel="stylesheet" href="style.css">
</head>
<style>
    form {
        width: 80%;
        min-height: 60px;
        margin: auto;
        min-width: 800px;
    }
    .list{
        list-style-type: none;
        padding: 0;
        margin: 1rem auto;
        padding-top: 1px;
        width: 80%;
        
    }
    .list-item{
        display: flex;
        align-items: center;
        border: 1px solid #aaa;
        margin-top: -1px;
    }

    .list-item {
        display: grid;
        grid-template-columns: 2fr 2fr 3fr 2fr 2fr 2fr;
        justify-items: center;
        align-items: center;
        margin-left: 10px;
    }
    .list-item img{
        width: 90px;
        height: 60px;
        
    }
    .list-item:nth-child(1){
        background-color: #ff6;
    }
    .state{
        margin: auto;
        text-align: center;
    }
    .tabtal{
        height: 60px;
        display: grid;
        grid-template-columns: 3fr 4fr;
        grid-auto-rows: 10px;
        justify-items: center;
        padding-left: 60px;
    }
  
</style>

<body>
    <h1 class="header">檔案上傳練習</h1>
  
    <!----建立你的表單及設定編碼----->
    <form action="./api/upload.php" method="post" enctype="multipart/form-data">
        <div class="tabtal">
            <div>描述 : <input type="text" name="description"></div>
            <div>檔案 : <input type="file" name="file_name">
            <input type="submit" value="上傳"></div>
        </div>
    </form>
    <?php
    if (isset($_GET['upload']) && ($_GET['upload'] == 'success')) {
        echo "<div class='state'>";
        echo "上傳成功";
        echo "</div>";
    }
    if (isset($_GET['del'])) {
        echo "<div style='color:red;' class='state'>";
        echo $_GET['del'];
        echo "</div>";
    }
    ?>
    <!----建立一個連結來查看上傳後的圖檔---->
    <?php
    $files = all('upload');
    if (count($files) > 0) {
        echo "<ul class='list'>";
        echo "<li class='list-item'>";
        echo "<div>縮圖</div>";
        echo "<div>描述</div>";
        echo "<div>檔名</div>";
        echo "<div>大小</div>";
        echo "<div>類型</div>";
        echo "<div>操作</div>";
        echo "</li>";

        foreach ($files as $file) {
            echo "<li class='list-item'>";
                echo "<div>";
                if(is_image($file['type'])){
                    echo "<img src='./upload/{$file['file_name']}'>";
                }else{
                    $icon=dummy_icon($file['type']);
                    echo "<img src='./material/{$icon}' style='width:80px'>";
                }
                echo "</div>";
                echo "<div>";
                    echo $file['description'];
                echo "</div>";
                echo "<div>";
                    echo $file['file_name'];
                echo "</div>";
                echo "<div>";
                    echo floor($file['size']/1024)."KB";
                echo "</div>";
                echo "<div>";
                    echo $file['type'];
                echo "</div>";
                echo "<div>";
                    echo "<a href='./edit_form.php?id={$file['id']}'>編輯</a>";
                    echo "<a href='./api/del.php?id={$file['id']}'>刪除</a>";
                echo "</div>";
            echo "<li>";
        }
        echo "</ul>";
    } else {
        echo "<div class='state'>";
        echo "目前尚無上傳資料~";
        echo "</div>";
    }
    ?>

</body>

</html>