function login_page(formid, id1, id2) {
    var email = document.getElementById(id1).value;
    var password = document.getElementById(id2).value;
    if ((email.trim() == "" || password.trim() == "")) {
        toastr.warning('Please Provide Valid Email Address & Password', 'Sorry');
    }
    else {
        var mailFormat = /\S+@\S+\.\S+/;
        if (!email.match(mailFormat)) {
            toastr.warning('Please Provide Valid Email Address', 'Sorry');
        }
        else {
            formid.submit();
        }
    }
}
function RegisterPage(id1, id2, id3, id4, id5) {
    var fname = document.getElementById(id1).value;
    var lname = document.getElementById(id2).value;
    var email = document.getElementById(id3).value;
    var pass1 = document.getElementById(id4).value;
    var pass2 = document.getElementById(id5).value;
    if (fname.trim() == "" || lname.trim() == "" || email.trim() == "" || pass1.trim() == "" || pass2.trim() == "") {
        toastr.warning('Please Fill Up All The Fields', 'Sorry');
        return false;
    }else
    {
        var mailFormat = /\S+@\S+\.\S+/;
        if (!email.match(mailFormat)) {
            toastr.warning('Please Provide Valid Email', 'Sorry');
            return false;
        }
        else if(pass1 != pass2)
        {
            toastr.warning('Password & Confirm Password Doesn\'t Match', 'Sorry');
            return false;
        }
        else if(document.getElementById("email-er").value != "")
        {
            toastr.warning('This Email is already Exist', 'Sorry');
            return false;
        }
        else {
            return true;
        }
    }
}

function Check_Email()
{
    var email = document.getElementById("sign-email").value;
    var obj = new XMLHttpRequest();
    obj.onreadystatechange = function()
    {
        if(obj.status == 200 && obj.readyState == 4)
        {
            if(obj.responseText == 1)
            {
                document.getElementById("email-er").value = "Find";
            }
            else
            {
                document.getElementById("email-er").value = "";

            }
        }
    }
    obj.open("POST","admin/edit_cat.php",true);
    obj.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    obj.send("email="+email);
}