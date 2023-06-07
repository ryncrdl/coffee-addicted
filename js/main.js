// Event delegation to handle button clicks
document.addEventListener("click", function (event) {
  if (event.target.classList.contains("addQuantity")) {
    handleQuantityUpdate(event.target.dataset.id, "increase")
  } else if (event.target.classList.contains("subsQuantity")) {
    handleQuantityUpdate(event.target.dataset.id, "decrease")
  }
})

function handleQuantityUpdate(productId, action) {
  var qtyInput = document.getElementById("qty-" + productId)
  var currentQty = parseInt(qtyInput.value)

  if (action === "increase") {
    qtyInput.value = currentQty + 1
  } else if (action === "decrease" && currentQty > 0) {
    qtyInput.value = currentQty - 1
  }
}
