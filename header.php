<section>
    <div class="top-logo" data-spy="affix" data-offset-top="250">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="wed-logo">
                        <a href="index.php"><img src="images/logo.png" alt="" title=" Plan Your Travel Now "/></a>

                    </div>
                </div>
                <div class="col-md-7">
                    <div class="main-menu">
                        <ul>
                            <li>
                                <?php
                                if ($_SESSION[page] == "index") 
                                {
                                ?>
                                <a href="index.php" style="color:#ff0049;">Home</a>
                                <?php
                                }
                                else
                                {
                                ?>
                                    <a href="index.php">Home</a>
                                <?php
                                }
                                ?>

                            </li>
                            <li>
                                
                                 <?php
                                if ($_SESSION[page] == "about") 
                                {
                                ?>
                                <a href="about-us.php" style="color:#ff0049;">About Us</a>
                                <?php
                                }
                                else
                                {
                                ?>
                                   <a href="about-us.php">About Us</a>
                                <?php
                                }
                                ?>
                                
                            </li>
                            <li class="about-menu">
                                <a href="javascript:void(0)" class="mm-arr">Packages <i class="fa fa-angle-down"></i></a>

                                <div class="mm-pos">
                                    <div class="about-mm m-menu">
                                        <div class="m-menu-inn">
                                            <div class="mm1-com mm1-s1">

                                                    <?php
                                                    $packagedata = $con->query("select * from package limit 0,4");
                                                    while($packagerow = mysqli_fetch_array($packagedata))
                                                    {
                                                    ?>
                                                <div class="ed-course-in" style="margin:12px;" title="<?php echo $packagerow[1]; ?>">
                                                        <a class="course-overlay menu-about" href="packagedetails.php?packageid=<?php echo $packagerow[0]; ?>" >
                                                            <img src="<?php echo $packagerow[5]; ?>" height="71px" width="114px" alt="">
                                                            <span style="text-transform:capitalize;font-size:10px;"><?php echo $packagerow[1]; ?></span>
                                                        </a>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                
                                            </div>
                                            <div class="mm1-com mm1-s2">
                                                <?php
                                                    $packagedata = $con->query("select * from package limit 5,4");
                                                    while($packagerow = mysqli_fetch_array($packagedata))
                                                    {
                                                    ?>
                                                    <div class="ed-course-in" style="margin:12px;" title="<?php echo $packagerow[1]; ?>">
                                                        <a class="course-overlay menu-about" href="packagedetails.php?packageid=<?php echo $packagerow[0]; ?>" >
                                                            <img src="<?php echo $packagerow[5]; ?>" height="71px" width="114px" alt="">
                                                            <span style="text-transform:capitalize;font-size:10px;"><?php echo $packagerow[1]; ?></span>
                                                        </a>
                                                    </div>
                                                    <?php
                                                    }
                                                    ?>
                                                <a href="packagelist.php" class="mm-r-m-btn">View More</a>
                                            </div>
                                            <div class="mm1-com mm1-s3">
                                                <ul>
                                                    <?php
                                                    $packagedata = $con->query("select * from package limit 0,10");
                                                    while($packagerow = mysqli_fetch_array($packagedata))
                                                    {
                                                    ?>
                                                    <li><a style="padding:10px 0px 2px 0px;" href="packagedetails.php?packageid=<?php echo $packagerow[0]; ?>"><?php echo $packagerow[1]; ?></a></li>
                                                    <?php
                                                    }
                                                    ?>
                                                </ul>
                                            </div>
                                            <div class="mm1-com mm1-s4">
                                                <ul>
                                                    <?php
                                                    $packagedata = $con->query("select * from package limit 11,8");
                                                    while($packagerow = mysqli_fetch_array($packagedata))
                                                    {
                                                    ?>
                                                    <li><a style="padding:10px 0px 2px 0px;" href="packagedetails.php?packageid=<?php echo $packagerow[0]; ?>"><?php echo $packagerow[1]; ?></a></li>
                                                    <?php
                                                    }
                                                    ?>
                                                </ul>
                                                 <a href="packagelist.php" style="font-size:14px;margin-left:22px;">View More</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li class="cour-menu">
                                <a href="javascript:void(0)" class="mm-arr">Hotels <i class="fa fa-angle-down"></i></a>

                                <div class="mm-pos">
                                    <div class="cour-mm m-menu">
                                        <div class="m-menu-inn">
                                          <?php
                                          $lavohotel=$con->query("SELECT * FROM thejourney.hotel where star > 4 limit 10");
                                          while($aapohotel=mysqli_fetch_array($lavohotel))
                                          {
                                          ?>
                                            <div class="mm1-compotano mm1-cour-com mm1-s3" style="margin: 0 auto;">
                                                <div class="text-center">
                                                <img src="<?php echo $aapohotel[10]; ?>" style="height:100px;width:100px;"/>
                                                <h4 style="font-size:10px;" class="text-center"><?php echo $aapohotel[2]; ?></h4>
                                                <span class="ratehead">
                                                                                                            <?php
                                                    $starcheck=0;
                                                    if($aapohotel[7]=="0.5"||$aapohotel[7]=="1.5"||$aapohotel[7]=="2.5"||$aapohotel[7]=="3.5"||$aapohotel[7]=="4.5")
                                                    {
                                                        $starcheck=1;
                                                    }
                                                    for($i=1;$i<=floor($aapohotel[7]);$i++)
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
                                                        if($aapohotel[7]=="0.5")
                                                        {
                                                        ?>
                                                            <i class='fa fa-star-o'></i>
                                                            <i class='fa fa-star-o'></i>
                                                            <i class='fa fa-star-o'></i>
                                                            <i class='fa fa-star-o'></i>
                                                        <?php    
                                                        }
                                                        if($aapohotel[7]=="1.5")
                                                        {
                                                        ?>
                                                            <i class='fa fa-star-o'></i>
                                                            <i class='fa fa-star-o'></i>
                                                            <i class='fa fa-star-o'></i>
                                                        <?php    
                                                        }
                                                        if($aapohotel[7]=="2.5")
                                                        {
                                                        ?>
                                                            <i class='fa fa-star-o'></i>
                                                            <i class='fa fa-star-o'></i>
                                                        <?php    
                                                        }
                                                        if($aapohotel[7]=="3.5")
                                                        {
                                                        ?>
                                                           <i class='fa fa-star-o'></i>
                                                        <?php
                                                        }
                                                    }
                                                    ?>
                                                </span>
                                                <div>
                                                    <a href="hotel-details.php?hotelid=<?php echo $aapohotel[1]; ?>" style="font-size:10px;">View in detail</a>
                                                </div>
                                                </div>
                                            </div>
                                           <?php
                                          }
                                           ?>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="admi-menu">
                                <a href="javascript:void(0)" class="mm-arr">Places <i class="fa fa-angle-down"></i></a>

                                <div class="mm-pos">
                                    <div class="admi-mm m-menu">
                                        <div class="m-menu-inn">
                                            <?php
                                            $placelavo=$con->query("select * from place where placeid in(select placeid from packageplace) limit 4");
                                            while($placeapo=mysqli_fetch_array($placelavo))
                                            {
                                            ?>
                                            <div class="mm2-com mm1-com mm1-s1">
                                                <div class="ed-course-in">
                                                    <a class="course-overlay" href="javascript:void(0)">
                                                        <img src="<?php echo $placeapo[4]; ?>" style="width:124px;height:86px;" alt="">
                                                        <span><?php ?></span>
                                                    </a>
                                                </div>
                                                <p><h5 style="color:black;"><?php echo $placeapo[2]; ?></h5></p>
                                                <p><?php echo substr($placeapo[3],0,180); ?></p>
                                                <a href="index.php#aayaavo" class="mm-r-m-btn">View More Places</a>
                                            </div>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li>
                               
                                
                                 <?php
                                if ($_SESSION[page] == "contact") 
                                {
                                ?>
                                <a href="contact-us.php" style="color:#ff0049;">Contact Us</a>
                                <?php
                                }
                                else
                                {
                                ?>
                                <a href="contact-us.php">Contact Us</a>
                                <?php
                                }
                                ?>
                               
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="row">
                        <?php
                        if($_SESSION[type]==1)
                        {
                        ?>
                            <div class="col-md-6 batton">
                                <a href="admin/usersetting.php">My Account</a><br>
                                <a href="mybooking.php">My Booking</a>
                            </div>
                            <div class="col-md-6 batton2">

                                <a href="packagelist.php"><i class="fa fa-pencil"></i>Book Package</a> 

                            </div>
                        <?php    
                        }
                        else
                        {
                        ?>
                            
                        <?php  
                        }
                        ?>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

</section>
