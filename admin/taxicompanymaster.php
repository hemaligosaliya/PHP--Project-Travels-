<?php
require_once '../connection.php';
require_once '../insertdata.php';
$_SESSION[page] = "";
if ($_SESSION[user] == "") {
    header("location:../index.php");
} else if ($_SESSION[type]!= 3) {
    header("location:../index.php");
}

?>
<html lang="en">


<?php
require_once 'adminhead.php';
?>


    <body onload="takedata('<?php echo $_SESSION[shu]; ?>', 'display', 0, 1, 10, '');">

        <?php
        require_once 'adminheader.php';
        ?>

        <div class="adtopbot">

        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2 admenu">
                    <div class="row ">
                        <div class="col-md-12">
                            <div class="sb2-12 ">
                                <ul>
                                    <li>
                                        <img src="images/taxifinal.png" alt="">
                                    </li>
                                    <li>
                                        <h5> <?php
                                            $name = $con->query("select * from taxicompany where taxicompanyid=$_SESSION[taxicompanyid]");
                                            $getname = mysqli_fetch_array($name);
                                            echo "welcome, $getname[2]";
                                            ?>
                                        </h5>
                                    </li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 adsubmenu">
                            <ul class="linkclick">


                                <li <?php if($_SESSION[shu]=='assignvehiclename'){ echo "class='linkactive'"; }  ?> onclick="takedata('assignvehiclename', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-bed" aria-hidden="true"></i> vehicle name
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='requesttaxiconformation'){ echo "class='linkactive'"; }  ?> onclick="takedata('requesttaxiconformation', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-registered" aria-hidden="true"></i> request Conformation
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-10" >
                    <div class="row">
                        <div class="col-md-12" id="searchboxad">
                            <form class="form-group">
                              <?php 
                              if($_SESSION[shu]=='site profile' || $_SESSION[shu]=='package' || $_SESSION[shu]=='package place' || $_SESSION[shu]=='assignvehiclename' || $_SESSION[shu]=='assignfoodtype' || $_SESSION[shu]=='requesttaxiconformation')
                                {
                                }
                                else
                                {
                              ?>
                                Search  : <input type="search" autocomplete="off" onkeyup="takedata('<?php echo $_SESSION[shu]; ?>','search',this.value);" name="search" placeholder="Search here" class="admin-form animated fadeInUp" />
                              <?php 
                                }
                              ?>
                            </form>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12" id="missdata">

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
