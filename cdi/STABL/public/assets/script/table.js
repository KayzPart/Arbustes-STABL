// Améliorer la fonction du compteur de click


let arrayNumbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
let arrayNumbersRandom = arrayNumbers.sort(() => Math.random() - 0.5)

const btn = document.getElementById('good-result')
const or = document.getElementById('or')
let nombre2 = 1
let randomRange = 11
let counter = 0
let resultScore



let myFunction = function () {
  for (let i = 1; i <= 10; i++) {

    let result = nombreSelectionner * i
    document.getElementById('choice').innerHTML += `<div class="billes"><input type="radio" value= "${result}"><label>${result}</label></div>`
  }
}
myFunction()


for (let i = 1; i <= 10; i++) {
  let result = nombreSelectionner * i

  document.getElementById('table').innerHTML += `<div class="operation">${nombreSelectionner} x ${i} = &nbsp;<span class="results">${result}</span> <br ></div>`
}

startGame()
function startGame() {
  if (order == 1 && help == 1) {
    generateBallsGreen()
    or.style.display = 'block'
  }
  else if (order == 1 && help == 2) {
    table()
  }
  else if (order == 2 && help == 1) {
    randomNumber()
    generateBallsOutOfOrder()
    or.style.display = 'block'
  }
  else if (order == 2 && help == 2) {
    randomNumber()
    tableOutOfOrder()
  }
  // Question opération
  document.getElementById('question').innerHTML = `<span>${nombreSelectionner} x ${nombre2}</span>`
  click()

}

// function tableOutOfOrder() {
//   const spanResult = document.querySelectorAll('.results')
//   
// }

function generateBallsGreen() {
  const table = document.createElement('table');
  const firstColum = document.getElementById('colum')
  const secondColum = document.getElementById('second-colum')

  for (let i = 0; i < nombre2; i++) {
    const row = document.createElement('tr');
    for (let j = 1; j <= nombreSelectionner; j++) {
      const col = document.createElement('td');
      col.classList.add('col-header')
      row.appendChild(col);
    }
    table.appendChild(row);
    break
  }
  firstColum.append(table);
  clone = table.cloneNode(true)
  secondColum.append(clone)
}

function table() {
  const spanResult = document.querySelectorAll('.results')
  let i = 1
  for (i = 1; i <= nombre2; i++) {
    if (i == 10) {
      break
    }
    spanResult[i].classList.add('show')

    if (i == nombre2 - 1) {
      spanResult[i].classList.remove('show')
    }
  }
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

// Affichage de la modal score
function showScore() {
  const modal = document.getElementById('modal-container')
  modal.style.display = 'block'
  const viewScore = document.getElementById('viewScore')
  viewScore.innerHTML = `Score : ${resultScore} / 10`
  document.getElementById('finalScore').innerHTML = `<input type="hidden" name="score_valeur" value="${resultScore}"><input type="submit" name="submit" id="scoreSubmit"  value="Bien joué ! Enregistre ton score 🏆">`
}

// Affichage du bouton pour passer à la question suivante
function goodResult() {
  btn.addEventListener('click', () => {
    let ballsGreen = document.querySelectorAll('.billes')
    btn.style.display = "none"
    ballsGreen.forEach((element) => {
      if (element.classList.contains('false')) {
        element.classList.remove('false')
      }
      if (element.classList.contains('true')) {
        element.classList.remove('true')
      }
    })
    if(nombre2 < 10){
      nombre2++
      startGame()
    } 
    else if(nombre2 == 10){
      showScore(resultScore)
    }
    
  })
}
goodResult()

// Compteur de click
function counterClick(){
  let ballsGreen = document.querySelectorAll('.billes')
  ballsGreen.forEach((element) => {
    element.addEventListener('click', function () {
      counter++
      console.log(counter)
      if(counter > 10){
        resultScore = difference(10, counter)
        console.log(resultScore)
        return resultScore
      }
      else{
        resultScore = counter
      }
    })
  })
}
counterClick()

// calcule la difference entre le counter et 10 
function difference(a, b){
  return Math.abs(a - b)
}


function randomNumber() {
  const inputScoreValeur = document.querySelectorAll('input[type=radio]')
  let numbers = arrayNumbers.sort(() => Math.random() - 0.5)
  nombre2 = numbers.pop()
  inputScoreValeur.forEach((elem) => {
    elem.addEventListener('click', function (event) {
      let item = event.target.value
      if (item == nombreSelectionner * nombre2) {
        arrayNumbers.indexOf(nombre2)
      }
    })
  })
}