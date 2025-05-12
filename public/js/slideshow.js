const prev = document.getElementById('prev-btn')
const next = document.getElementById('next-btn')
const list = document.querySelector('.box-list')
const itemWidth = 486
const padding = 10

prev.addEventListener('click',()=>{
  list.scrollLeft -= (itemWidth + padding)
})
next.addEventListener('click',()=>{
  list.scrollLeft += (itemWidth + padding)
})

// Con el click
let isDown = false;
let startX;
let scrollLeft;

list.addEventListener('mousedown', (e) => {
  isDown = true;
  document.body.classList.add('grabbing');
  document.body.style.userSelect = 'none';
  startX = e.pageX - list.offsetLeft;
  scrollLeft = list.scrollLeft;
});

window.addEventListener('mouseup', () => {
  isDown = false;
  document.body.classList.remove('grabbing');
  document.body.style.userSelect = 'none';
});

window.addEventListener('mousemove', (e) => {
  if (!isDown) return;
  e.preventDefault();
  const x = e.pageX - list.offsetLeft;
  const walk = (x - startX) * 1.5; // la sensibilidad
  list.scrollLeft = scrollLeft - walk;
});