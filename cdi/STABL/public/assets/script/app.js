fetch('./STABL/Models/Ajax.php', {
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
      let nombre2 = 1
      let random = 10
      let score = 0
      let counter = 0
      // let resultOperation = nombreSelectionner * nombre2

      let multiple = [
        { nombreSelectionner, nombre2: 1 },
        { nombreSelectionner, nombre2: 2 },
        { nombreSelectionner, nombre2: 3 },
        { nombreSelectionner, nombre2: 4 },
        { nombreSelectionner, nombre2: 5 },
        { nombreSelectionner, nombre2: 6 },
        { nombreSelectionner, nombre2: 7 },
        { nombreSelectionner, nombre2: 8 },
        { nombreSelectionner, nombre2: 9 },
        { nombreSelectionner, nombre2: 10 }
      ];

      console.log(multiple)
      let resultOperations = multiple.map(function (element) {
        const results = `${element.nombreSelectionner}` * `${element.nombre2}`
        return results
        // console.log(results)
      })
      // for(let op of resultOperations.values()){
      //   console.log(op)
      // }
      const tables = document.getElementById('tables')
      tables.innerHTML += resultOperations.join(" ")

      multiple.forEach(function (item, index) {
        console.log(item);
      });


      for (let i = 1; i <= 10; i++) {
        // console.log(result)
        document.getElementById('table').innerHTML += `<div class="operation">${nombreSelectionner} x ${i} = ... <br ></div>`
      }



      startGame()
      function startGame() {
        // Question opération
        document.getElementById('question').innerHTML = `<span>${nombreSelectionner} x ${nombre2}</span>`
        for (let i = 1; i <= 10; i++) {
          let result = nombreSelectionner * i

          document.getElementById('choice').innerHTML += `<div class="billes"><input type="radio" name="score_valeur" id="score_valeur" value= ${result}>${result}</div>`
        }
        if (order == 1 && help == 1) {
          generateBilles()
        }
        click()
      }

      function generateBilles() {
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
        document.body.appendChild(table);
      }

      function click() {
        const inputScoreValeur = document.querySelectorAll('input[type=radio][name=score_valeur]')
        const valeurScore = document.querySelector('input[type=radio][name=score_valeur]')

        if (valeurScore) {
          inputScoreValeur.forEach((elem) => {
            const parent = elem.parentNode
            elem.addEventListener("click", function (event) {
              let item = event.target.value;
              console.log(item);
              if (item == nombreSelectionner * nombre2) {
                // parent.classList.add('true')
                parent.style.backgroundImage = "url('public/assets/ressources/bille-vert.png')"
                document.getElementById('result').innerHTML = `<p> Bien jouer !`
                // document.getElementById('table').innerHTML += `<div class="operation">${nombreSelectionner} x ${nombre2} = ${nombreSelectionner * nombre2}<br ></div>`
                score++
                nombre2++
                console.log(nombreSelectionner * nombre2)
                startGame()

              } else {
                parent.classList.add('false')
                document.getElementById('result').innerHTML = `<p> Essaye encore !</p>`
              }
              counter++
              showScore()
              // if (counter < 10) {
              //   setTimeout(startGame(), 3000)
              //   return
              // }else{
              //   document.getElementById('score').innerHTML = ""
              //   document.getElementById('result').innerHTML = `<p> Score : ${score} / 10</p>`
              // }
            });
          });
        }
      }

      function showScore() {
        document.getElementById('score').innerHTML = `<p> Score : ${score} / 10</p>`
      }


    })
  })
  .catch((error) => console.log(error))

// Function externes

function randomNumber() {
  nombre2 = Math.floor(Math.random() * random);
  // console.log(nombre2)
}


// Afficher le score dynamiquement
function showScoreInformation() {
  document.getElementById('score').innerHTML = `<p>Score : 20:20</p>`
}

// Test table multiplication
// const array = []
// for (let i = 1; i < 11; i++) {
//   array.push(i)
// }
// for (let j = 1; j < 11; j++) {
//   const multiplications = array.map((num) => {
//     return num * j;
//   })
//   console.log(multiplications)
// }
