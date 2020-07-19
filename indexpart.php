<section>
    <div class="rows pad-bot-redu tb-space">
        <div class="container">

            <div class="spe-title">
                <h2>Top <span>tour Packages</span></h2>
                <div class="title-line">
                    <div class="tl-1"></div>
                    <div class="tl-2"><i class="fa fa-gg"></i></div>
                    <div class="tl-3"></div>
                </div>
                <p>India's leading Package Booking website , With opportunity for user to create their custom package.</p>
            </div>
            <div>
                <?php
                    $sel=$con->query("SELECT *,datediff(todate,fromdate) FROM package p,schedule s where p.packageid=s.packageid order by p.packageid desc limit 6");
                    while($packdata=mysqli_fetch_array($sel))
                    {
                ?>
                <a href=href="packagedetails.php?packageid=<?php echo $packdata[0]; ?>"></a>
                    <div class="col-md-4 col-sm-6 col-xs-12 b_packages wow slideInUp" data-wow-duration="0.5s">
                        <?php
                        $offer=$con->query("select * from offer where fromdate<=curdate() and todate>=curdate() and packageid=$packdata[0]");
                        $offerrow=  mysqli_fetch_array($offer);
                        if($offerrow[0]!="")
                        {
                        ?>
                            <div class="band"> <img src="images/band.png" alt="" /> </div>
                            <font style="position:absolute;z-index:999;left:28px;color:white;font-weight:700"><?php echo $offerrow[5]."%"; ?></font>
                        <?php  
                        }
                        ?>

                            <div class="v_place_img" style="height: 200px;overflow: hidden;"> <a href="packagedetails.php?packageid=<?php echo $packdata[0]; ?>"><img src="<?php echo $packdata[5];  ?>" alt="Package Booking" title="<?php echo $packdata[1]; ?>" /> </a></div>

                        <div class="b_pack rows">

                            <div class="col-md-8 col-sm-8">
                                <h4><a href="packagedetails.php?packageid=<?php echo $packdata[0]; ?>"><?php echo $packdata[1];  ?></a></h4>
                            </div>

                            <div class="col-md-4 col-sm-4 pack_icon">
                                <ul>
                                    <li>
                                        <a href="packagedetails.php?packageid=<?php echo $packdata[0]; ?>"><img src="images/clock.png" alt="Date" title="<?php echo $packdata[17]; ?> Days" /> </a>
                                    </li>
                                    <li>
                                        <a href="packagedetails.php?packageid=<?php echo $packdata[0]; ?>"><img src="images/info.png" alt="Details" title="View in detail" /> </a>
                                    </li>
                                    <li>
                                        <a href="packagedetails.php?packageid=<?php echo $packdata[0]; ?>"><img src="images/price.png" alt="Price" title="Package amount &#8377; <?php echo $packdata[4]; ?>" /> </a>
                                    </li>
                                    <?php
                                    $datalavo=$con->query("SELECT pp.*,p.*,c.*,s.*,co.* FROM packageplace pp,place p,city c,state s,country co where p.placeid=pp.placeid and c.cityid=p.cityid and s.stateid=c.stateid and co.countryid=s.countryid and pp.packageid=$packdata[0]");
                                    $datadayo=  mysqli_fetch_array($datalavo);
                                    ?>
                                    <li>
                                        <a href="packagedetails.php?packageid=<?php echo $packdata[0]; ?>"><img src="images/map.png" alt="Location" title="<?php echo $datadayo[16].' / '.$datadayo[14]; ?>"/> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </a>
                <?php
                    }
                ?>
            </div>
        </div>
        <div class="text-center">
            <a href="packagelist.php" title="view more">
                <span style="letter-spacing:1px;">View More</span>
                <span style="padding-left:10px;"><i class="fa fa-paper-plane-o animated fadeInLeft infinite"></i></span>
            </a>
        </div>
    </div>
</section>

