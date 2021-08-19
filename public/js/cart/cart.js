// Multiplicar produtos do carrinho

const inputAmount    = document.querySelectorAll('input[name=amount]')
const totalElement   = document.querySelectorAll('#total')
const productElement = document.querySelectorAll('input[type=hidden]')
const totalValue     = document.querySelector('#total-value')
const btnDelete      = document.querySelectorAll('.delete')
const inputTotal     = document.querySelector('input[name=_total]')

var formatter = new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'Mts',
});

inputAmount.forEach((input) => {
    input.addEventListener('change', () => {
    
        let inputId       = Number(input.id)
        let units         = parseInt(input.value)
        let estoque       = parseInt(input.max)
        let precounitario = parseFloat(productElement[inputId].value)

        totalElement[inputId].innerHTML = "Total: "

        if(units > estoque) {
            precounitario *= estoque;
            totalElement[inputId].innerHTML += formatter.format(precounitario)
            input.value = estoque

        } else {
            precounitario *= units
            totalElement[inputId].innerHTML += formatter.format(precounitario)
        }

        totalCart()

    });
});


function totalCart() {

    if (productElement.length == 0) return
    
    let array1 = []
    for (let i = 0; i < inputAmount.length; i++) {
        array1.push(parseFloat(productElement[i].value * inputAmount[i].value ))
    }
    let total = array1.reduce((total, num) => { return total + num })

    totalValue.innerHTML = "Total value of your cart: " + formatter.format(total)
    inputTotal.value = total.toFixed(2)
}

totalCart()

// Deletar produto
btnDelete.forEach((btn) => {
    btn.addEventListener('click', (event) => {
        event.preventDefault()

        let index = btn.id
        cartItems.splice(index, 1)

        setCookie(cookie_name, cartItems, 1)
 
        setTimeout(() => {
            window.location = "cart.php"
        }, 400);

        btn.parentElement.parentElement.parentElement.classList.add("fade-delete")

        console.log(cartItems.length)
        if (cartItems.length == 0) {
            document.cookie = "addToCart=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;"
        }
    })
})

