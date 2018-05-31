<?php
    
    class Account{
        
        private $con;
        private $errorArray;
        
        public function __construct($con){
            $this->con=$con;
            $this->errorArray=array();
        }
        
        public function register($un,$fn,$ln,$em,$em2,$pw,$p2){
            
            $this->validateUsername($un);
            $this->validateFirstName($fn);
            $this->validateLastName($ln);
            $this->validateEmails($em,$em2);
            $this->validatePasswords($pw,$p2);
            
            if(empty($this->errorArray)){
                return $this->insertUserDetails($un,$fn,$ln,$em,$pw);
            }else{
                return false;
            }
            
            
        }
        
        public function getError($error){
            if(!in_array($error,$this->errorArray)){
                $error="";
            }
            return '<span class="errorMessage">'.$error.'</span>';
        }

        public function login($un,$pw){

            $pw=md5($pw);

            $searchForUser=mysqli_query($this->con,"SELECT * FROM users WHERE username='$un' AND password='$pw'");

            if(mysqli_num_rows($searchForUser)==1){
                return true;
            }else{
                array_push($this->errorArray, Constants::$loginError);
                return false;
            }

        }
        
        private function insertUserDetails($un,$fn,$ln,$em,$pw){

            $encryptedPw=md5($pw);
            $profilePic="assets\images\profile-pics\pic.jpg";
            $date=date("Y-m-d");

            $result=mysqli_query($this->con,"INSERT INTO users VALUES('','$un','$fn','$ln','$em','$encryptedPw',
                '$date','$profilePic')");

            return $result;


        }

        private function validateUsername($un){
            if(strlen($un)>25 || strlen($un)<5){
                array_push($this->errorArray,Constants::$usernameCharacters);
                return;
            }

            $checkUsernameQuery=mysqli_query($this->con,"SELECT username FROM users WHERE username='$un'");
            if(mysqli_num_rows($checkUsernameQuery)!=0){
                array_push($this->errorArray, Constants::$usernameTaken);
                return;
            }
        }
        
        private function validateFirstName($fn){
            if(strlen($fn)>25 || strlen($fn)<2){
                array_push($this->errorArray,Constants::$firstNameCharacters);
                return;
            }
        }
        
        private function validateLastName($ln){
            if(strlen($ln)>25 || strlen($ln)<5){
                array_push($this->errorArray,Constants::$lastNameCharacters);
                return;
            }
        }
        
        private function validateEmails($em,$em2){

            if($em != $em){
                 array_push($this->errorArray,Constants::$emailsDontMatch);
                return;
            }

            if(!filter_var($em,FILTER_VALIDATE_EMAIL)){
                array_push($this->errorArray,Constants::$emailInvalid);
                return;
            }

            $checkUsernameQuery=mysqli_query($this->con,"SELECT email FROM users WHERE email='$em'");
            if(mysqli_num_rows($checkUsernameQuery)!=0){
                array_push($this->errorArray, Constants::$emailTaken);
                return;
            }
            
        }
        
        private function validatePasswords($p1,$p2){
            if($p1 != $p2){
                 array_push($this->errorArray,Constants::$passwordDontMatch);
                return;
            }
            
            if(preg_match('/[^A-Za-z0-9]/',$p1)){
                array_push($this->errorArray,Constants::$passwordNotAlphaNumeric);
                return;
            }
            
            if(strlen($p1)>30 || strlen($p1)<5){
                array_push($this->errorArray,Constants::$passwordCharacters);
                return;
            }
        }
        
    }

?>