// Make the AJAX request
fetch("fetch_data.php")
  .then(response => response.json())
  .then(data => {
    // Iterate over each data object and update the HTML elements
    const divs = document.getElementsByClassName("div");
    data.menu.forEach((item, index) => {
      const div = divs[index];
      div.querySelector("h1").textContent = item.DishName;
      div.querySelector("p").textContent = item.DishDescription;

      // Create and set the image element
      const img = document.createElement("img");
      img.src = data.images[index].Dishimage;
      img.alt = `img ${index + 1}`;
      img.style.width = "202px";
      img.style.height = "200px";
      img.style.marginTop = "-20px";
      div.insertBefore(img, div.firstChild);
    });
  })
  .catch(error => {
    console.error("Error:", error);
  });