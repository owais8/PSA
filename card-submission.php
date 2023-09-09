
<?php
session_start();
require_once('config.php');
$conn=connectDB();
$id=$_SESSION["user_id"];

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve form data
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $email = $_POST["email"];
    $phone_number = $_POST["phone_number"];
    $address = $_POST["address"];
    $street_address = $_POST["street_address"];
    $address_line2 = $_POST["address_line2"];
    $state = $_POST["state"];
    $coupon_code = $_POST["coupon_code"];
    $referral_code = $_POST["referral_code"];
    $total_price = $_POST["total_price"];
    $total_price = str_replace(['$', ','], '', $total_price);

    $total_grading_price = $_POST["total_grading_price"];
    $total_grading_price = str_replace(['$', ','], '', $total_grading_price);

    $total_evaluation_price = $_POST["total_evaluation_price"];
    $total_evaluation_price = str_replace(['$', ','], '', $total_evaluation_price);

    $card_value = $_POST["card_value"];
    $service_provider = $_POST["service_provider"];
    $card_quantity = $_POST["card_quantity"];
    // Insert data into the database using SQLi (not recommended for production)
    $sql = "INSERT INTO submissions (first_name, last_name, email, phone_number, address, street_address, address_line2, state, coupon_code, referral_code, total_price, total_grading_price, total_evaluation_price, card_value, service_provider, card_quantity, user_id)
            VALUES ('$first_name', '$last_name', '$email', '$phone_number', '$address', '$street_address', '$address_line2', '$state', '$coupon_code', '$referral_code', '$total_price', '$total_grading_price', '$total_evaluation_price', '$card_value', '$service_provider', '$card_quantity', '$id')";

    if ($conn->query($sql) === TRUE) {
        $submission_id = $conn->insert_id;
        header("Location: logging.php?id=" . $submission_id); // Redirect to insurance page

        echo "Form data has been successfully submitted!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Source+Sans+3"
      rel="stylesheet"
    />
  </head>

  <body>
  <?php include 'navbar.php'; ?>

    <form action="" method='post' class="container-md" id='myForm'>
      <h2><b>CARD SUBMISSION</b></h2>
      <p>You are more than welcome to submit different service levels in the same package to us (ex: PSA bulk & SGC regular).</p>
  
      <p>However each service level needs a different order placed on our site, as they would come back at different times.</p>
  
      <p>So you would place your order for (ex: 20  cards bulk, complete shipping and place order) then place a new order for the other service(s) you need.</p>
  
      <p>You would then print out your 2 packing slips, put each form with the cards going each service level in the 1 package.</p>
  
      <p>This allows you to get status updates on each individual order. If submitting just 1 order type (ex: PSA bulk) simply put your packing slip with the cards and you are good to go!</p>
  
      <p>Good luck on your submission, and thank you for choosing kksportscards.</p>
      <br>
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="email">First Name:</label>
            <input
              name="first_name"
              type="text"
              class="form-control"
              id="email"
              required="true"
            />
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="email">Last Name:</label>
            <input
              name="last_name"
              type="text"
              class="form-control"
              id="email"
              required="true"
            />
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="email">Email:</label>
            <input
              name="email"
              type="email"
              class="form-control"
              id="email"
              required="true"
            />
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="email">Phone Number:</label>
            <input
              name="phone_number"
              type="text"
              class="form-control"
              id="email"
              required="true"

            />
          </div>
        </div>
      </div>
      <br />
      <br />
      <br />

      <h2 class="h2">SHIPPING</h2>
      <div class="row">
      <div class="form-group">
        <label for="email">Your Address:</label>
        <input
          name="address"
          type="text"
          class="form-control"
          id="email"
          required="true"

        />
      </div>
    </div>
    <div class="row">
      <div class="form-group">
        <label for="pwd">Street Address:</label>
        <input
          name="street_address"
          type="text"
          class="form-control"
          id="pwd"
          required="true"

        />
      </div>
    </div>
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="email">Address Line 2:</label>
            <input
              name="address_line2"
              type="text"
              class="form-control"
              id="email"
              required="true"

            />
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="email">State:</label>
            <input
              name="state"
              type="text"
              class="form-control"
              id="email"
              required="true"

            />
          </div>
        </div>
      </div>
      <br>
      <table id='myTable' class="table table-sm table-borderless">
        <thead>
          <tr>
            <th scope="col">Service Provider</th>
            <th scope="col">Grading Subtotal - Due at End of Grading</th>
            <th scope="col">Evaluation Subtotal</th>
            <th scope="col">Total</th>

          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
      <button style="margin-bottom: 20px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#largeScrollableModal">
        Add Group
      </button >
      <br>
      <div class="row">
        <div class="col">
          <div class="form-group">
            <label for="email">Coupon Code</label>
            <input
              name="coupon_code"
              type="text"
              class="form-control"
              id="email"
            />
          </div>
        </div>
        <div class="col">
          <div class="form-group">
            <label for="email">Referral Code:</label>
            <input
              name="referral_code"
              type="text"
              class="form-control"
              id="email"
            />
          </div>
        </div>
      </div>
      <input type="hidden" name="total_price" id="total_price" value="0" required>
      <input class='input-hidden' type="text" name="total_grading_price" id="total_grading_price" value="0" required>
      <input type="hidden" name="total_evaluation_price" id="total_evaluation_price" value="0" required>
      <input type="hidden" name="card_value" id="card_value" value="0" required="required">
      <input type="hidden" name="service_provider" id="service_provider" required="true">
      <input type="hidden" name="card_quantity" id="card_quantity" required="required">


<!-- Button trigger modal -->


      <!-- Large Scrollable Modal -->
      <div class="modal fade" id="largeScrollableModal" tabindex="-1" aria-labelledby="largeScrollableModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="largeScrollableModalLabel">Add Group</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                
                    <!-- 1. Evaluate Cards Check Button -->
                    <div class="mb-3 form-check">
                        <input class="form-check-input" type="checkbox" id="evaluateCardsCheck">
                        <label class="form-check-label" for="evaluateCardsCheck">Evaluate Cards</label>
                    </div>
                    <p>
                      WHAT IS CARD EVALUATION?
                      - Evaluation is a service we offer where we will look over your card(s) and put aside any cards we do not believe will grade a 9-10. It includes a wipe down for fingerprints or dust and gets put in a fresh sleeve before submission. We will contact you with any rejects/concerns Evaluation is strictly based on our opinion and is not guaranteed as we are not the ones grading them at PSA. Grading is a subjective process.
                  
                      - What is Cracking: Cracking is where we will crack a card out of a graded slab for you, and resubmit for PSA's opinion. We are highly trained in cracking slabs from PSA, BGS, SGC among other companies.
                  
                      Evaluation is $3 per card.
                    </p>
                    <!-- 2. Service Provider Select Element -->
                    <div class="mb-3">
                        <label for="serviceProviderSelect" class="form-label">Service Provider</label>
                        <select class="form-select" id="serviceProviderSelect">
                            <option value="PSA">PSA</option>
                            <option value="SGC">SGC</option>
                        </select>
                    </div>

                    <!-- 3. PSA Quantity Input Field -->
                    <div class="mb-3">
                        <label for="psaQuantityInput" class="form-label">PSA Quantity</label>
                        <input type="number" class="form-control" id="psaQuantityInput">
                    </div>

                    <!-- 4. PSA Grading Select -->
                    <div class="mb-3">
                        <label for="psaGradingSelect" class="form-label">PSA Grading</label>
                        <select name="input_24" id="input_2_24" class="form-select large gfield_select" aria-describedby="gfield_description_2_24" aria-required="true" aria-invalid="false" data-conditional-logic="visible">
                          <option value="PSA Bulk 1980-present- $19 per card - Max Declared Value: $499 - Est. Turnaround : 60 Business Days|19">PSA Bulk 1980-present- $19 per card - Max Declared Value: $499 - Est. Turnaround : 60 Business Days</option>
                          <option value="PSA Bulk 1979-older- $19 per card - Max Declared Value: $499 - Est. Turnaround: 60 Business Days|19">PSA Bulk 1979-older- $19 per card - Max Declared Value: $499 - Est. Turnaround: 60 Business Days</option>
                          <option value="PSA Bulk Dual 1980-present - $25 per card - Max Declared Value: $499 - Est. Turnaround: 75 Business Days|25">PSA Bulk Dual 1980-present - $25 per card - Max Declared Value: $499 - Est. Turnaround: 75 Business Days</option>
                          <option value="PSA Value 1980-present- $25 per card - Max Declared Value: $499 - Est. Turnaround: 65 Business Days|25">PSA Value 1980-present- $25 per card - Max Declared Value: $499 - Est. Turnaround: 65 Business Days</option>
                          <option value="PSA Value 1979-older- $25 per card - Max Declared Value: $499 - Est. Turnaround: 65 Business Days|25">PSA Value 1979-older- $25 per card - Max Declared Value: $499 - Est. Turnaround: 65 Business Days</option>
                          <option value="PSA Value Plus - $40 per card - Max Declared Value: $499 - Est. Turnaround: 20 Business Days|40">PSA Value Plus - $40 per card - Max Declared Value: $499 - Est. Turnaround: 20 Business Days</option>
                          <option value="PSA Regular- $75 per card - Max Declared Value: $1,499 - Est. Turnaround: 10 Business Days|75">PSA Regular- $75 per card - Max Declared Value: $1,499 - Est. Turnaround: 10 Business Days</option>
                          <option value="PSA Regular Dual - $110 per card - Max Declared Value: $1,499 - Est. Turnaround: 15 Business Days|110">PSA Regular Dual - $110 per card - Max Declared Value: $1,499 - Est. Turnaround: 15 Business Days</option>
                          <option value="PSA Express- $170 per card - Max Declared Value: $2,499 - Est. Turnaround: 5 Business Days|170">PSA Express- $170 per card - Max Declared Value: $2,499 - Est. Turnaround: 5 Business Days</option>
                          <option value="PSA Express Dual- $215 per card - Max Declared Value: $2,499 - Est. Turnaround: 10 Business Days|215">PSA Express Dual- $215 per card - Max Declared Value: $2,499 - Est. Turnaround: 10 Business Days</option>
                          <option value="PSA Super Express- $330 per card - Max Declared Value $4,999 - Est. Turnaround: 3 Business Days|330">PSA Super Express- $330 per card - Max Declared Value $4,999 - Est. Turnaround: 3 Business Days</option>
                          <option value="2023 NATIONAL ON-SITE GRADING|150">2023 NATIONAL ON-SITE GRADING</option>
                      </select>
                      
                    </div>
                    <h6><b>Evaluation</b></h6>
                
                    <!-- Price Calculation -->
                    <p>
                        Price:
                        <span id="evaluationPrice">0</span>
                    </p>
                    <h5><b>Group Price</b></h5>
                    <hr>

                    <h6><b>Grand Total - Due at end of grading</b></h6>
                
                    <!-- Price Calculation -->
                    <p>
                        Price:
                        <span id="grandTotal">0</span>
                    </p>
                    <h6><b>Total Price</b></h6>
                
                    <!-- Price Calculation -->
                    <p>
                        Total:
                        <span id="totalPrice">0</span>
                    </p>
                    
                  </div>
                  <button type="button" id="group_data" class="btn btn-primary">Save changes</button>

                  </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Submit</button>
    </form>
    <hr />
  </body>
  <?php include 'footer.php'; ?>

  <script src="https://cdn.jsdelivr.net/npm/popper.js@2.11.6/dist/umd/popper.min.js"></script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script src="main.js"></script>
</html>
