
window.onload = function(){
            

    var mail = document.getElementsByClassName("validation_mail");
    var password = document.getElementsByClassName("validation_password");
    var drop = document.getElementsByClassName("validation_drop");
    var radio = document.forms[0].rad;
    var checkbox = document.forms[0].check;
    var formhandle = document.forms.theformname;
    // var output1 = document.getElementById(//"output1");
    // var output2 = document.getElementById(//"output2");
    
    formhandle.onsubmit = processform;
    
        function processform() {
            if (mail.value === ""|| mail.value === null ) {	
                mail.style.background="red";
                mail.focus();
                return false;
            };
    
            if (password.value === ""|| password.value === null ) {	
                password.style.background="red";
                password.focus();
                return false;
            };
            // if (rad.value == ""|| rad.value == null ) {	
            //     output1.innerHTML = "Missing the radio buttons"
            //     output1.style.color = "green";
            //     output1.style.fontSize="30px";
            //     return false;
            // };
            if (drop.value == 0){
                drop.style.background="red";
                return false;
            }
            // if (check.checked == false) {
            //     output1.innerHTML = "Missing the checkbox";
            //     output1.style.color="red";
            //     output1.style.fontSize="30px";
            //     return false;
            // }
    
        
    
        // output2.innerHTML= "Thank you " + mail.value + " for filling this form!"
        // output2.style.fontSize = "60px";
        // formhandle.style.display="none";
        return false;
        }
    
    }