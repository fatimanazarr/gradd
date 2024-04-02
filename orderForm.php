<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="resp.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        section {
            text-align: center;
            margin-top: -10vh;
        }
        
        h1 {
            color: black;
            font-family: Mirza;
            font-size: 50px;
        }
        
        h2 {
            color: #303030;
            font-family: Avenir;
            font-size: 16px;
            font-weight: lighter;
        }
        
        p {
            color: #A6A6A6;
            font-family: Avenir;
            font-size: 35px;
            width: 400px;
        }
        
        .button {
            background-color: #964325;
            border-radius: 4px;
            box-shadow: none;
            border: none;
            width: 186px;
            height: 35.91px;
            color: white;
            font-family: Avenir;
            font-size: 16px;
            margin: 10px;
        }
    </style>
</head>
<body>
    <section>
        <h1>إتمام الشراء</h1>
        <h2>يرجى إدخال المعلومات المطلوبة بالأسفل</h2>
        <p>هل تريد إتمام الشراء كزائر أم بحسابك الشخصي؟</p>
        <a href="#" onclick="goToVisitorForm(); return false;"><button id="visitor-button" class="button">متابعة كزائر</button></a>
        <a href="#" onclick="goToSignUp(); return false;"><button class="button">متابعة بحساب</button></a>

        <script>
  // Retrieve the selectedItems array from the URL query parameters
  const queryString = window.location.search;
  const urlParams = new URLSearchParams(queryString);
  const selectedItemsString = urlParams.get("selectedItems");
  let selectedItems = JSON.parse(selectedItemsString);

  // Display the modified selectedItems array in the console
  console.log(selectedItems);

  // Function to open visitorForm.php and pass the selectedItems array as a query parameter
  function goToVisitorForm() {
    const modifiedSelectedItemsString = JSON.stringify(selectedItems);
    const url = "visitorForm.php?selectedItems=" + encodeURIComponent(modifiedSelectedItemsString);
    window.location.href = url;
  }

  // Function to open signUp.php and pass the selectedItems array as a query parameter
  function goToSignUp() {
    const modifiedSelectedItemsString = JSON.stringify(selectedItems);
    const url = "signUp.php?selectedItems=" + encodeURIComponent(modifiedSelectedItemsString);
    window.location.href = url;
  }
</script>
    </section>
</body>
</html>