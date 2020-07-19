<!DOCTYPE html>
<?php require_once 'connection.php'; 
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
        
        
        <div class="container">
            <div class="row topbot">
                <?php
                $billgoto=$con->query("SELECT * FROM billhistory where emailid='$_SESSION[user]'");
                while($billrow= mysqli_fetch_array($billgoto))
                {
                    if(mysqli_num_rows($billgoto)>=1)
                    {
                        if($billrow[4]=="static")
                        {
                        ?>
                                    <div>
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="cus-book-form form_1 custompackdis" style="height:350px;width:650px;">
                                                    <div class="row">
                                                        <div class="col-md-4 hovervala text-center" style="text-transform: capitalize;">
                                                            <?php
                                                            $packagedata = $con->query("SELECT * FROM package p,schedule s where p.packageid=s.packageid and p.packageid=$billrow[3]");
                                                            $rowpackage = mysqli_fetch_array($packagedata);
                                                            ?>
                                                            <img src="<?php echo $rowpackage[5]; ?>"style="height:248px;width:190px;"/>
                                                            <div style="margin-top:10px;">
                                                                <font><?php echo $rowpackage[1]; ?></font>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">

                                                            <i class="fa fa-gg fafado" style="float:right; color:#4E2E70;"></i>
                                                            <div class="row" style="margin-top:20px;">
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Number Of Days</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-sun-o" style="margin-right:10px;"></i><?php echo $rowpackage[2].' Days'; ?></div>
                                                                </div>
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Number Of Nights</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-moon-o" style="margin-right:10px;"></i><font style="font-size:12px;"><?php echo $rowpackage[3].' Nights'; ?></font></div>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="padding-bottom:10px;margin-top:10px;">
                                                                <div class="col-md-12 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Amount</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-rupee" style="margin-right:10px;"></i><?php echo $rowpackage[4]; ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="row" >
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">From Date</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-clock-o" style="margin-right:10px;"></i><?php echo $rowpackage[10]; ?></div>
                                                                </div>
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">To Date</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-clock-o" style="margin-right:10px;"></i><?php echo $rowpackage[11]; ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                    <div class="col-md-12" style="margin-top:20px;">
                                                                             <div class="text-center btn" style="margin-bottom:20px;width:100%;background:#4E2E70!important;color:white;font-weight:1000;" title="click me" data-toggle="modal" data-target="#custompackage" onclick="custompackageleva('staticpackagebilldisplay',<?php echo $billrow[3]; ?>);">package Bill</div>
                                                                             <div class="col-md-12">
                                                                                 <a class="btn text-center" target="_blank" style="margin-bottom:20px;width:100%;background:#4E2E70!important;color:white;font-weight:1000;" href="<?php echo $rowpackage[6]; ?>">View Package PDF</a>
                                                                             </div>
                                                                     </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                        <?php    
                        }
                        else
                        {
                        ?>
                                <div style="margin-bottom:30px;">
                                <?php
                                 $lavo=$con->query("select * from custompackage where custompackageid=$billrow[3]");
                                while($row=mysqli_fetch_array($lavo))
                                {
                                 ?>     
                                    <div class="cus-book-form form_1 custompackdis" style="height:350px;width:650px;">
                                                <div class="row">
                                                    <div class="col-md-4 hovervala">
                                                        <?php
                                                        if($row[7]=="Honeymoon Package")
                                                        {
                                                        ?>
                                                        <img src="images/honeymoon_romantic.webp" style="height:281px;width:190px;" />
                                                        <?php   
                                                        }
                                                        elseif($row[7]=="Family Package") 
                                                        {
                                                         ?>
                                                        <img src="images/family.webp" style="height:281px;width:190px;" />
                                                        <?php
                                                        }
                                                        elseif($row[7]=="Holiday Package") 
                                                        {
                                                        ?>
                                                        <img src="images/water+activities.webp" style="height:281px;width:190px;" />
                                                        <?php
                                                        }
                                                        elseif($row[7]=="Group Package") 
                                                        {
                                                        ?>
                                                        <img src="images/friends_group.webp" style="height:281px;width:190px;" />
                                                        <?php
                                                        }
                                                        elseif($row[7]=="Regular Package") 
                                                        {
                                                        ?>
                                                        <img src="images/adventure.webp" style="height:281px;width:190px;" />
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <img src="images/solo.webp" style="height:281px;width:190px;" />
                                                        <?php    
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="col-md-8">
                                                         <i class="fa fa-gg fafado" style="float:right; color:#4E2E70;"></i>
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
                                                                  <div class="col-md-12" style="margin-top:20px;">
                                                                    <div class="text-center btn" style="margin-bottom:20px;width:100%;background:#4E2E70!important;color:white;font-weight:1000;" title="click me" data-toggle="modal" data-target="#custompackage" onclick="custompackageleva('custompackagebilldisplay',<?php echo $billrow[3]; ?>);">custom package Bill</div>
                                                                    <div class="col-md-12">
                                                                        <?php
                                                                        $pdfgoto=$con->query("SELECT * FROM custompackageresponse where custompackageid=$billrow[3]");
                                                                        $pdfaapo= mysqli_fetch_array($pdfgoto);
                                                                        ?>
                                                                        <a class="btn text-center" target="_blank" style="margin-bottom:20px;width:100%;background:#4E2E70!important;color:white;font-weight:1000;" href="<?php echo $pdfaapo[2]; ?>">View Package PDF</a>
                                                                    </div>
                                                                  </div>
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
                    }
                    else 
                    {
                    ?>
                        <h1>Please Buy the Package and check Later</h1>
                    <?php  
                    }
                }
                ?>
            </div>
        </div>

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