/* 

Main.js da página Kanban.php

  Aqui, você encontrará algumas funções da página, como a criação de novos cards pelo botão +Card, 
a parte principal do kanban, fazendo uso do "drag and drop", funções de checagem como a que pega
o último ID do banco para gerar o próximo card (o qual foi criado para prevenir a criação de cards
com o mesmo ID) e algumas solicitações Ajax para o envio de dados para o PHP no banco de dados.

*/

var btnElement = document.querySelector('button.addCard');
btnElement.addEventListener("click", function (ev)
{
  getUltimoId(ev, criarQuadrado);
});

function getUltimoId(ev, callback)
{
  let xhr = new XMLHttpRequest();
  xhr.open('GET', 'Get_card_Id.php', true);
  xhr.onreadystatechange = function ()
  {
    if (xhr.readyState == 4)
    {
      if (xhr.status == 200)
      {
        let last_id = parseInt(xhr.responseText);
        console.log("Último ID retornado:", last_id);
        callback(ev, last_id);
      }
      else
      {
        console.error("Erro na requisição à API:", xhr.status);
      }
    }
  }
  xhr.send();
}

function criarQuadrado(ev, last_id) {
  let i = last_id + 1;

  const urlParams = new URLSearchParams(window.location.search);
  const kanbanId = urlParams.get('id');

  let cardContainer = document.createElement('div');
  cardContainer.className = 'card-container';
  cardContainer.draggable = 'true';
  cardContainer.setAttribute('ondragstart', 'moverquadro(event)');
  cardContainer.setAttribute('status', 'fazer');
  cardContainer.id = i;

  let newCard = document.createElement('textarea');
  newCard.rows = '4';
  newCard.cols = '40';
  newCard.id = "card" + i;
  newCard.className = 'divTextArea';
  
  let id_card = i;
  
  let deleteButton = document.createElement('button');
  deleteButton.className = 'delete-button';
  deleteButton.innerHTML = '<img class="delete-img" src="Create_Page/img/icon-delete.png"/>';

  cardContainer.appendChild(newCard);
  cardContainer.appendChild(deleteButton);

  if (ev.target.id === 'fazendo')
  {
    newCard.setAttribute('status', 'fazendo');
    document.querySelector('#fazendo').appendChild(cardContainer);
  }
  else if (ev.target.id === 'feito')
  {
    newCard.setAttribute('status', 'feito');
    document.querySelector('#feito').appendChild(cardContainer);
  }
  else
  {
    newCard.setAttribute('status', 'fazer');
    document.querySelector('#fazer').appendChild(cardContainer);
  }

  newCard.addEventListener('blur', function() {
    outArea(id_card, newCard.value);
  });

  var cardData = {
    nm_card: id_card,
    id_kanban: kanbanId,
  };

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "Salvar_card.php", true);
  xhr.setRequestHeader("Content-type", "application/json");
  let jsonData = JSON.stringify(cardData);
  xhr.send(jsonData);
}


function comecar(ev)
{ 
  ev.preventDefault();
}

function moverquadro(ev)
{
  ev.dataTransfer.setData("text/plain", ev.target.id);
}


function parar(ev)
{
  ev.preventDefault();
  let sourceId = ev.dataTransfer.getData("text/plain");
  let sourceContainer = document.getElementById(sourceId);
  let status = '';

  if (sourceContainer !== null)
  {
    if (ev.target.id === 'fazendo')
    {
      status = 'fazendo';
    }
    else if (ev.target.id === 'feito')
    {
      status = 'feito';
    }
    else
    {
      status = 'fazer';
    }

    if (status !== '' && sourceContainer.getAttribute('status') !== status)
    {
      if (status === 'fazendo')
      {
        document.querySelector('#fazendo').appendChild(sourceContainer);
      }
      else if (status === 'feito')
      {
        document.querySelector('#feito').appendChild(sourceContainer);
      }
      else
      {
        document.querySelector('#fazer').appendChild(sourceContainer);
      }

      sourceContainer.setAttribute('status', status);
      let id_card = sourceId.replace("card", "");
      AttStatus(id_card, status);
    }
  }
}

function outArea(id_card, texto)
{
  saveData(id_card, texto);
}
  
function saveData(idCard, texto)
{
  let xhr = new XMLHttpRequest();
  xhr.open('POST', 'Salvar_texto.php', true);
  xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  const data = 'id_card=' + encodeURIComponent(idCard) + '&texto=' + encodeURIComponent(texto);
  xhr.send(data);
}

function AttStatus(cardId, novoStatus)
{
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "Att_status.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  const data = "id_card=" + encodeURIComponent(cardId) + "&novo_status=" + encodeURIComponent(novoStatus);
  xhr.send(data);
}

document.addEventListener("DOMContentLoaded", function () {
  let deleteButtons = document.querySelectorAll(".delete-button");
  deleteButtons.forEach(function (button) {
    button.addEventListener("click", function () {
      deleteCard(button);
    });
  });
});

function deleteCard(button)
{
  let cardContainer = button.parentElement;
  let cardId = cardContainer.getAttribute("id");
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "Delete_card.php", true);
  xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  var data = "id_card=" + cardId;
  xhr.onreadystatechange = function ()
  {
    if (xhr.readyState === 4)
    {
      if (xhr.status === 200)
      {
        console.log("Card excluído com sucesso.");
        cardContainer.remove();
      }
      else
      {
        console.error("Erro na exclusão do card:", xhr.status, xhr.responseText);
      }
    }
  };
  xhr.send(data);
}
