<?php
require_once '../connection.php';
require_once '../insertdata.php';
$_SESSION[page] = "";
?>
<html>
    <?php
    require_once 'adminhead.php';
    ?>
    
    <body>
        <img src="../images/ballon.png" id="adminballon1" onclick="displayadmin();" class="ballonanimation" />
        <img src="../images/ballon.png" id="adminballon2" onclick="displayadmin();" class="ballonanimation1"/>   
        <section class="page_404" id="admin404">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12" style="padding-top:45px;">
                        <div class="col-sm-10 col-sm-offset-1  text-center">
                            <div class="four_zero_four_bg">
                                <h1 class="text-center ">404</h1>


                            </div>

                            <div class="contant_box_404">
                                <h3 class="h2">
                                    Look like you're lost
                                </h3>

                                <p>the page you are looking for not avaible!</p>

                                <a href="../index.php" class="link_404">Go to Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="adminform">
            <div class="container" style="padding-top:100px;">
                <div class="row" style="margin-left:320px;">
                    <div class="col-md-12 center-align">
                        <div class="row col s6">
                            <h1>-- Login --</h1>
                        </div>
                        <form name="adminlogin" action="" method="post" autocomplete="off">
                            <?php
                                if ($logineradmin == 1) 
                                {
                                 ?>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-field col s6">
                                                    <font class="animated flash infinite" style="color:red; font-size:10px;">Invalid Login</font>
                                                </div>
                                            </div>
                                        </div>
                                <?php
                                }
                            ?>
                            
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-field col s6">
                                        <input id="list-title" type="email" name="emailid" required="" class="validate">
                                        <label for="list-title" class="active">Enter Emailid</label>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-field col s6">
                                        <input id="list-title" type="password" name="password" required="" class="validate uppassword">
                                        <label for="list-title" class="active">Enter password</label>
                                    </div>
                                    <font class="fa fa-eye-slash" id="eye2" style="position:relative;top:31px;right: 160px;"></font>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="input-field col s6">
                                        <button type="submit" class="btn" name="loginadmin">login</button> &nbsp;&nbsp;
                                        <button type="reset" class="btn ">Reset</button>
                                    </div> 
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
        
        
        <?php
        require_once 'adminscript.php';
        ?>
    </body>
</html>