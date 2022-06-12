<?php
// Variables to make inputs persist in the form
$fullname = $country = $status = $chartedFlight = $arrival = $departure = $affiliation = $commercialFlight = $accomodation = $transport = $passport = $covid = $miscellaneous = $invitedBy = $group = '';

// Array to errors error messages
$errors = array('fullname' => '', 'stmt'=>'');

// Check if the submit button have been clicked and process the form
if (isset($_POST["submit"])){

  $fullname = $_POST["fullname"];
  $country = $_POST["country"];
  $status = ($_POST["status"]);
  $chartedFlight = ($_POST["charted-flight"]);
  $arrival = ($_POST["arrival"]);
  $departure = ($_POST["departure"]);
  $affiliation = ($_POST["affiliation"]);
  $commercialFlight = ($_POST["commercial-flight"]);
  $accomodation = ($_POST["accomodation"]);
  $transport = ($_POST["transport"]);
  $passport = ($_POST["passport"]);
  $covid = ($_POST["covid"]);
  $miscellaneous = ($_POST["miscellaneous"]);
  $invitedBy = ($_POST["invited-by"]);
  $group = ($_POST["group"]);

  // Connect to the database
  require_once('includes/database_inc.php');

  // Function to create a new user to store t the database
  function createUser($con, $fullname, $country, $status, $chartedFlight, $arrival, $departure, $affiliation, $commercialFlight, $accomodation, $transport, $passport, $covid, $miscellaneous){
    
    // SQL statement to get data from staff members table from the database
    $sql = "INSERT INTO guests (fullname, country, status, chartedFlight, arrival, departure, affiliation, commercialFlight, accomodation, transport, passport, covid, miscellaneous) VALUES (?,?,?,?,?,?,?,?,?,?,?,?);";
    
    // Create a prepared statement
    $stmt = $con -> stmt_init();
    
    // Display an error if preparing statemnt failed
    if(!$stmt -> prepare($sql)){
      $errors['stmt'] = 'stmtfailed';
    }
    
    // Bind statement to variables
    $stmt -> bind_param("ssssssssssssss", $fullname, $country, $status, $chartedFlight, $arrival, $departure, $affiliation, $commercialFlight, $accomodation, $transport, $passport, $covid, $miscellaneous);
    
    // Execute statement
    $stmt -> execute();
    
    // Close statement
    $stmt -> close();
  }

  // Error to display if fullname is empty
  if(empty($fullname)){
    $errors['fullname'] = 'Fullname is required';
  }
  
  if(!empty($fullname)){
    createUser($con, $fullname, $country, $status, $chartedFlight, $arrival, $departure, $affiliation, $commercialFlight, $accomodation, $transport, $passport, $covid, $miscellaneous);
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"
      integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
  <link rel="stylesheet" href="../css/style.css">
  <title>Add Guest</title>
</head>
<body>
  <!-- Header/Navigation from Partials folder -->
  <?php @include ('partials/menu.php')?>

  <main>
    <div class="form-container">
    <h1 class="page-heading">Add Guest</h1>
      <div class="form-content container">
        <!-- Sign Up Form -->
        <form action="add-guest.php" method="post">
          <ul class="add-guest">
            <!-- Fullname -->
            <li>
              <label for="fullname">Fullname</label>
              <input type="text" name="fullname" id="fullname" value="<?php echo htmlspecialchars($fullname)?>">
              <span><p class="log-reg-error"><?php echo $errors['fullname'];?></p></span>
            </li>
            <!-- Country -->
            <li>
              <label for="country">Country</label>
              <select name="country" id="country">
                <option value="">Select Country</option>
                <option value="1">USA</option>
                <option value="2">Cape Town, RSA</option>
                <option value="3">Durban, RSA</option>
                <option value="4">RSA</option>
                <option value="5">Senegal</option>
                <option value="6">Kenya</option>
                <option value="7">Namibia</option>
                <option value="8">DRC</option>
                <option value="9">Ghana</option>
                <option value="10">UK</option>
                <option value="11">Dubai, UAE</option>
                <option value="12">Scotland</option>
                <option value="13">Choma, Zambia</option>
                <option value="14">Kabwe, Zambia</option>
                <option value="15">Ndola, Zambia</option>
                <option value="16">Petauke, Zambia</option>
                <option value="17">Livingstone</option>
                <option value="18">Lusaka, Zambia</option>
                <option value="19">Zambia</option>
                <option value="20">Zimbabwe</option>
                <option value="21">Bulgaria</option>
                <option value="22">Nigeria</option>
                <option value="23">Italy</option>
              </select>
            </li>
            <!-- Status -->
            <li>
              <label for="status">Status</label>
              <select name="status" id="status">
                <option value="Normal">Normal</option>
                <option value="VIP">VIP</option>
              </select>
            </li>
            <!-- Charted Flight -->
            <li>
              <label for="charted-flight">Charted Flight</label>
              <div class="charted-flight">
                <span class="check-flight">
                  <input type="radio" name="flight" id="yes" value="yes">Yes
                </span>    
                <span class="check-flight">
                  <input type="radio" name="flight" id="no" value="no">No
                </span>
              </div>
            </li>
            <!-- Commercial Flight -->
            <li>
              <label for="commercial-flight">Commercial Flight</label>
              <select name="commercial-flight" id="commercial-flight">
                <option value="1">USA-RSA-RTN</option>
                <option value="2">SENEGAL-RSA-RTN</option>
                <option value="3">KENYA-RSA-RTN</option>
                <option value="4">GHANA-RSA-RTN</option>
                <option value="5">DUBAI-RSA-RTN</option>
                <option value="6">UK-LUN-RTN</option>
                <option value="7">USA-LUN-RTN</option>
                <option value="8">SCOTLAND-LUN-RTN</option>
                <option value="9">LVI-JNB-OW</option>
                <option value="10">JNB-LVI-JNB-RTN</option>
                <option value="11">JNB-LVI-LUN-JNB</option>
                <option value="12">NYC-JNB-LVI-NYC</option>
                <option value="13">NYC-LVI-NYC</option>
                <option value="14">LUN-JNB-OW</option>
                <option value="15">NYC-LUN-NYC</option>
                <option value="16">NYC-DBX-JNB-NYC</option>
              </select>
            </li>
            <!-- Arrival -->
            <li>
              <label for="arrival">Arrival</label>
              <input type="date" name="arrival" id="arrival" value="<?php echo htmlspecialchars($arrival)?>">
            </li>
            <!-- Departure -->
            <li>
              <label for="departure">Departure</label>
              <input type="date" name="departure" id="departure" value="<?php echo htmlspecialchars($departure)?>">
            </li>
            <!-- Affiliation -->
            <li>
              <label for="affiliation">Affiliation</label>
              <input type="text" name="affiliation" id="affiliation" value="<?php echo htmlspecialchars($affiliation)?>">
            </li>
            <!-- Accomodation -->
            <li>
              <label for="accomodation">Accomodation</label>
              <select name="accomodation" id="accomodation">
                <option value="Yes">YES</option>
                <option value="Yes-Sharing">YES-Sharing</option>
              </select>
            </li>
            <!-- Transport -->
            <li>
              <label for="transport">Transport</label>
              <select name="transport" id="transport">
                <option value="Yes">Yes</option>
                <option value="By Road">By Road</option>
              </select>
            </li>
            <!-- Passport -->
            <li>
              <label for="passport">Passport</label>
              <div class="passport">
                <span class="check-passport">
                  <input type="radio" name="passport" id="yes" value="yes">Yes
                </span>
                <span class="check-passport">
                  <input type="radio" name="passport" id="no" value="no">No
                </span>
              </div>
            </li>
            <!-- Covid -->
            <li>
              <label for="covid">Covid</label>
              <div class="covid">
                <span class="check-covid">
                  <input type="radio" name="covid" id="yes" value="yes">Yes
                </span>
                <span class="check-covid">
                  <input type="radio" name="covid" id="no" value="no">No
                </span>
              </div>
            </li>
            <!-- Miscellaneous -->
            <li>
              <label for="miscellaneous">Miscellaneous</label>
              <input type="text" name="miscellaneous" id="miscellaneous" value="<?php echo htmlspecialchars($miscellaneous)?>">
            </li>
            <!-- Invited by -->
            <li>
              <label for="invited-by">Invited By</label>
              <select name="invited-by" id="invited-by">
                <option value="">Select Inviter</option>
                <option value="1">Mrs T.Ndambo</option>
                <option value="2">Mrs Dos antos</option>
                <option value="3">Matildah Pikiti</option>
                <option value="4">Linda Mtonga</option>
                <option value="5">Ms R.Ndambo</option>
                <option value="6">Mrs A.Masebo</option>
              </select>
            </li>
            <!-- Group -->
            <li>
              <label for="group">Group</label>
              <select name="group" id="group">
                <option value="">Select Group</option>
                <option value="1">AUC Namibia</option>
                <option value="2">AUC Durban</option>
                <option value="3">AUC Cape Town</option>
                <option value="4">Events Manager/Comm Members</option>
                <option value="5">Directors</option>
                <option value="6">Chairman's Office</option>
                <option value="7">AU Commercial Investments</option>
                <option value="8">AU Food Security</option>
                <option value="9">AU Aviation</option>
                <option value="10">AU Health</option>
                <option value="11">AU Technogies</option>
                <option value="12">AU Admin</option>
                <option value="13">AU Commodity House</option>
                <option value="14">AU Travel</option>
                <option value="15">QPay</option>
                <option value="16">AU Consultants</option>
                <option value="17">RSA International Guests</option>
              </select>
            </li>
          </ul>
          <!-- Submit button -->
          <input type="submit" name="submit" value="Add Guest">
        </form>
      </div>
    </div>
  </main>

  <!-- Script for error messages -->
  <!-- <script src="scripts/menu.js"></script>
  <script src="message.js"></script> -->

</body>
</html>