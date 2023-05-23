// scripts.js
document.addEventListener('DOMContentLoaded', () => {
  const closeBtn = document.getElementById('closeBtn');
  const popupForm = document.getElementById('popupForm');


  closeBtn.addEventListener('click', () => {
    popupForm.style.display = 'none';
  });

  window.addEventListener('click', (event) => {
    if (event.target === popupForm) {
      popupForm.style.display = 'none';
    }
  });
});
