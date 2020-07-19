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
        

        <?php
        require_once 'header_toppati.php';
        ?>

        <?php
        require_once 'header.php';
        ?>
       
        <!--====== HOTELS LIST ==========-->
        <section class="hot-page2-alp hot-page2-pa-sp-top all-hot-bg">
            <div  style="background: linear-gradient(to right, rgba(29, 43, 100,0.5), rgba(248, 205, 218,0.5));">
            <div class="container" style="padding-bottom:50px;">
                <div class="row inner_banner inner_banner_3 bg-none">
                    <div class="hot-page2-alp-tit">
                        <h1>Welcome to India's Wild Hotelrang</h1>
                        <p>India's leading Hotel Booking website , with best facilities to customer.</p>
                    </div>
                </div>
                <div class="row">
                    <div class="hot-page2-alp-con">
                        <!--LEFT LISTINGS-->
                        <div class="col-md-3 hot-page2-alp-con-left">
                            <!--PART 1 : LEFT LISTINGS-->
                            <div class="hot-page2-alp-con-left-1">
                                <h3>Suggesting Hotels</h3> </div>
                            <!--PART 2 : LEFT LISTINGS-->
                            <div class="hot-page2-hom-pre hot-page2-alp-left-ner-notb">
                                <ul>
                                    <?php 
                                    $data=$con->query("select * from hotel h,place p,city c,state s,country co where p.placeid=h.placeid and c.cityid=p.cityid and s.stateid=c.stateid and co.countryid=s.countryid group by star desc");
                                    while ($row=mysqli_fetch_array($data))
                                    {
                                    ?>
                                    <li>
                                        <a  href="hotel-details.php?hotelid=<?php echo $row[1]; ?>">
                                            <div class="hot-page2-hom-pre-1 hot-page2-alp-cl-1-1"> <img src="<?php echo $row[10]; ?>" alt="" height="20px"/> </div>
                                            <div class="hot-page2-hom-pre-2 hot-page2-alp-cl-1-2">
                                                <h5><?php echo $row[2]; ?></h5> <span>City: <?php echo $row[23]; ?> , <?php echo $row[28]; ?></span> </div>
                                            <div class="hot-page2-hom-pre-3 hot-page2-alp-cl-1-3"> <span style="width:50px;" class="text-center"><?php echo $row[7]; ?><i class="fa fa-star starmate" style="color: #fea900;"></i></span> </div>
                                        </a>
                                    </li>
                                
                                    <?php
                                    }
                                    ?>
                               </ul>
                            </div>
                        </div>
                        <!--END LEFT LISTINGS-->
                        <!--RIGHT LISTINGS-->
                        <div class="col-md-9">
                            <div class="hot-page2-alp-con-right-1">
                                <!--LISTINGS-->
                                <div class="row">
                                    <!--LISTINGS START-->
                                    
                                    <?php
                                    $row=$con->query("select * from hotel");
                                    while($data= mysqli_fetch_array($row))
                                    {
                                    ?>
                                    
                                    <div class="hot-page2-alp-r-list">
                                        <div class="col-md-3 hot-page2-alp-r-list-re-sp">
                                            <a href="hotel-details.php?hotelid=<?php echo $data[1]; ?>">
                                                
                                                <div class="hot-page2-hli-1"> <img src="<?php echo $data[10]; ?>" style="height:212px;width:210px;"  alt=""/> </div>
                                            </a>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="hot-page2-alp-ri-p2"> <a href="hotel-details.php?hotelid=<?php echo $data[1]; ?>"><h3 style="text-transform: capitalize;"><?php echo $data[2]; ?> 
                                                        
                                                <?php
                                                if($data[8]=="veg")
                                                {
                                                ?>
                                                    <img src="images/veg.png" height="20px;"/>
                                                <?php
                                                }
                                                else if($data[8]=="both")
                                                {
                                                ?>
                                                    <img src="images/both.jpeg" height="20px;"  />
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                    <img src="images/non-veg.png" height="20px;"  />
                                                <?php
                                                }
                                                ?>
                                             </h3></a>
                                                <span class="ratingg">
                                                    <?php
                                                    $starcheck=0;
                                                    if($data[7]=="0.5"||$data[7]=="1.5"||$data[7]=="2.5"||$data[7]=="3.5"||$data[7]=="4.5")
                                                    {
                                                        $starcheck=1;
                                                    }
                                                    for($i=1;$i<=floor($data[7]);$i++)
                                                    {
                                                    ?>
                                                        <li><i class="fa fa-star"></i></li>
                                                    <?php 
                                                    }
                                                    if($starcheck==1)
                                                    {
                                                    ?>
                                                        <li><i class="fa fa-star-half-empty"></i></li>
                                                    <?php
                                                        if($data[7]=="0.5")
                                                        {
                                                        ?>
                                                        <li><i class='fa fa-star-o'></i></li>
                                                        <li><i class='fa fa-star-o'></i></li>
                                                        <li><i class='fa fa-star-o'></i></li>
                                                        <li><i class='fa fa-star-o'></i></li>
                                                        <?php    
                                                        }
                                                        if($data[7]=="1.5")
                                                        {
                                                        ?>
                                                        <li><i class='fa fa-star-o'></i></li>
                                                        <li><i class='fa fa-star-o'></i></li>
                                                        <li><i class='fa fa-star-o'></i></li>
                                                        <?php    
                                                        }
                                                        if($data[7]=="2.5")
                                                        {
                                                        ?>
                                                        <li><i class='fa fa-star-o'></i></li>
                                                        <li><i class='fa fa-star-o'></i></li>
                                                        <?php    
                                                        }
                                                        if($data[7]=="3.5")
                                                        {
                                                        ?>
                                                           <li><i class='fa fa-star-o'></i></li>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                                <div>
                                                    <div><span><img src="images/1.png" style="color:#343c42;height:18px;width:18px;"></span><span style="padding-left:10px;"><?php echo $data[3]; ?></span></div>
                                                    <div style="padding-top:10px;"><span><img src="images/2.png" style="color:#343c42;height:18px;width:18px;"></span><span style="padding-left:10px;color:#979797;letter-spacing:1px;"><?php echo $data[4]; ?></span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <?php
                                            $roomdata=$con->query("select min(rateperday) from assignroomtype where hotelid=$data[1]");
                                            $roomrow=mysqli_fetch_array($roomdata);
                                            ?>
                                            <div class="hot-page2-alp-ri-p3">
                                                <span class="hot-list-p3-1">Starting Price Per Day</span> 
                                                <span class="hot-list-p3-2"><i class="fa fa-rupee">
                                                        <font style="font-weight:0px;"><?php echo $roomrow[0]; ?>/-</font></i> 
                                                </span>
                                                <span class="hot-list-p3-4">
                                                    <a href="hotel-details.php?hotelid=<?php echo $data[1]; ?>" class="hot-page2-alp-quot-btn"><b class="fa fa-arrow-right"></b> View More</a>
                                                </span> </div>
                                        </div>
                                    </div>
                                    <?php
                                    }
                                    ?>								
                                </div>
                            </div>
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