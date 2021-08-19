
const content       = document.querySelector('.alert-container')
const msnElement    = content.querySelector('#alert-msn')
const button        = content.querySelector('#alert-button')

function onColosed(param) {
    console.log(param)
    if (param != null) {
        param.focus()
    }
}

function windowAlert(mensage) {
    content.classList.remove('hidden-alert') 
    content.classList.add('show-alert')
    msnElement.innerHTML = mensage
}
button.addEventListener('click', () => {
    content.classList.remove('show-alert') 
    content.classList.add('hidden-alert')
    msnElement.innerHTML = ''
    onColosed
})