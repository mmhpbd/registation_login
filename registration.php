<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link rel="stylesheet" href="./css/log_regi.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"
    integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    body {
      background-image: url(./css/earth-g19c3d3f89_1920.jpg);
      background-repeat: no-repeat;
      height: 100%;
      width: 100%;
      color:white !important;
    }
  </style>
<body>
   <div class="container">
    <?php
    if(isset($_POST["submit"])){
      $fullName = $_POST["fullname"];
      $email = $_POST["email"];
      $comname = $_POST["comname"];
      $number = $_POST["number"];
      $password = $_POST["password"];
      $passwordRepeat = $_POST["repeat_password"];
      
      $passwordHash = password_hash($password, PASSWORD_DEFAULT);

      $erros = array();
      
      if(empty($fullName) OR empty($email) OR empty($comname) OR empty($number) OR empty($password) OR empty($passwordRepeat)) {
        array_push($erros,"All Fields Are Required");
      }

      if(!filter_var($email, FILTAR_VALIDATE_EMAIL)) {
        array_push($erros, "Email is not Valid");
      }
      if(strlen($password)<8) {
        array_push($erros, "Password must be at least 8 characters long");
      }
      if($password==$passwordRepeat) {
        array_push($erros, "Password does not match");
      }
      if(count($erros)>0) {
        foreach($erros as $erros){
          echo"<div class='alert alert-danger'>$error</div>";
        }
      }
      else{
        require_once "database.php";
        $sql = "INSERT INTO user (fullName, email, comname, number, password, passwordRepeat) value (?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        $preparestmt = mysqli_stmt_perpare($stmt,$sql);
        if($preparestmt) {
          mysqli_stmt_bind_param($stmt,"sss", $fullName, $email, $comname, $number, $passwordHash);
        }
      }
    }
    ?>
    <div class="registration">
      <h1>Ragistration Form</h1>
    <form action="registration.php" method="post">
      <div class="mb-3">
        <label for="exampleInput" class="form-label">Name</label>
        <input type="text" class="form-control" id="exampleInput" name="fullname" placeholder="your Name">
      </div>
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" class="form-control" id="exampleInputEmail1" name="email" placeholder="example@email.com">
  </div>
  <div class="mb-3">
    <label for="exampleInput" class="form-label">Company Name</label>
    <input type="text" class="form-control" id="exampleInput" name="comname" placeholder="Your Company Name">
  </div>
  <div class="mb-3">
    <label for="exampleInput" class="form-label">Number</label>
    <input type="number" class="form-control" id="exampleInput" name="number" placeholder="your Contact Number">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="your Password">
  </div>
  <div class="mb-3">
    <label for="exampleInputPassword1" class="form-label">Confrim Password</label>
    <input type="password" class="form-control" id="exampleInputPassword1" name="repeat_password" placeholder="Re-Type Password">
  </div>
  <button type="submit" class="btn btn-primary" value="Register" name="submit">Submit</button>
</form>
    </div>
   </div>



    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"
    integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"
    integrity="sha384-mQ93GR66B00ZXjt0YO5KlohRA5SY2XofN4zfuZxLkoj1gXtW8ANNCe9d5Y3eG5eD" crossorigin="anonymous">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous">
  </script>
</body>
</html>