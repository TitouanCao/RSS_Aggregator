const [red, green, blue] = [255, 165, 0]
const scroller_row = document.getElementsByClassName("scroller")[1]
const scroller_compact = document.getElementsByClassName("scroller")[0]
const small_spacers = document.getElementsByClassName("small-spacer")
const spacers = document.getElementsByClassName("spacer")
let max = window.innerHeight


adjust_herald_position()
adjust_font_size()
color_spacers()
set_header_row()
set_header_compact();
set_compact_td_size()

window.onload = function() {
  var cookie = decodeURIComponent(document.cookie).split(';')
  for (var i = 0; i < cookie.length; i++) {
    if (cookie[i] == "mode=compact") switch_mode(true)
  }

  let body = document.getElementsByTagName("body")
  for (var i = 0; i < body.length; i++) {
    body[i].style.opacity = "1"
  }
}

/*------------------------------------------*/

function adjust_font_size() {
  let text = document.getElementById("switcher-text-p")
  let nbCharacters = text.innerHTML.length + 1
  text.style.fontSize = (window.innerHeight*0.9)/nbCharacters+"px"
}

function adjust_herald_position() {
  let herald = document.getElementById("herald")
  herald.style.left = -document.getElementById("herald-core").offsetWidth+"px"
}

function color_spacers() {
  for (var i = 0; i < small_spacers.length; i++) {
    let position = small_spacers[i].offsetTop - scroller_row.scrollTop
    if (position > 0 && position < max) {
      position = position / (max / 3)
      let [r, g, b] = [red, green/position, blue/position].map(Math.round)
      small_spacers[i].style.backgroundColor = "rgb("+r+","+g+","+b+")"
    }
  }

  for (var i = 0; i < spacers.length; i++) {
    let position = spacers[i].offsetTop - scroller_row.scrollTop
    if (position > 0 && position < max) {
      position = position / (max / 3)
      let [r, g, b] = [red, green/position, blue/position].map(Math.round)
      spacers[i].style.backgroundColor = "rgb("+r+","+g+","+b+")"
    }
  }
}

function set_header_row() {
  if (scroller_row.scrollTop == 0) {
    let header = document.getElementsByClassName("row-th")
    for (var i = 0; i < header.length; i++) {
      header[i].style.backgroundColor = '#fff828'
      header[i].style.padding = "25px"
    }
  }
  else {
    let header = document.getElementsByClassName("row-th")
    for (var i = 0; i < header.length; i++) {
      header[i].style.backgroundColor = 'white'
      header[i].style.paddingTop = "10px"
      header[i].style.paddingBottom = "10px"
    }
  }
}

function set_header_compact() {
  if (scroller_compact.scrollTop == 0) {
    let header = document.getElementsByClassName("compact-th")
    for (var i = 0; i < header.length; i++) {
      header[i].style.backgroundColor = '#fff828'
      header[i].style.padding = "25px"
    }
  }
  else {
    let header = document.getElementsByClassName("compact-th")
    for (var i = 0; i < header.length; i++) {
      header[i].style.backgroundColor = 'white'
      header[i].style.paddingTop = "10px"
      header[i].style.paddingBottom = "10px"
    }
  }
}

function set_compact_td_size() {
  let tds = document.getElementsByClassName("compact-td")
  for (var i = 0; i < tds.length; i++) {
    let max = 0;
    for (var j = 0; j < tds[i].children.length; j++) {
      if (tds[i].children[j].children[1].offsetHeight > max) {
        max = tds[i].children[j].children[1].offsetHeight;
      }
    }
    tds[i].style.height = tds[i].children.length*50 + (max*1.5)  + "px"
  }
}




