<!DOCTYPE html>
<?php require_once 'connection.php'; 
      require_once './insertdata.php';
      if($_REQUEST[packageid]!="")
      {
          $_SESSION[packageid]=$_REQUEST[packageid];
          header('location:packagedetails.php');
      }
?>
<html lang="en">
    <?php
    require_once 'head.php';
    ?>

    <body style="text-transform:capitalize;">
        <div id="preloader">
            <div id="status">&nbsp;</div>
        </div>

        <?php
        require_once 'header_toppati.php';
        ?>

        <?php
        require_once 'header.php';
        ?>
<section>
    <?php
            $datalavo=$con->query("SELECT pp.*,p.*,c.*,s.*,co.* FROM packageplace pp,place p,city c,state s,country co where p.placeid=pp.placeid and c.cityid=p.cityid and s.stateid=c.stateid and co.countryid=s.countryid and pp.packageid=$_SESSION[packageid]");
            $package=$con->query("select * from package where packageid=$_SESSION[packageid]");
            $packagedayo=  mysqli_fetch_array($package);
            $datadayo=  mysqli_fetch_array($datalavo);
            $packagerate=$con->query("select count(rate),sum(rate) from rate where packageid=$_SESSION[packageid]");
            $packagerateaapo=mysqli_fetch_array($packagerate);
            $avgcount=$packagerateaapo[1]/$packagerateaapo[0];
     ?>       
    <div class="rows inner_banner" style="background:url('<?php echo "$packagedayo[5]"; ?>') no-repeat;background-size: cover!important;">
        <div class="container">
            <h2><span><?php echo $datadayo[16]; ?> -</span> <?php echo $packagedayo[1]; ?><span class="tour_star">
                <?php
               for($i=1;$i<=5;$i++)
               {
                   if($i<=$avgcount)
                   {
                   ?>
                    <i class="fa fa-star"></i>
                   <?php
                   }
               }
                ?>
                </span>
                <?php
                if($avgcount!="")
                {
                ?>
                <span class="tour_rat"><?php echo $avgcount; ?><i class="fa fa-star" style="font-size:10px;top:-20px;right:1px;position:relative;"></i></span>
                <?php
                }
                ?>
            </h2>
            <ul>
                <li><a href="packagelist.php">Package</a>
                </li>
                <li><i class="fa fa-angle-right" aria-hidden="true"></i> </li>
                <li><a href="javascript:void(0)" class="bread-acti"><?php echo $packagedayo[1]; ?></a>
                </li>
            </ul>
            <p>Book travel packages and enjoy your holidays with distinctive experience</p>
        </div>
    </div>
