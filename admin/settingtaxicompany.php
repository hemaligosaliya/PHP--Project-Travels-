<?php
require_once '../connection.php';
require_once '../insertdata.php';
$_SESSION[page] = "";
if ($_SESSION[user] == "") {
    header("location:../index.php");
} else if ($_SESSION[type] !=3) {
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
        $data= $con->query("select * from taxicompany where taxicompanyid=$_SESSION[taxicompanyid]");
        $row=mysqli_fetch_array($data);
        $_SESSION[checkpotaniid]=$row[0];
        $_SESSION[checkpotaniid1]=$row[2];
        $_SESSION[upid]=$_SESSION[taxicompanyid];
        ?>
        <div class="container-fluid">
            <div class="row topbot">
                <div class="col-md-3 profilelefttaxi animated fadeInLeft" id='side-left'>
                    
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

                        <form  action="" autocomplete="off" method="post" name="uptaxicompany">
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[2]; ?>" name="upname"autofocus="" required="" pattern="^[a-z ]*$" class="validate lowertransfer">
                                                <label for="list-title" class="active">Update taxicompany name</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[4]; ?>"  name="upmobile" required="" maxlength="10" pattern="^[0-9]{10}$" class="validate lowertransfer" >
                                                <label for="list-title" class="active">Update company mobile</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="upaddress" required="" class="materialize-textarea"><?php echo $row[3]; ?></textarea>
                                        <label for="textarea1" class="active">Update company address</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="upmap" required="" class="materialize-textarea"><?php echo $row[5]; ?></textarea>
                                        <label for="textarea1" class="active">Update company map</label>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="upabout" required="" class="materialize-textarea"><?php echo $row[6]; ?></textarea>
                                        <label for="textarea1" class="active">Update company about</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[7]; ?>"  name="upgstno" required="" maxlength="15" pattern="^[A-Z0-9]{15}$" class="validate lowertransfer" >
                                                <label for="list-title" class="active">Update company gstno</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="email" name="upemailid" value="<?php echo $row[8]; ?>" required="" class="validate lowertransfer">
                                            <label for="list-title" class="active">Update company emailid</label>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="password" name="uppassword" value="<?php echo $row[9]; ?>" required=""  pattern="[0-9A-Za-z]{6,7}" maxlength="7" class="validate uppassword">
                                            <label for="list-title" class="active">Update company password</label>
                                        </div>
                                        <font class="fa fa-eye-slash" id="eye2" style="position:relative;top:31px;right: 39px;"></font>
                                    </div>
                                </div>
                                
                            <div class="row adform1" style="padding-top:20px;"> 
                                    <div class="col-md-12 center-align">
                                        <div class="form-group form-group-sm"> 
                                            <button type="submit" class="btn" name="uptaxicompanyprofile">Update Profile</button> &nbsp;&nbsp;
                                        </div> 
                                    </div>
                                </div>
                            </form>
                    </div>
                    
                    <div class="profilephoto">
                        <img src="images/car(2)final.jpg" style="background:white;" class="animated fadeInRight" />
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
                                <h3 class="animated flipInY">Welcome , <?php echo $row[2];?></h3>
                            </div>
                        </div>
                        <div class="col-md-12" style="padding-bottom:20px;">
                            <iframe style="margin-left:30px;" src="<?php echo $row[5]; ?>" width="97%"></iframe> 
                        </div>
                        
                        <div class="col-md-12">
                            <div class="datadisplayuserfinal">
                                <h5 style="margin-left:30px;background:-webkit-linear-gradient(45deg,#2a3c54,white);" class="animated flipInY"><i class="fa fa-map-marker" style="padding-right:10px;"></i> <?php echo $row[3]; ?></h5>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-5">
                                    <div class="datadisplayuserfinal">
                                        <h5 style="margin-left:30px;background:-webkit-linear-gradient(45deg,#2a3c54,white);" class="animated flipInY"><i class="fa fa-envelope" style="padding-right:10px;"></i> <?php echo $row[8]; ?></h5>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="datadisplayuserfinal">
                                        <h5 style="margin-left:30px;" class="animated flipInY"><i class="fa fa-phone" style="padding-right:10px;"></i> <?php echo $row[4]; ?></h5>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="datadisplayuserfinal">
                                        <h5 style="margin-left:30px;background:-webkit-linear-gradient(45deg,#2a3c54,white);" class="animated flipInY"><i class="fa fa-newspaper-o" style="padding-right:10px;"></i> <?php echo $row[7]; ?></h5>
                                    </div>
                                </div>
                            </div>                           
                        </div>
                        
                        <div class="col-md-12">
                            <div class="datadisplayuserfinal">
                                <h5 style="margin-left:30px;" class="animated flipInY"><i class="fa fa-bookmark" style="padding-right:10px;"></i> <?php echo $row[6]; ?></h5>
                            </div>
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
