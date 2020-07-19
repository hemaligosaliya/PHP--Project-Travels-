 var cbn=0;
 var cntadmin=0;
$(document).ready(function(){
  
    // setting start
    $("#side-left > div").hide();
    $(".profilephoto").show();
    $("#adminform").hide();
    $("#revbtn").hide();
    $("#verify").hide();
   //profile button name change
    // setting end
    
    $c=0;
    $("#eye").click(function(){
        if($c==0){
            $(".password").attr("type","text");
            $("#eye").attr("class","fa fa-eye myeye");
            $c=1;
        } 
        else
        {
            $(".password").attr("type","password");
            $("#eye").attr("class","fa fa-eye-slash myeye");
            $c=0;
        }
    });
    
    //repassword field eye
    
    $c1=0;
    $("#eye1").click(function(){
        if($c1==0){
            $(".repassword").attr("type","text");
            $("#eye1").attr("class","fa fa-eye myeye");
            $c1=1;
        } 
        else
        {
            $(".repassword").attr("type","password");
            $("#eye1").attr("class","fa fa-eye-slash myeye");
            $c1=0;
        }
    });
    
    $c3=0;
    $("#eye2").click(function(){
        if($c3==0){
            $(".uppassword").attr("type","text");
            $("#eye2").attr("class","fa fa-eye myeye");
            $c3=1;
        } 
        else
        {
            $(".uppassword").attr("type","password");
            $("#eye2").attr("class","fa fa-eye-slash myeye");
            $c3=0;
        }
    });
    
});

// setting page
function changepatto(name)
{
    $("#side-left").toggleClass("col-md-3 col-md-9",1000);
    $("#side-right").toggleClass("col-md-7 col-md-1",1000);
    $("#side-left > div").toggle();
    $("#side-right > div").toggle();
    $(".profilephoto").show().toggleClass(".profilephoto .profilebtn-clicked")
    $(".profilebtn").toggleClass(".profilebtn .profilebtn-clicked");
    //    $(name).text("View your Profile");
    if(cbn==0)
    {
        
        $(name).text("View your Profile");
        cbn=1;
    }
    else
    {
        $(name).text("Edit your Profile");
        cbn=0;
    }
}


function daycheck()
{
    var day=document.package.numberofday.value;
    var night=document.package.numberofnight.value;
    var total;
    var errormate=0;
    total=day-night;
    if(total!=1)
    {
        errormate=1;
    }
    if(errormate==1)
    {
        document.getElementById("khotupadiyu").innerHTML="please proper insert number of day and nights!";
        document.getElementById("khotupadiyu").style.color="red";
        return false;
    }
}

function updaycheckup()
{
    var day=document.uppackage.upnumberofday.value;
    var night=document.uppackage.upnumberofnight.value;
    var total;
    var errormate=0;
    total=day-night;
    if(total!=1)
    {
        errormate=1;
    }
    if(errormate==1)
    {
        document.getElementById("khotupadiyuup").innerHTML="please proper update number of day and nights!";
        document.getElementById("khotupadiyuup").style.color="red";
        return false;
    }
}

function passcheck()
{
    var pass=document.registration.password.value;
    var repass=document.registration.repassword.value;
    var cap=document.registration.captcha.value;
    var wcap=$("#captcha").text();
    var pf=0;
    var cf=0;
    if(pass!=repass)
    {
       pf=1;
    }
    if(cap.trim()!=wcap.trim())
    {
         cf=1;
    }
    if(pf==0 && cf==0)
    {
        return true;
    }
    else
    {
        if(pf==1)
        {
            document.getElementById("donot").innerHTML="Password Not Match !";
            document.getElementById("donot").style.color="red";
            document.registration.repassword.focus();
            if(cf==0)
            {
                document.getElementById("captchanot").innerHTML="";
            }
        }
        if(cf==1)
        {
           document.getElementById("captchanot").innerHTML="Captcha Not Match !";
           document.getElementById("captchanot").style.color="red";
           document.registration.captcha.focus();
           if(pf==0)
            {
                 document.getElementById("donot").innerHTML="";
            }
        }
        return false;
    }
}

