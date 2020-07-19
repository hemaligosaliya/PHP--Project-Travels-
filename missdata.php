<?php
require_once './connection.php';
require_once './PHPMailerAutoload.php';
//print_r($_REQUEST);



if($_REQUEST[shu]=="captcha")
{
   $ek=rand(0,9);
   $be=rand(11,99);
   $tran=chr(rand(97,122));
   $char=rand(0,9);
   $pach=chr(rand(65,90));
   $final=$ek.$be.$tran.$char.$pach;
   echo $final;
}
?>

<?php
//slider search


if($_REQUEST[shu]=="mainsearch")
{
 ?>
    <ul>
        <?php
        $sel=$con->query("select * from package where name like '$_REQUEST[id]%'");
        if(mysqli_num_rows($sel))
        {
            ?>
            <li><h5>Packages</h5></li>
            <?php
                 while($row= mysqli_fetch_array($sel))
                {
                ?>
                <a href="packagedetails.php?packageid=<?php echo $row[0]; ?>"><li style="text-align:left;"><font><?php echo $row[1]; ?></font><img style="float:right;height:22px;width:29px;margin-right:30px;" src="<?php echo $row[5]; ?>"/></li></a>
                <?php
                }   
        }
        $goto=$con->query("select * from hotel where name like '$_REQUEST[id]%'");
        if(mysqli_num_rows($goto)>=1)
        {
         ?>
            <li><h5>Hotels</h5></li>
         <?php
          while($aapo= mysqli_fetch_array($goto))
          {
          ?>
            <a href="hotel-details.php?hotelid=<?php echo $aapo[1]; ?>"><li style="text-align:left;"><font><?php echo $aapo[2]; ?></font><img style="float:right;height:22px;width:29px;margin-right:30px;" src="<?php echo $aapo[9]; ?>"/></li></a>
          <?php
          }
        }
        if(mysqli_num_rows($sel)==0 && mysqli_num_rows($goto)==0)
        {
        ?>
            <li><h3 style="color:black;">No records Found !...</h3></li>
        <?php    
        }
        ?>
    </ul>
<?php
}

?>


<?php

//searching sorting

$str="";
if(isset ($_REQUEST[place]))
{
    $str=$str."placeid in(";
    foreach ($_REQUEST[place] as $val)
    {
        $str=$str . $val . ",";
    }
    $str=rtrim($str,",");
    $str=$str . ")";
}

if(isset ($_REQUEST[placepoint]))
{
    if($str!="")
    {
        $str=$str." and ";
    }
    $str=$str."pointid in(";
    foreach ($_REQUEST[placepoint] as $val)
    {
        $str=$str . $val . ",";
    }
    $str=rtrim($str,",");
    $str=$str . ")";
}

