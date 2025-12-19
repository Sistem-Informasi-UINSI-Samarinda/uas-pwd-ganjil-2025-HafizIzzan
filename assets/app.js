const xmark = document.querySelector('#xmark');
const bar = document.querySelector('#bar');
const navbar = document.querySelector('#navbar');

bar.addEventListener('click', ()=> {
    bar.classList.add('hide');
    xmark.classList.remove('hide');
    navbar.classList.remove('hide');
})

xmark.addEventListener('click', ()=> {
    bar.classList.remove('hide');
    xmark.classList.add('hide');
    navbar.classList.add('hide');
})