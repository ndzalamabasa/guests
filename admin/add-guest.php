<?php
// Variables to make inputs persist in the form
$fullname = $country = $status = $chartedFlight = $arrival = $departure = $affiliation = $commercialFlight = $accomodation = $transport = $passport = $covid = $miscellaneous = '';

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
      <div class="form-content">
        <!-- Form Heading and global errors section-->
        <div class = "header">
          <h1 class="text-3xl font-bold text-center underline">Add Guest</h1>
        </div>

        <!-- Sign Up Form -->
        <form action="add-guest.php" method="post">
          <ul class="registration">
            <!-- Fullname -->
            <li>
              <label for="fullname" class="border-2 border-solid rounded-small border-blue-800">Fullname</label>
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
                <option value="">Normal</option>
                <option value="Student">VIP</option>
              </select>
            </li>
            <!-- Charted Flight -->
            <li>
              <label for="charted-flight">Charted Flight</label>
              <input type="text" name="charted-flight" id="charted-flight" value="<?php echo htmlspecialchars($chartedFlight)?>">
            </li>
            <!-- Arrival -->
            <li>
              <label for="arrival">Arrival</label>
              <input type="text" name="arrival" id="arrival" value="<?php echo htmlspecialchars($arrival)?>">
            </li>
            <!-- Departure -->
            <li>
              <label for="departure">Departure</label>
              <input type="text" name="departure" id="departure" value="<?php echo htmlspecialchars($departure)?>">
            </li>
            <!-- Affiliation -->
            <li>
              <label for="affiliation">Affiliation</label>
              <input type="text" name="affiliation" id="affiliation" value="<?php echo htmlspecialchars($affiliation)?>">
            </li>
            <!-- Commercial Flight -->
            <li>
              <label for="commercial-flight">Commercial Flight</label>
              <input type="text" name="commercial-flight" id="commercial-flight" value="<?php echo htmlspecialchars($commercialFlight)?>">
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
              <input type="text" name="passport" id="passport" value="<?php echo htmlspecialchars($passport)?>">
            </li>
            <!-- Covid -->
            <li>
              <label for="covid">Covid</label>
              <input type="text" name="covid" id="covid" value="<?php echo htmlspecialchars($covid)?>">
            </li>
            <!-- Miscellaneous -->
            <li>
              <label for="miscellaneous">Miscellaneous</label>
              <input type="text" name="miscellaneous" id="miscellaneous" value="<?php echo htmlspecialchars($miscellaneous)?>">
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