<script type="text/javascript">

var jsvar = <?php echo json_encode($fval); ?>;


if (jsvar > 47 && jsvar < 195  ) {
     document.getElementById('glow').onclick = illuminateGreen;
} else if (jsvar> 195 && jsvar < 251) {
     document.getElementById('glow').onclick = illuminateYellow;
} else {
document.getElementById('glow').onclick = illuminateRed;
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
</script>