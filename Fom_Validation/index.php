<?php include './includes/connect.php';
$username_msg = "Username should be between 3 to 20 characters";
$email_msg = "Email is not valid";
$phone_msg = "Phone number should be 10 digits";
$place_msg = "Place should be between 3 to 30 characters";
$fill_msg = "All fields are required";
$error_msg = array();

if(isset($_POST['submit'])){
    $username=htmlspecialchars($_POST['username']);
    $email=htmlspecialchars($_POST['email']);
    $phone=htmlspecialchars($_POST['phone']);
    $place=htmlspecialchars($_POST['place']);

    $username = ucwords(strtolower($username));
    $place = ucwords(strtolower($place));

    // Removing spaces if any
    $username = str_replace(" ","",$username);
    $email = str_replace(" ","",$email);
    $phone = str_replace(" ","",$phone);
    $place = str_replace(" ","",$place);
   if(empty($username)|| empty($email)|| empty($phone)|| empty($place)){
      
      array_push($error_msg,$fill_msg);
    }
 else{
    if(strlen($username)<3 || strlen($username)>20){
      array_push($error_msg,$username_msg);
    }
    if(strlen($place)<3 || strlen($place)>30){
      array_push($error_msg,$place_msg);
    }
    if(!filter_var($email,FILTER_VALIDATE_EMAIL)|| !preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/',$email)){
      array_push($error_msg,$email_msg);
    } 
    if(!preg_match('/^[0-9]{10}+$/',$phone) || ctype_digit($phone)==false|| strlen($phone)!=10){
      array_push($error_msg,$phone_msg);
    }
    
 }
 //checking existing email username and phone number
 if (empty($error_msg)) {
  $check_query = "SELECT * FROM crud WHERE email='$email' OR phone='$phone'";
  $check_result = mysqli_query($con, $check_query);
  if($check_result){
      if(mysqli_num_rows($check_result) > 0){
          $existing_data = mysqli_fetch_assoc($check_result);
          if($existing_data['email'] === $email){
              $email_msg = "Email already exists";
              array_push($error_msg, $email_msg);
          }
         if ($existing_data['username'] === $username) {
           $username_msg = "Username already exists";
           array_push($error_msg, $username_msg);
          # code...
         }
          if($existing_data['phone'] === $phone){
            $phone_msg = "Phone number already exists";
              array_push($error_msg, $phone_msg);
          }
      } 
      else {
        // Validate and sanitize inputs again before insertion
        $username = mysqli_real_escape_string($con, $username); 
        $email = mysqli_real_escape_string($con, $email);
        $phone = mysqli_real_escape_string($con, $phone);
        $place = mysqli_real_escape_string($con, $place);

          //inserting data
        if(empty($error_msg)) {
          $insert_query="insert into crud (username,email,phone,address) values ('$username','$email','$phone','$place')";
          $result=mysqli_query($con,$insert_query);
          if($result){
            echo "<script>alert('Data inserted successfully')</script>";
            echo "<script>window.open('index.php','_self')</script>";
            
          }else{
            die(mysqli_error($result));
          }
      }
    }
  } else {
      die("Query failed: " . mysqli_error($con));
  }

 }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Validation</title>
    <link rel="stylesheet" href="style.css?v1=a">
</head>
<body>
<div class="form_container">
  <h1 class="heading">Form Validation</h1>
  <?php if(in_array($fill_msg,$error_msg)){
        echo '<span class="error_messages" id= "all_fields_error">'.$fill_msg.'</span>';
      }
      ?>
  <div>
    <form action="" method="post">
      <input type="text" name="username" placeholder="Enter your username"  class="input_field"  autocomplete="off"/>
      <?php if(in_array($username_msg,$error_msg)){
        echo '<span class="error_messages">'.$username_msg.'</span>';
      }
      ?>

      <input type="email" name="email" placeholder="Enter your email"  class="input_field" autocomplete="off"/>
      <?php if(in_array($email_msg,$error_msg)){
        echo '<span class="error_messages"id="user_email_error">'.$email_msg.'</span>';
      } 
      ?>

      <input type="number" name="phone" placeholder="Enter your phone" class="input_field" autocomplete="off"/>
      <?php if(in_array($phone_msg,$error_msg)){
        echo '<span class="error_messages">'.$phone_msg.'</span>';
      } 
      ?>

      <input type="place" name="place" placeholder="Enter your place"  class="input_field" autocomplete="off"/>
      <?php if(in_array($place_msg,$error_msg)){
        echo '<span class="error_messages">'.$place_msg.'</span>';
      }
      ?>
      
      <button type="submit" class="btn" name="submit">Submit Form</button>
    </form>
</div>
</div>
</body>

<script>
  document.addEventListerner('DOMContentLoaded',function(){
    const errorMessages = document.querySelectorAll('.error_messages');
    const inputFields = document.querySelectorAll('.input_field');
    const btn = document.querySelector('.btn');
    const form = document.querySelector('form');
    const userEmailError = doccument.querySelector('.user_email_error');
    const allFieldsError = document.getElementById('all_fields_error');

    inputFields.forEach((inputField)=>{
      inputField.addEventListener('focus',()=>{
     if(allFieldsError){
      allFieldsError.textcontent = '';
        }
        
        const errorSpan = this.nextElementSibling ;
        if(errorSpan.textContent == errorSpan.classList.contains('error_messages')){
          errorSpan.textContent = '';
        }
      });

    });
  });

</script>
</html>