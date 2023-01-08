// Indice à incrémenter pour parcourir tableau
let indice = 0
// Tableau nombre2 dans l'ordre
let arrayNumbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
// Tableau nombre2 dans le désordre
let arrayNumbers2 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
let arrayNumbersRandom = arrayNumbers2.sort(() => Math.random() - 0.5)
// Tableau quand TABLES est sélectionner (vaut nombreselectionner)
let arrayTablesRandom1 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
let tableRandom1 = arrayTablesRandom1.sort(() => Math.random() - 0.5)
// Tableau quand TABLES est sélectionner (vaut nombre2)
let arrayTablesRandom2 = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
let tableRandom2 = arrayTablesRandom2.sort(() => Math.random() - 0.5)

// Bouton question suivante
const btn = document.getElementById('good-result')
const counterSpan = document.getElementById('counter')

// const or = document.getElementById('or')
let nombre2 = 0
let randomRange = 10
let counter = 0
// let resultScore = 0
let numberTable1 = 0
let numberTable2 = 0

// // Génère les billes jaunes / CLiquable pour vérifier le résultat
function generateBallsYellow() {
  for (let i = 1; i <= 10; i++) {

    let result = nombreSelectionner * i
    document.getElementById('choice').innerHTML += `<div class="billes"><input type="radio" value= "${result}"><label>${result}</label></div>`
  }
}
generateBallsYellow()

// Affiche la table 
function generateTableOperation() {
  for (let i = 1; i <= 10; i++) {
    let result = nombreSelectionner * i

    document.getElementById('table').innerHTML += `<div class="operation">${nombreSelectionner} x ${i} = &nbsp;<span class="results">${result}</span> <br ></div>`
  }
}
generateTableOperation()

// Lancement du jeu et vérification des conditions 
startGame()
function startGame() {
  nextNumber(indice)
  if (help == 1) {
    generateBallsGreen()
  }
  if (help == 2) {
    beforeAfter()
  }
  // Question opération
  document.getElementById('question').innerHTML = `<span>${nombreSelectionner} x ${nombre2}</span>`
  click()
}


// Génère le tableau de billes 
function generateBallsGreen() {
  const table = document.createElement('table');
  const firstColum = document.getElementById('colum')
  // const secondColum = document.getElementById('second-colum')

  firstColum.innerHTML = '';
  // secondColum.innerHTML='';
  for (let i = 0; i < nombre2; i++) {
    const row = document.createElement('tr');
    for (let j = 1; j <= nombreSelectionner; j++) {
      const col = document.createElement('td');
      col.classList.add('col-header')
      row.appendChild(col);
    }
    table.appendChild(row);
  }
  firstColum.append(table);
  // clone = table.cloneNode(true)
  // secondColum.append(clone)
}


function beforeAfter() {
  const beforeQuestion = document.getElementById('before_question')
  const afterQuestion = document.getElementById('after_question')
  beforeQuestion.innerHTML = `<span>${nombreSelectionner} x ${nombre2 - 1} = ${nombreSelectionner * `${nombre2 - 1}`}  </span>`
  afterQuestion.innerHTML = `<span>${nombreSelectionner} x ${nombre2 + 1} =  ${nombreSelectionner * `${nombre2 + 1}`}</span>`
}

// Function that checks the click, the result and the value and which adds the correct result in the table
function click() {
  const inputScoreValeur = document.querySelectorAll('input[type=radio]')
  const btn = document.getElementById('good-result')
  inputScoreValeur.forEach((elem) => {
    const parent = elem.parentNode
    elem.addEventListener("click", function (event) {
      let item = event.target.value;
      const spanResult = document.querySelectorAll('.results')
      if (item == nombreSelectionner * nombre2) {
        parent.classList.add('true')
        spanResult.forEach(result => {
          if (result.textContent == nombreSelectionner * nombre2) {
            result.classList.add('show')
            result.style.color = 'green'
          }
        })
        btn.style.display = 'block'
      }
      else {
        parent.classList.add('false')
      }
    })
  });
}
function nextNumber(indice) {
  if (indice < 10) {
    if (order == 1) {
      nombre2 = arrayNumbers[indice]
    }
    if (order == 2) {
      nombre2 = arrayNumbersRandom[indice]
    }
    if (order == 0) {
      nombreSelectionner = tableRandom1[indice]
      nombre2 = tableRandom2[indice]
      document.getElementById('choice').innerHTML = ''
      document.getElementById('table').style.display = "none"
      generateBallsYellow()
    }
    cr = true
    // indice++
  } else if (indice == 10) {
    // showScore(resultScore)
    ajaxSendScore(order, help, nombreSelectionner, resultScore)
    
  }
}

// Affichage du bouton pour passer à la question suivante
function goodResult() {
  btn.addEventListener('click', () => {
    let balls = document.querySelectorAll('.billes')
    btn.style.display = "none"
    balls.forEach((element) => {
      if (element.classList.contains('false')) {
        element.classList.remove('false')
      }
      if (element.classList.contains('true')) {
        element.classList.remove('true')
      }
    })
    if (cr == true) {
      indice++
      cr = nextNumber()
      startGame()
    }
  })
}
goodResult()

// Quand table es sélectionner probleme de counter (a voir)
// Compteur de click
function counterClick() {
  const balls = document.querySelectorAll('.billes')
  balls.forEach((element) => {
    element.addEventListener('click', function () {
      counter++
      resultScore = counter
      counterSpan.innerHTML = `Nombre de click : ${resultScore}`
      // if (counter <= 2) {
      //   
      // }
      // else if (counter > 2) {
      //   diffCount = difference(counter, 2)
      //   resultScore = 2 - diffCount
      //   if (resultScore <= 0) {
      //     resultScore = 1
      //   }
      // }
    })
  })
}
counterClick()

// calcule la difference entre le counter et 10 
// function difference(a, b) {
//   return Math.abs(a - b)
// }
function ajaxSendScore() {
  showScore()
  const donnees = {
    order: order,
    help: help,
    id: id,
    outil: outil, 
    nombreSelectionner: nombreSelectionner,
    resultScore: resultScore
  };
  //const donnees = [order, help, nombreSelectionner, resultScore];
  console.log(donnees);
  fetch('./misajourscore', {
    method: 'POST',
    mode: 'cors',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(donnees)
  })
  .then((response) => { return response.json() })
  .then(datas => {alert(datas.msg)})
  .catch((error) => console.log(error))
}


// Affichage de la modal score
function showScore() {
  const modal = document.getElementById('modal-container')
  modal.style.display = 'block'
  const viewScore = document.getElementById('viewScore')
  viewScore.innerHTML = `Tu as réussi l'activité en ${resultScore} clics.`
}