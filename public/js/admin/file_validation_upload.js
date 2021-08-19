/* PÁGINA CADASTRAR UM NOVO PRODUTO */
/* Validação e previsualização de imagens antes do upload */

const inputFiles = document.querySelector('input[type=file]')
const previewImage = document.querySelectorAll('.image-preview__image')
const previewDefaultText = document.querySelectorAll('.image-preview__default-text')
const imgName = document.querySelectorAll('.img-name')

inputFiles.addEventListener("change", function() {
    const file = this.files;

    if(file.length < 2) {
        return windowAlert("You must select two images!")
    } else if(file.length > 2) {
        return windowAlert("You have selected more than two images, select only two images!")
    }
    previewImage.forEach((_, idx) => {

        if(file[idx].size > 500000) {
            return windowAlert(file[idx].name + ": Must be less than 500 KB!")
        }

        if(file[idx]) {
            let str = ["Small image ", "Large image "];
            imgName[idx].innerHTML = str[idx] + file[idx].name;

            const render = new FileReader();

            previewDefaultText[idx].style.display = "none";
            previewImage[idx].style.display = "block";

            render.addEventListener("load", function() {
                previewImage[idx].setAttribute("src", this.result);
            });
            render.readAsDataURL(file[idx]);
        }
    })
})
