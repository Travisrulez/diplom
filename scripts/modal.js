const modal = document.querySelector('.modal')
const overlay = document.querySelector('.overlay')
const openModalButton = document.querySelectorAll('.open-modal-btn')

const openModal = () => {
  modal.classList.add('active')
  overlay.classList.add('active')
}

const closeModal = () => {
  modal.classList.remove('active')
  overlay.classList.remove('active')
}

openModalButton.forEach(btn => btn.addEventListener('click', openModal))
overlay.addEventListener('click', closeModal)