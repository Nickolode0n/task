<?php

if(isset($_SESSION['username']) || isset($_SESSION['email'])){
  
  $username = $_SESSION['username'];
  $email = $_SESSION['email'];
  $sql = $db->prepare("SELECT * FROM Users WHERE email = :email OR username = :username");
  $sql->bindParam(':email', $email, PDO::PARAM_STR);
  $sql->bindParam(':username', $username, PDO::PARAM_STR);
  $sql->execute();
  $fetch = $sql->fetch(PDO::FETCH_ASSOC);

  $role_perm = $db->prepare("SELECT roleID FROM role_perm WHERE userID =  ?");
  $role_perm->execute([$fetch['userID']]);
  $role = $role_perm->fetchColumn();
}else{

  header('location: index.php');
  exit();

}

?>