<section>
    <div class="rows tb-space pad-top-o pad-bot-redu">
        <div class="container">

            <div class="spe-title">
                <h2> Popular <span>Places</span> </h2>
                <div class="title-line">
                    <div class="tl-1"></div>
                    <div class="tl-2"><i class="fa fa-gg"></i></div>
                    <div class="tl-3"></div>
                </div>
                <p>Book Your Package and enjoy your holidays with distinctive experience with lower price rate on thejourney</p>
            </div>
            <?php
                $data=$con->query("select * from packageplace pa,package p,place pp,city c,state s,country cc where c.cityid=pp.cityid and s.stateid=c.stateid and cc.countryid=s.countryid and p.packageid=pa.packageid and pp.placeid=pa.placeid group by pa.packageid limit 0,1");
                $row= mysqli_fetch_array($data);
            ?>
            <div class="col-md-6">
                    <a href="packagedetails.php?packageid=<?php echo $row[0]; ?>">
                        <div class="tour-mig-like-com pointer" title="<?php echo $row[14]; ?>">
                        <div class="tour-mig-lc-img"> <img src="<?php echo $row[16]; ?>" alt=""> </div>
                        <div class="tour-mig-lc-con">
                            <h5><?php echo $row[14]; ?></h5>
                                    <p><span></span> Starting from <?php echo $row[8]; ?></p>
                        </div>
                    </div>
                    </a>
            </div>
            <?php
                $data=$con->query("select * from packageplace pa,package p,place pp,city c,state s,country cc where c.cityid=pp.cityid and s.stateid=c.stateid and cc.countryid=s.countryid and p.packageid=pa.packageid and pp.placeid=pa.placeid group by pa.packageid limit 1,4");
                while($row= mysqli_fetch_array($data))    
                {
            ?>
            <div class="col-md-3">
                <a href="packagedetails.php?packageid=<?php echo $row[0]; ?>">
                        <div class="tour-mig-like-com pointer" style="max-height:180px;overflow: hidden;" title="<?php echo $row[14]; ?>">
                            <div class="tour-mig-lc-img"> <img src="<?php echo $row[16]; ?>" alt="" style="height:170px;width:255px;"> </div>
                        <div class="tour-mig-lc-con tour-mig-lc-con2">
                            <h5 style="text-transform: capitalize;"><?php echo $row[14]; ?></h5>
                            <p><span style="text-transform: capitalize;"></span> Starting from <?php echo $row[8]; ?></p>
                        </div>
                    </div>
                </a>
            </div>
            <?php
                }
            ?>
        </div>
    </div>
</section>

