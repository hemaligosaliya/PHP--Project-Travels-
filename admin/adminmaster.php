<?php
require_once '../connection.php';
require_once '../insertdata.php';
$_SESSION[page] = "";
if ($_SESSION[user] == "") {
    header("location:../index.php");
} else if ($_SESSION[type]!= 0) {
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
                                        $adminnophoto = $con->query("select * from register where emailid='$_SESSION[user]'");
                                        $selphotoadmin = mysqli_fetch_array($adminnophoto);
                                        ?>
                                        <img src="<?php echo '../' . $selphotoadmin[10]; ?>" alt="">
                                    </li>
                                    <li>
                                        <h5> <?php
                                            $name = $con->query("select * from register where emailid like '$_SESSION[user]'");
                                            $getname = mysqli_fetch_array($name);
                                            echo "welcome, $getname[3] $getname[4]";
                                            ?>
                                            <span> <?php
                                                $lastseen = $con->query("select * from loginhistory where emailid like '$_SESSION[user]'");
                                                $getlast = mysqli_fetch_array($lastseen);
                                                echo "Last Seen, $getlast[2]";
                                                ?></span></h5>
                                    </li>
                                    <li></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 adsubmenu">
                            <ul class="linkclick">
                                
                                
                                <li <?php if($_SESSION[shu]=='custompackagebill'){ echo "class='linkactive'"; }  ?> onclick="takedata('custompackagebill', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-rupee" aria-hidden="true"></i>Custom package Payment
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='packagebill'){ echo "class='linkactive'"; }  ?> onclick="takedata('packagebill', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-rupee" aria-hidden="true"></i> package Payment
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='advancepayment'){ echo "class='linkactive'"; }  ?> onclick="takedata('advancepayment', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-rupee" aria-hidden="true"></i>Advance Payment
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='custompackage'){ echo "class='linkactive'"; }  ?> onclick="takedata('custompackage', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-superpowers" aria-hidden="true"></i> Custom Package
                                </li>

                                <li <?php if($_SESSION[shu]=='country'){ echo "class='linkactive'"; }  ?> onclick="takedata('country', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-globe" aria-hidden="true"></i> Country
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='state'){ echo "class='linkactive'"; }  ?> onclick="takedata('state', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-paper-plane-o" aria-hidden="true"></i> State
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='city'){ echo "class='linkactive'"; }  ?> onclick="takedata('city', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-location-arrow" aria-hidden="true"></i> city
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='place'){ echo "class='linkactive'"; }  ?> onclick="takedata('place', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-map-marker" aria-hidden="true"></i> place
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='placepoint'){ echo "class='linkactive'"; }  ?> onclick="takedata('placepoint', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-map-pin " aria-hidden="true"></i> place point
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='package'){ echo "class='linkactive'"; }  ?> onclick="takedata('package', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-subway" aria-hidden="true"></i> package 
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='package place'){ echo "class='linkactive'"; }  ?> onclick="takedata('package place', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-magic" aria-hidden="true"></i> package place
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='schedule'){ echo "class='linkactive'"; }  ?> onclick="takedata('schedule', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-clock-o" aria-hidden="true"></i> schedule
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='hotel'){ echo "class='linkactive'"; }  ?> onclick="takedata('hotel', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-building" aria-hidden="true"></i> Hotel 
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='room'){ echo "class='linkactive'"; }  ?> onclick="takedata('room', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-bed" aria-hidden="true"></i> room type
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='food'){ echo "class='linkactive'"; }  ?> onclick="takedata('food', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-cutlery" aria-hidden="true"></i> food type
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='amenities'){ echo "class='linkactive'"; }  ?> onclick="takedata('amenities', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-wifi" aria-hidden="true"></i> amenities type
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='user'){ echo "class='linkactive'"; }  ?> onclick="takedata('user', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-user" aria-hidden="true"></i> User 
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='site profile'){ echo "class='linkactive'"; }  ?> onclick="takedata('site profile', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-user-secret" aria-hidden="true"></i> site profile
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='tc and Privacy policy'){ echo "class='linkactive'"; }  ?> onclick="takedata('tc and Privacy policy', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-asterisk" aria-hidden="true"></i> t&c Privacy policy
                                </li> 

                                <li <?php if($_SESSION[shu]=='taxicompany'){ echo "class='linkactive'"; }  ?> onclick="takedata('taxicompany', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-taxi" aria-hidden="true"></i> taxi company
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='vehicle'){ echo "class='linkactive'"; }  ?> onclick="takedata('vehicle', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-motorcycle" aria-hidden="true"></i> vehicle type
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='vehiclename'){ echo "class='linkactive'"; }  ?> onclick="takedata('vehiclename', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-car" aria-hidden="true"></i> vehicle name
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='review'){ echo "class='linkactive'"; }  ?> onclick="takedata('review', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-search" aria-hidden="true"></i> package review
                                </li>
                                
                                <li <?php if($_SESSION[shu]=='offer'){ echo "class='linkactive'"; }  ?> onclick="takedata('offer', 'display', 0, 1, 10, '');count=1;onmouseover=searchbox();">
                                    <i class="fa fa-percent" aria-hidden="true"></i> package offer
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
                              if($_SESSION[shu]=='site profile' || $_SESSION[shu]=='package' || $_SESSION[shu]=='package place' || $_SESSION[shu]=='packagebill' || $_SESSION[shu]=='custompackagebill')
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



        <!-- <div class="container-fluid sb2">
            <div class="row">
                <div class="col-md-2">
                <div class="sb2-1">
                    <div class="sb2-12">
                        <ul>
                            <li>
        <?php
        $adminnophoto = $con->query("select * from register where emailid='$_SESSION[user]'");
        $selphotoadmin = mysqli_fetch_array($adminnophoto);
        ?>
                                <img src="<?php echo '../' . $selphotoadmin[10]; ?>" alt="">
                            </li>
                            <li>
                                <h5> <?php
        $name = $con->query("select * from register where emailid like '$_SESSION[user]'");
        $getname = mysqli_fetch_array($name);
        echo "welcome, $getname[3] $getname[4]";
        ?>
                                    <span> <?php
        $lastseen = $con->query("select * from loginhistory where emailid like '$_SESSION[user]'");
        $getlast = mysqli_fetch_array($lastseen);
        echo "Last Seen, $getlast[2]";
        ?></span></h5>
                            </li>
                            <li></li>
                        </ul>
                    </div>

                    <div class="sb2-13">
                        <ul class="collapsible" data-collapsible="accordion">
                            
                            
                            <li onclick="takedata('country','display',0,1,10,'');"><a href="javascript:void(0);" class="menu-active">
                                    <i class="fa fa-bar-chart" aria-hidden="true"></i> Country [<?php echo $_SESSION[country]; ?>]</a>
                            </li>
                            
                            
                            <li onclick="takedata('room','display',0,1,10,'');"><a href="javascript:void(0);">
                                    <i class="fa fa-user" aria-hidden="true"></i> Room [<?php echo $_SESSION[room]; ?>]</a>
                            </li>
                            
                            
                            <li onclick="takedata('user','display',0,1,10,'');"><a href="javascript:void(0);">
                                    <i class="fa fa-user" aria-hidden="true"></i> User [<?php echo $_SESSION[user]; ?>]</a>
                            </li>
                            
                            
                            
                        </ul>
                    </div>
                    </div>
                </div>
                </div>


        <!--body
        <div class="sb2-2">
            
            <div class="sb2-2-2">
                <ul>
                    <li><a href="index.html"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                    </li>
                    <li class="active-bre"><a href="#"> Dashboard</a>
                    </li>
                    <li class="page-back"><a href="index.html"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
                    </li>
                </ul>
            </div>

            <div class="ad-v2-hom-info">
                         
                <div class="ad-v2-hom-info-inn">
                    <ul>
                        <li>
                            <div class="ad-hom-box ad-hom-box-1">
                                <span class="ad-hom-col-com ad-hom-col-1"><i class="fa fa-bar-chart"></i></span>
                                <div class="ad-hom-view-com">
                                    <p><i class="fa  fa-arrow-up up"></i>Views</p>
                                    <h3>22,520</h3>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="ad-hom-box ad-hom-box-2">
                                <span class="ad-hom-col-com ad-hom-col-2"><i class="fa fa-usd"></i></span>
                                <div class="ad-hom-view-com">
                                    <p><i class="fa  fa-arrow-up up"></i> Earnings</p>
                                    <h3>22,520</h3>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="ad-hom-box ad-hom-box-3">
                                <span class="ad-hom-col-com ad-hom-col-3"><i class="fa fa-address-card-o"></i></span>
                                <div class="ad-hom-view-com">
                                    <p><i class="fa  fa-arrow-up up"></i> Users</p>
                                    <h3>22,520</h3>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div class="ad-hom-box ad-hom-box-4">
                                <span class="ad-hom-col-com ad-hom-col-4"><i class="fa fa-envelope-open-o"></i></span>
                                <div class="ad-hom-view-com">
                                    <p><i class="fa  fa-arrow-up up"></i> Enquiry</p>
                                    <h3>22,520</h3>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="sb2-2-3">
                <div class="row">
                           
                    <div class="col-md-6">
                        <div class="box-inn-sp">
                            <div class="inn-title">
                                <h4>Country Campaigns</h4>
                                <p>Airtport Hotels The Right Way To Start A Short Break Holiday</p>
                                <a class='dropdown-button drop-down-meta' href='#' data-activates='dropdown1'><i class="material-icons">more_vert</i></a>
                                <ul id='dropdown1' class='dropdown-content'>
                                    <li><a href="#!">Add New</a>
                                    </li>
                                    <li><a href="#!">Edit</a>
                                    </li>
                                    <li><a href="#!">Update</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="#!"><i class="material-icons">delete</i>Delete</a>
                                    </li>
                                    <li><a href="#!"><i class="material-icons">subject</i>View All</a>
                                    </li>
                                    <li><a href="#!"><i class="material-icons">play_for_work</i>Download</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-inn">
                                <div class="table-responsive table-desi">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Country</th>
                                                <th>Client</th>
                                                <th>Changes</th>
                                                <th>Budget</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span class="txt-dark weight-500">Australia</span>
                                                </td>
                                                <td>Beavis</td>
                                                <td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>2.43%</span></span>
                                                </td>
                                                <td>
                                                    <span class="txt-dark weight-500">$1478</span>
                                                </td>
                                                <td>
                                                    <span class="label label-success">Active</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="txt-dark weight-500">Cuba</span>
                                                </td>
                                                <td>Felix</td>
                                                <td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>1.43%</span></span>
                                                </td>
                                                <td>
                                                    <span class="txt-dark weight-500">$951</span>
                                                </td>
                                                <td>
                                                    <span class="label label-danger">Closed</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="txt-dark weight-500">France</span>
                                                </td>
                                                <td>Cannibus</td>
                                                <td><span class="txt-danger"><i class="fa fa-angle-up" aria-hidden="true"></i><span>-8.43%</span></span>
                                                </td>
                                                <td>
                                                    <span class="txt-dark weight-500">$632</span>
                                                </td>
                                                <td>
                                                    <span class="label label-default">Hold</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="txt-dark weight-500">Norway</span>
                                                </td>
                                                <td>Neosoft</td>
                                                <td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>7.43%</span></span>
                                                </td>
                                                <td>
                                                    <span class="txt-dark weight-500">$325</span>
                                                </td>
                                                <td>
                                                    <span class="label label-default">Hold</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="txt-dark weight-500">South Africa</span>
                                                </td>
                                                <td>Hencework</td>
                                                <td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>9.43%</span></span>
                                                </td>
                                                <td>
                                                    <span>$258</span>
                                                </td>
                                                <td>
                                                    <span class="label label-success">Active</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="box-inn-sp">
                            <div class="inn-title">
                                <h4>Country Campaigns</h4>
                                <p>Airtport Hotels The Right Way To Start A Short Break Holiday</p>
                                <a class='dropdown-button drop-down-meta' href='#' data-activates='dropdown2'><i class="material-icons">more_vert</i></a>
                                <ul id='dropdown2' class='dropdown-content'>
                                    <li><a href="#!">Add New</a>
                                    </li>
                                    <li><a href="#!">Edit</a>
                                    </li>
                                    <li><a href="#!">Update</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="#!"><i class="material-icons">delete</i>Delete</a>
                                    </li>
                                    <li><a href="#!"><i class="material-icons">subject</i>View All</a>
                                    </li>
                                    <li><a href="#!"><i class="material-icons">play_for_work</i>Download</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-inn">
                                <div class="table-responsive table-desi">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>State</th>
                                                <th>Client</th>
                                                <th>Changes</th>
                                                <th>Budget</th>
                                                <th>Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span class="txt-dark weight-500">California</span>
                                                </td>
                                                <td>Beavis</td>
                                                <td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>2.43%</span></span>
                                                </td>
                                                <td>
                                                    <span class="txt-dark weight-500">$1478</span>
                                                </td>
                                                <td>
                                                    <span class="label label-success">Active</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="txt-dark weight-500">Florida</span>
                                                </td>
                                                <td>Felix</td>
                                                <td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>1.43%</span></span>
                                                </td>
                                                <td>
                                                    <span class="txt-dark weight-500">$951</span>
                                                </td>
                                                <td>
                                                    <span class="label label-danger">Closed</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="txt-dark weight-500">Hawaii</span>
                                                </td>
                                                <td>Cannibus</td>
                                                <td><span class="txt-danger"><i class="fa fa-angle-up" aria-hidden="true"></i><span>-8.43%</span></span>
                                                </td>
                                                <td>
                                                    <span class="txt-dark weight-500">$632</span>
                                                </td>
                                                <td>
                                                    <span class="label label-default">Hold</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="txt-dark weight-500">Alaska</span>
                                                </td>
                                                <td>Neosoft</td>
                                                <td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>7.43%</span></span>
                                                </td>
                                                <td>
                                                    <span class="txt-dark weight-500">$325</span>
                                                </td>
                                                <td>
                                                    <span class="label label-default">Hold</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="txt-dark weight-500">New Jersey</span>
                                                </td>
                                                <td>Hencework</td>
                                                <td><span class="txt-success"><i class="fa fa-angle-up" aria-hidden="true"></i><span>9.43%</span></span>
                                                </td>
                                                <td>
                                                    <span>$258</span>
                                                </td>
                                                <td>
                                                    <span class="label label-success">Active</span>
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

            <div class="sb2-2-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-inn-sp">
                            <div class="inn-title">
                                <h4>User Details</h4>
                                <p>Airtport Hotels The Right Way To Start A Short Break Holiday</p>
                                <a class="dropdown-button drop-down-meta" href="#" data-activates="dr-users"><i class="material-icons">more_vert</i></a>
                                <ul id="dr-users" class="dropdown-content">
                                    <li><a href="#!">Add New</a>
                                    </li>
                                    <li><a href="#!">Edit</a>
                                    </li>
                                    <li><a href="#!">Update</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="#!"><i class="material-icons">delete</i>Delete</a>
                                    </li>
                                    <li><a href="#!"><i class="material-icons">subject</i>View All</a>
                                    </li>
                                    <li><a href="#!"><i class="material-icons">play_for_work</i>Download</a>
                                    </li>
                                </ul>

                            </div>
                            <div class="tab-inn">
                                <div class="table-responsive table-desi">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>User</th>
                                                <th>Name</th>
                                                <th>Phone</th>
                                                <th>Email</th>
                                                <th>Country</th>
                                                <th>Listings</th>
                                                <th>Enquiry</th>
                                                <th>Bookings</th>
                                                <th>Reviews</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span class="list-img"><img src="images/user/1.png" alt=""></span>
                                                </td>
                                                <td><a href="#"><span class="list-enq-name">Marsha Hogan</span><span class="list-enq-city">Illunois, United States</span></a>
                                                </td>
                                                <td>+01 3214 6522</td>
                                                <td>chadengle@dummy.com</td>
                                                <td>Australia</td>
                                                <td>
                                                    <span class="label label-primary">02</span>
                                                </td>
                                                <td>
                                                    <span class="label label-danger">12</span>
                                                </td>
                                                <td>
                                                    <span class="label label-success">24</span>
                                                </td>
                                                <td>
                                                    <span class="label label-info">36</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="list-img"><img src="images/user/2.png" alt=""></span>
                                                </td>
                                                <td><a href="#"><span class="list-enq-name">Marsha Hogan</span><span class="list-enq-city">Illunois, United States</span></a>
                                                </td>
                                                <td>+01 3214 6522</td>
                                                <td>chadengle@dummy.com</td>
                                                <td>Australia</td>
                                                <td>
                                                    <span class="label label-primary">02</span>
                                                </td>
                                                <td>
                                                    <span class="label label-danger">12</span>
                                                </td>
                                                <td>
                                                    <span class="label label-success">24</span>
                                                </td>
                                                <td>
                                                    <span class="label label-info">36</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="list-img"><img src="images/user/3.png" alt=""></span>
                                                </td>
                                                <td><a href="#"><span class="list-enq-name">Marsha Hogan</span><span class="list-enq-city">Illunois, United States</span></a>
                                                </td>
                                                <td>+01 3214 6522</td>
                                                <td>chadengle@dummy.com</td>
                                                <td>Australia</td>
                                                <td>
                                                    <span class="label label-primary">02</span>
                                                </td>
                                                <td>
                                                    <span class="label label-danger">12</span>
                                                </td>
                                                <td>
                                                    <span class="label label-success">24</span>
                                                </td>
                                                <td>
                                                    <span class="label label-info">36</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="list-img"><img src="images/user/4.png" alt=""></span>
                                                </td>
                                                <td><a href="#"><span class="list-enq-name">Marsha Hogan</span><span class="list-enq-city">Illunois, United States</span></a>
                                                </td>
                                                <td>+01 3214 6522</td>
                                                <td>chadengle@dummy.com</td>
                                                <td>Australia</td>
                                                <td>
                                                    <span class="label label-primary">02</span>
                                                </td>
                                                <td>
                                                    <span class="label label-danger">12</span>
                                                </td>
                                                <td>
                                                    <span class="label label-success">24</span>
                                                </td>
                                                <td>
                                                    <span class="label label-info">36</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="list-img"><img src="images/user/5.png" alt=""></span>
                                                </td>
                                                <td><a href="#"><span class="list-enq-name">Marsha Hogan</span><span class="list-enq-city">Illunois, United States</span></a>
                                                </td>
                                                <td>+01 3214 6522</td>
                                                <td>chadengle@dummy.com</td>
                                                <td>Australia</td>
                                                <td>
                                                    <span class="label label-primary">02</span>
                                                </td>
                                                <td>
                                                    <span class="label label-danger">12</span>
                                                </td>
                                                <td>
                                                    <span class="label label-success">24</span>
                                                </td>
                                                <td>
                                                    <span class="label label-info">36</span>
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

            <div class="sb2-2-3">
                <div class="row">
                    


                    <div class="col-md-6">
                        <div class="box-inn-sp">
                            <div class="inn-title">
                                <h4>Travel Package Enquiry</h4>
                                <p>Airtport Hotels The Right Way To Start A Short Break Holiday</p>
                                <a class="dropdown-button drop-down-meta" href="#" data-activates="dr-listings"><i class="material-icons">more_vert</i></a>
                                <ul id="dr-listings" class="dropdown-content">
                                    <li><a href="#!">Add New</a>
                                    </li>
                                    <li><a href="#!">Edit</a>
                                    </li>
                                    <li><a href="#!">Update</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="#!"><i class="material-icons">delete</i>Delete</a>
                                    </li>
                                    <li><a href="#!"><i class="material-icons">subject</i>View All</a>
                                    </li>
                                    <li><a href="#!"><i class="material-icons">play_for_work</i>Download</a>
                                    </li>
                                </ul>
                                

                            </div>
                            <div class="tab-inn">
                                <div class="table-responsive table-desi">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Select</th>
                                                <th>Listing</th>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>City</th>
                                                <th>Enquiry</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="filled-in" id="filled-in-box-1" checked="checked" />
                                                    <label for="filled-in-box-1"></label>
                                                </td>
                                                <td><span class="list-img"><img src="images/listing/1.jpg" alt=""></span>
                                                </td>
                                                <td><span class="list-enq-name">Taaj Club House</span><span class="list-enq-city">Illunois, United States</span>
                                                </td>
                                                <td>12 may</td>
                                                <td>Hawaii</td>
                                                <td>
                                                    <span class="label label-success">15</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="filled-in" id="filled-in-box-2" checked="checked" />
                                                    <label for="filled-in-box-2"></label>
                                                </td>
                                                <td><span class="list-img"><img src="images/listing/2.jpg" alt=""></span>
                                                </td>
                                                <td><span class="list-enq-name">Grand Hotel</span><span class="list-enq-city">Rio,Brazil</span>
                                                </td>
                                                <td>07 aug</td>
                                                <td>Hawaii</td>
                                                <td>
                                                    <span class="label label-success">05</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="filled-in" id="filled-in-box-3" checked="checked" />
                                                    <label for="filled-in-box-3"></label>
                                                </td>
                                                <td><span class="list-img"><img src="images/listing/3.jpg" alt=""></span>
                                                </td>
                                                <td><span class="list-enq-name">Grand Pales</span><span class="list-enq-city">Chennai,India</span>
                                                </td>
                                                <td>18 jun</td>
                                                <td>Hawaii</td>
                                                <td>
                                                    <span class="label label-success">35</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="filled-in" id="filled-in-box-4" />
                                                    <label for="filled-in-box-4"></label>
                                                </td>
                                                <td><span class="list-img"><img src="images/listing/4.jpg" alt=""></span>
                                                </td>
                                                <td><span class="list-enq-name">Lake Palace Hotel</span><span class="list-enq-city">Beijing,China</span>
                                                </td>
                                                <td>09 apr</td>
                                                <td>Hawaii</td>
                                                <td>
                                                    <span class="label label-success">24</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" class="filled-in" id="filled-in-box-5" />
                                                    <label for="filled-in-box-5"></label>
                                                </td>
                                                <td><span class="list-img"><img src="images/listing/5.jpg" alt=""></span>
                                                </td>
                                                <td><span class="list-enq-name">First Class Hotel</span><span class="list-enq-city">Berlin,Germany</span>
                                                </td>
                                                <td>21 jun</td>
                                                <td>Hawaii</td>
                                                <td>
                                                    <span class="label label-success">18</span>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="col-md-6">
                        <div class="box-inn-sp">
                            <div class="inn-title">
                                <h4>Hotel Bookings</h4>
                                <p>Airtport Hotels The Right Way To Start A Short Break Holiday</p>
                                <a class="dropdown-button drop-down-meta" href="#" data-activates="dr-hotel"><i class="material-icons">more_vert</i></a>
                                <ul id="dr-hotel" class="dropdown-content">
                                    <li><a href="#!">Add New</a>
                                    </li>
                                    <li><a href="#!">Edit</a>
                                    </li>
                                    <li><a href="#!">Update</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="#!"><i class="material-icons">delete</i>Delete</a>
                                    </li>
                                    <li><a href="#!"><i class="material-icons">subject</i>View All</a>
                                    </li>
                                    <li><a href="#!"><i class="material-icons">play_for_work</i>Download</a>
                                    </li>
                                </ul>
                                

                            </div>
                            <div class="tab-inn">
                                <div class="table-responsive table-desi">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Select</th>
                                                <th>Listing</th>
                                                <th>Name</th>
                                                <th>Date</th>
                                                <th>City</th>
                                                <th>Enquiry</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" id="ch2-1" />
                                                    <label for="ch2-1"></label>
                                                </td>
                                                <td><span class="list-img"><img src="images/listing/1.jpg" alt=""></span>
                                                </td>
                                                <td><span class="list-enq-name">Taaj Club House</span><span class="list-enq-city">Illunois, United States</span>
                                                </td>
                                                <td>12 may</td>
                                                <td>Hawaii</td>
                                                <td>
                                                    <span class="label label-success">15</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" id="ch2-2" />
                                                    <label for="ch2-2"></label>
                                                </td>
                                                <td><span class="list-img"><img src="images/listing/2.jpg" alt=""></span>
                                                </td>
                                                <td><span class="list-enq-name">Grand Hotel</span><span class="list-enq-city">Rio,Brazil</span>
                                                </td>
                                                <td>07 aug</td>
                                                <td>Hawaii</td>
                                                <td>
                                                    <span class="label label-success">05</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" id="ch2-3" />
                                                    <label for="ch2-3"></label>
                                                </td>
                                                <td><span class="list-img"><img src="images/listing/3.jpg" alt=""></span>
                                                </td>
                                                <td><span class="list-enq-name">Grand Pales</span><span class="list-enq-city">Chennai,India</span>
                                                </td>
                                                <td>18 jun</td>
                                                <td>Hawaii</td>
                                                <td>
                                                    <span class="label label-success">35</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" id="ch2-4" />
                                                    <label for="ch2-4"></label>
                                                </td>
                                                <td><span class="list-img"><img src="images/listing/4.jpg" alt=""></span>
                                                </td>
                                                <td><span class="list-enq-name">Lake Palace Hotel</span><span class="list-enq-city">Beijing,China</span>
                                                </td>
                                                <td>09 apr</td>
                                                <td>Hawaii</td>
                                                <td>
                                                    <span class="label label-success">24</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <input type="checkbox" id="ch2-5" />
                                                    <label for="ch2-5"></label>
                                                </td>
                                                <td><span class="list-img"><img src="images/listing/5.jpg" alt=""></span>
                                                </td>
                                                <td><span class="list-enq-name">First Class Hotel</span><span class="list-enq-city">Berlin,Germany</span>
                                                </td>
                                                <td>21 jun</td>
                                                <td>Hawaii</td>
                                                <td>
                                                    <span class="label label-success">18</span>
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

          
            <div class="sb2-2-3">
                <div class="row">
                    
                    <div class="col-md-6">
                        <div class="box-inn-sp">
                            <div class="inn-title">
                                <h4>Latest Activity</h4>
                                <p>Airtport Hotels The Right Way To Start A Short Break Holiday</p>
                                <a class="dropdown-button drop-down-meta" href="#" data-activates="dr-activ"><i class="material-icons">more_vert</i></a>
                                <ul id="dr-activ" class="dropdown-content">
                                    <li><a href="#!">Add New</a>
                                    </li>
                                    <li><a href="#!">Edit</a>
                                    </li>
                                    <li><a href="#!">Update</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="#!"><i class="material-icons">delete</i>Delete</a>
                                    </li>
                                    <li><a href="#!"><i class="material-icons">subject</i>View All</a>
                                    </li>
                                    <li><a href="#!"><i class="material-icons">play_for_work</i>Download</a>
                                    </li>
                                </ul>
                                

                            </div>
                            <div class="tab-inn list-act-hom">
                                <ul>
                                    <li class="list-act-hom-con">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <h4><span>12 may, 2017</span> Arrival and Evening Dhow Cruise</h4>
                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>
                                    </li>
                                    <li class="list-act-hom-con">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <h4><span>08 Jun, 2017</span> City Tour and Evening Free</h4>
                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>
                                    </li>
                                    <li class="list-act-hom-con">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <h4><span>27 July, 2017</span> Desert Safari with Dinner</h4>
                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>
                                    </li>
                                    <li class="list-act-hom-con">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <h4><span>14 Aug, 2017</span> Day at leisure</h4>
                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>
                                    </li>
                                    <li class="list-act-hom-con">
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                        <h4><span>24 Sep, 2017</span> Departure</h4>
                                        <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour.</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
               
                    <div class="col-md-6">
                        <div class="box-inn-sp">
                            <div class="inn-title">
                                <h4>Social Media</h4>
                                <p>Airtport Hotels The Right Way To Start A Short Break Holiday</p>
                                <a class="dropdown-button drop-down-meta" href="#" data-activates="dr-social"><i class="material-icons">more_vert</i></a>
                                <ul id="dr-social" class="dropdown-content">
                                    <li><a href="#!">Add New</a>
                                    </li>
                                    <li><a href="#!">Edit</a>
                                    </li>
                                    <li><a href="#!">Update</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="#!"><i class="material-icons">delete</i>Delete</a>
                                    </li>
                                    <li><a href="#!"><i class="material-icons">subject</i>View All</a>
                                    </li>
                                    <li><a href="#!"><i class="material-icons">play_for_work</i>Download</a>
                                    </li>
                                </ul>
                               

                            </div>
                            <div class="tab-inn">
                                <div class="table-responsive table-desi">
                                    <table class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th>Media</th>
                                                <th>Name</th>
                                                <th>Share</th>
                                                <th>Like</th>
                                                <th>Members</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span class="list-img"><img src="images/sm/1.png" alt=""></span>
                                                </td>
                                                <td><span class="list-enq-name">Linked In</span><span class="list-enq-city">Illunois, United States</span>
                                                </td>
                                                <td>15K</td>
                                                <td>18K</td>
                                                <td>
                                                    <span class="label label-success">263</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="list-img"><img src="images/sm/2.png" alt=""></span>
                                                </td>
                                                <td><span class="list-enq-name">Twitter</span><span class="list-enq-city">Illunois, United States</span>
                                                </td>
                                                <td>15K</td>
                                                <td>18K</td>
                                                <td>
                                                    <span class="label label-success">263</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="list-img"><img src="images/sm/3.png" alt=""></span>
                                                </td>
                                                <td><span class="list-enq-name">Facebook</span><span class="list-enq-city">Illunois, United States</span>
                                                </td>
                                                <td>15K</td>
                                                <td>18K</td>
                                                <td>
                                                    <span class="label label-success">263</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="list-img"><img src="images/sm/4.png" alt=""></span>
                                                </td>
                                                <td><span class="list-enq-name">Google Plus</span><span class="list-enq-city">Illunois, United States</span>
                                                </td>
                                                <td>15K</td>
                                                <td>18K</td>
                                                <td>
                                                    <span class="label label-success">263</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="list-img"><img src="images/sm/5.png" alt=""></span>
                                                </td>
                                                <td><span class="list-enq-name">YouTube</span><span class="list-enq-city">Illunois, United States</span>
                                                </td>
                                                <td>15K</td>
                                                <td>18K</td>
                                                <td>
                                                    <span class="label label-success">263</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="list-img"><img src="images/sm/6.png" alt=""></span>
                                                </td>
                                                <td><span class="list-enq-name">WhatsApp</span><span class="list-enq-city">Illunois, United States</span>
                                                </td>
                                                <td>15K</td>
                                                <td>18K</td>
                                                <td>
                                                    <span class="label label-success">263</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="list-img"><img src="images/sm/7.png" alt=""></span>
                                                </td>
                                                <td><span class="list-enq-name">VK</span><span class="list-enq-city">Illunois, United States</span>
                                                </td>
                                                <td>15K</td>
                                                <td>18K</td>
                                                <td>
                                                    <span class="label label-success">263</span>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><span class="list-img"><img src="images/sm/2.png" alt=""></span>
                                                </td>
                                                <td><span class="list-enq-name">Twitter</span><span class="list-enq-city">Illunois, United States</span>
                                                </td>
                                                <td>15K</td>
                                                <td>18K</td>
                                                <td>
                                                    <span class="label label-success">263</span>
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
          
            <div class="sb2-2-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-inn-sp">
                            <div class="inn-title">
                                <h4>Google Map</h4>
                                <p>Airtport Hotels The Right Way To Start A Short Break Holiday</p>
                                <a class="dropdown-button drop-down-meta" href="#" data-activates="dr-map"><i class="material-icons">more_vert</i></a>
                                <ul id="dr-map" class="dropdown-content">
                                    <li><a href="#!">Add New</a>
                                    </li>
                                    <li><a href="#!">Edit</a>
                                    </li>
                                    <li><a href="#!">Update</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li><a href="#!"><i class="material-icons">delete</i>Delete</a>
                                    </li>
                                    <li><a href="#!"><i class="material-icons">subject</i>View All</a>
                                    </li>
                                    <li><a href="#!"><i class="material-icons">play_for_work</i>Download</a>
                                    </li>
                                </ul>
                                

                            </div>
                            <div class="tab-inn">
                                <div class="table-responsive table-desi tab-map">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6290413.804893654!2d-93.99620524741552!3d39.66116578737809!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x880b2d386f6e2619%3A0x7f15825064115956!2sIllinois%2C+USA!5e0!3m2!1sen!2sin!4v1469954001005" allowfullscreen></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            Comment Over
            
        <div class="row">
            <div class="col-md-12">
                <div class="col-md-3">
                    
                </div>
            <div class="col-md-9">
                <br/>
                <form class="form-group">
                    Search <?php echo $_SESSION[shu]; ?> : <input type="search" autocomplete="off" onkeyup="takedata('<?php echo $_SESSION[shu]; ?>','search',this.value);" name="search" placeholder="Search here" class="admin-form" />
                </form>
            </div>
            </div>
        </div>
        
        
      
        <div class="row">
            <div class="col-md-12" id="missdata">

            </div>
        </div>
    </div>

        <!--== BOTTOM FLOAT ICON ==
        <section>
            <div class="fixed-action-btn vertical">
                <a class="btn-floating btn-large red pulse">
                    <i class="large material-icons">mode_edit</i>
                </a>
                <ul>
                    <li><a class="btn-floating red"><i class="material-icons">insert_chart</i></a>
                    </li>
                    <li><a class="btn-floating yellow darken-1"><i class="material-icons">format_quote</i></a>
                    </li>
                    <li><a class="btn-floating green"><i class="material-icons">publish</i></a>
                    </li>
                    <li><a class="btn-floating blue"><i class="material-icons">attach_file</i></a>
                    </li>
                </ul>
            </div>
        </section>
        
        
        -->

        <?php
        require_once 'adminscript.php';
        ?>

    </body>

</html>
