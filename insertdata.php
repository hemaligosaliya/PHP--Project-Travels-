
<?php

//mail file

require_once './PHPMailerAutoload.php';

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
        $mail->AltBody = 'thejourney';

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

//fileupload
if (isset($_REQUEST[upload])) 
{
    $ex = "." . substr($_FILES[photo][type], 6);
    if ($ex == ".jpg" || $ex == ".jpeg") 
        {
        $size = $_FILES[photo][size] / 1024 / 1024;
        if ($size <=5) 
            {
            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
            $path = "upload/" . $name;
            $path1 = dirname(__FILE__) . "/" . $path;
            move_uploaded_file($_FILES[photo][tmp_name], $path1);
            $in = $con->query("insert into product values(0,'$_REQUEST[photoname]','$path')");
            $test = 1;
        } 
        else 
        {
            $err = 1;
        }
    } 
    else 
    {
        $er = 1;
    }
}


//Register(insert)

if (isset($_REQUEST[sendregister])) 
{
    $ex = "." . substr($_FILES[photo][type], 6);
    
    if ($ex == ".jpg" || $ex == ".jpeg") 
    {
        $size = $_FILES[photo][size] / 1024 / 1024;
        if ($size <= 5) 
        {
            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
            $path = "upload/" . $name;
            $path1 = dirname(__FILE__) . "/" . $path;
            move_uploaded_file($_FILES[photo][tmp_name], $path1);
            
            $dupcheck=$con->query("select * from register where emailid like '$_REQUEST[emailid]'");
            $duprec=  mysqli_fetch_array($dupcheck);
            if($duprec[0]=="")
            {
                 $registrationin=$con->query("insert into register values($_REQUEST[countryid],$_REQUEST[stateid],$_REQUEST[cityid],'$_REQUEST[fname]','$_REQUEST[lname]','$_REQUEST[emailid]','$_REQUEST[contact]','$_REQUEST[gender]','$_REQUEST[password]',1,'$path')");
                 header("location:welcome.php");
                 $profile=$con->query("select * from siteprofile where category=2");
                $profilerow=  mysqli_fetch_array($profile);
                sendmail("$_REQUEST[emailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                <br/>
                <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[emailid]</span></strong></p>
                <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[password]</span></strong></p>
                <br/>
                <hr/>
                <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                </p>
                <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");
                 
            }
            else
            {
               $dup=1;
            }
            
        } 
        else 
        {
            $err = 1;
        }
    } 
    else 
    {
        $er = 1;
    }
}




if (isset($_REQUEST[upregister])) 
{
    if($_FILES[upphoto][size]=="")
    {       
            if($_SESSION[user]!=$_REQUEST[upemailid] && $_SESSION[password]!=$_REQUEST[uppassword])
            {
                $data=$con->query("select * from register where emailid like '$_REQUEST[upemailid]'");
                $row=mysqli_num_rows($data);
                if($row==0)
                {
                            $in=$con->query("update register set emailid='$_REQUEST[upemailid]',countryid=$_REQUEST[upcountryid],stateid=$_REQUEST[upstateid],cityid=$_REQUEST[upcityid],fname='$_REQUEST[upfname]',lname='$_REQUEST[uplname]',contact='$_REQUEST[upcontact]',gender='$_REQUEST[upgender]',password='$_REQUEST[uppassword]' where emailid like '$_SESSION[user]'");
                            if($_SESSION[user]!=$_REQUEST[upemailid] || $_SESSION[password]!=$_REQUEST[uppassword])
                                    {
                                        header('location:../logout.php');
                                        $profile=$con->query("select * from siteprofile where category=2");
                                        $profilerow=  mysqli_fetch_array($profile);
                                        sendmail("$_REQUEST[upemailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                                        <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                                        <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                                        <br/>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[upemailid]</span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[uppassword]</span></strong></p>
                                        <br/>
                                        <hr/>
                                        <p><h2 style='color:#2A3C54;'>Your <span style='color:#FF0049;'>Email</span> or <span style='color:#FF0049;'>password</span> is change</h2></p>
                                        <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                                        <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                                        </p>
                                        <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");               
                                    }
                            
                }
                else 
                {
                    $_SESSION[dup]=1;
                }
            }
            elseif($_SESSION[user]!=$_REQUEST[upemailid])
            {
                    $data=$con->query("select * from register where emailid like '$_REQUEST[upemailid]'");
                    $row=mysqli_num_rows($data);
                    if($row==0)
                    {
                                $in=$con->query("update register set emailid='$_REQUEST[upemailid]',countryid=$_REQUEST[upcountryid],stateid=$_REQUEST[upstateid],cityid=$_REQUEST[upcityid],fname='$_REQUEST[upfname]',lname='$_REQUEST[uplname]',contact='$_REQUEST[upcontact]',gender='$_REQUEST[upgender]',password='$_REQUEST[uppassword]' where emailid like '$_SESSION[user]'");
                                     if($_SESSION[user]!=$_REQUEST[upemailid] || $_SESSION[password]!=$_REQUEST[uppassword])
                                    {
                                        header('location:../logout.php');
                                        $profile=$con->query("select * from siteprofile where category=2");
                                        $profilerow=  mysqli_fetch_array($profile);
                                        sendmail("$_REQUEST[upemailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                                        <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                                        <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                                        <br/>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[upemailid]</span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[uppassword]</span></strong></p>
                                        <br/>
                                        <hr/>
                                        <p><h2 style='color:#2A3C54;'>Your <span style='color:#FF0049;'>Email</span> or <span style='color:#FF0049;'>password</span> is change</h2></p>
                                        <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                                        <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                                        </p>
                                        <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");               
                                    }
                    }
                    else 
                    {
                        $_SESSION[dup]=1;
                    }
            }
            elseif($_SESSION[password]!=$_REQUEST[uppassword])
            { 
                $in=$con->query("update register set countryid=$_REQUEST[upcountryid],stateid=$_REQUEST[upstateid],cityid=$_REQUEST[upcityid],fname='$_REQUEST[upfname]',lname='$_REQUEST[uplname]',contact='$_REQUEST[upcontact]',gender='$_REQUEST[upgender]',password='$_REQUEST[uppassword]' where emailid like '$_SESSION[user]'");
                                    if($_SESSION[user]!=$_REQUEST[upemailid] || $_SESSION[password]!=$_REQUEST[uppassword])
                                    {
                                        header('location:../logout.php');
                                        $profile=$con->query("select * from siteprofile where category=2");
                                        $profilerow=  mysqli_fetch_array($profile);
                                        sendmail("$_REQUEST[upemailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                                        <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                                        <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                                        <br/>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[upemailid]</span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[uppassword]</span></strong></p>
                                        <br/>
                                        <hr/>
                                        <p><h2 style='color:#2A3C54;'>Your <span style='color:#FF0049;'>Email</span> or <span style='color:#FF0049;'>password</span> is change</h2></p>
                                        <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                                        <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                                        </p>
                                        <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");               
                                    }
            }
            else 
            { 
                $in=$con->query("update register set countryid=$_REQUEST[upcountryid],stateid=$_REQUEST[upstateid],cityid=$_REQUEST[upcityid],fname='$_REQUEST[upfname]',lname='$_REQUEST[uplname]',contact='$_REQUEST[upcontact]',gender='$_REQUEST[upgender]' where emailid like '$_SESSION[user]'");
            }
                
    }
    else
    {
        
        if($_SESSION[user]!=$_REQUEST[upemailid] && $_SESSION[password]!=$_REQUEST[uppassword])
        {
            $ex = "." . substr($_FILES[upphoto][type], 6);
            if ($ex == ".jpg" || $ex == ".jpeg") {
                $size = $_FILES[upphoto][size] / 1024 / 1024;
                if ($size <= 5) {
                    $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                    $path = "upload/" . $name;
                    $path1 = dirname(__FILE__) . "/" . $path;

                    $data = $con->query("select * from register where emailid like '$_REQUEST[upemailid]'");
                    $row = mysqli_num_rows($data);

                    if ($row == 0) {
                        $in = $con->query("update register set emailid='$_REQUEST[upemailid]',countryid=$_REQUEST[upcountryid],stateid=$_REQUEST[upstateid],cityid=$_REQUEST[upcityid],fname='$_REQUEST[upfname]',lname='$_REQUEST[uplname]',contact='$_REQUEST[upcontact]',gender='$_REQUEST[upgender]',password='$_REQUEST[uppassword]',photo='$path' where emailid like '$_SESSION[user]'");
                        move_uploaded_file($_FILES[upphoto][tmp_name], $path1);
                                    if($_SESSION[user]!=$_REQUEST[upemailid] || $_SESSION[password]!=$_REQUEST[uppassword])
                                    {
                                        header('location:../logout.php');
                                        $profile=$con->query("select * from siteprofile where category=2");
                                        $profilerow=  mysqli_fetch_array($profile);
                                        sendmail("$_REQUEST[upemailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                                        <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                                        <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                                        <br/>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[upemailid]</span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[uppassword]</span></strong></p>
                                        <br/>
                                        <hr/>
                                        <p><h2 style='color:#2A3C54;'>Your <span style='color:#FF0049;'>Email</span> or <span style='color:#FF0049;'>password</span> is change</h2></p>
                                        <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                                        <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                                        </p>
                                        <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");               
                                    }
                    } else {
                        $_SESSION[dup] = 1;
                    }
                } else {
                    $_SESSION[err] = 1;
                }
            } else {
                $_SESSION[er] = 1;
            }
        }
        elseif ($_SESSION[user]!=$_REQUEST[upemailid]) 
        {
                $ex = "." . substr($_FILES[upphoto][type], 6);
            if ($ex == ".jpg" || $ex == ".jpeg") {
                $size = $_FILES[upphoto][size] / 1024 / 1024;
                if ($size <= 5) {
                    $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                    $path = "upload/" . $name;
                    $path1 = dirname(__FILE__) . "/" . $path;

                    $data = $con->query("select * from register where emailid like '$_REQUEST[upemailid]'");
                    $row = mysqli_num_rows($data);

                    if ($row == 0) {
                        $in = $con->query("update register set emailid='$_REQUEST[upemailid]',countryid=$_REQUEST[upcountryid],stateid=$_REQUEST[upstateid],cityid=$_REQUEST[upcityid],fname='$_REQUEST[upfname]',lname='$_REQUEST[uplname]',contact='$_REQUEST[upcontact]',gender='$_REQUEST[upgender]',photo='$path' where emailid like '$_SESSION[user]'");
                        move_uploaded_file($_FILES[upphoto][tmp_name], $path1);
                                    if($_SESSION[user]!=$_REQUEST[upemailid] || $_SESSION[password]!=$_REQUEST[uppassword])
                                    {
                                        header('location:../logout.php');
                                        $profile=$con->query("select * from siteprofile where category=2");
                                        $profilerow=  mysqli_fetch_array($profile);
                                        sendmail("$_REQUEST[upemailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                                        <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                                        <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                                        <br/>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[upemailid]</span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[uppassword]</span></strong></p>
                                        <br/>
                                        <hr/>
                                        <p><h2 style='color:#2A3C54;'>Your <span style='color:#FF0049;'>Email</span> or <span style='color:#FF0049;'>password</span> is change</h2></p>
                                        <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                                        <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                                        </p>
                                        <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");               
                                    }
                    } else {
                        $_SESSION[dup] = 1;
                    }
                } else {
                    $_SESSION[err] = 1;
                }
            } else {
                $_SESSION[er] = 1;
            }
        }
        elseif ($_SESSION[password]!=$_REQUEST[uppassword])
        {
            $ex = "." . substr($_FILES[upphoto][type], 6);
            if ($ex == ".jpg" || $ex == ".jpeg") 
                {
                $size = $_FILES[upphoto][size] / 1024 / 1024;
                if ($size <= 5) 
                    {
                    $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                    $path = "upload/" . $name;
                    $path1 = dirname(__FILE__) . "/" . $path;
                    $in = $con->query("update register set countryid=$_REQUEST[upcountryid],stateid=$_REQUEST[upstateid],cityid=$_REQUEST[upcityid],fname='$_REQUEST[upfname]',lname='$_REQUEST[uplname]',contact='$_REQUEST[upcontact]',gender='$_REQUEST[upgender]',password='$_REQUEST[uppassword]',photo='$path' where emailid like '$_SESSION[user]'");
                    move_uploaded_file($_FILES[upphoto][tmp_name], $path1);
                                    if($_SESSION[user]!=$_REQUEST[upemailid] || $_SESSION[password]!=$_REQUEST[uppassword])
                                    {
                                        header('location:../logout.php');
                                        $profile=$con->query("select * from siteprofile where category=2");
                                        $profilerow=  mysqli_fetch_array($profile);
                                        sendmail("$_REQUEST[upemailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                                        <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                                        <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                                        <br/>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[upemailid]</span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[uppassword]</span></strong></p>
                                        <br/>
                                        <hr/>
                                        <p><h2 style='color:#2A3C54;'>Your <span style='color:#FF0049;'>Email</span> or <span style='color:#FF0049;'>password</span> is change</h2></p>
                                        <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                                        <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                                        </p>
                                        <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");               
                                    }
                } else {
                    $_SESSION[err] = 1;
                }
            } else {
                $_SESSION[er] = 1;
            }
        }
        else
        {
                
                $ex = "." . substr($_FILES[upphoto][type], 6);
                if ($ex == ".jpg" || $ex == ".jpeg")
                {
                    $size = $_FILES[upphoto][size] / 1024 / 1024;
                    if ($size <= 5) 
                    {
                        $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                        $path = "upload/" . $name;
                        $path1 = dirname(__FILE__) . "/" . $path;
                        $in=$con->query("update register set countryid=$_REQUEST[upcountryid],stateid=$_REQUEST[upstateid],cityid=$_REQUEST[upcityid],fname='$_REQUEST[upfname]',lname='$_REQUEST[uplname]',contact='$_REQUEST[upcontact]',gender='$_REQUEST[upgender]',photo='$path' where emailid like '$_SESSION[user]'");
                        move_uploaded_file($_FILES[upphoto][tmp_name], $path1);
                    } 
                    else 
                    {
                        $_SESSION[err]=1;
                    }
                } 
                else 
                {
                    $_SESSION[er]=1;
                }
            
        }
          
    }
     
}

    //Login

    if(isset($_REQUEST[loginadmin]))
    {
        $user=$con->real_escape_string($_REQUEST[emailid]);
        $password=$con->real_escape_string($_REQUEST[password]);
        $check=$con->query("select * from register where emailid like '$user' and password like '$password' and type=0");
        $data=mysqli_fetch_array($check);
        if($data[0]=="")
        {
            $logineradmin=1;
        }
        else
        {
           $_SESSION[user]=$data[5];
           $_SESSION[password]=$data[8];
           $_SESSION[dt]=date('Y-m-d h:i:s');
           $_SESSION[type]=$data[9];
           
           $check1=$con->query("select * from loginhistory where emailid like '$_SESSION[user]'");
           $data1=mysqli_fetch_array($check1);
        
            if($data1[0]=="")
            {
                $in=$con->query("insert into loginhistory values('$_SESSION[user]','$_SESSION[password]','$_SESSION[dt]')");
            }
            if($_SESSION[type]==0)
            {
               header('location:../admin/adminmaster.php');
               $_SESSION[shu]='custompackagebill';
            }
        }
    }

    if(isset($_REQUEST[safelogin]))
    {
        $user=$con->real_escape_string($_REQUEST[emailid]);
        $password=$con->real_escape_string($_REQUEST[password]);
        
        $check=$con->query("select * from register where emailid like '$user' and password like '$password' and type=1");
        $data=mysqli_fetch_array($check);
        
        
        if($data[0]=="")
        {
            $check1=$con->query("select * from hotel where emailid like '$user' and password like '$password'");
            $data1=mysqli_fetch_array($check1);
        }
        else
        {
           $_SESSION[user]=$data[5];
           $_SESSION[password]=$data[8];
           $_SESSION[dt]=date('Y-m-d h:i:s');
           $_SESSION[type]=$data[9];
           
           $check=$con->query("select * from loginhistory where emailid like '$_SESSION[user]'");
           $data=mysqli_fetch_array($check);
        
            if($data[0]=="")
            {
                $in=$con->query("insert into loginhistory values('$_SESSION[user]','$_SESSION[password]','$_SESSION[dt]')");
            }
            
            if(isset($_REQUEST[rem]))
            {
                setcookie("user",$_SESSION[user],time()+60*60*24*30,"/");
                setcookie("password",$_SESSION[password],time()+60*60*24*30,"/");
            }
            else 
            {
                setcookie("user",$_SESSION[user],time()-1,"/");
                setcookie("password",$_SESSION[password],time()-1,"/");   
            }
            
            if($_SESSION[type]==0)
            {
               header('location:./admin/adminmaster.php');
               $_SESSION[shu]='country';
            }
            else
            {
                header('location:customermaster.php');
            }
        }
        
        if($data1[0]=="")
        {
            $check2=$con->query("select * from taxicompany where emailid like '$user' and password like '$password'");
            $data2=mysqli_fetch_array($check2);
        }
        else
        {
           $_SESSION[user]=$data1[15];
           $_SESSION[hotelid]=$data1[1];
           $_SESSION[password]=$data1[14];
           $_SESSION[type]=2;
           if(isset($_REQUEST[rem]))
            {
                setcookie("user",$_SESSION[user],time()+60*60*24*30,"/");
                setcookie("password",$_SESSION[password],time()+60*60*24*30,"/");
            }
            else 
            {
                setcookie("user",$_SESSION[user],time()-1,"/");
                setcookie("password",$_SESSION[password],time()-1,"/");   
            }
            header('location:./admin/hotelmaster.php');
        }
        if($data2[0]=="")
        {
            $loginer=1;
        }
        else
        {
            $_SESSION[user]=$data2[8];
            $_SESSION[taxicompanyid]=$data2[1];
            $_SESSION[password]=$data2[9];
            $_SESSION[type]=3;
            if(isset($_REQUEST[rem]))
            {
                setcookie("user",$_SESSION[user],time()+60*60*24*30,"/");
                setcookie("password",$_SESSION[password],time()+60*60*24*30,"/");
            }
            else 
            {
                setcookie("user",$_SESSION[user],time()-1,"/");
                setcookie("password",$_SESSION[password],time()-1,"/");   
            }
            header('location:./admin/taxicompanymaster.php');
        }
    }
    
       

    
    // Country(insert,update)

if (isset($_REQUEST[sendcountry])) 
{
    $data=$con->query("select * from country where name like '$_REQUEST[name]'");
    $row=  mysqli_fetch_array($data);
    if($row[0]=="")
    {
        $in=$con->query("insert into country values(0,'$_REQUEST[name]')");
    }
    else 
    {
        $_SESSION[dup]=1;
    }
}

if (isset($_REQUEST[upcountry])) 
{
    $data=$con->query("select * from country where name like '$_REQUEST[upname]'");
    $row=  mysqli_fetch_array($data);
    if($row[0]=="")
    {
         $in=$con->query("update country set name='$_REQUEST[upname]' where countryid=$_SESSION[upid]");
    }
    else 
    {
        $_SESSION[dup]=1;
    }
   
}


    //State(insert,delete)

if (isset($_REQUEST[sendstate])) 
{
    $data=$con->query("select * from state where name like '$_REQUEST[name]' and countryid=$_REQUEST[countryid]");
    $row=mysqli_fetch_array($data);
    
    if($row[0]=="")
    {
        $in=$con->query("insert into state values($_REQUEST[countryid],0,'$_REQUEST[name]')");
        
    }
    else 
    {
        $_SESSION[dup]=1;
    }
}


if (isset($_REQUEST[upstate])) 
{
    $data=$con->query("select * from state where name like '$_REQUEST[upname]' and countryid=$_SESSION[checkpotaniid]");
    $row=  mysqli_fetch_array($data);
    if($row[0]=="")
    {
         $in=$con->query("update state set name='$_REQUEST[upname]' where stateid=$_SESSION[upid]");
    }
    else 
    {
        $_SESSION[dup]=1;
    }
   
}


    //city(insert,delete)

if (isset($_REQUEST[sendcity])) 
{
    $data=$con->query("select * from city where name like '$_REQUEST[name]' and stateid=$_REQUEST[stateid]");
    $row=mysqli_fetch_array($data);
    if($row[0]=="")
    {
        $in=$con->query("insert into city values($_REQUEST[stateid],0,'$_REQUEST[name]')");
        
    }
    else 
    {
        $_SESSION[dup]=1;
    }
}


if (isset($_REQUEST[upcity])) 
{
    $data=$con->query("select * from city where name like '$_REQUEST[upname]' and stateid=$_SESSION[checkpotaniid]");
    $row=  mysqli_fetch_array($data);
    if($row[0]=="")
    {
         $in=$con->query("update city set name='$_REQUEST[upname]' where cityid=$_SESSION[upid]");
    }
    else 
    {
        $_SESSION[dup]=1;
    }
   
}



//place(insert,delete)

if (isset($_REQUEST[sendplace])) 
{
   
    $ex = "." . substr($_FILES[photo][type], 6);
    if ($ex == ".jpg" || $ex == ".jpeg") 
        {
        $size = $_FILES[photo][size] / 1024 / 1024;
        if ($size <= 5) 
            {
            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
            $path = "upload/" . $name;
            $path1 = dirname(__FILE__) . "/" . $path;
            
            $data=$con->query("select * from place where placename like '$_REQUEST[placename]' and cityid=$_REQUEST[cityid]");
            $row=mysqli_fetch_array($data);
            if($row[0]=="")
            {
                $in=$con->query("insert into place values($_REQUEST[cityid],0,'$_REQUEST[placename]','$_REQUEST[briefhistory]','$path')");
                move_uploaded_file($_FILES[photo][tmp_name], $path1);
            }
            else 
            {
                $_SESSION[dup]=1;
            }
            

        } 
        else 
        {
            $_SESSION[err]=1;
        }
    } 
    else 
    {
        $_SESSION[er]=1;
    }  
}


if (isset($_REQUEST[upplace])) 
{
   
            if($_FILES[upphoto][size]=="")
            {
                        if($_REQUEST[upplacename]!=$_SESSION[checkpotaniid1])
                        {

                              $data=$con->query("select * from place where placename like '$_REQUEST[upplacename]' and cityid=$_SESSION[checkpotaniid]");
                              $row= mysqli_fetch_array($data);
                              if($row[0]=="")
                              {
                                  $in=$con->query("update place set placename='$_REQUEST[upplacename]',briefhistory='$_REQUEST[upbriefhistory]' where placeid=$_SESSION[upid]");
                              }
                              else 
                              {
                                  $_SESSION[dup]=1;
                              }

                        }
                        else
                        {
                               $in=$con->query("update place set briefhistory='$_REQUEST[upbriefhistory]' where placeid=$_SESSION[upid]");   
                        }
            }
            else
            {
                        if($_REQUEST[upplacename]!=$_SESSION[checkpotaniid1])
                        {
                                 $ex = "." . substr($_FILES[upphoto][type], 6);
                                 if ($ex == ".jpg" || $ex == ".jpeg") 
                                     {
                                     $size = $_FILES[upphoto][size] / 1024 / 1024;
                                     if ($size <= 5) 
                                         {
                                         $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                                         $path = "upload/" . $name;
                                         $path1 = dirname(__FILE__) . "/" . $path;

                                         $data=$con->query("select * from place where placename like '$_REQUEST[upplacename]' and cityid=$_SESSION[checkpotaniid]");
                                         $row= mysqli_fetch_array($data);
                                         $unlinkmate=$con->query("select * from place where placeid=$_SESSION[upid]");
                                         $dataunlinkmate= mysqli_fetch_array($unlinkmate);

                                         if($row[0]=="")
                                         {   
                                             unlink("../".$dataunlinkmate[4]);
                                             $in=$con->query("update place set placename='$_REQUEST[upplacename]',briefhistory='$_REQUEST[upbriefhistory]',photo='$path' where placeid=$_SESSION[upid]");
                                             move_uploaded_file($_FILES[upphoto][tmp_name], $path1);
                                         }
                                         else 
                                         {
                                             $_SESSION[dup]=1;
                                         }

                                     } 
                                     else 
                                     {
                                         $_SESSION[err]=1;
                                     }
                                 } 
                                 else 
                                 {
                                     $_SESSION[er]=1;
                                 }      
                        }
                        else
                        {
                              $ex = "." . substr($_FILES[upphoto][type], 6);
                                 if ($ex == ".jpg" || $ex == ".jpeg") 
                                     {
                                     $size = $_FILES[upphoto][size] / 1024 / 1024;
                                     if ($size <= 5) 
                                     {
                                         $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                                         $path = "upload/" . $name;
                                         $path1 = dirname(__FILE__) . "/" . $path;
                                         
                                             $unlinkmate=$con->query("select * from place where placeid=$_SESSION[upid]");
                                             $dataunlinkmate= mysqli_fetch_array($unlinkmate);
                                             unlink("../".$dataunlinkmate[4]);
                                             $in=$con->query("update place set placename='$_REQUEST[upplacename]',briefhistory='$_REQUEST[upbriefhistory]',photo='$path' where placeid=$_SESSION[upid]");
                                             move_uploaded_file($_FILES[upphoto][tmp_name], $path1);
                                     } 
                                     else 
                                     {
                                         $_SESSION[err]=1;
                                     }
                                 } 
                                 else 
                                 {
                                     $_SESSION[er]=1;
                                 }
                        }
            } 
}



//placepoint(insert,delete)

if (isset($_REQUEST[sendplacepoint])) 
{
   
    $ex = "." . substr($_FILES[photo][type], 6);
    if ($ex == ".jpg" || $ex == ".jpeg") 
        {
        $size = $_FILES[photo][size] / 1024 / 1024;
        if ($size <= 5) 
            {
            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
            $path = "upload/" . $name;
            $path1 = dirname(__FILE__) . "/" . $path;
            move_uploaded_file($_FILES[photo][tmp_name], $path1);
            
            $data=$con->query("select * from placepoint where name like '$_REQUEST[name]' and placeid=$_REQUEST[placeid]");
            $row=mysqli_fetch_array($data);
            if($row[0]=="")
            {
                $in=$con->query("insert into placepoint values($_REQUEST[placeid],0,'$_REQUEST[name]','$_REQUEST[kmfromcenterpoint]','$_REQUEST[briefhistory]','$path')");

            }
            else 
            {
                $_SESSION[dup]=1;
            }
            

        } 
        else 
        {
            $_SESSION[err]=1;
        }
    } 
    else 
    {
        $_SESSION[er]=1;
    }  
}


if (isset($_REQUEST[upplacepoint])) 
{
    if($_FILES[upphoto][size]=="")
    {
        if($_SESSION[checkpotaniid1]!=$_REQUEST[upname])
        {
              $data=$con->query("select * from placepoint where name like '$_REQUEST[upname]' and placeid=$_SESSION[checkpotaniid]");
              $row=mysqli_fetch_array($data);
                if($row[0]=="")
                {
                    $in=$con->query("update placepoint set name='$_REQUEST[upname]',kmfromcenterpoint='$_REQUEST[upkmfromcenterpoint]',briefhistory='$_REQUEST[upbriefhistory]' where pointid=$_SESSION[upid]");

                }
                else 
                {
                    $_SESSION[dup]=1;
                }
        }
        else 
        {
                $in=$con->query("update placepoint set kmfromcenterpoint='$_REQUEST[upkmfromcenterpoint]',briefhistory='$_REQUEST[upbriefhistory]' where pointid=$_SESSION[upid]");
        }
    }
    else 
    {
        if($_SESSION[checkpotaniid1]!=$_REQUEST[upname])
           {
                $ex = "." . substr($_FILES[upphoto][type], 6);
                if ($ex == ".jpg" || $ex == ".jpeg") 
                    {
                    $size = $_FILES[upphoto][size] / 1024 / 1024;
                    if ($size <= 5) 
                        {
                        $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                        $path = "upload/" . $name;
                        $path1 = dirname(__FILE__) . "/" . $path;

                        $data=$con->query("select * from placepoint where name like '$_REQUEST[upname]' and placeid=$_SESSION[checkpotaniid]");
                        $row=mysqli_fetch_array($data);
                        if($row[0]=="")
                        {
                            $unlinkmate=$con->query("select * from placepoint where pointid=$_SESSION[upid]");
                            $dataunlinkmate=mysqli_fetch_array($unlinkmate);
                            unlink("../".$dataunlinkmate[5]);
                            $in=$con->query("update placepoint set name='$_REQUEST[upname]',kmfromcenterpoint='$_REQUEST[upkmfromcenterpoint]',briefhistory='$_REQUEST[upbriefhistory]',photo='$path' where pointid=$_SESSION[upid]");
                            move_uploaded_file($_FILES[upphoto][tmp_name], $path1);
                        }
                        else 
                        {
                            $_SESSION[dup]=1;
                        }

                    } 
                    else 
                    {
                        $_SESSION[err]=1;
                    }
                } 
                else 
                {
                    $_SESSION[er]=1;
                }
           }
           else 
           {
                $ex = "." . substr($_FILES[upphoto][type], 6);
                  if ($ex == ".jpg" || $ex == ".jpeg") 
                      {
                      $size = $_FILES[upphoto][size] / 1024 / 1024;
                      if ($size <= 5) 
                          {
                          $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                          $path = "upload/" . $name;
                          $path1 = dirname(__FILE__) . "/" . $path;
                          $unlinkmate=$con->query("select * from placepoint where pointid=$_SESSION[upid]");
                          $dataunlinkmate=mysqli_fetch_array($unlinkmate);
                          unlink("../".$dataunlinkmate[5]);
                          $in=$con->query("update placepoint set kmfromcenterpoint='$_REQUEST[upkmfromcenterpoint]',briefhistory='$_REQUEST[upbriefhistory]',photo='$path' where pointid=$_SESSION[upid]");
                          move_uploaded_file($_FILES[upphoto][tmp_name], $path1);
                      } 
                      else 
                      {
                          $_SESSION[err]=1;
                      }
                  } 
                  else 
                  {
                      $_SESSION[er]=1;
                  }
           }   
    }
 }
 
//package(insert,delete)

if (isset($_REQUEST[sendpackage])) 
{
   
    $ex = "." . substr($_FILES[photo][type], 6);
    
    $ex1= "." . substr($_FILES[aboutpdf][type],12);
    if ($ex == ".jpg" || $ex == ".jpeg" && $ex1== ".pdf")
        {
        $size = $_FILES[photo][size] / 1024 / 1024;
        $size1=$_FILES[aboutpdf][size] / 1024 / 1024;
        if ($size <= 5 && $size1 <= 12) 
            {
            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
            $path = "city/".$name;
            $path1 = dirname(__FILE__) . "/" . $path;
            
            $pdf = rand(100, 999) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex1;
            $pdfpath = "pdf/" . $pdf;
            $pdfpath1 = dirname(__FILE__) . "/" . $pdfpath;
            $data=$con->query("select * from package where name like '$_REQUEST[name]'");
            $row=mysqli_fetch_array($data);
            if($row[0]=="")
            {
                $in=$con->query("insert into package values(0,'$_REQUEST[name]',$_REQUEST[numberofday],$_REQUEST[numberofnight],$_REQUEST[amount],'$path','$pdfpath',$_REQUEST[status])");
                move_uploaded_file($_FILES[aboutpdf][tmp_name], $pdfpath1);
                move_uploaded_file($_FILES[photo][tmp_name], $path1);
            }
            else 
            {
                $_SESSION[dup]=1;
            }
            

        } 
        else 
        {
            $_SESSION[err]=1;
        }
    } 
    else 
    {
        $_SESSION[er]=1;
    }  
}

if (isset($_REQUEST[uppackage])) 
{
    if($_FILES[upphoto][size]=="" && $_FILES[upaboutpdf][size]=="")
    {
        if($_SESSION[checkpotaniid]!=$_REQUEST[upname])
        {
            $data=$con->query("select * from package where name like '$_REQUEST[upname]'");
            $row=mysqli_fetch_array($data);
            if($row[0]=="")
            {
               $in=$con->query("update package set name='$_REQUEST[upname]',numberofday=$_REQUEST[upnumberofday],numberofnight=$_REQUEST[upnumberofnight],amount=$_REQUEST[upamount],status=$_REQUEST[upstatus] where packageid=$_SESSION[upid]");
            }
            else 
            {
                $_SESSION[dup]=1;
            }
        }
        else 
        {
            $in=$con->query("update package set numberofday=$_REQUEST[upnumberofday],numberofnight=$_REQUEST[upnumberofnight],amount=$_REQUEST[upamount],status=$_REQUEST[upstatus] where packageid=$_SESSION[upid]");
        }
    }
    else 
    {
        if($_FILES[upphoto][size]!="" && $_FILES[upaboutpdf][size]!="")
        {
            if($_SESSION[checkpotaniid]!=$_REQUEST[upname])
            {
                $ex = "." . substr($_FILES[upphoto][type], 6);
                    $ex1= "." . substr($_FILES[upaboutpdf][type],12);
                    if ($ex == ".jpg" || $ex == ".jpeg" && $ex1== ".pdf")
                        {
                        $size = $_FILES[upphoto][size] / 1024 / 1024;
                        $size1=$_FILES[upaboutpdf][size] / 1024 / 1024;
                        if ($size <= 5 && $size1 <= 12) 
                            {
                            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                            $path = "city/".$name;
                            $path1 = dirname(__FILE__) . "/" . $path;

                            $pdf = rand(100, 999) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex1;
                            $pdfpath = "pdf/" . $pdf;
                            $pdfpath1 = dirname(__FILE__) . "/" . $pdfpath;

                            $data=$con->query("select * from package where name like '$_REQUEST[upname]'");
                            $row=mysqli_fetch_array($data);
                            if($row[0]=="")
                            {
                                $upunlink= $con->query("select * from package where packageid=$_SESSION[upid]");
                                $upunlinkdata=mysqli_fetch_array($upunlink);
                                unlink("../".$upunlinkdata[5]);
                                unlink("../".$upunlinkdata[6]);
                                $in=$con->query("update package set name='$_REQUEST[upname]',numberofday=$_REQUEST[upnumberofday],numberofnight=$_REQUEST[upnumberofnight],amount=$_REQUEST[upamount],photo='$path',aboutpdf='$pdfpath',status=$_REQUEST[upstatus] where packageid=$_SESSION[upid]");
                                move_uploaded_file($_FILES[upaboutpdf][tmp_name], $pdfpath1);
                                move_uploaded_file($_FILES[upphoto][tmp_name], $path1);
                            }
                            else 
                            {
                                $_SESSION[dup]=1;
                            }


                        } 
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }
            }
            else 
            {
                    $ex = "." . substr($_FILES[upphoto][type], 6);
                    $ex1= "." . substr($_FILES[upaboutpdf][type],12);
                    if ($ex == ".jpg" || $ex == ".jpeg" && $ex1== ".pdf")
                        {
                        $size = $_FILES[upphoto][size] / 1024 / 1024;
                        $size1=$_FILES[upaboutpdf][size] / 1024 / 1024;
                        if ($size <= 5 && $size1 <= 12) 
                            {
                            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                            $path = "city/".$name;
                            $path1 = dirname(__FILE__) . "/" . $path;

                            $pdf = rand(100, 999) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex1;
                            $pdfpath = "pdf/" . $pdf;
                            $pdfpath1 = dirname(__FILE__) . "/" . $pdfpath;
                                $upunlink= $con->query("select * from package where packageid=$_SESSION[upid]");
                                $upunlinkdata=mysqli_fetch_array($upunlink);
                                unlink("../".$upunlinkdata[5]);
                                unlink("../".$upunlinkdata[6]);
                                $in=$con->query("update package set name='$_REQUEST[upname]',numberofday=$_REQUEST[upnumberofday],numberofnight=$_REQUEST[upnumberofnight],amount=$_REQUEST[upamount],photo='$path',aboutpdf='$pdfpath',status=$_REQUEST[upstatus] where packageid=$_SESSION[upid]");
                                move_uploaded_file($_FILES[upaboutpdf][tmp_name], $pdfpath1);
                                move_uploaded_file($_FILES[upphoto][tmp_name], $path1);
                        } 
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }
            }
            
        }
        elseif($_FILES[upphoto][size]!="")
        {
            if($_SESSION[checkpotaniid]!=$_REQUEST[upname])
            {
                $ex = "." . substr($_FILES[upphoto][type], 6);
                    if ($ex == ".jpg" || $ex == ".jpeg")
                        {
                        $size = $_FILES[upphoto][size] / 1024 / 1024;
                        if ($size <= 5) 
                            {
                            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                            $path = "city/".$name;
                            $path1 = dirname(__FILE__) . "/" . $path;
                            $data=$con->query("select * from package where name like '$_REQUEST[upname]'");
                            $row=mysqli_fetch_array($data);
                            if($row[0]=="")
                            {
                                $upunlink= $con->query("select * from package where packageid=$_SESSION[upid]");
                                $upunlinkdata=mysqli_fetch_array($upunlink);
                                unlink("../".$upunlinkdata[5]);
                                $in=$con->query("update package set name='$_REQUEST[upname]',numberofday=$_REQUEST[upnumberofday],numberofnight=$_REQUEST[upnumberofnight],amount=$_REQUEST[upamount],photo='$path',status=$_REQUEST[upstatus] where packageid=$_SESSION[upid]");
                                move_uploaded_file($_FILES[upphoto][tmp_name], $path1);
                            }
                            else 
                            {
                                $_SESSION[dup]=1;
                            }

                        } 
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }

            }
            else 
            {
                    $ex = "." . substr($_FILES[upphoto][type], 6);
                    if ($ex == ".jpg" || $ex == ".jpeg")
                        {
                        $size = $_FILES[upphoto][size] / 1024 / 1024;
                        if ($size <= 5) 
                        {
                            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                            $path = "city/".$name;
                            $path1 = dirname(__FILE__) . "/" . $path;
                                $upunlink= $con->query("select * from package where packageid=$_SESSION[upid]");
                                $upunlinkdata=mysqli_fetch_array($upunlink);
                                unlink("../".$upunlinkdata[5]);
                                $in=$con->query("update package set name='$_REQUEST[upname]',numberofday=$_REQUEST[upnumberofday],numberofnight=$_REQUEST[upnumberofnight],amount=$_REQUEST[upamount],photo='$path',status=$_REQUEST[upstatus] where packageid=$_SESSION[upid]");
                                move_uploaded_file($_FILES[upphoto][tmp_name], $path1);
                        } 
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }
            }
            
        }
        elseif($_FILES[upaboutpdf][size]!="")
        {
            if($_SESSION[checkpotaniid]!=$_REQUEST[upname])
            {
                    $ex1= "." . substr($_FILES[upaboutpdf][type],12);
                    if ($ex1== ".pdf")
                        {
                        $size1=$_FILES[upaboutpdf][size] / 1024 / 1024;
                        if ($size1 <=12) 
                            {
                            $pdf = rand(100, 999) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex1;
                            $pdfpath = "pdf/" . $pdf;
                            $pdfpath1 = dirname(__FILE__) . "/" . $pdfpath;

                            $data=$con->query("select * from package where name like '$_REQUEST[upname]'");
                            $row=mysqli_fetch_array($data);
                            if($row[0]=="")
                            {
                                $upunlink= $con->query("select * from package where packageid=$_SESSION[upid]");
                                $upunlinkdata=mysqli_fetch_array($upunlink);
                                unlink("../".$upunlinkdata[6]);
                                $in=$con->query("update package set name='$_REQUEST[upname]',numberofday=$_REQUEST[upnumberofday],numberofnight=$_REQUEST[upnumberofnight],amount=$_REQUEST[upamount],aboutpdf='$pdfpath',status=$_REQUEST[upstatus] where packageid=$_SESSION[upid]");
                                move_uploaded_file($_FILES[upaboutpdf][tmp_name], $pdfpath1);
                            }
                            else 
                            {
                                $_SESSION[dup]=1;
                            }
                        } 
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }
            }
            else 
            {
                    $ex1= "." . substr($_FILES[upaboutpdf][type],12);
                    if ($ex1== ".pdf")
                        {
                        $size1=$_FILES[upaboutpdf][size] / 1024 / 1024;
                        if ($size1 <=12) 
                            {
                            $pdf = rand(100, 999) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex1;
                            $pdfpath = "pdf/" . $pdf;
                            $pdfpath1 = dirname(__FILE__) . "/" . $pdfpath;
                                $upunlink= $con->query("select * from package where packageid=$_SESSION[upid]");
                                $upunlinkdata=mysqli_fetch_array($upunlink);
                                unlink("../".$upunlinkdata[6]);
                                $in=$con->query("update package set name='$_REQUEST[upname]',numberofday=$_REQUEST[upnumberofday],numberofnight=$_REQUEST[upnumberofnight],amount=$_REQUEST[upamount],aboutpdf='$pdfpath',status=$_REQUEST[upstatus] where packageid=$_SESSION[upid]");
                                move_uploaded_file($_FILES[upaboutpdf][tmp_name], $pdfpath1);
                                move_uploaded_file($_FILES[upphoto][tmp_name], $path1);
        
                        } 
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }
            }
        }
    }
}

//Hotel(insert,delete)

if (isset($_REQUEST[sendhotel])) 
{
   
    $ex = "." . substr($_FILES[logo][type], 6);
    
    $ex1= "." . substr($_FILES[bannerphoto][type],6);
    if ($ex == ".jpg" || $ex == ".jpeg" && $ex1 == ".jpg" || $ex1 == ".jpeg")
        {
        $size = $_FILES[logo][size] / 1024 / 1024;
        $size1=$_FILES[bannerphoto][size] / 1024 / 1024;
        if ($size <= 5 && $size1 <= 5) 
            {
            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
            $path = "hotel/".$name;
            $path1 = dirname(__FILE__) . "/" . $path;
            
            $pdf = rand(100, 999) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex1;
            $pdfpath = "hotel/" . $pdf;
            $pdfpath1 = dirname(__FILE__) . "/" . $pdfpath;
      
            $data=$con->query("select * from hotel where name like '$_REQUEST[name]'");
            $row=mysqli_fetch_array($data);
            if($row[0]=="")
            {
                $pass=rand(0,99).chr(rand(65,90)).chr(rand(97,122)).rand(0,9).chr(rand(97,122));
                $in=$con->query("insert into hotel values($_REQUEST[placeid],0,'$_REQUEST[name]','$_REQUEST[address]','$_REQUEST[mobile]','$_REQUEST[map]','$_REQUEST[about]','$_REQUEST[star]','$_REQUEST[type]','$path','$pdfpath','$_REQUEST[gstno]','$_REQUEST[checkouttime]','$_REQUEST[checkintime]','$pass','$_REQUEST[emailid]')");
                move_uploaded_file($_FILES[bannerphoto][tmp_name], $pdfpath1);
                move_uploaded_file($_FILES[logo][tmp_name], $path1);
                $profile=$con->query("select * from siteprofile where category=2");
                $profilerow=  mysqli_fetch_array($profile);
                sendmail("$_REQUEST[emailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
<div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
<div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
<br/>
<p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[emailid]</span></strong></p>
<p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$pass</span></strong></p>
<br/>
<hr/>
<h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
<font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
</p>
<p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");
            }
            else 
            {
                $_SESSION[dup]=1;
            }
            

        } 
        else 
        {
            $_SESSION[err]=1;
        }
    } 
    else 
    {
        $_SESSION[er]=1;
    }  
}


if (isset($_REQUEST[uphotel])) 
{
    if($_FILES[uplogo][size]=="" && $_FILES[upbannerphoto][size]=="")
    {
        if($_SESSION[checkpotaniid1]!=$_REQUEST[upname])
        {
            $data=$con->query("select * from hotel where name like '$_REQUEST[upname]' and placeid=$_SESSION[checkpotaniid]");
            $row=mysqli_fetch_array($data);
            if($row[0]=="")
            {
               $in=$con->query("update hotel set name='$_REQUEST[upname]',address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',star='$_REQUEST[upstar]',type='$_REQUEST[uptype]',gstno='$_REQUEST[upgstno]',checkouttime='$_REQUEST[upcheckouttime]',checkintime='$_REQUEST[upcheckintime]' where hotelid=$_SESSION[upid]");
            }
            else 
            {
                $_SESSION[dup]=1;
            } 
        }
        else
        {
              $in=$con->query("update hotel set name='$_REQUEST[upname]',address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',star='$_REQUEST[upstar]',type='$_REQUEST[uptype]',gstno='$_REQUEST[upgstno]',checkouttime='$_REQUEST[upcheckouttime]',checkintime='$_REQUEST[upcheckintime]' where hotelid=$_SESSION[upid]");
        }
        
    }
    else
    {
        if($_FILES[uplogo][size]!="" && $_FILES[upbannerphoto][size]!="")
        {
            if($_SESSION[checkpotaniid1]!=$_REQUEST[upname])
            {
                    $ex = "." . substr($_FILES[uplogo][type], 6);
                    $ex1= "." . substr($_FILES[upbannerphoto][type],6);
                    if ($ex == ".jpg" || $ex == ".jpeg" && $ex1 == ".jpg" || $ex1 == ".jpeg")
                        {
                        $size = $_FILES[uplogo][size] / 1024 / 1024;
                        $size1=$_FILES[upbannerphoto][size] / 1024 / 1024;
                        if ($size <= 5 && $size1 <= 5) 
                            {
                            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                            $path = "hotel/".$name;
                            $path1 = dirname(__FILE__) . "/" . $path;

                            $pdf = rand(100, 999) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex1;
                            $pdfpath = "hotel/" . $pdf;
                            $pdfpath1 = dirname(__FILE__) . "/" . $pdfpath;


                            $data=$con->query("select * from hotel where name like '$_REQUEST[upname]' and placeid=$_SESSION[checkpotaniid]");
                            $row=mysqli_fetch_array($data);
                            if($row[0]=="")
                            {
                               $unlinkmate=$con->query("select * from hotel where hotelid=$_SESSION[upid]");
                               $dataunlinkmate=  mysqli_fetch_array($unlinkmate);
                               unlink("../".$dataunlinkmate[9]);
                               unlink("../".$dataunlinkmate[10]);
                               $in=$con->query("update hotel set name='$_REQUEST[upname]',address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',star='$_REQUEST[upstar]',type='$_REQUEST[uptype]',logo='$path',bannerphoto='$pdfpath',gstno='$_REQUEST[upgstno]',checkouttime='$_REQUEST[upcheckouttime]',checkintime='$_REQUEST[upcheckintime]' where hotelid=$_SESSION[upid]");
                                move_uploaded_file($_FILES[upbannerphoto][tmp_name], $pdfpath1);
                                move_uploaded_file($_FILES[uplogo][tmp_name], $path1);
                            }
                            else 
                            {
                                $_SESSION[dup]=1;
                            }


                        } 
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }
            }
            else
            {
                    $ex = "." . substr($_FILES[uplogo][type], 6);
                    $ex1= "." . substr($_FILES[upbannerphoto][type],6);
                    if ($ex == ".jpg" || $ex == ".jpeg" && $ex1 == ".jpg" || $ex1 == ".jpeg")
                    {
                        $size = $_FILES[uplogo][size] / 1024 / 1024;
                        $size1=$_FILES[upbannerphoto][size] / 1024 / 1024;
                        if ($size <= 5 && $size1 <= 5) 
                        {
                            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                            $path = "hotel/".$name;
                            $path1 = dirname(__FILE__) . "/" . $path;

                            $pdf = rand(100, 999) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex1;
                            $pdfpath = "hotel/" . $pdf;
                            $pdfpath1 = dirname(__FILE__) . "/" . $pdfpath;
                            $unlinkmate = $con->query("select * from hotel where hotelid=$_SESSION[upid]");
                            $dataunlinkmate = mysqli_fetch_array($unlinkmate);
                            unlink("../" . $dataunlinkmate[9]);
                            unlink("../" . $dataunlinkmate[10]);
                            $in = $con->query("update hotel set name='$_REQUEST[upname]',address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',star='$_REQUEST[upstar]',type='$_REQUEST[uptype]',logo='$path',bannerphoto='$pdfpath',gstno='$_REQUEST[upgstno]',checkouttime='$_REQUEST[upcheckouttime]',checkintime='$_REQUEST[upcheckintime]' where hotelid=$_SESSION[upid]");
                            move_uploaded_file($_FILES[upbannerphoto][tmp_name], $pdfpath1);
                            move_uploaded_file($_FILES[uplogo][tmp_name], $path1);
                        }    
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }
            }
            
        }
        elseif($_FILES[uplogo][size]!="")
        {
            if($_SESSION[checkpotaniid1]!=$_REQUEST[upname])
            {
                $ex = "." . substr($_FILES[uplogo][type], 6);
                    if ($ex == ".jpg" || $ex == ".jpeg")
                        {
                        $size = $_FILES[uplogo][size] / 1024 / 1024;
                        if ($size <= 5) 
                            {
                            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                            $path = "hotel/".$name;
                            $path1 = dirname(__FILE__) . "/" . $path;
                            $data=$con->query("select * from hotel where name like '$_REQUEST[upname]' and placeid=$_SESSION[checkpotaniid]");
                            $row=mysqli_fetch_array($data);
                            if($row[0]=="")
                            {
                               $unlinkmate=$con->query("select * from hotel where hotelid=$_SESSION[upid]");
                               $dataunlinkmate=  mysqli_fetch_array($unlinkmate);
                               unlink("../".$dataunlinkmate[9]);
                               $in=$con->query("update hotel set name='$_REQUEST[upname]',address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',star='$_REQUEST[upstar]',type='$_REQUEST[uptype]',logo='$path',gstno='$_REQUEST[upgstno]',checkouttime='$_REQUEST[upcheckouttime]',checkintime='$_REQUEST[upcheckintime]' where hotelid=$_SESSION[upid]");
                               move_uploaded_file($_FILES[uplogo][tmp_name], $path1);
                            }
                            else 
                            {
                                $_SESSION[dup]=1;
                            }


                        } 
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }
            }
            else
            {
                    $ex = "." . substr($_FILES[uplogo][type], 6);
                    if ($ex == ".jpg" || $ex == ".jpeg")
                        {
                        $size = $_FILES[uplogo][size] / 1024 / 1024;
                        if ($size <= 5) 
                            {
                            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                            $path = "hotel/".$name;
                            $path1 = dirname(__FILE__) . "/" . $path;
                               $unlinkmate=$con->query("select * from hotel where hotelid=$_SESSION[upid]");
                               $dataunlinkmate=  mysqli_fetch_array($unlinkmate);
                               unlink("../".$dataunlinkmate[9]);
                               $in=$con->query("update hotel set name='$_REQUEST[upname]',address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',star='$_REQUEST[upstar]',type='$_REQUEST[uptype]',logo='$path',gstno='$_REQUEST[upgstno]',checkouttime='$_REQUEST[upcheckouttime]',checkintime='$_REQUEST[upcheckintime]' where hotelid=$_SESSION[upid]");
                               move_uploaded_file($_FILES[uplogo][tmp_name], $path1);
                        } 
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }
            }
            
        }
        elseif($_FILES[upbannerphoto][size]!="")
        {
            if($_SESSION[checkpotaniid1]!=$_REQUEST[upname])
            {
                    $ex1= "." . substr($_FILES[upbannerphoto][type],6);
                    if ($ex1 == ".jpg" || $ex1 == ".jpeg")
                    {
                        $size1=$_FILES[upbannerphoto][size] / 1024 / 1024;
                        if ($size1 <= 5) 
                        {
                            $pdf = rand(100, 999) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex1;
                            $pdfpath = "hotel/" . $pdf;
                            $pdfpath1 = dirname(__FILE__) . "/" . $pdfpath;


                            $data=$con->query("select * from hotel where name like '$_REQUEST[upname]' and placeid=$_SESSION[checkpotaniid]");
                            $row=mysqli_fetch_array($data);
                            if($row[0]=="")
                            {
                               $unlinkmate=$con->query("select * from hotel where hotelid=$_SESSION[upid]");
                               $dataunlinkmate=  mysqli_fetch_array($unlinkmate);
                               unlink("../".$dataunlinkmate[10]);
                               $in=$con->query("update hotel set name='$_REQUEST[upname]',address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',star='$_REQUEST[upstar]',type='$_REQUEST[uptype]',bannerphoto='$pdfpath',gstno='$_REQUEST[upgstno]',checkouttime='$_REQUEST[upcheckouttime]',checkintime='$_REQUEST[upcheckintime]' where hotelid=$_SESSION[upid]");
                                move_uploaded_file($_FILES[upbannerphoto][tmp_name], $pdfpath1);
                            }
                            else 
                            {
                                $_SESSION[dup]=1;
                            }
                        } 
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }
            }
            else
            {
                        $ex1= "." . substr($_FILES[upbannerphoto][type],6);
                    if ($ex1 == ".jpg" || $ex1 == ".jpeg")
                    {
                        $size1=$_FILES[upbannerphoto][size] / 1024 / 1024;
                        if ($size1 <= 5) 
                        {
                            $pdf = rand(100, 999) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex1;
                            $pdfpath = "hotel/" . $pdf;
                            $pdfpath1 = dirname(__FILE__) . "/" . $pdfpath;
                            $unlinkmate=$con->query("select * from hotel where hotelid=$_SESSION[upid]");
                            $dataunlinkmate=  mysqli_fetch_array($unlinkmate);
                            unlink("../".$dataunlinkmate[10]);
                            $in=$con->query("update hotel set name='$_REQUEST[upname]',address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',star='$_REQUEST[upstar]',type='$_REQUEST[uptype]',bannerphoto='$pdfpath',gstno='$_REQUEST[upgstno]',checkouttime='$_REQUEST[upcheckouttime]',checkintime='$_REQUEST[upcheckintime]' where hotelid=$_SESSION[upid]");
                            move_uploaded_file($_FILES[upbannerphoto][tmp_name], $pdfpath1);
                        } 
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }
            }
            
        }
    }
 }
 
 
//terms & condition(insert,delete)

if (isset($_REQUEST[sendtc])) 
{
    $data=$con->query("select * from siteprofile where title like '$_REQUEST[title]' and category=$_REQUEST[category]");
    $row=mysqli_fetch_array($data);
    if($row[0]=="")
    {
        $in=$con->query("insert into siteprofile (tcid,category,title,firstmessage,secondmessage) values(0,$_REQUEST[category],'$_REQUEST[title]','$_REQUEST[firstmessage]','$_REQUEST[secondmessage]')");
    }
    else 
    {
        $_SESSION[dup]=1;
    }
}


if (isset($_REQUEST[uptc])) 
{
    if($_SESSION[checkpotaniid1]=$row[9]!=$_REQUEST[uptitle])
    {
        $data=$con->query("select * from siteprofile where title like '$_REQUEST[uptitle]' and category=$_SESSION[checkpotaniid]");
        $row=  mysqli_num_rows($data);
            if($row==1)
            {
                 $in=$con->query("update siteprofile set title='$_REQUEST[uptitle]',firstmessage='$_REQUEST[upfirstmessage]',secondmessage='$_REQUEST[upsecondmessage]' where tcid=$_SESSION[upid]");
            }
            else 
            {
                $_SESSION[dup]=1;
            }
    }
    else 
    {
        $in=$con->query("update siteprofile set firstmessage='$_REQUEST[upfirstmessage]',secondmessage='$_REQUEST[upsecondmessage]' where tcid=$_SESSION[upid]");
    }
}


//sendpackageplace(insert,update)

if(isset($_REQUEST[sendpackageplace]))
{
       if(empty($_REQUEST[pointid]))
       {
           $_SESSION[dup]=1;
       }
       else 
       {
           foreach ($_REQUEST[pointid] as $item)
            {
                $in=$con->query("insert into packageplace values($_SESSION[packageid],$_SESSION[placeid],$item,0)");
            }
       }
}

//update siteprofile

if(isset($_REQUEST[upsiteprofile]))
{
    $in=$con->query("update siteprofile set tollfree='$_REQUEST[uptollfree]',fax='$_REQUEST[upfax]',emailid='$_REQUEST[upemailid]',address='$_REQUEST[upaddress]',branchaddress='$_REQUEST[upbranchaddress]',branchmap='$_REQUEST[upbranchmap]',website='$_REQUEST[upwebsite]' where category=$_SESSION[upid]");
}


// schedule(insert,update)

if (isset($_REQUEST[sendschedule])) 
{
    $data=$con->query("select * from schedule where packageid=$_REQUEST[packageid]");
    $row=  mysqli_fetch_array($data);
    if($row[0]=="")
    {
        $in=$con->query("insert into schedule values($_REQUEST[packageid],0,'$_REQUEST[fromdate]','$_REQUEST[todate]','$_REQUEST[pickuppoint]','$_REQUEST[droppoint]','$_REQUEST[pickuptime]','$_REQUEST[goby]','$_REQUEST[returnby]')");
    }
    else 
    {
        $_SESSION[dup]=1;
    }
}

if (isset($_REQUEST[upschedule])) 
{
         $in=$con->query("update schedule set fromdate='$_REQUEST[upfromdate]',todate='$_REQUEST[uptodate]',pickuppoint='$_REQUEST[uppickuppoint]',droppoint='$_REQUEST[updroppoint]',pickuptime='$_REQUEST[uppickuptime]',goby='$_REQUEST[upgoby]',returnby='$_REQUEST[upreturnby]' where scheduleid=$_SESSION[upid]");
}

//taxicompany(insert,update)

if (isset($_REQUEST[sendtaxicompany])) 
{
    $data=$con->query("select * from taxicompany where name like '$_REQUEST[name]' and placeid=$_REQUEST[placeid]");
    $row=mysqli_fetch_array($data);
    if($row[0]=="")
    {
        $pass=chr(rand(65,90)).rand(0,99).chr(rand(65,90)).chr(rand(97,122)).rand(0,9).chr(rand(65,90)).rand(0,9);
        $in=$con->query("insert into taxicompany values($_REQUEST[placeid],0,'$_REQUEST[name]','$_REQUEST[address]','$_REQUEST[mobile]','$_REQUEST[map]','$_REQUEST[about]','$_REQUEST[gstno]','$_REQUEST[emailid]','$pass')");
         $profile=$con->query("select * from siteprofile where category=2");
                  $profilerow=  mysqli_fetch_array($profile);
                 sendmail("$_REQUEST[emailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                <br/>
                <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[emailid]</span></strong></p>
                <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$pass</span></strong></p>
                <br/>
                <hr/>
                <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                </p>
                <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");
    }
    else 
    {
        $_SESSION[dup]=1;
    }
}

if (isset($_REQUEST[uptaxicompany])) 
{
    if($_SESSION[checkpotaniid1]!=$_REQUEST[upname])
    {
        $data=$con->query("select * from taxicompany where name like '$_REQUEST[upname]' and placeid=$_SESSION[checkpotaniid]");
        $row= mysqli_fetch_array($data);
        if($row[0]=="")
        {
            $in=$con->query("update taxicompany set name='$_REQUEST[upname]',address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',gstno='$_REQUEST[upgstno]' where taxicompanyid=$_SESSION[upid]");
        }
        else 
        {
            $_SESSION[dup]=1;
        }
    }
    else
    {
        $in=$con->query("update taxicompany set address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',gstno='$_REQUEST[upgstno]' where taxicompanyid=$_SESSION[upid]");
    }
    
}


 // room(insert,update)

if (isset($_REQUEST[sendroom])) 
{
    $data=$con->query("select * from room where roomtype like '$_REQUEST[roomtype]'");
    $row=  mysqli_fetch_array($data);
    if($row[0]=="")
    {
        $in=$con->query("insert into room values(0,'$_REQUEST[roomtype]')");
    }
    else 
    {
        $_SESSION[dup]=1;
    }
}
if (isset($_REQUEST[uproom])) 
{
    $data=$con->query("select * from room where roomtype like '$_REQUEST[uproomtype]'");
    $row=  mysqli_fetch_array($data);
    if($row[0]=="")
    {
         $in=$con->query("update room set roomtype='$_REQUEST[uproomtype]' where roomid=$_SESSION[upid]");
    }
    else 
    {
        $_SESSION[dup]=1;
    }
   
}

 // food(insert,update)

if (isset($_REQUEST[sendfood])) 
{
    $data=$con->query("select * from food where foodtype like '$_REQUEST[foodtype]'");
    $row=  mysqli_fetch_array($data);
    if($row[0]=="")
    {
        $in=$con->query("insert into food values(0,'$_REQUEST[foodtype]')");
    }
    else 
    {
        $_SESSION[dup]=1;
    }
}
if (isset($_REQUEST[upfood])) 
{
    $data=$con->query("select * from food where foodtype like '$_REQUEST[upfoodtype]'");
    $row=  mysqli_fetch_array($data);
    if($row[0]=="")
    {
         $in=$con->query("update food set foodtype='$_REQUEST[upfoodtype]' where foodid=$_SESSION[upid]");
    }
    else 
    {
        $_SESSION[dup]=1;
    }
   
}


 // amenities(insert,update)

if (isset($_REQUEST[sendamenities])) 
{
    $data=$con->query("select * from amenities where amenitiestype like '$_REQUEST[amenitiestype]'");
    $row=  mysqli_fetch_array($data);
    if($row[0]=="")
    {
        $in=$con->query("insert into amenities values(0,'$_REQUEST[amenitiestype]')");
    }
    else 
    {
        $_SESSION[dup]=1;
    }
}
if (isset($_REQUEST[upamenities])) 
{
    $data=$con->query("select * from amenities where amenitiestype like '$_REQUEST[upamenitiestype]'");
    $row=  mysqli_fetch_array($data);
    if($row[0]=="")
    {
         $in=$con->query("update amenities set amenitiestype='$_REQUEST[upamenitiestype]' where amenitiesid=$_SESSION[upid]");
    }
    else 
    {
        $_SESSION[dup]=1;
    }
   
}


// vehicle(insert,update)

if (isset($_REQUEST[sendvehicle])) 
{
    $data=$con->query("select * from vehicle where vehicletype like '$_REQUEST[vehicletype]'");
    $row=  mysqli_fetch_array($data);
    if($row[0]=="")
    {
        $in=$con->query("insert into vehicle values(0,'$_REQUEST[vehicletype]')");
    }
    else 
    {
        $_SESSION[dup]=1;
    }
}

if (isset($_REQUEST[upvehicle])) 
{
    $data=$con->query("select * from vehicle where vehicletype like '$_REQUEST[upvehicletype]'");
    $row=  mysqli_fetch_array($data);
    if($row[0]=="")
    {
         $in=$con->query("update vehicle set vehicletype='$_REQUEST[upvehicletype]' where vehicleid=$_SESSION[upid]");
    }
    else 
    {
        $_SESSION[dup]=1;
    }
   
}

// assignroomtype(insert,update)

if (isset($_REQUEST[sendassignroomtype])) 
{
    $data=$con->query("select * from assignroomtype where hotelid=$_SESSION[hotelid] and roomid=$_REQUEST[roomid]");
    $row=  mysqli_fetch_array($data);
    if($row[0]=="")
    {
        $in=$con->query("insert into assignroomtype values($_SESSION[hotelid],$_REQUEST[roomid],0,'$_REQUEST[noofroom]',$_REQUEST[rateperday],'$_REQUEST[about]')");
    }
    else 
    {
        $_SESSION[dup]=1;
    }
}

if (isset($_REQUEST[upassignroomtype])) 
{
        
        $in=$con->query("update assignroomtype set noofroom='$_REQUEST[upnoofroom]',rateperday=$_REQUEST[uprateperday],about='$_REQUEST[upabout]' where assignroomtypeid=$_SESSION[upid]");
}

//assignfoodtype

if (isset($_REQUEST[sendassignfoodtype])) 
{
    $data=$con->query("select * from assignfoodtype where hotelid=$_SESSION[hotelid] and foodid=$_REQUEST[foodid]");
    $row=  mysqli_fetch_array($data);
    if($row[0]=="")
    {
        $in=$con->query("insert into assignfoodtype values($_SESSION[hotelid],$_REQUEST[foodid],0)");
    }
    else 
    {
        $_SESSION[dup]=1;
    }
}


//assignamenities

if(isset($_REQUEST[sendassignamenities]))
{
       if(empty($_REQUEST[assignamenitiesid]))
       {
           $_SESSION[dup]=1;
           echo $_SESSION[user];
       }
       else 
       {
           foreach ($_REQUEST[assignamenitiesid] as $item)
            {
               
                $in=$con->query("insert into assignamenities values($_SESSION[hotelid],$item,0)");
            }
       }
}


//vehiclename(insert,delete)

if (isset($_REQUEST[sendvehiclename])) 
{
   
    $ex = "." . substr($_FILES[aboutpdf][type], 12);
    if ($ex == ".pdf")
        {
        $size = $_FILES[photo][aboutpdf] / 1024 / 1024;
        if ($size <= 12) 
            {
            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
            $path = "vehicle/" . $name;
            $path1 = dirname(__FILE__) . "/" . $path;
            
            $data=$con->query("select * from vehiclename where name like '$_REQUEST[name]' and vehicleid=$_REQUEST[vehicleid]");
            $row=mysqli_fetch_array($data);
            if($row[0]=="")
            {
                $in=$con->query("insert into vehiclename values($_REQUEST[vehicleid],0,'$_REQUEST[name]','$_REQUEST[seating]','$path')");
                move_uploaded_file($_FILES[aboutpdf][tmp_name], $path1);
            }
            else 
            {
                $_SESSION[dup]=1;
            }
        } 
        else 
        {
            $_SESSION[err]=1;
        }
    } 
    else 
    {
        $_SESSION[er]=1;
    }  
}


if (isset($_REQUEST[upvehiclename])) 
{
    if($_FILES[upaboutpdf][size]=="")
    {
        if($_REQUEST[upname]!=$_SESSION[checkpotaniid1])
        {
            
            $data=$con->query("select * from vehiclename where name like '$_REQUEST[upname]' and vehicleid=$_SESSION[checkpotaniid]");
            $row=mysqli_fetch_array($data);
            if($row[0]=="")
            {
                $in=$con->query("update vehiclename set name='$_REQUEST[upname]',seating='$_REQUEST[upseating]' where vehiclenameid=$_SESSION[upid]");
            }
            else 
            {
                $_SESSION[dup]=1;
            } 
        }
        else
        {
                $in=$con->query("update vehiclename set seating='$_REQUEST[upseating]' where vehiclenameid=$_SESSION[upid]");
        }
    }
    else
    {
        if($_REQUEST[upname]!=$_SESSION[checkpotaniid1])
        {
                    $ex = "." . substr($_FILES[upaboutpdf][type], 12);
                    if ($ex == ".pdf")
                        {
                        $size = $_FILES[photo][upaboutpdf] / 1024 / 1024;
                        if ($size <= 12) 
                            {
                            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                            $path = "vehicle/" . $name;
                            $path1 = dirname(__FILE__) . "/" . $path;
                            $data=$con->query("select * from vehiclename where name like '$_REQUEST[upname]' and vehicleid=$_SESSION[checkpotaniid]");
                            $row=mysqli_fetch_array($data);
                            if($row[0]=="")
                            {
                                $unlinkmate=$con->query("select * from vehiclename where vehiclenameid=$_SESSION[upid]");
                                $dataunlinkmate=  mysqli_fetch_array($unlinkmate);
                                unlink("../".$dataunlinkmate[4]);
                                $in=$con->query("update vehiclename set name='$_REQUEST[upname]',seating='$_REQUEST[upseating]',aboutpdf='$path' where vehiclenameid=$_SESSION[upid]");
                                move_uploaded_file($_FILES[upaboutpdf][tmp_name], $path1);
                            }
                            else 
                            {
                                $_SESSION[dup]=1;
                            }
                        } 
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }
        }
        else
        {
            
            $ex = "." . substr($_FILES[upaboutpdf][type], 12);
                    if ($ex == ".pdf")
                        {
                        $size = $_FILES[photo][upaboutpdf] / 1024 / 1024;
                        if ($size <= 12) 
                            {
                            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                            $path = "vehicle/" . $name;
                            $path1 = dirname(__FILE__) . "/" . $path;
                            $unlinkmate=$con->query("select * from vehiclename where vehiclenameid=$_SESSION[upid]");
                            $dataunlinkmate=  mysqli_fetch_array($unlinkmate);
                            unlink("../".$dataunlinkmate[4]);
                            $in=$con->query("update vehiclename set seating='$_REQUEST[upseating]',aboutpdf='$path' where vehiclenameid=$_SESSION[upid]");
                            move_uploaded_file($_FILES[upaboutpdf][tmp_name], $path1);
                        } 
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }
            
        }
    }
}


//assignvehiclename

if (isset($_REQUEST[sendassignvehiclename])) 
{
    $data=$con->query("select * from assignvehiclename where taxicompanyid=$_SESSION[taxicompanyid] and vehiclenameid=$_REQUEST[vehiclenameid]");
    $row=  mysqli_fetch_array($data);
    if($row[0]=="")
    {
        $in=$con->query("insert into assignvehiclename values($_SESSION[taxicompanyid],$_REQUEST[vehiclenameid],0)");
    }   
    else 
    {
        $_SESSION[dup]=1;
    }
}

//updatehotel ( settinghotel )


if (isset($_REQUEST[uphotelprofile])) 
{
    if($_FILES[uplogo][size]=="" && $_FILES[upbannerphoto][size]=="")
    {
        if($_SESSION[checkpotaniid1]!=$_REQUEST[upname])
        {
            $data=$con->query("select * from hotel where name like '$_REQUEST[upname]' and placeid=$_SESSION[checkpotaniid]");
            $row=mysqli_fetch_array($data);
            if($row[0]=="")
            { 
               $in=$con->query("update hotel set emailid='$_REQUEST[upemailid]',password='$_REQUEST[uppassword]',name='$_REQUEST[upname]',address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',star='$_REQUEST[upstar]',type='$_REQUEST[uptype]',gstno='$_REQUEST[upgstno]',checkouttime='$_REQUEST[upcheckouttime]',checkintime='$_REQUEST[upcheckintime]' where hotelid=$_SESSION[upid]");
               if($_SESSION[user]!=$_REQUEST[upemailid] || $_SESSION[password]!=$_REQUEST[uppassword])
                {
                    header('location:../logout.php');
                    $profile=$con->query("select * from siteprofile where category=2");
                    $profilerow=  mysqli_fetch_array($profile);
                    sendmail("$_REQUEST[upemailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                    <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                    <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                    <br/>
                    <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[upemailid]</span></strong></p>
                    <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[uppassword]</span></strong></p>
                    <br/>
                    <hr/>
                    <p><h2 style='color:#2A3C54;'>Your <span style='color:#FF0049;'>Email</span> or <span style='color:#FF0049;'>password</span> is changed</h2></p>
                    <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                    <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                    </p>
                    <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");               
                }
            }
            else 
            {
                $_SESSION[dup]=1;
            } 
        }
        else
        {
              $in=$con->query("update hotel set emailid='$_REQUEST[upemailid]',password='$_REQUEST[uppassword]',name='$_REQUEST[upname]',address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',star='$_REQUEST[upstar]',type='$_REQUEST[uptype]',gstno='$_REQUEST[upgstno]',checkouttime='$_REQUEST[upcheckouttime]',checkintime='$_REQUEST[upcheckintime]' where hotelid=$_SESSION[upid]");
              if($_SESSION[user]!=$_REQUEST[upemailid] || $_SESSION[password]!=$_REQUEST[uppassword])
                {
                    header('location:../logout.php');
                    $profile=$con->query("select * from siteprofile where category=2");
                    $profilerow=  mysqli_fetch_array($profile);
                    sendmail("$_REQUEST[upemailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                    <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                    <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                    <br/>
                    <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[upemailid]</span></strong></p>
                    <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[uppassword]</span></strong></p>
                    <br/>
                    <hr/>
                    <p><h2 style='color:#2A3C54;'>Your <span style='color:#FF0049;'>Email</span> or <span style='color:#FF0049;'>password</span> is changed</h2></p>
                    <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                    <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                    </p>
                    <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");               
                }
        }
        
    }
    else
    {
        if($_FILES[uplogo][size]!="" && $_FILES[upbannerphoto][size]!="")
        {
            if($_SESSION[checkpotaniid1]!=$_REQUEST[upname])
            {
                    $ex = "." . substr($_FILES[uplogo][type], 6);
                    $ex1= "." . substr($_FILES[upbannerphoto][type],6);
                    if ($ex == ".jpg" || $ex == ".jpeg" && $ex1 == ".jpg" || $ex1 == ".jpeg")
                        {
                        $size = $_FILES[uplogo][size] / 1024 / 1024;
                        $size1=$_FILES[upbannerphoto][size] / 1024 / 1024;
                        if ($size <= 5 && $size1 <= 5) 
                            {
                            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                            $path = "hotel/".$name;
                            $path1 = dirname(__FILE__) . "/" . $path;

                            $pdf = rand(100, 999) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex1;
                            $pdfpath = "hotel/" . $pdf;
                            $pdfpath1 = dirname(__FILE__) . "/" . $pdfpath;


                            $data=$con->query("select * from hotel where name like '$_REQUEST[upname]' and placeid=$_SESSION[checkpotaniid]");
                            $row=mysqli_fetch_array($data);
                            if($row[0]=="")
                            {
                               $unlinkmate=$con->query("select * from hotel where hotelid=$_SESSION[upid]");
                               $dataunlinkmate=  mysqli_fetch_array($unlinkmate);
                               unlink("../".$dataunlinkmate[9]);
                               unlink("../".$dataunlinkmate[10]);
                               $in=$con->query("update hotel set emailid='$_REQUEST[upemailid]',password='$_REQUEST[uppassword]',name='$_REQUEST[upname]',address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',star='$_REQUEST[upstar]',type='$_REQUEST[uptype]',logo='$path',bannerphoto='$pdfpath',gstno='$_REQUEST[upgstno]',checkouttime='$_REQUEST[upcheckouttime]',checkintime='$_REQUEST[upcheckintime]' where hotelid=$_SESSION[upid]");
                                move_uploaded_file($_FILES[upbannerphoto][tmp_name], $pdfpath1);
                                move_uploaded_file($_FILES[uplogo][tmp_name], $path1);
                                if($_SESSION[user]!=$_REQUEST[upemailid] || $_SESSION[password]!=$_REQUEST[uppassword])
                                    {
                                        header('location:../logout.php');
                                        $profile=$con->query("select * from siteprofile where category=2");
                                        $profilerow=  mysqli_fetch_array($profile);
                                        sendmail("$_REQUEST[upemailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                                        <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                                        <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                                        <br/>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[upemailid]</span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[uppassword]</span></strong></p>
                                        <br/>
                                        <hr/>
                                        <p><h2 style='color:#2A3C54;'>Your <span style='color:#FF0049;'>Email</span> or <span style='color:#FF0049;'>password</span> is changed</h2></p>
                                        <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                                        <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                                        </p>
                                        <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");               
                                    }
                            }
                            else 
                            {
                                $_SESSION[dup]=1;
                            }


                        } 
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }
            }
            else
            {
                    $ex = "." . substr($_FILES[uplogo][type], 6);
                    $ex1= "." . substr($_FILES[upbannerphoto][type],6);
                    if ($ex == ".jpg" || $ex == ".jpeg" && $ex1 == ".jpg" || $ex1 == ".jpeg")
                    {
                        $size = $_FILES[uplogo][size] / 1024 / 1024;
                        $size1=$_FILES[upbannerphoto][size] / 1024 / 1024;
                        if ($size <= 5 && $size1 <= 5) 
                        {
                            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                            $path = "hotel/".$name;
                            $path1 = dirname(__FILE__) . "/" . $path;

                            $pdf = rand(100, 999) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex1;
                            $pdfpath = "hotel/" . $pdf;
                            $pdfpath1 = dirname(__FILE__) . "/" . $pdfpath;
                            $unlinkmate = $con->query("select * from hotel where hotelid=$_SESSION[upid]");
                            $dataunlinkmate = mysqli_fetch_array($unlinkmate);
                            unlink("../" . $dataunlinkmate[9]);
                            unlink("../" . $dataunlinkmate[10]);
                            $in = $con->query("update hotel set emailid='$_REQUEST[upemailid]',password='$_REQUEST[uppassword]',name='$_REQUEST[upname]',address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',star='$_REQUEST[upstar]',type='$_REQUEST[uptype]',logo='$path',bannerphoto='$pdfpath',gstno='$_REQUEST[upgstno]',checkouttime='$_REQUEST[upcheckouttime]',checkintime='$_REQUEST[upcheckintime]' where hotelid=$_SESSION[upid]");
                            move_uploaded_file($_FILES[upbannerphoto][tmp_name], $pdfpath1);
                            move_uploaded_file($_FILES[uplogo][tmp_name], $path1);
                            if($_SESSION[user]!=$_REQUEST[upemailid] || $_SESSION[password]!=$_REQUEST[uppassword])
                                {
                                    header('location:../logout.php');
                                    $profile=$con->query("select * from siteprofile where category=2");
                                    $profilerow=  mysqli_fetch_array($profile);
                                    sendmail("$_REQUEST[upemailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                                    <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                                    <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                                    <br/>
                                    <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[upemailid]</span></strong></p>
                                    <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[uppassword]</span></strong></p>
                                    <br/>
                                    <hr/>
                                    <p><h2 style='color:#2A3C54;'>Your <span style='color:#FF0049;'>Email</span> or <span style='color:#FF0049;'>password</span> is changed</h2></p>
                                    <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                                    <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                                    </p>
                                    <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");               
                                }
                        }    
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }
            }
            
        }
        elseif($_FILES[uplogo][size]!="")
        {
            if($_SESSION[checkpotaniid1]!=$_REQUEST[upname])
            {
                $ex = "." . substr($_FILES[uplogo][type], 6);
                    if ($ex == ".jpg" || $ex == ".jpeg")
                        {
                        $size = $_FILES[uplogo][size] / 1024 / 1024;
                        if ($size <= 5) 
                            {
                            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                            $path = "hotel/".$name;
                            $path1 = dirname(__FILE__) . "/" . $path;
                            $data=$con->query("select * from hotel where name like '$_REQUEST[upname]' and placeid=$_SESSION[checkpotaniid]");
                            $row=mysqli_fetch_array($data);
                            if($row[0]=="")
                            {
                               $unlinkmate=$con->query("select * from hotel where hotelid=$_SESSION[upid]");
                               $dataunlinkmate=  mysqli_fetch_array($unlinkmate);
                               unlink("../".$dataunlinkmate[9]);
                               $in=$con->query("update hotel set emailid='$_REQUEST[upemailid]',password='$_REQUEST[uppassword]',name='$_REQUEST[upname]',address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',star='$_REQUEST[upstar]',type='$_REQUEST[uptype]',logo='$path',gstno='$_REQUEST[upgstno]',checkouttime='$_REQUEST[upcheckouttime]',checkintime='$_REQUEST[upcheckintime]' where hotelid=$_SESSION[upid]");
                               move_uploaded_file($_FILES[uplogo][tmp_name], $path1);
                               if($_SESSION[user]!=$_REQUEST[upemailid] || $_SESSION[password]!=$_REQUEST[uppassword])
                                {
                                    header('location:../logout.php');
                                    $profile=$con->query("select * from siteprofile where category=2");
                                    $profilerow=  mysqli_fetch_array($profile);
                                    sendmail("$_REQUEST[upemailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                                    <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                                    <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                                    <br/>
                                    <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[upemailid]</span></strong></p>
                                    <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[uppassword]</span></strong></p>
                                    <br/>
                                    <hr/>
                                    <p><h2 style='color:#2A3C54;'>Your <span style='color:#FF0049;'>Email</span> or <span style='color:#FF0049;'>password</span> is changed</h2></p>
                                    <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                                    <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                                    </p>
                                    <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");               
                                }
                            }
                            else 
                            {
                                $_SESSION[dup]=1;
                            }


                        } 
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }
            }
            else
            {
                    $ex = "." . substr($_FILES[uplogo][type], 6);
                    if ($ex == ".jpg" || $ex == ".jpeg")
                        {
                        $size = $_FILES[uplogo][size] / 1024 / 1024;
                        if ($size <= 5) 
                            {
                            $name = chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex;
                            $path = "hotel/".$name;
                            $path1 = dirname(__FILE__) . "/" . $path;
                               $unlinkmate=$con->query("select * from hotel where hotelid=$_SESSION[upid]");
                               $dataunlinkmate=  mysqli_fetch_array($unlinkmate);
                               unlink("../".$dataunlinkmate[9]);
                               $in=$con->query("update hotel set emailid='$_REQUEST[upemailid]',password='$_REQUEST[uppassword]',name='$_REQUEST[upname]',address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',star='$_REQUEST[upstar]',type='$_REQUEST[uptype]',logo='$path',gstno='$_REQUEST[upgstno]',checkouttime='$_REQUEST[upcheckouttime]',checkintime='$_REQUEST[upcheckintime]' where hotelid=$_SESSION[upid]");
                               move_uploaded_file($_FILES[uplogo][tmp_name], $path1);
                               if($_SESSION[user]!=$_REQUEST[upemailid] || $_SESSION[password]!=$_REQUEST[uppassword])
                                {
                                                    header('location:../logout.php');
                                                    $profile=$con->query("select * from siteprofile where category=2");
                                                    $profilerow=  mysqli_fetch_array($profile);
                                                    sendmail("$_REQUEST[upemailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                                    <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                                    <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                                    <br/>
                                    <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[upemailid]</span></strong></p>
                                    <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[uppassword]</span></strong></p>
                                    <br/>
                                    <hr/>
                                    <p><h2 style='color:#2A3C54;'>Your <span style='color:#FF0049;'>Email</span> or <span style='color:#FF0049;'>password</span> is changed</h2></p>
                                    <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                                    <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                                    </p>
                                    <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");               
                                }
                        } 
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }
            }
            
        }
        elseif($_FILES[upbannerphoto][size]!="")
        {
            if($_SESSION[checkpotaniid1]!=$_REQUEST[upname])
            {
                    $ex1= "." . substr($_FILES[upbannerphoto][type],6);
                    if ($ex1 == ".jpg" || $ex1 == ".jpeg")
                    {
                        $size1=$_FILES[upbannerphoto][size] / 1024 / 1024;
                        if ($size1 <= 5) 
                        {
                            $pdf = rand(100, 999) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex1;
                            $pdfpath = "hotel/" . $pdf;
                            $pdfpath1 = dirname(__FILE__) . "/" . $pdfpath;


                            $data=$con->query("select * from hotel where name like '$_REQUEST[upname]' and placeid=$_SESSION[checkpotaniid]");
                            $row=mysqli_fetch_array($data);
                            if($row[0]=="")
                            {
                               $unlinkmate=$con->query("select * from hotel where hotelid=$_SESSION[upid]");
                               $dataunlinkmate=  mysqli_fetch_array($unlinkmate);
                               unlink("../".$dataunlinkmate[10]);
                               $in=$con->query("update hotel set emailid='$_REQUEST[upemailid]',password='$_REQUEST[uppassword]',name='$_REQUEST[upname]',address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',star='$_REQUEST[upstar]',type='$_REQUEST[uptype]',bannerphoto='$pdfpath',gstno='$_REQUEST[upgstno]',checkouttime='$_REQUEST[upcheckouttime]',checkintime='$_REQUEST[upcheckintime]' where hotelid=$_SESSION[upid]");
                                move_uploaded_file($_FILES[upbannerphoto][tmp_name], $pdfpath1);
                                if($_SESSION[user]!=$_REQUEST[upemailid] || $_SESSION[password]!=$_REQUEST[uppassword])
                                   {
                                                header('location:../logout.php');
                                                $profile=$con->query("select * from siteprofile where category=2");
                                                $profilerow=  mysqli_fetch_array($profile);
                                                sendmail("$_REQUEST[upemailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                                <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                                <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                                <br/>
                                <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[upemailid]</span></strong></p>
                                <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[uppassword]</span></strong></p>
                                <br/>
                                <hr/>
                                <p><h2 style='color:#2A3C54;'>Your <span style='color:#FF0049;'>Email</span> or <span style='color:#FF0049;'>password</span> is changed</h2></p>
                                <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                                <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                                </p>
                                <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");               
                                 }
                            }
                            else 
                            {
                                $_SESSION[dup]=1;
                            }
                        } 
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }
            }
            else
            {
                        $ex1= "." . substr($_FILES[upbannerphoto][type],6);
                    if ($ex1 == ".jpg" || $ex1 == ".jpeg")
                    {
                        $size1=$_FILES[upbannerphoto][size] / 1024 / 1024;
                        if ($size1 <= 5) 
                        {
                            $pdf = rand(100, 999) . chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)) . $ex1;
                            $pdfpath = "hotel/" . $pdf;
                            $pdfpath1 = dirname(__FILE__) . "/" . $pdfpath;
                            $unlinkmate=$con->query("select * from hotel where hotelid=$_SESSION[upid]");
                            $dataunlinkmate=  mysqli_fetch_array($unlinkmate);
                            unlink("../".$dataunlinkmate[10]);
                            $in=$con->query("update hotel set emailid='$_REQUEST[upemailid]',password='$_REQUEST[uppassword]',name='$_REQUEST[upname]',address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',star='$_REQUEST[upstar]',type='$_REQUEST[uptype]',bannerphoto='$pdfpath',gstno='$_REQUEST[upgstno]',checkouttime='$_REQUEST[upcheckouttime]',checkintime='$_REQUEST[upcheckintime]' where hotelid=$_SESSION[upid]");
                            move_uploaded_file($_FILES[upbannerphoto][tmp_name], $pdfpath1);
                            if($_SESSION[user]!=$_REQUEST[upemailid] || $_SESSION[password]!=$_REQUEST[uppassword])
                                {
                                    header('location:../logout.php');
                                    $profile=$con->query("select * from siteprofile where category=2");
                                    $profilerow=  mysqli_fetch_array($profile);
                                    sendmail("$_REQUEST[upemailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                    <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                    <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                    <br/>
                    <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[upemailid]</span></strong></p>
                    <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[uppassword]</span></strong></p>
                    <br/>
                    <hr/>
                    <p><h2 style='color:#2A3C54;'>Your <span style='color:#FF0049;'>Email</span> or <span style='color:#FF0049;'>password</span> is changed</h2></p>
                    <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                    <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                    </p>
                    <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");               
                                }
                        } 
                        else 
                        {
                            $_SESSION[err]=1;
                        }
                    } 
                    else 
                    {
                        $_SESSION[er]=1;
                    }
            }
            
        }
    }
 }
 
 
 //settingtaxicompany ( taxicompany profile )

 if (isset($_REQUEST[uptaxicompanyprofile])) 
{
    if($_SESSION[checkpotaniid1]!=$_REQUEST[upname])
    {
        $data=$con->query("select * from taxicompany where name like '$_REQUEST[upname]' and placeid=$_SESSION[checkpotaniid]");
        $row= mysqli_fetch_array($data);
        if($row[0]=="")
        {
            $in=$con->query("update taxicompany set emailid='$_REQUEST[upemailid]',password='$_REQUEST[uppassword]',name='$_REQUEST[upname]',address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',gstno='$_REQUEST[upgstno]' where taxicompanyid=$_SESSION[upid]");
            if($_SESSION[user]!=$_REQUEST[upemailid] || $_SESSION[password]!=$_REQUEST[uppassword])
            {
                            header('location:../logout.php');
                            $profile=$con->query("select * from siteprofile where category=2");
                            $profilerow=  mysqli_fetch_array($profile);
                            sendmail("$_REQUEST[upemailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
            <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
            <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
            <br/>
            <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[upemailid]</span></strong></p>
            <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[uppassword]</span></strong></p>
            <br/>
            <hr/>
            <p><h2 style='color:#2A3C54;'>Your <span style='color:#FF0049;'>Email</span> or <span style='color:#FF0049;'>password</span> is changed</h2></p>
            <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
            <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
            </p>
            <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");               
                        }
        }
        else 
        {
            $_SESSION[dup]=1;
        }
    }
    else
    {
        $in=$con->query("update taxicompany set emailid='$_REQUEST[upemailid]',password='$_REQUEST[uppassword]',address='$_REQUEST[upaddress]',mobile='$_REQUEST[upmobile]',map='$_REQUEST[upmap]',about='$_REQUEST[upabout]',gstno='$_REQUEST[upgstno]' where taxicompanyid=$_SESSION[upid]");
        if($_SESSION[user]!=$_REQUEST[upemailid] || $_SESSION[password]!=$_REQUEST[uppassword])
                    {
                        header('location:../logout.php');
                        $profile=$con->query("select * from siteprofile where category=2");
                        $profilerow=  mysqli_fetch_array($profile);
                        sendmail("$_REQUEST[upemailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
        <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
        <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
        <br/>
        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[upemailid]</span></strong></p>
        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[uppassword]</span></strong></p>
        <br/>
        <hr/>
        <p><h2 style='color:#2A3C54;'>Your <span style='color:#FF0049;'>Email</span> or <span style='color:#FF0049;'>password</span> is changed</h2></p>
        <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
        <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
        </p>
        <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");               
                    }
    }
    
}

//review and rating
if(isset($_REQUEST[sendreview]))
{
    $a=$con->query("select * from rate where packageid=$_SESSION[packageid] and emailid like '$_SESSION[user]'");
    $cnt=mysqli_num_rows($a);
    if($cnt==0)
    {
        $dt=date('Y-m-d');
        $inrate=$con->query("insert into rate values($_SESSION[packageid],'$_SESSION[user]',0,$_REQUEST[rate])");
        $inreview=$con->query("insert into review values($_SESSION[packageid],'$_SESSION[user]',0,'$_REQUEST[review]','$dt')");
    }
    
}

if(isset($_REQUEST[upreviewform]))
{
    $dt=date('Y-m-d');
    $uprate=$con->query("update rate set rate=$_REQUEST[uprate] where emailid='$_SESSION[user]' and packageid=$_SESSION[packageid]");
    $upreview=$con->query("update review set review='$_REQUEST[upreview]',reviewdate='$dt' where emailid='$_SESSION[user]' and packageid=$_SESSION[packageid]");
}

//custom package

if(isset($_REQUEST[sendcustompackage]))
{
      if($_SESSION[user]!="")
      {
            if($_SESSION[type]==1)
            {
               $in=$con->query("insert into custompackage values('$_SESSION[user]',0,'$_REQUEST[arrivaldate]','$_REQUEST[departuredate]',$_REQUEST[budget],$_REQUEST[noofadults],$_REQUEST[noofchildrens],'$_REQUEST[packagecategory]',0,NULL)");
                
            }
            else 
            {
                $_SESSION[dupp]=1;
            }
      }
      else
      {
          $_SESSION[dup]=1;
          
      }
}


//place assign(insert,update)

if(isset($_REQUEST[sendplaceassign]))
{
       if(empty($_REQUEST[placeid]))
       {
           $_SESSION[dup]=1;
       }
       else 
       {
           foreach ($_REQUEST[placeid] as $item)
            {
                $in=$con->query("insert into placeassign values($_SESSION[custompackageid],$item,0)");
            }
       }
}



// package offer (insert,delete)

if (isset($_REQUEST[sendoffer]))
{
    $data=$con->query("select * from offer where packageid=$_REQUEST[packageid]");
    $row=mysqli_fetch_array($data);
    
    if($row[0]=="")
    {
        $in=$con->query("insert into offer values($_REQUEST[packageid],0,'$_REQUEST[offername]','$_REQUEST[fromdate]','$_REQUEST[todate]',$_REQUEST[percentage])");
    }
    else 
    {
        $_SESSION[dup]=1;
    }
}


if (isset($_REQUEST[upoffer]))
{
        $in=$con->query("update offer  set offername='$_REQUEST[upoffername]',fromdate='$_REQUEST[upfromdate]',todate='$_REQUEST[uptodate]',percentage=$_REQUEST[uppercentage] where offerid=$_SESSION[upid]");
}

//custom package hotel

if(isset($_REQUEST[hotelrequest]))
{
       if(empty($_REQUEST[hotelid]))
       {
           $_SESSION[dup]=1;
       }
       else 
       {
           foreach ($_REQUEST[hotelid] as $item)
            {
                $in=$con->query("insert into hotelrequest values($_SESSION[hotelcustompackageid],$item,0,0,NULL)");
            }
            $sel=$con->query("select status,activationdate from custompackage where custompackageid=$_SESSION[hotelcustompackageid]");
            $selrow=mysqli_fetch_array($sel);
            
            if($selrow[0]==0)
            {    
                $dt=date('Y-m-d',strtotime("+10 days"));
                $up=$con->query("update custompackage set status=1,activationdate='$dt' where custompackageid=$_SESSION[hotelcustompackageid]");
            }
       }
}

//custom package taxi company

if(isset($_REQUEST[taxirequest]))
{
        if(empty($_REQUEST[taxicompanyid]))
       {
           $_SESSION[dup]=1;
       }
       else 
       {
           foreach ($_REQUEST[taxicompanyid] as $item)
            {
               $in=$con->query("insert into taxicompanyrequest values($_SESSION[taxicustompackageid],$item,0,0,NULL)");
            }
            $sel=$con->query("select status,activationdate from custompackage where custompackageid=$_SESSION[taxicustompackageid]");
            $selrow=mysqli_fetch_array($sel);
            
            if($selrow[0]==0)
            {    
                $dt=date('Y-m-d',strtotime("+10 days"));
                $up=$con->query("update custompackage set status=1,activationdate='$dt' where custompackageid=$_SESSION[taxicustompackageid]");
            }
       }
}

//custom package hotel

if(isset($_REQUEST[delhotelcustom]))
{
    $del=$con->query("delete from hotelrequest where hotelrequestid=$_REQUEST[delhotelcustom]");
}

//custom package taxi

if(isset($_REQUEST[delcustomtaxi]))
{
    $del=$con->query("delete from taxicompanyrequest where taxicompanyrequestid=$_REQUEST[delcustomtaxi]");
}

//hotelrequest conformation
if(isset($_REQUEST[conformationbyhotel]))
{
   $up=$con->query("update hotelrequest set status=1,amount=$_REQUEST[amount] where hotelrequestid=$_REQUEST[hotelrequestid]");
}

//taxi request conformation

if(isset($_REQUEST[conformationbytaxi]))
{
   $up=$con->query("update taxicompanyrequest set status=1,amount=$_REQUEST[amount] where taxicompanyrequestid=$_REQUEST[taxirequestid]");
}

//custompackage response
if(isset($_REQUEST[custompackageresponse]))
{
    $ex = "." . substr($_FILES[responsepdf][type], 12);
    if ($ex == ".pdf")
        {
        $size = $_FILES[photo][responsepdf] / 1024 / 1024;
        if ($size <= 12) 
            {
            $name = chr(rand(65, 90)).chr(rand(65, 90)) . chr(rand(65, 90)) . rand(100, 999) . chr(rand(97, 122)) . chr(rand(97, 122)).chr(rand(65, 90)) . $ex;
            $path = "responsepdf/" . $name;
            $path1 = dirname(__FILE__) . "/" . $path;
            $seltaxi=$con->query("select sum(amount) from taxicompanyrequest where status=1 and custompackageid=$_REQUEST[custompackageresponse]");
            $selhotel=$con->query("select sum(amount) from hotelrequest where status=1 and custompackageid=$_REQUEST[custompackageresponse]");
            $taxirow= mysqli_fetch_array($seltaxi);
            $hotelrow= mysqli_fetch_array($selhotel);
            $amount=$taxirow[0]+$hotelrow[0];
            move_uploaded_file($_FILES[responsepdf][tmp_name], $path1);
            $up=$con->query("update custompackage set status=2 where custompackageid=$_REQUEST[custompackageresponse]");
            $in=$con->query("insert into custompackageresponse values($_REQUEST[custompackageresponse],0,'$path',$amount)");
        } 
        else 
        {
            $_SESSION[err]=1;
        }
    } 
    else 
    {
        $_SESSION[er]=1;
    }
}

//request new password

if(isset($_REQUEST[verificationcodeemail]))
{
    $check=$con->query("select * from register where emailid like '$_REQUEST[emailid]'");
    if(mysqli_num_rows($check)==1)
    {
            $randome=rand(100,1000). rand(700, 999) .rand(500, 999);
            $_SESSION[requestpass]=$randome;
            $_SESSION[emailsachvo]=$_REQUEST[emailid];
            $profile=$con->query("select * from siteprofile where category=2");
                            $profilerow=  mysqli_fetch_array($profile);
                            sendmail("$_REQUEST[emailid]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                            <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                            <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                            <br/>
                            <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Verification Code :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$randome</span></strong></p>
                            <br/>
                            <hr/>
                            <p><h2 style='color:#2A3C54;'>Verification <span style='color:#FF0049;'>code</span> for <span style='color:#FF0049;'>change</span> password </h2></p>
                            <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                            <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                            </p>
                            <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");               
                            
    }
    else
    {
        $_SESSION[emailverify]=1;   
    }

}

if(isset($_REQUEST[getverificationcode]))
{
    if($_SESSION[requestpass]==$_REQUEST[verificationcode])
    {
      $_SESSION[verificationcode]=$_REQUEST[verificationcode];
    }
    else
    {
        session_destroy();
        header('location:requestpassword.php');
    }
}

if(isset($_REQUEST[changepassword]))
{
    $up = $con->query("update register set password='$_REQUEST[password]' where emailid like '$_SESSION[emailsachvo]'");
    $profile = $con->query("select * from siteprofile where category=2");
    $profilerow = mysqli_fetch_array($profile);
    sendmail("$_SESSION[emailsachvo]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                                        <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                                        <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                                        <br/>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>Emailid :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_SESSION[emailsachvo]</span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>New password :-</span> <span style='color: white; background: #FF0049; padding: 10px;'>$_REQUEST[password]</span></strong></p>
                                        <br/>
                                        <hr/>
                                        <p><h2 style='color:#2A3C54;'>Your  <span style='color:#FF0049;'>password</span> is change</h2></p>
                                        <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                                        <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                                        </p>
                                        <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");
        session_destroy();
        header('location:login.php');
}

//static payment
if(isset($_REQUEST[advanceamount]))
{
        $sell=$con->query("SELECT * FROM booking where itemcode='static' and mixpackageid=$_REQUEST[advanceamount] and emailid='$_SESSION[user]'");
        $roww= mysqli_fetch_array($sell);
        $dt=date('Y-m-d');
        $selconfo=$con->query("SELECT * FROM confrimbooking where bookingid=$roww[1] and emailid like '$_SESSION[user]'");
        if(mysqli_num_rows($selconfo)==0)
        {
            $in=$con->query("insert into confrimbooking values('$_SESSION[user]',$roww[1],0,'$dt','$_REQUEST[payment]',$roww[6],$roww[7],$roww[8],0,$roww[2],'$roww[3]')");
            $up=$con->query("update booking set paymode='$_REQUEST[payment]' where bookingid=$roww[1]");   
        }
}

//bill Payment

if(isset($_REQUEST[bill]))
{
    $data=$con->query("select * from booking where bookingid=$_REQUEST[bookingid]");
    $rowbooking= mysqli_fetch_array($data);
    $dt=date('Y-m-d');
    $up=$con->query("update confrimbooking set status=1 where confrimbookingid=$_REQUEST[confrimbookingid]");
    $inbill=$con->query("insert into bill values($_REQUEST[confrimbookingid],0,'$dt',$rowbooking[6],$rowbooking[7],$rowbooking[8])");
    $in=$con->query("insert into billhistory values('$rowbooking[0]',$_REQUEST[confrimbookingid],0,$rowbooking[2],'$rowbooking[3]','$dt','$rowbooking[5]',$rowbooking[6],$rowbooking[7],$rowbooking[8])");
    $goto=$con->query("select * from package where packageid=$rowbooking[2]");
    $aapo= mysqli_fetch_array($goto);
    $del=$con->query("delete from booking where bookingid=$_REQUEST[bookingid]");
     
    $profile = $con->query("select * from siteprofile where category=2");
    $profilerow = mysqli_fetch_array($profile);
    sendmail("$rowbooking[0]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                                        <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                                        <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                                        <br/>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>$aapo[1] Package Payment Confirm</span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'> Number of Days </span> <span style='color: white; background: #FF0049; padding: 10px;'> $aapo[2] </span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'> Number of Nights </span> <span style='color: white; background: #FF0049; padding: 10px;'> $aapo[3] </span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'> Amount </span> <span style='color: white; background: #FF0049; padding: 10px;'> $aapo[4] </span></strong></p>
                                        <br/>
                                        <hr/>
                                        <p><h2 style='color:#2A3C54;'>Get Ready  <span style='color:#FF0049;'>With</span> Your Stuff</h2></p>
                                        <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                                        <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1];</b></span></font>
                                        </p>
                                        <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3];</b></span></font></p>", "thejourney");
}



//custom payment
if(isset($_REQUEST[customadvanceamount]))
{
        $sell=$con->query("SELECT * FROM booking where itemcode='custom' and mixpackageid=$_REQUEST[customadvanceamount] and emailid='$_SESSION[user]'");
        $roww= mysqli_fetch_array($sell);
        $dt=date('Y-m-d');
        $selconfo=$con->query("SELECT * FROM confrimbooking where bookingid=$roww[1] and emailid like '$_SESSION[user]'");
        if(mysqli_num_rows($selconfo)==0)
        {
            $in=$con->query("insert into confrimbooking values('$_SESSION[user]',$roww[1],0,'$dt','$_REQUEST[payment]',$roww[6],$roww[7],$roww[8],0,$roww[2],'$roww[3]')");
            $up=$con->query("update booking set paymode='$_REQUEST[payment]' where bookingid=$roww[1]");   
        }
}

//custom bill

if(isset($_REQUEST[custombill]))
{
    $data=$con->query("select * from booking where bookingid=$_REQUEST[bookingid]");
    $rowbooking= mysqli_fetch_array($data);
    $dt=date('Y-m-d');
    $up=$con->query("update confrimbooking set status=1 where confrimbookingid=$_REQUEST[confrimbookingid]");
    $inbill=$con->query("insert into bill values($_REQUEST[confrimbookingid],0,'$dt',$rowbooking[6],$rowbooking[7],$rowbooking[8])");
    $in=$con->query("insert into billhistory values('$rowbooking[0]',$_REQUEST[confrimbookingid],0,$rowbooking[2],'$rowbooking[3]','$dt','$rowbooking[5]',$rowbooking[6],$rowbooking[7],$rowbooking[8])");
    $upp=$con->query("update custompackage set status=3 where custompackageid=$rowbooking[2]");
    $goto=$con->query("select * from custompackage where custompackageid=$rowbooking[2]");
    $aapo= mysqli_fetch_array($goto);
    $amountgoto=$con->query("select * from custompackageresponse where custompackageid=$rowbooking[2]");
    $amountaapo= mysqli_fetch_array($amountgoto);
    $profiledata=$con->query("select * from emailid like '$_SESSION[user]'");
    $profilerow= mysqli_fetch_array($profiledata);
    
    $taxireq=$con->query("SELECT * FROM taxicompanyrequest ta,taxicompany t where t.taxicompanyid=ta.taxicompanyid  and ta.custompackageid=$rowbooking[2] and ta.status=1");
     while($taxirow= mysqli_fetch_array($taxireq))
     {
         $upkaro=$con->query("update taxicompanyrequest set status=2 where taxicompanyid=$taxirow[1] and custompackageid=$rowbooking[2]");
        sendmail("$taxirow[13]","<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                                        <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                                        <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                                        <br/>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'> Customer is confirm come on your Taxi Company </span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'> Arrival Date </span> <span style='color: white; background: #FF0049; padding: 10px;'> $aapo[2] </span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'> departure date </span> <span style='color: white; background: #FF0049; padding: 10px;'> $aapo[3] </span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'> customer Name </span> <span style='color: white; background: #FF0049; padding: 10px;'> $profilerow[3] $profilerow[4]</span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'> Email </span> <span style='color: white; background: #FF0049; padding: 10px;'> $profilerow[5] </span></strong></p>
                                            <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'> customer Contact number </span> <span style='color: white; background: #FF0049; padding: 10px;'> $profilerow[6] </span></strong></p>
                                        <br/>
                                        <hr/>
                                        <p><h2 style='color:#2A3C54;'>Get Ready  <span style='color:#FF0049;'>With</span> Your Service</h2></p>
                                        <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                                        <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1]</b></span></font>
                                        </p>
                                        <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3]</b></span></font></p>","the journey");
     }
     
     $hotelreq=$con->query("SELECT * FROM hotelrequest ha,hotel h where h.hotelid=ha.hotelid and ha.custompackageid=$rowbooking[2] and ha.status=1");
     while($hotelrow= mysqli_fetch_array($hotelreq))
     {
         $upkaro=$con->query("update hotelrequest set status=2 where hotelid=$taxirow[1] and custompackageid=$rowbooking[2]");
        sendmail("$hotelrow[20]","<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                                        <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                                        <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                                        <br/>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'> Customer is confirm come on your Hotel</span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'> Arrival Date </span> <span style='color: white; background: #FF0049; padding: 10px;'> $aapo[2] </span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'> departure date </span> <span style='color: white; background: #FF0049; padding: 10px;'> $aapo[3] </span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'> customer Name </span> <span style='color: white; background: #FF0049; padding: 10px;'> $profilerow[3] $profilerow[4]</span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'> Email </span> <span style='color: white; background: #FF0049; padding: 10px;'> $profilerow[5] </span></strong></p>
                                            <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'> customer Contact number </span> <span style='color: white; background: #FF0049; padding: 10px;'> $profilerow[6] </span></strong></p>
                                        <br/>
                                        <hr/>
                                        <p><h2 style='color:#2A3C54;'>Get Ready  <span style='color:#FF0049;'>With</span> Your Service</h2></p>
                                        <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                                        <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1]</b></span></font>
                                        </p>
                                        <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3]</b></span></font></p>","thejourney");
     }
    
    $profile = $con->query("select * from siteprofile where category=2");
    $profilerow = mysqli_fetch_array($profile);
    sendmail("$rowbooking[0]", "<h1><span style='color: #ff0049;'><strong>THE JOURNEY</strong></span></h1>
                                        <div style='height:5px;float:left;background:#FF0049; width:50%;'></div>
                                        <div style='height:5px;float:left;background:#2A3C54;width:50%'></div>
                                        <br/>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'>$aapo[7] Package Payment Confirm</span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'> Arrival Date </span> <span style='color: white; background: #FF0049; padding: 10px;'> $aapo[2] </span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'> departure date </span> <span style='color: white; background: #FF0049; padding: 10px;'> $aapo[3] </span></strong></p>
                                        <p style='padding: 10px;'><strong><span style='background: #2a3c54; color: white; padding: 10px;'> Amount </span> <span style='color: white; background: #FF0049; padding: 10px;'> $amountaapo[3] </span></strong></p>
                                        <br/>
                                        <hr/>
                                        <p><h2 style='color:#2A3C54;'>Get Ready  <span style='color:#FF0049;'>With</span> Your Stuff</h2></p>
                                        <h3><span style='color: #2a3c54;'>If you Have</span><span style='color: #FF0049;' > Any problem?</span></h3>
                                        <font style='padding-left:30px; color:#FF0049;'>Call :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[1]</b></span></font>
                                        </p>
                                        <p><font style='padding-left:30px; color:#FF0049;'>Email :-&nbsp;&nbsp;&nbsp;<span style='color:#2A3C54;'><b>$profilerow[3]</b></span></font></p>", "thejourney");
    
    
    $del=$con->query("delete from booking where bookingid=$_REQUEST[bookingid]");
}

?>