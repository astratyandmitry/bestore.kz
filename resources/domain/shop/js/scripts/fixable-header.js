let app = document.querySelector('.app')
let nav = document.querySelector('.nav')
let scroll = window.scrollY

function fixable () {
  if (window.scrollY > nav.offsetHeight) {
    app.classList.add('app--header-fixed')
  } else {
    app.classList.remove('app--header-fixed')
  }
}

window.addEventListener('scroll', fixable)

fixable()
