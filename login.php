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
                    <div class="col-md-3 col-md-offset-3 mainclass1">


                        <div class="col-md-12">
                            <div class="spe-title1">
                                <font>Login <span>With Your</span> Journey</font>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                        <form action="" method="post" autocomplete="off" name="login">
                           <?php
                           if($loginer==1)
                           {
                               echo '<font id="khalikarologinne" class="animated flash infinite" style="padding-left:117px; color:red; font-size:10px;">Invalid Login</font>';
                           }
                           ?>
                            <div class="form-group">
                                <div class="row formpadding">
                                    <div class="col-md-2">

                                    </div>
                                 
                                    <div class="col-md-10 formcontrol">
                                        <i class="fa fa-envelope"> </i>
                                        <input type="email" required="" value="<?php if(isset($_COOKIE[user])){echo $_COOKIE[user];} ?>" name="emailid" class="form-control"  placeholder="Enter Your Email"/>
                                    </div>
                                </div>
                                <div class="row formpadding">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-10 formcontrol">
                                        <i class="fa fa-unlock-alt"> </i>
                                        <input type="password" required="" value="<?php if(isset($_COOKIE[password])){echo $_COOKIE[password];} ?>" name="password" class="form-control password"  placeholder="*****************"/>
                                        <font class="fa fa-eye-slash" id="eye"></font>
                                    </div>
                                </div>
                                <div class="row formpadding">
                                    <div class="col-md-2">

                                    </div>
                                    <div class="col-md-10">
                                      <?php
                                      if(isset($_COOKIE[user]))
                                      {
                                      ?>
                                        <div class="checkbox checkbox-info checkbox-circle">
                                            <input id="tc" class="styled checkboxpadding" name="rem" checked="" type="checkbox">
                                            <label for="tc" class="checkboxpadding"><font>Stay login here</font>   </span>
                                            </label>
                                        </div>
                                      <?php
                                      }
                                      else
                                      {
                                      ?>
                                         <div class="checkbox checkbox-info checkbox-circle">
                                            <input id="tc" class="styled checkboxpadding" name="rem" type="checkbox">
                                            <label for="tc" class="checkboxpadding"><font>Stay login here</font>   </span>
                                            </label>
                                        </div>
                                      <?php
                                      }
                                      ?>
                                    </div>
                                </div>
                                <div class="row formpadding">

                                    <div class="col-md-4 formbutton col-md-offset-1">
                                        <button type="submit" name="safelogin" class="btn">Login</button>
                                    </div>
                                    <div class="col-md-4 formbutton">
                                        <button type="reset" onclick="document.getElementById('khalikarologinne').innerHTML = '';" class="btn">clear</button>
                                    </div>

                                </div>
                                
                                <div class="row formpadding">
                                    <div class="col-md-2">
                                        
                                    </div>
                                    <div class="col-md-10 formrequestarrow" style="margin-left:66px;">
                                        <i class="fa fa-arrow-right"></i> <a href="requestpassword.php">Forget passsword ?</a>
                                        
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