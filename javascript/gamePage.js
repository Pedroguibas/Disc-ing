
function dropdown() {
    if (!this.querySelector('.buttonIcon').classList.contains('rotated')) {
        this.querySelector('.buttonIcon').classList.add('rotated');
        this.parentElement.parentElement.querySelector('.gameDropContent').classList.remove('gameDropHidden');
        this.classList.add('contentVisible');
    }
    else {
        this.querySelector('.buttonIcon').classList.remove('rotated');
        this.parentElement.parentElement.querySelector('.gameDropContent').classList.add('gameDropHidden');
        this.classList.remove('contentVisible');
    }
}

function changeScoreColor() {
    let scoreElem = document.getElementById('gameScore');
    let score = parseFloat(scoreElem.textContent);

    if (score < 3)
        scoreElem.style = "color: #700000";
    else if (score < 5)
        scoreElem.style = "color: #af6300";
    else if (score < 6.5)
        scoreElem.style = "color: #d8b800";
    else if (score < 8)
        scoreElem.style = "color: #4aac09";
    else if (score < 9)
        scoreElem.style = "color: #007716";
    else
        scoreElem.style = "color: #004d0e";
}

function modoAvaliar() {
    this.querySelectorAll('.scoreStar').forEach(function(elem) {
        elem.classList.remove('mouseOut');
    });
}

function modoMostrarAvaliacao() {
    this.querySelectorAll('.scoreStar').forEach(function(elem) {
        elem.classList.add('mouseOut');
    });
}


const dropdownBtn = document.querySelectorAll('.buttonDrop');
dropdownBtn.forEach(function(elem) {
    elem.addEventListener('click', dropdown)
});

const starScoreContainer = document.getElementById('starScoreContainer');
starScoreContainer.addEventListener('mouseenter', modoAvaliar);
starScoreContainer.addEventListener('mouseleave', modoMostrarAvaliacao);