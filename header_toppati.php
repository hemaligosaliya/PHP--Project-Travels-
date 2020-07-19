<?php
if($_SESSION[user]!="")
{
?>
<div id="counter"></div>
<?php
}
  $rowsiteprofile=$con->query("select * from siteprofile where category=2");
   $datasiteprofile=  mysqli_fetch_array($rowsiteprofile);
?>
<div class="ed-top">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="ed-com-t1-left">
                    <ul>
                        <li><i class="fa fa-map-marker" aria-hidden="true"></i></li>
                        <li class="phone">Location : <?php echo $datasiteprofile[4]; ?>
                        </li>
                        <li><i class="fa fa-phone" aria-hidden="true"></i></li>
                        <li class="phone">Toll-free :  <?php echo $datasiteprofile[1]; ?>
                        </li>
                    </ul>
                </div>
                <div class="ed-com-t1-right">
                    <ul>
                        <?php
                        if($_SESSION[type]==1)
                        {
                        ?>
                        <li class="ed-com-t1-right1"><a href="logout.php">Sign Out</a>
                        </li>
                        <?php
                        }
                        elseif($_SESSION[user]=="")
                        {
                        ?>
                        <li class="ed-com-t1-right1"><a href="login.php">Sign In</a>
                        </li>
                        <li class="ed-com-t1-right2"><a href="register.php">Sign Up</a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
                <div class="ed-com-t1-social">
                    <ul>
                        <li><a href="" title="Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="" title="Google+"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="" title="Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                        </li>
                        <li><a href="" title="Instagram"><i class="fa fa-instagram" aria-hidden="true"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>