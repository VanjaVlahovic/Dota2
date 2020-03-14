var xmlHttp;
function FindName(name){ 
xmlHttp=GetXmlHttpObject();
if (xmlHttp==null){
 alert ("Browser does not support HTTP Request")
 return
 }
 
var url="findByName.php";
url=url+"?name="+name;
url=url+"&sid="+Math.random();
xmlHttp.onreadystatechange=stateChanged; 
xmlHttp.open("GET",url,true);
xmlHttp.send(null);
}

function stateChanged(){ 

if (xmlHttp.readyState==4){ 
 document.getElementById("profilediv").innerHTML=xmlHttp.responseText;
 document.getElementById("profilediv").style.display="block";
 document.getElementById("profilediv").style.border="0px solid";
 } 
}

function GetXmlHttpObject(){
var xmlHttp=null;
try {
 // Firefox, Opera 8.0+, Safari
 xmlHttp=new XMLHttpRequest();
 } catch (e) {
 //Internet Explorer
 try {
  xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
  } catch (e) {
  xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
 }
return xmlHttp;
}
