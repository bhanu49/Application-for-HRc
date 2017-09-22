
function CallButton()
{
   document.getElementById("glow").click();    
}
setTimeout("CallButton()",1500)


//encode php variables to js 

var jsvar = <?php echo json_encode($fval); ?>;
var js_qty = <?php echo json_encode($ID2); ?>;

//check for kraft
if (js_qty == 19) {
if (jsvar > 47 && jsvar < 195  ) {
     document.getElementById('glow').onclick = illuminateGreen;
} else if (jsvar> 195 && jsvar < 251) {
     document.getElementById('glow').onclick = illuminateYellow;
} else {
document.getElementById('glow').onclick = illuminateRed;
}
}

//check for energy arbiet
if (js_qty == 1) {
if (jsvar > 1.5 && jsvar < 10  ) {
     document.getElementById('glow').onclick = illuminateGreen;
}else {
document.getElementById('glow').onclick = illuminateRed;
}
}

//check for Druck
if (js_qty == 5) {
if (jsvar > 32 && jsvar < 115 ) {
     document.getElementById('glow').onclick = illuminateGreen;
} else if (jsvar> 115 && jsvar < 324) {
     document.getElementById('glow').onclick = illuminateYellow;
} else {
document.getElementById('glow').onclick = illuminateRed;
}
}

//check for Drehmoment

if (js_qty == 4) {
if (jsvar > 60 && jsvar < 89  ) {
     document.getElementById('glow').onclick = illuminateGreen;
} else {
document.getElementById('glow').onclick = illuminateRed;
}
}



function illuminateRed() {
  clearLights();
  document.getElementById('stopLight').style.backgroundColor = "red";
}

function illuminateYellow() {
  clearLights();
  document.getElementById('slowLight').style.backgroundColor = "#ffc900";
}

function illuminateGreen() {
  clearLights();
  document.getElementById('goLight').style.backgroundColor = "#5db046";
}

function clearLights() {
  document.getElementById('stopLight').style.backgroundColor = "#6f7e8e";
  document.getElementById('slowLight').style.backgroundColor = "#6f7e8e";
  document.getElementById('goLight').style.backgroundColor = "#6f7e8e";
}
document.querySelector(".trigger").onclick()