<!DOCTYPE html>
<?php
require_once 'connection.php';
require_once './insertdata.php';

if($_REQUEST[custompackageid]!="")
{
    $_SESSION[custompackageid]=$_REQUEST[custompackageid];
    header('location:custompackage.php');
    $del=$con->query("delete from custompackage where custompackageid=$_SESSION[custompackageid]");
}
if($_REQUEST[placeassignid]!="")
{
    $_SESSION[placeassignid]=$_REQUEST[placeassignid];
    header('location:custompackage.php');
     $del=$con->query("delete from placeassign where placeassignid=$_SESSION[placeassignid]");
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
        <div class="container">
            <div class="row">
                <div class="col-md-12" id="missdata">

                </div>
            </div>
        </div>
        <section>
            <div class="tb-space cus-pack-form">
                <div class="rows container">
                    <?php
                            $lavo=$con->query("select * from custompackage where emailid='$_SESSION[user]'");
                            $row=mysqli_fetch_array($lavo);
                            if($row[0]!="")
                            {
                                ?>
                                    <div class="spe-title cus-title">
                                        <h2>Choose places of Your <span> Package</span></h2>
                                        <div class="title-line">
                                            <div class="tl-1"></div>
                                            <div class="tl-2"><i class="fa fa-gg" style="color:#FF0049;"></i></div>
                                            <div class="tl-3"></div>
                                        </div>
                                    </div>
                                <div style="margin-bottom:30px;">
                                <?php
                                 $lavo=$con->query("select * from custompackage where emailid='$_SESSION[user]'");
                                while($row=mysqli_fetch_array($lavo))
                                {
                                 ?>     
                                    <div class="cus-book-form form_1 custompackdis">
                                                <?php
                                                if ($_SESSION[dup] == 1) {
                                                    $_SESSION[dup]=0;
                                                    ?>
                                                    <div class="row">
                                                        <div class="col-md-12 text-center">
                                                            <font style="padding-left:180px;color:red;text-transform:capitalize;" class="animated infinite flash">First select place and hit the button ! .....</font>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                                <div class="row">
                                                    <div class="col-md-4 hovervala">
                                                        <?php
                                                        if($row[7]=="Honeymoon Package")
                                                        {
                                                        ?>
                                                        <img src="images/honeymoon_romantic.webp"/>
                                                        <?php   
                                                        }
                                                        elseif($row[7]=="Family Package") 
                                                        {
                                                         ?>
                                                        <img src="images/family.webp"/>
                                                        <?php
                                                        }
                                                        elseif($row[7]=="Holiday Package") 
                                                        {
                                                        ?>
                                                        <img src="images/water+activities.webp"/>
                                                        <?php
                                                        }
                                                        elseif($row[7]=="Group Package") 
                                                        {
                                                        ?>
                                                        <img src="images/friends_group.webp"/>
                                                        <?php
                                                        }
                                                        elseif($row[7]=="Regular Package") 
                                                        {
                                                        ?>
                                                        <img src="images/adventure.webp"/>
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <img src="images/solo.webp"/>
                                                        <?php    
                                                        }
                                                        if($row[8]==1 || $row[8]==2)
                                                        {
                                                        ?>
                                                            <font style="margin-left:10px;color:#4E2E70;">Budget</font> -- <i class="fa fa-rupee" style="font-size:10px;"></i> <font style="font-size:10px;letter-spacing:1px;"><?php echo $row[4]; ?></font>
                                                        <?php    
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <?php
                                                        if($row[8]!=3)
                                                        {
                                                        ?>
                                                            <a href="custompackage.php?custompackageid=<?php echo $row[1]; ?>"> <i class="fa fa-close fafado" style="float:right; color:#4E2E70;" title="delete"></i></a>
                                                        <?php    
                                                        }
                                                        ?>
                                                        <div class="row" style="margin-top:20px;">
                                                            <div class="col-md-6 text-center">
                                                                <font style="color:#4E2E70;font-size:15px;">Departure Date</font>
                                                                <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                <div class="text-center"><i class="fa fa-clock-o" style="margin-right:10px;"></i><?php echo date("d-m-Y", strtotime($row[3])); ?></div>
                                                            </div>
                                                            <div class="col-md-6 text-center">
                                                                <font style="color:#4E2E70;font-size:15px;">Arrival Date</font>
                                                                <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                <div class="text-center"><i class="fa fa-clock-o" style="margin-right:10px;"></i><?php echo date("d-m-Y", strtotime($row[2])); ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="padding-bottom:10px;margin-top:10px;">
                                                            <div class="col-md-12 text-center">
                                                                <font style="color:#4E2E70;font-size:15px;">Package Category</font>
                                                                 <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                <div class="text-center"><i class="fa fa-suitcase" style="margin-right:10px;"></i><?php echo $row[7]; ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="row" >
                                                                    <div class="col-md-6 text-center">
                                                                        <font style="color:#4E2E70;font-size:15px;">Number of adults</font>
                                                                        <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                        <div class="text-center"><i class="fa fa-user" style="margin-right:10px;"></i><?php echo $row[5]; ?></div>
                                                                    </div>
                                                                    <div class="col-md-6 text-center">
                                                                        <font style="color:#4E2E70;font-size:15px;">Number of children</font>
                                                                        <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                        <div class="text-center"><i class="fa fa-child" style="margin-right:10px;"></i><?php echo $row[6]; ?></div>
                                                                    </div>
                                                        </div>
                                                        <div class="row">
                                                            <?php
                                                             if($row[8]==0)
                                                             {
                                                            ?>
                                                                <div class="col-md-12" style="margin-top:20px;">
                                                                    <button style="width:100%;background:#4E2E70!important;color:white;font-weight:1000;" name="placeassignsession" class="text-center btn"  data-toggle="modal" data-target="#custompackage" onclick="custompackageleva('custompackage',<?php echo $row[1]; ?>);">Let's Go for selection</button>
                                                                </div>
                                                            <?php
                                                             }
                                                             elseif ($row[8]==1) 
                                                             {
                                                                    $data1=$con->query("SELECT datediff(activationdate,curdate()) FROM custompackage where custompackageid=$row[1]");
                                                                    $row1=  mysqli_fetch_array($data1);
                                                                    if($row1[0]==0)
                                                                    {
                                                                     ?>
                                                                            <script>alert('Your Package Request is cancle please try again Later!.....');</script>
                                                                     <?php
                                                                           $del=$con->query("delete from custompackage where custompackageid=$row[1]");
                                                                           $profile=$con->query("select * from siteprofile where category=2");
                                                                            $profilerow=  mysqli_fetch_array($profile);
                                                                            sendmail("$_SESSION[user]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                                                                            <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                                                                            <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                                                                            <br/>
                                                                            <div style='color:#FF0049;'>YOUR PACKAGE REQUEST IS CANCLE FOR SOME REASON PLEASE TRY AGAIN !........</div>
                                                                            <hr/>
                                                                            <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                                                                            <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                                                                            </p>
                                                                            <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");
                                                                            header('location:custompackage.php');
                                                                    }
                                                                    ?>
                                                                <div class="col-md-12" style="margin-top:20px;">
                                                                    <button style="width:100%;background:#4E2E70!important;color:white;font-weight:1000;"  class="text-center btn" title="pendding">Conformation with in   <?php echo $row1[0]." Days"; ?></button>
                                                                </div>
                                                             <?php
                                                             }
                                                             elseif ($row[8]==2) 
                                                             {
                                                             ?>
                                                                <div class="col-md-12" style="margin-top:20px;">
                                                                    <div class="text-center btn" style="margin-bottom:20px;width:100%;background:#4E2E70!important;color:white;font-weight:1000;" title="click me" data-toggle="modal" data-target="#custompackage" onclick="custompackageleva('custompackagedetail',<?php echo $row[1]; ?>);">view Package Details</div>
                                                                    <button style="width:100%;background:#4E2E70!important;color:white;font-weight:1000;"  class="text-center btn" title="click me" data-toggle="modal" data-target="#custompackage" onclick="custompackageleva('custompackagebill',<?php echo $row[1]; ?>);">Book Now</button>
                                                                </div>
                                                             <?php
                                                             }
                                                             elseif($row[8]==3)
                                                             {
                                                             ?>
                                                                  <div class="col-md-12" style="margin-top:20px;">
                                                                    <div class="text-center btn" style="margin-bottom:20px;width:100%;background:#4E2E70!important;color:white;font-weight:1000;" title="click me" data-toggle="modal" data-target="#custompackage" onclick="custompackageleva('custompackagedetail',<?php echo $row[1]; ?>);">view Package Details</div>
                                                                    <a class="text-center btn" style="margin-bottom:20px;width:100%;background:#4E2E70!important;color:white;font-weight:1000;" href="mybooking.php">View the Bill</a>
                                                                </div>
                                                             <?php
                                                             }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                 <?php
                                }
                                ?>
                                </div>
                                <?php
                            }
                    ?>
                    <div class="spe-title cus-title">
                        <h2>Create your <span>Custom Package</span> Now !</h2>
                        <div class="title-line">
                            <div class="tl-1"></div>
                            <div class="tl-2"><i class="fa fa-gg" style="color:#FF0049;"></i></div>
                            <div class="tl-3"></div>
                        </div>
                        <div id="showcustom"></div>
                        <p>India's leading tour and travels Booking website . Book travel packages and enjoy your holidays with distinctive experience</p>
                    </div>
                    <div class="cus-book-form form_1">
                        <form class="formcustompackage" method="post" action="" name="custompackage" onsubmit="return(checkdate());">
                            <?php
                            if($_SESSION[dup]==1)
                            {
                            ?>
                                <div class="row" style="padding-bottom:40px;">
                                    <div class="col-md-12">
                                        <h2 class="text-center animated fadeInDown">Please First Login ! ......</h2>
                                    </div>
                                </div>
                            <?php
                            $_SESSION[dup]=0;
                            }
                            elseif($_SESSION[dupp]==1)
                            {
                            ?>
                                <div class="row" style="padding-bottom:40px;">
                                    <div class="col-md-12">
                                        <h4 class="text-center animated fadeInDown">Please login with Your Personal Account! ......</h4>
                                    </div>
                                </div>
                            <?php
                            $_SESSION[dup]=0;
                            }
                            ?>
                            <div class="row">
                                <div class="col-md-6">
                                    <p style="position: absolute;top:-15px;">Departure Date</p>
                                    <div class="input-field col s12 padd-left">
                                        <i class="fa fa-calendar animated fadeInDown global2"style="top:14px;"></i>
                                        <input type="date" name="departuredate" min="<?php echo Date('Y-m-d', strtotime("+7 days")); ?>" required="" max="<?php echo Date('Y-m-d', strtotime("+1 year")); ?>" onchange="dedate(this.value);"/>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <p style="position: absolute;top:-15px;">Arrival Date </p>
                                    <div class="input-field col s12 padd-left">
                                        <i class="fa fa-calendar global2 animated fadeInDown" style="top:14px;"></i>
                                        <input type="date" name="arrivaldate" min="<?php echo Date('Y-m-d', strtotime("+7 days")); ?>" max="<?php echo Date('Y-m-d', strtotime("+1 year")); ?>" required="" id="dateaapo" />
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-field col s12"style="margin-left:10px;">
                                        <i class="fa fa-user global2 animated fadeInDown" style="top:18px;margin-left:-10px;"></i>
                                        <input type="text" class="validate" required="" maxlength="2" pattern="[0-9]*" name="noofadults">
                                        <label>number of adults</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-field col s12"style="margin-left:10px;">
                                        <i class="fa fa-child global2 animated fadeInDown" style="top:18px;margin-left:-10px;"></i>
                                        <input type="text" class="validate" required="" maxlength="2" pattern="[0-9]*" name="noofchildrens">
                                        <label>number of children's</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-field col s12"style="margin-left:10px;">
                                        <i class="fa fa-rupee global2 animated fadeInDown" style="top:18px;margin-left:-10px;"></i>
                                        <input type="text" class="validate" required="" maxlength="7" pattern="[0-9]*" name="budget">
                                        <label>Enter Your Budget</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-field col s12"style="margin-left:10px;">
                                        <i class="fa fa-sun-o global2 animated fadeInDown" style="top:18px;margin-left:-10px;"></i>
                                        <div class="input-field col s12">
                                            <select name="packagecategory" required="">
                                                <option value="" disabled selected>Select your package</option>
                                                <option value="Honeymoon Package">Honeymoon Package</option>
                                                <option value="Family Package">Family Package</option>
                                                <option value="Holiday Package">Holiday Package</option>
                                                <option value="Group Package">Group Package</option>
                                                <option value="Regular Package">Regular Package</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row" style="margin-top:20px;">
                                <div class="col-md-12">
                                    <button style="width:100%;background:#FF0049; color:white;" name="sendcustompackage" class="text-center btn">Create Now</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>
        </section>
       
        <!-- Manage Parent Model custom package -->
        <div class="modal fade" id="custompackage">
                <div class="modal-dialog modal-lg" id="custompackage1">

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