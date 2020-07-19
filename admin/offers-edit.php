<!DOCTYPE html>
<html lang="en">


<!-- Mirrored from rn53themes.net/themes/demo/travelz/admin/offers-edit.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 13 Jan 2019 05:21:55 GMT -->
<head>
    <title>Lava Material - Web Application and Website Multipurpose Admin Panel Template</title>
    <!--== META TAGS ==-->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!--== FAV ICON ==-->
    <link rel="shortcut icon" href="images/fav.ico">

    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600|Quicksand:300,400,500" rel="stylesheet">

    <!-- FONT-AWESOME ICON CSS -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!--== ALL CSS FILES ==-->
    <link rel="stylesheet" href="css/adminstyle.css">
    <link rel="stylesheet" href="css/mob.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/materialize.css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
</head>

<body>
    <!--== MAIN CONTRAINER ==-->
    <div class="container-fluid sb1">
        <div class="row">
            <!--== LOGO ==-->
            <div class="col-md-2 col-sm-3 col-xs-6 sb1-1">
                <a href="#" class="btn-close-menu"><i class="fa fa-times" aria-hidden="true"></i></a>
                <a href="#" class="atab-menu"><i class="fa fa-bars tab-menu" aria-hidden="true"></i></a>
                <a href="index.html" class="logo"><img src="images/logo1.png" alt="" />
                </a>
            </div>
            <!--== SEARCH ==-->
            <div class="col-md-6 col-sm-6 mob-hide">
                <form class="app-search">
                    <input type="text" placeholder="Search..." class="form-control">
                    <a href="#"><i class="fa fa-search"></i></a>
                </form>
            </div>
            <!--== NOTIFICATION ==-->
            <div class="col-md-2 tab-hide">
                <div class="top-not-cen">
                    <a class='waves-effect btn-noti' href='#'><i class="fa fa-commenting-o" aria-hidden="true"></i><span>5</span></a>
                    <a class='waves-effect btn-noti' href='#'><i class="fa fa-envelope-o" aria-hidden="true"></i><span>5</span></a>
                    <a class='waves-effect btn-noti' href='#'><i class="fa fa-tag" aria-hidden="true"></i><span>5</span></a>
                </div>
            </div>
            <!--== MY ACCCOUNT ==-->
            <div class="col-md-2 col-sm-3 col-xs-6">
                <!-- Dropdown Trigger -->
                <a class='waves-effect dropdown-button top-user-pro' href='#' data-activates='top-menu'><img src="images/user/6.png" alt="" />My Account <i class="fa fa-angle-down" aria-hidden="true"></i>
                </a>

                <!-- Dropdown Structure -->
                <ul id='top-menu' class='dropdown-content top-menu-sty'>
                    <li><a href="setting.html" class="waves-effect"><i class="fa fa-cogs" aria-hidden="true"></i>Admin Setting</a>
                    </li>
                    
                    </li>
                    <li><a href="hotel-all.html" class="waves-effect"><i class="fa fa-building-o" aria-hidden="true"></i> Hotels</a>
                    </li>
                    <li><a href="package-all.html" class="waves-effect"><i class="fa fa-umbrella" aria-hidden="true"></i> Tour Packages</a>
                    </li>
                    <li><a href="event-all.html" class="waves-effect"><i class="fa fa-flag-checkered" aria-hidden="true"></i> Events</a>
                    </li>
                    <li><a href="offers.html" class="waves-effect"><i class="fa fa-tags" aria-hidden="true"></i> Offers</a>
                    </li>
                    <li><a href="user-add.html" class="waves-effect"><i class="fa fa-user-plus" aria-hidden="true"></i> Add New User</a>
                    </li>
                    <li><a href="#" class="waves-effect"><i class="fa fa-undo" aria-hidden="true"></i> Backup Data</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="#" class="ho-dr-con-last waves-effect"><i class="fa fa-sign-in" aria-hidden="true"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!--== BODY CONTNAINER ==-->
    <div class="container-fluid sb2">
        <div class="row">
            <div class="sb2-1">
                <!--== USER INFO ==-->
                <div class="sb2-12">
                    <ul>
                        <li><img src="images/placeholder.jpg" alt="">
                        </li>
                        <li>
                            <h5>Victoria Baker <span> Santa Ana, CA</span></h5>
                        </li>
                        <li></li>
                    </ul>
                </div>
                <!--== LEFT MENU ==-->
                <div class="sb2-13">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li><a href="index.html"><i class="fa fa-bar-chart" aria-hidden="true"></i> Dashboard</a>
                        </li>
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-user" aria-hidden="true"></i> Users</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    <li><a href="user-all.html">All Users</a>
                                    </li>
                                    <li><a href="user-add.html">Add New user</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-umbrella" aria-hidden="true"></i> Tour Packages</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    <li><a href="package-all.html">All Packages</a>
                                    </li>
                                    <li><a href="package-add.html">Add New Package</a>
                                    </li>
                                    <li><a href="package-cat-all.html">All Package Categories</a>
                                    </li>
                                    <li><a href="package-cat-add.html">Add Package Categories</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-h-square" aria-hidden="true"></i> Hotels</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    <li><a href="hotel-all.html">All Hotels</a>
                                    </li>
                                    <li><a href="hotel-add.html">Add New Hotel</a>
                                    </li>
                                    <li><a href="hotel-room-type-all.html">Room Type</a>
                                    </li>
                                    <li><a href="hotel-room-type-add.html">Add Room Type</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-picture-o" aria-hidden="true"></i> Sight Seeings</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    <li><a href="sight-see-all.html">All Sight Seeings</a>
                                    </li>
                                    <li><a href="sight-see-add.html">Add New Sight Seeing</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-calendar-o" aria-hidden="true"></i> Events</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    <li><a href="event-all.html">All Events</a>
                                    </li>
                                    <li><a href="event-add.html">Add New Event</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-braille" aria-hidden="true"></i> Ui-Kits</a>
                            <div class="collapsible-body left-sub-menu">
                                <ul>
                                    <li><a href="ui-form.html">ui-form</a>
                                    </li>
                                    <li><a href="ui-kit.html">ui-kit</a>
                                    </li>
                                    <li><a href="ui-table.html">ui-table</a>
                                    </li>
                                    <li><a href="ui-pre-load.html">ui-pre-load</a>
                                    </li>
                                    <li><a href="ui-tab.html">ui-tab</a>
                                    </li>
                                    <li><a href="ui-icons.html">ui-icons</a>
                                    </li>
                                    <li><a href="ui-collapsible.html">ui-collapsible</a>
                                    </li>
                                </ul>
                            </div>
                            </li>
                            <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-usd" aria-hidden="true"></i> Discounts</a>
                                <div class="collapsible-body left-sub-menu">
                                    <ul>
                                        <li><a href="discount.html">All Discounts</a>
                                        </li>
                                        <li><a href="discount-add.html">Add New Discounts</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="javascript:void(0)" class="collapsible-header active"><i class="fa fa-tags" aria-hidden="true"></i> Offers</a>
                                <div class="collapsible-body left-sub-menu">
                                    <ul>
                                        <li><a href="offers.html" class="menu-active">All Offers</a>
                                        </li>
                                        <li><a href="offers-add.html">Add New Offers</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-ticket" aria-hidden="true"></i> Booking & Enquiry</a>
                                <div class="collapsible-body left-sub-menu">
                                    <ul>
                                        <li><a href="hotel-booking-all.html">Hotel</a>
                                        </li>
                                        <li><a href="package-booking-all.html">Package</a>
                                        </li>
                                        <li><a href="sight-see-booking-all.html">Sight Seeings</a>
                                        </li>
                                        <li><a href="event-booking-all.html">Events</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="javascript:void(0)" class="collapsible-header"><i class="fa fa-rss" aria-hidden="true"></i> Blog & Articals</a>
                                <div class="collapsible-body left-sub-menu">
                                    <ul>
                                        <li><a href="blog-all.html">All Blogs</a>
                                        </li>
                                        <li><a href="blog-add.html">Add Blog</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li><a href="social-media.html"><i class="fa fa-plus-square-o" aria-hidden="true"></i> Social Media</a>
                            </li>
                            <li><a href="login.html" target="_blank"><i class="fa fa-sign-in" aria-hidden="true"></i> Login</a>
                            </li>
                    </ul>
                </div>
            </div>
            <div class="sb2-2">
                <div class="sb2-2-2">
                    <ul>
                        <li><a href="index.html"><i class="fa fa-home" aria-hidden="true"></i> Home</a>
                        </li>
                        <li class="active-bre"><a href="#"> Offers Edit</a>
                        </li>
                        <li class="page-back"><a href="index.html"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
                        </li>
                    </ul>
                </div>
                <div class="sb2-2-add-blog sb2-2-1">
                    <div class="box-inn-sp">
                        <div class="inn-title">
                            <h4>Offers Edit</h4>
                            <p>Airtport Hotels The Right Way To Start A Short Break Holiday</p>
                        </div>
                        <div class="bor">
                            <form>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input id="list-title" type="text" value="Blog Post Name" class="validate">
                                        <label for="list-title">Offers Name</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <input id="post-auth" type="text" value="$240" class="validate">
                                        <label for="post-auth">Offers Price</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <div class="file-field">
                                            <div class="btn">
                                                <span>File</span>
                                                <input type="file">
                                            </div>
                                            <div class="file-path-wrapper">
                                                <input class="file-path validate" type="text" placeholder="Upload Blog Banner">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <textarea id="textarea1" class="materialize-textarea">It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</textarea>
                                        <label for="textarea1">Blog Descriptions:</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <select multiple>
                                            <option value="" disabled selected>Choose Category</option>
                                            <option value="1">Hotels</option>
                                            <option value="2">Educations</option>
                                            <option value="3">Medical</option>
                                            <option value="3">Health</option>
                                            <option value="3">Fitness</option>
                                            <option value="3">Tution</option>
                                            <option value="3">Software</option>
                                            <option value="3">Wedding</option>
                                            <option value="3">Party</option>
                                            <option value="3">Spa/Club</option>
                                        </select>
                                        <label>Select Category</label>
                                    </div>
                                    <div class="input-field col s12">
                                        <select multiple>
                                            <option value="" disabled selected>Choose Category</option>
                                            <option value="1">Hotels</option>
                                            <option value="2">Educations</option>
                                            <option value="3">Medical</option>
                                            <option value="3">Health</option>
                                            <option value="3">Fitness</option>
                                            <option value="3">Tution</option>
                                            <option value="3">Software</option>
                                            <option value="3">Wedding</option>
                                            <option value="3">Party</option>
                                            <option value="3">Spa/Club</option>
                                        </select>
                                        <label>Select Sub Category</label>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="input-field col s12">
                                        <input type="submit" class="waves-effect waves-light btn-large" value="Submit">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--== BOTTOM FLOAT ICON ==-->
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

    <!--======== SCRIPT FILES =========-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/materialize.min.js"></script>
    <script src="js/custom.js"></script>
</body>


<!-- Mirrored from rn53themes.net/themes/demo/travelz/admin/offers-edit.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 13 Jan 2019 05:21:55 GMT -->
</html>