<?php
    if(isset($_GET['busiKey'])){
        $_SESSION['account']['currentBusinessKey'] = $_GET['busiKey'];
        header('Location: dashboard.php');
        die();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="SMiLE Project">
        <meta name="author" content="Radu Marian Tutunaru, Mujtaba Mehdi">
   
        <!-- <link rel="shortcut icon" href="../../assets/ico/favicon.ico"> -->

        <title></title>
        <!-- Select box plugin fix for Bootstrap-->
        <link href="ext/css/bootstrap-select.min.css" rel="stylesheet">

        <!-- Bootstrap core CSS -->
        <link href="ext/css/bootstrap.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="ext/css/style.css" rel="stylesheet">
        <link href="ext/js/select2/select2-bootstrap.css">

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body
        <?php if ($page === "index"){
            echo "class=\"indeximg\"";
        }
        ?>
    >

        <div class="navbar navbar-default navbar-fixed-top" role="navigation">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.php">TrackMyFood!</a>
                </div><!--End of .navbar-header-->

                <div class="collapse navbar-collapse">
                    <!--Begining of menu navigation-->
                    <ul class="nav navbar-nav">
                        
                        <li class="active"><a href="index.php">Home</a></li>
                        <?php if(isset($_SESSION['account']) === false ) { ?>
                        <li><a href="login.php">Sign In</a></li>
                        <li><a href="register-business.php">Register</a></li>
                        <?php }else{ ?>
                        <li><a href="logout.php">Log Out</a></li>
                        <li><a href="search.php">Search</a></li>
                        <?php } ?>
                        
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">More <b class="caret"></b></a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">Other Information</li>
                                <li><a href="#">About us</a></li>
                                <li><a href="#">Contact us</a></li>
                                <li><a href="#">Privacy policy</a></li>
                                <li><a href="#">Cookie policy</a></li>
                            </ul>
                        </li><!--End of dropdown menu-->
                    </ul><!--End of menu navigation-->

                    <!--Display user if signed in-->
                    <?php if(isset($_SESSION['account']) === true) { ?>
                        
                        <form class="navbar-search">
                            <div class="navbar-text navbar-right" style="margin-top: 10px;margin-bottom: -4px;">
                                <?php if($_SESSION['account']['accountType'] === "Business Account"){ ?>Change business:
                                    <form action="" method="post" id="changeBusiness">
                                        <select name="busiKey" class="span selectpicker">
                                            <?php
                                                $noOfBusinesses = sizeof($_SESSION['account']['businessApiKeys']);
                                                for($i = 0; $i<$noOfBusinesses; $i++){
                                                    echo "<option value=\"".$_SESSION['account']['businessApiKeys'][$i]."\">".$_SESSION['account']['businessNames'][$i]."</option>";
                                                }
                                            ?>
                                        </select>
                                        <button type="submit" class="btn btn-success rm-relish">Change!</button>
                                    </form>
                                <?php } ?>
                                &nbsp;&nbsp;Signed in as <a href="#" class="navbar-link"><?php echo $_SESSION['account']['name']; ?></a>
                            </div>
                        </form>

                    <?php } ?>
                    <!--End of displaying user if signed in-->

                </div><!--End of.nav-collapse -->
            </div><!--ENd of .container-->
        </div><!--End of .navbar-->