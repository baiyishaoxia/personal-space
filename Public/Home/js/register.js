
function checkLength(){
    var password=document.getElementById("password"); //获取密码框值
    if(password.value.length<6){
         document.getElementById("errorpwd1").style.display = "block";
    }else
		 document.getElementById("errorpwd1").style.display = "none";
  }



function checkPass(){
  var pwd1=document.getElementById("password").value;
  var pwd2=document.getElementById("password2").value;
   if(pwd1 != pwd2){
       document.getElementById("errorpwd2").style.display = "block";
  }else
	   document.getElementById("errorpwd2").style.display = "none";
}

function useremail(){
    var useremail=document.getElementById("user_email").value;
    document.getElementById("email").value=useremail;
}
