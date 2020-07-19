<!DOCTYPE html>
<?php require_once 'connection.php'; 
      require_once './insertdata.php';
      
      if($_SESSION[user]!="")
      {
            if($_SESSION[type]==2)
            {
                $_SESSION[shu]='assignroomtype';
                header('location:./admin/hotelmaster.php');
            }
            elseif($_SESSION[type]==3)
            {
                $_SESSION[shu]='assignvehiclename';
                header('location:./admin/taxicompanymaster.php');
            }
            else if($_SESSION[type]==1)
            {
                header('location:index.php');
            }
            else 
            {
                header('location:index.php');
            }
      }
?>
<html lang="en">
    <?php
    require_once 'head.php';
    ?>

    <body onload="captchaleva('captcha');">
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
            <img src="images/cruse1.png" class="cruseanimation" />
            <div class="container-fluid login-wrapper1">
                <div class="row main">
                    <div class="col-md-6 col-md-offset-2 mainclass">


                        <div class="col-md-12">
                            <div class="spe-title1">
                                <font>Register <span>With Your</span> Journey</font>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                        <form action="" method="post" autocomplete="off" name="registration" onsubmit="return(passcheck())" enctype="multipart/form-data">
                            <div class="form-group">

                                <div class="row formpadding">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-4 formcontrol">
                                        <i class="fa fa-user"> </i>
                                        <input type="text" required="" class="form-control" name="fname" pattern="^[a-zA-Z]*$" placeholder="First name"/>

                                    </div>
                                    <div class="col-md-4 formcontrol">
                                        <i class="fa fa-user"> </i>
                                        <input type="text" required="" class="form-control" name="lname" pattern="^[a-zA-Z]*$"  placeholder="Last name"/>
                                    </div>
                                </div>

                                <div class="row formpadding">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-10"> 
                                        <div class="input-field col s3">
                                            <i class="fa fa-globe global"></i>
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
                                        <div class="input-field col s3 padd-left">
                                            <i class="fa fa-paper-plane-o global1"></i>
                                            <select name="stateid" required="" class="editprofile" id="statecombo" onchange="selectlevareg('city',this.value)">
                                                <option value="" disabled selected>Select State</option>
                                                
                                            </select>
                                        </div>
                                        <div class="input-field col s3 padd-left1">
                                            <i class="fa fa-map-marker global2"></i>
                                            <select name="cityid" required="" id="citycombo" class="editprofile">
                                                <option value="" disabled selected>Select city</option>
                                                
                                            </select>
                                        </div>
                                    </div>   
                                </div>

                                <div class="row formpadding">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-4 formcontrol">

                                        <i class="fa fa-phone"> </i>
                                        <input type="text" required="" class="form-control" name="contact" pattern="^[0-9]{10}$" maxlength="10"  placeholder="Enter contact number"/>

                                    </div>
                                    <div class="col-md-4  radio-inline">

                                        <div class="col-md-6">
                                            <input type="radio" value="male" name="gender" checked=""/><font>Male</font>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="radio" value="female" name="gender"/><font>Female</font>
                                        </div>

                                    </div>
                                </div>

                                <div class="row formpadding">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-4 formcontrol">
                                        <i class="fa fa-envelope"> </i>
                                        <input type="email" required="" class="form-control" placeholder="Enter your email" name="emailid"/>
                                        <?php
                                        if($dup==1)
                                        {
                                        ?>
                                         <font style="position: absolute;color: red;left: 27px;top: 39px;font-size: 11px;"class="animated flash infinite" id="khalikaroreg">Already Exist</font>
                                        <?php
                                        }
                                        ?>
                                       
                                    </div>
                                    <div class="col-md-4 formcontrolfile">
                                        <i class="fa fa-camera"> </i>
                                        <input type="file" required="" class="form-control" name="photo"/>
                                        <?php
                                        if ($er == 1) 
                                        {
                                            echo '<p><font style="color: red;position: absolute;font-size: 10px;left: 24px;" class="animated flash infinite">Invalid file formate</font></p>';
                                        } 
                                        elseif($err == 1) 
                                        {
                                            echo '<p><font style="color: red;position: absolute;font-size: 10px;left: 24px;" class="animated flash infinite">Size too large</font></p>';
                                        }
                                        ?>
                                    </div>
                                </div>



                                <div class="row formpadding">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-4 formcontrol">
                                        <i class="fa fa-lock"> </i>
                                        <input type="password" required="" class="form-control password" name="password" pattern="^[a-z0-9A-Z]{8,18}$" maxlength="10" placeholder="*************"/>
                                        <font class="fa fa-eye-slash" id="eye"></font>
                                    </div>
                                    <div class="col-md-4 formcontrol">
                                        <i class="fa fa-lock"> </i>
                                        <input type="password" required="" class="form-control repassword" name="repassword" maxlength="10" placeholder="Retype ******"/>
                                        <font class="fa fa-eye-slash" id="eye1"></font>
                                        <b id="donot" style="color: red;position: absolute;font-size: 10px;left: 24px;" class="animated flash infinite"></b>
                                    </div>
                                </div>

                                <div class="row formpadding">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-10">

                                        <div class="checkbox checkbox-info checkbox-circle">
                                            <input id="tc" class="styled checkboxpadding" type="checkbox" required="">
                                            <label for="tc" class="checkboxpadding"><font> I accept your <a href="terms-conditions.php">Terms & Condition</a></font>   </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row formpadding">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-4 formcontrol" >
                                        <p class="captcha" id="captcha" oncopy="return false"> </p>
                                        <font onclick="captchaleva('captcha');" class="fa fa-refresh"></font>
                                    </div>
                                    <div class="col-md-4 formcontrol">
                                           
                                        <input type="text" required="" onpaste="return false" class="form-control" name="captcha"  placeholder="Enter Captcha"/>
                                         <b id="captchanot" style="color: red;position: absolute;font-size: 10px;left: 24px;" class="animated flash infinite" ></b>
                                    </div>
                                </div>
                                <div class="row formbuttonpadding">

                                    <div class="col-md-3 formbutton col-md-offset-2">
                                        <button type="submit" name="sendregister" class="btn">Registration</button>
                                    </div>
                                    <div class="col-md-3 formbutton">
                                        <button type="reset" name="" onclick="document.getElementById('donot').innerHTML = ''; document.getElementById('khalikaroreg').innerHTML = ''; document.getElementById('captchanot').innerHTML='';" class="btn">clear</button>
                                    </div> 

                                </div>
                            </div>
                        </form>
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