//captcha

function captchaleva(shu)
{   
    $.ajax({
        
        url:'missdata.php?shu='+shu,
        type:'POST',
        success:function(data){
        
            $("#captcha").html(data);
        }
        
    });
} 

//rating

function userrate(shu,uid,hid,ketla,action)
{   alert(shu+uid+hid+ketla+action);
    $.ajax({
        
        url:'missdata.php?shu='+shu+'&uid='+uid+'&hid='+hid+'&ketla='+ketla+'&action='+action,
        type:'POST',
        success:function(data){
        
            $("#userrate").html(data);
        }
        
    });
} 


function takedata(shu,action,id,ketlamupage,perpage,kayu)
{
  
    if(action=="search" && id=='')
    {
        action='display';
        ketlamupage=1;
        perpage=10;
    }
    $.ajax({
        url:'../missdata.php?shu='+shu+'&action='+action+'&id='+id+'&ketlamupage='+ketlamupage+'&perpage='+perpage+'&kayu='+kayu,
        type:'POST',
        success:function(data){
        
            $("#missdata").html(data);
        }       
        
    });
}

var sp=0;
function showpass(password,id)
{
    if(sp==0)
    {
        $('#'+id).text(password);
        sp=1;
    }
    else
    {
         $('#'+id).text("**********");
        sp=0;
    }
}


//adminmatser link effect

function changeclass(kon)
{
    
    $('.linkclick li.linkactive').removeClass("linkactive");
    $(kon).addClass("linkactive");
}

$(document).ready(function () {
    $('.linkclick li').click(function () {
      
        changeclass(this); 
        
    });
});


//select combo

function selectleva(konu,id)
{
    $.ajax({
        
        url:'../missdata.php?konu='+konu+'&id='+id,
        type:'POST',
        success:function(combodata){
        
            $("#"+konu+"combo").html(combodata);
            
        }
        
    });
}

//select registrationcombo

function selectlevareg(konu,id)
{
    $.ajax({
        
        url:'missdata.php?konu='+konu+'&id='+id,
        type:'POST',
        success:function(combodata){
            $("#"+konu+"combo").html(combodata);
            
        }
        
    });
}



//select Custom package place select combo

function selectcustomselectplace(konu,id,custom)
{
    $.ajax({
        
        url:'missdata.php?konu='+konu+'&id='+id+'&custom='+custom,
        type:'POST',
        success:function(combodata){
            $("#"+konu+"combo").html(combodata);
            
        }
        
    });
}

//model combo(package)

function viewmoreleva(konidetail,id)
{   
    $.ajax({
        
        url:'../missdata.php?konidetail='+konidetail+'&id='+id,
        type:'POST',
        success:function(data){
        
            $("#viewmore1").html(data);
        }
        
    });
}

//model combo(vehicle)

function vehicleleva(konidetail,id,name)
{   
    $.ajax({
        
        url:'../missdata.php?konidetail='+konidetail+'&id='+id+'&name='+name,
        type:'POST',
        success:function(data){
        
            $("#vehicle1").html(data);
        }
        
    });
}

//model combo(package)

function taxicompanyleva(konidetail,id)
{   
    $.ajax({
        
        url:'../missdata.php?konidetail='+konidetail+'&id='+id,
        type:'POST',
        success:function(data){
        
            $("#taxicompany1").html(data);
        }
        
    });
}

function packageleva(konidetail,id)
{   
    $.ajax({
        
        url:'../missdata.php?konidetail='+konidetail+'&id='+id,
        type:'POST',
        success:function(data){
        
            $("#packagemore1").html(data);
        }
        
    });
}


//model combo(hotel)

function hotelprofile(konidetail,id)
{
    $.ajax({
        
        url:'../missdata.php?konidetail='+konidetail+'&id='+id,
        type:'POST',
        success:function(data){
        
            $("#hotel1").html(data);
        }
        
    });
}

