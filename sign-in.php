<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>الرئيسية</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="resp.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      overflow: hidden;
    }
  </style>
</head>
<body>
  <section>
    <div class="right-div4">
      <img class="pizzaImg" src="Images/sign-in.png">
    </div>
    <div id="left-div4">
      <div id="top-section2">
        <h1>بغتاليا</h1>
        <div class="signupsection">
          <button class="sign-upbutton">إنشاء حساب</button>
          <p>ليس لديك حساب؟</p>
        </div>
      </div>
      <div id="bottom-section2">
        <h1>تسجيل الدخول</h1>
        <p>يرجى إدخال المعلومات المطلوبة بالأسفل</p>
        <form id="signin-form">
          <input type="text" id="phone" placeholder="رقم الهاتف">
          <input type="password" id="password" placeholder="كلمة السر">
          <input type="submit" value="تسجيل الدخول">
        </form>
      </div>
    </div>
  </section>

  <script>
    document.getElementById("signin-form").addEventListener("submit", function(event) {
      event.preventDefault(); // Prevent form submission

      var phone = document.getElementById("phone").value;
      var password = document.getElementById("password").value;

      // Make an AJAX request to the PHP script
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "signin.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
          var response = JSON.parse(xhr.responseText);
          if (response.status === "success") {
            console.log("Sign-in successful");
            // Redirect to a new page or perform other actions
          } else {
            console.log("Sign-in failed: " + response.message);
            // Display an error message to the user
          }
        }
      };
      xhr.send("phone=" + encodeURIComponent(phone) + "&password=" + encodeURIComponent(password));
    });
  </script>
</body>
</html>