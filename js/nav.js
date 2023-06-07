const btn_nav_open = document.querySelector("#btn-nav-open")
const btn_nav_close = document.querySelector("#btn-nav-close")
const nav = document.querySelector("#navlinks")

btn_nav_open.addEventListener("click", function () {
  nav.classList.add("show-nav")
})

btn_nav_close.addEventListener("click", function () {
  nav.classList.remove("show-nav")
})
