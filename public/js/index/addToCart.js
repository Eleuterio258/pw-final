// Adicionar produtos ao carrinho

const btnAddcart        = document.querySelectorAll('.add-to-cart')
const cartItemsElement  = document.querySelector('#cart-items')

let cartItems = []

let cookie_name = "addToCart"

// Deletar cookie
//document.cookie = "addToCart=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;"

function getCookie(cname) {
    var name = cname + "="
    var decodedCookie = decodeURIComponent(document.cookie)
    var ca = decodedCookie.split(';')

    for (var i = 0; i < ca.length; i++) {
        var c = ca[i]

        while (c.charAt(0) == ' ') {
            c = c.substring(1)
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length)
        }
    }
    return ""
}

function setCookie(cname, cvalue, exdays) {
    var d = new Date()

    d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000))

    var expires = "expires=" + d.toGMTString()

    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/"
}

function checkCookie() {
    var value = getCookie(cookie_name)

    if (value != "") {
        console.log("Possuie cookie " + value)

        let split = value.split(',')
        cartItems = split
        cartItemsElement.innerHTML = cartItems.length

    } else {
        console.log("Não possui cookie")
    }
}

checkCookie()
// Adicionar ao carrinho
btnAddcart.forEach((btn) => {
    btn.addEventListener('click', (event) => {

        let index = cartItems.indexOf(event.target.value)
        
        if (event.target.value != cartItems[index]) {
            cartItems.push(event.target.value)
            cartItemsElement.innerHTML = cartItems.length

            setCookie(cookie_name, cartItems, 1)
        }         
    })
})
