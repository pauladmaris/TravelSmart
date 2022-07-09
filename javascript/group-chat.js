const form_group = document.querySelector(".group-typing-area"),
msg_location = form_group.querySelector(".msg_location").value,
inputField2 = form_group.querySelector(".group_msg_field"),
sendBtn2 = form_group.querySelector("button"),
chatBox2 = document.querySelector(".chatBox");


form_group.onsubmit = (e) => {
    e.preventDefault();
}

inputField2.focus();
inputField2.onkeyup = ()=>{
    if(inputField2.value != ""){
        sendBtn2.classList.add("active");
    } else {
        sendBtn2.classList.remove("active");
    }
}

sendBtn2.onclick = ()=>{
    let xhr_group = new XMLHttpRequest();
    xhr_group.open("POST", "php-chat/insert-group-chat.php", true);
    xhr_group.onload = ()=>{
      if(xhr_group.readyState === XMLHttpRequest.DONE){
          if(xhr_group.status === 200){
              inputField2.value = "";
              scrollToBottom();
          }
      }
    }
    let formData = new FormData(form_group);
    xhr_group.send(formData);
}

chatBox2.onmouseenter = ()=>{
    chatBox2.classList.add("active");
}

chatBox2.onmouseleave = ()=>{
    chatBox2.classList.remove("active");
}

setInterval(() =>{
    let xhr_group = new XMLHttpRequest();
    xhr_group.open("POST", "php-chat/get-group-chat.php", true);
    xhr_group.onload = ()=>{
      if(xhr_group.readyState === XMLHttpRequest.DONE){
          if(xhr_group.status === 200){
            let data = xhr_group.response;
            chatBox2.innerHTML = data;
            if(!chatBox2.classList.contains("active")){
                scrollToBottom();
             }
          }
      }
    }
    xhr_group.setRequestHeader("Content-type", "application/x-www-form_group-urlencoded");
    xhr_group.send("msg_location="+msg_location);
}, 500);

function scrollToBottom(){
    chatBox2.scrollTop = chatBox2.scrollHeight;
}

function showGroupChat() {
    var x = document.getElementById("groupChat");

    if(x.style.display == 'none'){
      x.style.display = 'block';
      var element = document.querySelector("#groupChat");
      element.scrollIntoView();
    } 
    return false; 
}