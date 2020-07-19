<?php
require_once 'connection.php';
?>
<!-- Manage Child Model custom package-->

<?php
if ($_REQUEST[konidetail] == "custompackage") {
    $lavo = $con->query("select * from custompackage where custompackageid=$_REQUEST[id]");
    $row = mysqli_fetch_array($lavo);
    $_SESSION[custompackageid] = $_REQUEST[id];
    ?>
    <div class="modal-content">
        <div class="modal-header">
            <div class="spe-title cus-title" style="margin-top:10px;">
                <h2 style="color:#4E2E70;">Select places of Your <span> Package</span></h2>
                <div class="title-line">
                    <div class="tl-1"></div>
                    <div class="tl-2"><i class="fa fa-gg" style="color:#FF0049;"></i></div>
                    <div class="tl-3"></div>
                </div>
            </div>
            <i class="fa fa-close fafado" style="float:right; color:#4E2E70;font-size:20px;position:absolute;right:30px;top:25px;" data-dismiss="modal"></i>
        </div>
        <div class="modal-body" style="padding:20px!important">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12" style="margin:20px 0px 40px 20px;">
                        <div class="row">
                            <div class="col-md-4 hovervala">
                                <?php
                                if ($row[7] == "Honeymoon Package") {
                                    ?>
                                    <img src="images/honeymoon_romantic.webp" style="width:70%;"/>
                                    <?php
                                } elseif ($row[7] == "Family Package") {
                                    ?>
                                    <img src="images/family.webp"/>
                                    <?php
                                } elseif ($row[7] == "Holiday Package") {
                                    ?>
                                    <img src="images/water+activities.webp" style="width:70%;"/>
                                    <?php
                                } elseif ($row[7] == "Group Package") {
                                    ?>
                                    <img src="images/friends_group.webp"/>
                                    <?php
                                } elseif ($row[7] == "Regular Package") {
                                    ?>
                                    <img src="images/adventure.webp"/>
                                    <?php
                                } else {
                                    ?>
                                    <img src="images/solo.webp"/>
                                    <?php
                                }
                                ?>

                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <div class="col-md-3 text-center">
                                        <font style="color:#4E2E70;font-size:15px;">Departure Date</font>
                                        <div style="height:10px;width:2px; background-color:#4E2E70;margin: 0 auto;"></div>
                                        <div class="text-center"><i class="fa fa-clock-o" style="margin-right:10px;"></i><?php echo date("d-m-Y", strtotime($row[3])); ?></div>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <font style="color:#4E2E70;font-size:15px;">Arrival Date</font>
                                        <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                        <div class="text-center"><i class="fa fa-clock-o" style="margin-right:10px;"></i><?php echo date("d-m-Y", strtotime($row[2])); ?></div>
                                    </div>
                                    <div class="col-md-4 text-center">
                                        <font style="color:#4E2E70;font-size:15px;">Package Category</font>
                                        <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                        <div class="text-center"><i class="fa fa-suitcase" style="margin-right:10px;"></i><?php echo $row[7]; ?></div>
                                    </div>
                                </div>
                                <div class="row"style="margin-top:20px;">
                                    <div class="col-md-5 text-center">
                                        <font style="color:#4E2E70;font-size:15px;">Number of adults</font>
                                        <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                        <div class="text-center"><i class="fa fa-user" style="margin-right:10px;"></i><?php echo $row[5]; ?></div>
                                    </div>
                                    <div class="col-md-7">
                                        <font style="color:#4E2E70;font-size:15px;">Number of children</font>
                                        <div style="height:10px;width:1px; background-color:#4E2E70;margin-left:64px;"></div>
                                        <div style="margin-left:50px;"><i class="fa fa-child" style="margin-right:10px;"></i><?php echo $row[6]; ?></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-9 text-center">
                                        <font style="color:#4E2E70;font-size:15px;">Budget</font>
                                        <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                        <div class="text-center" style="letter-spacing:1px;"><i class="fa fa-rupee" style="margin-right:10px;"></i><?php echo $row[4] . " /-"; ?></div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <form action="" method="post" name="custom package">
                                            <div class="col-md-6" style="margin:0 auto;">
                                                <div class="input-field col s10">
                                                    <i class="fa fa-globe global" style="top:8px;"></i>
                                                    <select name="countryid" required="" class="editprofile" onchange="selectlevareg('state', this.value)">
                                                        <option value="" disabled selected>Select Country</option>
                                                        <?php
                                                        $datasel = $con->query("select * from country");
                                                        while ($rowsel = mysqli_fetch_array($datasel)) {
                                                            ?>
                                                            <option value="<?php echo $rowsel[0]; ?>"><?php echo $rowsel[1]; ?></option>
                                                            <?php
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6" style="margin:0 auto;">
                                                <div class="input-field col s10 padd-left">
                                                    <i class="fa fa-paper-plane-o global1" style="top:8px;"></i>
                                                    <select name="stateid" required="" class="editprofile" id="statecombo" onchange="selectlevareg('city', this.value)">
                                                        <option value="" disabled selected>Select State</option>          
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="input-field col s5 padd-left1" style="margin-left:124px!important;">
                                                    <i class="fa fa-map-marker global2" style="top:8px;"></i>
                                                    <select name="cityid" required="" id="citycombo" class="editprofile" onchange="selectcustomselectplace('customplace', this.value,<?php echo $_SESSION[custompackageid]; ?>)">
                                                        <option value="" disabled selected>Select city</option>   
                                                    </select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12" id="customplacecombo">
                        <?php
                        $sel = $con->query("select * from placeassign pa,place p where p.placeid=pa.placeid and pa.custompackageid=$_REQUEST[id]");
                        if(mysqli_num_rows($sel)>=1)
                        {
                        ?>
                            <h1>Manage Assign Place</h1>
                        <?php
                        }
                        ?>
                        <div class="text-center">
                        <?php
                        
                        while ($row= mysqli_fetch_array($sel)) 
                            {
                            ?>
                            <div class="chip">
                                <?php echo $row[5]; ?><a href="custompackage.php?placeassignid=<?php echo $row[2]; ?>"><i class="fa fa-close" style="padding-left:10px;"></i></a>
                            </div>
                            <?php
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

<?php
if ($_REQUEST[konidetail] == "custompackagedetail") {
    $lavo = $con->query("select * from custompackage where custompackageid=$_REQUEST[id]");
    $row = mysqli_fetch_array($lavo);
    $_SESSION[custompackageid] = $_REQUEST[id];
    ?>
    <div class="modal-content">
        <div class="modal-header">
            <div class="spe-title cus-title" style="margin-top:10px;">
                <h2 style="color:#4E2E70;">Package <span> Details</span></h2>
                <div class="title-line">
                    <div class="tl-1"></div>
                    <div class="tl-2"><i class="fa fa-gg" style="color:#FF0049;"></i></div>
                    <div class="tl-3"></div>
                </div>
            </div>
            <i class="fa fa-close fafado" style="float:right; color:#4E2E70;font-size:20px;position:absolute;right:30px;top:25px;" data-dismiss="modal"></i>
        </div>
        <div class="modal-body" style="padding:20px!important">
                <div class="row">
                    <div class="col-md-12">
                        <h3>Package Place :-</h3>  
                    </div>
                    <div class="col-md-12">
                        <?php
                        $sel = $con->query("select * from placeassign pa,place p where p.placeid=pa.placeid and pa.custompackageid=$_REQUEST[id]");
                        ?>
                        <div class="text-center">
                            <?php
                            while ($row = mysqli_fetch_array($sel)) 
                            {
                            ?>
                              <div class="chip">
                                  <?php echo $row[5]; ?>
                              </div>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:20px;">
                        <div style="margin-left:30px;">
                            <form action="" method="post">
                                    <h1 style="text-transform:capitalize;padding:10px;background:#590072;color:white;"> hotels of your package</h1>
                                    <?php
                                    $datahotel = $con->query("select * from hotel h,hotelrequest hr,place p,city c where p.placeid=h.placeid and c.cityid=p.cityid and h.hotelid=hr.hotelid and hr.custompackageid=$_REQUEST[id] and hr.status=1");
                                    while ($row = mysqli_fetch_array($datahotel)) {
                                        ?>
                                        <div class="to-ho-hotel-con" style="height:249px!important;">
                                            <div class="to-ho-hotel-con-1"  style="max-height:145px;overflow:hidden;">
                                                <?php
                                                $roomgoto = $con->query("select sum(nofrom) from assignroomtype where hotelid=$row[1]");
                                                $aapmane = mysqli_fetch_array($roomgoto);
                                                ?>
                                                <div class="hom-hot-av-tic" style="font-size:10px;"> Available Rooms: <?php echo $aapmane[0]; ?></div> <img src="<?php echo $row[10]; ?>" alt="" style="height:100px;"> 
                                            </div>
                                            <div class="to-ho-hotel-con-23" style="padding:18px!important;">
                                                <div class="to-ho-hotel-con-2">
                                                    <h4 style="text-transform: capitalize;"><font style="font-size:14px;"><?php echo $row[2]; ?> ( <?php echo $row[23] . " / " . " $row[28] "; ?> )</font><font style="float:right;letter-spacing:1px;"><i class="fa fa-phone"></i> : &nbsp;<?php echo $row[4]; ?></font></h4>
                                                </div>
                                                <div class="to-ho-hotel-con-3">
                                                    <ul>
                                                        <li>
                                                            <div class="dir-rat-star ho-hot-rat-star"> Rating: 
                                                                <?php
                                                                $starcheck = 0;
                                                                if ($row[7] == "0.5" || $row[7] == "1.5" || $row[7] == "2.5" || $row[7] == "3.5" || $row[7] == "4.5") {
                                                                    $starcheck = 1;
                                                                }
                                                                for ($i = 1; $i <= floor($row[7]); $i++) {
                                                                    ?>
                                                                    <i class="fa fa-star" style="font-size:10px!important;"></i>
                                                                    <?php
                                                                }
                                                                if ($starcheck == 1) {
                                                                    ?>
                                                                    <i class="fa fa-star-half-empty" style="font-size:10px!important;"></i>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </li>
                                                        <br>
                                                        <li>
                                                            <div class="col-md-12">
                                                                Address: <?php echo $row[3];?>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col-md-12">
                                                                
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="col-md-12">
                                                                <?php
                                                                $price = $con->query("SELECT * FROM hotelrequest where hotelid=$row[1] and custompackageid=$_REQUEST[id]");
                                                                $pricerow = mysqli_fetch_array($price);
                                                                ?>
                                                                <i class="fa fa-rupee"></i><font style="font-size:10px;"><?php echo $pricerow[4]; ?></font><font style="font-size:10px;"> /- Day</font><font style="font-size:10px;"> (approx)</font>
                                                            </div>
                                                            <div class="col-md-12 text-center">
                                                                <?php
                                                                $hotelreq = $con->query("select * from hotelrequest where custompackageid=$_REQUEST[id] and hotelid=$row2[1]");
                                                                $hotelrow = mysqli_fetch_array($hotelreq);
                                                                ?>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </form>
                        </div>
                    </div>
                    <div class="col-md-12" style="margin-top:20px;">
                        <form action="" method="post">
                                <div class="col-md-12">
                                    <h1 style="text-transform:capitalize;padding:10px;background:#590072;color:white;">Taxi Company of Your package</h1>
                                </div>
                                <div class="col-md-12">
                                    <?php
                                    $datataxi = $con->query("select * from taxicompany t,taxicompanyrequest tr,place p,city c where p.placeid=t.placeid and c.cityid=p.cityid and t.taxicompanyid=tr.taxicompanyid and tr.status=1 and tr.custompackageid=$_REQUEST[id]");
                                    while ($row = mysqli_fetch_array($datataxi)) {
                                        ?>
                                        <div class="col-md-12 text-center" style="padding:20px;">
                                            <?php echo $row[2]; ?>
                                            <font style="margin-left:10px;"><?php echo " [ &nbsp;" . $row[17]; ?></font>
                                            <font class="animated fadeInRight infinite">&nbsp; -> &nbsp;</font>
                                            <font> <?php echo $row[22] . " &nbsp;] "; ?> </font>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </form> 
                    </div>
                    <div class="col-md-12" style="margin-top:20px;">
                                 <?php
                                    $seltaxi=$con->query("select sum(amount) from taxicompanyrequest where status=1 and custompackageid=$_REQUEST[id]");
                                    $selhotel=$con->query("select sum(amount) from hotelrequest where status=1 and custompackageid=$_REQUEST[id]");
                                    $taxirow= mysqli_fetch_array($seltaxi);
                                    $hotelrow= mysqli_fetch_array($selhotel);
                                    $amount=$taxirow[0]+$hotelrow[0];
                                 ?>
                        <h3>Package Amount :-</h3>
                    </div>
                    <div class="col-md-12">
                        <div style="margin:20px 0px 0px 20px;">
                            <div class="row">
                                <div class="col-md-4 text-center" style="text-transform:capitalize;">
                                    <font style="font-size:18px;">taxi approx rate</font>
                                    <div style="margin: 0 auto;width:1px;height:10px;background-color:#4E2E70;"></div>
                                    <div style="margin: 0 auto;font-size:10px;"><?php echo "<i class='fa fa-rupee'> </i> ".$taxirow[0]; ?></div>
                                </div>
                                <div class="col-md-1 text-center">
                                    <i class="fa fa-plus" style="margin-top:13px;font-size:25px;"></i>
                                </div>
                                <div class="col-md-4 text-center">
                                     <font style="font-size:18px;">Hotel approx rate</font>
                                    <div style="margin: 0 auto;width:1px;height:10px;background-color:#4E2E70;"></div>
                                    <div style="margin: 0 auto;font-size:10px;"><?php echo "<i class='fa fa-rupee'> </i> ".$hotelrow[0]; ?></div>
                                </div>
                                <div class="col-md-1 text-center">
                                    <font style="margin-top:3px;font-size:36px;">=</font>
                                </div>
                                <div class="col-md-2 text-center">
                                     <font style="font-size:18px;">Total</font>
                                    <div style="margin: 0 auto;width:1px;height:10px;background-color:#4E2E70;"></div>
                                    <div style="margin: 0 auto;font-size:10px;"><?php echo "<i class='fa fa-rupee'> </i> ".$amount; ?></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 text-center" style="margin-top:20px;">
                        <?php 
                        $customres=$con->query("SELECT * FROM custompackageresponse where custompackageid=$_REQUEST[id]");
                        $customrow= mysqli_fetch_array($customres);
                        ?>
                        <div><a target="_blank" href="<?php echo $customrow[2]; ?>" class="btn">view package pdf</a></div>
                    </div>
                </div>
        </div>
    </div>
<?php
}
?>


<?php

//static package bill

if ($_REQUEST[konidetail] == "staticpackage") 
{
    
?>
    <div class="modal-content">
        <div class="modal-header">
            <i class="fa fa-close fafado" style="float:right; color:#4E2E70;font-size:20px;" data-dismiss="modal"></i>
        </div>
        <div class="modal-body" style="padding:20px!important">
        <?php
        if($_SESSION[type]==1)
        {
            $dt=date('Y-m-d');
            $packagelavo=$con->query("select * from package where packageid=$_REQUEST[id]");
            $packagedayo= mysqli_fetch_array($packagelavo);
            $packageoffer=$con->query("select * from offer where fromdate<=curdate() and todate>=curdate() and packageid=$_REQUEST[id]");
            $packageofferdayo= mysqli_fetch_array($packageoffer);
            if(mysqli_num_rows($packageoffer)>=1)
            {
                $amount=$packagedayo[4]*$packageofferdayo[5]/100;
                $amount=$packagedayo[4]-$amount;
                $advamount= round($amount/4);
                $payamount=$amount-$advamount;
            }
            else
            {
                $amount=$packagedayo[4];
                $advamount= round($amount/4);
                $payamount=$amount-$advamount;
            }
            $sel=$con->query("SELECT * FROM booking where itemcode='static' and mixpackageid=$_REQUEST[id] and emailid='$_SESSION[user]'");
            if(mysqli_num_rows($sel)==0)
            {
                $in=$con->query("insert into booking values('$_SESSION[user]',0,$_REQUEST[id],'static','$dt','none',$advamount,$amount,$payamount)");
            }
        ?>
            <form action="" method="post" name="confirmbooking">
            <section class="invoice-wrapper">
                        <div class="container" style="width:1030px;">
                            <div class="row topbot">

                                <div class="col-md-10 px-5">
                                    <div class="row py-5">
                                        <div class="col-md-3">
                                            
                                        </div>
                                        <div class="col-md-4">
                                            <h2 class='invoice-text text-center' style="margin-left:127px">RECEIPT</h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <?php
                                            $datalavosppedma=$con->query("select * from register where emailid='$_SESSION[user]'");
                                            $dataspeddmaapo= mysqli_fetch_array($datalavosppedma);
                                            $dt=date('d-m-Y');
                                            $billgoto=$con->query("SELECT *,max(bookingid) FROM booking where mixpackageid=$_REQUEST[id] and itemcode=0 and emailid='$_SESSION[user]'");
                                            $billaapo= mysqli_fetch_array($billgoto);
                                            ?>
                                            <h4><?php echo $dataspeddmaapo[3]." ".$dataspeddmaapo[4]; ?></h4>
                                            <p>Date Issued : <?php echo $dt; ?> <br/>Invoice No : <?php echo $billaapo[9]; ?></p>
                                        </div>
                                        <div class="col-md-3 col-md-offset-5 text-right">
                                            <?php
                                            $goto = $con->query("select * from register where type=0");
                                            $aapo = mysqli_fetch_array($goto);
                                            $pachugoto = $con->query("select * from siteprofile where category=2");
                                            $pachuaapo = mysqli_fetch_array($pachugoto);
                                            $string = $pachuaapo[4];
                                            $stradd = explode(",", $string);
                                            ?>
                                            <p>The Journey<br/><?php echo $stradd[0]; ?>,<?php echo $stradd[1]; ?>,<br /><?php echo $stradd[2]; ?><?php echo $stradd[3]; ?></p>
                                        </div>
                                    </div>
                                    <div class="row py-5">
                                        <div class="col-md-12">
                                            <div class='table-responsive'>
                                                <table class='table'>
                                                    <thead>
                                                    <th>PACKAGE NAME</th>
                                                    <th style="text-align:center;">PACKAGE AMOUNT</th>
                                                    <th style="text-align:center;">ADVANCE AMOUNT</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr style="height:55px;">
                                                            <td style="width:440px;"><?php echo $packagedayo[1]; ?></td>
                                                            <td style="text-align:center;"><i class='fa fa-rupee'></i> <?php echo $amount; ?></td>
                                                            <td style="text-align:center;"class='highlighter'><i class='fa fa-rupee'></i> <?php echo $advamount; ?></td>
                                                        </tr>
                                                                <?php
                                                                $sel = $con->query("SELECT * FROM booking where itemcode='static' and mixpackageid=$_REQUEST[id] and emailid='$_SESSION[user]'");
                                                                $rowsel = mysqli_fetch_array($sel);
                                                                $selllavo = $con->query("SELECT * FROM confrimbooking where bookingid=$rowsel[1]");
                                                                if (mysqli_num_rows($selllavo) == 0) 
                                                                {
                                                                ?>
                                                        <tr style="border:none;">
                                                            <td colspan="3" style="border:none;">
                                                                <h4>Select Payment Mode</h4>
                                                                <div class="row" style="margin-top:20px; text-align:center;">
                                                                    <div class="col-md-4">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-12" title="google pay">
                                                                                        <img src="images/googlepay.png" style="width: 50px;height:50px;"/>
                                                                                    </div>
                                                                                    <div class="col-md-12" title="google pay">
                                                                                        <input type="radio" value="google pay" name="payment" checked=""/><br/>
                                                                                        <font style="letter-spacing:2px;">[ 9054946767 ]</font><br/>
                                                                                        <font style="letter-spacing:2px;">[ 8200212880 ]</font>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-4">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-12" title="amazon pay">
                                                                                        <img src="images/amazonpay.png" style="width: 50px;height:50px;"/>
                                                                                    </div>
                                                                                    <div class="col-md-12" title="amazon pay">
                                                                                        <input type="radio" value="amazon pay" name="payment" /><br>
                                                                                        <font style="letter-spacing:2px;">[ 9054946767 ]</font><br/>
                                                                                        <font style="letter-spacing:2px;">[ 8200212880 ]</font>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-4">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-12" title="phone pay">
                                                                                        <img src="images/phonepay.png" style="width: 50px;height:50px;"/>
                                                                                    </div>
                                                                                    <div class="col-md-12" title="phone pay">
                                                                                        <input type="radio" value="phone pay" name="payment"/><br>
                                                                                        <font style="letter-spacing:2px;">[ 9054946767 ]</font><br/>
                                                                                        <font style="letter-spacing:2px;">[ 8200212880 ]</font>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                                    <?php
                                                                }
                                                                ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row py-5 invoice-footer">
                                        <div class="col-md-12">
                                            <div class='table-responsive'>
                                                <table class='table'>
                                                    <thead>
                                                    <th style="text-align:center;">PAY ADVANCE AMOUNT</th>
                                                    <th style="text-align:center;width:202px;"></th>
                                                    <th style="text-align:center;"></th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td rowspan="0" style="text-align:center;"><h3 class='highlighter' rowspan="0"><i class='fa fa-rupee'></i> <?php echo $advamount;  ?></h3></td>
                                                            <td></td>
                                                            <td style="text-align:center;"> 
                                                                <?php
                                                                $sel=$con->query("SELECT * FROM booking where itemcode='static' and mixpackageid=$_REQUEST[id] and emailid='$_SESSION[user]'");
                                                                $rowsel= mysqli_fetch_array($sel);
                                                                $selllavo=$con->query("SELECT * FROM confrimbooking where bookingid=$rowsel[1]");
                                                                $statuscheck=$con->query("SELECT * FROM confrimbooking where bookingid=$rowsel[1] and status=1");
                                                                if(mysqli_num_rows($selllavo)==0)
                                                                {
                                                                ?>
                                                                    <button class="btn text-center" value="<?php echo $_REQUEST[id]; ?>" name="advanceamount">Confirm Book Now</button>
                                                                <?php 
                                                                }
                                                                elseif (mysqli_num_rows($statuscheck)>=1) 
                                                                {
                                                                ?>
                                                                    <a href="#">Check Your Booking</a>
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                    <h3 style="font-weight:lighter;">Waiting For Confirmation Email</h3>
                                                                <?php    
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
            </form>
        <?php
        }
        else 
        {
        ?>
            <img src="images/planbill.gif" style="height:510px;width:100%;"/>  
            <h1 style="position:absolute;top:44px;left:49px;font-weight:lighter;" class="animated infinite fadeIn">Please Login First ! . . . <a href="login.php">Login</a></h1>
        <?php    
        }
        ?>
        </div>
    </div>
<?php
}

?>

<?php

//custom package bill

if ($_REQUEST[konidetail] == "custompackagebill") 
{
    
?>
    <div class="modal-content">
        <div class="modal-header">
            <i class="fa fa-close fafado" style="float:right; color:#4E2E70;font-size:20px;" data-dismiss="modal"></i>
        </div>
        <div class="modal-body" style="padding:20px!important">
        <?php
        if($_SESSION[type]==1)
        {
            $dt=date('Y-m-d');
            $packagelavo=$con->query("SELECT * FROM custompackageresponse cu,custompackage c where c.custompackageid=cu.custompackageid and c.custompackageid=$_REQUEST[id]");
            $packagedayo= mysqli_fetch_array($packagelavo);
            $amount=$packagedayo[3];
            $advamount= round($amount/4);
            $payamount=$amount-$advamount;
                
            $sel=$con->query("SELECT * FROM booking where itemcode='custom' and mixpackageid=$_REQUEST[id] and emailid='$_SESSION[user]'");
            if(mysqli_num_rows($sel)==0)
            {
                $in=$con->query("insert into booking values('$_SESSION[user]',0,$_REQUEST[id],'custom','$dt','none',$advamount,$amount,$payamount)");
            }
        ?>
            <form action="" method="post" name="confirmbooking">
            <section class="invoice-wrapper">
                        <div class="container" style="width:1030px;">
                            <div class="row topbot">

                                <div class="col-md-10 px-5">
                                    <div class="row py-5">
                                        <div class="col-md-3">
                                            
                                        </div>
                                        <div class="col-md-4">
                                            <h2 class='invoice-text text-center' style="margin-left:127px">RECEIPT</h2>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <?php
                                            $datalavosppedma=$con->query("select * from register where emailid='$_SESSION[user]'");
                                            $dataspeddmaapo= mysqli_fetch_array($datalavosppedma);
                                            $dt=date('d-m-Y');
                                            $billgoto=$con->query("SELECT *,max(bookingid) FROM booking where mixpackageid=$_REQUEST[id] and itemcode=0 and emailid='$_SESSION[user]'");
                                            $billaapo= mysqli_fetch_array($billgoto);
                                            ?>
                                            <h4><?php echo $dataspeddmaapo[3]." ".$dataspeddmaapo[4]; ?></h4>
                                            <p>Date Issued : <?php echo $dt; ?> <br/>Invoice No : <?php echo $billaapo[9]; ?></p>
                                        </div>
                                        <div class="col-md-3 col-md-offset-5 text-right">
                                            <?php
                                            $goto = $con->query("select * from register where type=0");
                                            $aapo = mysqli_fetch_array($goto);
                                            $pachugoto = $con->query("select * from siteprofile where category=2");
                                            $pachuaapo = mysqli_fetch_array($pachugoto);
                                            $string = $pachuaapo[4];
                                            $stradd = explode(",", $string);
                                            ?>
                                            <p>The Journey<br/><?php echo $stradd[0]; ?>,<?php echo $stradd[1]; ?>,<br /><?php echo $stradd[2]; ?><?php echo $stradd[3]; ?></p>
                                        </div>
                                    </div>
                                    <div class="row py-5">
                                        <div class="col-md-12">
                                            <div class='table-responsive'>
                                                <table class='table'>
                                                    <thead>
                                                    <th>PACKAGE NAME</th>
                                                    <th style="text-align:center;">PACKAGE AMOUNT</th>
                                                    <th style="text-align:center;">ADVANCE AMOUNT</th>
                                                    </thead>
                                                    <tbody>
                                                        <tr style="height:55px;">
                                                            <td style="width:440px;"><?php echo $packagedayo[11]; ?></td>
                                                            <td style="text-align:center;"><i class='fa fa-rupee'></i> <?php echo $amount; ?></td>
                                                            <td style="text-align:center;"class='highlighter'><i class='fa fa-rupee'></i> <?php echo $advamount; ?></td>
                                                        </tr>
                                                                <?php
                                                                $sel = $con->query("SELECT * FROM booking where itemcode='custom' and mixpackageid=$_REQUEST[id] and emailid='$_SESSION[user]'");
                                                                $rowsel = mysqli_fetch_array($sel);
                                                                $selllavo = $con->query("SELECT * FROM confrimbooking where bookingid=$rowsel[1]");
                                                                if (mysqli_num_rows($selllavo) == 0) 
                                                                {
                                                                ?>
                                                        <tr style="border:none;">
                                                            <td colspan="3" style="border:none;">
                                                                <h4>Select Payment Mode</h4>
                                                                <div class="row" style="margin-top:20px; text-align:center;">
                                                                    <div class="col-md-4">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-12" title="google pay">
                                                                                        <img src="images/googlepay.png" style="width: 50px;height:50px;"/>
                                                                                    </div>
                                                                                    <div class="col-md-12" title="google pay">
                                                                                        <input type="radio" value="google pay" name="payment" checked=""/><br/>
                                                                                        <font style="letter-spacing:2px;">[ 9054946767 ]</font><br/>
                                                                                        <font style="letter-spacing:2px;">[ 8200212880 ]</font>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-4">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-12" title="amazon pay">
                                                                                        <img src="images/amazonpay.png" style="width: 50px;height:50px;"/>
                                                                                    </div>
                                                                                    <div class="col-md-12" title="amazon pay">
                                                                                        <input type="radio" value="amazon pay" name="payment" /><br>
                                                                                        <font style="letter-spacing:2px;">[ 9054946767 ]</font><br/>
                                                                                        <font style="letter-spacing:2px;">[ 8200212880 ]</font>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    <div class="col-md-4">
                                                                        <div class="row">
                                                                            <div class="col-md-12">
                                                                                <div class="row">
                                                                                    <div class="col-md-12" title="phone pay">
                                                                                        <img src="images/phonepay.png" style="width: 50px;height:50px;"/>
                                                                                    </div>
                                                                                    <div class="col-md-12" title="phone pay">
                                                                                        <input type="radio" value="phone pay" name="payment"/><br>
                                                                                        <font style="letter-spacing:2px;">[ 9054946767 ]</font><br/>
                                                                                        <font style="letter-spacing:2px;">[ 8200212880 ]</font>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <?php
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row py-5 invoice-footer">
                                        <div class="col-md-12">
                                            <div class='table-responsive'>
                                                <table class='table'>
                                                    <thead>
                                                    <th style="text-align:center;">PAY ADVANCE AMOUNT</th>
                                                    <th style="text-align:center;width:202px;"></th>
                                                    <th style="text-align:center;"></th>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td rowspan="0" style="text-align:center;"><h3 class='highlighter' rowspan="0"><i class='fa fa-rupee'></i> <?php echo $advamount;  ?></h3></td>
                                                            <td></td>
                                                            <td style="text-align:center;"> 
                                                                <?php
                                                                $sel=$con->query("SELECT * FROM booking where itemcode='custom' and mixpackageid=$_REQUEST[id] and emailid='$_SESSION[user]'");
                                                                $rowsel= mysqli_fetch_array($sel);
                                                                $selllavo=$con->query("SELECT * FROM confrimbooking where bookingid=$rowsel[1]");
                                                                $statuscheck=$con->query("SELECT * FROM confrimbooking where bookingid=$rowsel[1] and status=1");
                                                                if(mysqli_num_rows($selllavo)==0)
                                                                {
                                                                ?>
                                                                    <button class="btn text-center" value="<?php echo $_REQUEST[id]; ?>" name="customadvanceamount">Confirm Book Now</button>
                                                                <?php 
                                                                }
                                                                elseif (mysqli_num_rows($statuscheck)>=1) 
                                                                {
                                                                ?>
                                                                    <a href="#">Check Your Booking</a>
                                                                <?php
                                                                }
                                                                else
                                                                {
                                                                ?>
                                                                    <h3 style="font-weight:lighter;">Waiting For Confirmation Email</h3>
                                                                <?php    
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </section>
            </form>
        <?php
        }
        else 
        {
        ?>
            <img src="images/planbill.gif" style="height:510px;width:100%;"/>  
            <h1 style="position:absolute;top:44px;left:49px;font-weight:lighter;" class="animated infinite fadeIn">Please Login First ! . . .</h1>
        <?php    
        }
        ?>
        </div>
    </div>
<?php
}
?>

<?php

//custom package bill display

if ($_REQUEST[konidetail] == "custompackagebilldisplay") {
?>    <div class="modal-content">
                <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="spe-title cus-title" style="margin-top:10px;">
                                        <h2 style="color:#4E2E70;">Package <span> Bill</span></h2>
                                        <div class="title-line">
                                            <div class="tl-1"></div>
                                            <div class="tl-2"><i class="fa fa-gg" style="color:#FF0049;"></i></div>
                                            <div class="tl-3"></div>
                                        </div>
                                    </div>
                        <i class="fa fa-close fafado" style="float:right; color:#4E2E70;font-size:20px;position:absolute;right:30px;top:25px;" data-dismiss="modal"></i>
                                    </div>
                                    <div class="col-md-12">
                                        <section class="invoice-wrapper" id="custombillprint">
                                    <div class="container" style="width:1030px;">
                                        <div class="row topbot">

                                            <div class="col-md-10 px-5">
                                                <div class="row py-5">
                                                    <div class="col-md-3">
                                                       <img src="images/logo.png" class="img-responsive" style="height:50px; width:200px;" /> 
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h2 class='invoice-text text-center' style="margin-left:127px">RECEIPT</h2>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
    <?php
    $datalavosppedma = $con->query("select * from register where emailid='$_SESSION[user]'");
    $dataspeddmaapo = mysqli_fetch_array($datalavosppedma);
    $dt = date('d-m-Y');
    $custompackage = $con->query("SELECT * FROM billhistory where itemcode='custom' and mixpackageid=$_REQUEST[id]");
    $custompackagerow = mysqli_fetch_array($custompackage);
    $billgoto = $con->query("SELECT * FROM custompackage where custompackageid=$_REQUEST[id]");
    $billaapo = mysqli_fetch_array($billgoto);
    ?>
                                                        <h4><?php echo $dataspeddmaapo[3] . " " . $dataspeddmaapo[4]; ?></h4>
                                                        <p>Date Issued : <?php echo $custompackagerow[5]; ?> <br/>Invoice No : <?php echo $custompackagerow[2]; ?></p>
                                                    </div>
                                                    <div class="col-md-3 col-md-offset-5 text-right">
    <?php
    $goto = $con->query("select * from register where type=0");
    $aapo = mysqli_fetch_array($goto);
    $pachugoto = $con->query("select * from siteprofile where category=2");
    $pachuaapo = mysqli_fetch_array($pachugoto);
    $string = $pachuaapo[4];
    $stradd = explode(",", $string);
    ?>
                                                        <p>The Journey<br/><?php echo $stradd[0]; ?>,<?php echo $stradd[1]; ?>,<br /><?php echo $stradd[2]; ?><?php echo $stradd[3]; ?></p>
                                                    </div>
                                                </div>
                                                <div class="row py-5">
                                                    <div class="col-md-12">
                                                        <div class='table-responsive'>
                                                            <table class='table'>
                                                                <thead>
                                                                <th>PACKAGE Category</th>
                                                                <th style="text-align:center;">PACKAGE AMOUNT</th>
                                                                <th style="text-align:center;">ADVANCE AMOUNT</th>
                                                                </thead>
                                                                <tbody>
    <?php
    $packamount = $con->query("select * from custompackageresponse where custompackageid=$_REQUEST[id]");
    $packamountrow = mysqli_fetch_row($packamount);
    $amount = $packamountrow[3];
    $advamount = round($amount / 4);
    $payamount = $amount - $advamount;
    ?>
                                                                    <tr style="height:55px;">
                                                                        <td style="width:440px;"><?php echo $billaapo[7]; ?></td>
                                                                        <td style="text-align:center;"><i class='fa fa-rupee'></i> <?php echo $amount; ?></td>
                                                                        <td style="text-align:center;"class='highlighter'><i class='fa fa-rupee'></i> <?php echo $advamount; ?></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-5 invoice-footer">
                                                <div class="col-md-12">
                                                    <div class='table-responsive'>
                                                        <table class='table'>
                                                            <thead>
                                                            <th>SIGNATURE</th>
                                                            <th>PAYMODE</th>
                                                            <th>PAYABLE AMOUNT</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class='img-responsive' rowspan="0"><img src='images/signature.png' height="30px" style="padding-top:10px;" width="auto" /></td>
                                                                    <td>Account No : 58890100003332<br/>IFSC Code : BARBOLHROAD</td>
                                                                    <td rowspan="0"><h3 class='highlighter' rowspan="0"><i class='fa fa-rupee'></i> <?php
    $gst = $payamount * 5 / 100;
    echo $gst + $payamount;
    ?></h3>(5% GST include)</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 py-3">
                                                    <div class='row justify-content-between'>
                                                        <div class='col-md-4'>
                                                            <h4 class='font-weight-light'><i class='fa fa-heart pr-3'></i> Thanks for booking &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;package</h4>
                                                        </div>
                                                        <div class='col-md-8'>
                                                            <ul class="info-invoice">
                                                                <li class="d-inline px-3"><?php echo $pachuaapo[3]; ?></li>
                                                                <li class="d-inline px-3"><?php echo $pachuaapo[1]; ?></li>
                                                                <li class="d-inline px-3"><?php echo substr($pachuaapo[7], 7); ?></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12" style="position:relative;">
                                                    <div style="position:absolute; right:20px;">
                                                        <i class="fa fa-print" style="font-size:20px;" onclick="printleva('custombillprint');" title="print bill Now !.."></i>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>

                                        </div>
                                    </div>
                                </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
    <?php
}
    ?>



<?php

//static package bill display

if ($_REQUEST[konidetail] == "staticpackagebilldisplay") {
?>    <div class="modal-content">
                <div class="modal-body">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="spe-title cus-title" style="margin-top:10px;">
                                        <h2 style="color:#4E2E70;">Package <span> Bill</span></h2>
                                        <div class="title-line">
                                            <div class="tl-1"></div>
                                            <div class="tl-2"><i class="fa fa-gg" style="color:#FF0049;"></i></div>
                                            <div class="tl-3"></div>
                                        </div>
                                    </div>
                        <i class="fa fa-close fafado" style="float:right; color:#4E2E70;font-size:20px;position:absolute;right:30px;top:25px;" data-dismiss="modal"></i>
                                    </div>
                                    <div class="col-md-12">
                                    <section class="invoice-wrapper" id="staticbillprint">
                                    <div class="container" style="width:1030px;">
                                        <div class="row topbot">

                                            <div class="col-md-10 px-5">
                                                <div class="row py-5">
                                                    <div class="col-md-3">
                                                       <img src="images/logo.png" class="img-responsive" style="height:50px; width:200px;" /> 
                                                    </div>
                                                    <div class="col-md-4">
                                                        <h2 class='invoice-text text-center' style="margin-left:127px">RECEIPT</h2>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
    <?php
    $datalavosppedma = $con->query("select * from register where emailid='$_SESSION[user]'");
    $dataspeddmaapo = mysqli_fetch_array($datalavosppedma);
    $dt = date('d-m-Y');
    $custompackage = $con->query("SELECT * FROM billhistory where itemcode='static' and mixpackageid=$_REQUEST[id]");
    $custompackagerow = mysqli_fetch_array($custompackage);
    $billgoto = $con->query("SELECT * FROM package where packageid=$_REQUEST[id]");
    $billaapo = mysqli_fetch_array($billgoto);
    ?>
                                                        <h4><?php echo $dataspeddmaapo[3] . " " . $dataspeddmaapo[4]; ?></h4>
                                                        <p>Date Issued : <?php echo $custompackagerow[5]; ?> <br/>Invoice No : <?php echo $custompackagerow[2]; ?></p>
                                                    </div>
                                                    <div class="col-md-3 col-md-offset-5 text-right">
    <?php
    $goto = $con->query("select * from register where type=0");
    $aapo = mysqli_fetch_array($goto);
    $pachugoto = $con->query("select * from siteprofile where category=2");
    $pachuaapo = mysqli_fetch_array($pachugoto);
    $string = $pachuaapo[4];
    $stradd = explode(",", $string);
    ?>
                                                        <p>The Journey<br/><?php echo $stradd[0]; ?>,<?php echo $stradd[1]; ?>,<br /><?php echo $stradd[2]; ?><?php echo $stradd[3]; ?></p>
                                                    </div>
                                                </div>
                                                <div class="row py-5">
                                                    <div class="col-md-12">
                                                        <div class='table-responsive'>
                                                            <table class='table'>
                                                                <thead>
                                                                <th>PACKAGE Name</th>
                                                                <th style="text-align:center;">PACKAGE AMOUNT</th>
                                                                <th style="text-align:center;">ADVANCE AMOUNT</th>
                                                                </thead>
                                                                <tbody>
    <?php
    $packamount = $con->query("SELECT * FROM billhistory where itemcode='static' and mixpackageid=$_REQUEST[id]");
    $packamountrow = mysqli_fetch_row($packamount);
    $amount = $packamountrow[8];
    $advamount = round($amount / 4);
    $payamount = $amount - $advamount;
    ?>
                                                                    <tr style="height:55px;">
                                                                        <td style="width:440px;"><?php echo $billaapo[1]; ?></td>
                                                                        <td style="text-align:center;"><i class='fa fa-rupee'></i> <?php echo $amount; ?></td>
                                                                        <td style="text-align:center;"class='highlighter'><i class='fa fa-rupee'></i> <?php echo $advamount; ?></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row py-5 invoice-footer">
                                                <div class="col-md-12">
                                                    <div class='table-responsive'>
                                                        <table class='table'>
                                                            <thead>
                                                            <th>SIGNATURE</th>
                                                            <th>PAYMODE</th>
                                                            <th>PAYABLE AMOUNT</th>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td class='img-responsive' rowspan="0"><img src='images/signature.png' height="30px" style="padding-top:10px;" width="auto" /></td>
                                                                    <td>Account No : 58890100003332<br/>IFSC Code : BARBOLHROAD</td>
                                                                    <td rowspan="0"><h3 class='highlighter' rowspan="0"><i class='fa fa-rupee'></i> <?php
    $gst = $payamount * 5 / 100;
    echo $gst + $payamount;
    ?></h3>(5% GST include)</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 py-3">
                                                    <div class='row justify-content-between'>
                                                        <div class='col-md-4'>
                                                            <h4 class='font-weight-light'><i class='fa fa-heart pr-3'></i> Thanks for booking &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;package</h4>
                                                        </div>
                                                        <div class='col-md-8'>
                                                            <ul class="info-invoice">
                                                                <li class="d-inline px-3"><?php echo $pachuaapo[3]; ?></li>
                                                                <li class="d-inline px-3"><?php echo $pachuaapo[1]; ?></li>
                                                                <li class="d-inline px-3"><?php echo substr($pachuaapo[7], 7); ?></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            <div class="col-md-12" style="position:relative;">
                                                <div style="position:absolute; right:20px;">
                                                    <i class="fa fa-print" style="font-size:20px;" onclick="printleva('staticbillprint');" title="print bill Now !.."></i>
                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                                    </div>
                                </div>
                            </div>
                        </div>
                  </div>
    <?php
}
    ?>
