<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
<section class="main-section">
  <div class="image-container2">
    <img src="Images/sign-up.png" alt="Image">
  </div>
  <div class="content-container">
    <div class="top-section">
      <h1 class="title2">بغتاليا</h1>
      <div class="login-section" >
        <h2 class="subtitle">هل لديكَ حساب؟</h2>
        <button class="login-button">تسجيل الدخول</button>
      </div>
    </div>
    <div class="bottom-section">
      <h1 class="form-title">إنشاء حساب</h1>
      <p class="form-description">يرجى إدخال المعلومات المطلوبة بالأسفل</p>
      <form class="form" style="direction: rtl;" method="post">
  <div class="form-group">
    <input type="text" class="input-box" placeholder="الاسم الأول" name="CustomerFirstName">
    <input type="text" class="input-box" placeholder="الاسم الأخير" name="CustomerLastName">
  </div>
  <div class="form-group">
    <input type="text" class="input-box" placeholder="رقم الهاتف" style="width: 350px;" name="CustomerPhone">
  </div>
  <div class="form-group">
    <input type="password" class="input-box" placeholder="كلمة المرور" style="width: 350px;" name="CustomerPassword">
  </div>

  <button type="submit" class="submit-button">إرسال</button>
</form>
    </div>
  </div>
</section>
<script>
 function signUp() {
  // Retrieve the form inputs
  var firstName = document.querySelector('input[name="CustomerFirstName"]').value;
  var lastName = document.querySelector('input[name="CustomerLastName"]').value;
  var phone = document.querySelector('input[name="CustomerPhone"]').value;
  var password = document.querySelector('input[name="CustomerPassword"]').value;

  console.log('Form Data:');
  console.log('First Name:', firstName);
  console.log('Last Name:', lastName);
  console.log('Phone:', phone);
  console.log('Password:', password);

  // Create a URL-encoded string from the form data
  var formData = new URLSearchParams();
  formData.append('CustomerFirstName', firstName);
  formData.append('CustomerLastName', lastName);
  formData.append('CustomerPhone', phone);
  formData.append('CustomerPassword', password);

  // Send a POST request to the server
  fetch('fetch_data.php', {
    method: 'POST',
    body: formData
  })
    .then(function (response) {
      if (response.ok) {
        // Successful response
        console.log('Sign-up successful!');
        // Add any further actions or redirects here
      } else {
        // Error occurred
        console.log('Sign-up failed!');
      }
    })
    .catch(function (error) {
      // Error occurred during the request
      console.error('Error:', error);
    });
}

// Add an event listener to the form's submit event
document.querySelector('.form').addEventListener('submit', function (event) {
  event.preventDefault(); // Prevent the default form submission
  signUp(); // Call the signUp function
});

</script>
</body>
</html>