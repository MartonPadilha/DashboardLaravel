let teste = document.querySelector('.delivered').innerHTML
console.log(teste);

teste = parseInt((teste/30)*12)
console.log(teste);

document.querySelector('.total_profit').innerHTML = `R$${teste},00`

