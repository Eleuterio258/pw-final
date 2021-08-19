/* Validação de formulário */

// Formatação de telefone
const phoneInput = document.querySelector('input[name=telefone]').addEventListener('blur', (event) => {
    const dddInput = document.querySelector('input[name=ddd]')
    const ddd = event.target.value.substr(1,2)
    
    dddInput.value = ddd
})
// Formatação de CEP e  Telefone
$(function () {
    $('input[name=cep]').mask('99.999-999')
    $('input[name=telefone]').mask('(99) 99999-9999')
})

//#region Selecionar Estado e Cidade
const stateSelect = document.querySelector('select#estado')
const stateInput  = document.querySelector('input[name=state]')
const citySelect  = document.querySelector('select#cidade')   
const cityInput   = document.querySelector('input[name=city]')

function estados() {

    fetch('https://servicodados.ibge.gov.br/api/v1/localidades/estados')
    .then(res => res.json())
    .then(states => {
        for(state of states){
            stateSelect.innerHTML += `<option value="${state.id}">${state.nome}</option>`
        }
    })
}
function cidades(event) {

    const ufValue = event.target.value

    const indexOfSelectedState = event.target.selectedIndex
    stateInput.value = event.target.options[indexOfSelectedState].text

    const url = `https://servicodados.ibge.gov.br/api/v1/localidades/estados/${ufValue}/municipios`

    citySelect.innerHTML = "<option value>City</option>"
    citySelect.disabled = true
    
    fetch(url)
    .then(res => res.json())
    .then(cities => {
        for(city of cities){
            citySelect.innerHTML += `<option value="${city.nome}">${city.nome}</option>`
        }

        citySelect.disabled = false
    })
}
function getCidade(event) {

    const indexOfSelectedState = event.target.selectedIndex
    cityInput.value = event.target.options[indexOfSelectedState].text

}

estados()

stateSelect.addEventListener('change', cidades)
citySelect.addEventListener('change', getCidade)

//#endregion Selecionar Estado e Cidade

//#region Validação de senha
const pwd1 = document.querySelector('input[name=senha1]');
const pwd2 = document.querySelector('input[name=senha2]');

pwd1.addEventListener('blur', () => {
    if (pwd1.value.length < 8 && pwd1.value.length > 0) {
        windowAlert("The password must contain at least 8 digits");
        onColosed(pwd1)
    }
})  

pwd2.addEventListener('blur', () => {
    if(pwd1.value != pwd2.value) {
        windowAlert("Password is not the same");
        onColosed(pwd2)
    }
}) 
 
//#endregion  Validação de senha     

