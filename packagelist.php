<!DOCTYPE html>
<?php
require_once 'connection.php';
require_once './insertdata.php';
$_SESSION[page] = "index";
?>
<html lang="en">
    <?php
    require_once 'head.php';
    ?>

    <body onload="misssearch('productdata',6,100);">
        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div>

        <?php
        require_once 'header_toppati.php';
        ?>

        <?php
        require_once 'header.php';
        ?>

        <section class="hot-page2-alp hot-page2-pa-sp-top">
            <div style="background: linear-gradient(to right, rgba(29, 43, 100,0.5), rgba(248, 205, 218,0.5));">
                <div class="container" style="padding-bottom:50px;">
                    <div class="row inner_banner inner_banner_3 bg-none">
                        <div class="hot-page2-alp-tit">
                            <h1>Welcome to India's Wild Hotelrang</h1>
                            <p>India's leading tour and travels Booking website , with give opportunist to customer create their custom package.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="hot-page2-alp-con">
                            <!--LEFT LISTINGS-->
                            <div class="col-md-3 hot-page2-alp-con-left">
                                <!--PART 1 : LEFT LISTINGS-->
                                <div class="hot-page2-alp-con-left-1">
                                    <h3>Top Rated Packages</h3> </div>
                                <!--PART 2 : LEFT LISTINGS-->
                                <div class="hot-page2-hom-pre hot-page2-alp-left-ner-notb"> 
                                    <?php
                                    $cntpack = 0;
                                    $leftrate = $con->query("select *,avg(r.rate) as dd from rate r,package p where p.packageid=r.packageid group by r.packageid order by dd desc limit 5");
                                    while ($leftaapo = mysqli_fetch_array($leftrate)) {
                                        $cntpack++;
                                        ?>
                                        <ul>
                                            <li>
                                                <a href="packagedetails.php?packageid=<?php echo $leftaapo[0]; ?>">
                                                    <div class="hot-page2-hom-pre-1 hot-page2-alp-cl-1-1"> <img src="<?php echo $leftaapo[9]; ?>" alt=""> </div>
                                                    <div class="hot-page2-hom-pre-2 hot-page2-alp-cl-1-2">
                                                        <h5><?php echo $leftaapo[5]; ?></h5> 
                                                        <span>
                                                            Duration: <?php echo $leftaapo[6]; ?> Days & <?php echo $leftaapo[7]; ?> Nights   
                                                        </span> 
                                                    </div>
                                                    <div class="hot-page2-hom-pre-3 hot-page2-alp-cl-1-3"> <span><?php echo round($leftaapo[12]); ?><i class="fa fa-star starmate"></i></span> </div>
                                                </a>
                                            </li>
                                        </ul>
                                        <?php
                                    }
                                    if ($cntpack == 0) {
                                        echo '<h2 class="text-center">No Records Found</h2>';
                                    }
                                    ?>
                                </div>
                                <form method="post" action="" style="border-bottom:none;" id="vegfilter">
                                    <div class="hot-page2-alp-l3 hot-page2-alp-l-com">
                                        <h4><i class="fa fa-calendar-check-o" aria-hidden="true"></i>Find Your package by place</h4>
                                        <div class="hot-page2-alp-l-com1 hot-room-ava-check">
                                            <div class="v2-search-form package-form" style="border:none;" >							
                                                <div class="row" style="max-height:700px;overflow-y:auto;overflow-x:hidden;">
                                                    <div class="col-md-12">
                                                        <div class=" input-field col s8">
                                                            <?php
                                                            $a=0;
                                                            $lavo=$con->query("SELECT * FROM place p, packageplace pp where p.placeid=pp.placeid group by p.placeid");
                                                            while($row= mysqli_fetch_array($lavo))
                                                            {
                                                                $a++;
                                                            ?>
                                                            <input id="list-title<?php echo $a; ?>" value="<?php echo $row[1]; ?>" type="checkbox" name="place[]" onchange="misssearch('productdata',0,100);">
                                                                <label for="list-title<?php echo $a; ?>"><?php echo $row[2]; ?></label>
                                                            <?php    
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="hot-page2-alp-l3 hot-page2-alp-l-com">
                                        <h4><i class="fa fa-calendar-check-o" aria-hidden="true"></i>Find package by place point</h4>
                                        <div class="hot-page2-alp-l-com1 hot-room-ava-check">
                                            <div class="v2-search-form package-form"  style="border:none;">							
                                                <div class="row" style="max-height:700px;overflow-y:auto;overflow-x:hidden;">
                                                    <div class="col-md-12">
                                                        <div class=" input-field col s8">
                                                            <?php
                                                            $a=0;
                                                            $lavo=$con->query("SELECT * FROM placepoint p, packageplace pp where p.pointid=pp.pointid group by p.pointid");
                                                            while($row= mysqli_fetch_array($lavo))
                                                            {
                                                                $a++;
                                                            ?>
                                                            <input id="listt-title<?php echo $a; ?>" value="<?php echo $row[1]; ?>" type="checkbox" name="placepoint[]" onchange="misssearch('productdata',0,100);">
                                                                <label for="listt-title<?php echo $a; ?>"><?php echo $row[2]; ?></label>
                                                            <?php    
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                        </div>



                            <!--END LEFT LISTINGS-->
                            <!--RIGHT LISTINGS-->
                            <div class="col-md-9 hot-page2-alp-con-right" id="productdata">
                                
                            </div>
                            <!--END RIGHT LISTINGS-->
                        </div>
                    </div>
                </div>
            </div>
        </section>


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