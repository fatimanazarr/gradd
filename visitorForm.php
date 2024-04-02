<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إتمام الشراء كزائر</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="resp.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        #section {
            text-align: center;
            margin-top: -10vh;
        }
        
        #heading {
            color: black;
            font-family: Mirza;
            font-size: 50px;
        }
        
        #subheading {
            color: #303030;
            font-family: Avenir;
            font-size: 16px;
            font-weight: lighter;
        }
        
        #description {
            color: #A6A6A6;
            font-family: Avenir;
            font-size: 35px;
            width: 400px;
        }
        
        #form {
            margin-top: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        
        input[type="text"] {
            width: 416px;
            height: 35.91px;
            margin-bottom: 10px;
            direction: rtl;
            font-family: Avenir;
            font-size: 16px;
            color: #A6A6A6;
            background-color: transparent;
            border: 1px solid #A6A6A6;
            border-radius: 4px;
        }

        #submit-button {
    width: 416px;
    height: 35.91px;
    background-color: #964325;
    border-radius: 4px;
    border: none;
    box-shadow: none;
    color: white;
    font-family: Avenir;
    font-size: 16px;
}
        
        #order-type {
            width: 420px;
            height: 35.91px;
            margin-bottom: 10px;
            direction: rtl;
            font-family: Avenir;
            font-size: 16px;
            color: #A6A6A6;
            background-color: transparent;
            border: 1px solid #A6A6A6;
            border-radius: 4px;
        }
        
        #pickup-time {
            display: none;
            width: 416px;
        }
        
        #pickup-time input[type="text"] {
            width: 416px;
            height: 35.91px;
            margin-bottom: 10px;
            direction: rtl;
            font-family: Avenir;
            font-size: 16px;
            color: #A6A6A6;
            background-color: transparent;
            border: 1px solid #A6A6A6;
            border-radius: 4px;
        }
        
        #total-price-heading {
            color: black;
            font-family: Mirza;
            font-size: 20px;
            text-align: right;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <section id="section">
        <h1 id="heading">إتمام الشراء</h1>
        <h2 id="subheading">يرجى إدخال المعلومات المطلوبة بالأسفل</h2>
        
        <form id="form" style="direction: rtl;">
            <div style="display: flex; justify-content: space-between;">
                <input type="text" id="first-name" placeholder="الاسم الأول">
            </div>
            <input type="text" id="table-number" placeholder="رقم الطاولة">
            <select onchange="togglePickupTime()" id="order-type">
                <option value="dine-in">تناول في المطعم</option>
                <option value="take-away">توصيل</option>
            </select>
            <div id="pickup-time">
                <input type="text" placeholder="وقت الاستلام">
            </div>
            <h1 id="total-price-heading">السعر الكلي:</h1>
            <h3 id="total-price"></h3>
            <input type="submit" id="submit-button" value="إرسال">
        </form>
    </section>

    <script>
         // Retrieve the selectedItems array from the URL query parameters
    const queryString = window.location.search;
    const urlParams = new URLSearchParams(queryString);
    const selectedItemsString = urlParams.get("selectedItems");
    const selectedItems = JSON.parse(selectedItemsString);

    // Calculate the total price
let totalPrice = 0;
for (let i = 0; i < selectedItems.length; i++) {
  const item = selectedItems[i];
  totalPrice += parseFloat(item.TotalPrice);
}
    // Display the total price on the page
const totalPriceElement = document.getElementById("total-price");
totalPriceElement.textContent = totalPrice + " ريال";

    console.log(selectedItems);
    console.log(totalPrice);
        function togglePickupTime() {
            var orderType = document.getElementById("order-type");
            var pickupTimeDiv = document.getElementById("pickup-time");
            var selectedOption = orderType.options[orderType.selectedIndex].value;
            
            if (selectedOption === "take-away") {
                pickupTimeDiv.style.display = "block";
            } else {
                pickupTimeDiv.style.display = "none";
            }
        }
    </script>
</body>
</html>