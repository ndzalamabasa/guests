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
              <!-- <span><p class="log-reg-error"><?php //echo $errors['fullname'];?></p></span> -->
            </li>
            <!-- Country -->
            <li>
              <label for="country">Country</label>
              <input type="text" name="country" id="country" value="<?php echo htmlspecialchars($country)?>">
            </li>
            <!-- Status -->
            <li>
              <label for="status">Status</label>
              <select name="status" id="status">
                <option value="normal">Normal</option>
                <option value="vip">VIP</option>
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
                      <input type="radio" name="flight" id="no">No
                    </span>
                  </div>
            </li>
            <!-- Commercial Flight -->
            <li>
              <label for="commercial-flight">Commercial Flight</label>
              <input type="text" name="commercial-flight" id="commercial-flight" value="<?php echo htmlspecialchars($commercialFlight)?>">
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
              <input type="text" name="accomodation" id="accomodation" value="<?php echo htmlspecialchars($accomodation)?>">
            </li>
            <!-- Transport -->
            <li>
              <label for="transport">Transport</label>
              <input type="text" name="transport" id="transport" value="<?php echo htmlspecialchars($transport)?>">
            </li>
            <!-- Passport -->
            <li>
              <label for="passport">Passport</label>
              <div class="passport">
                <span class="check-passport">
                  <input type="radio" name="passport" id="yes" value="yes">Yes
                </span>
                <span class="check-passport">
                  <input type="radio" name="passport" id="no">No
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
                  <input type="radio" name="covid" id="no">No
                </span>
            </li>
            <!-- Miscellaneous -->
            <li>
              <label for="miscellaneous">Miscellaneous</label>
              <input type="text" name="miscellaneous" id="miscellaneous" value="<?php echo htmlspecialchars($miscellaneous)?>">
            </li>
            <!-- Invited by -->
            <li>
              <label for="invited-by">Invited By</label>
              <input type="text" name="invited-by" id="invited-by" value="<?php echo htmlspecialchars($invitedBy)?>">
            </li>
            <!-- Group -->
            <li>
              <label for="group">Group</label>
              <select name="group" id="group">
                <option value="">Select Group</option>
                <option value="AUC Namibia">AUC Namibia</option>
                <option value="AUC Durban">AUC Durban</option>
                <option value="AUC Cape Town">AUC Cape Town</option>
                <option value="Events Manageer / Comm Members">Events Manager/Comm Members</option>
                <option value="Directors">Directors</option>
                <option value="Chairman's Office">Chairman's Office</option>
                <option value="AU Commercial Investments">AU Commercial Investments</option>
                <option value="AU Food Security">AU Food Security</option>
                <option value="AU Aviation">AU Aviation</option>
                <option value="AU Health">AU Health</option>
                <option value="AU Technologies">AU Technogies</option>
                <option value="AU Admin">AU Admin</option>
                <option value="AU Commodity House">AU Commodity House</option>
                <option value="AU Travel">AU Travel</option>
                <option value="QPay">QPay</option>
                <option value="AU Consultants">AU Consultants</option>
                <option value="RSA International Guests">RSA International Guests</option>
              </select>
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