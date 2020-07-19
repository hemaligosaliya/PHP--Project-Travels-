<!DOCTYPE html>
<?php
require_once 'connection.php';
require_once './insertdata.php';
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

        <section class="toplogin">
            <img src="images/ballon.png" class="ballonanimation"/>
            <img src="images/ballon.png" class="ballonanimation1"/>
            <img src="images/cruse1.png" class="cruseanimation1" />
            <div class="container-fluid login-wrapper">
                <div class="row main">
                    <div class="col-md-3 col-md-offset-3 animated fadeInDownBig mainclass1" style="<?php
                    if ($_SESSION[requestpass] == "") {
                        echo'height:280px';
                    }
                    ?>">


                        <div class="col-md-12">
                            <div class="spe-title1">
                                <font>create <span>New</span> Password</font>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                        <?php
                        if($_SESSION[verificationcode]!="")
                        {
                        ?>
                        <form action="" method="post" autocomplete="off" name="requestpasswordform" style="margin-left:20px;" onsubmit="return(checkrequest());">
                            <div class="form-group">

                                    <div class="row ">
                                        <div class="col-md-2">

                                        </div>

                                        <div class="col-md-10 formcontrol">
                                            <?php
                                            $lavo = $con->query("select * from register where emailid like '$_SESSION[emailsachvo]'");
                                            $aapo = mysqli_fetch_array($lavo);
                                            ?>
                                            <img class="img-responsive" src="<?php echo $aapo[10]; ?>" style="height:100px;width:100px;border-radius:50%;margin-left:30px;"/>
                                            <h5 style="margin-left:20px;margin-top:10px;"><?php echo $aapo[3] . " " . $aapo[4]; ?></h5>
                                        </div>
                                    </div>
                                <div id="erroraapo" class="animated infinite flash text-center" style="color: #363c42;">
                                </div>
                                    <div class="row">
                                        <div class="col-md-2">

                                        </div>
                                        <div class="col-md-10 formcontrol">
                                            <i class="fa fa-unlock-alt"> </i>
                                            <input type="password" required="" name="password" pattern="^[a-z0-9A-Z]{8,18}$" maxlength="10" class="form-control password"  placeholder="Enter New Password"/>
                                            <font class="fa fa-eye-slash" id="eye"></font>
                                        </div>
                                    </div>
                                     <div class="row">
                                        <div class="col-md-2">

                                        </div>
                                        <div class="col-md-10 formcontrol">
                                            <i class="fa fa-unlock-alt"> </i>
                                            <input type="password" required="" name="repassword" class="form-control repassword"  placeholder="Confirm New Password"/>
                                            <font class="fa fa-eye-slash" id="eye1"></font>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-8 formbutton col-md-offset-1">
                                            <button type="submit" name="changepassword" class="btn">Change my Password</button>
                                        </div>
                                    </div>
                                
                                </div>
                            </form>
                            
                            <div class="col-md-12 " style="margin-left:64px;">
                                <form action="" method="post">
                                <button name="sessionkhalikaro" style="background: transparent;border: none;color:#2A3C54;">Reset</button>
                                </form>
                            </div>
                        <?php
                        if(isset($_REQUEST[sessionkhalikaro]))
                        {
                            session_destroy();
                            header('location:requestpassword.php');
                        }
                        ?>
                        
                        <?php    
                        }
                        elseif ($_SESSION[requestpass] == "") {
                            ?>
                            <form action="" method="post" autocomplete="off" name="requestpassword" style="margin-top:100px;margin-left:20px;">
                                <?php
                                if ($_SESSION[emailverify] == 1) {
                                    echo '<font id="khalikarologinne" class="animated flash infinite" style="padding-left:90px; color:red; font-size:10px;">Invalid Emailid</font>';
                                    $_SESSION[emailverify] = 0;
                                }
                                ?>
                                <div class="form-group">
                                    <div class="row formpadding">
                                        <div class="col-md-2">

                                        </div>

                                        <div class="col-md-10 formcontrol">
                                            <i class="fa fa-envelope"> </i>
                                            <input type="email" required="" name="emailid" class="form-control" onchange="requestpass()"  placeholder="Enter Your Email"/>
                                        </div>
                                    </div>
                                    <div class="row formpadding">

                                        <div class="col-md-4 formbutton col-md-offset-1">
                                            <button type="submit" name="verificationcodeemail" class="btn">Send</button>
                                        </div>
                                        <div class="col-md-4 formbutton">
                                            <button type="reset" class="btn">clear</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <?php
                        } elseif ($_SESSION[requestpass] != "") {
                            ?>
                            <form action="" method="post" autocomplete="off" name="requestpassword" style="margin-left:20px;">
                                <div class="form-group">

                                    <div class="row formpadding">
                                        <div class="col-md-2">

                                        </div>

                                        <div class="col-md-10 formcontrol">
                                            <?php
                                            $lavo = $con->query("select * from register where emailid like '$_SESSION[emailsachvo]'");
                                            $aapo = mysqli_fetch_array($lavo);
                                            ?>
                                            <img class="img-responsive" src="<?php echo $aapo[10]; ?>" style="height:100px;width:100px;border-radius:50%;margin-left:30px;"/>
                                            <h5 style="margin-left:20px;margin-top:10px;"><?php echo $aapo[3] . " " . $aapo[4]; ?></h5>
                                        </div>
                                    </div>
                                    <span style="margin-left:65px;" class="animated flash infinite">check Your Mail !..</span>
                                    <div class="row formpadding">
                                        <div class="col-md-2">

                                        </div>

                                        <div class="col-md-10 formcontrol">
                                            <i class="fa fa-envelope"> </i>
                                            <input type="text" required="" name="verificationcode" class="form-control" title="You can enter verificationcode only one time" placeholder="Enter verification code"/>
                                        </div>
                                    </div>
                                    <div class="row formpadding">

                                        <div class="col-md-4 formbutton col-md-offset-1">
                                            <button type="submit" name="getverificationcode" class="btn">Send</button>
                                        </div>
                                        <div class="col-md-4 formbutton">
                                            <button type="reset" class="btn">clear</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-12 " style="margin-left:64px;">
                                <form action="" method="post">
                                <button name="sessionkhalikaro" style="background: transparent;border: none;color:#2A3C54;">Reset</button>
                                </form>
                            </div>
                        <?php
                        if(isset($_REQUEST[sessionkhalikaro]))
                        {
                            session_destroy();
                            header('location:requestpassword.php');
                        }
                        ?>
                             <script>
                                 var tmp=0;
                                 alert('Verification Code Sent to : <?php echo $_SESSION[emailsachvo]; ?> ');
                             </script>
                            <?php
                        }
                        ?>
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