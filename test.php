<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .three-divs-section {
  display: flex;
  justify-content: space-between;
  width: 100%;
  margin-top: 50px;
}

.div {
  flex-basis: calc(33.33% - 20px);
  height: 320px;
  border-radius: 320px;
  background-color: white;
  text-align: center;
  padding-top: 20px;
  margin-right: 20px;
}

.div:last-child {
  margin-right: 0;
}

.div img {
  width: 202px;
  height: 200px;
  margin-top: -20px;
}

.div h1 {
  font-size: 20px;
  color: #333333;
}

.div p {
  color: #333333;
  font-weight: 300;
  font-size: 30px;
}
    </style>
</head>
<body>
<section class="three-divs-section">
  <div class="div" id="div1">
    <img src="" alt="Image 1" id="image1">
    <h1 id="title1"></h1>
    <p id="text1"></p>
  </div>
  <div class="div" id="div2">
    <img src="" alt="Image 2" id="image2">
    <h1 id="title2"></h1>
    <p id="text2"></p>
  </div>
  <div class="div" id="div3">
    <img src="" alt="Image 3" id="image3">
    <h1 id="title3"></h1>
    <p id="text3"></p>
  </div>
  <div class="div" id="div4">
    <img src="" alt="Image 3" id="image3">
    <h1 id="title3"></h1>
    <p id="text3"></p>
  </div>
</section>
<script src="script.js"></script>
</body>
</html>