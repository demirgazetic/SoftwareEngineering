

<div class="row">
    <form class="col-md-6 col-md-offset-3" method="POST">
      <div class="form-group">
        <label for="inputNumber">Number</label>
        <input type="text" class="form-control" id="inputNumber" name="number" placeholder="Enter number" required>
      </div>
      <button class="btn btn-primary" type="submit">Send message</button>
      <?php
      error_reporting(E_ALL);
      ini_set('display_errors', 1);
      if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, "https://rest.nexmo.com/sms/json");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt(
          $ch,
          CURLOPT_POSTFIELDS,
          "from=Nexmo&text=Hello from Nexmo&to=" . $_POST['number'] . "&api_key=3ff0eee8&api_secret=JZoHjdy50SQMsWzN"
        );

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $server_output = curl_exec($ch);
        $manage = json_decode($server_output, true);
        if ($manage['message-count'] == 1) {
          echo "Message sent successfuly";
        } else {
          echo "Message sent unsuccessfuly";
        }

        curl_close($ch);
        var_dump($server_output);
      }
     
    
      ?>
      
    </form>
  </div>