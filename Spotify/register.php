<?php
    include("Includes/config.php");
    include("Includes/classes/Constants.php");
    include("Includes/classes/Account.php");
    $account=new Account($con);
    
    include("Includes/handlers/register-handler.php");
    include("Includes/handlers/login-handler.php");

    function getInputValue($name){
        if(isset($_POST[$name])){
            echo $_POST[$name];
        }
    }

?>

<html>
    <head>
        <title>Welcome to register page</title>

        <link rel="stylesheet" type="text/css" href="assets/css/register.css">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script src="assets/js/register.js"></script>
    </head>
    <body>

        <?php 

            if(isset($_POST["registerButton"])){

                echo '<script type="text/javascript">
                      $(document).ready(function(){
                      $("#loginForm").hide();
                      $("#registerForm").show();
                      });
                      </script>';

            }

            else{

                echo '<script type="text/javascript">
                      $(document).ready(function(){
                      $("#loginForm").show();
                      $("#registerForm").hide();
                      });
                      </script>';

            }

         ?>
        
  

        <div id="background">
            <div id="loginContainer">
                <div id="inputContainer">
                    <form id="loginForm" action="register.php" method="post">
                        <h2>Login to your acount</h2>
                        <p>
                            <?php echo $account->getError(Constants::$loginError);?> 
                            <label for="loginUsername">Username</label>
                            <input id="loginUsername" name="loginUsername" type="text" placeholder="your username" required value="<?php getInputValue('loginUsername'); ?>">
                        </p>
                        
                        <p>
                            <label for="loginPassword">Password</label>
                            <input id="loginPassword" name="loginPassword" type="password" placeholder="your password" required>
                        </p>
                        
                        <button type="submit" name="loginButton">Log in</button>

                        <div class="hasAccountText">
                            <span id="hideLogin">Don't have an account yet? Signup here. </span>
                        </div>
                    </form>
                    
                     <form id="registerForm" action="register.php" method="post">
                        <h2>Create your acount</h2>
                        <p>
                            <?php echo $account->getError(Constants::$usernameCharacters);?>
                            <?php echo $account->getError(Constants::$usernameTaken);?>
                            <label for="username">Username</label>
                            <input id="username" name="username" type="text" placeholder="your username" required
                                   value="<?php getInputValue('username'); ?>">
                        </p>
                         
                         <p>
                             <?php echo $account->getError(Constants::$firstNameCharacters);?>
                            <label for="firstName">First name</label>
                            <input id="firstName" name="firstName" type="text" placeholder="your name" required value="<?php getInputValue('firstName'); ?>" >
                        </p>
                         
                         <p>
                            <?php echo $account->getError(Constants::$lastNameCharacters);?>
                            <label for="lastName">Last name</label>
                            <input id="lastName" name="lastName" type="text" placeholder="your surname" required value="<?php getInputValue('lastName'); ?>">
                        </p>
                         
                         <p>
                            <?php echo $account->getError(Constants::$emailTaken);?>
                             <?php echo $account->getError(Constants::$emailInvalid);?>
                            <label for="email">E-mail</label>
                            <input id="email" name="email" type="email" placeholder="your email" required value="<?php getInputValue('email'); ?>">
                        </p>

                         <p>
                             <?php echo $account->getError(Constants::$emailInvalid);?>
                             <?php echo $account->getError(Constants::$emailsDontMatch);?>
                             
                            <label for="email"> Confirm e-mail</label>
                            <input id="email2" name="email2" type="email" placeholder="confirm email" required value="<?php getInputValue('email2'); ?>">
                        </p>
                        
                        <p>
                            <?php echo $account->getError(Constants::$passwordDontMatch);?>
                            <?php echo $account->getError(Constants::$passwordNotAlphaNumeric);?>
                            <?php echo $account->getError(Constants::$passwordCharacters);?>
                            <label for="password">Password</label>
                            <input id="password" name="password" type="password" placeholder="your password" required >
                        </p>
                         
                        <p>
                            <label for="password2">Confirm password</label>
                            <input id="password2" name="password2" type="password" placeholder="confirm password" required >
                        </p>
                        
                        <button type="submit" name="registerButton">Sign up</button>

                        <div class="hasAccountText">
                            <span id="hideRegister">Already have an account? Log in here. </span>
                        </div>
                    </form>
                </div>
                <div id="loginText">
                <h1>Get great music, right now</h1>
                <h2>Listen to loads of songs for free</h2>
                <ul>
                    <li>Discover music you'll fall in love with</li>
                    <li>Create your own playlists</li>
                    <li>Follow artists to keep up to date</li>
                </ul>
            </div>


            </div>
        </div>
    </body>
</html>


