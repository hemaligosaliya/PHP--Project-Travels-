<?php
require_once '../connection.php';
require_once '../insertdata.php';
$_SESSION[page] = "";
if ($_SESSION[user] == "") {
    header("location:../index.php");
} else if ($_SESSION[type] != 0) {
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
        ?>
        <div class="container-fluid">
            <div class="row topbot">
                <div class="col-md-3 profileleft animated fadeInLeft" id='side-left'>
                    
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
                            <?php
                                $data= $con->query("select * from register where emailid='$_SESSION[user]'");
                                $row=mysqli_fetch_array($data);
                             ?>
                        <form action="" method="post" name="upregister" enctype="multipart/form-data">
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-field col s10">
                                        <input id="list-title" type="text" name="upfname" autofocus="" value="<?php echo $row[3]; ?>" required="" pattern="^[A-Za-z]*$" class="validate">
                                            <label for="list-title" class="active">update first Name</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="input-field col s10">
                                      <input id="list-title" type="text" name="uplname" autofocus="" value="<?php echo $row[4]; ?>" required="" pattern="^[A-Za-z]*$" class="validate">
                                            <label for="list-title" class="active">update Last Name</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                    <div class="col-md-4">
                                        <p class="labelrating1">Update Country</p>
                                        <div class="input-field col s10 editprofile">
                                            <select name="upcountryid" autofocus="" required="" onchange="selectleva('state',this.value)">
                                                <option value="" disabled="" selected="">Select country</option>
                                                <?php
                                                        $datasel = $con->query("select * from country");
                                                        while ($rowsel = mysqli_fetch_array($datasel)) 
                                                        {
                                                        ?>
                                                            <option <?php if($row[0]==$rowsel[0]){ echo selected; } ?>  value="<?php echo $rowsel[0]; ?>"><?php echo $rowsel[1]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                            </select>  
                                        </div>   
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <p class="labelrating1">Update state</p>
                                        <div class="input-field col s10 editprofile">
                                            <select name="upstateid" id="statecombo" onchange="selectleva('city',this.value)">
                                                        <?php
                                                        $datasel = $con->query("select * from state where stateid=$row[1]");
                                                        while ($rowsel = mysqli_fetch_array($datasel)) 
                                                        {
                                                        ?>
                                                            <option <?php if($row[0]==$rowsel[0]){ echo selected; } ?>  value="<?php echo $rowsel[1]; ?>"><?php echo $rowsel[2]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                            </select>
                                        </div>   
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <p class="labelrating1">Update city</p>
                                        <div class="input-field col s10 editprofile" >
                                            <select name="upcityid" id="citycombo" >
                                                        <?php
                                                        $datasel = $con->query("select * from city where cityid=$row[2]");
                                                        while ($rowsel = mysqli_fetch_array($datasel)) 
                                                        {
                                                        ?>
                                                            <option <?php if($row[0]==$rowsel[0]){ echo selected; } ?>  value="<?php echo $rowsel[1]; ?>"><?php echo $rowsel[2]; ?></option>
                                                        <?php
                                                        }
                                                        ?>         
                                            </select>
                                        </div>   
                                    </div>
                                    
                                </div>
                            <div class="row" style="padding-top: 20px;">
                                <div class="col-md-6">
                                    
                                    <?php
                                        if ($_SESSION[dup] == 1) {
                                            echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
                                            $_SESSION[dup] = 0;
                                        }
                                        ?>
                                    
                                    
                                    <div class="input-field col s10">
                                        <input id="list-title" type="email" name="upemailid" value="<?php echo $row[5]; ?>" required="" class="validate">
                                        <label for="list-title" class="active">update Email</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-field col s10">
                                        <input id="list-title" type="text" name="upcontact" value="<?php echo $row[6]; ?>" required="" maxlength="10" pattern="^[0-9]{10}$" class="validate">
                                            <label for="list-title" class="active">update Contact</label>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row" style="padding-top: 20px;">
                                <div class="col-md-6">
                                    <div class="input-field col s10">
                                        <input id="list-title" type="password" name="uppassword" value="<?php echo $row[8]; ?>" required="" pattern="^[a-z0-9A-Z]{8,18}$" maxlength="10" class="validate uppassword">
                                            <label for="list-title" class="active">update password</label>
                                    </div>
                                    <font class="fa fa-eye-slash" id="eye2" style="position:relative;top:31px;right: 39px;"></font>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="radio" name="upgender" value="male" <?php if($row[7]=="male" || $row[7]=="Male"){echo checked;} ?> class="with-gap">
                                            <label for="list-title" >male</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3">
                                            <div class="input-field col s10">
                                            <input id="list-title" type="radio" name="upgender" value="female" <?php if($row[7]=="female" || $row[7]=="Female"){echo checked;} ?> class="with-gap">
                                            <label for="list-title" >female</label>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    
                                </div>
                            </div>
                            
                            <div class="row">
                                
                                <div class="col-md-6">
                                     <p class="labelrating1">If You Want Upadte Your Profile photo ?</p>
                                    <?php
                                    if ($_SESSION[er] == 1) {
                                        echo '<p><font style="color: red; font-size:10px;" class="animated flash infinite">Invalid file formate</font></p>';
                                        $_SESSION[er] = 0;
                                    } elseif ($_SESSION[err] == 1) {
                                        echo '<p><font style="color: red; font-size:10px;" class="animated flash infinite">Size too large</font></p>';
                                        $_SESSION[err] = 0;
                                    }
                                    ?>
                                    <div class="input-field col s10">
                                        <div class="file-field">
                                            <div class="btn">
                                                <span>File</span>
                                                <input type="file" name="upphoto" title="only choose photo if you want to change profile picture">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" placeholder="Upload photo">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6" style="padding-top:50px;">
                                    <button type="submit" class="btn" name="upregister">Update Profile</button> &nbsp;&nbsp;
                                    <button type="reset" class="btn">Reset</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>
                    
                    <div class="profilephoto">
                        <img src="../<?php echo $row[10]; ?>" class="animated fadeInRight" />
                        <button class="profilebtn animated flip" onclick="changepatto(this);">Edit your Profile</button>
                    </div>
                    
                    
                </div>
                <div class="col-md-2">
                    
                </div>
                <div class="col-md-7 animated fadeInRight" id="side-right" style="transition:1s ease-out;">
                    <div style="padding-top:30px;">
                        <h1 style="letter-spacing:2px; color:#FF0049;"><i class="fa fa-user" style="color:#2A3C54; padding-left: 10px;"></i> Profile</h1>
                    </div>
                    <div class="datadisplayuser">
                        <h3 class="animated flipInY">Welcome , <?php echo $row[3]." ".$row[4]; ?></h3>
                    </div>
                    <div class="datadisplayuser">
                        <h5 style="margin-left:30px;" class="animated flipInY"><i class="fa fa-envelope"></i> <?php echo $row[5]; ?></h5>
                    </div>
                    <div class="datadisplayuser">
                        <h5 style="margin-left:60px;" class="animated flipInY"><i class="fa fa-key"></i> 
                        <?php
                        $countmate=strlen($row[8]);
                        for($i=1;$i<=$countmate;$i++)
                        {
                            echo '<font style="letter-spacing:3px;">*</font>';
                        }
                        ?></h5>
                    </div>
                    <div class="datadisplayuser">
                        <?php
                            $selcity=$con->query("select * from city where cityid=$row[2]");
                            $datacity=  mysqli_fetch_array($selcity);
                            $selstate=$con->query("select * from state where stateid=$row[1]");
                            $datastate=  mysqli_fetch_array($selstate);
                            $selcountry=$con->query("select * from country where countryid=$row[0]");
                            $datacountry=  mysqli_fetch_array($selcountry);
                        ?>
                        <h5 style="margin-left:90px;" class="animated flipInY"><i class="fa fa-globe"></i> <?php echo $datacountry[1]; ?>&nbsp;&nbsp; <i class="fa fa-paper-plane-o"></i> <?php echo $datastate[2]; ?> &nbsp;&nbsp;<i class="fa fa-map-marker"></i> <?php echo $datacity[2]; ?></h5>
                    </div>
                    
                    <div class="datadisplayuser">
                        <h5 style="margin-left:120px; letter-spacing: 2px;" class="animated flipInY"><i class="fa fa-phone"></i> <?php echo $row[6]; ?></h5>
                    </div>
                    
                    <div class="datadisplayuser">
                        <h5 style="margin-left:150px;" class="animated flipInY"><i class="<?php if($row[7]=='male'){echo 'fa fa-male';}else{echo 'fa fa-female';} ?>"></i> <?php if($row[7]=='male'){echo 'Male';}else{echo 'female';} ?></h5>
                    </div>
                </div>
            </div>
        </div>
        
            

        <?php
        require_once 'adminscript.php';
        ?>

    </body>

</html>
