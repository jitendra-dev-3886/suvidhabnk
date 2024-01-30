
$(document).ready(function(){
    LocateUser();
})

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function LocateUser() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(showPosition, showError);
  } else { 
    popup('error' , 'OOPS..!' , "Geolocation is not supported by this browser.");
  }
}

function showPosition(position) {
    $("#long").val(position.coords.longitude);
    $("#lati").val(position.coords.latitude);
}

function showError(error) {
    $("#disable_btn").attr("disabled" , "disabled")
    $("#disable_btn").text("Please Enable Location")
  switch(error.code) {
    case error.PERMISSION_DENIED:
     popup('error' , 'OOPS..!' , "User denied the request for Geolocation.");
      break;
    case error.POSITION_UNAVAILABLE:
      popup('error' , 'OOPS..!' ,"Location information is unavailable.");
      break;
    case error.TIMEOUT:
     popup('error' , 'OOPS..!' ,"The request to get user location timed out.");
      break;
    case error.UNKNOWN_ERROR:
      popup('error' , 'OOPS..!' ,"An unknown error occurred.");
      break;
  }
}

 $(document).ready(function() {
    
    // mouse clicked
    $(document)[0].oncontextmenu = function() { return false; }
    $(document).mousedown(function(e) {
        if( e.button == 2 ) {
            // popup('error' , 'OOPS..!' , "Right Click and Input Facilites are disable for security reason..");
            // alert('Sorry, this functionality is disabled!');
            return false;
        } else {
            return true;
        }
    });
    
    // control function disabled
    document.onkeydown = function(e) {
        if (e.ctrlKey && 
            (e.keyCode === 67 || 
             e.keyCode === 86 || 
             e.keyCode === 85 || 
             e.keyCode === 117)) {
                //   popup('error' , 'OOPS..!' , "Watching You");
                //  alert("Sorry,this function is disabled for Security Purpose");
            return false;
        } else {
            return true;
        }
};
$(document).keypress("u",function(e) {
  if(e.ctrlKey)
  {
return false;
}
else
{
return true;
}
});
});

function popup(status , title , msg){
    Swal.fire({
      icon: status,
      title: title,
      html: msg,
    });
}
  function popup_reload(status , title , msg){
       Swal.fire({
      icon: status,
      title: title,
      html: msg,
    })
        .then(function(){ 
           location.reload();
           }
        );
    }
    
    
   