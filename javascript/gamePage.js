
function dropdown() {
    if (!this.querySelector('.buttonIcon').classList.contains('rotated')) {
        this.querySelector('.buttonIcon').classList.add('rotated');
        this.parentElement.parentElement.querySelector('.gameDropContent').classList.remove('gameDropHidden');
    }
    else {
        this.querySelector('.buttonIcon').classList.remove('rotated');
        this.parentElement.parentElement.querySelector('.gameDropContent').classList.add('gameDropHidden');
    }
}


const dropdownBtn = document.querySelectorAll('.buttonDrop');
dropdownBtn.forEach(function(elem) {
    elem.addEventListener('click', dropdown);
})