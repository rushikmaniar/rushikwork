<?php session_start(); ?>
  <?php
  require_once "includes/header.php";
  $con = new connection();
  if(isset($_POST['insert_btn'])  && ($_POST['insert_btn']=="SignUp" ))
  {
  $firstname = $_POST['firstname'];
  $lastname = $_POST['lastname'];
  $username = $_POST['username'];
  $password = $_POST['password'];
  $_SESSION['firstname'] = $firstname;
  $_SESSION['lastname'] = $lastname;
  $_SESSION['username'] = $username;
  $_SESSION['password'] = $password;
  $con->insert($firstname,$lastname,$username,$password);
  }
  ?>
    <h1 align="center" class="h1">SignUp.php</h1>
    <form method="POST">
      <table align="center" border="5" class="table-condensed" width="30%">
        <tr>
          <td>FirstName</td>
          <td><input type="text" name="firstname"/></td>
        </tr>
        <tr>
          <td>Lastname</td>
          <td><input type="text" name="lastname"/></td>
        </tr>
        <tr>
          <td>Username</td>
          <td><input type="text" name="username"/></td>
        </tr>
        <tr>
          <td>Password</td>
          <td><input type="text" name="password"/></td>
        </tr>
        <tr>
          <td colspan="2"><center><input type="submit" name="insert_btn" value="SignUp" /></td></center>
        </tr>
      </table>
    </form>
    <center>
    <a href="index.php">Alerady Member ? </a>
    </center>
  <?php $con->get_footer(); ?>