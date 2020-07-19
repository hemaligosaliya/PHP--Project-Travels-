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


        <div class="container">
            <div class="row topbot">
                <div class="col-md-12">
                <div class="spe-title">
                    <h2>Valuable <span>Review</span></h2>
                    <div class="title-line">
                        <div class="tl-1"></div>
                        <div class="tl-2"><i class="fa fa-gg"></i></div>
                        <div class="tl-3"></div>
                    </div>
                </div>
            </div>
        </div>
            <div class="row abcd">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3 abc">
                            <div class="reviewimage">
                            <img src="images/review12.svg"/>
                             <font>Jay Parmar </font>
                            </div>
                        </div>
                        <div class="col-md-9 reviewuser">
                           
                            <p><i class="fa fa-calendar-o"></i> 05 February, 2019</p>
                            <img src="images/review5.jpg" />
                            <img src="images/related2.png"/>
                            <img src="images/review4.jpeg"/>
                            <p class="reviewuser1">This is our Best trip.I never forget those days.This is our Best trip.I never forget those days.
                            This is our Best trip.I never forget those days.This is our Best trip.I never forget those days.This is our Best trip.I never forget those days.
                            This is our Best trip.I never forget those days. This is our Best trip.I never forget those days.
                            This is our Best trip.I never forget those days.</p>
                        </div>
                    </div>
                </div>
            </div>
            
             <div class="row abcd">
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-3 abc">
                            <div class="reviewimage">
                            <img src="images/review12.svg"/>
                             <font>Jay Parmar </font>
                            </div>
                        </div>
                        <div class="col-md-9 reviewuser">
                           
                            <p><i class="fa fa-calendar-o"></i> 05 February, 2019</p>
                            <img src="images/review5.jpg" />
                            <img src="images/related2.png"/>
                            <img src="images/review4.jpeg"/>
                            <p class="reviewuser1">This is our Best trip.I never forget those days.This is our Best trip.I never forget those days.
                            This is our Best trip.I never forget those days.This is our Best trip.I never forget those days.This is our Best trip.I never forget those days.
                            This is our Best trip.I never forget those days. This is our Best trip.I never forget those days.
                            This is our Best trip.I never forget those days.</p>
                        </div>
                    </div>
                </div>
            </div>
            
             
            
            
            <div class="row topbot">

                <div class="col-md-6 imagereview">
                    <center><h2>Share Your Feedback With Us</h2></center>
                    <img src="images/question.png"/>
                </div>
                <div class="col-md-6 imagereview1" >

                    <form  action="" method="post" name="review">

                        <div class="form-group form-group-sm formyo">
                            <input type="text" class="form-control " required="" pattern="^[A-Za-z]*$" placeholder="Enter Your Name">
                        </div>
                        <div class="form-group form-group-sm formyo">
                            <input type="Email" class="form-control " required="" placeholder="Enter Your Email">
                        </div>
                        <div class="form-group form-group-sm formyo">
                            <input type="text" class="form-control " required="" pattern="^[0-9]{10}$" placeholder="Enter Your Contact no">
                        </div>
                        <div class="form-group form-group-sm formyo">
                            <textarea class="form-control" rows="5" required="" placeholder="Give Your Valuable Review"></textarea>
                        </div>
                        <div class="form-group form-group-sm"> 
                            <button type="submit" class="btn" name="sendreview">Submit</button> &nbsp;&nbsp;
                            <button type="reset" class="btn ">Reset</button>
                        </div>  
                    </form>

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