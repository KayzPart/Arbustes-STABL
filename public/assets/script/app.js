fetch('./Models/Ajax.php', {
    method : 'GET',
    mode:    'cors',
    headers: {
      'Content-Type': 'application/json',  // sent request
      'Accept':       'application/json'   // expected data sent back
    },
    body: JSON.stringify()
})
.then((response) => { return response.json()})
.then(datas => {
      datas.map(element => {
        let nombreSelectionner = element.score_param1
        for(let i = 1; i <= 10; i++){
          // let result = nombreSelectionner * i
          // document.getElementById('jeu').innerHTML += "<br />" + nombreSelectionner + " x " + i + " = " + result
          document.getElementById('jeu').innerHTML += `<div class="calcul">${nombreSelectionner} x ${i} = ${nombreSelectionner*i} <br ></div>`
          document.getElementById('resultats').innerHTML +=  '<div class="billes">' + nombreSelectionner*i + '<br ></div>'
        } 
      })
    })
  .catch((error) => console.log(error))