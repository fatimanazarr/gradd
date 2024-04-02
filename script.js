// Add an index variable to keep track of the current review
let currentIndex = 0;
let selectedItems = [];
let isMenuOpen = false;

function goToSecondPage() {
  const params = new URLSearchParams();
  params.append("selectedItems", JSON.stringify(selectedItems));
  window.location.href = "shoppingBag.php?" + params.toString();
}
function addToCart(id, dishName, dishPrice, dishDescription) {
  const selectedItemIndex = selectedItems.findIndex(
    selectedItem => selectedItem.DishName === dishName
  );

  if (selectedItemIndex !== -1) {
    // Item already exists in the array, increment the quantity
    selectedItems[selectedItemIndex].quantity++;
  }
}
function toggleMenu(event) {
  const cartDropdown = document.getElementById("cart-dropdown");

  // Check if the click event originated from the shopping bag icon
  if (event.target.classList.contains("fa-bag-shopping")) {
    isMenuOpen = !isMenuOpen;

    if (isMenuOpen) {
      cartDropdown.style.display = "block";
    } else {
      cartDropdown.style.display = "none";
    }
  }
}

// Add a click event listener to the document
document.addEventListener("click", toggleMenu);
// دالة لعرض الريفيو مال الاندكس الحالي
function displayReview(data, index) {
  const reviewData = data.reviews[index];
  const customerName = document.getElementById("customer_name");
  const customerReview = document.getElementById("customer_review");

  customerName.textContent = reviewData.CustomerName;
  customerReview.textContent = reviewData.CustomerReview;
}

// دالة تتعامل ويا الضغط على السهم لعرض الريفيو التالي
function handleIconClick(data, isNext) {
  if (isNext) {
    currentIndex = (currentIndex + 1) % data.reviews.length; // يتحرك للريفيو الجاي
  } else {
    currentIndex = (currentIndex - 1 + data.reviews.length) % data.reviews.length; // يتحرك للريفيو السابق
  }

  displayReview(data, currentIndex);
}

document.addEventListener("DOMContentLoaded", function() {
  fetchAndPopulateMenuItems('مقبلات');
});
function fetchAndPopulateMenuItems(category) {
  fetch("fetch_data.php?category=" + category)
    .then(response => response.json())
    .then(data => {
      const menuData = data.menu;
      const imagesData = data.images;

      const menuDiv = document.querySelector(".menu-items");
      menuDiv.innerHTML = ""; // Clear the previous content

      menuData.forEach((item, index) => {
        if (item.DishCategory === category) {
          const itemDiv = document.createElement("div");
          itemDiv.classList.add("menu-item");

          const dishImage = document.createElement("img");
          dishImage.id = `dish-image-${index}`;
          itemDiv.appendChild(dishImage);

          const dishName = document.createElement("h1");
          dishName.id = `dish-name-${index}`;
          itemDiv.appendChild(dishName);

          const dishDesc = document.createElement("p");
          dishDesc.id = `dish-desc-${index}`;
          itemDiv.appendChild(dishDesc);

          const dishPrice = document.createElement("h3");
          dishPrice.id = `dish-price-${index}`;
          itemDiv.appendChild(dishPrice);

          // Create the "Add to Basket" button
      const addToBasketButton = document.createElement("button");
      addToBasketButton.textContent = "إضافة للسلة";
      addToBasketButton.classList.add("add-to-basket-button");

      // Add event listener for the "Add to Basket" button
      addToBasketButton.addEventListener("click", () => {
        const selectedItemIndex = selectedItems.findIndex(
          selectedItem => selectedItem.DishName === item.DishName
        );
      
        if (selectedItemIndex !== -1) {
          // Item already exists in the array, increment the quantity
          selectedItems[selectedItemIndex].quantity++;
        } else {
          // Item doesn't exist in the array, create a new object
          const selectedItem = {
            DishName: item.DishName,
            TotalPrice: item.TotalPrice,
            DishDescription: item.DishDescription,
            quantity: 1
          };
          selectedItems.push(selectedItem);
        }
      
        console.log(selectedItems);
       
        
      });
          // Append the button after the price
          itemDiv.appendChild(addToBasketButton);

          menuDiv.appendChild(itemDiv);

          const imageIndex = imagesData.findIndex(img => img.DishName === item.DishName);
          dishImage.src = imagesData[imageIndex].Dishimage;
          dishName.textContent = item.DishName;
          dishDesc.textContent = item.DishDescription;
          dishPrice.textContent = `$${item.TotalPrice}`;
        }
      });
    })
    .catch(error => {
      console.error("Error:", error);
    });
}

function populateMenuItems() {
  // Fetch the first 8 items from the "menu" and "images" tables
  fetch("fetch_data.php")
    .then(response => response.json())
    .then(data => {
      const menuData = data.menu.slice(0, 8); // Get the first 8 items from the menu data
      const imagesData = data.images.slice(0, 8); // Get the first 8 items from the images data

      // Iterate over the menu items and populate the HTML elements
      menuData.forEach((item, index) => {
        const dishNameElement = document.getElementById(`Dish_name_${index}`);
        const dishDescElement = document.getElementById(`Dish_desc_${index}`);
        const dishImageElement = document.getElementById(`Dish_image_${index}`);
        const dishPriceElement = document.getElementById(`Dish_price_${index}`);

        dishNameElement.textContent = item.DishName;
        dishDescElement.textContent = item.DishDescription;
        dishImageElement.src = imagesData[index].Dishimage;
        dishPriceElement.textContent = `$${item.TotalPrice}`;
      });
    })
    .catch(error => {
      console.error("Error:", error);
    });
}

// Call the function to populate the menu items
populateMenuItems();


// Call the initial display
fetch("fetch_data.php")
  .then(response => response.json())
  .then(data => {
    displayReview(data, currentIndex);

    // Add event listeners to the icon circles
    const iconCircles = document.getElementsByClassName("icon-circle");
    iconCircles[0].addEventListener("click", () => handleIconClick(data, false)); // Previous icon circle
    iconCircles[1].addEventListener("click", () => handleIconClick(data, true)); // Next icon circle
  })
  .catch(error => {
    console.error("Error:", error);
  });

