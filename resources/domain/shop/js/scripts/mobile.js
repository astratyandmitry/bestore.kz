let menuIcon = document.querySelector('.js-menu')
let menu = document.querySelector('.menu')
let searchIcon = document.querySelector('.js-search')
let search = document.querySelector('.search')
let loader = document.querySelector('.loader')
let body = document.querySelector('body')

menuIcon.addEventListener('click', () => {
  search.classList.remove('search--active')

  if (menu.classList.contains('menu--active')) {
    menu.classList.remove('menu--active')
    loader.classList.remove('loader--active')
    body.classList.remove('fixed')
  } else {
    menu.classList.add('menu--active')
    loader.classList.add('loader--active')
    body.classList.add('fixed')
  }
})

searchIcon.addEventListener('click', () => {
  menu.classList.remove('menu--active')
  search.classList.add('search--active')
  loader.classList.add('loader--active')
  body.classList.add('fixed')

})

loader.addEventListener('click', () => {
  search.classList.remove('search--active')
  menu.classList.remove('menu--active')
  loader.classList.remove('loader--active')
  body.classList.remove('fixed')
})
