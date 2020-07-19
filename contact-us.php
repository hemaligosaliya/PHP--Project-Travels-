<!DOCTYPE html>
<?php require_once 'connection.php';
require_once './insertdata.php';
 $_SESSION[page]="contact";
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

                <div class="row">
                    <div class="col-md-12">
                        <div class="spe-title">
                            <h2>Contact <span>us</span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                     <div class="col-md-12">
                            <div class="col-md-7">
                                <video src="video/contactvideo1.mp4" height="336px" width="596px" autoplay="" loop=""></video>
                            </div>
                            <div class="col-md-5 contactp">
                                <p>It would be great to hear from you! If you got any questions, please do not hesitate to send us a message. We are looking forward to hearing from you! We reply within 24 hours!</p>
                                <br>
                                <p>Email us with any questions or inquiries or call 1800-3002-8411. We would be happy to answer your questions and set up a meeting with you. Thejourney can help set you apart from the flock.</p>
                                <br>
                                <p>Many business' contact pages are rather cold -- but the more friendly you make your page's copy, the better you'll make your visitors feel. After all, you should want them to contact you so you can help them and start building a relationship.</p>
                            </div>
                        </div>
                    <div class="col-md-12 padd-top">
                        <div class="spe-title">
                            <h3>Find at here <span></span></h3>
                            <div class="title-line">
                                <div class="tl-11"></div>
                                <div class="tl-22"><i class="fa fa-gg"></i></div>
                                <div class="tl-33"></div>

                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3721.1268088914967!2d72.7635391499589!3d21.147351185865247!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be04d52cba79f9b%3A0xbd17a53472bfb9d0!2sPrime+Shoppers!5e0!3m2!1sen!2sin!4v1549265095497" width="1152" height="470" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 map">
                        <div class="spe-title">
                            <h3>Get in touch <span></span></h3>
                            <div class="title-line">
                                <div class="tl-11"></div>
                                <div class="tl-22"><i class="fa fa-gg"></i></div>
                                <div class="tl-33"></div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <?php
                    $row=$con->query("select * from siteprofile where category=2");
                    $data=  mysqli_fetch_array($row);
                    ?>
                    <div class="col-md-12">
                        <section class="tourb2-ab-p-41 com-colo-abou">
                            <div class="container-fluid">
                                <div class="row tourb2-ab-p4">
                                    <div class="col-md-6 col-sm-6">
                                        <div class="tourb2-ab-p4-1 tourb2-ab-p4-com boxyo"> <i class="fa fa-map-marker" aria-hidden="true"></i>
                                            <div class="tourb2-ab-p4-text">
                                                <h4><span>Address</span></h4>
                                                <p><?php echo $data[4]; ?></p></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="tourb2-ab-p4-1 tourb2-ab-p4-com boxyo"> <i class="fa fa-envelope " aria-hidden="true"></i>
                                            <div class="tourb2-ab-p4-text">
                                                <h4><span>Email</span></h4>
                                                <p><a class="ecolor" href="mailto:<?php echo $data[3]; ?>"><?php echo $data[3]; ?></a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="tourb2-ab-p4-1 tourb2-ab-p4-com boxyo"> <i class="fa fa-phone" aria-hidden="true"></i>
                                            <div class="tourb2-ab-p4-text">
                                                <h4><span>Tollfree</span></h4>
                                                <p class="letterspace"><?php echo $data[1]; ?></p></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="tourb2-ab-p4-1 tourb2-ab-p4-com boxyo"> <i class="fa fa-fax" aria-hidden="true"></i>
                                            <div class="tourb2-ab-p4-text">
                                                <h4><span>FAX</span></h4>
                                                <p class="letterspace"><?php echo $data[2]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="tourb2-ab-p4-1 tourb2-ab-p4-com boxyo"> <i class="fa fa-home" aria-hidden="true"></i>
                                            <div class="tourb2-ab-p4-text">
                                                <h4><span>our branch</span></h4>
                                                <p><?php echo $data[5]; ?></p>
                                                <p><a href="<?php echo $data[6]; ?>" target="_blank"> Get a Location</a></p></div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6">
                                        <div class="tourb2-ab-p4-1 tourb2-ab-p4-com boxyo"> <i class="fa fa-globe" aria-hidden="true"></i>
                                            <div class="tourb2-ab-p4-text">
                                                <h4><span>Website</span></h4>
                                                <p><?php echo $data[7]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
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