function validate() {
    var name  = document.getElementById("name").value;
	var email = document.getElementById("email").value;
	var contectNo = document.getElementById("contactNo").value;
	var pasword = document.getElementById("pasword").value;
	var cpasword = document.getElementById("cpasword").value;
			
	if(name == ""){
		document.getElementById("n").innerHTML = "Please Enter Your Name";
		return false;
	} else {
		document.getElementById("n").innerHTML = "";
	}
	
	if(!isNaN(name)){
		document.getElementById("n").innerHTML = "Please Enter Characters only";
		return false;
	} else {
		document.getElementById("n").innerHTML = "";
	}

	if(email == ""){
		document.getElementById("e").innerHTML = "Please Enter Your Email";
		return false;
	} else {
		document.getElementById("e").innerHTML = "";
	}
	
	/*var emailformat = /^[a-z A-Z 0-9 \_\.\-]+\@[a-z A-Z]{2,6}[.]{1}[a￾z]{2,4}[.]{0,1}[a-z]{0,2}$/;
	if(emailformat.test(email)){
		document.getElementById("e").innerHTML = "";
	}else{
		document.getElementById("e").innerHTML = "Please Enter correct email format";
		return false;
	}*/

    if(contectNo == ""){
        document.getElementById("cno").innerHTML = "Please Enter Your Contect Number";
        return false;
    } else {
		document.getElementById("cno").innerHTML = "";
	}

    if(pasword == ""){
        document.getElementById("p").innerHTML = "Please Enter Your Password";
        return false;
    } else {
		document.getElementById("p").innerHTML = "";
	}
    
    if(cpasword == ""){
        document.getElementById("cp").innerHTML = "Please Confirm Your Password";
        return false;
    } else {
		document.getElementById("cp").innerHTML = "";
	}

    if(pasword != cpasword){
        document.getElementById("cp").innerHTML = "Password doesn't match.";
        return false;
    } else {
		document.getElementById("cp").innerHTML = "";
	}
}
