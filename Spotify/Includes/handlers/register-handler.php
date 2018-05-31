<?php
    
    function standartizePassword($inputText){
        $inputText=strip_tags($inputText);
        return $inputText;
    }

    function standartizeUsername($inputText){
        $inputText=strip_tags($inputText);
        $inputText=str_replace(" ","",$inputText);
        return $inputText;
    }

    function standartizeStrings($inputText){
        $inputText=strip_tags($inputText);
        $inputText=str_replace(" ","",$inputText);
        $inputText=ucfirst(strtolower($inputText));
        return $inputText;
    }
    
    if(isset($_POST["registerButton"])){
        
        $username=standartizeUsername($_POST["username"]);
        $firstName=standartizeStrings($_POST["firstName"]);
        $lastName=standartizeStrings($_POST["lastName"]);
        $email=standartizeStrings($_POST["email"]);
        $email2=standartizeStrings($_POST["email2"]);
        $password=standartizePassword($_POST["password"]);
        $password2=standartizePassword($_POST["password2"]);
        
        $wasSuccessful=$account->register($username,$firstName,$lastName,$email,$email2,$password,$password2);
        
        if($wasSuccessful==true){
            $_SESSION['userLoggedIn']=$username;
            header("Location: index.php");
        }
        
    }

?>
