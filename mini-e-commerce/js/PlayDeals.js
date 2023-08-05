let addProductBtn = document.getElementById("addProduct");
let closeBtn = document.getElementById("closeBtn");
let form = document.querySelector(".add-product-form");

addProductBtn.addEventListener("click", () => {
    form.classList.toggle("active");
});

closeBtn.addEventListener("click", () => {
    form.classList.remove("active");
});



