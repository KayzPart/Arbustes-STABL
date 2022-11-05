// Requête Ajax pour afficher les différents rendu en fonction du score sur la homepage
const figure = document.querySelectorAll('.border_score')
console.log(figure)
const inputTable = document.querySelectorAll('input[type=radio][name=selectTable]')
console.log(inputTable)
const border = document.querySelectorAll('.border_score')
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
        // console.log(datas)
        datas.map(element => {
            // console.log(element)
            let score = element.score_valeur
            console.log(score)
            // if(score < 8){
                inputTable.forEach(item => {
                    if(item.value == element.score_param1){
                       
                    }
                })
            
        })
    })
    .catch((error) => console.log(error))
