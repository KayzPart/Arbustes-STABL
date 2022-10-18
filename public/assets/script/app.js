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
      let nombreSelectionner = element.score_param1
      let order = element.score_param2
      let help = element.score_param3
      let nombre2 = 1
      let random = 10
      let score = 0
      let counter = 0
      let resultOperation = nombreSelectionner * nombre2
      console.log(nombreSelectionner * nombre2)
      // Si user sélectionne bille + ordre
      function startGame(){
        if (order == 1 && help == 1) {
          Generate()
          click()
          // let nombre2 = 1
          // Question opération
          document.getElementById('question').innerHTML = `<span>${nombreSelectionner} x ${nombre2}</span>`
          
          const table = document.createElement('table');
          for (let i = 1; i <= nombre2; i++) {
            const row = document.createElement('tr');
            for (let j = 1; j <= nombreSelectionner; j++) {
              const col = document.createElement('td');
              col.classList.add('col-header')
              row.appendChild(col);
            }
            table.appendChild(row);
          }
          document.body.appendChild(table);
        }
      }
      startGame()
      
      function Generate() {
        for (let i = 1; i <= 10; i++) {
          let result = nombreSelectionner * i

          document.getElementById('choice').innerHTML += `<div class="billes"><input type="radio" name="score_valeur" id="score_valeur" value= ${result}>${result}</div>`
          // Affichage de la table 
          document.getElementById('table').innerHTML += `<div class="operation">${nombreSelectionner} x ${i} = ... <br ></div>`
        }
      }

      function click() {
        const billes = document.querySelectorAll('.billes')
        console.log(billes)
        const inputScoreValeur = document.querySelectorAll('input[type=radio][name=score_valeur]')
        const valeurScore = document.querySelector('input[type=radio][name=score_valeur]')


        if (valeurScore) {
          inputScoreValeur.forEach((elem) => {
            const parent = elem.parentNode
            console.log(parent)
            elem.addEventListener("click", function (event) {
              let item = event.target.value;
              console.log(item);
              console.log(resultOperation)
              if (item == resultOperation && counter < 10) {
                parent.classList.add('true')
                score++
                document.getElementById('result').innerHTML = `<p> Bien jouer !</p><button>Continuer</button>`
              } else {
                parent.classList.add('false')
                document.getElementById('result').innerHTML = `<p> Essaye encore !</p>`
              }
              counter++
              showScore()
              // if (counter < 10) {
              //   setTimeout(startGame, 3000)
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

      // let multiple = [
      //   {nombreSelectionner, nombre2: "1"},
      //   {nombreSelectionner, nombre2: "2"},
      //   {nombreSelectionner, nombre2: "3"},
      //   {nombreSelectionner, nombre2: "4"},
      //   {nombreSelectionner, nombre2: "5"},
      //   {nombreSelectionner, nombre2: "6"},
      //   {nombreSelectionner, nombre2: "7"},
      //   {nombreSelectionner, nombre2: "8"},
      //   {nombreSelectionner, nombre2: "9"},
      //   {nombreSelectionner, nombre2: "10"}
      // ];
      //  let resultOperation = multiple.map(function(element){
      //   return `${element.nombreSelectionner}` * `${element.nombre2}`
      //  })
      //  console.log(resultOperation)


      // Ordre + bille
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

