let hamburger = document.querySelector('.hamburger')
let dropdown = document.querySelector('.header .dropdown')
let loader = document.querySelector('.loader')
let body = document.querySelector('body')
let searchInput = document.querySelector('.search__input')

hamburger.addEventListener('click', () => {
  if (dropdown.classList.contains('dropdown--active')) {
    dropdown.classList.remove('dropdown--active')
    loader.classList.remove('loader--active')
    body.classList.remove('fixed')
  } else {
    dropdown.classList.add('dropdown--active')
    loader.classList.add('loader--active')
    body.classList.add('fixed')
  }
})

loader.addEventListener('click', () => {
  dropdown.classList.remove('dropdown--active')
  loader.classList.remove('loader--active')
  body.classList.remove('fixed')
})

searchInput.addEventListener('focusin', () => {
  loader.classList.add('loader--active')
  body.classList.add('fixed')
})

searchInput.addEventListener('focusout', () => {
  loader.classList.add('loader--active')
  body.classList.add('fixed')
})
