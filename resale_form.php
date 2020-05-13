
<!DOCTYPE html>
<html>
  <head>
    <title>Resale</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
    <style>
      html, body {
      min-height: 100%;
      }
      body, div, form, input, select, textarea, p { 
      padding: 0;
      margin: 0;
      outline: none;
      font-family: Roboto, Arial, sans-serif;
      font-size: 14px;
      color: #666;
      line-height: 22px;
      }
      h1 {
      position: absolute;
      margin: 0;
      font-size: 36px;
      color: #fff;
      z-index: 2;
      }
      .testbox {
      display: flex;
      justify-content: center;
      align-items: center;
      height: inherit;
      padding: 20px;
      }
      form {
      width: 100%;
      padding: 20px;
      border-radius: 6px;
      background: #fff;
      box-shadow: 0 0 20px 0 #333; 
      }
      .banner {
      position: relative;
      height: 210px;
      display: flex;
      justify-content: center;
      align-items: center;
      text-align: center;
      }
      .banner::after {
      content: "";
      background-color: rgba(0, 0, 0, 0.4); 
      position: absolute;
      width: 100%;
      height: 100%;
      }
      input, textarea, select {
      margin-bottom: 10px;
      border: 1px solid #ccc;
      border-radius: 3px;
      }
      input {
      width: calc(100% - 10px);
      padding: 5px;
      }
      select {
      width: 100%;
      padding: 7px 0;
      background: transparent;
      }
      textarea {
      width: calc(100% - 12px);
      padding: 5px;
      }
      .item:hover p, .item:hover i, .question:hover p, .question label:hover, input:hover::placeholder {
      color: #333;
      }
      .item input:hover, .item select:hover, .item textarea:hover {
      border: 1px solid transparent;
      box-shadow: 0 0 6px 0 #333;
      color: #333;
      }
      .item {
      position: relative;
      margin: 10px 0;
      }
      input[type="date"]::-webkit-inner-spin-button {
      display: none;
      }
      .item i, input[type="date"]::-webkit-calendar-picker-indicator {
      position: absolute;
      font-size: 20px;
      color: #a9a9a9;
      }
      .item i {
      right: 1%;
      top: 30px;
      z-index: 1;
      }
      [type="date"]::-webkit-calendar-picker-indicator {
      right: 0;
      z-index: 2;
      opacity: 0;
      cursor: pointer;
      }
      input[type="time"]::-webkit-inner-spin-button {
      margin: 2px 22px 0 0;
      }
      input[type=radio], input.other {
      display: none;
      }
      label.radio {
      position: relative;
      display: inline-block;
      margin: 5px 20px 10px 0;
      cursor: pointer;
      }
      .question span {
      margin-left: 30px;
      }
      label.radio:before {
      content: "";
      position: absolute;
      top: 2px;
      left: 0;
      width: 15px;
      height: 15px;
      border-radius: 50%;
      border: 2px solid #ccc;
      }
      #radio_5:checked ~ input.other {
      display: block;
      }
      input[type=radio]:checked + label.radio:before {
      border: 2px solid #444;
      background: #444;
      }
      label.radio:after {
      content: "";
      position: absolute;
      top: 7px;
      left: 5px;
      width: 7px;
      height: 4px;
      border: 3px solid #fff;
      border-top: none;
      border-right: none;
      transform: rotate(-45deg);
      opacity: 0;
      }
      input[type=radio]:checked + label:after {
      opacity: 1;
      }
      .btn-block {
      margin-top: 10px;
      text-align: center;
      }
      button {
      width: 150px;
      padding: 10px;
      border: none;
      border-radius: 5px; 
      background: #444;
      font-size: 16px;
      color: #fff;
      cursor: pointer;
      }
      button:hover {
      background: #666;
      }
      @media (min-width: 568px) {
      .name-item, .city-item {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      }
      .name-item input, .city-item input {
      width: calc(50% - 20px);
      }
      .city-item select {
      width: calc(50% - 8px);
      }
      }
    </style>
  </head>
  <body>
    <div class="testbox">
      <form action="/">
        <div class="banner">
          <h1>Resale Car Form</h1>
        </div>
        <div class="item">
          <b>Car Details:</b>
          <div class="name-item">
            <input type="text" name="name" placeholder="Car Name (along with manufacturer name | eg - Ford EcoSport)" required/>
            <input type="text" name="name" placeholder="Manufacturer Name"  required/>
          </div>
          <div class="name-item">
            <input type="text" name="name" placeholder="Color"  required/>
            <input type="number" name="name" placeholder="Mileage" step="0.1" min="0"  required/>
          </div>
        </div>
        <!--
          <div class="question">
          <p>Vehicle Type:</p>
          <div class="question-answer">
            <div>
              <input type="radio" value="none" id="radio_1" name="vehicle" />
              <label for="radio_1" class="radio"><span>Limousine (8-12 person)</span></label>
            </div>
            <div>
              <input type="radio" value="none" id="radio_2" name="vehicle" />
              <label for="radio_2" class="radio"><span>SUV (6-7 person)</span></label>
            </div>
            <div>
              <input type="radio" value="none" id="radio_3" name="vehicle" />
              <label for="radio_3" class="radio"><span>Sedan(4-5person)</span></label>
            </div>
            <div>
              <input type="radio" value="none" id="radio_4" name="vehicle" />
              <label for="radio_4" class="radio"><span>HatchBack (4-5 person)</span></label>
            </div>
            <div>
              <input type="radio" value="none" id="radio_4" name="vehicle" />
              <label for="radio_5" class="radio"><span>Coupe (1-2 person)</span></label>
            </div>
            <div>
              <input type="radio" value="none" id="radio_5" name="vehicle" />
              <label for="radio_6" class="radio other"><span>Other</span></label>
              <input class="other" type="text" name="name" />
            </div>
          </div>
        </div>

      -->

      <div class="item">
        Manufacture Date
        <input type="date" name="m_date" required/>
      </div>

        <div class="item">
        	<select>
              <option value="">Fuel Type</option>
              <option value="1">Petrol</option>
              <option value="2">Diesel</option>
            </select>
		</div>
		<div class="name-item">
          <input type="number" name="name" placeholder="Kilometers driven (in numbers only)" min="0"  required>
          <input type="number" name="name" placeholder="Resale Price (in numbers only)" min="0"  required>
        </div>

        <!--
          <div class="item">
          <p>Dealer Name</p>
          <div class="name-item">
            <input type="text" name="name" placeholder="First" />
            <input type="text" name="name" placeholder="Last" />
          </div>
        </div>
        <div class="item">
          <p>Dealer Email</p>
          <input type="email" name="name"/>
        </div>
        <div class="item">
          <p>Dealer Phone</p>
          <input type="tel" name="phone" pattern="[0-9]{10}"/>
        </div>
        <div class="item">
          <p>Dealer Website</p>
          <input type="url" name="name"/>
        </div>
        <div class="item">
          <p>Manufacturer Name</p>
          <div class="name-item">
            <input type="text" name="name"/>
            
          </div>
        </div>
        <div class="item">
          <p>Manufacturer Email</p>
          <input type="email" name="name"/>
        </div>
        <div class="item">
          <p>Manufacturer Phone</p>
          <input type="tel" name="phone" pattern="[0-9]{10}"/>
        </div>
        <div class="item">
          <p>Manufacturer Website</p>
          <input type="url" name="name"/>
        </div>
      -->

      <b>FEATURES (required)</b>
      <div class="name-item">
        <input type="text" name="name" placeholder="Car feature 1"  required>
        <input type="text" name="name" placeholder="Car feature 2" required>
      </div>

      <div class="name-item">
        <input type="text" name="name" placeholder="Car feature 3" required>
        <input type="text" name="name" placeholder="Car feature 4" required>
      </div>
        
        
        <div class="btn-block">
          <button type="submit" href="/">SEND</button>
        </div>
      </form>
    </div>
  </body>
</html>