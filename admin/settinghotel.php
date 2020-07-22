<?php
require_once '../connection.php';
require_once '../insertdata.php';
$_SESSION[page] = "";
if ($_SESSION[user] == "") {
    header("location:../index.php");
} else if ($_SESSION[type] != 2) {
    header("location:../index.php");
}
?>
<html lang="en">


<?php
require_once 'adminhead.php';
?>
    <body>
                <?php
        require_once 'adminheader.php';
        $data= $con->query("select * from hotel where hotelid=$_SESSION[hotelid]");
        $row=mysqli_fetch_array($data);
        $_SESSION[checkpotaniid]=$row[0];
        $_SESSION[upid]=$_SESSION[hotelid];
        $_SESSION[checkpotaniid1]=$row[2];
                ?>
        <div class="container-fluid">
            <div class="row topbot">
                <div class="col-md-3 profileleft animated fadeInLeft" style="background:url('<?php echo "../".$row[10] ?>');background-repeat: no-repeat;height:620px;background-size:cover;transition:1s ease-out;position: relative;" id='side-left'>
                    
                    <div class="animated fadeInLeft formheightset" style="padding:10px; background:white;box-shadow: 0px 2px 20px -3px rgba(68,68,68,0.6); " >
                        <div class="row">
                            <div class="col-md-12">
                                <div class="spe-title">
                                    <h3>Update Profile<span></span></h3>
                                    <div class="title-line">
                                        <div class="tl-11"></div>
                                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                                        <div class="tl-33"></div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <form action="" method="post" name="uphotel" enctype="multipart/form-data">
                               
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-group-sm">
                                                <?php
                                                if ($_SESSION[dup] == 1) {
                                                    echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
                                                    $_SESSION[dup] = 0;
                                                }
                                                ?>
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" autofocus="" name="upname" value="<?php echo $row[2]; ?>" required="" pattern="^[a-z ]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="active">update Hotel Name</label>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="text" name="upmobile" value="<?php echo $row[4]; ?>" required="" maxlength="10" pattern="^[0-9]{10}$" class="validate lowertransfer">
                                                <label for="list-title" class="active">Update Hotel Mobile Number</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="text" name="upgstno" value="<?php echo $row[11]; ?>" required="" maxlength="15" pattern="^[A-Z0-9]{15}$" class="validate">
                                            <label for="list-title" class="active">Update Hotel GSTNO</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="upaddress" required="" class="materialize-textarea"><?php echo $row[3]; ?></textarea>
                                        <label for="textarea1" class="active">Update Hotel address</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="text" value="<?php echo $row[5]; ?>" name="upmap" required="" class="validate">
                                                <label for="list-title" class="active">update Hotel Map</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="upabout" required="" class="materialize-textarea"><?php echo $row[6]; ?></textarea>
                                        <label for="textarea1" class="active">Update About Hotel</label>
                                        </div>
                                    </div>
                                </div>                               
                                <div class="row">
                                    
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-3">
                                        <p class="labelrating">Update Your Hotel rating</p>
                                        <fieldset class="rating">
                                            <input type="radio" id="star5" name="upstar" value="5" class="ratingradio1" <?php  if($row[7]=='5'){ echo checked;} ?>/><span class = "full" for="star5" title="Awesome - 5 stars"></span>
                                            <input type="radio" id="star4half" name="upstar" value="4.5" class="ratingradio2" <?php  if($row[7]=='4.5'){ echo checked;} ?> /><span class="half" for="star4half" title="Pretty good - 4.5 stars"></span>
                                            <input type="radio" id="star4" name="upstar" value="4" class="ratingradio3"  <?php  if($row[7]=='4'){ echo checked;} ?> /><span class = "full" for="star4" title="Pretty good - 4 stars"></span>
                                            <input type="radio" id="star3half" name="upstar" value="3.5"  class="ratingradio4" <?php  if($row[7]=='3.5'){ echo checked;} ?> /><span class="half" for="star3half" title="Meh - 3.5 stars"></span>
                                            <input type="radio" id="star3" name="upstar" value="3" class="ratingradio5" <?php  if($row[7]=='3'){ echo checked;} ?> /><span class = "full" for="star3" title="Meh - 3 stars"></span>
                                            <input type="radio" id="star2half" name="upstar" value="2.5" class="ratingradio6" <?php  if($row[7]=='2.5'){ echo checked;} ?> /><span class="half" for="star2half" title="Kinda bad - 2.5 stars"></span>
                                            <input type="radio" id="star2" name="upstar" value="2" class="ratingradio7" <?php  if($row[7]=='2'){ echo checked;} ?> /><span class = "full" for="star2" title="Kinda bad - 2 stars"></span>
                                            <input type="radio" id="star1half" name="upstar" value="1.5" class="ratingradio8" <?php  if($row[7]=='1.5'){ echo checked;} ?> /><span class="half" for="star1half" title="Meh - 1.5 stars"></span>
                                            <input type="radio" id="star1" name="upstar" value="1" class="ratingradio9" <?php  if($row[7]=='1'){ echo checked;} ?> /><span class = "full" for="star1" title="Sucks big time - 1 star"></span>
                                            <input type="radio" id="starhalf" name="upstar" value="0.5" class="ratingradio10" <?php  if($row[7]=='0.5'){ echo checked;} ?> /><span class="half" for="starhalf" title="Sucks big time - 0.5 stars"></span>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-3">
                                        <p class="labelrating">Update Hotel Type</p>
                                        <div class="input-field col s10">
                                            <select name="uptype" required="" style="display: block!important;">
                                                <option value="" disabled selected>Update hotel type</option>
                                                <option value="veg" <?php  if($row[8]=='veg'){ echo selected;} ?> >veg</option>
                                               <option value="non-veg" <?php  if($row[8]=='non-veg'){ echo selected;} ?>  >non-veg</option>
                                               <option value="both" <?php  if($row[8]=='both'){ echo selected;} ?> >both</option>
                                            </select>  
                                        </div>   
                                    </div>
                                    <div class="col-md-3">
                                         <p class="labelrating">Update checkouttime</p>
                                        <div class="input-field col s10">
                                            <input id="post-auth" type="time" required="" value="<?php echo $row[12]; ?>" name="upcheckouttime" class="validate">
                                            <label for="post-auth" class=""></label>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                         <p class="labelrating">Update checkintime</p>
                                        <div class="input-field col s10">
                                            <input id="post-auth" type="time" required="" value="<?php echo $row[13]; ?>" name="upcheckintime" class="validate">
                                            <label for="post-auth" class=""></label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <?php
                                        if ($_SESSION[er] == 1)  
                                        {
                                            echo '<p><font style="color: red; font-size:10px;" class="animated flash infinite">Invalid file formate</font></p>';
                                            $_SESSION[er]=0;
                                        } 
                                        elseif($_SESSION[err] == 1) 
                                        {
                                            echo '<p><font style="color: red; font-size:10px;" class="animated flash infinite">Size too large</font></p>';
                                             $_SESSION[err]=0;
                                        }
                                        ?>
                                        <div class="input-field col s10">
                                        <div class="file-field">
                                            <div class="btn">
                                                <span>File</span>
                                                <input type="file" name="uplogo">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" placeholder="Update logo">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php
                                        if ($_SESSION[er] == 1)  
                                        {
                                            echo '<p><font style="color: red; font-size:10px;" class="animated flash infinite">Invalid file formate</font></p>';
                                            $_SESSION[er]=0;
                                        } 
                                        elseif($_SESSION[err] == 1) 
                                        {
                                            echo '<p><font style="color: red; font-size:10px;" class="animated flash infinite">Size too large</font></p>';
                                             $_SESSION[err]=0;
                                        }
                                        ?>
                                        <div class="input-field col s10">
                                        <div class="file-field">
                                            <div class="btn">
                                                <span>File</span>
                                                <input type="file" name="upbannerphoto">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" placeholder="update banner photo">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="email" name="upemailid" value="<?php echo $row[15]; ?>" required="" class="validate lowertransfer">
                                            <label for="list-title" class="active">Update Hotel emailid</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="password" name="uppassword" value="<?php echo $row[14]; ?>" required=""  pattern="[0-9A-Za-z]{4,5}" maxlength="5" class="validate uppassword">
                                            <label for="list-title" class="active">Update Hotel password</label>
                                        </div>
                                        <font class="fa fa-eye-slash" id="eye2" style="position:relative;top:31px;right: 39px;"></font>
                                    </div>
                                </div> 
                            
                            <div class="row adform1" style="padding-top:10px;">
                                    <div class="col-md-12 center-align">
                                        <div class="form-group form-group-sm"> 
                                            <button type="submit" class="btn" name="uphotelprofile">Update Hotel</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                    </div>
                    
                    <div class="profilephoto">
                        <img src="../<?php echo $row[9]; ?>" class="animated fadeInRight" />
                        <button class="profilebtn animated flip" onclick="changepatto(this);">Edit your Profile</button>
                    </div>
                    
                    
                </div>
                <div class="col-md-2">
                    
                </div>
                <div class="col-md-7 animated fadeInRight" id="side-right" style="transition:1s ease-out;">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="padding-top:30px;">
                                <h1 style="letter-spacing:2px; color:#FF0049;"><i class="fa fa-user" style="color:#2A3C54; padding-left: 10px;"></i> Profile</h1>
                            </div>  
                        </div>
                        <div class="col-md-12">
                            <div class="datadisplayuser">
                                <h3 class="animated flipInY">Welcome , <?php echo $row[2] ?>&nbsp;&nbsp;
                                    <?php
                                    if($row[8]=="veg")
                                    {
                                    ?>
                                        <img src="images/veg.png" height="15px" />
                                    <?php
                                    }
                                    elseif ($row[8]=="non-veg") 
                                    {
                                    ?>
                                        <img src="images/non-veg.png" height="15px" />
                                    <?php
                                    }
                                    else
                                    {
                                    ?>
                                        <img src="images/both.jpeg" height="15px" />
                                    <?php
                                    }
                                    ?>
                                </h3>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row" style="margin-left:30px;">
                                <div class="col-md-6">
                                    <div class="datadisplayuser">
                                        <iframe src="<?php echo $row[5]; ?>" width="100%"></iframe>  
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="datadisplayuserfinal">
                                        <h5 class="animated flipInY"><i class="fa fa-map-marker" style="padding-right:5px;"></i><font style="font-size:10px;"><?php echo $row[3]; ?></font></h5>
                                    </div>
                                    <div class="datadisplayuserfinal">
                                        <h5 class="animated flipInY" style="background:-webkit-linear-gradient(45deg,#2a3c54,white);"><i class="fa fa-phone" style="padding-right:10px;"></i><?php echo $row[4]; ?></h5>
                                    </div>
                                    <div class="datadisplayuserfinal">
                                        <h5 class="animated flipInY">Hotel Rating :- &nbsp;<?php echo $row[7]; ?>&nbsp;
                                            <?php
                                            $a=0;
                                            for($i=1;$i<=floor($row[7]);$i++)
                                            {
                                                ?>
                                                <i class="fa fa-star" style="padding-right:2px;padding-left:2px; color:#F6BE00; background-color:#2A3C54;"></i>
                                                <?php
                                                
                                            }
                                            if($row[7]==1.5 || $row[7]==2.5 || $row[7]==3.5 || $row[7]==4.5)
                                                {
                                                    if($a==0)
                                                    {
                                                    ?>
                                                        <i class="fa fa-star-half" style="padding-right:2px;padding-left:2px; color:#F6BE00;background-color:#2A3C54;"></i>
                                                    <?php
                                                    $a=1;
                                                    }
                                                }
                                            ?>
                                            
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="datadisplayuserfinal">
                                            <h5 style="margin-left:30px; background:-webkit-linear-gradient(45deg,#2a3c54,white);" class="animated flipInY">checkout time , <?php echo $row[12] ?></h5>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="datadisplayuserfinal">
                                            <h5 style="margin-left:30px;" class="animated flipInY">Gstno , <?php echo $row[11] ?></h5>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="datadisplayuserfinal">
                                            <h5 style="margin-left:30px; background:-webkit-linear-gradient(45deg,#2a3c54,white);" class="animated flipInY" >checkin time , <?php echo $row[13] ?></h5>
                                        </div>
                                    </div> 
                                </div>
                        </div>
                        <div class="col-md-12 datadisplayuserfinal" style="padding-left:50px;">
                            <h5 ><i class="fa fa-envelope" style="padding-right:20px;padding-right:20px;"></i><?php echo $row[15]; ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
            

        <?php
        require_once 'adminscript.php';
        ?>

    </body>

</html>