</section>
<!--====== TOUR DETAILS - BOOKING ==========-->
<section>
    <div class="rows banner_book" id="inner-page-title">
        <div class="container">
            <div class="banner_book_1">
                <ul>
                    <li class="dl1">Location : <?php echo $datadayo[11]; ?>&nbsp;,&nbsp;<?php echo $datadayo[14]; ?></li>
                    <?php
                         $offer = $con->query("select * from offer where fromdate<=curdate() and todate>=curdate() and packageid=$_SESSION[packageid]");
                         $offerrow = mysqli_fetch_array($offer);
                         $a=$packagedayo[4]*$offerrow[5]/100;
                    ?>
                    <li class="dl2">Price : <i class="fa fa-rupee"></i>&nbsp;<?php echo $ag=$packagedayo[4]-$a;  ?>
                        <?php
                        if($offerrow[0]!="")
                        {
                        ?>
                        <font style="font-size:18px;position:relative;padding:15px 3px 34px 0px;right:-52px;background:#FF0049;"><?php echo $offerrow[5] . "% off"; ?></font>
                        <?php
                        }
                        ?>
                    </li>
                    <li class="dl3">Duration : <?php echo $packagedayo[3];  ?> Nights / <?php echo $packagedayo[2];  ?> Days</li>
                    <li class="dl4"><a href="javascript:void(0)" data-toggle="modal" data-target="#staticpackage" onclick="staticpackageleva('staticpackage',<?php echo $_SESSION[packageid]; ?>);">Book Now</a> </li>
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
                    <h2>The Best Sight Seeing in <?php echo $datadayo[11]; ?>&nbsp;,&nbsp;<?php echo $datadayo[14]; ?> </h2> </div>
                <!--====== TOUR DESCRIPTION ==========-->
                <div class="tour_head1">
                    <h3>Place Point</h3>
                    <p style="padding-left:40px;">
                    <div class="row">
                    <?php
                    $packgeplace=$con->query("SELECT pp.*,p.* FROM packageplace pp,placepoint p where p.pointid=pp.pointid and packageid=$_SESSION[packageid]");
                    while($packgeplacedayo=mysqli_fetch_array($packgeplace))
                    {    
                    ?>
                        <div class="col-md-3" style="padding:10px;color:#7f7f7f;">
                        <font style="padding-right:20px;" > <?php echo  "<font style='color:black;'> -</font> ".$packgeplacedayo[6];?> </font>
                        </div>
                    <?php
                    }

                    ?>
                    </div>
                    </p>
                </div>
                <!--====== ROOMS: HOTEL BOOKING ==========-->
                <div class="tour_head1 hotel-book-room">
                    <h3>Photo Gallery</h3>
                    <div id="myCarousel1" class="carousel slide" data-ride="carousel">
                        <!-- Indicators -->
                        <ul class="carousel-indicators carousel-indicators-1" style="width:fit-content!important;margin-left:auto!important;right:0px!important;margin-right:auto;">
                            <?php
                            $cnt=0;
                            $packgeplace=$con->query("SELECT pp.*,p.* FROM packageplace pp,placepoint p where p.pointid=pp.pointid and packageid=$_SESSION[packageid]");
                            while($packgeplacedayo=mysqli_fetch_array($packgeplace))
                            { 
                                
                            ?>
                            <li data-target="#myCarousel1" data-slide-to="<?php echo $cnt;?>"><img src="<?php echo $packgeplacedayo[9]; ?>"></li>
                            <?php
                            $cnt++;
                            }
                            ?>
                        </ul>
                        <!-- Wrapper for slides -->
                        <div class="carousel-inner carousel-inner1" role="listbox" style="height:345px;">
                            <?php
                            $cntslider=1;
                            $packgeplace=$con->query("SELECT pp.*,p.* FROM packageplace pp,placepoint p where p.pointid=pp.pointid and packageid=$_SESSION[packageid]");
                            while($packgeplacedayo=mysqli_fetch_array($packgeplace))
                            {
                                
                            ?>
                            <div class="item <?php if($cntslider==1){echo 'active';} ?>"> <img src="<?php echo $packgeplacedayo[9]; ?>" class="img-responsive" style="height:345px;"> </div>
                            <?php
                            $cntslider++;
                            }   
                            ?> 
                        </div>
                        <!-- Left and right controls -->
                        <a class="left carousel-control" href="#myCarousel1" role="button" data-slide="prev"> <span><i class="fa fa-angle-left hotel-gal-arr" aria-hidden="true"></i></span> </a>
                        <a class="right carousel-control" href="#myCarousel1" role="button" data-slide="next"> <span><i class="fa fa-angle-right hotel-gal-arr hotel-gal-arr1" aria-hidden="true"></i></span> </a>
                    </div>
                </div>
                <!--====== DURATION ==========-->
                <div class="tour_head1 l-info-pack-days days">
                    <h3>Day to Day Itinerary</h3>
                    <ul>
                            <?php
                            $cntslider=1;
                            $packgeplace=$con->query("SELECT pp.*,p.* FROM packageplace pp,placepoint p where p.pointid=pp.pointid and packageid=$_SESSION[packageid]");
                            while($packgeplacedayo=mysqli_fetch_array($packgeplace))
                            {
                            ?>
                                <li class="l-info-pack-plac"> <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    <h4><span style="color:black;">Day : <?php echo $cntslider; ?></span> <font style="color:#4B4B4B;"><?php echo $packgeplacedayo[6]; ?></font></h4>
                                    <p><?php echo $packgeplacedayo[8]; ?></p>
                                </li>
                            <?php
                                $cntslider++;
                            }
                            ?>
                    </ul>
                </div>
                <div>
                    <div class="dir-rat">
                        <?php
                        if($_SESSION[type]==1)
                        {
                            $sel=$con->query("SELECT * FROM review where packageid=$_SESSION[packageid] and emailid='$_SESSION[user]'");
                            $sell=$con->query("SELECT * FROM rate where packageid=$_SESSION[packageid] and emailid='$_SESSION[user]'");
                            $selcnt=  mysqli_num_rows($sel);
                            $selcnt1=  mysqli_num_rows($sell);
                            $rev=$con->query("SELECT * FROM billhistory where emailid='$_SESSION[user]' and mixpackageid=$_SESSION[packageid] and itemcode='static'");
                           if(mysqli_num_rows($rev)>=1)
                           {
                               
                                if($selcnt==0 && $selcnt1==0)
                                {
                            ?>
                            <form class="dir-rat-form" name="" action="" method="post">
                                    <div class="dir-rat-inn dir-rat-title">
                                        <h3>Write Your Rating & Review Here</h3>
                                        <p>Your Feedback is Important</p>

                                        <fieldset class="rating">
                                            <input type="radio" id="star5" name="rate" value="5" />
                                            <label class="full" for="star5" title="Awesome - 5 stars"></label>
                                            <input type="radio" id="star4" name="rate" value="4" />
                                            <label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                            <input type="radio" id="star3" checked="" name="rate" value="3" />
                                            <label class="full" for="star3" title="Meh - 3 stars"></label>
                                            <input type="radio" id="star2" name="rate" value="2" />
                                            <label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                            <input type="radio" id="star1" name="rate" value="1" />
                                            <label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                        </fieldset>
                                    </div>
                                    <div class="dir-rat-inn">
                                            <div class="form-group col-md-12 pad-left-o">
                                                <textarea placeholder="Write your message" name="review" required=""></textarea>
                                            </div>
                                            <div class="form-group col-md-12 pad-left-o">
                                                <input type="submit" value="SUBMIT" name="sendreview" na class="link-btn"> 
                                            </div>
                                    </div>
                            </form>
                            <?php
                                }
                                else
                                {
                                    $selfinal=  mysqli_fetch_array($sel);
                                    $selfinal1= mysqli_fetch_array($sell);
                                 ?>
                                    <form class="dir-rat-form" name="" action="" method="post">
                                                <div class="dir-rat-inn dir-rat-title">
                                                    <h3>Your Rating & Review Here</h3>
                                                    <p>Your Feedback is Important</p>

                                                    <fieldset class="rating">
                                                        <input type="radio" id="star5" onchange="review();" name="uprate" value="5" <?php if($selfinal1[3]==5){echo 'checked';} ?>/>
                                                        <label class="full" for="star5" title="Awesome - 5 stars"></label>
                                                        <input type="radio" id="star4" onchange="review();" name="uprate" value="4" <?php if($selfinal1[3]==4){echo 'checked';} ?>/>
                                                        <label class="full" for="star4" title="Pretty good - 4 stars"></label>
                                                        <input type="radio" id="star3" onchange="review();" name="uprate" value="3" <?php if($selfinal1[3]==3){echo 'checked';} ?>/>
                                                        <label class="full" for="star3" title="Meh - 3 stars"></label>
                                                        <input type="radio" id="star2" onchange="review();" name="uprate" value="2" <?php if($selfinal1[3]==2){echo 'checked';} ?>/>
                                                        <label class="full" for="star2" title="Kinda bad - 2 stars"></label>
                                                        <input type="radio" id="star1" onchange="review();" name="uprate" value="1" <?php if($selfinal1[3]==1){echo 'checked';} ?>/>
                                                        <label class="full" for="star1" title="Sucks big time - 1 star"></label>
                                                    </fieldset>
                                                </div>
                                                <div class="dir-rat-inn">
                                                    <div class="form-group col-md-12 pad-left-o">
                                                        <textarea placeholder="Update your Review" onchange="review();" name="upreview" required=""><?php echo $selfinal[3]; ?></textarea>
                                                    </div>
                                                    <div class="form-group col-md-12 pad-left-o">
                                                        <input type="submit" value="change my rate & review" id="revbtn" name="upreviewform" na class="link-btn"> 
                                                    </div>
                                                </div>
                                            </form>
                                 <?php

                                }
                           }
                        }
                        ?>
                        <!--COMMENT RATING-->
                        <?php
                        if($avgcount!="")
                        {
                        ?>
                            <h3>Package Rating & Review</h3>
                        <?php
                        }
                        else
                        {
                        ?>
                            <h3>No Rating & Review Avaliable</h3>
                        <?php
                        }
                        ?>

                        <?php
                        $rev=$con->query("SELECT * FROM register ree,rate r,review re,package p where p.packageid=r.packageid and p.packageid=re.packageid and ree.emailid=r.emailid and ree.emailid=re.emailid and r.packageid=$_SESSION[packageid]");
                        while($revaapo=mysqli_fetch_array($rev))
                        {
                         ?>
                        <div class="dir-rat-inn dir-rat-review">
                            <div class="row">
                                <div class="col-md-3 dir-rat-left"> <img src="<?php echo $revaapo[10]; ?>" class="img-responsive"style="height:100px!important;width:100px!important; " alt="">
                                    <p><?php echo $revaapo[3]." ".$revaapo[4]; ?> <span><?php echo date('d F Y',strtotime($revaapo[19])); ?></span> </p>
                                </div>
                                <div class="col-md-9 dir-rat-right">
                                    <div class="dir-rat-star"> 
                                                        <?php
                                                        for($i=1;$i<=5;$i++)
                                                        {
                                                            if($i<=$revaapo[14])
                                                            {
                                                            ?>
                                                             <i class="fa fa-star"></i>
                                                            <?php
                                                            }
                                                        }
                                                         ?>
                                    </div>
                                    <p><?php echo $revaapo[18]; ?></p>
                                </div>
                            </div>
                        </div>
                        <?php
                        }
                        ?>
                    </div>
                </div>
            </div>
            <div class="col-md-3 tour_r">
                <!--====== TRIP INFORMATION ==========-->
                <div class="tour_right tour_incl tour-ri-com">
                    <h3>Trip Information</h3>
                    <ul>
                        <?php
                        $sech=$con->query("select *,datediff(todate,fromdate) from schedule where packageid=$_SESSION[packageid]");
                        $sechaapo=  mysqli_fetch_array($sech);
                        ?>
                        <li>Location : <?php echo $datadayo[11]; ?>&nbsp;,&nbsp;<?php echo $datadayo[14]; ?></li>
                        <li>Arrival Date: <?php echo $sechaapo[2]; ?></li>
                        <li>Departure Date: <?php echo $sechaapo[2]; ?></li>
                        <li>Number of Days: <?php echo $sechaapo[9]; ?> days</li>
                        <li>Provide Free Guide Service</li>
                        <li>Breakfast,Lunch,Dinner Include</li>
                    </ul>
                </div>
                <!--====== HELP PACKAGE ==========-->
                <div class="tour_right head_right tour_help tour-ri-com">
                    <h3>Help & Support</h3>
                    <div class="tour_help_1">
                        <h4 class="tour_help_1_call">Call Us Now</h4>
                        <?php
                        $phone=$con->query("select * from siteprofile where category=2");
                        $phoneappo=  mysqli_fetch_array($phone);
                        ?>
                        <h4><i class="fa fa-phone" aria-hidden="true"></i> <?php echo $phoneappo[1]; ?></h4> </div>
                </div>
                <!--====== PUPULAR TOUR PACKAGES ==========-->
                <div class="tour_right tour_rela tour-ri-com">
                    <?php
                        if($avgcount!="")
                        {
                        ?>
                            <h3>POPULAR PACKAGES</h3>
                        <?php
                        }
                        ?>
                    <?php
                    $leftrate = $con->query("select *,avg(r.rate) as dd from rate r,package p where p.packageid=r.packageid group by r.packageid order by dd desc limit 0,4");
                    while ($leftaapo = mysqli_fetch_array($leftrate)) 
                    {
                                $packagerate=$con->query("select count(rate),sum(rate) from rate where packageid=$leftaapo[0]");
                                $packagerateaapo=mysqli_fetch_array($packagerate);
                                $avgcount=$packagerateaapo[1]/$packagerateaapo[0];
                    ?>
                    <div class="tour_rela_1"> <img src="<?php echo $leftaapo[9]; ?>" height="200px"/>
                             <h4><?php echo $leftaapo[5]."<br><br>"; ?> <?php echo $leftaapo[6]; ?>Days / <?php echo $leftaapo[7]; ?>Nights</h4>
                            <p>
                                    <?php
                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $avgcount) {
                                            ?>
                                                <i class="fa fa-star" style="color:#FF9800;"></i>
                                            <?php
                                        }
                                    }
                                    ?>
                            </p> 
                            <a href="packagedetails.php?packageid=<?php echo $leftaapo[0]; ?>" class="link-btn">View this Package</a> 
                        </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</section>

        <!-- Manage Parent Model package Bill-->
        <div class="modal fade" id="staticpackage">
                <div class="modal-dialog modal-lg" id="staticpackage1">

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