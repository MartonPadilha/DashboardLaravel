let teste = document.querySelector('.delivered').innerHTML

teste = parseInt((teste/30)*12)

document.querySelector('.total_profit').innerHTML = `R$${teste},00`

