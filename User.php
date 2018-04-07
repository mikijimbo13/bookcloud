<?php


class User{
  private $name
  private $mail
  private $password
  
   
  public function __construct($name, $mail, $passwordHash){
    $this->name = $name;
    $this->mail = $mail;
    $this->pasword = $passwordHash  
  }

  public static function password_hash($password){
    //do hash
    return passwordHash;
  }
  
  public function changePassword($newPassword){
    
  }
  
  public function accept($visitor){
    $visitor->visitUser($this);

}
