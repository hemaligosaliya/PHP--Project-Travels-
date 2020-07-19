<?php
require_once '../connection.php';
require_once '../insertdata.php';
$_SESSION[page] = "";
if ($_SESSION[user] == "") {
    header("location:../index.php");
} else if ($_SESSION[type]!= 2) {
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
                                        <?php
                                        $adminnophoto = $con->query("select * from hotel where hotelid='$_SESSION[hotelid]'");
                                        $selphotoadmin = mysqli_fetch_array($adminnophoto);
                                        ?>
                                        <img src="<?php echo '../' . $selphotoadmin[9]; ?>" alt="">
                                    </li>
                                    <li>
                                        <h5> <?php
                                            $name = $con->query("select * from hotel where hotelid like '$_SESSION[hotelid]'");
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


                                <li <?php if($_SESSION[shu]=='assignroomtype'){ echo "class='linkactive'"; }  ?> onclick="takedata('assignroomtype', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-bed" aria-hidden="true"></i> room type
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='assignfoodtype'){ echo "class='linkactive'"; }  ?> onclick="takedata('assignfoodtype', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-cutlery" aria-hidden="true"></i> food type
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='assignamenities'){ echo "class='linkactive'"; }  ?> onclick="takedata('assignamenities', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-wifi" aria-hidden="true"></i> amenities type
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='requesthotelconformation'){ echo "class='linkactive'"; }  ?> onclick="takedata('requesthotelconformation', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
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
                              if($_SESSION[shu]=='site profile' || $_SESSION[shu]=='package' || $_SESSION[shu]=='package place' || $_SESSION[shu]=='assignvehiclename' || $_SESSION[shu]=='assignfoodtype'|| $_SESSION[shu]=='assignroomtype' || $_SESSION[shu]=='requesthotelconformation' || $_SESSION[shu]=="assignamenities")
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
