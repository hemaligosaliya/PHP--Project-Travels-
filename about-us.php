<!DOCTYPE html>
<?php require_once 'connection.php';
require_once './insertdata.php';
 $_SESSION[page]="about";
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




        <div class="container-fluid">
            <div class="row aboutbot">
                <div class="col-md-12">

                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h2>About <span>us</span></h2>
                                <div class="title-line">
                                    <div class="tl-1"></div>
                                    <div class="tl-2"><i class="fa fa-gg"></i></div>
                                    <div class="tl-3"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-12 about-top">
                                <h2>Explore your ideal journey by interest</h2>
                            </div>
                        </div>
                    </div>


                    <section class="tourb2-ab-p-2 com-colo-abou">
                        <div class="container">
                            <!-- TITLE & DESCRIPTION -->
                            <div class="col-md-12">
                                <div class="spe-title">
                                    <h3>Top tour packages in this month<span></span></h3>
                                    <div class="title-line">
                                        <div class="tl-11"></div>
                                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                                        <div class="tl-33"></div>

                                    </div>
                                    <p>World's leading tour and travels Booking website,Over 30,000 packages worldwide. Book travel packages and enjoy your holidays with distinctive experience</p>
                                </div>
                            </div>
                            <div class="row tourb2-ab-p1">
                                <div class="col-md-6 col-sm-6">
                                    <div class="tourb2-ab-p1-left">
                                        <h3>Welcome to Holiday Tour & Travels</h3> <span> Better Your destination Experience</span>
                                        <p>Get the best recommendations from locals who love their cities
                                            In each and every destination, you will find information, advice, and experiences from locals. Learn about the latest recommendations on attractions, places to eat, shop and much more. 
                                            usa tours for indians Discover the best sights of America on a group tour with Indians visiting the USA. Enjoy a safe, comfortable and worry-free holiday in the US while traveling with like-minded Indian passengers.</p>
                                        <p>All group tours include sightseeing entrance fees, Indian vegetarian food, Indian tour manager, airport transfers, luxurious hotel accommodation.   <i class="fa fa-plane "></i></p>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="tourb2-ab-p1-right"> <img src="images/iplace-8.jpg" alt="" /> </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="tourb2-ab-p-3 com-colo-abou">
                        <div class="container-fluid">
                            <div class="row tourb2-ab-p3">
                                <?php
                                $pack=$con->query("SELECT count(*) FROM package");
                                $packrow= mysqli_fetch_array($pack);
                                ?>
                                <div class="col-md-3 col-sm-6">
                                    <div class="tourb2-ab-p3-1 tourb2-ab-p3-com"> <span><?php echo $packrow[0]; ?></span>
                                        <h4>Packages</h4>
                                        <p>We might be travellers at heart, but every one of our travel content creatives has years of professional travel.</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                            <?php
                                $pack=$con->query("SELECT count(*) FROM place");
                                $packrow= mysqli_fetch_array($pack);
                            ?>
                                    <div class="tourb2-ab-p3-1 tourb2-ab-p3-com"> <span><?php echo $packrow[0]; ?></span>
                                        <h4>Places</h4>
                                        <p>In India, selecting a destination for sightseeing holidays can be quite difficult as there is plenty to choose from.</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                            <?php
                                $pack=$con->query("SELECT count(*) FROM taxicompany");
                                $packrow= mysqli_fetch_array($pack);
                            ?>
                                    <div class="tourb2-ab-p3-1 tourb2-ab-p3-com"> <span><?php echo $packrow[0]; ?></span>
                                        <h4>Taxi Services</h4>
                                        <p>As we look forward to 2019 and all it has in store, we’d like to acknowledge all that 2018 held for our company.</p>
                                    </div>
                                </div>
                                <div class="col-md-3 col-sm-6">
                            <?php
                                $pack=$con->query("SELECT count(*) FROM hotel");
                                $packrow= mysqli_fetch_array($pack);
                            ?>
                                    <div class="tourb2-ab-p3-1 tourb2-ab-p3-com"> <span><?php echo $packrow[0]; ?></span>
                                        <h4>Hotels</h4>
                                        <p>Begin a chat with SnapTravel and our AI powered bot will scour hundreds of sources to find you the best hotel deals. </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <section class="tourb2-ab-p-4 com-colo-abou">
                        <div class="container-fluid">
                            <div class="row tourb2-ab-p4">
                                <div class="col-md-6 col-sm-6">
                                    <div class="tourb2-ab-p4-1 tourb2-ab-p4-com"> <i class="fa fa-flag-o" aria-hidden="true"></i>
                                        <div class="tourb2-ab-p4-text">
                                            <h4><span>Travel</span> Booking</h4>
                                            <p>We might be travellers at heart, but every one of our travel content creatives has years of professional travel copywriting experience behind them. They’ve successfully created travel content for brands like yours while continuing to wander this awesome world. we provide faster booking facility.</p></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="tourb2-ab-p4-1 tourb2-ab-p4-com"> <i class="fa fa-map-o" aria-hidden="true"></i>
                                        <div class="tourb2-ab-p4-text">
                                            <h4><span>Hotel</span> Booking</h4>
                                            <p>Begin a chat with SnapTravel and our AI powered bot will scour hundreds of sources to find you the best hotel deals. Our bot is backed by a team of human travel agent ninjas available 24/7 over chat. As a bonus, we will call the hotel on check-in day to negotiate a free upgrade on your behalf.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="tourb2-ab-p4-1 tourb2-ab-p4-com"> <i class="fa fa-taxi" aria-hidden="true"></i>
                                        <div class="tourb2-ab-p4-text">
                                            <h4><span>Taxi</span> Booking</h4>
                                            <p>As we look forward to 2019 and all it has in store, we’d like to acknowledge all that 2018 held for our company, our clients, and the industry as a whole. Steve Mackenzie reflects on this past year’s successes and challenges as a springboard for the next 365 days! </p></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="tourb2-ab-p4-1 tourb2-ab-p4-com"> <i class="fa fa-umbrella" aria-hidden="true"></i>
                                        <div class="tourb2-ab-p4-text">
                                            <h4><span>Sight Seeing</span> Booking</h4>
                                            <p>In India, selecting a destination for sightseeing holidays can be quite difficult as there is plenty to choose from. We at Yatra understand this issue, and therefore offer a number of customised packages for different sightseeing.we can provide more than 50 places for sight seen .</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="tourb2-ab-p4-1 tourb2-ab-p4-com"> <i class="fa fa-binoculars" aria-hidden="true"></i>
                                        <div class="tourb2-ab-p4-text">
                                            <h4><span>Tour</span> Discount</h4>
                                            <p>Discover the heart and soul of Indochina on this tour of four very diverse countries. Encounter history, both ancient and modern, and witness the unbelievable splendour of Angkor Wat.</p></div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-6">
                                    <div class="tourb2-ab-p4-1 tourb2-ab-p4-com"> <i class="fa fa-globe" aria-hidden="true"></i>
                                        <div class="tourb2-ab-p4-text">
                                            <h4><span>Top</span> Brandings</h4>
                                            <p>We provide you with engaging content specific to your brand or industry and ideas that grow customers and in turn help you to optimize your business profile and promote your business across the various social media.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>


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