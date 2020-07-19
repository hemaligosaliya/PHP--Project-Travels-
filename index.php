<!DOCTYPE html>
<?php require_once 'connection.php'; 
      require_once './insertdata.php';
      $_SESSION[page]="index";
?>
<html lang="en">
    <?php
    require_once 'head.php';
    ?>

    <body>
        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div>

        <?php
        require_once 'header_toppati.php';
        ?>

        <?php
        require_once 'header.php';
        ?>
        <?php
        require_once 'slider.php';
        ?>
        
        <?php
        require_once 'indexpart.php';
        ?>
        
        
        <div class="container">
            <div class="row topbot">
                
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