//model combo(siteprofile)

function siteprofile(konidetail,id)
{   
    $.ajax({
        
        url:'../missdata.php?konidetail='+konidetail+'&id='+id,
        type:'POST',
        success:function(data){
        
            $("#siteprofile1").html(data);
        }
        
    });
}

//model combo(siteprofile)

function tc(konidetail,id)
{   
    $.ajax({
        
        url:'../missdata.php?konidetail='+konidetail+'&id='+id,
        type:'POST',
        success:function(data){
        
            $("#tc1").html(data);
        }
        
    });
}


//model combo( custom hotel)

function customhotel(konidetail,id)
{   

    $.ajax({
        
        url:'../missdata.php?konidetail='+konidetail+'&id='+id,
        type:'POST',
        success:function(data){
        
            $("#customhotel1").html(data);
        }
        
    });
}

//model combo(custom package)

function custompackageleva(konidetail,id)
{   
    $.ajax({
            
        url:'custompackagemodel.php?konidetail='+konidetail+'&id='+id,
        type:'POST',
        success:function(data){
            $("#custompackage1").html(data);
        }
        
    });
}

//model combo(custom package)

function staticpackageleva(konidetail,id)
{   
    $.ajax({
            
        url:'custompackagemodel.php?konidetail='+konidetail+'&id='+id,
        type:'POST',
        success:function(data){
            $("#staticpackage1").html(data);
        }
        
    });
}

//reload search

function searchbox()
{
    if(count==1)
    {
        $.ajax({
        
        url:'searchbox.php',
        type:'POST',
        success:function(combodata){
        
            $("#searchboxad").html(combodata);
            
        }

        });
        count=0;
    }
    
}

//display admin login

function displayadmin()
{
    cntadmin++;
    if(cntadmin==10)
    {
        $("#adminform").show().addClass('animated flip');
        $("#admin404").hide();
        $("#adminballon1").hide();
        $("#adminballon2").hide();
    }
}


//review
function review()
{
  $("#revbtn").show().addClass('animated flip');
}

//custom package
function dedate(date)
{     
      $("#dateaapo").attr('min',date);
}

// offer package
function deoffer(date)
{     
      $("#dateoffer").attr('min',date);
}

// sechudle package
function deschudle(date)
{     
      $("#datedeschudle").attr('min',date);
}

function checkdate()
{
    var de=document.custompackage.departuredate.value;
    var ar=document.custompackage.arrivaldate.value;
    var amount=document.custompackage.arrivaldate.value;
    if(de==ar)
    {
        alert('minimum 2 day select ');
        return  false;
    }
    else
    {
        return true;
    }
}

function checkrequest()
{
  var password=document.requestpasswordform.password.value;
  var repassword=document.requestpasswordform.repassword.value; 
  if(password==repassword)
  {
        return true;
  }
  else
  {
        document.getElementById("erroraapo").innerHTML="password is not match";
        return false;
  }
}

function misssearch(konu,ketla,price)
{
    var d=$('#vegfilter').serialize();
          $.ajax({
        
        url:'missdata.php?konu='+konu+'&ketla='+ketla+'$p='+price,
        type:'POST',
        data:d,
        success:function(data){
        
            $("#productdata").html(data);
            
        }

        });
    
}

//main search

function mainsearch(shu,id)
{
    if(id=="")
    {
        $('#mainsearch').addClass('dismain');
    }
    else
    {
         $('#mainsearch').removeClass('dismain');
    }
    $.ajax({
        
        url:'missdata.php?shu='+shu+'&id='+id,
        type:'POST',
        success:function(data){
            $("#mainsearch").html(data);
        }
        
    });
}

function printleva(printid)
{
    var content = document.getElementById(printid).innerHTML;
    var mywindow = window.open('', 'Print');
    mywindow.document.write(content);
    mywindow.document.close();
    mywindow.focus();
    mywindow.print();
    mywindow.close();
}