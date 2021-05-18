
function showName(str){

    if (str.length == 0){ //exit function if nothing has been typed in the textbox

        document.getElementById("txtName").innerHTML=""; //clear previous results

        return;

    }

    if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari

        xmlhttp=new XMLHttpRequest();

    } else {// code for IE6, IE5

        xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

    }

    xmlhttp.onreadystatechange=function() {

        if (xmlhttp.readyState == 4 && xmlhttp.status == 200){

            document.getElementById("txtName").innerHTML=xmlhttp.responseText;

        }

    }

    xmlhttp.open("GET","frameworks.php?name="+str,true);

    xmlhttp.send();

}

if (window.XMLHttpRequest) {// code for IE7+, Firefox, Chrome, Opera, Safari

    xmlhttp=new XMLHttpRequest();
    console.log("Hello!")
} else {// code for IE6, IE5

    xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");

}

console.log(xmlhttp.responseText);

var cookies = document.cookie.split(";").
map(function(el){ return el.split("="); }).
reduce(function(prev,cur){ prev[cur[0]] = cur[1];return prev },{});

console.log(cookies["bus_headers"]);