<section>
    <div class="rows tb-space pad-top-o pad-bot-redu">
        <div class="container">

            <div class="spe-title">
                <h2>Top<span> Branded Hotels</span> </h2>
                <div class="title-line">
                    <div class="tl-1"></div>
                    <div class="tl-2"><i class="fa fa-gg"></i></div>
                    <div class="tl-3"></div>
                </div>
                <p>Book Your Package and enjoy rooms and enjoy your holidays with distinctive experience</p>
            </div>

            <div class="to-ho-hotel">
                <?php
                    $data=$con->query("select * from hotel h,place p,city c,assignroomtype ar where h.hotelid=ar.hotelid and p.placeid=h.placeid and c.cityid=p.cityid group by h.name limit 8");
                    while($row=  mysqli_fetch_array($data))
                    {
                ?>
                <div class="col-md-3">
                    <div class="to-ho-hotel-con">
                        <a href="hotel-details.php?hotelid=<?php echo $row[1]; ?>">
                            <div class="to-ho-hotel-con-1"  style="height:135px;overflow:hidden;">
                                <?php
                                $roomgoto=$con->query("select sum(nofrom) from assignroomtype where hotelid=$row[1]");
                                $aapmane=  mysqli_fetch_array($roomgoto);
                                ?>
                                <div class="hom-hot-av-tic"> Available Rooms: <?php echo $aapmane[0]; ?></div> <img src="<?php echo $row[10]; ?>" alt=""> 
                            </div>
                        </a>
                        <div class="to-ho-hotel-con-23">
                            <div class="to-ho-hotel-con-2">
                                <a href="hotel-details.php?hotelid=<?php echo $row[1]; ?>">
                                    <h4 style="text-transform: capitalize;"><?php echo $row[2]; ?></h4>
                                </a>
                            </div>
                            <div class="to-ho-hotel-con-3">
                                <ul>
                                    <li  style="text-transform: capitalize;" >City: <?php echo $row[18]." ,".$row[23]; ?>
                                        <div class="dir-rat-star ho-hot-rat-star"> Rating: 
                                            <?php
                                                $starcheck = 0;
                                                if ($row[7] == "0.5" || $row[7] == "1.5" || $row[7] == "2.5" || $row[7] == "3.5" || $row[7] == "4.5") {
                                                    $starcheck = 1;
                                                }
                                                for ($i = 1; $i <= floor($row[7]); $i++) {
                                                    ?>
                                                    <i class="fa fa-star"></i>
                                                    <?php
                                                }
                                                if ($starcheck == 1) {
                                                    ?>
                                                    <i class="fa fa-star-half-empty"></i>
                                                    <?php
                                                }
                                                ?>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="col-md-12">
                                            <span><i class="fa fa-rupee"></i></span><span class="ho-hot-pri" style="font-size: 24px;padding-left:5px;"><?php echo $row[28]; ?> /- Per Day</span> 
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
        <div class="text-center">
            <a href="hotellist.php" title="view more">
                <span style="letter-spacing:1px;">View More</span>
                <span style="padding-left:10px;"><i class="fa fa-paper-plane-o animated fadeInLeft infinite"></i></span>
            </a>
        </div>
    </div>
</section>

<section>
    <div class="offer">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="offer-l"> <span class="ol-1"></span> 
                        <span class="ol-2"><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i></span> 
                        <span class="ol-4">Standardized Budget Rooms For Packages</span>                            
                        <span class="ol-3"></span>
                        <?php
                        $aa=$con->query("SELECT min(rateperday),max(rateperday) FROM assignroomtype");
                        $abc=  mysqli_fetch_array($aa);
                        ?>
                        <span class="ol-5"><?php echo "<i class='fa fa-rupee'></i>".$abc[0]." - "."<i class='fa fa-rupee'></i>".$abc[1]; ?></span>
                        <ul>
                            <li class="wow fadeInUp" data-wow-duration="0.5s">
                                <a href="#!" class="waves-effect waves-light btn-large offer-btn"><img src="images/icon/dis1.png" alt="">
                                </a><span>Free WiFi</span>
                            </li>
                            <li class="wow fadeInUp" data-wow-duration="0.7s">
                                <a href="#!" class="waves-effect waves-light btn-large offer-btn"><img src="images/icon/dis2.png" alt=""> </a><span>Breakfast</span>
                            </li>
                            <li class="wow fadeInUp" data-wow-duration="0.9s">
                                <a href="#!" class="waves-effect waves-light btn-large offer-btn"><img src="images/icon/dis3.png" alt=""> </a><span>Pool</span>
                            </li>
                            <li class="wow fadeInUp" data-wow-duration="1.1s">
                                <a href="#!" class="waves-effect waves-light btn-large offer-btn"><img src="images/icon/dis4.png" alt=""> </a><span>Television</span>
                            </li>
                            <li class="wow fadeInUp" data-wow-duration="1.3s">
                                <a href="#!" class="waves-effect waves-light btn-large offer-btn"><img src="images/icon/dis5.png" alt=""> </a><span>GYM</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="offer-r">
                        <?php
                            $lavobhai=$con->query("select min(percentage),max(percentage) from offer");
                            $dayobhai= mysqli_fetch_array($lavobhai);
                        ?>
                        <div class="or-1"> <span class="or-11">Book</span> <span class="or-12">Package</span><span class="or-12potano"><a href="packagelist.php">Now</a></span><span class="or-12potano"><a href=""></a></span> </div>
                        <div class="or-2"> <span class="or-21">Get</span> <span class="or-22" style="font-size:39px;"><?php echo $dayobhai[0].'% - '.$dayobhai[1].'%'; ?></span> <span class="or-23">Off</span> <span class="or-24">free Guide Service provide by our company</span> <span class="or-25"></span> </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="rows tb-space">
        <div class="container events events-1" id="inner-page-title">

            <div class="spe-title" id="aayaavo">
                <h2>Find & View<span> Place & place point</span></h2>
                <div class="title-line">
                    <div class="tl-1"></div>
                    <div class="tl-2"><i class="fa fa-gg"></i></div>
                    <div class="tl-3"></div>
                </div>
                <p>India's leading tour and travels Booking website . Book travel packages and enjoy your holidays with distinctive experience</p>
            </div>
            <div class="row">
                <form method="post" action="" name="findnow" style="margin-left:90px;">
                    <div class="col-md-3">
                         <div class="input-field col s10">
                             <i class="fa fa-globe global" style="top:8px;"></i>
                                            <select name="countryid" required="" class="editprofile" onchange="selectlevareg('state',this.value)">
                                                <option value="" disabled selected>Select Country</option>
                                                <?php
                                                        $datasel = $con->query("select * from country");
                                                        while ($rowsel = mysqli_fetch_array($datasel)) 
                                                        {
                                                        ?>
                                                        <option value="<?php echo $rowsel[0]; ?>"><?php echo $rowsel[1]; ?></option>
                                                        <?php
                                                        }
                                                ?>
                                                
                                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-field col s10 padd-left">
                                <i class="fa fa-paper-plane-o global1" style="top:8px;"></i>
                                <select name="stateid" required="" class="editprofile" id="statecombo" onchange="selectlevareg('city',this.value)">
                                    <option value="" disabled selected>Select State</option>          
                                </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-field col s10 padd-left1">
                                <i class="fa fa-map-marker global2" style="top:8px;"></i>
                                <select name="cityid" required="" id="citycombo" class="editprofile" onchange="selectlevareg('placetaxi',this.value)">
                                        <option value="" disabled selected>Select city</option>   
                                </select>
                         </div>
                    </div>
                    <div class="col-md-3">
                        <div class="input-field col s10 padd-left1">
                                <i class="fa fa-map-o global2" style="top:8px;"></i>
                                <select name="cityid" required="" id="placetaxicombo" class="editprofile" onchange="selectlevareg('pointgoto',this.value)">
                                        <option value="" disabled selected>Select place</option>   
                                </select>
                         </div>
                    </div>
                </form>
            </div>
            <input style="margin-top:20px;" type="text" id="myInput" onkeyup="myFunction()" placeholder="Search Place Point Name.." title="Type in a name">
            <div style="max-height:1046px!important;overflow: auto visible;">
                <table id="myTable">
                    <tbody id="pointgotocombo">
                        <tr>
                            <th style="text-align:center;">No</th>
                            <th style="text-align:center;">Place Point</th>
                            <th style="width:10%;" style="text-align:center;">Center Point km</th>
                            <th style="text-align:center;">Brief History</th>
                        </tr>
                        <?php
                        $place=$con->query("select * from country co,state s,city c,place p,placepoint po where p.placeid=po.placeid and p.cityid=c.cityid and c.stateid=s.stateid and s.countryid=co.countryid");
                        $placecnt=0;
                        while($placeaapo=mysqli_fetch_array($place))
                        {
                            $pack=$con->query("select * from packageplace where placeid=$placeaapo[9]");
                            $packrow=mysqli_fetch_array($pack);
                            $placecnt++;
                        ?>
                        <tr title="<?php echo $placeaapo[7]." -> ".$placeaapo[4]." -> ".$placeaapo[1]; ?>">
                            <td style="text-align:center;"><?php echo $placecnt; ?></td>
                            <td style="text-align:center;"><img src="<?php echo $placeaapo[18]; ?>" alt="" /><a href="javascript:void(0)" class="events-title"><?php echo $placeaapo[15]; ?></a> </td>
                            <td style="text-align:center;"><?php echo $placeaapo[16]." "."km"; ?></td>
                            <td class="e_h1" style="text-align:justify;"><?php echo $placeaapo[17];?>
                                <?php
                                if($packrow[0]!="")
                                {
                                ?>
                                <br><br>
                                <span style="margin: 0 auto;">This place point are avaliable in packages. </span><a href="packagedetails.php?packageid=<?php echo $packrow[0]; ?>" class="animated flash infinite hoverplacepoint">see package now</a>
                                <?php    
                                }
                                ?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>



<section>
    <div class="rows pla pad-bot-redu tb-space">
        <div class="pla1 p-home container">

            <div class="spe-title spe-title-1">
                <h2>Top <span>Sight Seeing</span> in this month</h2>
                <div class="title-line">
                    <div class="tl-1"></div>
                    <div class="tl-2"><i class="fa fa-gg"></i></div>
                    <div class="tl-3"></div>
                </div>
                <p>India's leading tour and travels Booking website. Book travel packages and enjoy your holidays with distinctive experience</p>
            </div>
            <div class="popu-places-home">
                <?php
                $sarapacklavo=$con->query("select * from billhistory where itemcode='static' group by mixpackageid Having count(*)>1");
                while($sarapackaapo= mysqli_fetch_array($sarapacklavo))
                {
                    $pack=$con->query("select * from package paa,schedule sc,packageplace pa,place p,city c,state s,country cc where paa.packageid=sc.packageid and paa.packageid=pa.packageid and cc.countryid=s.countryid and s.stateid=c.stateid and p.placeid=pa.placeid and c.cityid=p.cityid and pa.packageid=$sarapackaapo[3] group by paa.packageid limit 4");
                    $packaapo= mysqli_fetch_array($pack);
                    
                ?>
                <div class="col-md-6 col-sm-6 col-xs-12 place">
                    <div class="col-md-6 col-sm-12 col-xs-12"> <img src="<?php echo $packaapo[5]; ?>" alt="" style="height:183px;width:247px;" /> </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <h3><span><?php echo $packaapo[1]; ?></span> <?php echo $packaapo[2]; ?> Days / <?php echo $packaapo[3]; ?> Nights</h3>
                        <p>Amount : <i class="fa fa-rupee"></i> <font> <?php echo $packaapo[4]; ?></font>
                            <br/><i class="fa fa-map-marker"></i>  Location : <br/> <?php echo $packaapo[31]."/".$packaapo[33]; ?> </p> <a href="packagedetails.php?packageid=<?php echo $packaapo[0]; ?>" class="link-btn">more info</a> </div>
                </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="ho-popu tb-space pad-bot-redu">
        <div class="rows container">

            <div class="spe-title">
                <h2>Top <span>Branding </span>For This month</h2>
                <div class="title-line">
                    <div class="tl-1"></div>
                    <div class="tl-2"><i class="fa fa-gg"></i></div>
                    <div class="tl-3"></div>
                </div>
                <p>India's' leading tour and travels Booking website . Book travel packages and enjoy your holidays with distinctive experience</p>
            </div>
            <div class="ho-popu-bod">
                <div class="col-md-4">
                    <div class="hot-page2-hom-pre-head">
                        <h4>Top Branding <span>Hotels</span></h4>
                    </div>
                    <div class="hot-page2-hom-pre">
                        <ul>
                        <?php
                        $cntpack=0;
                        $selho=$con->query("select * from hotel h,place p,city c,state s,country co where p.placeid=h.placeid and c.cityid=p.cityid and s.stateid=c.stateid and co.countryid=s.countryid group by star desc limit 5");
                        while($rowho=  mysqli_fetch_array($selho))
                        {
                            $cntpack++;
                        ?>
                            <li>
                                <a href="hotel-details.php?hotelid=<?php echo $rowho[1]; ?>">
                                    <div class="hot-page2-hom-pre-1"> <img src="<?php echo $rowho[10]; ?>" alt=""> </div>
                                    <div class="hot-page2-hom-pre-2">
                                        <h5><?php echo $rowho[2]; ?></h5> <span>City: <?php echo $rowho[23]; ?> , <?php echo $rowho[28]; ?></span> </div>
                                    <div class="hot-page2-hom-pre-3"> <span style="width:50px;" class="text-center"><?php echo $rowho[7]; ?><i class="fa fa-star starmate" style="color: #fea900;"></i></span> </div>
                                </a>
                            </li>
                        <?php
                        }
                         if($cntpack==0)
                            {
                                echo '<h2 class="text-center">No Records Found</h2>';
                            }
                        ?>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="hot-page2-hom-pre-head">
                        <h4>Top Branding <span>Packages</span></h4>
                    </div>
                    <div class="hot-page2-hom-pre">
                        <ul>
                            <?php
                            $cntpack=0;
                            $leftrate=$con->query("select *,avg(r.rate) as dd from rate r,package p where p.packageid=r.packageid group by r.packageid order by dd desc limit 5");
                            while($leftaapo=  mysqli_fetch_array($leftrate))
                            {
                             $cntpack++;
                            ?>
                            <li>
                                <a href="packagedetails.php?packageid=<?php echo $leftaapo[0]; ?>">
                                    <div class="hot-page2-hom-pre-1"> <img src="<?php echo $leftaapo[9]; ?>" alt=""> </div>
                                    <div class="hot-page2-hom-pre-2">
                                        <h5><?php echo $leftaapo[5]; ?></h5> <span>Duration: <?php echo $leftaapo[6]; ?> Days and <?php echo $leftaapo[7]; ?> Nights</span> </div>
                                    <div class="hot-page2-hom-pre-3"> <span><?php echo round($leftaapo[12]); ?><i class="fa fa-star starmate"></i></span> </div>
                                </a>
                            </li>
                            <?php
                            }
                            if($cntpack==0)
                            {
                                echo '<h2 class="text-center">No Records Found</h2>';
                            }  
                            ?>

                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="hot-page2-hom-pre-head">
                        <h4>Top Branding <span>Reviewers</span></h4>
                    </div>
                    <div class="hot-page2-hom-pre">
                        <ul>
                              <?php
                              $cntpack=0;
                              $reviewlavo=$con->query("select *,count(r.emailid) as fd from review r,package p where p.packageid=r.packageid group by r.emailid order by fd desc limit 5");
                              while($reviewaapo=  mysqli_fetch_array($reviewlavo))
                              {
                                   $cntpack++;
                                   $lavo=$con->query("select * from register r,city c where c.cityid=r.cityid and emailid like '$reviewaapo[1]'");
                                   $dayo=mysqli_fetch_array($lavo);
                                   $cntlavo=$con->query("select count(*) from review where emailid like '$reviewaapo[1]'");
                                   $cntaapo=mysqli_fetch_array($cntlavo);
                              ?>
                            <li>
                                <a href="packagedetails.php?packageid=<?php echo $reviewaapo[0]; ?>">
                                    <div class="hot-page2-hom-pre-1"> 
                                        <img src="<?php echo $dayo[10]; ?>" alt="">
                                    </div>
                                    <div class="hot-page2-hom-pre-2">
                                        <h5><?php echo $dayo[3]." ".$dayo[4]; ?></h5> <span>No of Reviews: <?php echo $cntaapo[0]; ?> , City : <?php echo $dayo[13]; ?></span> </div>
                                    <div class="hot-page2-hom-pre-3"> <i class="fa fa-hand-o-right starmate" aria-hidden="true" style="color:#2A3C54!important;"></i> </div>
                                </a>
                            </li>
                            <?php
                              }
                              if($cntpack==0)
                                {
                                    echo '<h2 class="text-center">No Records Found</h2>';
                                }
                            ?>
                            
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="foot-mob-sec tb-space">
        <div class="rows container">

            <div class="col-md-6 col-sm-6 col-xs-12 family"> <img src="images/mobile.png" alt="" /> </div>

            <div class="col-md-6 col-sm-6 col-xs-12">

                <div class="foot-mob-app">
                    <h2>Our mobile app is coming soon avaliable on store</h2>
                    <p>India's leading tour and travel Booking website.Book travel packages and enjoy your holidays with distinctive experience</p>
                    <ul>
                        <li><i class="fa fa-check" aria-hidden="true"></i> Easy Hotel Booking</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i> Tour and Travel Packages</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i> Package Reviews and Ratings</li>
                        <li><i class="fa fa-check" aria-hidden="true"></i> Manage your Bookings, Enquiry and Reviews</li>
                    </ul>
                    <img class="pointer" src="images/android.png" alt="">
                    <img class="pointer" src="images/apple.png" alt="">
                </div>
            </div>
        </div>
    </div>
</section>