if($_REQUEST[konu]=="productdata")
{
    if($str!="")
    {
        if($_REQUEST[ketla]==0)
        {
            $selpro=$con->query("select * from packageplace where $str  group by packageid");
            $s=$con->query("select count(*) from packageplace where $str  group by packageid");
            $ss= mysqli_fetch_array($s);
        }
        else
        {
            $selpro=$con->query("select * from packageplace group by packageid");
            $s=$con->query("select count(*) from packageplace group by packageid");
            $ss= mysqli_fetch_array($s); 
        }
    }
    else
    {
            $selpro=$con->query("select * from packageplace group by packageid");
            $s=$con->query("select count(*) from packageplace group by packageid");
            $ss= mysqli_fetch_array($s);
    }
?>
        <div class="hot-page2-alp-con-right-1">
                                    <!--LISTINGS-->
                                    <div class="row">
                                        <!--LISTINGS START-->
                                        <?php
                                        $i=0;
                                        if($ss[0]!=0)
                                        {
                                            while($selprodata= mysqli_fetch_array($selpro))
                                            {   
                                                $datalavo = $con->query("select * from package p,schedule s,packageplace pp where p.packageid=s.packageid and p.status=1 and p.packageid=pp.packageid and pp.packageplaceid=$selprodata[3]");
                                                $rowlavo = mysqli_fetch_array($datalavo);
                                                $i++;
                                            ?>
                                            <div class="hot-page2-alp-r-list">
                                                <div class="col-md-3 hot-page2-alp-r-list-re-sp">
                                                    <a href="packagedetails.php?packageid=<?php echo $rowlavo[0]; ?>">
                                                        <div class="hot-page2-hli-1"> <img src="<?php echo $rowlavo[5]; ?>" alt=""> </div>
                                                    </a>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="trav-list-bod">
                                                        <a href="packagedetails.php?packageid=<?php echo $rowlavo[0]; ?>"><h3 style="text-transform:capitalize;"><?php echo $rowlavo[1]; ?></h3></a>
                                                        <?php
                                                        $starlavo = $con->query("SELECT * FROM rate where packageid=$rowlavo[0]");
                                                        $stardayo = mysqli_fetch_array($starlavo);
                                                        ?>
                                                        <p>
                                                            <?php
                                                            for ($i = 1; $i <= $stardayo[3]; $i++) {
                                                                ?>
                                                                <i class="fa fa-star" style="color:#Faa600;padding:4px;"></i>
                                                                <?php
                                                            }
                                                            ?>
                                                        </p>
                                                        <?php
                                                        $placelavo = $con->query("SELECT pp.*,p.* FROM packageplace pp,place p where p.placeid=pp.placeid and packageid=$rowlavo[0]");
                                                        $placeapo = mysqli_fetch_array($placelavo);
                                                        $offer = $con->query("select * from offer where fromdate<=curdate() and todate>=curdate() and packageid=$rowlavo[0]");
                                                        $offerrow = mysqli_fetch_array($offer);
                                                        ?>
                                                        <p><?php echo substr($placeapo[7], 0, 180) ?></p>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <?php
                                                    if ($offerrow[0] == "") {
                                                        ?>
                                                        <div class="hot-page2-alp-ri-p3 tour-alp-ri-p3" style="padding-top:35px;">
                                                            <span class="hot-list-p3-1">Package Price</span> 
                                                            <span class="hot-list-p3-2"><i class="fa fa-rupee"></i>
                                                                <?php echo $rowlavo[4]; ?>
                                                            </span>
                                                            <span class="hot-list-p3-4">
                                                                <a href="packagedetails.php?packageid=<?php echo $rowlavo[0]; ?>" class="hot-page2-alp-quot-btn">view detail</a>
                                                            </span> 
                                                        </div>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <div class="hot-page2-alp-ri-p3 tour-alp-ri-p3" style="padding-top:35px;">
                                                            <div class="hot-page2-alp-r-hot-page-rat"><?php echo $offerrow[5] . "% off"; ?></div> 
                                                            <span class="hot-list-p3-1">Package Price</span> 
                                                            <span class="hot-list-p3-2"><i class="fa fa-rupee"></i>
                                                                <?php
                                                                    $a=$rowlavo[4]*$offerrow[5]/100;
                                                                    echo $ag=$rowlavo[4]-$a;
                                                                ?>
                                                                <strike style="font-size:10px;color:black;" >[ <?php echo $rowlavo[4]; ?> ]</strike>
                                                            </span>
                                                            <span class="hot-list-p3-4">
                                                                <a href="packagedetails.php?packageid=<?php echo $rowlavo[0]; ?>" class="hot-page2-alp-quot-btn">view detail</a>
                                                            </span> 
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>

                                                </div>
                                                <div>
                                                    <div class="trav-ami">
                                                        <h4>Detail and Services</h4>
                                                        <ul>
                                                            <li><img src="images/icon/a14.png" alt=""> <span>Sightseeing</span></li>
                                                            <li><img src="images/icon/a15.png" alt=""> <span>Hotel</span></li>
                                                            <li><?php
                                                                if ($rowlavo[15] == "aeroplan") {
                                                                    ?>
                                                                    <img src="images/plane.png" height="20px" alt=""> <span>Go By</span>
                                                                    <?php
                                                                } elseif ($rowlavo[15] == "bus") {
                                                                    ?>
                                                                    <img src="images/icon/a16.png" height="20px" alt=""> <span>Go By</span>
                                                                    <?php
                                                                } elseif ($rowlavo[15] == "train") {
                                                                    ?>
                                                                    <img src="images/train.png" height="20px" alt=""> <span>Go By</span>
                                                                    <?php
                                                                } elseif ($rowlavo[15] == "car") {
                                                                    ?>
                                                                    <img src="images/car.png" height="20px" alt=""> <span>Go By</span>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </li>
                                                            <li>
                                                                <?php
                                                                if ($rowlavo[16] == "aeroplan") {
                                                                    ?>
                                                                    <img src="images/plane.png" height="20px" alt=""> <span>Return By</span>
                                                                    <?php
                                                                } elseif ($rowlavo[16] == "bus") {
                                                                    ?>
                                                                    <img src="images/icon/a16.png" height="20px" alt=""> <span>Return By</span>
                                                                    <?php
                                                                } elseif ($rowlavo[16] == "train") {
                                                                    ?>
                                                                    <img src="images/train.png" height="20px" alt=""> <span>Return By</span>
                                                                    <?php
                                                                } elseif ($rowlavo[16] == "car") {
                                                                    ?>
                                                                    <img src="images/car.png" height="20px" alt=""> <span>Return By</span>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </li>
                                                            <li><img src="images/icon/a18.png" alt=""> <span>Duration <?php echo $rowlavo[3]; ?>N/<?php echo $rowlavo[2]; ?>D</span></li>
                                                            <li><img src="images/icon/a19.png" alt=""> <span>Location : <?php echo $placeapo[6]; ?></span></li>
                                                            <li><img src="images/icon/dbl4.png" alt=""> <span>Stay Plan</span></li>
                                                        </ul>
                                                    </div>	
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        }
                                        else
                                        {
                                        ?>
                                            <h1>Not Found !..</h1>
                                        <?php
                                        }
                                        ?>
                                        <!--END LISTINGS-->
                                    </div>
                                </div>
<?php
}
?>

<?php

//mail file
    function sendmail($email,$sms,$subject)
    {
  
        $mail = new PHPMailer;

        $mail->isSMTP();

        $mail->SMTPDebug = 0;

        //Ask for HTML-friendly debug output
        $mail->Debugoutput = 'html';

        //Set the hostname of the mail server
        $mail->Host = 'smtp.gmail.com';

        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $mail->Port = 587;

        //Set the encryption system to use - ssl (deprecated) or tls
        $mail->SMTPSecure = 'tls';

        //Whether to use SMTP authentication
        $mail->SMTPAuth = true;

        //Username to use for SMTP authentication - use full email address for gmail
        $mail->Username = "bhautikdomz@gmail.com";

        //Password to use for SMTP authentication
        $mail->Password = "bhautik123";

        //Set who the message is to be sent from
        $mail->setFrom('bhautikdomz@gmail.com', 'thejourney');

        //Set an alternative reply-to address
        $mail->addReplyTo('bhautikdomz@gmail.com', 'thejourney');

        //Set who the message is to be sent to
        $mail->addAddress($email, 'thejourney');

        //Set the subject line
        $mail->Subject = $subject;

        //Read an HTML message body from an external file, convert referenced images to embedded,
        //convert HTML into a basic plain-text alternative body
        $message=$sms;
        $mail->msgHTML($message, dirname(__FILE__));

        //Replace the plain text body with one created manually
        $mail->AltBody = 'BAJIRAO';

        //Attach an image file
        //$mail->addAttachment('images/phpmailer_mini.png');

        //send the message, check for errors
        if (!$mail->send()) 
        {
            $done=1;
            echo "Mailer Error: " . $mail->ErrorInfo;
        } 
        else
        {
            $done=2;
        }
    }


//end mail


?>

<!--combo start  -->

<?php

   //customplace

    if ($_REQUEST[konu] == "customplace") 
    {
        ?>
<div class="row">
    <form action="" name="customplaceassign" method="post" onsubmit="return(checkcheckbox());">
        <?php
        $a=0;
        $sel=$con->query("select * from place where cityid=$_REQUEST[id] and placeid not in(select placeid from placeassign where custompackageid=$_REQUEST[custom])");
        while($row=mysqli_fetch_array($sel))
        {
            $a++;
        ?>
            <div class="col-md-4 text-center">
                <div>
                    <img src="<?php echo $row[4]; ?>" height="150px" width="150px" style="border-top:8px solid #2A3C54;"/>
                </div>
                <div class="checkbox checkbox-info checkbox-circle">
                    <input id="custom<?php echo $a; ?>" class="styled checkboxpadding" name="placeid[]" type="checkbox" value="<?php echo $row[1]; ?>">
                    <label for="custom<?php echo $a; ?>" class="checkboxpadding active"><font style="padding-left:10px;font-weight:700;"><?php echo $row[2]; ?></font></label>
                    <span></span>
                </div>
                
            </div>
        <?php 
        }
        if($a>=1)
        {
        ?>
        <div class="col-md-12 text-center">
            <button  style="width:50%;background:#4E2E70!important;color:white;font-weight:1000;"  name="sendplaceassign" class="text-center btn">Assign Now</button>
        </div>
        <?php
        }
        ?>
    </form>
</div>
        <?php
    }

    //state

    if ($_REQUEST[konu] == "state") 
    {
        ?>
            <option value="" disabled="" selected="">Select State</option>
         <?php
        $datasel = $con->query("select * from state where countryid=$_REQUEST[id]");
        while ($rowsel = mysqli_fetch_array($datasel)) 
        {
            ?>
                    <option  value="<?php echo $rowsel[1]; ?>"><?php echo $rowsel[2]; ?></option>
            <?php
        }
    }
    
    //city
        
    if ($_REQUEST[konu] == "city") 
    {
        ?>
            <option value="" disabled="" selected="">Select city</option>
         <?php
        $datasel = $con->query("select * from city where stateid=$_REQUEST[id]");
        while ($rowsel = mysqli_fetch_array($datasel)) 
        {
            ?>
                    <option  value="<?php echo $rowsel[1]; ?>"><?php echo $rowsel[2]; ?></option>
            <?php
        }
    }
    
    
     //place
    

    if ($_REQUEST[konu] == "placetaxi") 
    {
        ?>
            <option value="" disabled="" selected="">Select place</option>
         <?php
        $datasel = $con->query("select * from place where cityid=$_REQUEST[id]");
        while ($rowsel = mysqli_fetch_array($datasel)) 
        {
            ?>
                    <option  value="<?php echo $rowsel[1]; ?>"><?php echo $rowsel[2]; ?></option>
            <?php
        }
    }

    
    //place point index
    

    if ($_REQUEST[konu] == "pointgoto") 
    {
    ?>
                    <tr>
                        <th style="text-align:center;">No</th>
                        <th style="text-align:center;">Place Point</th>
                        <th style="width:10%;" style="text-align:center;">Center Point km</th>
                        <th style="text-align:center;">Brief History</th>
                    </tr>
                    <?php
                    $place=$con->query("select * from country co,state s,city c,place p,placepoint po where p.placeid=po.placeid and p.cityid=c.cityid and c.stateid=s.stateid and s.countryid=co.countryid and p.placeid=$_REQUEST[id]");
                    $placecnt=0;
                    while($placeaapo=mysqli_fetch_array($place))
                    {
                        $placecnt++;
                    ?>
                    <tr>
                        <td style="text-align:center;"><?php echo $placecnt; ?></td>
                        <td style="text-align:center;"><img src="<?php echo $placeaapo[18]; ?>" alt="" /><a href="javascript:void(0)" class="events-title"><?php echo $placeaapo[15]; ?></a> </td>
                        <td style="text-align:center;"><?php echo $placeaapo[16]." "."km"; ?></td>
                        <td class="e_h1" style="text-align:center;"><?php echo $placeaapo[17]; ?></td>
                    </tr>
                    <?php
                    }
                    ?>
    <?php
    }
    
    //package
    
    if($_REQUEST[konu] == "package")
    {
       ?>
                    <form action="" method="post">
                        <div  class="row packageplacebox">
                        <?php
                        $data=$con->query("select * from place where cityid=$_REQUEST[id]");
                        while($row=  mysqli_fetch_array($data))
                        {
                        ?>
                                <div class="col-md-4">
                                    <img src="../<?php echo $row[4]; ?>"/>
                                    <div style="text-align:center;">
                                        <input id="list-title<?php echo $row[1]; ?>" required="" type="radio" name="placeid" value="<?php echo $row[1];?>" class="with-gap" onclick="selectleva('place',<?php echo $row[1]; ?>)">
                                        <label for="list-title<?php echo $row[1]; ?>" ><?php echo $row[2]; ?></label>
                                    </div>
                                </div>
                            
                       <?php
                        }
                       ?>
                        </div>
                    </form>
       <?php
    }
    
    
    //point
    
    if($_REQUEST[konu] == "place")
    {
        ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3>Select placepoint<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <a style="color:#FF0049;" class="print" onclick="takedata('package place','assign',<?php echo $_SESSION[packageid]; ?>);"><i class="fa fa-backward"  style="color:#FF0049;"></i> Back</a>
                        </div>
                    </div>
                    <form action="" method="post">
                            <div  class="row packageplacebox" id="divassign">
                        <?php
                        $data=$con->query("select * from placepoint where placeid=$_REQUEST[id]");
                        $_SESSION[placeid]=$_REQUEST[id];
                        while($row=  mysqli_fetch_array($data))
                        {
                            $sel=$con->query("select * from packageplace where packageid=$_SESSION[packageid] and pointid=$row[1]");
                            $sell=  mysqli_fetch_array($sel);
                            if($sell[0]=="")
                            {
                        ?>
                                 
                                <div class="col-md-4">
                                    <img src="../<?php echo $row[5]; ?>"/>
                                    <div style="text-align:center;">
                                        <input id="list-title<?php echo $row[1]; ?>" type="checkbox" name="pointid[]" value="<?php echo $row[1];?>" class="with-gap">
                                        <label for="list-title<?php echo $row[1]; ?>" ><?php echo $row[2]; ?></label>
                                    </div>
                                </div>
                           
                       <?php
                            }
                        }
                       ?>
                           </div>
                        <div class="row">
                            <?php
                            if(mysqli_num_rows($data)>=1)
                            {
                            ?>
                            <div class="col-md-12" style="padding-top:20px;">
                            <button type="submit" id="sendassign" class="btn" name="sendpackageplace">Send place point</button>
                            </div>
                            <?php 
                            }
                            else
                            {
                                ?>
                            <h5 style="padding-left:50px; padding-bottom:20px;">already all the place points of current place is selected!..</h5>
                                        <video src="../video/norecord.mp4" loop="" autoplay="" style="height:200px;width:100%;"></video>
                                <?php
                            }
                            ?>
                        </div>
                    </form>
                     
       <?php
    }
?>
                
                    

<!-- combo end -->


    <!-- Manage  advance payment -->

<?php
    
   if($_REQUEST[shu]=="advancepayment")
   {
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           
       }
       
       $count=$con->query("select count(*) from billhistory");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[client]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
               
               
           }

       ?>
       
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?> </span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                        </div>
                    </div>
        </div>
    <div class="row ">
       
        <div class="col-md-12">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?> <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th  style="text-align:center;"></th>
                    
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from billhistory where emailid like '$_REQUEST[id]%' or itemcode like '$_REQUEST[id]%' or paymode like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from billhistory limit $st,$_REQUEST[perpage]");
                         }
                         while($row=  mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr  style="text-align:center;">
                                <td style="border:none;">
                                    
                                    <?php
                                    if($row[4]=="static")
                                    {
                                    ?>
                                    <div>
                                        <div class="container">
                                            <div class="row">
                                                <div class="cus-book-form form_1 custompackdis" style="height:300px;width:650px;">
                                                    <div class="row">
                                                        <div class="col-md-4 hovervala text-center" style="text-transform: capitalize;">
                                                            <?php
                                                            $packagedata = $con->query("SELECT * FROM package p,schedule s where p.packageid=s.packageid and p.packageid=$row[3]");
                                                            $rowpackage = mysqli_fetch_array($packagedata);
                                                            $goto=$con->query("SELECT * FROM register where emailid like '$row[0]'");
                                                            $aapo= mysqli_fetch_array($goto);
                                                            ?>
                                                            <img src="../<?php echo $rowpackage[5]; ?>"style="height:147px;width:190px;"/>
                                                            <div style="margin-top:10px;">
                                                                <font><?php echo $rowpackage[1]; ?></font>
                                                                <font style="font-size:10px;color:#4E2E70;font-weight:700;">Name:-</font> <font style="font-weight:0;color:black;font-size:10px;"><?php echo $aapo[3]." ".$aapo[4]; ?></font>
                                                                <p><font style="font-size:10px;color:#4E2E70;font-weight:700;">Email:-</font> <font style="font-weight:0;color:black;font-size:10px;"><?php echo $aapo[5]; ?></font></p>
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
                                                                <div class="col-md-12">
                                                                   <font style="font-size:12px;color:#4E2E70;font-weight:700;">Contact no :- </font> <font style="font-weight:0;color:black;font-size:12px;"><?php echo $aapo[6]; ?></font>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="margin-top:2px;">
                                                                <div class="col-md-12">
                                                                    <font style="font-size:12px;color:#4E2E70;font-weight:700;">Advance Amount :- </font> <font style="font-weight:0;color:black;font-size:12px;">  <i class="fa fa-rupee"></i>  <?php echo $row[7]; ?></font>
                                                                   <font style="font-size:12px;color:#4E2E70;font-weight:700;">Total Amount :- </font> <font style="font-weight:0;color:black;font-size:12px;">  <i class="fa fa-rupee"></i>  <?php echo $row[8]; ?></font>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row" style="margin-top:2px;">
                                                                <div class="col-md-12">
                                                                   <font style="font-size:12px;color:#4E2E70;font-weight:700;">Remainning Amount :- </font> <font style="font-weight:0;color:black;font-size:12px;"><?php $gst=$row[9]*5/100; echo round($gst+$row[9]); ?></font>
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
                                        $lavo=$con->query("select * from custompackage where custompackageid=$row[3]");
                                        $gotorow= mysqli_fetch_array($lavo);
                                        $goto=$con->query("SELECT * FROM register where emailid like '$row[0]'");
                                        $aapo= mysqli_fetch_array($goto);
                                    ?>
                                    <div class="container">
                                        <div class="cus-book-form form_1 custompackdis" style="height:300px;width:650px;">
                                                <div class="row">
                                                    <div class="col-md-4 hovervala">
                                                        <?php
                                                        if($gotorow[7]=="Honeymoon Package")
                                                        {
                                                        ?>
                                                        <img src="../images/honeymoon_romantic.webp" style="height:147px;width:190px;" />
                                                        <?php   
                                                        }
                                                        elseif($gotorow[7]=="Family Package") 
                                                        {
                                                         ?>
                                                        <img src="../images/family.webp" style="height:147px;width:190px;" />
                                                        <?php
                                                        }
                                                        elseif($gotorow[7]=="Holiday Package") 
                                                        {
                                                        ?>
                                                        <img src="../images/water+activities.webp" style="height:147px;width:190px;" />
                                                        <?php
                                                        }
                                                        elseif($gotorow[7]=="Group Package") 
                                                        {
                                                        ?>
                                                        <img src="../images/friends_group.webp" style="height:147px;width:190px;" />
                                                        <?php
                                                        }
                                                        elseif($gotorow[7]=="Regular Package") 
                                                        {
                                                        ?>
                                                        <img src="../images/adventure.webp" style="height:147px;width:190px;" />
                                                        <?php
                                                        }
                                                        else
                                                        {
                                                        ?>
                                                        <img src="../images/solo.webp" style="height:147px;width:190px;" />
                                                        <?php    
                                                        }
                                                        ?>
                                                            <div style="margin-top:10px;">
                                                                <font><?php echo $rowpackage[1]; ?></font>
                                                                <font style="font-size:10px;color:#4E2E70;font-weight:700;">Name:-</font> <font style="font-weight:0;color:black;font-size:10px;"><?php echo $aapo[3]." ".$aapo[4]; ?></font>
                                                                <p><font style="font-size:10px;color:#4E2E70;font-weight:700;">Email:-</font> <font style="font-weight:0;color:black;font-size:10px;"><?php echo $aapo[5]; ?></font></p>
                                                            </div>
                                                    </div>
                                                    <div class="col-md-8">
                                                         <i class="fa fa-gg fafado" style="float:right; color:#4E2E70;"></i>
                                                        <div class="row" style="margin-top:20px;">
                                                            <div class="col-md-6 text-center">
                                                                <font style="color:#4E2E70;font-size:15px;">Departure Date</font>
                                                                <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                <div class="text-center"><i class="fa fa-clock-o" style="margin-right:10px;"></i><?php echo date("d-m-Y", strtotime($gotorow[3])); ?></div>
                                                            </div>
                                                            <div class="col-md-6 text-center">
                                                                <font style="color:#4E2E70;font-size:15px;">Arrival Date</font>
                                                                <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                <div class="text-center"><i class="fa fa-clock-o" style="margin-right:10px;"></i><?php echo date("d-m-Y", strtotime($gotorow[2])); ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="row" style="padding-bottom:10px;margin-top:10px;">
                                                            <div class="col-md-12 text-center">
                                                                <font style="color:#4E2E70;font-size:15px;">Package Category</font>
                                                                 <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                <div class="text-center"><i class="fa fa-suitcase" style="margin-right:10px;"></i><?php echo $gotorow[7]; ?></div>
                                                            </div>
                                                        </div>
                                                        <div class="row" >
                                                                    <div class="col-md-6 text-center">
                                                                        <font style="color:#4E2E70;font-size:15px;">Number of adults</font>
                                                                        <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                        <div class="text-center"><i class="fa fa-user" style="margin-right:10px;"></i><?php echo $gotorow[5]; ?></div>
                                                                    </div>
                                                                    <div class="col-md-6 text-center">
                                                                        <font style="color:#4E2E70;font-size:15px;">Number of children</font>
                                                                        <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                        <div class="text-center"><i class="fa fa-child" style="margin-right:10px;"></i><?php echo $gotorow[6]; ?></div>
                                                                    </div>
                                                        </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                   <font style="font-size:12px;color:#4E2E70;font-weight:700;">Contact no :- </font> <font style="font-weight:0;color:black;font-size:12px;"><?php echo $aapo[6]; ?></font>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="margin-top:2px;">
                                                                <div class="col-md-12">
                                                                    <font style="font-size:12px;color:#4E2E70;font-weight:700;">Advance Amount :- </font> <font style="font-weight:0;color:black;font-size:12px;">  <i class="fa fa-rupee"></i>  <?php echo $row[7]; ?></font>
                                                                   <font style="font-size:12px;color:#4E2E70;font-weight:700;">Total Amount :- </font> <font style="font-weight:0;color:black;font-size:12px;">  <i class="fa fa-rupee"></i>  <?php echo $row[8]; ?></font>
                                                                </div>
                                                            </div>
                                                            
                                                            <div class="row" style="margin-top:2px;">
                                                                <div class="col-md-12">
                                                                   <font style="font-size:12px;color:#4E2E70;font-weight:700;">Remainning Amount :- </font> <font style="font-weight:0;color:black;font-size:12px;"><?php $gst=$row[9]*5/100; echo round($gst+$row[9]); ?></font>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                    <?php
                                    }
                                    ?>

                                </td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="12" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="12">
                                    <?php
                                        echo "Total Record Are = $_SESSION[client]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>


    <!-- Manage custom package bill-->

<?php
    
   if($_REQUEST[shu]=="custompackagebill")
   {
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           
       }
       
       $count=$con->query("select count(*) from confrimbooking where status=0 and itemcode='custom'");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[client]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
               
               
           }

       ?>
       
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?> </span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                        </div>
                    </div>
        </div>
    <div class="row ">
       
        <div class="col-md-12">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?> <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th></th>
                    
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from  where fname like '$_REQUEST[id]%' or lname like '$_REQUEST[id]%' or emailid like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("SELECT * FROM confrimbooking where itemcode='custom' and status=0 limit $st,$_REQUEST[perpage]");
                         }
                         while($row=  mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td style="border:none!important;">
                                    <form method="post" action="">
                                    <div>
                                        <?php
                                        $sell=$con->query("select * from custompackage where custompackageid=$row[9]");
                                        $sellrow=mysqli_fetch_array($sell);
                                        ?>
                                        <div class="container">
                                            <div class="row">
                                                <div class="cus-book-form form_1 custompackdis" style="height:340px;">
                                                    <div class="row">
                                                        <div class="col-md-4 hovervala">
                                                            <?php
                                                            if ($sellrow[7] == "Honeymoon Package") {
                                                                ?>
                                                            <img src="../images/honeymoon_romantic.webp" />
                                                                <?php
                                                            } elseif ($sellrow[7] == "Family Package") {
                                                                ?>
                                                                <img src="../images/family.webp" />
                                                                <?php
                                                            } elseif ($sellrow[7] == "Holiday Package") {
                                                                ?>
                                                                <img src="../images/water+activities.webp"/>
                                                                <?php
                                                            } elseif ($sellrow[7] == "Group Package") {
                                                                ?>
                                                                <img src="../images/friends_group.webp" />
                                                                <?php
                                                            } elseif ($sellrow[7] == "Regular Package") {
                                                                ?>
                                                                <img src="../images/adventure.webp" />
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src="../images/solo.webp" />
                                                                <?php
                                                            }
                                                            ?>
                                                            <div style="margin-top:10px;">
                                                                <font><?php echo $sellrow[7]; ?></font>
                                                                <p style="font-size:10px;margin-top:3px;color:#4E2E70;" class="text-center">Pay Mode : <font style="color:black;"><?php echo $row[4]; ?>
                                                                <?php
                                                                if($row[4]=='google pay')
                                                                {
                                                                ?>
                                                                    <img src="images/googlepay.png" style="width:20px;height:20px;border:none;"/>
                                                                <?php    
                                                                }
                                                                elseif($row[4]=='amazon pay')
                                                                {
                                                                ?>
                                                                    <img src="images/amazonpay.png" style="width:20px;height:20px;border:none;"/>
                                                                <?php    
                                                                }
                                                                elseif($row[4]=='phone pay')
                                                                {
                                                                ?>
                                                                    <img src="images/phonepay.png" style="width:20px;height:20px;border:none;"/>
                                                                <?php    
                                                                }
                                                                ?>
                                                                </p>
                                                            </div>

                                                           
                                                        </div>
                                                        <?php
                                                            $profile=$con->query("select * from register where emailid like '$row[0]'");
                                                            $rowprofile= mysqli_fetch_array($profile);
                                                        ?>
                                                        <div class="col-md-8">
                                                            <i class="fa fa-gg fafado" style="float:right; color:#4E2E70;"></i>
                                                            <div class="row" style="margin-top:20px;">
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Customer Name</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-user" style="margin-right:10px;"></i><?php echo $rowprofile[3]." ".$rowprofile[4]; ?></div>
                                                                </div>
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Email id</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-envelope" style="margin-right:10px;"></i><font style="font-size:12px;"><?php echo $rowprofile[5]; ?></font></div>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="padding-bottom:10px;margin-top:10px;">
                                                                <div class="col-md-12 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Contact Number</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-phone" style="margin-right:10px;"></i><?php echo $rowprofile[6]; ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="row" >
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Book Date</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-clock-o" style="margin-right:10px;"></i><?php echo $row[3]; ?></div>
                                                                </div>
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">status</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-times" style="margin-right:10px;color:red;"></i>Not confirm</div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                    <div class="col-md-12" style="margin-top:20px;">
                                                                           <p style="font-size:15px;color:#4E2E70;font-weight:0;" class="text-center">
                                                                        <font style="padding-right:10px;">Advance Amount : <font style="color:black;"><?php echo $row[5]; ?></font></font>
                                                                        Total Amount : <font style="color:black;"><?php echo $row[6]; ?></font><br>
                                                                        Payable Amount : <font style="color:black;"><?php echo $row[7]; ?></font>
                                                                    </p>
                                                                    <input type='hidden' value="<?php echo $row[1]; ?>" name="bookingid"/>
                                                                    <input type='hidden' value="<?php echo $row[2]; ?>" name="confrimbookingid"/>
                                                                    <button style="width:100%;background:#4E2E70!important;color:white;font-weight:1000;border:1px solid white!important;" name="custombill" class="text-center btn" >confirm ,Custom package Now</button>
                                                                    </div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   </form>
                                </td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="12" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="12">
                                    <?php
                                        echo "Total Record Are = $_SESSION[client]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>

    <!-- Manage  package bill-->

<?php
    
   if($_REQUEST[shu]=="packagebill")
   {
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           
       }
       
       $count=$con->query("select count(*) from confrimbooking where status=0 and itemcode='static'");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[client]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
               
               
           }

       ?>
       
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?> </span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                        </div>
                    </div>
        </div>
    <div class="row ">
       
        <div class="col-md-12">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?> <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th></th>
                    
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from  where fname like '$_REQUEST[id]%' or lname like '$_REQUEST[id]%' or emailid like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("SELECT * FROM confrimbooking where itemcode='static' and status=0 limit $st,$_REQUEST[perpage]");
                         }
                         while($row=  mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td style="border:none!important;">
                                    <form method="post" action="">
                                    <div>
                                        <div class="container">
                                            <div class="row">
                                                <div class="cus-book-form form_1 custompackdis" style="height:340px;">
                                                    <div class="row">
                                                        <div class="col-md-4 hovervala">
                                                            <?php
                                                            $seeell=$con->query("SELECT * FROM booking where bookingid=$row[1] and itemcode='static'");
                                                            $rowsell= mysqli_fetch_array($seeell);
                                                            $packagedata=$con->query("SELECT * FROM package where packageid=$rowsell[2]");
                                                            $rowpackage= mysqli_fetch_array($packagedata);
                                                            ?>
                                                            <img src="../<?php echo $rowpackage[5]; ?>" style="width:200px; " />
                                                            <div style="margin-top:10px;">
                                                                <font><?php echo $rowpackage[1]; ?></font>
                                                                <p style="font-size:10px;margin-top:3px;color:#4E2E70;" class="text-center">Pay Mode : <font style="color:black;"><?php echo $row[4]; ?>
                                                                <?php
                                                                if($row[4]=='google pay')
                                                                {
                                                                ?>
                                                                    <img src="images/googlepay.png" style="width:20px;height:20px;border:none;"/>
                                                                <?php    
                                                                }
                                                                elseif($row[4]=='amazon pay')
                                                                {
                                                                ?>
                                                                    <img src="images/amazonpay.png" style="width:20px;height:20px;border:none;"/>
                                                                <?php    
                                                                }
                                                                elseif($row[4]=='phone pay')
                                                                {
                                                                ?>
                                                                    <img src="images/phonepay.png" style="width:20px;height:20px;border:none;"/>
                                                                <?php    
                                                                }
                                                                ?>
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-8">
                                                            
                                                                <i class="fa fa-gg fafado" style="float:right; color:#4E2E70;"></i>
                                                            <?php
                                                            $profile=$con->query("select * from register where emailid like '$row[0]'");
                                                            $rowprofile= mysqli_fetch_array($profile);
                                                            ?>
                                                            <div class="row" style="margin-top:20px;">
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Customer Name</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-user" style="margin-right:10px;"></i><?php echo $rowprofile[3]." ".$rowprofile[4]; ?></div>
                                                                </div>
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Email id</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-envelope" style="margin-right:10px;"></i><font style="font-size:12px;"><?php echo $rowprofile[5]; ?></font></div>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="padding-bottom:10px;margin-top:10px;">
                                                                <div class="col-md-12 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Contact Number</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-phone" style="margin-right:10px;"></i><?php echo $rowprofile[6]; ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="row" >
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Book Date</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-clock-o" style="margin-right:10px;"></i><?php echo $row[3]; ?></div>
                                                                </div>
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">status</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-times" style="margin-right:10px;color:red;"></i>Not confirm</div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12" style="margin-top:20px;">
                                                                    <p style="font-size:15px;color:#4E2E70;font-weight:0;" class="text-center">
                                                                        <font style="padding-right:10px;">Advance Amount : <font style="color:black;"><?php echo $row[5]; ?></font></font>
                                                                        Total Amount : <font style="color:black;"><?php echo $row[6]; ?></font><br>
                                                                        Payable Amount : <font style="color:black;"><?php echo $row[7]; ?></font>
                                                                    </p>
                                                                    <input type='hidden' value="<?php echo $row[1]; ?>" name="bookingid"/>
                                                                    <input type='hidden' value="<?php echo $row[2]; ?>" name="confrimbookingid"/>
                                                                    <button style="width:100%;background:#4E2E70!important;color:white;font-weight:1000;border:1px solid white!important;" name="bill" class="text-center btn" >confirm , package Now</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   </form>
                                </td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="12" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="12">
                                    <?php
                                        echo "Total Record Are = $_SESSION[client]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>



<!-- Manage taxi company  request conformation-->

<?php
    
   if($_REQUEST[shu]=="requesttaxiconformation")
   {
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
            $del=$con->query("delete from taxicompanyrequest where taxicompanyrequestid=$_REQUEST[id]");
       }
         
       $count=$con->query("select count(*) from taxicompanyrequest where taxicompanyid=$_SESSION[taxicompanyid]");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[requesttaxiconformation]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           }

       ?>
       
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span>Request Conformation  </span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                        </div>
                    </div>
        </div>
    <div class="row ">
       
        <div class="col-md-12">
            <div class="spe-title">
                    <h3>Display Request Conformation <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                             
                         $data=$con->query("select * from register where fname like '$_REQUEST[id]%' or lname like '$_REQUEST[id]%' or emailid like '$_REQUEST[id]%'");
                         
                         }
                         
                         else
                         {
                             $data=$con->query("select * from taxicompanyrequest where taxicompanyid=$_SESSION[taxicompanyid] limit $st,$_REQUEST[perpage]");
                         }
                         while($row=mysqli_fetch_array($data))
                         {
                              $data1=$con->query("select * from custompackage where custompackageid=$row[0]");
                              $row1=  mysqli_fetch_array($data1);
                              $ketla++;
                              $sell=$con->query("select * from taxicompanyrequest where taxicompanyid=$_SESSION[taxicompanyid] and custompackageid=$row[0]");
                              $sellrow=  mysqli_fetch_array($sell);
                            ?>
                            <tr>
                                 <td style="border:none!important;">
                                     <form method="post" action="">
                                    <div>
                                        <div class="container">
                                            <div class="row">
                                                <div class="cus-book-form form_1 custompackdis">
                                                    <div class="row">
                                                        <div class="col-md-4 hovervala">
                                                            <?php
                                                            if ($row1[7] == "Honeymoon Package") {
                                                                ?>
                                                            <img src="../images/honeymoon_romantic.webp" />
                                                                <?php
                                                            } elseif ($row1[7] == "Family Package") {
                                                                ?>
                                                                <img src="../images/family.webp" />
                                                                <?php
                                                            } elseif ($row1[7] == "Holiday Package") {
                                                                ?>
                                                                <img src="../images/water+activities.webp"/>
                                                                <?php
                                                            } elseif ($row1[7] == "Group Package") {
                                                                ?>
                                                                <img src="../images/friends_group.webp" />
                                                                <?php
                                                            } elseif ($row1[7] == "Regular Package") {
                                                                ?>
                                                                <img src="../images/adventure.webp" />
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src="../images/solo.webp" />
                                                                <?php
                                                            }
                                                            ?>
                                                                
                                                        </div>
                                                        <div class="col-md-8">
                                                            <?php
                                                             if($sellrow[3]==0)
                                                             {
                                                             ?>
                                                                <i class="fa fa-close fafado" style="float:right; color:#4E2E70;" title="delete" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[2]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i>
                                                             <?php  
                                                             }
                                                             ?>
                                                            
                                                            <div class="row" style="margin-top:20px;">
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Departure Date</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-clock-o" style="margin-right:10px;"></i><?php echo date("d-m-Y", strtotime($row1[3])); ?></div>
                                                                </div>
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Arrival Date</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-clock-o" style="margin-right:10px;"></i><?php echo date("d-m-Y", strtotime($row1[2])); ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="padding-bottom:10px;margin-top:10px;">
                                                                <div class="col-md-12 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Package Category</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-suitcase" style="margin-right:10px;"></i><?php echo $row1[7]; ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="row" >
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Number of adults</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-user" style="margin-right:10px;"></i><?php echo $row1[5]; ?></div>
                                                                </div>
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Number of children</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-child" style="margin-right:10px;"></i><?php echo $row1[6]; ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12" style="margin-top:20px;">
                                                             <?php
                                                             if($sellrow[3]==0)
                                                             {
                                                             ?>
                                                                    <input type="hidden" name="taxirequestid" value="<?php echo $row[2]; ?>"/>
                                                                                    <div class="input-field col s10">
                                                                                    <input id="list-title" type="text" required="" name="amount">
                                                                                    <label for="list-title">Enter your approx rate</label>
                                                                                </div>
                                                                    <button style="width:100%;background:#4E2E70!important;color:white;font-weight:1000;border:1px solid white!important;" name="conformationbytaxi" class="text-center btn" >confirm , customer travel in your taxi</button>
                                                             <?php
                                                             }
                                                             elseif($sellrow[3]==1)
                                                             {
                                                             ?>
                                                                    <span style="width:100%;background:#4E2E70!important;color:white;font-weight:1000;border:1px solid white!important;" name="conformation" class="text-center btn" >you will be notify by email</span>
                                                             <?php  
                                                             }
                                                             elseif($sellrow[3]==2)
                                                             {
                                                              ?>
                                                                    <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank" style="width:100%;background:#4E2E70!important;color:white;font-weight:1000;border:1px solid white!important;" name="conformation" class="text-center btn" >Check email</a>
                                                             <?php
                                                             }
                                                             ?>
                                                              
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     </form>
                                </td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="12" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="12">
                                    <?php
                                        echo "Total Record Are = $_SESSION[requesttaxiconformation]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>





<!-- Manage hotel  request conformation-->

<?php
    
   if($_REQUEST[shu]=="requesthotelconformation")
   {
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
            $del=$con->query("delete from hotelrequest where hotelrequestid=$_REQUEST[id]");
       }
       
       $count=$con->query("select count(*) from hotelrequest where hotelid=$_SESSION[hotelid]");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[requesthotelconformation]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           }

       ?>
       
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span>Request Conformation  </span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                        </div>
                    </div>
        </div>
    <div class="row ">
       
        <div class="col-md-12">
            <div class="spe-title">
                    <h3>Display Request Conformation <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                             
                         $data=$con->query("select * from register where fname like '$_REQUEST[id]%' or lname like '$_REQUEST[id]%' or emailid like '$_REQUEST[id]%'");
                         
                         }
                         
                         else
                         {
                             $data=$con->query("select * from hotelrequest where hotelid=$_SESSION[hotelid] limit $st,$_REQUEST[perpage]");
                         }
                         while($row=mysqli_fetch_array($data))
                         {
                              $data1=$con->query("select * from custompackage where custompackageid=$row[0]");
                              $row1=  mysqli_fetch_array($data1);
                              $ketla++;
                              $sell=$con->query("select * from hotelrequest where hotelid=$_SESSION[hotelid] and custompackageid=$row[0]");
                              $sellrow=  mysqli_fetch_array($sell);
                            ?>
                            <tr>
                                 <td style="border:none!important;">
                                     <form action="" method="post">
                                    <div>
                                        <div class="container">
                                            <div class="row">
                                                <div class="cus-book-form form_1 custompackdis">
                                                    <div class="row">
                                                        <div class="col-md-4 hovervala">
                                                            <?php
                                                            if ($row1[7] == "Honeymoon Package") {
                                                                ?>
                                                            <img src="../images/honeymoon_romantic.webp" />
                                                                <?php
                                                            } elseif ($row1[7] == "Family Package") {
                                                                ?>
                                                                <img src="../images/family.webp" />
                                                                <?php
                                                            } elseif ($row1[7] == "Holiday Package") {
                                                                ?>
                                                                <img src="../images/water+activities.webp"/>
                                                                <?php
                                                            } elseif ($row1[7] == "Group Package") {
                                                                ?>
                                                                <img src="../images/friends_group.webp" />
                                                                <?php
                                                            } elseif ($row1[7] == "Regular Package") {
                                                                ?>
                                                                <img src="../images/adventure.webp" />
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src="../images/solo.webp" />
                                                                <?php
                                                            }
                                                            ?>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <?php
                                                             if($sellrow[3]==0)
                                                             {
                                                             ?>
                                                                <i class="fa fa-close fafado" style="float:right; color:#4E2E70;" title="delete" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[2]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i>
                                                             <?php  
                                                             }
                                                             ?>
                                                            
                                                            <div class="row" style="margin-top:20px;">
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Departure Date</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-clock-o" style="margin-right:10px;"></i><?php echo date("d-m-Y", strtotime($row1[3])); ?></div>
                                                                </div>
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Arrival Date</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-clock-o" style="margin-right:10px;"></i><?php echo date("d-m-Y", strtotime($row1[2])); ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="row" style="padding-bottom:10px;margin-top:10px;">
                                                                <div class="col-md-12 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Package Category</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-suitcase" style="margin-right:10px;"></i><?php echo $row1[7]; ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="row" >
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Number of adults</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-user" style="margin-right:10px;"></i><?php echo $row1[5]; ?></div>
                                                                </div>
                                                                <div class="col-md-6 text-center">
                                                                    <font style="color:#4E2E70;font-size:15px;">Number of children</font>
                                                                    <div style="height:10px;width:1px; background-color:#4E2E70;margin: 0 auto;"></div>
                                                                    <div class="text-center"><i class="fa fa-child" style="margin-right:10px;"></i><?php echo $row1[6]; ?></div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12" style="margin-top:20px;">
                                                             <?php
                                                             if($sellrow[3]==0)
                                                             {
                                                             ?>
                                                                                    <input type="hidden" name="hotelrequestid" value="<?php echo $row[2]; ?>"/>
                                                                                    <div class="input-field col s10">
                                                                                    <input id="list-title" type="text" required="" name="amount">
                                                                                    <label for="list-title">Enter your approx rate</label>
                                                                                </div>
                                                                    <button style="width:100%;background:#4E2E70!important;color:white;font-weight:1000;border:1px solid white!important;" name="conformationbyhotel" class="text-center btn" >confirm , customer stay on hotel</button>
                                                             <?php
                                                             }
                                                             elseif($sellrow[3]==1)
                                                             {
                                                             ?>
                                                                    <span style="width:100%;background:#4E2E70!important;color:white;font-weight:1000;border:1px solid white!important;" name="conformation" class="text-center btn" >you will be notify by email</span>
                                                             <?php  
                                                             }
                                                             elseif($sellrow[3]==2)
                                                             {
                                                              ?>
                                                                    <a href="https://mail.google.com/mail/u/0/#inbox" target="_blank" style="width:100%;background:#4E2E70!important;color:white;font-weight:1000;border:1px solid white!important;" name="conformation" class="text-center btn" >Check email</a>
                                                             <?php
                                                             }
                                                             ?>
                                                              
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                     </form>
                                </td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="12" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="12">
                                    <?php
                                        echo "Total Record Are = $_SESSION[requesthotelconformation]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>




<!-- Manage  custom package-->

<?php
    
   if($_REQUEST[shu]=="custompackage")
   {
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $sel=$con->query("select emailid from custompackage where custompackageid like '$_REQUEST[id]'");
           $selrow=  mysqli_fetch_array($sel);
           sendmail("$selrow[0]",
                   "<h1 style='border-bottom:5px solid #2A3C54;'>the journey</h1><hr><div style='background:#FF0049;color:white;font-size:20px'><font style='color:black;'>Soory ...... !</font>Your Package Request Is Cancle</div><br>", "thejourney");
           $del=$con->query("delete from custompackage where custompackageid like '$_REQUEST[id]' ");
       }
       
       $count=$con->query("select count(*) from custompackage");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[custompackage]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
               
               
           }

       ?>
       
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?> </span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                        </div>
                    </div>
        </div>
    <div class="row ">
       
        <div class="col-md-12">
            <div class="spe-title">
                    <h3>check Availability of Hotel & taxi company's<span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from custompackage where emailid like '$_REQUEST[id]%' or packagecategory like '$_REQUEST[id]%' or arrivaldate like '$_REQUEST[id]%' or departuredate like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from custompackage limit $st,$_REQUEST[perpage]");
                         }
                         while($row=  mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                    <tr>
                        <td style="border:none!important;">
                                    <div>
                                        <div class="container">
                                            <?php
                                            if($_SESSION[dup]==1)
                                            {
                                            ?>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h4 style="color:red;" class="animated infinite flash">first select then hit the button</h4>
                                                </div>
                                            </div> 
                                            <?php
                                            $_SESSION[dup]=0;
                                            }
                                            ?>
                                            <div class="row">
                                                <div class="cus-book-form form_1 custompackdis">
                                                    <div class="row">
                                                        <div class="col-md-4 hovervala">
                                                            <?php
                                                            if ($row[7] == "Honeymoon Package") {
                                                                ?>
                                                            <img src="../images/honeymoon_romantic.webp" />
                                                                <?php
                                                            } elseif ($row[7] == "Family Package") {
                                                                ?>
                                                                <img src="../images/family.webp" />
                                                                <?php
                                                            } elseif ($row[7] == "Holiday Package") {
                                                                ?>
                                                                <img src="../images/water+activities.webp"/>
                                                                <?php
                                                            } elseif ($row[7] == "Group Package") {
                                                                ?>
                                                                <img src="../images/friends_group.webp" />
                                                                <?php
                                                            } elseif ($row[7] == "Regular Package") {
                                                                ?>
                                                                <img src="../images/adventure.webp" />
                                                                <?php
                                                            } else {
                                                                ?>
                                                                <img src="../images/solo.webp" />
                                                                <?php
                                                            }
                                                            ?>

                                                            <font style="margin-left:10px;color:#4E2E70;">Budget</font> -- <i class="fa fa-rupee" style="font-size:10px;" ></i> <font style="font-size:10px;letter-spacing:1px;"><?php echo $row[4]; ?></font>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <i class="fa fa-close fafado" style="float:right; color:#4E2E70;" title="delete" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[1]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i>
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
                                                                        <div style="width:100%;background:#4E2E70!important;color:white;font-weight:1000;" name="placeassignsession" class="text-center btn">
                                                                            <div class="row">
                                                                                <div class="col-md-3">
                                                                                    <font  data-toggle="modal" data-target="#customhotel" onclick="customhotel('customhotel',<?php echo $row[1]; ?>);"  style="font-size:10px;"> [ hotel <i class="fa fa-building" style="font-size:10px;"></i> ]</font>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <font data-toggle="modal" data-target="#customhotel" onclick="customhotel('customtaxi',<?php echo $row[1]; ?>);" style="font-size:10px;"> [ Taxi <i class="fa fa-taxi" style="font-size:10px;"></i> ]</font>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <font data-toggle="modal" data-target="#customhotel" onclick="customhotel('status',<?php echo $row[1]; ?>);" style="font-size:10px;"> [ status <i class="fa fa-gg" style="font-size:10px;"></i> ]</font>
                                                                                </div>
                                                                                <div class="col-md-3">
                                                                                    <font data-toggle="modal" data-target="#customhotel" onclick="customhotel('pending',<?php echo $row[1]; ?>);" style="font-size:10px;"> [ pending <i class="fa fa-pencil" style="font-size:10px;"></i> ]</font>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                            
                                                                            
                                                                        </div>
                                                                    </div>
                                                            </div>
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
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="12" class="adpaging"  style="border:none;">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="12"  style="border:none;">
                                    <?php
                                        echo "Total Record Are = $_SESSION[custompackage]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>



<!-- Manage package offer -->

<?php
    
   if($_REQUEST[shu]=="offer")
   {
       
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $del=$con->query("delete from offer where offerid=$_REQUEST[id]");
       }
       
       $count=$con->query("select count(*) from country");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[offer]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
               
               
           }

       ?>
       
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                </div>
        </div>
    </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];
                $data = $con->query("select * from offer where offerid=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                $_SESSION[checkpotaniid]=$row[0];
                ?>
                <div class="col-md-6 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" autocomplete="off" method="post" name="upcountry">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" autofocus=""  name="upoffername" value="<?php echo $row[2]; ?>" required="" pattern="^[a-z ]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="active">Update Offer Name</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating">Update fromdate Date</p>
                                        <div class="input-field col s10 padd-left">
                                            <input type="date" name="upfromdate" min="<?php echo Date('Y-m-d'); ?>" value="<?php echo $row[3]; ?>" required="" onchange="deoffer(this.value);"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating">Update todate Date</p>
                                            <div class="input-field col s10 padd-left">
                                               <input type="date" name="uptodate" required="" id="dateoffer" value="<?php echo $row[4]; ?>" />
                                           </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="text"  name="uppercentage" required="" value="<?php echo $row[5]; ?>" maxlength="2" pattern="^[0-9]*$" class="validate lowertransfer" >
                                            <label for="list-title" class="active">Update Offer Percentage</label>
                                        </div>
                                    </div>
                                </div>


                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm"> 
                                            <button type="submit" class="btn" name="upoffer">Update Country</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="col-md-6 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" method="post" name="offer" autocomplete="off" >
                                
                                <div class="row">
                                        <div class="col-md-12">
                                                <div class="input-field col s10">
                                                    <select name="packageid" required="">
                                                        <option value="" disabled selected>Select Package</option>
                                                        <?php
                                                        $datasel = $con->query("select * from package");
                                                        while ($rowsel = mysqli_fetch_array($datasel)) {
                                                            ?>
                                                            <option value="<?php echo $rowsel[0]; ?>"><?php echo $rowsel[1]; ?></option>
                                                            <?php
                                                        }
                                                        ?>

                                                    </select>
                                                </div>
                                        </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <?php
                                            if ($_SESSION[dup] == 1) {
                                                echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
                                                $_SESSION[dup] = 0;
                                            }
                                            ?>
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text"  name="offername" required="" pattern="^[a-z ]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Offer Name</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating">fromdate Date</p>
                                        <div class="input-field col s10 padd-left">
                                            <input type="date" name="fromdate" min="<?php echo Date('Y-m-d'); ?>" required="" onchange="deoffer(this.value);"/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating">todate Date</p>
                                            <div class="input-field col s10 padd-left">
                                               <input type="date" name="todate" required="" id="dateoffer" />
                                           </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="text"  name="percentage" required="" maxlength="2" pattern="^[0-9]*$" class="validate lowertransfer" >
                                            <label for="list-title" class="">Offer Percentage</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">  
                                            <button type="submit" class="btn" name="sendoffer">Submit Offer</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    ?>

            <div class="col-md-6 animated fadeInLeft">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>Package Name</th>
                    <th>Offer Name</th>
                    <th>From date</th>
                    <th>To date</th>
                    <th>percentages</th>
                    <th></th>
                    <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from offer where offername like '$_REQUEST[id]%' or fromdate like '$_REQUEST[id]%' or todate like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from offer limit $st,$_REQUEST[perpage]");
                         }
                         while($row=  mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td>
                                    <?php
                                    $abc=$con->query("select * from package where packageid=$row[0]");
                                    $row1=mysqli_fetch_array($abc);
                                    echo $row1[1];
                                    ?>
                                </td>
                                <td><?php echo $row[2]; ?></td>
                                <td><?php echo $row[3]; ?></td>
                                 <td><?php echo $row[4]; ?></td>
                                 <td><?php echo $row[5]; ?></td>
                                <td><i class="fa fa-refresh" onclick="takedata('<?php echo $_SESSION[shu]; ?>','update',<?php echo $row[1]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[1]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="7" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="7">
                                    <?php
                                        echo "Total record are : $_SESSION[offer]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>




<!-- Manage assignvehiclename -->

<?php
    
   if($_REQUEST[shu]=="assignvehiclename")
   {
       
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $del=$con->query("delete from assignvehiclename where assignvehiclenameid=$_REQUEST[id]");
       }
       
       $count=$con->query("SELECT count(*) FROM assignvehiclename a,taxicompany t where t.taxicompanyid=a.taxicompanyid and t.emailid like '$_SESSION[user]'");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[assignvehiclename]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
               
               
           }

       ?>
       
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                </div>
        </div>
    </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];

                $data = $con->query("select * from assignvehiclename where vehiclename=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                ?>
                <div class="col-md-6 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" autocomplete="off" method="post" name="">
                                
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="col-md-6 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" method="post" name="assignvehiclename" autocomplete="off" >
                                <div class="row" style="padding-bottom:20px;">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <?php
                                            if ($_SESSION[dup] == 1) {
                                                echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
                                                $_SESSION[dup] = 0;
                                            }
                                            ?>
                                            <div class="input-field col s10">
                                                <select name="vehiclenameid" required="">
                                                <option value="" disabled="" selected="">Select vehical name</option>
                                                   <?php
                                                    $sel=$con->query("select * from vehiclename");
                                                    while($rowsel=  mysqli_fetch_array($sel))
                                                    {
                                                   ?>
                                                        <option value="<?php echo $rowsel[1]; ?>"><?php echo $rowsel[2]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>  
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">  
                                            <button type="submit" class="btn" name="sendassignvehiclename">Submit vehicalName</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    ?>

            <div class="col-md-6 animated fadeInLeft">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
            </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>vehicle name</th>
                    <th>view in detail</th>
                    <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from assignvehiclename where name like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("SELECT * FROM assignvehiclename a,taxicompany t where t.taxicompanyid=a.taxicompanyid and t.emailid like '$_SESSION[user]' limit $st,$_REQUEST[perpage]");
                         }
                         while($row=mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td><?php $sel=$con->query("select * from vehiclename where vehiclenameid=$row[1]");
                                            $rowsel=  mysqli_fetch_array($sel);
                                            echo $rowsel[2];?></td>
                                <td><i class="fa fa-print print" data-toggle="modal" data-target="#vehicle" onclick="vehicleleva('vehicle',<?php echo $rowsel[1]; ?>,'<?php echo $rowsel[2]; ?>');"></i></td>
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[2]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="3" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="3">
                                    <?php
                                        echo "Total record are : $_SESSION[assignvehiclename]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>



<!-- Manage  vehiclename-->

<?php
    
   if($_REQUEST[shu]=="vehiclename")
   {
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $unlinkmate=$con->query("select * from vehiclename where vehiclenameid=$_REQUEST[id]");
           $dataunlinkmate=  mysqli_fetch_array($unlinkmate);
           unlink($dataunlinkmate[4]);
           $del=$con->query("delete from vehiclename where vehiclenameid=$_REQUEST[id]");
       }
       
       $count=$con->query("select count(*) from vehiclename");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[vehiclename]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
           }

       ?>
       
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                        </div>
                    </div>
        </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];

                $data = $con->query("select * from vehiclename where vehiclenameid=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                $_SESSION[checkpotaniid]=$row[0];
                $_SESSION[checkpotaniid1]=$row[2];
                ?>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" autocomplete="off" method="post" name="upvehiclename" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[2]; ?>" autofocus="" name="upname" required="" pattern="^[a-z ]*$" class="validate lowertransfer">
                                                <label for="list-title" class="active">Update name</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[3]; ?>" name="upseating" required="" maxlength="2" pattern="^[0-9]*$" class="validate lowertransfer">
                                                <label for="list-title" class="active">Update seating</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                        <div class="file-field">
                                            <div class="btn">
                                                <span>File</span>
                                                <input type="file" name="upaboutpdf">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" placeholder="Update aboutpdf">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm"> 
                                            <button type="submit" class="btn" name="upvehiclename">Update vehiclename</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>      
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" method="post" name="vehiclename" autocomplete="off" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <select name="vehicleid" required="">
                                                <option value="" disabled selected>Select vehicle</option>
                                                        <?php
                                                        $datasel = $con->query("select * from vehicle");
                                                        while ($rowsel = mysqli_fetch_array($datasel)) 
                                                        {
                                                        ?>
                                                            <option value="<?php echo $rowsel[0]; ?>"><?php echo $rowsel[1]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                            </select>  
                                        </div>   
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                                <?php
                                                if ($_SESSION[dup] == 1) {
                                                    echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
                                                    unset($_SESSION[dup]);
                                                }
                                                ?>
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text"  name="name" required="" pattern="^[a-z ]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Enter vehicle name</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="text"  name="seating" required="" maxlength="2" pattern="^[0-9]*$" class="validate lowertransfer" >
                                            <label for="list-title" class="">Enter vehicle seating</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
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
                                                <input type="file" name="aboutpdf" required="">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" placeholder="Upload pdf">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">  
                                            <button type="submit" class="btn" name="sendvehiclename">Send vehiclename</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    ?>

            <div class="col-md-6">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>vehical Type</th>
                    <th>name</th>
                     <th>seating</th>
                     <th>View in detail</th>
                     <th></th>
                     <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from vehiclename where name like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from vehiclename limit $st,$_REQUEST[perpage]");
                         }
                         while($row=mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td><?php $datasell=$con->query("select * from vehicle where vehicleid=$row[0];");
                                       $rowsell=  mysqli_fetch_array($datasell); 
                                       echo $rowsell[1];?></td>
                                <td><?php echo $row[2]; ?></td>
                                <td><?php echo $row[3]; ?></td>
                                <td><i class="fa fa-print print" data-toggle="modal" data-target="#vehicle" onclick="vehicleleva('vehicle',<?php echo $row[1]; ?>,'<?php echo $row[2]; ?>');"></i></td>
                                <td><i class="fa fa-refresh" onclick="takedata('<?php echo $_SESSION[shu]; ?>','update',<?php echo $row[1]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[1]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="6" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="6">
                                    <?php
                                        echo "Total record are : $_SESSION[vehiclename]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>


<!-- Manage assignfoodtype -->

<?php
    
   if($_REQUEST[shu]=="assignfoodtype")
   {
       
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $del=$con->query("delete from assignfoodtype where assignfoodid=$_REQUEST[id]");
       }
       
       $count=$con->query("SELECT count(*) FROM assignfoodtype a,hotel h where h.hotelid=a.hotelid and h.emailid like '$_SESSION[user]'");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[assignfoodtype]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
               
               
           }

       ?>
       
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                </div>
        </div>
    </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];

                $data = $con->query("select * from assignfoodtype where assignfoodid=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                ?>
                <div class="col-md-6 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" autocomplete="off" method="post" name="upassignfoodtype">
                                
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="col-md-6 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" method="post" name="assignfoodtype" autocomplete="off" >
                                <div class="row" style="padding-bottom:20px;">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <?php
                                            if ($_SESSION[dup] == 1) {
                                                echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
                                                $_SESSION[dup] = 0;
                                            }
                                            ?>
                                            <div class="input-field col s10">
                                                <select name="foodid" required="">
                                                <option value="" disabled="" selected="">Select food type</option>
                                                   <?php
                                                    $sel=$con->query("select * from food");
                                                    while($rowsel=  mysqli_fetch_array($sel))
                                                    {
                                                   ?>
                                                        <option value="<?php echo $rowsel[0]; ?>"><?php echo $rowsel[1]; ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>  
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">  
                                            <button type="submit" class="btn" name="sendassignfoodtype">Submit foodtype</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    ?>

            <div class="col-md-6 animated fadeInLeft">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>Food Type</th>
                    <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from assignfoodtype where name like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("SELECT * FROM assignfoodtype a,hotel h where h.hotelid=a.hotelid and h.emailid like '$_SESSION[user]' limit $st,$_REQUEST[perpage]");
                         }
                         while($row=  mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td><?php $sel=$con->query("select * from food where foodid=$row[1]");
                                            $rowsel=  mysqli_fetch_array($sel);
                                            echo $rowsel[1];?></td>
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[2]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="3" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="3">
                                    <?php
                                        echo "Total record are : $_SESSION[assignfoodtype]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>


<!-- Manage assignamenities -->

<?php
    
   if($_REQUEST[shu]=="assignamenities")
   {
       
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $del=$con->query("delete from assignamenities where assignamenitiesid=$_REQUEST[id]");
       }
       
       $count=$con->query("SELECT count(*) FROM assignamenities a,hotel h where h.hotelid=a.hotelid and h.emailid like '$_SESSION[user]'");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[assignfoodtype]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
               
               
           }

       ?>
       
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                </div>
        </div>
    </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];

                $data = $con->query("select * from assignamenities where assignamenitiesid=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                ?>
                <div class="col-md-6 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" autocomplete="off" method="post" name="upassignamenities">
                                
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="col-md-6 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-left:20px;">
                        <div class="col-md-12">
                            <form  action="" method="post" name="assignamenities" autocomplete="off" >
                                <div class="row" style="padding-bottom:20px;">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <?php
                                            if ($_SESSION[dup] == 1) {
                                                echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">first select amenities !....</font>';
                                                $_SESSION[dup] = 0;
                                            }
                                            ?>
                                            <div class="input-field col s10">
                                                <div class="row">
                                                   <?php
                                                    $sel=$con->query("SELECT * FROM amenities where amenitiesid not in(select amenitiesid from assignamenities where hotelid=$_SESSION[hotelid])");
                                                    while($rowsel=mysqli_fetch_array($sel))
                                                    {
                                                   ?>   
                                                    <div class="col-md-6" style="padding-top:15px;">
                                                                    <div class="input-field col s12">
                                                                        <input id="list-title<?php echo $rowsel[0]; ?>" type="checkbox" name="assignamenitiesid[]" value="<?php echo $rowsel[0]; ?>" class="validate">
                                                                            <label for="list-title<?php echo $rowsel[0]; ?>"><?php echo $rowsel[1]; ?></label>
                                                                    </div>
                                                            </div>
                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row adform1" style="padding-top:20px;">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <?php
                                            if(mysqli_num_rows($sel)>=1)
                                            {
                                            ?>
                                                <button type="submit" class="btn" name="sendassignamenities">Submit amenities</button> &nbsp;&nbsp;
                                                <button type="reset" class="btn ">Reset</button>
                                            <?php
                                            }
                                            else
                                            {
                                            ?>
                                                <h2>Already all amenities is selected !..</h2>
                                            <?php
                                            }
                                            ?>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    ?>

            <div class="col-md-6 animated fadeInLeft">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>amenities Type</th>
                    <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from assignamenities where name like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("SELECT * FROM assignamenities a,hotel h where h.hotelid=a.hotelid and h.emailid like '$_SESSION[user]' limit $st,$_REQUEST[perpage]");
                         }
                         while($row=  mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td><?php $sel=$con->query("select * from amenities where amenitiesid=$row[1]");
                                            $rowsel=  mysqli_fetch_array($sel);
                                            echo $rowsel[1];?></td>
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[2]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="3" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="3">
                                    <?php
                                        echo "Total record are : $_SESSION[assignfoodtype]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>




<!-- Manage assignroomtype -->

<?php
    
   if($_REQUEST[shu]=="assignroomtype")
   {
       
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $del=$con->query("delete from assignroomtype where assignroomtypeid=$_REQUEST[id]");
       }
       
       $count=$con->query("SELECT count(*) FROM assignroomtype a,hotel h where h.hotelid=a.hotelid and h.emailid like '$_SESSION[user]'");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[assignroomtype]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
               
               
           }

       ?>
       
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                </div>
        </div>
    </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];

                $data = $con->query("select * from assignroomtype where assignroomtypeid=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                $_SESSION[checkpotaniid]=$row[1];
                ?>
                <div class="col-md-5 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform257">
                        <div class="col-md-12">
                            <form  action="" autocomplete="off" method="post" name="upassignroomtype">
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <?php
                                            if ($_SESSION[dup] == 1) {
                                                echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
                                                $_SESSION[dup] = 0;
                                            }
                                            ?>
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[3]; ?>"  name="upnoofroom" required="" maxlength="3" pattern="^[0-9]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="active">update number of room</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[4]; ?>"  name="uprateperday" required="" maxlength="4" pattern="^[0-9]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="active">update rate perday</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="upabout" required="" class="materialize-textarea"><?php echo $row[5]; ?></textarea>
                                        <label for="textarea1" class="active">update about</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm"> 
                                            <button type="submit" class="btn" name="upassignroomtype">Update roomtype</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="col-md-5 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row adform257">
                        <div class="col-md-12">
                            <form  action="" method="post" name="assignroomtype" autocomplete="off" >
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <select name="roomid" required="">
                                                <option value="" disabled="" selected="">Select Room Type</option>
                                                <?php
                                                $sel=$con->query("select * from room");
                                                while ($row=  mysqli_fetch_array($sel))
                                                {
                                                ?>
                                                <option value="<?php echo $row[0]; ?>"><?php echo $row[1]; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>  
                                        </div>   
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <?php
                                            if ($_SESSION[dup] == 1) {
                                                echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
                                                $_SESSION[dup] = 0;
                                            }
                                            ?>
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text"  name="noofroom" required="" maxlength="3" pattern="^[0-9]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Enter number of room</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text"  name="rateperday" required="" maxlength="4" pattern="^[0-9]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Enter rate perday</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="about" required="" class="materialize-textarea"></textarea>
                                        <label for="textarea1" class="">Enter about</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">  
                                            <button type="submit" class="btn" name="sendassignroomtype">Send roomtype</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    ?>

            <div class="col-md-7 animated fadeInLeft">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>room Type</th>
                    <th>No of room</th>
                    <th>Rate per day</th>
                    <th>About</th>
                    <th></th>
                    <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                             $goto=$con->query("select * from hotel where emailid=$_SESSION[user]");
                             $apo=  mysqli_fetch_array($goto);
                         $data=$con->query("select * from assignroomtype where noofroom like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $goto=$con->query("select * from hotel where emailid=$_SESSION[user]");
                             $apo=  mysqli_fetch_array($goto);
                             $data=$con->query("SELECT * FROM assignroomtype a,hotel h where h.hotelid=a.hotelid and h.emailid like '$_SESSION[user]' limit $st,$_REQUEST[perpage]");
                         }
                         while($row=  mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td><?php $sel=$con->query("select * from room where roomid=$row[1]");
                                          $rowsel=mysqli_fetch_array($sel); 
                                           echo $rowsel[1];?></td>
                                <td><?php echo $row[3]; ?></td>
                                <td><?php echo $row[4]; ?></td>
                                <td><?php echo $row[5]; ?></td>
                                <td><i class="fa fa-refresh" onclick="takedata('<?php echo $_SESSION[shu]; ?>','update',<?php echo $row[2]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[2]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="6" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="6">
                                    <?php
                                        echo "Total record are : $_SESSION[assignroomtype]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>






<!-- Manage taxicompany -->

<?php
    
   if($_REQUEST[shu]=="taxicompany")
   {
       
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $del=$con->query("delete from taxicompany where taxicompanyid=$_REQUEST[id]");
       }
       
       $count=$con->query("select count(*) from taxicompany");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[taxicompany]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
        }

       ?>
       
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                </div>
        </div>
    </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];

                $data = $con->query("select * from taxicompany where taxicompanyid=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                $_SESSION[checkpotaniid]=$row[0];
                $_SESSION[checkpotaniid1]=$row[2];
                ?>
                <div class="col-md-5 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform256">
                        <div class="col-md-12">
                            <form  action="" autocomplete="off" method="post" name="uptaxicompany">
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[2]; ?>" name="upname"autofocus="" required="" pattern="^[a-z ]*$" class="validate lowertransfer">
                                                <label for="list-title" class="active">Update taxicompany name</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="upaddress" required="" class="materialize-textarea"><?php echo $row[3]; ?></textarea>
                                        <label for="textarea1" class="active">Update company address</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[4]; ?>"  name="upmobile" required="" maxlength="10" pattern="^[0-9]{10}$" class="validate lowertransfer" >
                                                <label for="list-title" class="active">Update company mobile</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
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
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[7]; ?>"  name="upgstno" required="" maxlength="15" pattern="^[A-Z0-9]{15}$" class="validate lowertransfer" >
                                                <label for="list-title" class="active">Update company gstno</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row adform1"> 
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm"> 
                                            <button type="submit" class="btn" name="uptaxicompany">Update details</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="col-md-5 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row adform256">
                        <div class="col-md-12">
                            <form  action="" method="post" name="taxicompany" autocomplete="off" >
                                
                                        <?php
                                            if ($_SESSION[dup] == 1) {
                                                echo '<div class="row"><div class="col-md-12"><font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font></div></div>';
                                                $_SESSION[dup] = 0;
                                            }
                                        ?>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating1">select Country</p>
                                        <div class="input-field col s10 editprofile">
                                            <select name="countryid" autofocus="" required="" onchange="selectleva('state',this.value)">
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
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating1">select state</p>
                                        <div class="input-field col s10 editprofile">
                                            <select name="stateid" id="statecombo" required="" onchange="selectleva('city',this.value)">
                                                <option value="" disabled="" selected="">Select state</option>
                                            </select>
                                        </div>   
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating1">select city</p>
                                        <div class="input-field col s10 editprofile" >
                                             <select name="cityid" id="citycombo" required="" onchange="selectleva('placetaxi',this.value)">
                                                <option value="" disabled="" selected="">Select city</option>
                                            </select>
                                        </div>   
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating1">select place</p>
                                        <div class="input-field col s10 editprofile">
                                            <select name="placeid" id="placetaxicombo" required="">
                                                <option value="" disabled="" selected="">Select place</option>
                                            </select>
                                        </div>   
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text"  name="name" required="" pattern="^[a-z ]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Enter company Name</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="address" required="" class="materialize-textarea"></textarea>
                                        <label for="textarea1" class="">Enter company address</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text"  name="mobile" required="" maxlength="10" pattern="^[0-9]{10}$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Enter company mobile</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="map" required="" class="materialize-textarea"></textarea>
                                        <label for="textarea1" class="">Enter company map</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="about" required="" class="materialize-textarea"></textarea>
                                        <label for="textarea1" class="">Enter company about</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text"  name="gstno" required="" maxlength="15" pattern="^[A-Z0-9]{15}$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Enter company gstno</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                 <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="email"  name="emailid" required="" class="validate lowertransfer" >
                                                <label for="list-title" class="">Enter company emailid</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">  
                                            <button type="submit" class="btn" name="sendtaxicompany">Send details</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    ?>

            <div class="col-md-7 animated fadeInLeft">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>Company Name</th>
                    <th>view in details</th>
                    <th></th>
                    <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from taxicompany where name like '$_REQUEST[id]%' or emailid like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from taxicompany limit $st,$_REQUEST[perpage]");
                         }
                         while($row=  mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td><?php echo $row[2]; ?></td>
                                <td><i class="fa fa-print print" data-toggle="modal" data-target="#taxicompany" onclick="taxicompanyleva('taxi',<?php echo $row[1]; ?>);"></i></td>
                                <td><i class="fa fa-refresh" onclick="takedata('<?php echo $_SESSION[shu]; ?>','update',<?php echo $row[1]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[1]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="3" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="3">
                                    <?php
                                        echo "Total record are : $_SESSION[taxicompany]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>



<!-- Manage schedule -->

<?php
    
   if($_REQUEST[shu]=="schedule")
   {
       
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $del=$con->query("delete from schedule where scheduleid=$_REQUEST[id]");
       }
       
       $count=$con->query("select count(*) from schedule");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[schedule]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
               
               
           }

       ?>
       
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                </div>
        </div>
    </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];

                $data = $con->query("select * from schedule where scheduleid=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                ?>
                <div class="col-md-5 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform256" style="height:750px;">
                        <div class="col-md-12">
                            <form  action="" method="post" name="upschedule" autocomplete="off" >                                
                                <div class="row">
                                    <div class="col-md-12">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="date" name="upfromdate" min="<?php echo date('Y-m-d'); ?>" value="<?php echo $row[2]; ?>" required="" onchange="deschudle(this.value);"/>
                                                <label for="list-title" class="active">Update fromdate</label>
                                            </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="date" name="uptodate" min="<?php echo date('Y-m-d'); ?>" id="datedeschudle" value="<?php echo $row[3]; ?>" required="" />
                                                 <label for="list-title" class="active">Update todate</label>
                                            </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" name="uppickuppoint" required="" pattern="^[a-z ]*$" value="<?php echo $row[4]; ?>" class="validate lowertransfer">
                                                <label for="list-title" class="active">Update pickuppoint</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" name="updroppoint" required="" pattern="^[a-z ]*$" value="<?php echo $row[5]; ?>" class="validate lowertransfer">
                                                <label for="list-title" class="active">Update droppoint</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <input id="post-auth" type="time" name="uppickuptime" required="" value="<?php echo $row[6]; ?>" class="validate">
                                            <label for="post-auth" class="active">Update pickuptime</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating">Update Goby</p>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom:20px;">
                                    <div class="col-md-2">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="radio" name="upgoby" value="aeroplan" <?php if($row[7]=='aeroplan'){ echo 'checked'; } ?> class="with-gap">
                                            <label for="list-title"><i class="fa fa-plane"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="radio" name="upgoby" value="bus" <?php if($row[7]=='bus'){ echo 'checked'; } ?> class="with-gap">
                                            <label for="list-title"><i class="fa fa-bus"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="radio" name="upgoby" value="train" <?php if($row[7]=='train'){ echo 'checked'; } ?> class="with-gap">
                                            <label for="list-title"><i class="fa fa-train"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="radio" name="upgoby" value="car" <?php if($row[7]=='car'){ echo 'checked'; } ?> class="with-gap">
                                            <label for="list-title"><i class="fa fa-car"></i></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating">Update returnby</p>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom:20px;">
                                    <div class="col-md-2">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="radio" name="upreturnby" value="aeroplan" <?php if($row[8]=='aeroplan'){ echo 'checked'; } ?> class="with-gap">
                                            <label for="list-title"><i class="fa fa-plane"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="radio" name="upreturnby" value="bus" <?php if($row[8]=='bus'){ echo 'checked'; } ?>  class="with-gap">
                                            <label for="list-title"><i class="fa fa-bus"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="radio" name="upreturnby" value="train" <?php if($row[8]=='train'){ echo 'checked'; } ?> class="with-gap">
                                            <label for="list-title"><i class="fa fa-train"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="radio" name="upreturnby" value="car" <?php if($row[8]=='car'){ echo 'checked'; } ?> class="with-gap">
                                            <label for="list-title"><i class="fa fa-car"></i></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">  
                                            <button type="submit" class="btn" name="upschedule">Update schedule</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="col-md-5 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row adform256" style="height:800px;">
                        <div class="col-md-12">
                            <form  action="" method="post" name="schedule" autocomplete="off" >
                                
                                <div class="row" style="padding-bottom:10px;">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                        <?php
                                            if ($_SESSION[dup] == 1) {
                                                echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
                                                $_SESSION[dup] = 0;
                                            }
                                         ?>
                                        <div class="input-field col s10">
                                            <select name="packageid" required="">
                                                <option value="" disabled selected>Select package</option>
                                                <?php
                                                $datasel = $con->query("select * from package");
                                                while ($rowsel = mysqli_fetch_array($datasel)) {
                                                ?>
                                                 <option value="<?php echo $rowsel[0]; ?>"><?php echo $rowsel[1]; ?></option>
                                                <?php
                                                }
                                                ?>
                                            </select>  
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating">fromdate</p>
                                            <div class="input-field col s10">
                                                <input id="list-title" type="date" name="fromdate" min="<?php echo date('Y-m-d'); ?>" onchange="dedate(this.value);" required=""/>
                                            </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating">todate</p>
                                            <div class="input-field col s10">
                                                <input id="list-title" type="date" name="todate" min="<?php echo date('Y-m-d'); ?>" id="dateaapo" required=""/>
                                            </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" name="pickuppoint" required="" pattern="^[a-z ]*$" class="validate lowertransfer">
                                                <label for="list-title" class="">Enter pickuppoint</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" name="droppoint" required="" pattern="^[a-z ]*$" class="validate lowertransfer">
                                                <label for="list-title" class="">Enter droppoint</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                         <p class="labelrating">Enter pickuptime</p>
                                        <div class="input-field col s10">
                                            <input id="post-auth" type="time" name="pickuptime" required="" class="validate">
                                            <label for="post-auth" class=""></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating">Goby</p>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom:20px;">
                                    <div class="col-md-2">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="radio" name="goby" value="aeroplan" checked="" class="with-gap">
                                            <label for="list-title"><i class="fa fa-plane"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="radio" name="goby" value="bus" class="with-gap">
                                            <label for="list-title"><i class="fa fa-bus"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="radio" name="goby" value="train" class="with-gap">
                                            <label for="list-title"><i class="fa fa-train"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="radio" name="goby" value="car" class="with-gap">
                                            <label for="list-title"><i class="fa fa-car"></i></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating">returnby</p>
                                    </div>
                                </div>
                                <div class="row" style="padding-bottom:20px;">
                                    <div class="col-md-2">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="radio" name="returnby" value="aeroplan" checked="" class="with-gap">
                                            <label for="list-title"><i class="fa fa-plane"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="radio" name="returnby" value="bus"  class="with-gap">
                                            <label for="list-title"><i class="fa fa-bus"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="radio" name="returnby" value="train" class="with-gap">
                                            <label for="list-title"><i class="fa fa-train"></i></label>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="radio" name="returnby" value="car" class="with-gap">
                                            <label for="list-title"><i class="fa fa-car"></i></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">  
                                            <button type="submit" class="btn" name="sendschedule">Send schedule</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    ?>

            <div class="col-md-7 animated fadeInLeft">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>package name</th>
                    <th>from date</th>
                    <th>to date</th>
                    <th>pickup point</th>
                    <th>drop point</th>
                    <th>pickup time</th>
                    <th>go by</th>
                    <th>return by</th>
                    <th></th>
                    <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from schedule where schedule like '$_REQUEST[id]%' or droppoint like '$_REQUEST[id]%' or goby like '$_REQUEST[id]%' or returnby like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from schedule");
                         }
                         while($row=  mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td><?php $sel=$con->query("select * from package where packageid=$row[0]");
                                            $data1=  mysqli_fetch_array($sel);
                                            echo $data1[1];?></td>
                                <td><?php echo $row[2]; ?></td>
                                <td><?php echo $row[3]; ?></td>
                                <td><?php echo $row[4]; ?></td>
                                <td><?php echo $row[5]; ?></td> 
                                <td><?php echo $row[6]; ?></td>
                                <td><?php if($row[7]=='aeroplan'){ echo "<i class='fa fa-plane'></i>";}
                                          elseif($row[7]=='bus'){ echo "<i class='fa fa-bus'></i>";}
                                          elseif($row[7]=='train'){ echo "<i class='fa fa-train'></i>";}
                                          elseif($row[7]=='car'){ echo "<i class='fa fa-car'></i>";}
                                     ?></td>
                                <td><?php if($row[8]=='aeroplan'){ echo "<i class='fa fa-plane'></i>";}
                                          elseif($row[8]=='bus'){ echo "<i class='fa fa-bus'></i>";}
                                          elseif($row[8]=='train'){ echo "<i class='fa fa-train'></i>";}
                                          elseif($row[8]=='car'){ echo "<i class='fa fa-car'></i>";}
                                    ?></td>
                                <td><i class="fa fa-refresh" onclick="takedata('<?php echo $_SESSION[shu]; ?>','update',<?php echo $row[1]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[1]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="10" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="10">
                                    <?php
                                        echo "Total record are : $_SESSION[schedule]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>


<!-- Manage Country -->

<?php
    
   if($_REQUEST[shu]=="country")
   {
       
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $del=$con->query("delete from country where countryid=$_REQUEST[id]");
       }
       
       $count=$con->query("select count(*) from country");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[country]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
               
               
           }

       ?>
       
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                </div>
        </div>
    </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];

                $data = $con->query("select * from country where countryid=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                ?>
                <div class="col-md-6 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" autocomplete="off" method="post" name="upcountry">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[1]; ?>" name="upname"autofocus="" required="" pattern="^[a-z ]*$" class="validate lowertransfer">
                                                <label for="list-title" class="active">Update Country</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm"> 
                                            <button type="submit" class="btn" name="upcountry">Update Country</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="col-md-6 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" method="post" name="country" autocomplete="off" >
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
        <?php
        if ($_SESSION[dup] == 1) {
            echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
            $_SESSION[dup] = 0;
        }
        ?>
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text"  name="name" required="" pattern="^[a-z ]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Enter Country</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">  
                                            <button type="submit" class="btn" name="sendcountry">Send Country</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    ?>

            <div class="col-md-6 animated fadeInLeft">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>Country</th>
                    <th></th>
                    <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from country where name like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from country limit $st,$_REQUEST[perpage]");
                         }
                         while($row=  mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td><?php echo $row[1]; ?></td>
                                <td><i class="fa fa-refresh" onclick="takedata('<?php echo $_SESSION[shu]; ?>','update',<?php echo $row[0]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[0]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="3" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="3">
                                    <?php
                                        echo "Total record are : $_SESSION[country]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>



<!-- Manage room -->

<?php
    
   if($_REQUEST[shu]=="room")
   {
       
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $del=$con->query("delete from room where roomid=$_REQUEST[id]");
       }
       
       $count=$con->query("select count(*) from room");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[room]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
               
               
           }

       ?>
       
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                        <div class="spe-title">
                                    <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                                    <div class="title-line">
                                        <div class="tl-1"></div>
                                        <div class="tl-2"><i class="fa fa-gg"></i></div>
                                        <div class="tl-3"></div>

                                    </div>
                        </div>
                </div>
            </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];

                $data = $con->query("select * from room where roomid=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                ?>
                <div class="col-md-6 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" autocomplete="off" method="post" name="updateroom">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[1]; ?>" name="uproomtype" autofocus="" required="" pattern="^[a-z ]*$" class="validate lowertransfer">
                                                <label for="list-title" class="active">Update room</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm"> 
                                            <button type="submit" class="btn" name="uproom">Update room</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="col-md-6 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" method="post" name="room" autocomplete="off" >
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
        <?php
        if ($_SESSION[dup] == 1) {
            echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
            $_SESSION[dup] = 0;
        }
        ?>
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text"  name="roomtype" required="" pattern="^[a-z ]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Enter room</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">  
                                            <button type="submit" class="btn" name="sendroom">Send room</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    ?>

            <div class="col-md-6 animated fadeInLeft">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>room type</th>
                    <th></th>
                    <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from room where roomtype like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from room limit $st,$_REQUEST[perpage]");
                         }
                         while($row=  mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td><?php echo $row[1]; ?></td>
                                <td><i class="fa fa-refresh" onclick="takedata('<?php echo $_SESSION[shu]; ?>','update',<?php echo $row[0]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[0]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="3" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="3">
                                    <?php
                                        echo "Total record are : $_SESSION[room]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>


<!-- Manage  food-->

<?php
    
   if($_REQUEST[shu]=="food")
   {
       
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $del=$con->query("delete from food where foodid=$_REQUEST[id]");
       }
       
       $count=$con->query("select count(*) from food");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[food]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
               
               
           }

       ?>
       
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                        <div class="spe-title">
                                    <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                                    <div class="title-line">
                                        <div class="tl-1"></div>
                                        <div class="tl-2"><i class="fa fa-gg"></i></div>
                                        <div class="tl-3"></div>

                                    </div>
                        </div>
                </div>
            </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];

                $data = $con->query("select * from food where foodid=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                ?>
                <div class="col-md-6 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" autocomplete="off" method="post" name="updatefood">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[1]; ?>" name="upfoodtype" autofocus="" required="" pattern="^[a-z ]*$" class="validate lowertransfer">
                                                <label for="list-title" class="active">Update foodtype</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm"> 
                                            <button type="submit" class="btn" name="upfood">Update food</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="col-md-6 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" method="post" name="food" autocomplete="off" >
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <?php
                                            if ($_SESSION[dup] == 1) {
                                                echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
                                                $_SESSION[dup] = 0;
                                            }
                                            ?>
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text"  name="foodtype" required="" pattern="^[a-z ]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Enter food type</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">  
                                            <button type="submit" class="btn" name="sendfood">Send food</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    ?>

            <div class="col-md-6 animated fadeInLeft">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>food type</th>
                    <th></th>
                    <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from food where foodtype like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from food limit $st,$_REQUEST[perpage]");
                         }
                         while($row=  mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td><?php echo $row[1]; ?></td>
                                <td><i class="fa fa-refresh" onclick="takedata('<?php echo $_SESSION[shu]; ?>','update',<?php echo $row[0]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[0]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="3" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="3">
                                    <?php
                                        echo "Total record are : $_SESSION[food]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>


<!-- Manage  amenities -->

<?php
    
   if($_REQUEST[shu]=="amenities")
   {
       
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $del=$con->query("delete from amenities where amenitiesid=$_REQUEST[id]");
       }
       
       $count=$con->query("select count(*) from amenities");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[amenities]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
               
               
           }

       ?>
       
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                        <div class="spe-title">
                                    <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                                    <div class="title-line">
                                        <div class="tl-1"></div>
                                        <div class="tl-2"><i class="fa fa-gg"></i></div>
                                        <div class="tl-3"></div>

                                    </div>
                        </div>
                </div>
            </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];

                $data = $con->query("select * from amenities where amenitiesid=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                ?>
                <div class="col-md-6 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" autocomplete="off" method="post" name="updateamenities">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[1]; ?>" name="upamenitiestype" autofocus="" required="" pattern="^[a-z ]*$" class="validate lowertransfer">
                                                <label for="list-title" class="active">Update amenitiestype</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm"> 
                                            <button type="submit" class="btn" name="upamenities">Update amenities</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="col-md-6 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" method="post" name="amenities" autocomplete="off" >
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <?php
                                            if ($_SESSION[dup] == 1) {
                                                echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
                                                $_SESSION[dup] = 0;
                                            }
                                            ?>
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text"  name="amenitiestype" required="" pattern="^[a-z ]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Enter amenities type</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">  
                                            <button type="submit" class="btn" name="sendamenities">Send amenities</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    ?>

            <div class="col-md-6 animated fadeInLeft">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>amenities type</th>
                    <th></th>
                    <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from amenities where amenitiestype like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from amenities limit $st,$_REQUEST[perpage]");
                         }
                         while($row=  mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td><?php echo $row[1]; ?></td>
                                <td><i class="fa fa-refresh" onclick="takedata('<?php echo $_SESSION[shu]; ?>','update',<?php echo $row[0]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[0]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="3" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="3">
                                    <?php
                                        echo "Total record are : $_SESSION[amenities]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>




<!-- Manage  vehicle-->

<?php
    
   if($_REQUEST[shu]=="vehicle")
   {
       
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $del=$con->query("delete from vehicle where vehicleid=$_REQUEST[id]");
       }
       
       $count=$con->query("select count(*) from vehicle");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[vehicle]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
               
               
           }

       ?>
       
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                        <div class="spe-title">
                                    <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                                    <div class="title-line">
                                        <div class="tl-1"></div>
                                        <div class="tl-2"><i class="fa fa-gg"></i></div>
                                        <div class="tl-3"></div>

                                    </div>
                        </div>
                </div>
            </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];

                $data = $con->query("select * from vehicle where vehicleid=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                ?>
                <div class="col-md-6 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" autocomplete="off" method="post" name="updatevehicle">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[1]; ?>" name="upvehicletype" autofocus="" required="" pattern="^[a-z ]*$" class="validate lowertransfer">
                                                <label for="list-title" class="active">Update vehicle type</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm"> 
                                            <button type="submit" class="btn" name="upvehicle">Update vehicle</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>
                <div class="col-md-6 animated fadeInRight">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" method="post" name="vehicle" autocomplete="off" >
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <?php
                                            if ($_SESSION[dup] == 1) {
                                                echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
                                                $_SESSION[dup] = 0;
                                            }
                                            ?>
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text"  name="vehicletype" required="" pattern="^[a-z ]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Enter vehicle type</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">  
                                            <button type="submit" class="btn" name="sendvehicle">Send vehicle</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    ?>

            <div class="col-md-6 animated fadeInLeft">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>vehicle type</th>
                    <th></th>
                    <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from vehicle where vehicletype like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from vehicle limit $st,$_REQUEST[perpage]");
                         }
                         while($row=  mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td><?php echo $row[1]; ?></td>
                                <td><i class="fa fa-refresh" onclick="takedata('<?php echo $_SESSION[shu]; ?>','update',<?php echo $row[0]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[0]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="3" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="3">
                                    <?php
                                        echo "Total record are : $_SESSION[vehicle]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>
     
    <!-- Manage  User-->

<?php
    
   if($_REQUEST[shu]=="user")
   {
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $unlinkmate=$con->query("select * from register where packageid=$_REQUEST[id]");
           $dataunlinkmate=  mysqli_fetch_array($unlinkmate);
           unlink($dataunlinkmate[10]);
           $del=$con->query("delete from register where emailid like '$_REQUEST[id]' ");
       }
       
       $count=$con->query("select count(*) from register");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[client]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
               
               
           }

       ?>
       
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?> </span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                        </div>
                    </div>
        </div>
    <div class="row ">
       
        <div class="col-md-12">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?> <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>Country Name</th>
                    <th>State Name</th>
                    <th>City Name</th>
                    <th>Photo</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Email Address</th>
                    <th>Contact</th>
                    <th>Gender</th>
                    <th>Password</th>
                    <th>Type</th>
                    <th>Delete</th>
                    
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from register where fname like '$_REQUEST[id]%' or lname like '$_REQUEST[id]%' or emailid like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from register limit $st,$_REQUEST[perpage]");
                         }
                         while($row=  mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td><?php $datasell=$con->query("select * from country where countryid=$row[0];");
                                       $rowsell=  mysqli_fetch_array($datasell); 
                                       echo $rowsell[1];?></td>
                                <td><?php $datasell=$con->query("select * from state where stateid=$row[1];");
                                       $rowsell=  mysqli_fetch_array($datasell); 
                                       echo $rowsell[2];?></td>
                                <td><?php $datasell=$con->query("select * from city where cityid=$row[2];");
                                       $rowsell=  mysqli_fetch_array($datasell); 
                                       echo $rowsell[2];?></td>
                                <td><img src="../<?php echo $row[10]; ?>" height="100px" width="100px"/></td>   
                                <td><?php echo $row[3]; ?></td>
                                <td><?php echo $row[4]; ?></td>
                                <td><?php echo $row[5]; ?></td>
                                <td><?php echo $row[6]; ?></td>
                                <td><?php echo $row[7]; ?></td>
                                <td onclick="showpass('<?php echo $row[8]; ?>',<?php echo $ketla; ?>);" id="<?php echo $ketla; ?>">**********</td>
                                
                                <td class="fafaset">
                                    <?php 
                                    if($row[9]==0)
                                    { 
                                    ?> 
                                    <i class="fa fa-user-circle"></i>
                                    <?php 
                                    }
                                    elseif($row[9]==1) 
                                    {
                                    ?>
                                    <i class="fa fa-user"></i>
                                    <?php
                                    }
                                    ?>
                                </td>
                                
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete','<?php echo $row[5]; ?>',<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="12" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="12">
                                    <?php
                                        echo "Total Record Are = $_SESSION[client]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>

    
    <!-- Manage review -->

<?php
    
   if($_REQUEST[shu]=="review")
   {
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $del=$con->query("delete from review where reviewid=$_REQUEST[id]");
       }
       
       $count=$con->query("select count(*) from review");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[review]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
               
               
           }

       ?>
       
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?> </span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                        </div>
                    </div>
        </div>
    <div class="row ">
       
        <div class="col-md-12">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?> <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>Package Name</th>
                    <th>User</th>
                    <th>Review</th>
                    <th>Review date</th>
                    <th></th>
                    
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from review where emailid like '$_REQUEST[id]%' or review like '$_REQUEST[id]%' or reviewdate like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from review limit $st,$_REQUEST[perpage]");
                         }
                         while($row=  mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td><?php $sel=$con->query("select * from package where packageid=$row[0]"); 
                                           $rowsel=mysqli_fetch_array($sel);
                                           echo $rowsel[1];?> &nbsp; <i class="fa fa-print print" data-toggle="modal" data-target="#viewmore" onclick="viewmoreleva('package',<?php echo $rowsel[0]; ?>);"></i></td>
                                <td><?php $sel1=$con->query("select * from register where emailid like '$row[1]'"); 
                                           $rowsel1=mysqli_fetch_array($sel1);
                                           echo $rowsel1[3]." ".$rowsel1[4];?></td>
                                <td><?php echo $row[3]; ?></td>
                                <td><?php echo $row[4]; ?></td> 
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete','<?php echo $row[2]; ?>',<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="5" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="5">
                                    <?php
                                        echo "Total Record Are = $_SESSION[review]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>

    
    
    
<!-- Manage state -->

<?php
    
   if($_REQUEST[shu]=="state")
   {
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $del=$con->query("delete from state where stateid=$_REQUEST[id]");
       }
       
       $count=$con->query("select count(*) from state");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[state]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
           }

       ?>
       
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                        </div>
                    </div>
        </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];

                $data = $con->query("select * from state where stateid=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                $_SESSION[checkpotaniid]=$row[0];
                ?>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" autocomplete="off" method="post" name="upstate">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[2]; ?>" autofocus="" name="upname" required="" pattern="^[a-z ]*$" class="validate lowertransfer">
                                                <label for="list-title" class="active">Update state</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm"> 
                                            <button type="submit" class="btn" name="upstate">Update state</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>      
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" method="post" name="state" autocomplete="off" >
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        
                                        
                                        <div class="input-field col s10">
                                            <select name="countryid" required="">
                                                <option value="" disabled selected>Select Country</option>
                                                        <?php
                                                        $datasel = $con->query("select * from country");
                                                        while ($rowsel = mysqli_fetch_array($datasel)) 
                                                        {
                                                        ?>
                                                            <option value="<?php echo $rowsel[0]; ?>"><?php echo $rowsel[1]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                            </select>
                                             
                                        </div>
                                        
                                        
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                                <?php
                                                if ($_SESSION[dup] == 1) {
                                                    echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
                                                    $_SESSION[dup] = 0;
                                                }
                                                ?>
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text"  name="name" required="" pattern="^[a-z ]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Enter state</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">  
                                            <button type="submit" class="btn" name="sendstate">Send state</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    ?>

            <div class="col-md-6">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>country </th>
                    <th>Name</th>
                    <th></th>
                     <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from state where name like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from state limit $st,$_REQUEST[perpage]");
                         }
                         while($row=mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td><?php $datasell=$con->query("select * from country where countryid=$row[0];");
                                       $rowsell=  mysqli_fetch_array($datasell); 
                                       echo $rowsell[1];?></td>
                                <td><?php echo $row[2]; ?></td>
                                <td><i class="fa fa-refresh" onclick="takedata('<?php echo $_SESSION[shu]; ?>','update',<?php echo $row[1]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[1]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="3" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="3">
                                    <?php
                                        echo "Total record are : $_SESSION[state]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>




<!-- Manage city -->

<?php
    
   if($_REQUEST[shu]=="city")
   {
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $del=$con->query("delete from city where cityid=$_REQUEST[id]");
       }
       
       $count=$con->query("select count(*) from city");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[city]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
           }

       ?>
       
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                        </div>
                    </div>
        </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];

                $data = $con->query("select * from city where cityid=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                 $_SESSION[checkpotaniid]=$row[0];
                ?>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" autocomplete="off" method="post" name="upcity">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[2]; ?>" autofocus="" name="upname" required="" pattern="^[a-z ]*$" class="validate lowertransfer">
                                                <label for="list-title" class="active">Update city</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm"> 
                                            <button type="submit" class="btn" name="upcity">Update city</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>      
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" method="post" name="city" autocomplete="off" >
                                
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="input-field col s10 editprofile">
                                                    <select name="countryid" autofocus="" required="" onchange="selectleva('state',this.value)">        
                                                        <option value="" disabled="" selected="">Select country</option>
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
                                        </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <select name="stateid" id="statecombo" required="">
                                                 <option value="" disabled="" selected="">Select State</option>
                                            </select>
                                        </div>   
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                                <?php
                                                if ($_SESSION[dup] == 1) {
                                                    echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
                                                    $_SESSION[dup] = 0;
                                                }
                                                ?>
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text"  name="name" required="" pattern="^[a-z ]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Enter city</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">  
                                            <button type="submit" class="btn" name="sendcity">Send city</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    ?>

            <div class="col-md-6">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>State</th>
                    <th>city</th>
                    <th></th>
                     <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from city where name like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from city limit $st,$_REQUEST[perpage]");
                         }
                         while($row=mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td><?php $datasell=$con->query("select * from state where stateid=$row[0];");
                                       $rowsell=  mysqli_fetch_array($datasell); 
                                       echo $rowsell[2];?></td>
                                <td><?php echo $row[2]; ?></td>
                                <td><i class="fa fa-refresh" onclick="takedata('<?php echo $_SESSION[shu]; ?>','update',<?php echo $row[1]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[1]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="4" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="4">
                                    <?php
                                        echo "Total record are : $_SESSION[city]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>
  
<!-- Manage place -->

<?php
    
   if($_REQUEST[shu]=="place")
   {
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $unlinkmate=$con->query("select * from place where placeid=$_REQUEST[id]");
           $dataunlinkmate=  mysqli_fetch_array($unlinkmate);
           unlink($dataunlinkmate[4]);
           $del=$con->query("delete from place where placeid=$_REQUEST[id]");
       }
       
       $count=$con->query("select count(*) from place");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[place]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
           }

       ?>
       
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                        </div>
                    </div>
        </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];

                $data = $con->query("select * from place where placeid=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                $_SESSION[checkpotaniid]=$row[0];
                $_SESSION[checkpotaniid1]=$row[2];
                ?>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" autocomplete="off" method="post" name="upplace" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[2]; ?>" autofocus="" name="upplacename" required="" pattern="^[a-z ]*$" class="validate lowertransfer">
                                                <label for="list-title" class="active">Update placename</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <textarea id="uptextarea1" name="upbriefhistory" required="" class="materialize-textarea"><?php echo $row[3]; ?></textarea>
                                            <label for="uptextarea1" class="active">briefhistory</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                        <div class="file-field">
                                            <div class="btn">
                                                <span>File</span>
                                                <input type="file" name="upphoto">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" placeholder="Upload photo">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm"> 
                                            <button type="submit" class="btn" name="upplace">Update city</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>      
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" method="post" name="place" autocomplete="off" enctype="multipart/form-data">
                                
                                <div class="row">
                                <div class="col-md-12">
                                        <div class="input-field col s10 editprofile">
                                            <select name="countryid" autofocus="" required="" onchange="selectleva('state',this.value)">        
                                                 <option value="" disabled="" selected="">Select country</option>
                                                <?php
                                                        $datasel = $con->query("select * from country");
                                                        while ($rowsel = mysqli_fetch_array($datasel)) 
                                                        {
                                                        ?>
                                                            <option value="<?php echo $rowsel[0]; ?>"><?php echo $rowsel[1]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                            </select>  
                                        </div>   
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="input-field col s10 editprofile">
                                            <select name="stateid" id="statecombo" required="" onchange="selectleva('city',this.value)">
                                                <option value="" disabled="" selected="">Select State</option>
                                            </select>
                                        </div>
                                </div>
                            </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <select name="cityid" required="" id="citycombo">
                                                <option value="" disabled="" selected="">Select city</option>        
                                            </select>  
                                        </div>   
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                                <?php
                                                if ($_SESSION[dup] == 1) {
                                                    echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
                                                    unset($_SESSION[dup]);
                                                }
                                                ?>
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text"  name="placename" required="" pattern="^[a-z ]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Enter placename</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="briefhistory" required="" class="materialize-textarea"></textarea>
                                        <label for="textarea1">briefhistory</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
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
                                                <input type="file" name="photo" required="">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" placeholder="Upload photo">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">  
                                            <button type="submit" class="btn" name="sendplace">Send city</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    ?>

            <div class="col-md-6">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>city</th>
                    <th>Place</th>
                    <th>Brief History</th>
                     <th>photo</th>
                     <th></th>
                     <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from place where placename like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from place limit $st,$_REQUEST[perpage]");
                         }
                         while($row=mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td><?php $datasell=$con->query("select * from city where cityid=$row[0];");
                                       $rowsell=  mysqli_fetch_array($datasell); 
                                       echo $rowsell[2];?></td>
                                <td><?php echo $row[2]; ?></td>
                                <td><?php echo $row[3]; ?></td>
                                <td><img src="../<?php echo $row[4]; ?>" height="100px" width="100px"/></td>
                                <td><i class="fa fa-refresh" onclick="takedata('<?php echo $_SESSION[shu]; ?>','update',<?php echo $row[1]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[1]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="6" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="6">
                                    <?php
                                        echo "Total record are : $_SESSION[place]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>



<!-- Manage place point -->

<?php
    
   if($_REQUEST[shu]=="placepoint")
   {
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $unlinkmate=$con->query("select * from placepoint where pointid=$_REQUEST[id]");
           $dataunlinkmate=  mysqli_fetch_array($unlinkmate);
           unlink($dataunlinkmate[5]);
           $del=$con->query("delete from placepoint where pointid=$_REQUEST[id]");
       }
       
       $count=$con->query("select count(*) from placepoint");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[placepoint]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
           }

       ?>
       
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                        </div>
                    </div>
        </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];

                $data = $con->query("select * from placepoint where pointid=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                $_SESSION[checkpotaniid]=$row[0];
                $_SESSION[checkpotaniid1]=$row[2];
                
                ?>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" autocomplete="off" method="post" name="upplacepoint" enctype="multipart/form-data">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[2]; ?>" autofocus="" name="upname" required="" pattern="^[a-z ]*$" class="validate lowertransfer">
                                                <label for="list-title" class="active">Update name</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[3]; ?>" name="upkmfromcenterpoint" required="" pattern="^[0-9.]*$" class="validate lowertransfer">
                                                <label for="list-title" class="active">Update kmfromcenterpoint</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <textarea id="uptextarea1" name="upbriefhistory" required="" class="materialize-textarea"><?php echo $row[4]; ?></textarea>
                                            <label for="uptextarea1" class="active"> Update briefhistory</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating">Update place Point photo</p>
                                        <div class="input-field col s10">
                                        <div class="file-field">
                                            <div class="btn">
                                                <span>File</span>
                                                <input type="file" name="upphoto">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" placeholder="Upload photo">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>

                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm"> 
                                            <button type="submit" class="btn" name="upplacepoint">Update Placepoint</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>      
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" method="post" name="placepoint" autocomplete="off" enctype="multipart/form-data">
                                
                                <div class="row">
                                <div class="col-md-12">
                                        <div class="input-field col s10 editprofile">
                                            <select name="countryid" autofocus="" required="" onchange="selectleva('state',this.value)">        
                                                 <option value="" disabled="" selected="">Select country</option>
                                                <?php
                                                        $datasel = $con->query("select * from country");
                                                        while ($rowsel = mysqli_fetch_array($datasel)) 
                                                        {
                                                        ?>
                                                            <option value="<?php echo $rowsel[0]; ?>"><?php echo $rowsel[1]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                            </select>  
                                        </div>   
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="input-field col s10 editprofile">
                                            <select name="stateid" id="statecombo" required="" onchange="selectleva('city',this.value)">
                                                <option value="" disabled="" selected="">Select State</option>
                                            </select>
                                        </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="input-field col s10 editprofile">
                                            <select name="cityid" id="citycombo" required="" onchange="selectleva('placetaxi',this.value)">
                                                 <option value="" disabled="" selected="">Select city</option>        
                                            </select>
                                        </div>   
                                </div>
                            </div>

                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <select name="placeid" required="" id="placetaxicombo">
                                                <option value="" disabled="" selected="">Select place</option>
                                            </select>  
                                        </div>   
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                                <?php
                                                if ($_SESSION[dup] == 1) {
                                                    echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
                                                    $_SESSION[dup] = 0;
                                                }
                                                ?>
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text"  name="name" required="" pattern="^[a-z ]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Enter placepoint name</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" name="kmfromcenterpoint" required="" pattern="^[0-9.]*$" class="validate lowertransfer">
                                                <label for="list-title" class="">Enter km from centerpoint</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="briefhistory" required="" class="materialize-textarea"></textarea>
                                        <label for="textarea1">Enter briefhistory</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
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
                                                <input type="file" name="photo" required="">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" placeholder="Upload photo">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">  
                                            <button type="submit" class="btn" name="sendplacepoint">Send placepoint</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    ?>

            <div class="col-md-6">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>placename</th>
                    <th>Point Name</th>
                    <th>Km form Center Point</th>
                    <th>Brief History</th>
                     <th>photo</th>
                     <th></th>
                     <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from placepoint where name like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from placepoint limit $st,$_REQUEST[perpage]");
                         }
                         while($row=mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td><?php $datasell=$con->query("select * from place where placeid=$row[0];");
                                       $rowsell=  mysqli_fetch_array($datasell); 
                                       echo $rowsell[2];?></td>
                                <td><?php echo $row[2]; ?></td>
                                <td><?php echo $row[3]; ?></td>
                                <td><?php echo $row[4]; ?></td>
                                <td><img src="../<?php echo $row[5]; ?>" height="100px" width="100px"/></td>
                                <td><i class="fa fa-refresh" onclick="takedata('<?php echo $_SESSION[shu]; ?>','update',<?php echo $row[1]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[1]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="6" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="6">
                                    <?php
                                        echo "Total record are : $_SESSION[placepoint]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>


  



<!-- Manage package -->

<?php
//package
    
   if($_REQUEST[shu]=="package")
   {
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $unlinkmate=$con->query("select * from package where packageid=$_REQUEST[id]");
           $dataunlinkmate=  mysqli_fetch_array($unlinkmate);
           unlink($dataunlinkmate[5]);
           unlink($dataunlinkmate[6]);
           $del=$con->query("delete from package where packageid=$_REQUEST[id]");
       }
       
       $count=$con->query("select count(*) from package");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[package]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
           }

       ?>
       
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>
                            </div>
                        </div>
                </div>
        </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];
                $data = $con->query("select * from package where packageid=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                $_SESSION[checkpotaniid]=$row[1];
                ?>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform257">
                        <div class="col-md-12">
                            <form  action="" autocomplete="off" method="post" name="uppackage" enctype="multipart/form-data" onsubmit="return(updaycheckup());">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                                <?php
                                                if ($_SESSION[dup] == 1) {
                                                    echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
                                                    $_SESSION[dup] = 0;
                                                }
                                                ?>
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" autofocus="" value="<?php echo $row[1]; ?>"  name="upname" required="" pattern="^[a-z ]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="active">Update package Name</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p id='khotupadiyuup' class="animated flash infinite"></p>
                                        <div class="input-field col s10">
                                            <input id="list-title" type="text" value="<?php echo $row[2]; ?>"  name="upnumberofday" required="" maxlength="2" pattern="^[0-9]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="active">Update Number of Day</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="text" value="<?php echo $row[3]; ?>"  name="upnumberofnight" required="" maxlength="2" pattern="^[0-9]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="active">Update Number of Night</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="text" value="<?php echo $row[4]; ?>"  name="upamount" required="" pattern="^[0-9]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="active">Update Amount</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
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
                                                <input type="file" name="upphoto">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" placeholder="Update package photo">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
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
                                                <input type="file" name="upaboutpdf">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" placeholder="update package PDF">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                
                                <div class="row" style="padding-bottom:25px;">
                                        <div class="col-md-6">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="radio" name="upstatus" value="1" <?php if($row[7]==1){ echo 'checked';} ?> class="with-gap">
                                                <label for="list-title" >active</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="radio" name="upstatus" value="0" <?php if($row[7]==0){ echo 'checked';} ?> class="with-gap">
                                                <label for="list-title" >Deactive</label>
                                            </div>
                                        </div>
                                </div>

                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm"> 
                                            <button type="submit" class="btn" name="uppackage">Update package</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>      
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row adform257">
                        <div class="col-md-12">
                            <form  action="" method="post" name="package" autocomplete="off" enctype="multipart/form-data" onsubmit="return(daycheck());">
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                                <?php
                                                if ($_SESSION[dup] == 1) {
                                                    echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
                                                    $_SESSION[dup] = 0;
                                                }
                                                ?>
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text"  name="name" required="" pattern="^[a-z ]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Enter package Name</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p id="khotupadiyu" class="animated flash infinite"></p>
                                        <div class="input-field col s10">
                                            <input id="list-title" type="text"  name="numberofday" required="" maxlength="2" pattern="^[0-9]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Number of Day</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="text"  name="numberofnight" required="" maxlength="2" pattern="^[0-9]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Number of Night</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="text"  name="amount" required="" pattern="^[0-9]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Amount</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
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
                                                <input type="file" name="photo" required="">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" placeholder="Upload photo">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
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
                                                <input type="file" name="aboutpdf" required="">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" placeholder="upload PDF">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                
                                <div class="row" style="padding-bottom:25px;">
                                        <div class="col-md-6">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="radio" name="status" value="1" checked class="with-gap">
                                                <label for="list-title" >active</label>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="radio" name="status" value="0" class="with-gap">
                                                <label for="list-title" >Deactive</label>
                                            </div>
                                        </div>
                                </div>
                                
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">  
                                            <button type="submit" class="btn" name="sendpackage">Send Package</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn " onclick="document.getElementById('khotupadiyu').innerHTML='';">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    
    ?>

            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-12">
                        <div class="spe-title">
                                <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row" style="padding-left:5px; color:#fff;">
                            <?php
                            $data=$con->query("select * from package");
                           while($row=mysqli_fetch_array($data))
                           {
                            ?>
                            <div class="col-md-4 my-3 px-0 col-md-offset-1 animated pulse infinite"  style="border:2px solid;height: 300px; background: url('../<?php echo $row[5]; ?>') no-repeat center;background-size:cover;box-shadow: 0 2px 20px 0px rgba(0,0,0,0.3);">
                                        <div class="overlay packageinner">
                                            <h4 class="animated fadeInDown packageinnerpad"><?php echo $row[1]; ?></h4>
                                            <p style="margin:50px 0px 0px 90px;border-radius:2px 0px 0px 2px;font-size: 17px;background-color:white;color:#2A3C54;padding-top:2px;padding-left:5px;" class="animated fadeInLeft">Days <span class="counter"><?php echo $row[2]; ?> </span> <img class="animated rotateIn infinite" src="../admin/images/days.png"/></p>
                                            <p style="margin:10px 0px 0px 80px;border-radius:2px 0px 0px 2px;font-size: 17px;background-color:white;color:#2A3C54;padding-top:2px;padding-left:5px;" class="animated fadeInRight">Nights <span class="counter"><?php echo $row[3]; ?> </span> <img class="animated pulse infinite" src="../admin/images/night.png"/></p>
                                            <h4 class="packageinnerh3">Price : <?php setlocale(LC_MONETARY,'en_IN');echo  money_format('%!i', $row[4]);?> <i class="fa fa-rupee"></i></h4>
                                            <h4 class="text-center"><i class="fa fa-refresh print" style="padding-right:20px;" ondblclick="takedata('<?php echo $_SESSION[shu]; ?>','update',<?php echo $row[0]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i>
                                                <i class="fa fa-trash print" style="padding-right:20px;" ondblclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[0]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i><i class="fa fa-print print" data-toggle="modal" data-target="#viewmore" onclick="viewmoreleva('package',<?php echo $row[0]; ?>);"></i></h4>
                                        </div>
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


<!-- Manage Hotel  !-->


<?php
    
   if($_REQUEST[shu]=="hotel")
   {
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $unlinkmate=$con->query("select * from hotel where hotelid=$_REQUEST[id]");
           $dataunlinkmate=  mysqli_fetch_array($unlinkmate);
           unlink($dataunlinkmate[9]);
           unlink($dataunlinkmate[10]);
           $del=$con->query("delete from hotel where hotelid=$_REQUEST[id]");
       }
       
       $count=$con->query("select count(*) from hotel");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[hotel]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
           }

       ?>
       
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                        </div>
                    </div>
        </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];

                $data = $con->query("select * from hotel where hotelid=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                $_SESSION[checkpotaniid]=$row[0];
                $_SESSION[checkpotaniid1]=$row[2];
                ?>
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform256">
                        <div class="col-md-12">
                            <form action="" method="post" name="uphotel" enctype="multipart/form-data">
                               
                                <div class="row">
                                    <div class="col-md-12">
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
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="upaddress" required="" class="materialize-textarea"><?php echo $row[3]; ?></textarea>
                                        <label for="textarea1" class="active">Update Hotel address</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="text" name="upmobile" value="<?php echo $row[4]; ?>" required="" maxlength="10" pattern="^[0-9]{10}$" class="validate lowertransfer">
                                                <label for="list-title" class="active">Update Hotel Mobile Number</label>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="text" value="<?php echo $row[5]; ?>" name="upmap" required="" class="validate">
                                                <label for="list-title" class="active">update Hotel Map</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="upabout" required="" class="materialize-textarea"><?php echo $row[6]; ?></textarea>
                                        <label for="textarea1" class="active">Update About Hotel</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
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
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
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
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-md-12">
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
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
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
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="text" name="upgstno" value="<?php echo $row[11]; ?>" required="" maxlength="15" pattern="^[A-Z0-9]{15}$" class="validate">
                                            <label for="list-title" class="active">Update Hotel GSTNO</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                         <p class="labelrating">Update Hotel checkouttime(12h formate)</p>
                                        <div class="input-field col s10">
                                            <input id="post-auth" type="time" required="" value="<?php echo $row[12]; ?>" name="upcheckouttime" class="validate">
                                            <label for="post-auth" class=""></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                         <p class="labelrating">Update Hotel checkintime(12h formate)</p>
                                        <div class="input-field col s10">
                                            <input id="post-auth" type="time" required="" value="<?php echo $row[13]; ?>" name="upcheckintime" class="validate">
                                            <label for="post-auth" class=""></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm"> 
                                            <button type="submit" class="btn" name="uphotel">Update Hotel</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>      
                <div class="col-md-5">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row adform256">
                        <div class="col-md-12">
                            <form action="" method="post" name="hotel" enctype="multipart/form-data">
                                
                                        <?php
                                            if ($_SESSION[dup] == 1) {
                                                echo '<div class="row"><div class="col-md-12"><font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font></div></div>';
                                                $_SESSION[dup] = 0;
                                            }
                                        ?>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating1">select Country</p>
                                        <div class="input-field col s10 editprofile">
                                            <select name="countryid" autofocus="" required="" onchange="selectleva('state',this.value)">
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
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating1">select state</p>
                                        <div class="input-field col s10 editprofile">
                                            <select name="stateid" id="statecombo" required="" onchange="selectleva('city',this.value)">
                                                <option value="" disabled="" selected="">Select state</option>
                                            </select>
                                        </div>   
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating1">select city</p>
                                        <div class="input-field col s10 editprofile" >
                                             <select name="cityid" id="citycombo" required="" onchange="selectleva('placetaxi',this.value)">
                                                <option value="" disabled="" selected="">Select city</option>
                                            </select>
                                        </div>   
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating1">select place</p>
                                        <div class="input-field col s10 editprofile">
                                            <select name="placeid" id="placetaxicombo" required="">
                                                <option value="" disabled="" selected="">Select place</option>
                                            </select>
                                        </div>   
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text"  name="name" required="" pattern="^[a-z ]*$" class="validate lowertransfer" >
                                                <label for="list-title" class="">Enter Hotel Name</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="address" required="" class="materialize-textarea"></textarea>
                                        <label for="textarea1" class="">Enter Hotel address</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="email" name="emailid" required="" class="validate lowertransfer">
                                                <label for="list-title" class="">Enter Hotel emailid</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="text" name="mobile" required="" maxlength="10" pattern="^[0-9]{10}$" class="validate lowertransfer">
                                                <label for="list-title" class="">Enter Hotel Mobile Number</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="text" name="map" required="" class="validate">
                                                <label for="list-title" class="">Enter Hotel Map</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="about" required="" class="materialize-textarea"></textarea>
                                        <label for="textarea1" class="">About Hotel</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <p class="labelrating">Select Your Hotel rating</p>
                                        <fieldset class="rating">
                                            <input type="radio" id="star5" name="star" value="5" class="ratingradio1" /><span class = "full" for="star5" title="Awesome - 5 stars"></span>
                                            <input type="radio" id="star4half" name="star" value="4.5" class="ratingradio2" /><span class="half" for="star4half" title="Pretty good - 4.5 stars"></span>
                                            <input type="radio" id="star4" name="star" value="4" class="ratingradio3" /><span class = "full" for="star4" title="Pretty good - 4 stars"></span>
                                            <input type="radio" id="star3half" name="star" value="3.5"  checked="" class="ratingradio4"/><span class="half" for="star3half" title="Meh - 3.5 stars"></span>
                                            <input type="radio" id="star3" name="star" value="3" class="ratingradio5"/><span class = "full" for="star3" title="Meh - 3 stars"></span>
                                            <input type="radio" id="star2half" name="star" value="2.5" class="ratingradio6"/><span class="half" for="star2half" title="Kinda bad - 2.5 stars"></span>
                                            <input type="radio" id="star2" name="star" value="2" class="ratingradio7"/><span class = "full" for="star2" title="Kinda bad - 2 stars"></span>
                                            <input type="radio" id="star1half" name="star" value="1.5" class="ratingradio8"/><span class="half" for="star1half" title="Meh - 1.5 stars"></span>
                                            <input type="radio" id="star1" name="star" value="1" class="ratingradio9"/><span class = "full" for="star1" title="Sucks big time - 1 star"></span>
                                            <input type="radio" id="starhalf" name="star" value="1" class="ratingradio10"/><span class="half" for="starhalf" title="Sucks big time - 0.5 stars"></span>
                                        </fieldset>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <select name="type" required="">
                                                <option value="" disabled selected>Select hotel type</option>
                                                <option value="veg">veg</option>
                                               <option value="non-veg">non-veg</option>
                                               <option value="both">both</option>
                                            </select>  
                                        </div>   
                                    </div>
                                </div>
                                
                                
                                <div class="row">
                                    <div class="col-md-12">
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
                                                <input type="file" name="logo" required="">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" placeholder="Upload logo">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
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
                                                <input type="file" name="bannerphoto" required="">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" placeholder="upload banner photo">
                                            </div>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <input id="list-title" type="text" name="gstno" required="" maxlength="15" pattern="^[A-Z0-9]{15}$" class="validate">
                                            <label for="list-title" class="">Enter Hotel GSTNO</label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                         <p class="labelrating">Hotel checkouttime</p>
                                        <div class="input-field col s10">
                                            <input id="post-auth" type="time" name="checkouttime" class="validate">
                                            <label for="post-auth" class=""></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                         <p class="labelrating">Hotel checkintime</p>
                                        <div class="input-field col s10">
                                            <input id="post-auth" type="time" name="checkintime" class="validate">
                                            <label for="post-auth" class=""></label>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm"> 
                                            <button type="submit" class="btn" name="sendhotel">Send Hotel</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    
    ?>

            <div class="col-md-7">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
                <div class="table-responsive" style="overflow-x:hidden;">
                <table class="table table-hover adhoteltable">
                  
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from hotel where name like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from hotel limit $st,$_REQUEST[perpage]");
                         }
                         while($row=mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            
                            <tr>
                                <td>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12 adhotel" style="margin: 0px;padding: 0px;">
                                                <img src="../<?php echo $row[10]; ?>"/>
                                               <img class="adlogo" src="../<?php echo $row[9]; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color: whitesmoke; margin-bottom:10px;">
                                    <div class="row" style="margin: 0px;padding: 0px;">
                                        <div class="col-md-12" style="margin: 0px;padding: 0px;">
                                            <i class="fa fa-hotel" style="float:left; padding-top:5px;padding-left:18px; font-size:20px; color:#2A3C54;"></i><h3 style="text-transform:capitalize;float:left; padding-left:10px;"><?php echo $row[2]; ?></h3>
                                           <?php
                                           if($row[8]=="veg")
                                           {
                                           ?>
                                            <img src="../admin/images/veg.png" height="20px" width="25px" style="float: left;color:#FF0049;margin-left:12px;"/>
                                           <?php
                                           }
                                           elseif($row[8]="non-veg")
                                           {
                                           ?>
                                            <img src="../admin/images/non-veg.png" height="20px" width="25px" style="float: left;color:#FF0049;margin-left:12px;"/>
                                           <?php    
                                           }
                                           elseif($row[8]="both")
                                           {
                                           ?>
                                            <img src="../admin/images/both.jpeg" height="20px" width="40px" style="float: left;color:#FF0049;margin-left:12px;"/>
                                           <?php    
                                           }
                                           ?>
                                            
                                            
                                            <div style="position:absolute;top:0px;right:4px;">
                                                <i class="fa fa-print" data-toggle="modal" data-target="#hotel" onclick="hotelprofile('hotel',<?php echo $row[1]; ?>);"></i>
                                                &nbsp; &nbsp;<i class="fa fa-refresh" ondblclick="takedata('<?php echo $_SESSION[shu]; ?>','update',<?php echo $row[1]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i>
                                               &nbsp; &nbsp;<i class="fa fa-trash" ondblclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[1]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></div>
                                            
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="6" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="6" style="background:whitesmoke;">
                                    <?php
                                        echo "Total record are : $_SESSION[hotel]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>

<!-- manage site profile -->

<?php
    
   if($_REQUEST[shu]=="site profile")
   {
       $_SESSION[shu]=$_REQUEST[shu];
       
       $count=$con->query("select count(*) from siteprofile where category=2");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[siteprofile]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
               
               
           }

       ?>
       
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?> </span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                        </div>
                    </div>
        </div>
    <div class="row ">
       
        <div class="col-md-12">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?> <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>Toll free</th>
                    <th>fax</th>
                    <th>Emailid</th>
                    <th>Address</th>
                    <th>Branch address</th>
                    <th>Branch map</th>
                    <th>website</th>
                    <th></th>
                    
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                            $data=$con->query("select * from siteprofile where category=2 and emailid like '$_REQUEST[id]%' or category=2 and tollfree like '$_REQUEST[id]%' or category=2 and address like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from siteprofile where category=2 limit $st,$_REQUEST[perpage]");
                         }
                         while($row=  mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr>
                                <td><?php echo $row[1] ; ?></td>
                                <td><?php echo $row[2] ; ?></td>
                                <td><?php echo $row[3] ; ?></td>
                                <td><?php echo $row[4] ; ?></td>
                                <td><?php echo $row[5] ; ?></td>
                                <td><iframe src="<?php echo $row[6] ; ?>"></iframe>    </td>
                                <td><?php echo $row[7] ; ?></td>
                                <td><i class="fa fa-refresh" data-toggle="modal" data-target="#siteprofile" onclick="siteprofile('siteprofile',<?php echo $row[8]; ?>);"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="12" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="12">
                                    <?php
                                        echo "Total Record Are = $_SESSION[siteprofile]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>



<!-- Manage t&c Privacy policy -->

<?php
    
   if($_REQUEST[shu]=="tc and Privacy policy")
   {
       $_SESSION[shu]=$_REQUEST[shu];
      
       if($_REQUEST[action]=="delete")
       {
           $del=$con->query("delete from siteprofile where tcid=$_REQUEST[id]");
       }
       
       $count=$con->query("select count(*) from siteprofile where category=1 or category=0");
       $page=  mysqli_fetch_array($count);
       
       $_SESSION[tc]=$page[0];
      
       $totpage=ceil($page[0]/$_REQUEST[perpage]);
       
       $spage=1;
       $epage=$totpage;
       
       $st=($_REQUEST[ketlamupage]*$_REQUEST[perpage])-$_REQUEST[perpage];
       
       if($totpage<=5)
       {
           $page=1;
           $epage=$totpage;
       }
       else
       {
           $spage=1;
           $epage=5;
           if($_REQUEST[kayu]=="next")
           {
               $spage=$_REQUEST[ketlamupage]-4;
               $epage=$_REQUEST[ketlamupage];
               
               if($spage<=1)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           if($_REQUEST[kayu]=="prev")
           {
               $spage=$_REQUEST[ketlamupage];
               $epage=$_REQUEST[ketlamupage]+4;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           if($_REQUEST[kayu]=="mid")
           {
               $spage=$_REQUEST[ketlamupage]-2;
               $epage=$_REQUEST[ketlamupage]+2;
               
               if($spage<=3)
               {
                   $spage=1;
                   $epage=5;
               }
               
               if($epage>$totpage)
               {
                   $spage=$totpage-4;
                   $epage=$totpage;
               }
           }
           
           
           }

       ?>
       
<div class="container-fluid">
    <div class="row">

        <div class="col-md-12">
                <div class="spe-title">
                            <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                            <div class="title-line">
                                <div class="tl-1"></div>
                                <div class="tl-2"><i class="fa fa-gg"></i></div>
                                <div class="tl-3"></div>

                            </div>
                        </div>
                    </div>
        </div>
   
    <div class="row ">
            <?php
            if ($_REQUEST[action] == "update") {
                $_SESSION[upid] = $_REQUEST[id];

                $data = $con->query("select * from siteprofile where tcid=$_SESSION[upid]");
                $row = mysqli_fetch_array($data);
                $_SESSION[checkpotaniid]=$row[8];
                $_SESSION[checkpotaniid1]=$row[9];
                ?>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">

                            <div class="spe-title">
                                <h3>Update <?php echo $_REQUEST[shu]; ?><span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" novalidate="" autocomplete="off" method="post" name="upsiteprofile">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text" value="<?php echo $row[9]; ?>" autofocus="" name="uptitle" required="" pattern="^[a-zA-Z ]*$" class="validate">
                                                <label for="list-title" class="active">Update title</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="upfirstmessage" required="" class="materialize-textarea"><?php echo $row[10]; ?></textarea>
                                        <label for="textarea1" class="active">update first term</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="upsecondmessage" required="" class="materialize-textarea"><?php echo $row[11]; ?></textarea>
                                        <label for="textarea1" class="active">update second term</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm"> 
                                            <button type="submit" class="btn" name="uptc">Update tc&policy</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                ?>      
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="spe-title">
                                <h3><?php echo $_REQUEST[shu]; ?>  form<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row adform255">
                        <div class="col-md-12">
                            <form  action="" method="post" name="siteprofile" autocomplete="off" >
                                <div class="row">
                                    <div class="col-md-12">
                                        
                                        
                                        
                                        <div class="input-field col s10">
                                            <select name="category" required="">
                                                <option value="" disabled selected>Select category</option>
                                                <option value="0">terms&condition</option>
                                                <option value="1">Privacy policy</option>
                                            </select>  
                                        </div>   
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">
                                                <?php
                                                if ($_SESSION[dup] == 1) {
                                                    echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:10px; color:red;">Duplication Found !....</font>';
                                                    $_SESSION[dup] = 0;
                                                }
                                                ?>
                                            <div class="input-field col s10">
                                                <input id="list-title" type="text"  name="title" required="" pattern="^[a-zA-Z ]*$" class="validate" >
                                                <label for="list-title" class="">Enter Title</label>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="firstmessage" required="" class="materialize-textarea"></textarea>
                                        <label for="textarea1" class="">Enter first term</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-field col s10">
                                            <textarea id="textarea1" name="secondmessage" required="" class="materialize-textarea"></textarea>
                                        <label for="textarea1" class="">Enter second term</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row adform1">
                                    <div class="col-md-12">
                                        <div class="form-group form-group-sm">  
                                            <button type="submit" class="btn" name="sendtc">Send tc&policy</button> &nbsp;&nbsp;
                                            <button type="reset" class="btn ">Reset</button>
                                        </div> 
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php
    }
    ?>

            <div class="col-md-6">
            <div class="spe-title">
                    <h3>Display <?php echo $_REQUEST[shu]; ?>  <span></span></h3>
                    <div class="title-line">
                        <div class="tl-11"></div>
                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                        <div class="tl-33"></div>

                    </div>
                </div>
        
            <div class="table-responsive">
                <table class="table table-hover adtbl">
                    <th>category</th>
                    <th>Title</th>
                    <th>View more</th>
                    <th></th>
                     <th></th>
                    <?php
                         $ketla=0;
                         if($_REQUEST[action]=="search")
                         {
                         $data=$con->query("select * from siteprofile where firstmessage like '$_REQUEST[id]%' or secondmessage like '$_REQUEST[id]%' and category or title like '$_REQUEST[id]%'");
                         }
                         
                         else
                         {
                             $data=$con->query("select * from siteprofile where category=1 or category=0 limit $st,$_REQUEST[perpage]");
                         }
                         while($row=mysqli_fetch_array($data))
                         {
                            $ketla++;
                            ?>
                            <tr><td><?php if($row[8]==0){echo 'terms&condition';}else{echo 'Privacy policy';} ?></td>
                                <td><?php echo $row[9]; ?></td>
                                <td><i class="fa fa-print print" data-toggle="modal" data-target="#tc" onclick="tc('tc',<?php echo $row[0]; ?>);"></i></td>
                                <td><i class="fa fa-refresh" onclick="takedata('<?php echo $_SESSION[shu]; ?>','update',<?php echo $row[0]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                                <td><i class="fa fa-trash" onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[0]; ?>,<?php echo $_REQUEST[ketlamupage]; ?>,<?php echo $_REQUEST[perpage]; ?>,'<?php echo $_REQUEST[kayu]; ?>');"></i></td>
                            </tr>
                            
                            <?php
                            
                         }
                    ?>
                        <?php
                            if($_REQUEST[action]!=="search")
                            {
                            ?>
                            <tr>
                                <td colspan="4" class="adpaging">
                                    
                                    <ul  class="paging">
                                        <?php
                                        if($spage!=1)
                                        {
                                        ?>
                                        <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]-1; ?>,<?php echo $_REQUEST[perpage]; ?>,'prev');">
                                             << 
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        for($i=$spage;$i<=$epage;$i++)
                                        {
                                        ?>
                                        
                                        
                                        <?php
                                        if($_REQUEST[ketlamupage]==$i)
                                        {
                                        ?>
                                        
                                        <li class="pageactive" onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        else
                                        {
                                        ?>
                                         <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $i; ?>,<?php echo $_REQUEST[perpage]; ?>,'mid');">
                                            <?php
                                                echo $i;
                                            ?>
                                        </li>
                                        <?php
                                        }
                                        ?>
                                        
                                        
                                        
                                        <?php
                                        }
                                        ?>
                                        
                                        <?php
                                        if($epage<$totpage)
                                        {
                                            ?>
                                            <li onclick="takedata('<?php echo $_SESSION[shu]; ?>','display',0,<?php echo $_REQUEST[ketlamupage]+1; ?>,<?php echo $_REQUEST[perpage]; ?>,'next');">
                                             >>
                                            </li>
                                        <?php
                                        }
                                        ?>
                                    </ul>
                                </td>
                            </tr>
                             <?php
                            }
                            ?>
                            <tr>
                                <td colspan="4">
                                    <?php
                                        echo "Total record are : $_SESSION[tc]";
                                    ?>
                                </td>
                            </tr>
            </table>
        </div>
    </div>
    </div>
    </div>
       <?php
    }
   ?>
<!-- package place -->
<?php
if($_REQUEST[shu]=="package place")
{
    $_SESSION[shu]=$_REQUEST[shu];
?>
    <div class="container-fluid">
        <div class="row">
                <div class="col-md-12">
                        <div class="spe-title">
                                <h2>Manage <span><?php echo $_REQUEST[shu]; ?></span></h2>
                                    <div class="title-line">
                                        <div class="tl-1"></div>
                                        <div class="tl-2"><i class="fa fa-gg"></i></div>
                                        <div class="tl-3"></div>
                                    </div>
                        </div>
                </div>
          </div>
        <?php
        if($_REQUEST[action]==delete)
        {
            $del=$con->query("delete from packageplace where packageplaceid=$_REQUEST[id]");
                
        }
        if($_REQUEST[action]==display)
        {
        ?>
        <div class="row">
                    <div class="col-md-12">
                            <div class="spe-title">
                                <h3>Select package<span></span></h3>
                                <div class="title-line">
                                    <div class="tl-11"></div>
                                    <div class="tl-22"><i class="fa fa-gg"></i></div>
                                    <div class="tl-33"></div>

                                </div>
                            </div>
                    </div>
          </div>
        <?php
        if ($_SESSION[dup] == 1) {
            ?>
                <div class="row">
                    <div class="col-md-12">
            <?php
            echo '<font id="khalikaroerror" class="animated flash infinite" style="font-size:17px;color:red;text-align:center;padding-bottom:35px;padding-left:200px;">First Select Placepoint and then press submit !....</font>';
            $_SESSION[dup] = 0;
            ?>
                    </div>
                </div>
            <?php
        }
        ?>
        
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="row packages" style="color:#fff;">
                    <?php
                      $data=$con->query("select * from package");
                      while($row=mysqli_fetch_array($data))
                      {
                       ?>
                    <div class="col-md-3 my-3 px-0 col-md-offset-1 animated pulse infinite package-wrapper"  style="background: url('../<?php echo $row[5]; ?>') no-repeat center;">
                                        <div class="overlay packageinner">
                                            <h4 class="animated fadeInDown packageinnerpad"><?php echo $row[1]; ?></h4>
                                            <p style="margin:50px 0px 0px 90px;border-radius:2px 0px 0px 2px;font-size: 17px;background-color:white;color:#2A3C54;padding-top:2px;padding-left:5px;" class="animated fadeInLeft">Days <span class="counter"><?php echo $row[2]; ?> </span> <img class="animated rotateIn infinite" src="../admin/images/days.png"/></p>
                                            <p style="margin:10px 0px 0px 80px;border-radius:2px 0px 0px 2px;font-size: 17px;background-color:white;color:#2A3C54;padding-top:2px;padding-left:5px;" class="animated fadeInRight">Nights <span class="counter"><?php echo $row[3]; ?> </span> <img class="animated pulse infinite" src="../admin/images/night.png"/></p>
                                            <h4 class="packageinnerh3">Price : <?php setlocale(LC_MONETARY,'en_IN');echo  money_format('%!i', $row[4]);?> <i class="fa fa-rupee"></i><i class="fa fa-map-marker print packageprint"  onclick="takedata('<?php echo $_SESSION[shu]; ?>','assign',<?php echo $row[0]; ?>);" ></i></h4>
                                            <h4 class="text-center"><i class="fa fa-print print" data-toggle="modal" data-target="#viewmore" onclick="viewmoreleva('package',<?php echo $row[0]; ?>);"></i></h4>
                                        </div>
                    </div>
                    <?php
                      }
                    ?>
                </div>
                
            </div>
        </div>
        <?php
        }
        elseif($_REQUEST[action]==assign)
        {
            $_SESSION[packageid]=$_REQUEST[id];
        ?>
                <div class="row">
                    <div class="col-md-6">
                        <form action="" method="post" name="packageplace">
                            <div class="row">
                                <div class="col-md-12 input-field col s10">
                                    <a style="color:#FF0049;" class="print" onclick="takedata('package place', 'display', 0, 1, 10, '');count=1;"><i class="fa fa-backward"></i> Back</a> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="input-field col s10 editprofile">
                                                    <p class="labelrating1">select Country</p>
                                            <select name="countryid" autofocus="" required="" onchange="selectleva('state',this.value)">        
                                                 <option value="" disabled="" selected="">Select country</option>
                                                <?php
                                                        $datasel = $con->query("select * from country");
                                                        while ($rowsel = mysqli_fetch_array($datasel)) 
                                                        {
                                                        ?>
                                                            <option value="<?php echo $rowsel[0]; ?>"><?php echo $rowsel[1]; ?></option>
                                                        <?php
                                                        }
                                                        ?>
                                            </select>  
                                        </div>   
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="input-field col s10 editprofile">
                                             <p class="labelrating1">select state</p>
                                            <select name="stateid" id="statecombo" required="" onchange="selectleva('city',this.value)">
                                                <option value="" disabled="" selected="">Select State</option>
                                            </select>
                                        </div>   
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12">
                                        <div class="input-field col s10 editprofile">
                                            <p class="labelrating1">select city</p>
                                            <select name="cityid" id="citycombo" required="" onchange="selectleva('package',this.value)">
                                                 <option value="" disabled="" selected="">Select city</option>        
                                            </select>
                                        </div>   
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-12" id="packagecombo">
                                    
                                </div>
                            </div>
                        </form>
                        
                    </div>
                    <div class="col-md-6">
                        <form action="" method="post" name="packageplace">
                            <div id="placecombo">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="spe-title">
                                                    <h3>package place<span></span></h3>
                                                    <div class="title-line">
                                                        <div class="tl-11"></div>
                                                        <div class="tl-22"><i class="fa fa-gg"></i></div>
                                                        <div class="tl-33"></div>

                                                    </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <?php
                                            $data=$con->query("select * from package where packageid=$_SESSION[packageid]");
                                            $row=mysqli_fetch_array($data);
                                            ?>
                                            <div class="col-md-5 my-3 px-0 col-md-offset-1 animated pulse infinite package-wrapper"  style="background: url('../<?php echo $row[5]; ?>') no-repeat center;color:#fff;">
                                                <div class="overlay packageinner">
                                                    <h4 class="animated fadeInDown packageinnerpad"><?php echo $row[1]; ?></h4>
                                                    <p style="margin:50px 0px 0px 90px;border-radius:2px 0px 0px 2px;font-size: 17px;background-color:white;color:#2A3C54;padding-top:2px;padding-left:5px;" class="animated fadeInLeft">Days <span class="counter"><?php echo $row[2]; ?> </span> <img class="animated rotateIn infinite" src="../admin/images/days.png"/></p>
                                                    <p style="margin:10px 0px 0px 80px;font-size: 17px;background-color:white;color:#2A3C54;padding-top:2px;padding-left:5px;" class="animated fadeInRight">Nights <span class="counter"><?php echo $row[3]; ?> </span> <img class="animated pulse infinite" src="../admin/images/night.png"/></p>
                                                    <h4 class="packageinnerh3">Price : <?php setlocale(LC_MONETARY,'en_IN');echo  money_format('%!i', $row[4]);?> <i class="fa fa-rupee"></i></h4>
                                                    <h4 class="text-center"><i class="fa fa-print print" data-toggle="modal" data-target="#viewmore" onclick="viewmoreleva('package',<?php echo $row[0]; ?>);"></i></h4>
                                                </div>
                                            </div>
                                            <div class="col-md-6 packagedelete">
                                                <h5>Package avaliable places  :-</h5>
                                            <?php
                                            $data=$con->query("select * from packageplace where packageid=$_SESSION[packageid]");
                                            $cntfinal=mysqli_num_rows($data);
                                            if($cntfinal>0)
                                            {
                                                    while($row=mysqli_fetch_array($data))
                                                    {
                                                        $data1=$con->query("select * from placepoint where pointid=$row[2]");
                                                            while($row1=mysqli_fetch_array($data1))
                                                            {
                                                            ?>
                                                                <div class="chip">
                                                                        <?php echo $row1[2]; ?> <i class="fa fa-close" style="color:#FF0049;"  onclick="takedata('<?php echo $_SESSION[shu]; ?>','delete',<?php echo $row[3]; ?>,0,0,'');takedata('<?php echo $_SESSION[shu]; ?>','display',0,1,10);" ></i>
                                                                </div>
                                                            <?php   
                                                            }

                                                    }
                                            }
                                            else 
                                            {
                                                ?>
                                                <h5>NO record Found !..</h5>
                                                <video src="../video/norecord.mp4" loop="" autoplay="" style="height:200px;width:100%"></video>
                                                <?php
                                            }
                                            ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>   
                        </form>
                    </div>
                </div>
        <?php
        }
        ?>
    </div>
<?php
}
?>
    
    <!-- Manage Parent Model siteprofile -->
<?php
if($_REQUEST[shu]!='captcha')
{
?>
    <div class="modal fade" id="siteprofile">
        <div class="modal-dialog modal-lg" id="siteprofile1">

        </div>    
    </div>   
<?php
}
?>


<!-- Manage Child Model siteprofile-->

<?php
if ($_REQUEST[konidetail] == "siteprofile") 
{
   ?>
        <div class="modal-content">
            <div class="modal-header">
                <h2>Update Site Profile Detail</h2>
                <button class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                            $data = $con->query("select * from siteprofile where category=$_REQUEST[id]");
                            $row = mysqli_fetch_array($data);
                            $_SESSION[upid]=$_REQUEST[id];
                            ?>
                                    <form action="" method="post" name="country" autocomplete="off">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-sm">
                                                            <div class="input-field col s10">
                                                                <input id="list-title" type="text" name="uptollfree" required="" value="<?php echo $row[1]; ?>" maxlength="14" pattern="^[0-9-]*$" class="validate">
                                                                <label for="list-title" class="active">Update tollfree</label>
                                                             </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-sm">
                                                            <div class="input-field col s10">
                                                                <input id="list-title" type="text" name="upfax" required="" value="<?php echo $row[2]; ?>" maxlength="14" pattern="^[0-9-]*$" class="validate">
                                                                <label for="list-title" class="active">Update fax</label>
                                                             </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-sm">
                                                        <div class="input-field col s10">
                                                            <input id="list-title" type="email" name="upemailid" required="" value="<?php echo $row[3]; ?>" class="validate">
                                                            <label for="list-title" class="active">Update emailid</label>
                                                        </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-sm">
                                                    <div class="input-field col s10">
                                                            <textarea id="textarea1" name="upaddress" required="" class="materialize-textarea"><?php echo $row[4]; ?></textarea>
                                                            <label for="textarea1" class="active">Update Address</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-sm">
                                                            <div class="input-field col s10">
                                                                <input id="list-title" type="text" name="upbranchaddress" required="" value="<?php echo $row[5]; ?>" class="validate">
                                                                <label for="list-title" class="active">Update branchaddress</label>
                                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-sm">
                                                    <div class="input-field col s10">
                                                            <textarea id="textarea1" name="upbranchmap" required="" class="materialize-textarea"><?php echo $row[6]; ?></textarea>
                                                            <label for="textarea1" class="active">Update branchmap</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-sm">
                                                            <div class="input-field col s10">
                                                                <input id="list-title" type="text" name="upwebsite" required="" value="<?php echo $row[7]; ?>" class="validate">
                                                                <label for="list-title" class="active">Update website Link</label>
                                                            </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row adform1">
                                            <div class="col-md-12">
                                                <div class="form-group form-group-sm">  
                                                    <button type="submit" class="btn" name="upsiteprofile">Update Site Profile</button> &nbsp;&nbsp;
                                                    <button type="reset" class="btn ">Reset</button>
                                                </div> 
                                            </div>
                                        </div>
                                    </form>
                         </div>
                    </div>
                </div>
            </div>
        </div>
<?php
}
?>


<!-- Manage Parent Model taxicompany -->
<?php
if($_REQUEST[shu]!='captcha')
{
?>
<div class="modal fade" id="taxicompany">
    <div class="modal-dialog modal-lg" id="taxicompany1">
        
    </div>    
</div>
<?php
}
?>
<!-- Manage Child Model taxicompany-->

<?php
if ($_REQUEST[konidetail] == "taxi") 
{
    $data = $con->query("select * from taxicompany where taxicompanyid=$_REQUEST[id]");
    $row = mysqli_fetch_array($data);
    ?>

    <div class="modal-content">
        <div class="modal-header">
            <h2><?php echo $row[2]; ?> Company </h2>
            <button class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h4 style="float:left;color:#FF0049;">Address :- </h4>
                        <font> &nbsp;<?php echo $row[3]; ?></font>
                     </div>
                    <div class="col-md-12" style="padding-top:20px;">
                        <h4 style="float:left;color:#FF0049;">about :- </h4>
                        <font> &nbsp;<?php echo $row[6]; ?></font>
                     </div>
                </div>
                <div class="row" style="padding-top:20px;">
                    <div class="col-md-4">
                        <h4 style="float:left;color:#FF0049;">mobile :- </h4>
                        <font> &nbsp;<?php echo $row[4]; ?></font>
                     </div>
                    <div class="col-md-4">
                        <h4 style="float:left;color:#FF0049;">gstno :- </h4>
                        <font> &nbsp;<?php echo $row[7]; ?></font>
                     </div>
                    <div class="col-md-4">
                        <h4 style="float:left;color:#FF0049;">emailid :- </h4>
                        <font> &nbsp;<?php echo $row[8]; ?></font>
                     </div>
                </div>
                <div class="row" style="padding-top:20px;">
                    <div class="col-md-12">
                        <iframe src="<?php echo $row[5]; ?>" height="300px" width="100%;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>


<!-- Manage Parent Model package -->
<?php
if($_REQUEST[shu]!='captcha')
{
?>
<div class="modal fade" id="viewmore">
    <div class="modal-dialog modal-lg" id="viewmore1">
        
    </div>    
</div>
<?php
}
?>

<!-- Manage Child Model package-->

<?php
if ($_REQUEST[konidetail] == "package") 
{
    $data = $con->query("select * from package where packageid=$_REQUEST[id]");
    $row = mysqli_fetch_array($data);
    ?>

    <div class="modal-content">
        <div class="modal-header">
            <h2><?php echo $row[1]; ?> package Detail</h2>
            <button class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <embed src="../<?php echo $row[6]; ?>" style="width:100%; height:450px;">
                     </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>


<!-- Manage Parent vehicle  -->
<?php
if($_REQUEST[shu]!='captcha')
{
?>
<div class="modal fade" id="vehicle">
    <div class="modal-dialog modal-lg" id="vehicle1">
        
    </div>    
</div>
<?php
}
?>

<!-- Manage Child Model vehicle-->

<?php
if ($_REQUEST[konidetail] == "vehicle") 
{
    $data = $con->query("select * from vehiclename where vehiclenameid=$_REQUEST[id]");
    $row = mysqli_fetch_array($data);
    ?>

    <div class="modal-content">
        <div class="modal-header">
            <h2>Vehicle Name  :- &nbsp;<?php echo $_REQUEST[name];?> </h2>
            <button class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <embed src="../<?php echo $row[4]; ?>" style="width:100%; height:450px;">
                     </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>


<!-- Manage Parent Model siteprofile -->
<?php
if($_REQUEST[shu]!='captcha')
{
?>
<div class="modal fade" id="tc">
    <div class="modal-dialog modal-lg" id="tc1">
        
    </div>    
</div>
<?php
}
?>

<!-- Manage Child Model siteprofile-->

<?php
if ($_REQUEST[konidetail] == "tc") 
{
    $data = $con->query("select * from siteprofile where tcid=$_REQUEST[id]");
    $row = mysqli_fetch_array($data);
    ?>

    <div class="modal-content">
        <div class="modal-header">
            <h2><?php if($row[8]==0){ echo 'Terms & Condition';}else{echo 'Privacy policy';} ?> </h2>
            <button class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <b style="color:#FF0049;"> <?php echo $row[9]; ?> :-</b>
                     </div>
                    <div class="col-md-12" style="padding-top:20px">
                         <?php echo $row[10]; ?>
                     </div>
                    <div class="col-md-12" style="padding-top:20px">
                         <?php echo $row[11]; ?>
                     </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>

<!-- Manage Parent Model hotel -->
<?php
if($_REQUEST[shu]!='captcha')
{
?>
<div class="modal fade" id="hotel">
    <div class="modal-dialog modal-lg" id="hotel1">
        
    </div>    
</div>
<?php
}
?>

<!-- Manage Child Model hotel -->

<?php
if ($_REQUEST[konidetail] == "hotel") 
{
?>
    <div class="modal-content">
        <div class="modal-header">
            <h2> </h2>
            <button class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <?php
                        $data=$con->query("select * from hotel where hotelid=$_REQUEST[id]");
                        $row=  mysqli_fetch_array($data);
                        ?>
                        <table class="table-responsive">
                            <tr>
                                <th></th>
                            </tr>
                            <tr>
                                <td>
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12 adhotel" style="margin: 0px;padding: 0px;">
                                                <img src="../<?php echo $row[10]; ?>"/>
                                               <img class="adlogo" src="../<?php echo $row[9]; ?>"/>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color: whitesmoke;">
                                    <div class="row" style="margin: 0px;padding: 0px;">
                                        <div class="col-md-12" style="margin: 0px;padding: 0px;">
                                            <i class="fa fa-hotel" style="float:left; padding-top:5px;padding-left:18px; font-size:20px; color:#2A3C54;"></i><h3 style="text-transform:capitalize;float:left; padding-left:10px;"><?php echo $row[2]; ?></h3>
                                            <?php
                                           if($row[8]=="veg")
                                           {
                                           ?>
                                            <img src="../admin/images/veg.png" height="20px" width="25px" style="float: left;color:#FF0049;margin-left:12px;"/>
                                           <?php
                                           }
                                           elseif($row[8]="non-veg")
                                           {
                                           ?>
                                            <img src="../admin/images/non-veg.png" height="20px" width="25px" style="float: left;color:#FF0049;margin-left:12px;"/>
                                           <?php    
                                           }
                                           elseif($row[8]="both")
                                           {
                                           ?>
                                            <img src="../admin/images/both.jpeg" height="20px" width="40px" style="float: left;color:#FF0049;margin-left:12px;"/>
                                           <?php    
                                           }
                                           ?>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row" style="padding-left: 20px;">
                                        <div class="col-md-12" style="margin: 0px;padding: 0px;">
                                            <font style="float: left;"><i class="fa fa-map-marker" style="color: #FF0049;"></i>&nbsp; Address,</font>
                                            <font style="float: left; padding-left: 10px;"><?php echo $row[3]; ?></font>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                             <tr>
                                <td>
                                    <div class="row" style="padding-left: 20px;">
                                        <div class="col-md-12" style="margin: 0px;padding: 0px;">
                                            <font style="float: left;"><i class="fa fa-phone" style="color: #FF0049;"></i>&nbsp; Mobile,</font>
                                            <font style="float: left; padding-left: 10px;"><?php echo $row[4]; ?></font>
                                            <font style="float: left;padding-left:30px;"><i class="fa fa-star" style="color: #FF0049;"></i>&nbsp; Star Rating ,</font>
                                            <p style="float: left; padding-left: 10px; "><?php echo $row[7]; ?> &nbsp;<i class="fa fa-star" style="color:#FF9800;"></i></p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row" style="padding-left: 20px;">
                                        <div class="col-md-12" style="margin: 0px;padding: 0px;">
                                            <font style="float: left;"><i class="fa fa-map-marker" style="color:#FF0049;"></i> where <?php echo $row[2]; ?> alive ,</font>
                                            <font style="float: left; padding-left: 10px;">
                                                <?php
                                                $selplace=$con->query("select * from place where placeid=$row[0]");
                                                $dataplace=  mysqli_fetch_array($selplace);
                                                $selcity=$con->query("select * from city where cityid=$dataplace[0]");
                                                $datacity=  mysqli_fetch_array($selcity);
                                                $selstate=$con->query("select * from state where stateid=$datacity[0]");
                                                $datastate=  mysqli_fetch_array($selstate);
                                                $selcountry=$con->query("select * from country where countryid=$datastate[0]");
                                                $datacountry=  mysqli_fetch_array($selcountry);  
                                                echo "<p style='padding-top:10px;'> [ ". $datacountry[1]." ] <i class='fa fa-hand-o-right' style='color:#FF0049;' ></i>"." [ ". $datastate[2]." ] <i class='fa fa-hand-o-right' style='color:#FF0049;'></i>"." [ ". $datacity[2]." ] <i class='fa fa-hand-o-right' style='color:#FF0049;'></i>"." [ ". $dataplace[2]." ] </p>";
                                                ?>
                                            </font>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row" style="padding-left: 20px;">
                                        <div class="col-md-12" style="margin: 0px;padding: 0px;">
                                            <font style="float: left;"><i class="fa fa-clock-o" style="color:#FF0049;"></i>&nbsp; check in,</font>
                                            <font style="float: left; padding-left: 10px;"><?php echo $row[13]; ?></font>
                                            <font style="float: left;padding-left:30px;"><i class="fa fa-clock-o" style="color:#FF0049;"></i>&nbsp; check out,</font>
                                            <font style="float: left; padding-left: 10px;"><?php echo $row[12]; ?></font>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row" style="padding-left: 20px;">
                                        <div class="col-md-12" style="margin: 0px;padding: 0px;">
                                            <font style="float: left;"><i class="fa fa-check-circle" style="color:#FF0049;"></i>&nbsp; GST No,</font>
                                            <font style="float: left; padding-left: 10px;"><?php echo $row[11]; ?></font>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row" style="padding-left: 20px;">
                                        <div class="col-md-12" style="margin: 0px;padding: 0px;">
                                            <font style="float: left;"><i class="fa fa-building" style="color:#FF0049;"></i>&nbsp;&nbsp;About <?php echo $row[2]; ?>,</font>
                                            <p style="float: left; text-align:center; padding-top:10px;">" <?php echo $row[6]; ?> "</p>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <iframe src="<?php echo $row[5]; ?>" height="300px" width="100%;"></iframe>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                     </div>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>


<!-- Manage Parent Model custom package hotel -->
<?php
if($_REQUEST[shu]!='captcha')
{
?>
<div class="modal fade" id="customhotel">
    <div class="modal-dialog modal-lg" id="customhotel1">
        
    </div>    
</div>
<script>
   $("#customhotel").on('hide.bs.modal',function(){
      window.location.href='adminmaster.php';
  });
</script>
<?php
}
?>

<!-- Manage Child Model custom package hotel-->

<?php
if ($_REQUEST[konidetail] == "customhotel") 
{
$hotelarray=array();
$i=0;
    ?>

    <div class="modal-content">
        <div class="modal-header">
            <h2>Send Request to Hotels</h2>
            <i class="close fafado fa fa-close" onclick="location.reload();" data-dismiss="modal" style="color:black!important;top:0px;position:relative;"></i>
        </div>
        <div class="modal-body">
            <form action="" method="post" name="custom">
            <div class="container-fluid">
                <div class="to-ho-hotel">
                <div class="row">
                    <?php
                     $data = $con->query("SELECT * FROM placeassign p,place pl,custompackage c,city cc where c.custompackageid=p.custompackageid and pl.placeid=p.placeid and cc.cityid=pl.cityid  and c.custompackageid=$_REQUEST[id] group by cc.cityid");
                     $_SESSION[hotelcustompackageid]=$_REQUEST[id];
                     while ($row = mysqli_fetch_array($data)) 
                     {
                     ?>
                                    <div class="col-md-12 text-center " style="padding:10px;background:#590072;color:white;">
                                                <h4>Hotels in <?php echo $row[20]; ?></h4>
                                    </div>
                                    <?php  
                                        $data1=$con->query("select * from hotel h,place p,city c where c.cityid=p.cityid and p.placeid=h.placeid and c.cityid=$row[3] and h.hotelid not in(select hotelid from hotelrequest where custompackageid=$_REQUEST[id])");
                                        while($row1=mysqli_fetch_array($data1))
                                        {
                                             $hotelarray[$i]=$row1[1];
                                             $i++;
                                        ?>
                                            <div class="col-md-3" style="margin-top:20px;">
                                                <div class="to-ho-hotel-con" style="height:250px!important;">
                                                        <div class="to-ho-hotel-con-1"  style="max-height:145px;overflow:hidden;">
                                                            <?php
                                                            $roomgoto = $con->query("select sum(nofrom) from assignroomtype where hotelid=$row1[1]");
                                                            $aapmane = mysqli_fetch_array($roomgoto);
                                                            ?>
                                                            <div class="hom-hot-av-tic" style="font-size:10px;"> Available Rooms: <?php echo $aapmane[0]; ?></div> <img src="<?php echo '../'.$row1[10]; ?>" alt="" style="height:100px;"> 
                                                        </div>
                                                    <div class="to-ho-hotel-con-23" style="padding:18px!important;">
                                                        <div class="to-ho-hotel-con-2">
                                                            <h4 style="text-transform: capitalize;"><font style="font-size:14px;"><?php echo $row1[2]; ?></font></h4>
                                                        </div>
                                                        <div class="to-ho-hotel-con-3">
                                                            <ul>
                                                                <li  style="text-transform: capitalize;" >City:<font style="font-size:10px;"> <?php echo $row1[18] . " ," . $row1[23]; ?></font>
                                                                    <div class="dir-rat-star ho-hot-rat-star"> Rating: 
                                                                        <?php
                                                                        $starcheck = 0;
                                                                        if ($row1[7] == "0.5" || $row1[7] == "1.5" || $row1[7] == "2.5" || $row1[7] == "3.5" || $row1[7] == "4.5") {
                                                                            $starcheck = 1;
                                                                        }
                                                                        for ($i = 1; $i <= floor($row1[7]); $i++) {
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
                                                                <li>
                                                                    <div class="col-md-12">
                                                                        <?php
                                                                        $price=$con->query("SELECT rateperday FROM assignroomtype where hotelid=$row1[1]");
                                                                        $pricerow=  mysqli_fetch_array($price);
                                                                        ?>
                                                                        <span style="float:left;">
                                                                                <input id="list-title<?php echo $row1[1]; ?>" type="checkbox" name="hotelid[]" value="<?php echo $row1[1];?>" class="with-gap">
                                                                                <label for="list-title<?php echo $row1[1]; ?>" ></label>
                                                                        </span>
                                                                        <span style="float:left;"><i class="fa fa-rupee"></i></span><span class="ho-hot-pri" style="font-size:10px;padding-left:5px;"><?php echo $pricerow[0]; ?><font style="font-size:10px;"> /- Day</font></span>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                    ?>
                     <?php
                     }
                     if(empty($hotelarray))
                     {
                     ?>
                             <div class="col-md-12 text-center" style="padding-top:20px;">
                                <h1 class="infinite flash animated">Already all hotel is selected !....</h1>
                            </div>
                     <?php
                     }
                     else
                     {
                     ?>

                                <div class="col-md-12 text-center">
                                    <button class="btn" name="hotelrequest">send request now</button>
                                </div>
                     <?php  
                     }
                    ?>

                </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <?php
}
?>

<!-- Manage Child Model custom package status -->

<?php
if($_REQUEST[konidetail] == "status")
{
    ?>
     <div class="modal-content">
        <div class="modal-header">
            <h2 class="text-center">Manage status</h2>
            <i class="close fafado fa fa-close" data-dismiss="modal" onclick="location.reload();" style="color:black!important;top:0px;position:relative;"></i>
        </div>
        <div class="modal-body">
            <div class="container-fluid">
                <div class="row">
                    <div class="text-center"><h1>Manage Hotel's status</h1><hr/></div>
                </div>
                <div class="row">
                        <?php
                        $data = $con->query("SELECT * FROM placeassign p,place pl,custompackage c,city cc where c.custompackageid=p.custompackageid and pl.placeid=p.placeid and cc.cityid=pl.cityid  and c.custompackageid=$_REQUEST[id] group by cc.cityid");
                        while ($row = mysqli_fetch_array($data)) 
                        {
                            ?>
                            <div class="col-md-12 text-center " style="padding:10px;background:#590072;color:white;">
                                <h4>Hotels in <?php echo $row[20]; ?></h4>
                            </div>
                            <?php
                                $data1=$con->query("select * from place where cityid=$row[3]");
                                while($row1=mysqli_fetch_array($data1))
                                {
                                   $data2=$con->query("select * from hotel where hotelid in(select hotelid from hotelrequest where custompackageid=$_REQUEST[id] and status=1) and placeid=$row1[1]");
                                   while($row2=  mysqli_fetch_array($data2))
                                   {
                                    ?>
                                        <form action="" method="post" name="customhotel">
                                            <div class="col-md-3" style="margin-top:10px;">
                                                <div class="to-ho-hotel-con" style="height:270px!important;">
                                                        <div class="to-ho-hotel-con-1"  style="max-height:145px;overflow:hidden;">
                                                            <?php
                                                            $roomgoto = $con->query("select sum(nofrom) from assignroomtype where hotelid=$row2[1]");
                                                            $aapmane = mysqli_fetch_array($roomgoto);
                                                            ?>
                                                            <div class="hom-hot-av-tic" style="font-size:10px;"> Available Rooms: <?php echo $aapmane[0]; ?></div> <img src="<?php echo '../'.$row2[10]; ?>" alt="" style="height:100px;"> 
                                                        </div>
                                                    <div class="to-ho-hotel-con-23" style="padding:18px!important;">
                                                        <div class="to-ho-hotel-con-2">
                                                            <h4 style="text-transform: capitalize;"><font style="font-size:14px;"><?php echo $row2[2]; ?></font></h4>
                                                        </div>
                                                        <div class="to-ho-hotel-con-3">
                                                            <ul>
                                                                <li>
                                                                    <div class="dir-rat-star ho-hot-rat-star"> Rating: 
                                                                        <?php
                                                                        $starcheck = 0;
                                                                        if ($row2[7] == "0.5" || $row2[7] == "1.5" || $row2[7] == "2.5" || $row2[7] == "3.5" || $row2[7] == "4.5") {
                                                                            $starcheck = 1;
                                                                        }
                                                                        for ($i = 1; $i <= floor($row2[7]); $i++) {
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
                                                                <li>
                                                                    <div class="col-md-12">
                                                                        <?php
                                                                        $price=$con->query("SELECT * FROM hotelrequest where hotelid=$row2[1] and custompackageid=$_REQUEST[id]");
                                                                        $pricerow=  mysqli_fetch_array($price);
                                                                        ?>
                                                                        <i class="fa fa-rupee"></i><font style="font-size:10px;"><?php echo $pricerow[4]; ?></font><font style="font-size:10px;"> /- Day</font><font style="font-size:10px;"> (approx)</font>
                                                                    </div>
                                                                    <div class="col-md-12 text-center">
                                                                        <?php
                                                                        $hotelreq=$con->query("select * from hotelrequest where custompackageid=$_REQUEST[id] and hotelid=$row2[1]");
                                                                        $hotelrow=mysqli_fetch_array($hotelreq);
                                                                        ?>
                                                                        <input type="hidden"value="<?php echo $hotelrow[2]; ?>" name="hotelrequestid"/>
                                                                        <button name="delhotelcustom" value="<?php echo $hotelrow[2]; ?>" class="btn" style="margin-top:10px;background:white;border:1px solid white!important;"><i class="fa fa-close" style="color:#FF0049;"></i></button>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                         </form>
                                    <?php  
                                   }
                                }
                        }
                        ?>
                </div>
                <form action="" method="post" name="taxideltekaro">
                        <div class="row">
                            <div class="text-center col-md-12">
                                <h1>manage Taxi Company's status</h1><hr/>
                            </div>
                            <div class="col-md-12">
                                <?php
                                $datataxi = $con->query("SELECT * FROM placeassign p,place pl,custompackage c,city cc where c.custompackageid=p.custompackageid and pl.placeid=p.placeid and cc.cityid=pl.cityid  and c.custompackageid=$_REQUEST[id] group by cc.cityid");
                                while ($row = mysqli_fetch_array($datataxi)) 
                                {
                                    ?>  
                                    <?php
                                    $data1 = $con->query("select * from place where cityid=$row[3]");
                                    while ($row1 = mysqli_fetch_array($data1)) 
                                    {
                                        $data2 = $con->query("select * from taxicompany where taxicompanyid in(select taxicompanyid from taxicompanyrequest where custompackageid=$_REQUEST[id] and status=1) and placeid=$row1[1]");
                                        while ($row2 = mysqli_fetch_array($data2)) 
                                        {
                                             $taxireq=$con->query("select * from taxicompanyrequest where custompackageid=$_REQUEST[id] and taxicompanyid=$row2[1]");
                                             $taxirow=mysqli_fetch_array($taxireq);
                                            ?>
                                
                                    <div class="col-md-5" style="box-shadow: 0px 4px 7px rgba(0, 0, 0, 0.09);margin:10px;padding-bottom:5px;">
                                        <div class="row">
                                            <div class="col-md-10 text-center">
                                                <?php echo $row2[2].' <font style="color:black;" class="animated fadeInRight infinite">&nbsp; -> &nbsp;</font> '.$row[20]; ?>
                                            </div>
                                            <div class="col-md-2">
                                                <button name="delcustomtaxi" class="btn" style="background:white;border:1px solid white!important;padding:0px!important;" value="<?php echo $taxirow[2]; ?>" > <i class="fa fa-close"></i></button>
                                            </div>
                                            <div class="col-md-12 text-center">
                                               <font>[ <?php echo $taxirow[4]; ?> ]</font>
                                            </div>
                                        </div>
                                    </div>
                                            <?php
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                    </form>
            </div>
        </div>
     </div>
    <?php
}
?>

<!-- manage custom package pending -->

<?php
if($_REQUEST[konidetail] == "pending")
{
    ?>
    <div class="modal-content">
        <div class="modal-header">
            <h2>Confirm Package Now !....</h2>
            <i class="close fafado fa fa-close" data-dismiss="modal" onclick="location.reload();" style="color:black!important;top:0px;position:relative;"></i>
        </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <?php
                                $data=$con->query("select * from taxicompanyrequest t,hotelrequest h,custompackage c where c.custompackageid=t.custompackageid and c.custompackageid=h.custompackageid and c.custompackageid=$_REQUEST[id] and h.status=1 and t.status=1");
                                if(mysqli_num_rows($data)>=1)
                                {
                                ?>
                                       <div class="row">
                                           <div class="col-md-12">
                                               <form action="" method="post">
                                                    <h1 style="text-transform:capitalize;padding:10px;background:#590072;color:white;">confirm hotels of custom package</h1>
                                                    <?php
                                                    $datahotel=$con->query("select * from hotel h,hotelrequest hr,place p,city c where p.placeid=h.placeid and c.cityid=p.cityid and h.hotelid=hr.hotelid and hr.custompackageid=$_REQUEST[id] and hr.status=1");
                                                    while($row=  mysqli_fetch_array($datahotel))
                                                    {
                                                    ?>
                                                                <div class="to-ho-hotel-con" style="height:180px!important;">
                                                                    <div class="to-ho-hotel-con-1"  style="max-height:145px;overflow:hidden;">
                                                                        <?php
                                                                        $roomgoto = $con->query("select sum(nofrom) from assignroomtype where hotelid=$row[1]");
                                                                        $aapmane = mysqli_fetch_array($roomgoto);
                                                                        ?>
                                                                        <div class="hom-hot-av-tic" style="font-size:10px;"> Available Rooms: <?php echo $aapmane[0]; ?></div> <img src="<?php echo '../' . $row[10]; ?>" alt="" style="height:100px;"> 
                                                                    </div>
                                                                    <div class="to-ho-hotel-con-23" style="padding:18px!important;">
                                                                        <div class="to-ho-hotel-con-2">
                                                                            <h4 style="text-transform: capitalize;"><font style="font-size:14px;"><?php echo $row[2]; ?> ( <?php echo $row[23]." / "." $row[28] "; ?> )</font></h4>
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
                                        
                                    <div class="row">
                                        <form action="" method="post">
                                            <div class="col-md-12">
                                                <h1 style="text-transform:capitalize;padding:10px;background:#590072;color:white;">confirm Taxi Company of custom package</h1>
                                            </div>
                                            <div class="col-md-12">
                                              <?php
                                              $datataxi=$con->query("select * from taxicompany t,taxicompanyrequest tr,place p,city c where p.placeid=t.placeid and c.cityid=p.cityid and t.taxicompanyid=tr.taxicompanyid and tr.status=1 and tr.custompackageid=$_REQUEST[id]");
                                              while($row= mysqli_fetch_array($datataxi))
                                              {
                                              ?>
                                                <div class="col-md-12 text-center" style="padding:20px;">
                                                    <?php echo  $row[2]; ?>
                                                    <font style="margin-left:10px;"><?php echo " [ &nbsp;". $row[17]; ?></font>
                                                    <font class="animated fadeInRight infinite">&nbsp; -> &nbsp;</font>
                                                    <font> <?php echo $row[22]." &nbsp;] "; ?> </font>
                                                </div>
                                               <?php
                                              }
                                              ?>
                                            </div>
                                        </form>
                                    </div>
                                    
                                         <?php
                                        $selcheck=$con->query("SELECT * FROM custompackage where status=2 and custompackageid=$_REQUEST[id]");
                                        $rowcheck= mysqli_fetch_array($selcheck);
                                        if($rowcheck=="")
                                        {
                                        ?>
                                            <div class="row text-center">
                                                <center>
                                                    <form action="" method="post" name="custompackageresponse" enctype="multipart/form-data">
                                                        <div class="row">
                                                            <div class="col-md-2">

                                                            </div>
                                                            <div class="col-md-10 text-center">
                                                                <div class="input-field col s10">
                                                                    <div class="file-field text-center"> 
                                                                        <?php
                                                                        if ($_SESSION[er] == 1) {
                                                                            echo '<p><font style="color: red; font-size:10px;" class="animated flash infinite">Invalid file formate</font></p>';
                                                                            $_SESSION[er] = 0;
                                                                        } elseif ($_SESSION[err] == 1) {
                                                                            echo '<p><font style="color: red; font-size:10px;" class="animated flash infinite">Size too large</font></p>';
                                                                            $_SESSION[err] = 0;
                                                                        }
                                                                        ?>
                                                                        <div class="btn">
                                                                            <span>File</span>
                                                                            <input type="file" name="responsepdf" required="">
                                                                        </div>
                                                                        <div class="file-path-wrapper">
                                                                            <input class="file-path validate" type="text" placeholder="Select response pdf">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-2">

                                                            </div>
                                                            <div class="col-md-10">
                                                                <div class="col s10">
                                                                    <button name="custompackageresponse" value="<?php echo $_REQUEST[id]; ?>" class="btn">Confirm</button>   
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </center>
                                            </div>
                                        <?php  
                                        }
                                        else
                                        {
                                        ?>
                                            <div class="row text-center">
                                                <div class="col-md-12">
                                                    <h1 class="animated flash infinite">Already Package is confirm</h1>
                                                </div>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                <?php
                                }
                                else
                                {
                                ?>
                                        <div class="col-md-12 text-center" style="padding-top:20px;">
                                            <h1 class="infinite flash animated"> Waiting for conformation !....</h1>
                                        </div>
                                <?php  
                                }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
    </div>
<?php
}
?>

<!-- Manage Child Model custom package taxi -->

<?php

if ($_REQUEST[konidetail] == "customtaxi") 
{
    $taxiarray=array();
    $i=0;
    ?>
    <div class="modal-content">
        <div class="modal-header">
            <h2>Send Request to Taxi company</h2>
            <i class="close fafado fa fa-close" onclick="location.reload();" data-dismiss="modal" style="color:black!important;top:0px;position:relative;"></i>
        </div>
        <div class="modal-body">
            <form action="" method="post" name="custom">
            <div class="container-fluid">
                <div class="to-ho-hotel">
                <div class="row">
                    <?php
                     $data = $con->query("SELECT * FROM placeassign p,place pl,custompackage c,city cc where c.custompackageid=p.custompackageid and pl.placeid=p.placeid and cc.cityid=pl.cityid  and c.custompackageid=$_REQUEST[id] group by cc.cityid");
                      $_SESSION[taxicustompackageid]=$_REQUEST[id];
                     while ($row = mysqli_fetch_array($data)) 
                     {
                     ?>
                                    <div class="col-md-12 text-center " style="padding:10px;background:#590072;color:white;">
                                        <h4>Taxi company in <?php echo $row[20]; ?></h4>
                                    </div>
                                    <div class="col-md-12 text-center">
                                    <?php  
                                        $data1=$con->query("select * from taxicompany t,place p,city c where c.cityid=p.cityid and p.placeid=t.placeid and c.cityid=$row[3] and t.taxicompanyid not in(select taxicompanyid from taxicompanyrequest where custompackageid=$_REQUEST[id])");
                                        while($row1=mysqli_fetch_array($data1))
                                        {
                                            $taxiarray[$i]=$row1[1];
                                            $i++;
                                        ?>

                                                <div style="padding:20px;">
                                                    <input id="list-title<?php echo $row1[1]; ?>" type="checkbox" name="taxicompanyid[]" value="<?php echo $row1[1];?>" class="with-gap">
                                                    <label for="list-title<?php echo $row1[1]; ?>" ><?php echo $row1[2]; ?></label>
                                                </div>

                                        <?php
                                        }
                                    ?>
                                    </div>
                     <?php
                     }
                     if(empty($taxiarray))
                     {
                     ?>
                                <div class="col-md-12 text-center" style="padding-top:20px;">
                                   <h1 class="infinite flash animated">Already all taxi company is selected !....</h1>
                                </div>
                     <?php
                     }
                     else
                     {
                     ?>
                                <div class="col-md-12 text-center">
                                    <button class="btn" name="taxirequest">send request now</button>
                                </div>
                     <?php  
                     }
                    ?>

                </div>
                </div>
            </div>
            </form>
        </div>
    </div>
    <?php
}
?>