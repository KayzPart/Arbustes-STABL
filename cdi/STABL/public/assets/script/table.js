let arrayNumbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
let arrayNumbersRandom = arrayNumbers.sort(() => Math.random() - 0.5)
console.log(arrayNumbersRandom)

const btn = document.getElementById('good-result')
const or = document.getElementById('or')
let nombre2 = 1
let randomRange = 11
let score = 0
let counter = 0


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

function tableOutOfOrder() {
  const spanResult = document.querySelectorAll('.results')
  // for (i = 1; i <= nombre2; i++) {
  //   // if (i == 10) {
  //   //   break
  //   // }
  //   spanResult[i].classList.add('show')
  //   console.log(i)
  //   console.log(spanResult[i])

  //   if (i == nombre2 -1) {
  //     spanResult[i].classList.remove('show')
  //   }
  //   else if (i < nombre2 - 1 && i < nombre2 - 2) {
  //     spanResult[i].classList.remove('show')
  //   }

  // }
  for (i = 0; i <= spanResult.length; i++) {
    console.log(spanResult[i])
  }
}

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
          counter++
          console.log(counter)
        }
        // Problème
        // counter++
        // console.log(counter)
      })
  });
  if(nombre2 === 11){
    showScore()
  }
  // }
}
function showScore() {
  const score = document.getElementById('modal-container')
  score.style.display ='block'
  score.classList.add('out')
  // .innerHTML = `<p> Score : ${score} / 10</p>`
  // console.log(score)
  // if (score === 10) {
  //   document.getElementById('finalScore').innerHTML = `<input type="hidden" name="score_valeur" value="${score}"><input type="hidden"  name="score_id" value="${idScore}"><input type="submit" name="submit" value="Bien joué ! Enregistre ton score 🏆">`
  // }
}
function goodResult() {
  btn.addEventListener('click', () => {
    let billes = document.querySelectorAll('.billes')
    btn.style.display ="none"
    billes.forEach((element) => {
      if (element.classList.contains('false')) {
        element.classList.remove('false')
      }
      if(element.classList.contains('true')){
        element.classList.remove('true')
      }
    })
    nombre2++
    startGame()
  })
}
goodResult()

// function showScore(){
//   if(nombre2 === 10){
//     console.log('afficher score')
//   }
// }
// showScore()

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