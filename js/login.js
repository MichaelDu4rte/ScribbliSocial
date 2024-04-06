const inputs = document.querySelectorAll(".input-field");
const toggle_btn = document.querySelectorAll(".toggle");
const main = document.querySelector("main");
const bullets = document.querySelectorAll(".bullets span");

let currentIndex = 0; // Índice do slide atual


inputs.forEach((inp) => {
  inp.addEventListener("focus", () => {
    inp.classList.add("active");
  });
  inp.addEventListener("blur", () => {
    if (inp.value != "") return;
    inp.classList.remove("active");
  });
});

toggle_btn.forEach((btn) => {
  btn.addEventListener("click", () => {
    main.classList.toggle("sign-up-mode");
  });
});

function moveSlider(index) {
  currentIndex = index; // Atualizar o índice do slide atual

  const textSlider = document.querySelector(".text-group");
  textSlider.style.transform = `translateY(${-(currentIndex) * 2.2}rem)`;

  bullets.forEach((bull) => bull.classList.remove("active"));
  bullets[currentIndex].classList.add("active");
}

function autoMoveSlider() {
  currentIndex = (currentIndex + 1) % bullets.length; // Avançar para o próximo slide
  moveSlider(currentIndex);
}

bullets.forEach((bullet, index) => {
  bullet.addEventListener("click", () => moveSlider(index));
});


const intervalo = 5000;

// Iniciar a função autoMoveSlider() automaticamente e repeti-la a cada intervalo
const intervalId = setInterval(autoMoveSlider, intervalo);