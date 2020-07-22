var cont=0,log;
$(document).ready(function(){
    callkaro();
    $("#counter").hide();
    $("body").mousedown(function(){
        cont=0;
        clearInterval(log);
        callkaro();
    });
    
    $("body").mouseup(function(){
        cont=0;
        clearInterval(log);
        callkaro();
    });
    
    $("body").click(function(){
        cont=0;
        clearInterval(log);
        callkaro();
    });
    
    $("body").mouseover(function(){
        cont=0;
        clearInterval(log);
        callkaro();
    });
    
    $("body").dblclick(function(){
        cont=0;
        clearInterval(log);
        callkaro();
    });
    
    $("body").keypress(function(){
        cont=0;
        clearInterval(log);
        callkaro();
    });
});

function callkaro()
{
    log=setInterval(auto,1000);
}

function auto()
{
    cont++;
    $("#counter").text(cont);
    var len=$("#counter").text();
    if(cont==1000)
    {
        if(len.length>0)
        {
            window.location.href="../logout.php";
        }
    }
}