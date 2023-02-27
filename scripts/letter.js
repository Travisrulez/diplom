const title = document.querySelector('.header__title')

const headerDecor = document.querySelector('.header .decor-letter')
const footerDecor = document.querySelector('.application .decor-letter')

document.addEventListener('DOMContentLoaded', () => {
  const firstLetter = title.innerHTML[0]

  headerDecor.textContent = firstLetter
  footerDecor.textContent = firstLetter
})