function hide_message() {
  let msgs = document.getElementsByClassName("message")
  for (var i = 0; i < msgs.length; i++) {
    msgs[i].style.display = "none"
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


window.setInterval('clickCount=0', 1000);
let clickCount = 0;
function hide_err_msg() {
  clickCount++
  if (clickCount == 2) {
    let elements = document.getElementsByClassName("error-msg")
    for (var i = 0; i < elements.length; i++) {
      elements[i].style.display = "none"
    }
  }
}

function stop_err_animation() {
  let msg = document.getElementsByClassName("error-msg")
  let stp = document.getElementsByClassName("err-stop")
  for (var i = 0; i < msg.length; i++) {
    msg[i].style.animation = "none"
    msg[i].style.backgroundColor = "#ff29e5"
    msg[i].style.color = "blue"
  }
  for (var i = 0; i < stp.length; i++) {
    stp[i].innerHTML = "<3"
  }
}

let mode = "row"
function switch_mode(quick = false) {
  let compact = document.getElementById("compact-container")
  let row = document.getElementById("row-container")
  if (quick == false) {
    compact.style.transition = "1s opacity"
    row.style.transition = "1s opacity"
  }
  if (mode == "row") {
    compact.style.opacity = "1"
    compact.style.zIndex = "-10"
    row.style.opacity = "0"
    row.style.zIndex = "-11"
    mode = "compact"
    document.cookie = "mode=compact";
  }
  else {
    compact.style.opacity = "0"
    compact.style.zIndex = "-11"
    row.style.opacity = "1"
    row.style.zIndex = "-10"
    mode = "row"
    document.cookie = "mode=row";
  }
}

function fold(element) {
  element.style.height = "60px"
  element.style.overflow = "hidden"
}

function unfold(element) {
  let child = element.children[1]
  element.style.height = child.offsetHeight+"px"
  element.style.overflow = "visible"
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

function top_function() {
  let elements = document.getElementsByClassName("scroller")
  Array.prototype.forEach.call(elements, function(elements) {
    elements.scrollTop = 0
  });
}

function unclick_picker() {
  let picker = document.getElementById("picker")
  let arrow = document.getElementById("picker-arrow")
  picker.style.top = "-20px"
  picker.style.left = "-200px"
  picker.style.backgroundColor = ""
  arrow.style.opacity = "1"
  arrow.style.transition = "0.3s opacity 0.3s, 0.2s width"
}

function onclick_picker() {
  let picker = document.getElementById("picker")
  let arrow = document.getElementById("picker-arrow")
  picker.style.top = "0"
  picker.style.left = "0"
  picker.style.backgroundColor = "#fff828"
  arrow.style.opacity = "0"
  arrow.style.transition = "0.3s opacity, 0.2s width"
}

function unclick_adder() {
  let adder = document.getElementById("adder")
  let arrow = document.getElementById("adder-arrow")
  adder.style.bottom = "-200px"
  adder.style.left = "-260px"
  adder.style.backgroundColor = ""
  arrow.style.opacity = "1"
  arrow.style.transition = "0.3s opacity 0.3s, 0.2s width"
}

function onclick_adder() {
  let adder = document.getElementById("adder")
  let arrow = document.getElementById("adder-arrow")
  adder.style.bottom = "0"
  adder.style.left = "0"
  adder.style.backgroundColor = "#fe3232"
  arrow.style.opacity = "0"
  arrow.style.transition = "0.3s opacity, 0.2s width"
}

document.addEventListener('click', function(e) {
  let picker = document.getElementById("picker")
  let adder = document.getElementById("adder")
  let herald = document.getElementById("herald")
    if (e.target.className == 'adder-input my_inputs' || e.target.className == 'adder-form') {
      onclick_adder()
      unclick_picker()
    }
    else if (e.target.className == 'picker-input my_inputs' || e.target.className == 'picker-form') {
      unclick_adder()
      onclick_picker()
    }
    else if (e.target.id == 'herald-arrow' || e.target.id == 'herald-core' ||
     e.target.closest("div").id == 'herald-core' ||
     e.target.closest("div").id == 'herald-name') {
      herald.style.left = "0"
      document.getElementById("herald-horn").style.display = "none"
    }
    else {
      unclick_adder()
      unclick_picker()
      document.getElementById("herald-horn").style.display = "block"
      herald.style.left = -document.getElementById("herald-core").offsetWidth+"px"
    }
}, false);


window.addEventListener("resize", function(e){
  adjust_font_size()
  setTimeout(function() {
    adjust_herald_position()
    max = window.innerHeight
    color_spacers()
  }, 700);
}, false);

scroller_row.addEventListener("scroll", function(e) {
  color_spacers()
  set_header_row();
}, false);

scroller_compact.addEventListener("scroll", function(e) {
  set_header_compact();
}, false);
