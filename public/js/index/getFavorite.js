const favoriteItems = document.querySelector('#favorite-items');

if (localStorage.getItem("favorites") != null) {
    let fItems = localStorage.getItem("favorites").split(',');
    favoriteItems.innerHTML = fItems.length;
    favoriteItems.parentElement.setAttribute("href", "index.php?favorites=" + fItems);
}
