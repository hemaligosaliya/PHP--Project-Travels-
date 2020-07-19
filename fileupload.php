<?php
require_once './connection.php';
require_once './insertdata.php';
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <form action="" method="post" name="fileupload" enctype="multipart/form-data">
            <?php
            if($er==1)
            {
                echo '<font color="red">Invalid file formate</font>';
            }
            else if($err==1) 
            {
                echo '<font color="red">Size too large</font>';
            }
            elseif ($test==1) 
            {
                    echo "sucess";
            }
            ?>
            <input type="text" placeholder="enter Name" required=" " name="photoname"/>
            <input type="file" name="photo" required="" />
            <button type="submit" name="upload">Upload Image</button>
        </form>
    </body>
</html>
