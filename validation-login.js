function validatelogin() {
	var email = document.getElementById("email").value;
	var pasword = document.getElementById("pasword").value;

	if(email == ""){
		document.getElementById("em").innerHTML = "Please Enter Your Email";
		return false;
	} else {
		document.getElementById("em").innerHTML = "";
	}
	
	if(pasword == ""){
        document.getElementById("ps").innerHTML = "Please Enter Your Password";
        return false;
    } else {
		document.getElementById("ps").innerHTML = "";
	}
}