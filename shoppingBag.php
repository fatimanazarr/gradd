<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="resp.css">
   
    <title>Document</title>
    <style>
        .dish {
          margin-top: 2vh;
          display: grid;
          grid-template-columns: 1fr 2fr 1fr 1fr; /* Adjust column widths as needed */
          align-items: center;
        }
        
        .dish h1 {
          grid-column: 1;
          color: #000000;
          font-family: mirza;
          font-size: 24px;
          font-weight: bold;
        }
        
        .dish p {
          color: #000000;
          font-family: Avenir;
          font-size: 18px;
          margin-right: 20vh;
        }
        
        .dish + .dish {
          border-top: 1px solid #964325;
          margin-top: 10px;
          margin-left: 20vh; /* Adjust the margin value as needed */
          margin-right: 20vh; /* Adjust the margin value as needed */
        }
        .total-price-button-container {
          display: flex;
          margin-top: 10vh;
          justify-content: space-between;
          align-items: center;
        }
    
        #totalPriceH1
        {
          font-family: Mirza;
          margin-right: 20vh;
        }
        button {
          width: 196px;
          height: 46px;
          margin-top: 30px;
          margin-left: 20vh;
          font-family: Avenir;
          font-size: 15px;
          font-weight: 400px;
          background-color: #964325;
          color: #F1EEE7;
          border: none;
          border-radius: 10px;
          font-family: 'Avenir', sans-serif;
          position: relative;
          overflow: hidden;
        }
        .quantity-container {
    display: flex;
    align-items: center;
  }

  .quantity-icon {
    width: 20px;
    height: 20px;
    cursor: pointer;
    margin-right: 15px;
  }

  .quantity {
  color: #000000;
  font-family: Avenir;
  font-size: 18px;
  margin-right: 5px;
  display: flex;
  align-items: center;
}
    </style>
</head>
<body>
  <section class="hero-section5" style="direction: rtl;">
    <div class="navbar5">
      <div class="logo5">
        <h1>بغتاليا</h1>
      </div>

      <div class="menu5">
        <ul>
          <div class="close-icon" onclick="toggleMenu()"><i class="fa-solid fa-times"></i></div>
          <li><a href="index.php" style="text-decoration: none; ">الرئيسية</a></li>
          <li><a href="appetizers.php" style="text-decoration: none; ">قائمة الطعام</a></li>
          <li><a href="about.php" style="text-decoration: none; ">من نحن</a></li>
          <li>تواصل معنا</li>
        </ul>
      </div>
    </div>
  </section>

  <section id="menu-items" style="direction: rtl;">
    <div class="menu-items-container" id="menuItemsContainer">
      <!-- Items will be dynamically populated here -->
    </div>
    
    <div class="total-price-button-container">
      <h1 id="totalPriceH1"></h1>
      <button id="finishShoppingButton">إتمام الشراء</button>
    </div>
  </section>

  <script>
  // Retrieve the selectedItems array from the URL query parameters
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const selectedItemsString = urlParams.get("selectedItems");
let selectedItems = JSON.parse(selectedItemsString);

  // Display the selectedItems array content in the console
  console.log(selectedItems);

  // Function to create the dish div dynamically
  function createDishDiv(dishName, dishDescription, quantity, price, index) {
    const menuItemsContainer = document.getElementById("menuItemsContainer");

    const dishDiv = document.createElement("div");
    dishDiv.classList.add("dish");

    const h1 = document.createElement("h1");
    h1.textContent = dishName;

    const p1 = document.createElement("p");
    p1.textContent = dishDescription;

    const quantityContainer = document.createElement("div");
    quantityContainer.classList.add("quantity-container");

    const decreaseIcon = document.createElement("img");
    decreaseIcon.src = "Images/decreaseSign.svg";
    decreaseIcon.alt = "Decrease";
    decreaseIcon.classList.add("quantity-icon");
    decreaseIcon.addEventListener("click", () => decreaseQuantity(p2, index));

    const p2 = document.createElement("p");
    p2.textContent = quantity;
    p2.classList.add("quantity");

    const increaseIcon = document.createElement("img");
    increaseIcon.src = "Images/increaseSign.svg";
    increaseIcon.alt = "Increase";
    increaseIcon.classList.add("quantity-icon");
    increaseIcon.addEventListener("click", () => increaseQuantity(p2, index));

    const p3 = document.createElement("p");
    p3.textContent = "$" + price;

    dishDiv.appendChild(h1);
    dishDiv.appendChild(p1);
    quantityContainer.appendChild(decreaseIcon);
    quantityContainer.appendChild(p2);
    quantityContainer.appendChild(increaseIcon);
    dishDiv.appendChild(quantityContainer);
    dishDiv.appendChild(p3);

    menuItemsContainer.appendChild(dishDiv);
  }

  // Function to decrease the quantity
  function decreaseQuantity(quantityElement, index) {
    let quantity = parseInt(quantityElement.textContent);
    if (quantity > 0) {
      quantity--;
      quantityElement.textContent = quantity;
      selectedItems[index].quantity = quantity; // Update the quantity in the selectedItems array
      calculateTotalPrice();
    }
  }

  // Function to increase the quantity
  function increaseQuantity(quantityElement, index) {
    let quantity = parseInt(quantityElement.textContent);
    quantity++;
    quantityElement.textContent = quantity;
    selectedItems[index].quantity = quantity; // Update the quantity in the selectedItems array
    calculateTotalPrice();
  }

  // Loop through the selectedItems array and create dish divs
  for (let i = 0; i < selectedItems.length; i++) {
    const item = selectedItems[i];
    createDishDiv(item.DishName, item.DishDescription, item.quantity, item.TotalPrice, i);
  }

  // Function to calculate the total price
  function calculateTotalPrice() {
    let totalPrice = 0;
    const quantityElements = document.getElementsByClassName("quantity");

    for (let i = 0; i < quantityElements.length; i++) {
      const quantity = parseInt(quantityElements[i].textContent);
      const price = parseFloat(selectedItems[i].TotalPrice);
      totalPrice += quantity * price;
    }

    // Get the total price h1 and finish shopping button elements
    const totalPriceH1 = document.getElementById("totalPriceH1");

    // Set the text content for the total price h1
    totalPriceH1.textContent = "السعر الكلي: " + totalPrice.toFixed(2);
  }

  // Call the calculateTotalPrice function to display the total price
  calculateTotalPrice();

  // Add an event listener to the finishShoppingButton
const finishShoppingButton = document.getElementById("finishShoppingButton");
finishShoppingButton.addEventListener("click", goToOrderForm);

// Function to open orderForm.php and pass the selectedItems array as a query parameter
function goToOrderForm() {
  const modifiedSelectedItemsString = JSON.stringify(selectedItems);
  window.location.href = "orderForm.php?selectedItems=" + encodeURIComponent(modifiedSelectedItemsString);
  window.open("visitorForm.php?selectedItems=" + encodeURIComponent(modifiedSelectedItemsString));}
</script>
</body>
</html>