<!doctype html>
<?phprequire_once '../connection.php';
     require_once '../insertdata.php';
?>
<html>
    
<?php
require_once 'adminhead.php';
?>
    
    <body>  
         <?php
        require_once 'adminheader.php';
        ?>
        
            <section class="invoice-wrapper">
                    <div class="container" style="width:1030px;">
                        <div class="row topbot">

                            <div class="col-md-10 px-5">
                                <div class="row py-5">
                                    <div class="col-md-3">
                                        <img src="images/logo.png" class="img-responsive" style="height:50px; width:200px;" />
                                    </div>
                                    <div class="col-md-4">
                                        <h2 class='invoice-text text-center' style="margin-left:127px">INVOICE</h2>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4>Bhautik Domadiya</h4>
                                        <p>Date Issued : 04 May '16 <br/>Invoice No : 12345</p>
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
                                        <p><?php echo $aapo[3] . " " . $aapo[4] ?><br/><?php echo $stradd[0]; ?>,<?php echo $stradd[1]; ?>,<br /><?php echo $stradd[2]; ?><?php echo $stradd[3]; ?></p>
                                    </div>
                                </div>
                                <div class="row py-5">
                                    <div class="col-md-12">
                                        <div class='table-responsive'>
                                            <table class='table'>
                                                <thead>
                                                <th style="text-align:center;">PACKAGE NAME</th>
                                                <th style="text-align:center;">PAY MODE</th>
                                                <th style="text-align:center;">PACKAGE AMOUNT</th>
                                                <th style="text-align:center;">ADVANCE AMOUNT</th>
                                                <th style="text-align:center;">SUBTOTAL</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="text-align:center;">Snow White</td>
                                                        <td style="text-align:center;">BANK</td>
                                                        <td style="text-align:center;"><i class='fa fa-rupee'></i> 12.34</td>
                                                        <td style="text-align:center;"><i class='fa fa-rupee'></i> 100</td>
                                                        <td style="text-align:center;"class='highlighter'><i class='fa fa-rupee'></i> 1234</td>
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
                                                <th>BANK INFO</th>
                                                <th>TOTAL AMOUNT</th>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class='img-responsive' rowspan="0"><img src='images/signature.png' height="30px" style="padding-top:10px;" width="auto" /></td>
                                                        <td>Account No : 123 456 789<br/>Sort Code : 01 23 45</td>
                                                        <td rowspan="0"><h3 class='highlighter' rowspan="0"><i class='fa fa-rupee'></i> 2468.00</h3>(5% GST include)</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-12 py-3">
                                        <div class='row justify-content-between'>
                                            <div class='col-md-4'>
                                                <h4 class='font-weight-light'><i class='fa fa-heart pr-3'></i>Thanks for booking package</h4>
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
                                </div>
                            </div>

                        </div>
                    </div>
                </section>
    </body>    
</html>