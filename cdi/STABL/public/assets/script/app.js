fetch('./Models_stabl/Ajax.php', {
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
      // Variables
      let nombreSelectionner = element.score_param1
      let order = element.score_param2
      let help = element.score_param3
      let idScore = element.score_id
      let nombre2 = 1
      let randomRange = 11
      let score = 0
      let counter = 0


      for (let i = 1; i <= 10; i++) {
        let result = nombreSelectionner * i

        document.getElementById('choice').innerHTML += `<div class="billes"><input type="radio" value= "${result}"><label>${result}</label></div>`

        document.getElementById('table').innerHTML += `<div class="operation">${nombreSelectionner} x ${i} = &nbsp;<span class="results">${result}</span> <br ></div>`
      }

      startGame()
      function startGame() {
        
        if (order == 1 && help == 1) {
          generateBallsInOrder()
        }
        else if (order == 1 && help == 2) {
          table()
        }
        else if(order == 2 && help == 1){
          randomNumber()
          generateBallsOutOfOrder()
        }
        else if(order == 2 && help == 2){
          randomNumber()
          tableOutOfOrder()
        }
        // Question opération
        document.getElementById('question').innerHTML = `<span>${nombreSelectionner} x ${nombre2}</span>`
        click()
      }

      function tableOutOfOrder() {
        const spanResult = document.querySelectorAll('.results')
        for (i = 1; i <= nombre2; i++) {
          if(i == 10){
            break
          }
          // console.log(i)
          // console.log(spanResult[i])
          spanResult[i].classList.add('show')

          
          if(i == nombre2 -1 ){
            spanResult[i].classList.remove('show')
          }
          else if(i < nombre2 -1  && i < nombre2 -2){
            spanResult[i].classList.remove('show')
          }
          
        }
      }
      

      function generateBallsInOrder() {
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
          break;
        }
        billes.append(table);
      }

      function generateBallsOutOfOrder() {
        const billes = document.getElementById('generateBille')
        const table = document.createElement('table');
        let j
        for (let i = 1; i <= nombre2; i++) {
          const row = document.createElement('tr');
          for (j = 1; j <= nombreSelectionner; j++) {
            const col = document.createElement('td');
            col.classList.add('col-header')
            row.appendChild(col);
          }
          table.appendChild(row);
        } 
        billes.append(table)
        
      }
      function table() {
        const spanResult = document.querySelectorAll('.results')
        let i = 1
        for (i = 1; i <= nombre2; i++) {
          if(i == 10){
            break
          }
          spanResult[i].classList.add('show')
          
          if(i == nombre2 -1){
            spanResult[i].classList.remove('show')
          }
        }
      }

      // Function that checks the click, the result and the value and which adds the correct result in the table
      function click() {
        const inputScoreValeur = document.querySelectorAll('input[type=radio]')
        const valeurScore = document.querySelector('input[type=radio]')
        if (valeurScore) {
          inputScoreValeur.forEach((elem) => {
            const parent = elem.parentNode
            elem.addEventListener("click", function (event) {
              let item = event.target.value;
              console.log(item)
              const spanResult = document.querySelectorAll('.results')
              if (item == nombreSelectionner * nombre2) {
                parent.style.backgroundImage = "url('public/assets/ressources/bille-vert.png')"
                spanResult.forEach(result => {
                  if (result.textContent == nombreSelectionner * nombre2) {
                    result.classList.add('show')
                    result.style.color = 'green'
                  }
                })
                // console.log(`${nombreSelectionner} x ${nombre2} = ${nombreSelectionner * nombre2}`)
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

      function randomNumber() {
        // nombre2 = Math.floor(Math.random() * (10 - 1)) + 1;
        // console.log(nombreSelectionner + 'x' + nombre2)
        let arrayNumbers = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10]
        nombre2 = arrayNumbers.sort(function () {
          return Math.random() - 0.5;
        });
        console.log(nombre2)
        // nombre2 = nombre2.pop()
        nombre2 = nombre2.pop()
      }
      

    })
  })
  .catch((error) => console.log(error))