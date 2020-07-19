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
        
        
        <div class="container">
            <div class="row topbot">
                                        <div class="tour_head1 hot-ameni">
                            <h3>Hotel Amenities</h3>
                            <ul>
                                <?php
                                 $hotelami=$con->query("SELECT * FROM amenities");
                                 while($hotelamirow= mysqli_fetch_array($hotelami))
                                 {
                                     $check=$con->query("SELECT * FROM assignamenities where hotelid=$_SESSION[hotelid] and amenitiesid=$hotelamirow[0]");
                                     $aapo= mysqli_fetch_array($check);
                                     if($aapo[0]=="")
                                     {
                                     ?>
                                <li><i class="fa fa-check" aria-hidden="true"></i><font style="text-transform: capitalize;"> <?php echo $hotelamirow[1]; ?></font></li>
                                     <?php    
                                     }
                                     else
                                     {
                                     ?>
                                        <li><i class="fa fa-check" aria-hidden="true"></i> <b style="color:black; text-transform:capitalize;"><?php echo $hotelamirow[1]; ?></b></li>
                                     <?php 
                                     }
                                 }
                                ?>
                            </ul>
                        </div>
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