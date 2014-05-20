<?php
    include('core/init.core.php');

    //Initialize the errors array:
    $errors = array();

    //If user is already logged in, then it redirects to dashboard:
    if(isset($_SESSION['account'])){
        header('Location: dashboard.php');
        die();
    }

    //Check if the email and password fields were submitted:
    if(isset($_POST['email'], $_POST['password'])){

    	//Check if the email is empty:
        if(empty($_POST['email'])){
            $errors[] = 'The email cannot be empty.';
        }

        //Check if the password is empty:
        if(empty($_POST['password'])){
            $errors[] = 'The password cannot be empty.';
        }

        //Api URL:
        $url = APIURL."/auth";

        //Header of the API:
        $headers = array('Content-Type: application/json',"ApplicationAuthorization: ".API_APP_KEY);
        
        //Data array of the API:
        $dataArray = array(
                        'email'    => htmlentities($_POST['email']),
        				'password' => htmlentities($_POST['password'])
                        );
        
        //Encode the data array into JSON:
        $data = json_encode($dataArray);

        //Get a response from the API:
        $response = rest_post($url, $data, $headers);

        //Get the user object:
        $userobj = json_decode($response);
        
        //print_r($userobj);
        //Get the status of the user (active/innactive):
        $status = $userobj->{'statusCode'};

        //Check if the login was successful:
        if($status!=200){
        	$errors[] = $userobj->{'errors'}[0];
            $errors[] = $userobj->{'moreInfo'};
        }else if($status==200){
            //Create the session:
            if(empty($errors)){
                //Get the size of the businessApiKeys array:
                $sizeBusinessKeysArray = sizeof($userobj->{'businessApiKeys'});
                //Store the variables in a session:
                $_SESSION['account'] = array('email'  => $userobj->{'email'},
                                             'apiKey' => $userobj->{'userApiKey'},
                                             'name'   => $userobj->{'userFullName'},
                                             'accountType' => $userobj->{'accountType'},
                                             'businessApiKeys' => $userobj->{'businessApiKeys'},
                                             'currentBusinessKey' => $userobj->{'businessApiKeys'}[0]);
                
                //Get the current business names and store them in an array:
                $bussinesNamesArray = array();

                for ($index = 0; $index<$sizeBusinessKeysArray; $index++){
                    //URL of the REST call:
                    $url = APIURL."/business/".$_SESSION['account']['businessApiKeys'][$index];
                    //Headers of the REST call:
                    $headers = array("Content-Type: application/json","ApplicationAuthorization: ".API_APP_KEY,"Authorization: ".$_SESSION['account']['apiKey']);
                    //REST response:
                    $response =  rest_get($url,$headers);
                    //Decode JSON object:
                    $data_arr = json_decode($response);
                    //Put business names into array:
                    $bussinesNamesArray[] = $data_arr->{'name'};
                }

                //Store the business names array into the session:
                $_SESSION['account']['businessNames'] = $bussinesNamesArray;
                //Store the current business name into the session:
                $_SESSION['account']['currentBusinessName'] = $bussinesNamesArray[0];

                //print_r($_SESSION['account']);
                //Redirect to the dashboard: 
                header('Location: dashboard.php');

                die();   
            }
        }
    }
?>
<?php include('header.php'); ?>

		<div class="container">
            <!--Sign in form starts here-->
            <form class="form-signin" method="post" role="form">
                <h2 class="form-signin-heading">Please sign in:</h2>

                <div>
                    <?php if(empty($errors)===false){ ?>
                        <ul class="fedback-error-signin">
                            <?php foreach ($errors as $error) {
                                echo "<li><p><span class=\"glyphicon glyphicon-remove form-control-feedback\"></span>&nbsp;&nbsp;{$error}</p></li>";
                            } ?>
                        </ul>
                    <?php } ?>
                </div>

                <input type="email" class="form-control" placeholder="Email" name="email" title="Please enter your email." required autofocus><br />
                <input type="password" class="form-control" placeholder="Password" name="password" title="Please enter your password." required>
                <!-- <label class="checkbox">
                    <input type="checkbox" value="remember-me" name="rememberme"> Remember me
                </label> --><br />
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button><br/>

                <p>Need an account? <a href="register-business.php" title="Register Here">Create Account</a></p>
                <p>Forgot your password? <a href="#" title="Forgot your password">Recover Password</a></p>
            </form><!--Sign in form ends here-->
        </div> <!-- /container -->

<?php include('footer.php'); ?>