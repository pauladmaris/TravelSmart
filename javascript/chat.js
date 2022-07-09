const form = document.querySelector(".typing-area"),
incoming_id = form.querySelector(".incoming_id").value,
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("button"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e)=>{
    e.preventDefault();
}

inputField.focus();
inputField.onkeyup = ()=>{
    if(inputField.value != ""){
        sendBtn.classList.add("active");
    } else {
        sendBtn.classList.remove("active");
    }
}

sendBtn.onclick = ()=>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php-chat/insert-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
              inputField.value = "";
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}
chatBox.onmouseenter = ()=>{
    chatBox.classList.add("active");
}

chatBox.onmouseleave = ()=>{
    chatBox.classList.remove("active");
}

setInterval(() =>{
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "php-chat/get-chat.php", true);
    xhr.onload = ()=>{
      if(xhr.readyState === XMLHttpRequest.DONE){
          if(xhr.status === 200){
            let data = xhr.response;
            chatBox.innerHTML = data;
            if(!chatBox.classList.contains("active")){
                scrollToBottom();
             }
          }
      }
    }
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhr.send("incoming_id="+incoming_id);
}, 500);

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}
  
function showCloseChat() {
    var x = document.getElementById("users");
    var y = document.getElementById("chatArea");

    if(x.style.display == 'none'){
        x.style.display = 'block';
        y.style.display = 'none';
        //clear string in URL using jQuery
        $(document).ready(function(){
        var uri = window.location.toString();
        if (uri.indexOf("?") > 0) {
            var clean_uri = uri.substring(0, uri.indexOf("?"));
            window.history.replaceState({}, document.title, clean_uri);
        }
        });
    } else {
        x.style.display = 'none';
        y.style.display = 'block';
    }
    return false;
}

function showCloseUsers() {
    var x = document.getElementById("users");

    if(x.style.display == 'none'){
        x.style.display = 'block';
    } else {
        x.style.display = 'none';
    }
    
    //clear string in URL using jQuery
    $(document).ready(function(){
        var uri = window.location.toString();
        if (uri.indexOf("?") > 0) {
            var clean_uri = uri.substring(0, uri.indexOf("?"));
            window.history.replaceState({}, document.title, clean_uri);
        }
    });
    return false;
}

function closeChat() {
    var x = document.getElementById("chatArea");

    if(x.style.display == 'block'){
        x.style.display = 'none';
    }
    
    //clear string in URL using jQuery
    $(document).ready(function(){
        var uri = window.location.toString();
        if (uri.indexOf("?") > 0) {
            var clean_uri = uri.substring(0, uri.indexOf("?"));
            window.history.replaceState({}, document.title, clean_uri);
        }
    
    });
    return false;
}

function showChat() {
    var x = document.getElementById("chatArea");

    if(x.style.visibility == 'hidden') {
        x.style.visibility = 'visible';
    }

    return false;
}

function closeError() {
    var x = document.getElementById("error2");

    if(x.style.display == 'none'){
        x.style.display = 'block';
    }
    else {
        x.style.display = 'none';
    }

    return false;
}


function upper(str) {
    return str && str[0].toUpperCase() + str.slice(1);
}

