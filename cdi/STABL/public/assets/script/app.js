fetch('./Models/Ajax.php', {
  method: 'GET',
  mode: 'cors',
  headers: {
    'Content-Type': 'application/json',  // sent request
    'Accept': 'application/json'   // expected data sent back
  },
  body: JSON.stringify()
})
  .then((response) => { return response.json() })
  .then(datas => {
    datas.map(element => {
      // Général
      let nombreSelectionner = element.score_param1
      let order = element.score_param2
      let help = element.score_param3
      let idScore = element.score_id
      let nombre2 = 1
      let random = 10
      let score = 0
      let counter = 0

      // let multiple = [
      //   { nombreSelectionner, nombre2: 1 },
      //   { nombreSelectionner, nombre2: 2 },
      //   { nombreSelectionner, nombre2: 3 },
      //   { nombreSelectionner, nombre2: 4 },
      //   { nombreSelectionner, nombre2: 5 },
      //   { nombreSelectionner, nombre2: 6 },
      //   { nombreSelectionner, nombre2: 7 },
      //   { nombreSelectionner, nombre2: 8 },
      //   { nombreSelectionner, nombre2: 9 },
      //   { nombreSelectionner, nombre2: 10 }
      // ];
      // console.log(multiple)
      // let resultOperations = multiple.map(function (element) {
      //   // const results2 = `${element.nombreSelectionner}` .'x'. `${element.nombre2}`
      //   let results = `${element.nombreSelectionner}` * `${element.nombre2}`
      //   // return results
      //   return `${element.nombreSelectionner} x ${element.nombre2} = ...`
      // })
      // const tables = document.getElementById('tables')
      // tables.innerHTML += resultOperations.join(' ')

      for (let i = 1; i <= 10; i++) {
        let result = nombreSelectionner * i

        document.getElementById('choice').innerHTML += `<div class="billes"><input type="radio" value= "${result}"><label>${result}</label></div>`


        document.getElementById('table').innerHTML += `<div class="operation">${nombreSelectionner} x ${i} = &nbsp;<span class="results">${result}</span> <br ></div>`
      }

      startGame()
      function startGame() {
        // Question opération
        document.getElementById('question').innerHTML = `<span>${nombreSelectionner} x ${nombre2}</span>`
        if (order == 1 && help == 1) {
          generateBilles()
        }
        click()
      }

      function generateBilles() {
        const billes = document.getElementById('generateBille')
        const table = document.createElement('table');
        for (let i = 1; i <= nombre2; i++) {
          const row = document.createElement('tr');
          for (let j = 1; j <= nombreSelectionner; j++) {
            const col = document.createElement('td');
            col.classList.add('col-header')
            row.appendChild(col);
          }
          table.appendChild(row);
          break
        }
        billes.append(table);
      }

      function click() {

        const inputScoreValeur = document.querySelectorAll('input[type=radio]')
        const valeurScore = document.querySelector('input[type=radio]')
        const spanResult = document.querySelectorAll('.results')


        if (valeurScore) {
          inputScoreValeur.forEach((elem) => {
            const parent = elem.parentNode
            elem.addEventListener("click", function (event) {
              let item = event.target.value;

              if (item == nombreSelectionner * nombre2) {
                parent.style.backgroundImage = "url('public/assets/ressources/bille-vert.png')"
                spanResult.forEach(result => {
                  if (result.textContent == nombreSelectionner * nombre2) {
                    result.classList.add('show')
                    result.style.color = 'green'
                  }
                })
                console.log(`${nombreSelectionner} x ${nombre2} = ${nombreSelectionner * nombre2}`)
                score++
                nombre2++
                const myTimeout = setTimeout(() => {
                  startGame()
                  parent.style.backgroundImage = "url('public/assets/ressources/bille-jaune.png')"
                }, 1000)
                if (score === 10) {
                  clearTimeout(myTimeout)
                }
              } else {
                parent.classList.add('false')
                setTimeout(() => {
                  parent.style.backgroundImage = "url('public/assets/ressources/bille-jaune.png')"
                }, 3000)
              }
              showScore()
            });
          });
        }
      }

      function showScore() {
        document.getElementById('score').innerHTML = `<p> Score : ${score} / 10</p>`
        if (score === 10) {
          document.getElementById('finalScore').innerHTML = `<input type="hidden" name="score_valeur" value="${score}"><input type="hidden"  name="score_id" value="${idScore}"><input type="submit" name="submit" value="Bien joué ! Enregistre ton score 🏆">`
        }
      }

    })
  })
  .catch((error) => console.log(error))

// Function externes

function randomNumber() {
  nombre2 = Math.floor(Math.random() * random);
}


// Afficher le score dynamiquement
function showScoreInformation() {
  document.getElementById('score').innerHTML = `<p>Score : 20:20</p>`
}