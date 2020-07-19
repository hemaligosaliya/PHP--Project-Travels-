<!DOCTYPE html>
<?php
require_once 'connection.php';
require_once './insertdata.php';
if ($_REQUEST[hotelid] != "") {
    $_SESSION[hotelid] = $_REQUEST[hotelid];
    header('location:hotel-details.php');
}
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
        <?php
            $row=$con->query("select * from hotel h,assignroomtype ar,assignfoodtype f,place pl,city c,state s,country co where h.hotelid=ar.hotelid and h.placeid=pl.placeid and c.cityid=pl.cityid and s.stateid=c.stateid and co.countryid=s.countryid and h.hotelid=f.hotelid and h.hotelid=$_SESSION[hotelid]");
            $data=  mysqli_fetch_array($row);
        ?>
        <section>
            <div class="rows inner_banner inner_banner_2" style=" background: url('<?php echo $data[10]; ?>') no-repeat center center;background-size: cover;">
                <div class="container">
                    <h2><span style="text-transform:capitalize;"><?php echo $data[2]; ?></span>&nbsp;
                    <span class="tour_star">
                        <?php
                        $starcheck = 0;
                        if ($data[7] == "0.5" || $data[7] == "1.5" || $data[7] == "2.5" || $data[7] == "3.5" || $data[7] == "4.5") 
                        {
                            $starcheck = 1;
                        }
                        for ($i = 1; $i <= floor($data[7]); $i++) 
                        {
                            ?>
                            <i class="fa fa-star"></i>
                            <?php
                        }
                        if($starcheck==1)
                                                    {
                                                    ?>
                                                        <i class="fa fa-star-half-empty"></i>
                                                    <?php
                                                        if($data[7]=="0.5")
                                                        {
                                                        ?>
                                                        <i class='fa fa-star-o'></i>
                                                        <i class='fa fa-star-o'></i>
                                                        <i class='fa fa-star-o'></i>
                                                        <i class='fa fa-star-o'></i>
                                                        <?php    
                                                        }
                                                        if($data[7]=="1.5")
                                                        {
                                                        ?>
                                                        <i class='fa fa-star-o'></i>
                                                        <i class='fa fa-star-o'></i>
                                                        <i class='fa fa-star-o'></i>
                                                        <?php    
                                                        }
                                                        if($data[7]=="2.5")
                                                        {
                                                        ?>
                                                        <i class='fa fa-star-o'></i>
                                                        <i class='fa fa-star-o'></i>
                                                        <?php    
                                                        }
                                                        if($data[7]=="3.5")
                                                        {
                                                        ?>
                                                           <i class='fa fa-star-o'></i>
                                                        <?php
                                                        }
                                                    }
                        ?>
                </span><span class="tour_rat"><?php echo $data[7]; ?><i class="fa fa-star" style="font-size:10px;top:-15px;right:-3px;position:relative;"></i></span></h2>
                    <ul>
                        <li><a href="hotellist.php">Hotel</a>
                        </li>
                        <li><i class="fa fa-angle-right" aria-hidden="true"></i> </li>
                        <li><a href="javascript:void(0);" class="bread-acti"><?php echo $data[2]; ?></a>
                        </li>
                    </ul>
                    <p>Location: <?php echo $data[3]; ?></p>
                </div>
            </div>
        </section>
        <!--====== TOUR DETAILS - BOOKING ==========-->
        <section>
            <div class="rows banner_book" id="inner-page-title">
                <div class="container">
                    <div class="banner_book_1">
                        <ul>
                            <li class="dl1">Location : <?php echo $data[35]; ?>&nbsp;,&nbsp;<?php echo $data[37]; ?></li>
                            <li class="dl2">Price : <i class="fa fa-rupee"></i>&nbsp;<?php echo $data[20]; ?></li>
                            <li class="dl3">Duration : One Night (minimum)</li>
                            <li class="dl2"><i class="fa fa-phone"></i>&nbsp;&nbsp;<?php echo $data[4]; ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!--====== TOUR DETAILS ==========-->
        <section>
            <div class="rows inn-page-bg com-colo">
                <div class="container inn-page-con-bg tb-space">
                    <div class="col-md-9">
                        <!--====== TOUR TITLE ==========-->
                        <div class="tour_head">
                            <h2 style="text-transform:capitalize;"><?php echo $data[2]; ?>
                                <?php
                                if($data[8]=="veg")
                                {
                                ?>
                                <img src="images/veg.png" height="20px"/>
                                <?php    
                                }
                                elseif($data[8]=="non-veg")
                                {
                                ?>
                                <img src="images/non-veg.png" height="20px"/>
                                <?php   
                                }
                                elseif($data[8]=="both")
                                {
                                 ?>
                                <img src="images/both.jpeg" height="20px"/>
                                <?php    
                                }
                                ?>
                            </h2> 
                        </div>
                        <!--====== TOUR DESCRIPTION ==========-->
                        <div class="tour_head1 hotel-com-color">
                            <h3>About <?php echo $data[2]; ?></h3>
                            <p><?php echo $data[6]; ?></p>
                            
                        </div>
                        <!-- ===== SEIGHT SEEN ================ -->
                        <div class="tour_head1 hotel-com-color">
                            <h3>Best Sight Seeing Placepoint Near Hotel</h3>
                            <?php
                            $sel=$con->query("select * from placepoint where placeid=$data[0] limit 0,8");
                            $cnt=1;
                            while($selrow=mysqli_fetch_array($sel))
                            {
                            ?>
                            <font style="color:#9D9D9D;padding-right:20px;"><?php echo "$cnt"."<font style='color:black;'>&nbsp;&nbsp;)&nbsp;&nbsp;</font>".$selrow[2]; ?></font>
                            <?php
                            $cnt++;
                            }   
                            ?>
                        </div>
                        <!--====== ROOMS: HOTEL BOOKING ==========-->
                        <div class="tour_head1 hotel-book-room">
                            <h3>Photo Gallery Of Hotel & Place Point</h3>
                        <div id="myCarousel1" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ul class="carousel-indicators carousel-indicators-1" style="width:fit-content!important;margin-left:auto!important;right:0px!important;margin-right:auto;">
                            <?php
                            $cnt=0;
                            $sel=$con->query("select * from placepoint where placeid=$data[0] limit 0,8");
                            while($selrow=mysqli_fetch_array($sel))
                            {     
                            ?>
                            <li data-target="#myCarousel1" data-slide-to="<?php echo $cnt;?>"><img src="<?php echo $selrow[5]; ?>"></li>
                            <?php
                            $cnt++;
                            }
                            ?>
                            <li data-target="#myCarousel1" data-slide-to="<?php echo $cnt;?>"><img src="<?php echo $data[9]; ?>"></li>
                            <?php $cnt++; ?>
                            <li data-target="#myCarousel1" data-slide-to="<?php echo $cnt;?>"><img src="<?php echo $data[10]; ?>"></li>
                        </ul>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner carousel-inner1" role="listbox" style="height:345px;">
                            <?php
                            $cntslider=1;
                            $sel=$con->query("select * from placepoint where placeid=$data[0] limit 0,8");
                            while($selrow=mysqli_fetch_array($sel))
                            {  
                            ?>
                            <div class="item <?php if($cntslider==1){echo 'active';} ?>"> <img src="<?php echo $selrow[5]; ?>" class="img-responsive animated fadeIn" style="height:345px;"> </div>
                            <?php
                            $cntslider++;
                            }   
                            ?>
                            <div class="item <?php if($cntslider==1){echo 'active';} ?>"> <img src="<?php echo $data[9]; ?>" class="img-responsive" style="height:345px;"> </div>
                            <div class="item <?php if($cntslider==1){echo 'active';} ?>"> <img src="<?php echo $data[10]; ?>" class="img-responsive" style="height:345px;"> </div>
                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel1" role="button" data-slide="prev"> <span><i class="fa fa-angle-left hotel-gal-arr animated fadeIn" aria-hidden="true"></i></span> </a>
                        <a class="right carousel-control" href="#myCarousel1" role="button" data-slide="next"> <span><i class="fa fa-angle-right hotel-gal-arr hotel-gal-arr1" aria-hidden="true"></i></span> </a>
                    </div>
                        </div>
                        <!--====== ABOUT THE TOUR ==========-->
                        <div class="tour_head1">
                            <h3 style="text-transform:capitalize;"><?php echo $data[2]."'s"; ?> time schedule</h3>
                            <font style="text-transform:capitalize; padding-right:10px;"><i class="fa fa-clock-o" style="padding-right:10px;"></i>Check in time :- <font style="color:black;"><?php echo $data[13]; ?></font></font>
                            <font style="text-transform:capitalize; padding-right:10px;"><i class="fa fa-clock-o" style="padding-right:10px;"></i>Check out time :- <font style="color:black;"><?php echo $data[12]; ?></font></font>
                        </div>
                        <!--======= FOOD TYPES ====-->
                        <div class="tour_head1">
                            <h3 style="text-transform:capitalize;"><?php echo $data[2]."'s"; ?> delicious food type</h3>
                            <p style="color:black;padding-left:20px;">
                                <?php $sel=$con->query("SELECT * FROM assignfoodtype a,food f where f.foodid=a.foodid and hotelid=$_SESSION[hotelid]");   
                                        while($selrow=mysqli_fetch_array($sel))
                                      {
                                      ?>
                                        <font style="padding-right:15px"><i class="fa fa-cutlery" style="padding-right:10px;"></i>&nbsp;<?php echo $selrow[4]; ?></font>
                                      <?php
                                      }
                                ?>
                            </p>
                        </div>
                        <!--====== HOTEL ROOM TYPES ==========-->
                        <div class="tour_head1">
                            <h3>ROOMS & AVAILABILITIES</h3>
                            <div class="tr-room-type">
                                <ul>
                                    <?php
                                    $sum=0;
                                    $roomrow=$con->query("select * from assignroomtype a,room r where r.roomid=a.roomid and hotelid=$_SESSION[hotelid]");
                                    while($roomdata=  mysqli_fetch_array($roomrow))
                                    {
                                        $sum=$sum+$roomdata[3];
                                     ?>
                                    <li>
                                        <div class="tr-room-type-list">
                                            <div class="col-md-3 tr-room-type-list-1">
                                                <?php
                                                if($roomdata[7]=="single")
                                                {
                                                ?>
                                                <img src="hotel room/single-Room.jpg" height="150px" alt="" />
                                                <?php
                                                }
                                                elseif($roomdata[7]=="double")
                                                {
                                                ?>
                                                <img src="hotel room/double-double-Room.jpg" height="150px" alt="" />
                                                <?php
                                                }
                                                elseif($roomdata[7]=="triple")
                                                {
                                                ?>
                                                <img src="hotel room/Triple-Room.jpg" height="150px" alt="" />
                                                <?php
                                                }
                                                elseif($roomdata[7]=="quad")
                                                {
                                                ?>
                                                <img src="hotel room/quad-Room.jpg" height="150px" alt="" />
                                                <?php
                                                }
                                                elseif($roomdata[7]=="queen")
                                                {
                                                ?>
                                                <img src="hotel room/Queen-Room.jpg" height="150px" alt="" />
                                                <?php
                                                }
                                                elseif($roomdata[7]=="king")
                                                {
                                                ?>
                                                <img src="hotel room/King-Room.jpg" height="150px" alt="" />
                                                <?php
                                                }
                                                elseif($roomdata[7]=="twin")
                                                {
                                                ?>
                                                <img src="hotel room/Twin-Room.jpg" height="150px" alt="" />
                                                <?php
                                                }
                                                elseif($roomdata[7]=="hollywood twin room")
                                                {
                                                ?>
                                                <img src="hotel room/Hollywood-Twin-Room.jpg" height="150px" alt="" />
                                                <?php
                                                }
                                                elseif($roomdata[7]=="double double")
                                                {
                                                ?>
                                                <img src="hotel room/double-double-Room.jpg" height="150px" alt="" />
                                                <?php
                                                }
                                                elseif($roomdata[7]=="studio")
                                                {
                                                ?>
                                                <img src="hotel room/studio-Room.jpg" height="150px" alt="" />
                                                <?php
                                                }
                                                elseif($roomdata[7]=="executive suite")
                                                {
                                                ?>
                                                <img src="hotel room/Room-Type-suite-Room.jpg" height="150px" alt="" />
                                                <?php
                                                }
                                                elseif($roomdata[7]=="mini suite")
                                                {
                                                ?>
                                                <img src="hotel room/Room-Type-suite-Room.jpg" height="150px" alt="" />
                                                <?php
                                                }
                                                elseif($roomdata[7]=="connecting room")
                                                {
                                                ?>
                                                <img src="hotel room/connecting-rooms.jpg" height="150px" alt="" />
                                                <?php
                                                }
                                                elseif($roomdata[7]=="connecting room")
                                                {
                                                ?>
                                                <img src="hotel room/connecting-rooms.jpg" height="150px" alt="" />
                                                <?php
                                                }
                                                elseif($roomdata[7]=="murphy room")
                                                {
                                                ?>
                                                <img src="hotel room/murphy-bed-rooms.jpg" height="150px" alt="" />
                                                <?php
                                                }
                                                elseif($roomdata[7]=="cabana")
                                                {
                                                ?>
                                                <img src="hotel room/Cabana-Room.jpg" height="150px" alt="" />
                                                <?php
                                                }
                                                elseif($roomdata[7]=="villa")
                                                {
                                                ?>
                                                <img src="hotel room/Villas.jpg" height="150px" alt="" />
                                                <?php
                                                }
                                                else
                                                {
                                                ?>
                                                <img src="hotel room/Room-Type-presidential-suite-bedroom.jpg" height="150px" alt="" />
                                                <?php
                                                }
                                                ?>                                               
                                            </div>
                                            <div class="col-md-6 tr-room-type-list-2">
                                                <h4><?php echo $roomdata[7]; ?></h4>
                                                <p><b>Amenities : </b> Television , Wi-Fi , Towels , Bedsheet , ac / non-ac, Garden and more.. </p> 
                                                <span><b>Includes : </b> <?php echo $roomdata[5]; ?></span> 
                                                <span><b>Rooms : </b> <?php echo $roomdata[3]; ?> Avaliable</span> </div>
                                            <div class="col-md-3 tr-room-type-list-3"> 
                                                <span class="hot-list-p3-1">Rate Per Day</span> 
                                                <span class="hot-list-p3-2"><i class="fa fa-rupee"></i><?php echo " ".$roomdata[4]; ?> /-</span> 
                                                <i class="fa fa-wifi" style="color:black;padding-left:20px;"></i>
                                                <i class="fa fa-building" style="color:black;padding-left:10px;"></i>
                                                <i class="fa fa-cutlery" style="color:black;padding-left:10px;"></i>
                                                <i class="fa fa-bed" style="color:black;padding-left:10px;"></i>
                                                <i class="fa fa-bath" style="color:black;padding-left:10px;"></i>
                                                <i class="fa fa-coffee" style="color:black;padding-left:10px;"></i>
                                            </div>
                                        </div>
                                    </li>
                                    <?php
                                    }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!--====== AMENITIES ==========-->
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
                                        <li><i class="fa fa-check" aria-hidden="true"></i><font style="text-transform: capitalize;color:#D5D4D5"> <?php echo $hotelamirow[1]; ?></font></li>
                                     <?php    
                                     }
                                     else
                                     {
                                     ?>
                                        <li><i class="fa fa-check" aria-hidden="true"></i> <font style="text-transform:capitalize;"><?php echo $hotelamirow[1]; ?></font></li>
                                     <?php 
                                     }
                                 }
                                ?>
                            </ul>
                        </div>
                        <!--====== TOUR LOCATION ==========-->
                        <div class="tour_head1 tout-map map-container">
                            <h3>Location</h3>
                            <iframe src="<?php echo $data[5]; ?>" style="padding:0px;margin:0px;height:400px;width:100%;"></iframe>
                        </div>
                    </div>
                    <div class="col-md-3 tour_r">
                        <!--====== PACKAGE SHARE ==========-->
                        <div class="tour_right head_right tour_social tour-ri-com">
                        <div class="tour_right head_right tour_help tour-ri-com">
                            <h3>Help & Support</h3>
                            <div class="tour_help_1">
                                <h4 class="tour_help_1_call">Call Us Now</h4>
                                <h4><i class="fa fa-phone" aria-hidden="true" style="letter-spacing:1px;"></i>&nbsp;<?php echo $data[4] ; ?></h4> </div>
                        </div>
                        <!--====== PUPULAR TOUR PACKAGES ==========-->
                        <div class="tour_right tour_rela tour-ri-com">
                            <h3>Popular Hotels</h3>
                                                <?php
                        $sel=$con->query("select * from hotel group by star desc limit 7");
                        while($row=  mysqli_fetch_array($sel))
                        {
                        ?>
                            <div class="tour_rela_1"> <img src="<?php echo $row[10]; ?>" width="221px" height="90px" alt="" />
                                <h4><?php echo $row[2]; ?></h4>
                                <h5><?php
                                        $starcheck = 0;
                                        if ($row[7] == "0.5" || $row[7] == "1.5" || $row[7] == "2.5" || $row[7] == "3.5" || $row[7] == "4.5") {
                                            $starcheck = 1;
                                        }
                                        for ($i = 1; $i <= floor($row[7]); $i++) {
                                            ?>
                                    <i class="fa fa-star" style="color: #FF9800;"></i>
                                            <?php
                                        }
                                        if($starcheck==1)
                                                    {
                                                    ?>
                                                        <i class="fa fa-star-half-empty" style='color: #FF9800;'></i>
                                                    <?php
                                                        if($row[7]=="0.5")
                                                        {
                                                        ?>
                                                        <i class='fa fa-star-o' style='color: #FF9800;' ></i>
                                                        <i class='fa fa-star-o' style='color: #FF9800;' ></i>
                                                        <i class='fa fa-star-o' style='color: #FF9800;' ></i>
                                                        <i class='fa fa-star-o' style='color: #FF9800;' ></i>
                                                        <?php    
                                                        }
                                                        if($row[7]=="1.5")
                                                        {
                                                        ?>
                                                        <i class='fa fa-star-o' style='color: #FF9800;' ></i>
                                                        <i class='fa fa-star-o' style='color: #FF9800;' ></i>
                                                        <i class='fa fa-star-o' style='color: #FF9800;' ></i>
                                                        <?php    
                                                        }
                                                        if($row[7]=="2.5")
                                                        {
                                                        ?>
                                                        <i class='fa fa-star-o' style='color: #FF9800;' ></i>
                                                        <i class='fa fa-star-o' style='color: #FF9800;' ></i>
                                                        <?php    
                                                        }
                                                        if($row[7]=="3.5")
                                                        {
                                                        ?>
                                                           <i class='fa fa-star-o' style='color: #FF9800;' ></i>
                                                        <?php
                                                        }
                                                    }
                                        ?>
                                </h5>
                                <p><?php echo substr($row[6],0,80) ?></p> <a href="hotel-details.php?hotelid=<?php echo $row[1]; ?>" class="link-btn">View this Hotel</a>
                            </div>
                        <?php
                        }
                        ?>   
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
