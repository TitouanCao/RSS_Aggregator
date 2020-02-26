
window.onload = function(){
  var cookie = decodeURIComponent(document.cookie).split(';')
  for (var i = 0; i < cookie.length; i++) {
    if (cookie[i] == "mode=compact") switch_mode(true)
  }


  let body = document.getElementsByTagName("body")
  for (var i = 0; i < body.length; i++) {
    body[i].style.opacity = "1"
  }

  let spacers = document.getElementsByClassName("spacer")
  for (var i = 0; i < spacers.length; i++) {
    spacers[i].style.backgroundColor = get_nice_color();
  }

  let cells = document.getElementsByClassName("compact-td")
  for (var i = 0; i < cells.length; i++) {
    cells[i].style.backgroundColor = get_rand_color();
  }

}


function get_rand_color() {
  let carac = "0123456789ABCDEF"
  let res = "#"
  for (var i = 0; i < 6; i++) {
    res = res + carac[Math.floor(Math.random()*16)]
  }
  return res;
}

function get_nice_color() {
  let nice_colors = ["#eedc6c", "#44ed3f", "#6a78f5", "#ea6af5", "#f56a6a", "#6af5cb"]
  return nice_colors[Math.floor(Math.random()*nice_colors.length)]
}


window.setInterval('clickCount=0', 2000);
let clickCount = 0;
function hide_err_msg() {
  clickCount++
  if (clickCount == 3) {
    let elements = document.getElementsByClassName("error-msg")
    for (var i = 0; i < elements.length; i++) {
      elements[i].style.display = "none"
    }
  }
}

let mode = "row"
function switch_mode(quick = false) {
  let compact = document.getElementById("compact-container")
  let row = document.getElementById("row-container")
  if (quick == false) {
    console.log("oui")
    compact.style.transition = "1s"
    row.style.transition = "1s"
  }
  if (mode == "row") {
    compact.style.left = "0"
    row.style.left = "100vw"
    compact.style.opacity = "1"
    row.style.opacity = "0"
    mode = "compact"
    document.cookie = "mode=compact";
  }
  else {
    compact.style.left = "100vw"
    row.style.left = "0"
    compact.style.opacity = "0"
    row.style.opacity = "1"
    mode = "row"
    document.cookie = "mode=row";
  }
}


function switch_audio(element) {
  let childrens = document.getElementById(element).parentNode.children
  for (var i = 0; i < childrens.length; i++) {
    if (childrens[i].className == "audio-icon") {
      let img = childrens[i].children
      for (var j = 0; j < img.length; j++) {
        if (img[j].tagName == "IMG") {
          let filepath = document.URL.split('?')[0]
          if (img[j].src == filepath + resourcesLocation + "pause.png")  img[j].src = resourcesLocation + "play.png"
          else if (img[j].src == filepath + resourcesLocation + "play.png") img[j].src = resourcesLocation + "pause.png"
        }
      }
    }

    if (childrens[i].tagName == "AUDIO") {
      if (childrens[i].paused) childrens[i].play();
      else childrens[i].pause();
    }
  }
}


document.addEventListener('click', function(e) {
  let picker = document.getElementById("picker")
  let adder = document.getElementById("adder")
    if (e.target.className == 'adder-input' || e.target.className == 'adder-form') {
      adder.style.bottom = "0"
      adder.style.left = "0"
      picker.style.top = "-30px"
      picker.style.left = "-180px"
    }
    else if (e.target.className == 'picker-input' || e.target.className == 'picker-form') {
      picker.style.top = "0"
      picker.style.left = "0"
      adder.style.bottom = "-160px"
      adder.style.left = "-260px"
    }
    else {
      adder.style.bottom = "-160px"
      adder.style.left = "-260px"
      picker.style.top = "-30px"
      picker.style.left = "-180px"
    }
}, false);
