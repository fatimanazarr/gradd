// Add an index variable to keep track of the current review
let currentIndex = 0;
function toggleMenu() {
  var menu = document.querySelector('.menu');
  var closeIcon = document.querySelector('.close-icon');
  
  if (menu.style.display === 'flex') {
    menu.style.display = 'none';
    closeIcon.style.display = 'none';
  } else {
    menu.style.display = 'flex';
    closeIcon.style.display = 'block';
  }
}
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