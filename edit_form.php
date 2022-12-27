<?php
include_once "./api/base.php";

$file=find('upload',$_GET['id']);
?>
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
        grid-template-columns: 2fr 2fr 3fr 2fr 2fr 2fr;
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
    li img {
        width:150px;

    }
</style>
<h2>編輯檔案</h2>
<form action="./api/edit.php" method="post" enctype="multipart/form-data">
        <ul>
            <li>描述 : <input type="text" name="description" value="<?=$file['description']?>"></li>
            <li>類型 : <?=$file['type']?></li>
            <li>類型 : <?=$file['size']?>byes</li>
            <li>
                <?php
                     if(is_image($file['type'])){
                        echo "<img src='./upload/{$file['file_name']}' style='width:150px'> ";
                    }else{
                        $icon=dummy_icon($file['type']);
                        echo "<img src='./material/{$icon}' style='width:80px'>";
                    }
                ?>
            </li>
            <li>檔案 : <input type="file" name="file_name"></li>
            <input type="hidden" name="id" value="<?=$file['id']?>" >
            <li><input type="submit" value="修改"></li>
        </ul>
    </form>