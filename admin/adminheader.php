<?php require_once '../connection.php'; 
      require_once '../insertdata.php';
      
      if($_SESSION[user]=="")
      {
          header("location:../index.php");
      }
?>
<?php
if($_SESSION[user]!="")
{
?>
<div id="counter"></div>
<?php
}
?>
<div class="container-fluid sb1">
        <div class="row">
            
            <div class="col-md-2 col-sm-3 col-xs-6 sb1-1">
                <a href="#" class="btn-close-menu"><i class="fa fa-times" aria-hidden="true"></i></a>
                <a href="#" class="atab-menu"><i class="fa fa-bars tab-menu" aria-hidden="true"></i></a>
                <?php
                if($_SESSION[type]=="0")
                {
                ?>
                    <a href="adminmaster.php" class="logo"><img src="images/logo1.png" alt="" /></a>
                <?php
                }
                elseif ($_SESSION[type]==1) 
                {
                ?>
                    <a href="../index.php" class="logo"><img src="images/logo1.png" alt="" /></a>
                <?php
                }
                elseif ($_SESSION[type]==2) 
                {
                ?>
                    <a href="hotelmaster.php" class="logo"><img src="images/logo1.png" alt="" /></a>
                <?php
                }
                elseif ($_SESSION[type]==3) 
                {
                ?>
                    <a href="taxicompanymaster.php" class="logo"><img src="images/logo1.png" alt="" /></a>
                <?php
                }
                ?>
            </div>
            
            <div class="col-md-6 col-sm-6 mob-hide">
                <?php
                if($_SESSION[type]!=1)
                {
                ?>
                <!-- <form class="app-search">
                    <input type="text" placeholder="search..." class="form-control"/>
                    <a href="#"><i class="fa fa-search"></i></a>
                </form> !-->
                <?php
                }
                ?>
            </div>
            
            <div class="col-md-2 tab-hide">
                <?php
                if($_SESSION[type]!=1)
                {
                ?>
                <div class="top-not-cen">
                    <a class='waves-effect btn-noti' href='#'><i class="fa fa-commenting-o" aria-hidden="true"></i><span>5</span></a>
                    <a class='waves-effect btn-noti' href='#'><i class="fa fa-envelope-o" aria-hidden="true"></i><span>5</span></a>
                    <a class='waves-effect btn-noti' href='#'><i class="fa fa-tag" aria-hidden="true"></i><span>5</span></a>
                </div>
                <?php
                }
                ?>
            </div>
            
            <div class="col-md-2 col-sm-3 col-xs-6">
                <a class='waves-effect dropdown-button top-user-pro' href='#' data-activates='top-menu'>
                    
                    <?php
                  if($_SESSION[type]== 0)
                  {
                      $adminnophoto = $con->query("select * from register where emailid='$_SESSION[user]'");
                      $selphotoadmin = mysqli_fetch_array($adminnophoto);
                      ?><img src="<?php echo '../' . $selphotoadmin[10]; ?>" height="25px" alt=""><?php
                  }
                  elseif($_SESSION[type]== 2)
                  {
                      $adminnophoto = $con->query("select * from hotel where hotelid=$_SESSION[hotelid]");
                      $selphotoadmin = mysqli_fetch_array($adminnophoto);
                      ?><img src="<?php echo '../' . $selphotoadmin[9]; ?>" height="25px" alt=""><?php
                  }
                  elseif($_SESSION[type]== 3)
                  {
                      ?><img src="images/taxifinal.png" height="25px" alt=""><?php
                  }
                 ?>
                    
                    My Account <i class="fa fa-angle-down" aria-hidden="true"></i>
                </a>

                <ul id='top-menu' class='dropdown-content top-menu-sty'>
                    <?php
                        if($_SESSION[type]== 0)
                        {
                        ?>
                            <li><a href="adminmaster.php" class="waves-effect"><i class="fa fa-user-circle-o" aria-hidden="true"></i>My Account</a>
                            </li>
                            <li><a href="setting.php" class="waves-effect"><i class="fa fa-cogs" aria-hidden="true"></i>Edit Profile</a>
                            </li>
                        <?php
                        }
                        elseif($_SESSION[type]== 2) 
                        {
                        ?>
                            <li><a href="hotelmaster.php" class="waves-effect"><i class="fa fa-user-circle-o" aria-hidden="true"></i>My Account</a>
                            </li>
                            <li><a href="settinghotel.php" class="waves-effect"><i class="fa fa-cogs" aria-hidden="true"></i>Edit Profile</a>
                            </li>
                        <?php
                        }
                        elseif($_SESSION[type]== 3)
                        {
                         ?>
                            <li><a href="taxicompanymaster.php" class="waves-effect"><i class="fa fa-user-circle-o" aria-hidden="true"></i>My Account</a>
                            </li>
                            <li><a href="settingtaxicompany.php" class="waves-effect"><i class="fa fa-cogs" aria-hidden="true"></i>Edit Profile</a>
                            </li>
                        <?php
                        }
                        elseif($_SESSION[type]== 1)
                        {
                         ?>
                            <li><a href="../index.php" class="waves-effect"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
                            </li>
                        <?php
                        }
                    ?>
                    <li class="divider"></li>
                    <li><a href="../logout.php" class="ho-dr-con-last waves-effect"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>