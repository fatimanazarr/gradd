fetch("fetch_data.php")
  .then(response => response.json())
  .then(data => {

    const items = document.querySelectorAll(".items-div .item");
    data.menu.slice(0, 8).forEach((item, index) => {
      const currentItem = items[index];
      currentItem.querySelector("h1").textContent = item.DishName;
      currentItem.querySelector("p").textContent = item.DishDescription;


      currentItem.querySelector("img").src = data.images[index].Dishimage;
    });
  })
  .catch(error => {
    console.error("Error:", error);
  });
