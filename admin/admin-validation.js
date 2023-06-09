function AddCategory(id1) {
    var name = document.getElementById(id1).value;
    var status = document.querySelector('input[name="status"]:checked');
    var er = document.getElementById("error").value;

    if (status == null || name.trim() == "") {
        toastr.warning('Please Provide Name or Status', 'Sorry');
        return false;
    }
    else {
        if (er.trim() == "") {
            return true;
        }
        else {
            toastr.warning('This category is already exist', 'Sorry');
            return false;
        }
    }
}

function Check_name(id) {
    var name = document.getElementById(id).value;
    var obj = new XMLHttpRequest();
    obj.onreadystatechange = function () {
        if (obj.status == 200 && obj.readyState == 4) {
            if (obj.responseText == 1) {
                document.getElementById("error").value = "Find";
            }
            else {
                document.getElementById("error").value = "";

            }
        }
    }
    obj.open("GET", "edit_cat.php?cat_name=" + name, true);
    obj.send();
}

function AddPost(id1, id2, id3, id4,id5) {
    var cat = document.getElementById(id1).value;
    var title = document.getElementById(id2).value;
    var msg = document.getElementById(id3).value;
    var img = document.getElementById(id4).value;
    var status = document.querySelector('input[name="'+id5+'"]:checked');
    if (status == null || cat == "Select Category" || msg.trim() == "" || title.trim() == "" || img.trim() == "") {
        toastr.warning('Please fill up all the fields', 'Sorry');
        return false;
    }
    else
    {
        return true;
    }
}

function EditPost(id2, id3) {
    var title = document.getElementById(id2).value;
    var msg = document.getElementById(id3).value;
    if (msg.replace( /(<([^>]+)>)/ig, '') == "" || title.replace( /(<([^>]+)>)/ig, '') == "" ) {
        toastr.warning('Please fill up all the fields', 'Sorry');
        return false;
    }
    else
    {
        return true;
    }
}