<section>
    <div class="rows">
        <div class="footer1 home_title tb-space">
            <div class="pla1 container">
                <?php
                $packlavo=$con->query("select * from package p, offer o,packageplace pl,place pp,city c,state s,country cc where c.cityid=pp.cityid and s.stateid=c.stateid and cc.countryid=s.countryid and pp.placeid=pl.placeid and p.packageid=o.packageid and p.packageid=pl.packageid and o.fromdate<=curdate() and o.todate>=curdate() group by p.packageid limit 2");
                while($row= mysqli_fetch_array($packlavo))
                {
                ?>
                    <div class="col-md-3 col-sm-6 col-xs-12">
                        <div class="disco" style=" background: url('<?php echo $row[5]; ?>') no-repeat center center;height:200px;width:262px;background-size:cover;">
                            <h3><?php echo $row[13]."%"; ?><span> OFF</span></h3>
                            <h4><?php echo $row[28]; ?>,<?php echo $row[30]; ?></h4>
                            <p>valid only for <?php echo $row[12]; ?></p> <a href="packagedetails.php?packageid=<?php echo $row[0]; ?>">Book Now</a> 
                        </div>
                    </div>
                <?php    
                }
                ?>

                <div class="col-md-6 col-sm-12 col-xs-12 foot-spec footer_places">
                    <h4><span>Most Popular</span> Packages</h4>
                    <ul>
                        <?php
                        $data=$con->query("select * from review r,package p where p.packageid=r.packageid Having count(*)>1 limit 20");
                        while($row= mysqli_fetch_array($data))
                        {
                        ?>
                        <li><a href="packagedetails.php?packageid=<?php echo $row[0]; ?>"><?php echo $row[6]; ?></a> </li>
                        <?php    
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="rows">
        <div class="footer">
            <div class="container">
                <div class="foot-sec2">
                    <div>
                        <div class="row">
                            <div class="col-sm-3 foot-spec foot-com">
                                <h4><span>About us</span></h4>
                                <p class="footercolor">We specialize in tours to India but are always expanding and enhancing our
                                   wide range of offers, as well as adding new and exciting tours of America, Italy, 
                                   Eastern Europe, Mexico and the Caribbean. <a href="about-us.php">READ MORE</a></p>
                            </div>
                            <div class="col-sm-3 foot-spec foot-com mail">
                                <h4><span>Address</span> & Contact Info</h4>
                                <p><?php echo $datasiteprofile[4]; ?></p>
                                <p class="phoneyo"> <span class="strong">Toll Free No : </span>1800-3002-8411</p>
                                <p><span class="strong">Email : </span><a href="mailto:<?php echo $datasiteprofile[3]; ?>">thejourney9999@gmail.com</a></p>
                                <p class="phoneyo"><span class="strong">Fax : </span><?php echo $datasiteprofile[2]; ?></p>
                            </div>
                            <div class="col-sm-3 col-md-3 foot-spec foot-com">
                                <h4><span>SUPPORT</span> & HELP</h4>
                                <ul class="two-columns">
                                    <li> <a href="about-us.php">About Us</a> </li>
                                    <li> <a href="terms-conditions.php#privacy policy">Privacy Policy</a> </li>
                                    <li> <a href="terms-conditions.php">Terms & Condition</a> </li>
                                    <li> <a href="contact-us.php">Contact us</a> </li>
                                    <li> <a href="packagelist.php">Package</a> </li>
                                    <li> <a href="hotellist.php">Hotels</a> </li>
                                </ul>
                            </div>
                            <div class="col-sm-3 foot-social foot-spec foot-com">
                                <h4><span>Follow</span> with us</h4>
                                <div>
                                  <iframe src="https://www.facebook.com/plugins/page.php?href=https%3A%2F%2Fwww.facebook.com%2FThe-Journey-485202905343374%2F%3Fmodal%3Dadmin_todo_tour&tabs=timeline&width=260px&height=237px&small_header=false&adapt_container_width=true&hide_cover=false&show_facepile=true&appId" 
                                          width="260px" height="237px" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowTransparency="true" allow="encrypted-media"></iframe>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
