<?php
//session_start();

require 'db.php';
$conn = dbConnection();

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

function login() {
  $stmt = $GLOBALS['conn']->prepare("select Password,Verified from User where Username=? or Email=?");
  $stmt->bind_param("ss",$_SESSION['username'],$_SESSION['username']);

  if ($stmt->execute()) {
    $result = $stmt->get_result();

    // If user exists in database
    if ($result->num_rows > 0) {
      $_SESSION['user_exists'] = true;

      // Validate password
      while($row = $result->fetch_assoc()) {
        if(password_verify($_SESSION['password'], $row['Password'])) {
          $_SESSION['password_validation'] = true;

          if ($row['Verified'] == 1) {
            $_SESSION['logged_in'] = true;
            $_SESSION['verified_user'] = true;

            echo "<script> window.location.href='../index.php' </script>";
            exit();

          } else {
            $_SESSION['verified_user'] = false;
            

            

            echo "<script> window.location.href='../index.php?verifityEcho=".$_SESSION['username']."'</script>";
          }

        } else {
          $_SESSION['logged_in'] = false;
          $_SESSION['password_validation'] = false;

          echo "<script> window.location.href = 'index.php?wrongPassword=wrongPassword' </script>";
        }
      }
    } else {
      $_SESSION['user_exists'] = false;
      echo "<script> window.location.href = 'index.php?wrongPassword=wrngPassword' </script>";
    }
  } else {
    echo "Error in select query: <i>" . $stmt->error . "</i>";
  }

  $stmt->close();
  $GLOBALS['conn']->close();
}

function userExists($username,$email) {
  if ($username != null) {
    // Function called from register.php
    $stmt = $GLOBALS['conn']->prepare("select ID from User where Username=? or Email=?");
    $stmt->bind_param("ss",$username,$email);

  } else {
    // Function called from verify_account.php
    $stmt = $GLOBALS['conn']->prepare("select ID from User where Email=?");
    $stmt->bind_param("s",$email);
  }

  if($stmt->execute()) {
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
      return true;
    } else {
      return false;
    }
  } else {
    echo "Error in select query: <i>" . $stmt->error . "</i>";
  }

  $stmt->close();
  $GLOBALS['conn']->close();
}

function checkCurrentPassword($username,$email,$password) {
  $stmt = $GLOBALS['conn']->prepare("select Password from User where Username=? or Email=?");
  $stmt->bind_param("ss",$username,$email);

  if ($stmt->execute()) {
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      $row = $result->fetch_assoc();
      $db_password = $row['Password'];

      if (password_verify($password,$db_password)) {
        return  true;
      } else {
        return false;
      }
    } else {
      echo "User not found.";
    }
  } else {
    echo "Error in select query: <i>" . $stmt->error . "</i>";
  }

  $stmt->close();
  $GLOBALS['conn']->close();
}

function uploadPhoto($photo) {
  $photos_path = dirname( dirname(__FILE__) ) . '/photos' . '/';
  $photo_name = $photo['name'];

  $photos_path .= $photo_name;

  $photo_temp_name = $photo['tmp_name'];

  if (move_uploaded_file($photo_temp_name, $photos_path)) {
    return 1;
  } else {
    return 0;
  }
}

function validateDateOfBirth($date,$action) {
  $today = date("Y-m-d");
  $diff = date_diff(date_create($date), date_create($today));

  if ($diff->format('%y%') < 0) {
    if ($action == 'update') {
      $url = "<a href='account.php'>Account</a>";
    } else {
      $url = "<a href='index.php'>Register</a>";
    }

    die("<div class='text-center'><p>Your age must be at least 18 years old.</p> " . $url . "</div>");
  }
}

function userVerified($email) {
  $stmt = $GLOBALS['conn']->prepare("select Verified from User where Email = ?");
  $stmt->bind_param("s",$email);

  if ($stmt->execute()) {
    $stmt->store_result();

    if ($stmt->affected_rows > 0) {
      $user_exists = true;

      $stmt->bind_result($Verified);

      while ($stmt->fetch()) {
        if ($Verified == 0) {
          $is_verified = false;
        } else {
          $is_verified = true;
        }
      }
    }

    return $is_verified;
  } else {
    echo "Error in sql query: <i>" . $stmt->error . "</i>";
  }

  $stmt->close();
  $GLOBALS['conn']->close();
}

?>
