// Homepage
let radioInput = document.querySelectorAll("input[type=radio][name=selectTable]")
let imgTables = document.querySelectorAll('.click-table')

radioInput.forEach(r => {
  r.addEventListener('click', () => {
    let imgRelated = r.parentNode.querySelector('img')
    updateImages(imgRelated)
  })
})

function updateImages(changedImage) {
  imgTables.forEach(image => {
    if (image === changedImage) {
      image.style.opacity = 1
    } else {
      image.style.opacity = 0.3
    }
  })
}