<section>
    <div class="footershadow">
        
    </div>
    <div class="rows tips tips-home tb-space home_title">
        <div class="container tips_1">

            <div class="col-md-4 col-sm-6 col-xs-12">
                <h3>Trip Before Travel</h3>
                <div class="tips_left tips_left_1">
                    <h5>Ready All Your Travel Stuff</h5>
                    <p>Before leave your home be carefull check your all stuff , what you need in your travel. </p>
                </div>
                <div class="tips_left tips_left_2">
                    <h5>Get Ready Your Proof</h5>
                    <p>Begins your journey with safety and proof.</p>
                </div>
                <div class="tips_left tips_left_3">
                    <h5>Clear Your Way</h5>
                    <p>Clear your way before start your journey.</p>
                </div>
            </div>

            <div class="col-md-8 col-sm-6 col-xs-12 testi-2">
                                <?php
                                    $cntpack=0;
                                    $reviewlavo=$con->query("select *,count(r.emailid) as fd from review r,package p where p.packageid=r.packageid group by r.emailid order by fd desc limit 1");
                                    $reviewaapo=  mysqli_fetch_array($reviewlavo);
                                    $lavo=$con->query("select * from register r,city c,state s,country cc where s.stateid=c.stateid and cc.countryid=s.countryid and c.cityid=r.cityid and emailid like '$reviewaapo[1]'");
                                    $dayo=mysqli_fetch_array($lavo);
                                ?>
                <h3>Valuable Reviews</h3>
                <div class="testi">
                    <div class="row">
                        <div class="col-md-2">
                            <img src="<?php echo $dayo[10]; ?>" style="border-radius:50%;width:100px;height:100px;" />
                        </div>
                        <div class="col-md-10">
                        <h4><?php echo $dayo[3]." ".$dayo[4]; ?></h4>
                        <p><?php echo substr($reviewaapo[3],0,150); ?></p> <address><?php echo $dayo[16]; ?> , <?php echo $dayo[18]; ?></address>     
                        </div>
                    </div>
                    
                </div>

                <h3>Why Choose Us ?</h3>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                                <div class="row footbannner">
                                    <div class="col-md-12 fafacolor">
                                        <div class="row">
                                            <div class="col-md-2"><span><i class="fa fa-handshake-o"></i></span></div>
                                            <div class="col-md-10"><span><font>Trust</font></span></div>
                                        </div>
                                    </div>
                                </div>
                                 <div class="row footbannner1">
                                    <div class="col-md-12 fafacolor1">
                                        <div class="row">
                                            <div class="col-md-2"><span><i class="fa fa-taxi"></i></span></div>
                                            <div class="col-md-10"><span><font>Taxi Services</font></span></div>
                                        </div>
                                    </div>  
                                </div>
                                          
                        </div>
                         <div class="col-md-6">
                                <div class="row footbannner2">
                                    <div class="col-md-12 fafacolor2">
                                        <div class="row">
                                            <div class="col-md-2"><span> <i class="fa fa-bed"></i></span></div>
                                            <div class="col-md-10 footerbanneryo">&nbsp;&nbsp;&nbsp;Arrangement &nbsp;&nbsp;&nbsp;Before You Reach</div>
                                            </div>
                                    </div>
                                </div>
                                 <div class="row footbannner3">
                                    <div class="col-md-12 fafacolor3">
                                        <div class="row">
                                            <div class="col-md-2"><span><i class="fa fa-smile-o"></i></span></div>
                                            <div class="col-md-10"><span><font>Customer Satisfaction</font></span></div>
                                        </div>
                                    </div>  
                                </div> 
                        </div>
                    </div> 
                </div>

            </div>
        </div>
    </div>
</section>
