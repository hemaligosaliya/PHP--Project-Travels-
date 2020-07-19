<!DOCTYPE html>
<?php require_once 'connection.php';
require_once './insertdata.php';?>
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


        <div class="container terms topbot">
            <div class="row">
                <div class="col-md-12 ">
                    <div class="spe-title">
                        <h2>Terms <span>&</span> Condition</h2>
                        <div class="title-line">
                            <div class="tl-1"></div>
                            <div class="tl-2"><i class="fa fa-gg"></i></div>
                            <div class="tl-3"></div>
                        </div>
                    </div>
                </div>
            </div>
             <?php
                $rowterms=$con->query("select * from siteprofile where category=0");
                $cnt=0;
                while ($dataterms=mysqli_fetch_array($rowterms))
                {
                    $cnt++;
             ?>
                    <div class="row">
                        <div class="col-md-3 terms-conditions"> 
                            <h4><?php echo $dataterms[9]; ?></h4>
                        </div>
                        <div class="col-md-9 terms-conditions">
                            <p> <?php echo $dataterms[10]; ?></p>
                            <p> <?php echo $dataterms[11]; ?></p>
                            <div class="<?php if($cnt!=1){ echo 'horizontalline';} ?>" ></div>
                        </div>
                    </div>
            <?php
                }
            ?>
            
            
            
            
            
           
            <div class="row" style="padding-top:30px;">
                <div class="spe-title" id="privacy policy">
                            <h3>Privacy policy <span></span></h3>
                            <div class="title-line">
                                <div class="tl-11"></div>
                                <div class="tl-22"><i class="fa fa-gg"></i></div>
                                <div class="tl-33"></div>

                            </div>
            </div>
            </div>
            
            
            <?php
                $rowterms=$con->query("select * from siteprofile where category=1");
                $cnt1=0;
                while ($dataterms=mysqli_fetch_array($rowterms))
                {
                    $cnt1++;
             ?>
                    <div class="row">
                        <div class="col-md-3 terms-conditions"> 
                            <h4><?php echo $dataterms[9]; ?></h4>
                        </div>
                        <div class="col-md-9 terms-conditions">
                            <p> <?php echo $dataterms[10]; ?></p>
                            <p> <?php echo $dataterms[11]; ?></p>
                            <div class="horizontalline" ></div>
                        </div>
                    </div>
            <?php
                }
            ?>
            
            
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