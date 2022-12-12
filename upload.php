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
        width: 50%;
        margin: auto;
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
    /* .list-item div:nth-child(1){
        width: 30%;
    }
    .list-item div:nth-child(2){
        width: 30%;
    }
    .list-item div:nth-child(3){
        width: 20%;
    }
    .list-item div:nth-child(4){
        width: 20%;
    } */
    .list-item {
        display: grid;
        grid-template-columns: 2fr 3fr 2fr 2fr;
        justify-items: center;
        align-items: center;
    }
    .list-item img{
        width: 90px;
        height: 60px;
        padding-top: 3px;
    }
    .list-item:nth-child(1){
        background-color: #ff6;
    }
</style>

<body>
    <h1 class="header">檔案上傳練習</h1>
    <?php
    if (isset($_GET['upload']) && ($_GET['upload'] == 'success')) {
        echo "上傳成功";
    }
    ?>
    <!----建立你的表單及設定編碼----->
    <form action="./api/upload.php" method="post" enctype="multipart/form-data">
        <ul>
            <li>描述 : <input type="text" name="description"></li>
            <li>檔案 : <input type="file" name="file_name"></li>
            <li><input type="submit" value="上傳"></li>
        </ul>
    </form>
    <!----建立一個連結來查看上傳後的圖檔---->
    <?php
    $files = all('upload');
    if (count($files) > 0) {
        echo "<ul class='list'>";
        echo "<li class='list-item'>";
        echo "<div>描述</div>";
        echo "<div>檔名</div>";
        echo "<div>大小</div>";
        echo "<div>類型</div>";
        echo "</li>";

        foreach ($files as $file) {
            echo "<li class='list-item'>";
                echo "<div>";
                    echo "<img src='./upload/{$file['file_name']}'>";
                echo "</div>";
                // echo "<div>";
                //     echo $file['description'];
                // echo "</div>";
                echo "<div>";
                    echo $file['file_name'];
                echo "</div>";
                echo "<div>";
                    echo $file['size'];
                echo "</div>";
                echo "<div>";
                    echo $file['type'];
                echo "</div>";
            echo "<li>";
        }
        echo "</ul>";
    } else {
        echo "目前尚無上傳資料~";
    }
    ?>

</body>

</html>