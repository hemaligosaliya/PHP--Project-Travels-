<!DOCTYPE html>
<?php require_once 'connection.php'; 
      require_once './insertdata.php';
      $_SESSION[page]="index";
     
     
?>
<html lang="en">
    <?php
    require_once 'head.php';
    ?>

    <body onload="userrate('userrate','<?php echo $_SESSION[user]; ?>',2,<?php echo $rate; ?>,'display');">
        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div>

        <?php
        require_once 'header_toppati.php';
        ?>

        <?php
        require_once 'header.php';
        ?>
        
        
        <div class="container">
            <div class="row topbot">

                <ul class="ratingg">
                   <b>Average Rate</b><br/>
                    <?php
                    for($i=1;$i<=5;$i++)
                    {
                    ?>
                    <li><i class="fa fa-star-o"></i></li>
                    <?php 
                    }
                    ?>
                </ul>
            </div>
            <div class="row topbot" id="userrate">
                
            </div>
        </div>

        <?php
        require_once 'footer.php';
        ?>

        <?php
        require_once 'footer1.php';
        ?>

        <?php
        require_once 'footer2.php';
        ?>

        <?php
        require_once 'script.php';
        ?>

    </body>

</html>