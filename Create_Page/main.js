/* 

Main.js da página Create.php

  Aqui, você encontrará algumas funções da página, como a criação de novos quadros kanban,
a edição dos nomes dos quadros, a possibilidade de excluí-los e algumas solicitaçõesAjax
para o envio de dados ao PHP.

*/


var openButton = document.getElementById("openModal");
var closeButton = document.getElementById("closeModal");

openButton.addEventListener("click", openModal);
closeButton.addEventListener("click", closeModal)

function openModal() {
  let modal = document.getElementById("myModal");
  modal.style.display = "block";
}

function closeModal() {
  let modal = document.getElementById("myModal");
  modal.style.display = "none";
}

window.onclick = function (event) {
  let modal = document.getElementById("myModal");
  if (event.target == modal)
  {
    modal.style.display = "none";
  }
}

document.addEventListener("DOMContentLoaded", function () {
  var deleteButton = document.querySelectorAll(".delete-button");
  deleteButton.forEach(function (button) {
    button.addEventListener("click", deleteFrame);
  });
});

function deleteFrame() {
  if (confirm("Tem certeza de que deseja excluir este card?"))
  {
    let divCard= this.parentElement;
    let frame = divCard.parentElement;
    frame.remove();
    let getId = frame.getAttribute("id");
    let id_frame = getId.replace("quadro", "");

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "Delete_frame.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    let data = "id_frame=" + encodeURIComponent(id_frame);
    xhr.onreadystatechange = function () {
      if (xhr.readyState === 4)
      {
        if (xhr.status === 200)
        {
          frame.remove();
        }
        else
        {
          console.error("Erro na exclusão do card:", xhr.status, xhr.responseText);
        }
      }
    };
    xhr.send(data);
  }
}

document.addEventListener("DOMContentLoaded", function () {
  let updateButton = document.querySelectorAll(".update-button");
  updateButton.forEach(function (button) {
    button.addEventListener("click", updateFrame);
  });
});

function updateFrame() {
  let button = this;
  let frame = button.closest('.quadro');
  let frameText = frame.querySelector('.TitleFrame');
  let getId = frame.getAttribute("id");
  let id_frame = getId.replace("quadro", "");
  let newText = prompt('Digite o novo nome do card:', frameText.textContent);
  if (newText !== null)
  {
    frameText.textContent = newText;

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "Update_frame.php", true);
    xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    let data = "id_frame=" + encodeURIComponent(id_frame) + "&newText=" + encodeURIComponent(newText);
    xhr.send(data);
  }
  else
  {
    alert("Campo está vazio ou você cancelou a troca de nome!");
  }
} 
    
  
