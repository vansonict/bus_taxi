<?php
	ob_start();
	session_start();
        //include_once '../ptittaxi_api/database.php';
?>
<!--
	*
	*author: vansonict
	*copyright
	*time: 02/11/2014
	*description:
	**
 -->
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=width-device, initial-scale=1">
        <title></title>

        <link href="css/spritely.css" rel="stylesheet" type="text/css">
        <link href="css/ptit-taxi.css" rel="stylesheet" type="text/css">
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css">
        <link href="css/font-awesome.css" rel="stylesheet" type="text/css">
        
        <script type="text/javascript" src="js/jquery-1.8.1.js"></script>
        <!--<script src="js/jquery-1.11.1.js" type="text/javascript"></script>-->
        <script src="js/bootstrap.min.js" type="text/javascript"></script>
    </head>

    <body>
        <div class="wrapper">
            <div class="container">
                <!--sprite header-->
                <div id="sp-container">
                    <div id="logo">
                        <a href="/">PTIT-TAXI</a>
                    </div>
                    <div id="slider">
                    </div>
                    <div id="dragMe">
                    </div>
                    <div id="buehne" class="buehne">
                        <div id="tap" class="buehne"></div>
                        <div id="hg" class="buehne"></div> <!-- Background of daytime--> 
                        <div id="hg1" class="buehne"></div> <!-- Background of nightime-->
                        <div id="wolken" class="buehne"></div> <!-- Cloud -->
                        <div id="mond" class="buehne"></div>
                        <div id="hill2" class="buehne"></div>
                        <div id="berge" class="buehne"></div>
                        <div id="strasse" class="buehne"></div>
    <!--                    <div id="balloons2" class="buehne"></div>		
                        <div id="balloons" class="buehne"></div>-->
                    </div>
                    <div id="car1">
                        <p>Kéo em đi...!</p>
                    </div>
                    <div id="car">
                        <p>Kéo em đi...!</p>
                    </div>
                </div> <!-- ./ sp-container -->

                <div class="navbar navbar-default" role="navigation">
                    <div class="container-fluid">
                         <div class="navbar-header">
                            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">PTIT - Taxi</a>
                        </div>
                        <div class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                              <li class="active"><a href="#">Home</a></li>
                              <li><a href="#">Link</a></li>
                              <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                                <ul class="dropdown-menu">
                                  <li><a href="#">Action</a></li>
                                  <li><a href="#">Another action</a></li>
                                  <li><a href="#">Something else here</a></li>
                                  <li class="divider"></li>
                                  <li class="dropdown-header">Nav header</li>
                                  <li><a href="#">Separated link</a></li>
                                  <li><a href="#">One more separated link</a></li>
                                </ul>
                              </li>
                            </ul>
                            <?php
                                $username = 'Guest';
                                $openButtonText = 'Sign In/Register';
                                $loginStatus = 'no';
                                $token = '';
                                if (isset($_SESSION['login']) && $_SESSION['login'] == 'yes') {
                                        $username = $_SESSION['username'];
                                        $token = $_SESSION['token'];
                                        $openButtonText = 'Log Out';
                                        $loginStatus = 'yes';
                                } 
                             ?>
                            <ul class="nav navbar-nav navbar-right">
                                <li id="welcome">
                                    <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-user"></i>
                                        <p id="p-welcome">Hello <?php echo $username; ?></p>
                                        <span class="fa fa-caret-down <?php if ($username === 'Guest') echo 'welcome-hidden';?>">
                                        </span>
                                    </a>
                                    <ul class="dropdown-menu <?php if ($username === 'Guest') echo 'welcome-hidden';?>"
                                        >
                                        <li><a href="#"><i class="fa fa-pencil fa-fw"></i> Edit</a></li>
                                        <li><a href="#"><i class="fa fa-trash-o fa-fw"></i> Delete</a></li>
                                        <li><a href="#"><i class="fa fa-ban fa-fw"></i> Ban</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#"><i class="i"></i> Make admin</a></li>
                                    </ul>
                                </li>
<!--                                <li>
                                      <div class="btn-group open">
                                          <a class="" href="#"><i class="fa fa-user fa-fw"></i> User</a>
                                          <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                              <span class="fa fa-caret-down"></span></a>
                                          <ul class="dropdown-menu">
                                              <li><a href="#"><i class="fa fa-pencil fa-fw"></i> Edit</a></li>
                                              <li><a href="#"><i class="fa fa-trash-o fa-fw"></i> Delete</a></li>
                                              <li><a href="#"><i class="fa fa-ban fa-fw"></i> Ban</a></li>
                                              <li class="divider"></li>
                                              <li><a href="#"><i class="i"></i> Make admin</a></li>
                                          </ul>
                                      </div>
                                </li>-->
                                <li>
                                    <a id="open" class="" href="#signup" data-toggle="modal" data-target=".bs-modal-sm"><i class="fa fa-lock"></i><p id="p-open"> <?php echo $openButtonText; ?></p></a>
                                  <!-- Modal -->
                                    <div class="modal fade bs-modal-sm" id="myModal" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                      <div class="modal-dialog modal-sm">
                                        <div class="modal-content">
                                            <br>
                                            <div class="bs-example bs-example-tabs">
                                                <ul id="myTab" class="nav nav-tabs">
                                                  <li class="active"><a href="#signin" data-toggle="tab">Sign In</a></li>
                                                  <li class=""><a href="#signup" data-toggle="tab">Register</a></li>
                                                  <li class=""><a href="#why" data-toggle="tab">Why?</a></li>
                                                </ul>
                                            </div>
                                          <div class="modal-body">
                                            <div id="myTabContent" class="tab-content">
                                            <div class="tab-pane fade in" id="why">
                                            <p>We need this information so that you can receive access to the site and its content. Rest assured your information will not be sold, traded, or given to anyone.</p>
                                            <p></p><br> Please contact <a mailto:href="vansonict@gmail.com"></a>vansonict@gmail.com</a> for any other inquiries.</p>
                                            </div>
                                            <div class="tab-pane fade active in" id="signin">
                                                <!--<form class="form-horizontal" action="" method="POST">-->
                                                <fieldset>
                                                <!-- Sign In Form -->
                                                <!-- Text input-->
                                                <div class="control-group">
                                                  <label class="control-label" for="userid">Alias:</label>
                                                  <div class="controls">
                                                    <input required="" id="userid" name="userid" type="text" class="form-control" placeholder="Vansonict" class="input-medium" required="">
                                                  </div>
                                                </div>

                                                <!-- Password input-->
                                                <div class="control-group">
                                                  <label class="control-label" for="passwordinput">Password:</label>
                                                  <div class="controls">
                                                    <input required="" id="passwordinput" name="passwordinput" class="form-control" type="password" placeholder="********" class="input-medium">
                                                  </div>
                                                </div>

                                                <!-- Multiple Checkboxes (inline) -->
                                                <div class="control-group">
                                                  <label class="control-label" for="rememberme"></label>
                                                  <div class="controls">
                                                    <label class="checkbox inline" for="rememberme-0">
                                                      <input type="checkbox" name="rememberme" id="rememberme-0" value="1">
                                                      Remember me
                                                    </label>
                                                  </div>
                                                </div>

                                                <!-- Button -->
                                                <div class="control-group">
                                                  <label class="control-label" for="signin"></label>
                                                  <div class="controls">
                                                    <button id="sign_in" name="sign_in" class="btn btn-success">Sign In</button>
                                                  </div>
                                                </div>
                                                </fieldset>
                                                <!--</form>-->
                                            </div>
                                            <div class="tab-pane fade" id="signup">
                                                <form class="form-horizontal">
                                                <fieldset>
                                                <!-- Sign Up Form -->
                                                <!-- Text input-->
                                                <div class="control-group">
                                                  <label class="control-label" for="Email">Email:</label>
                                                  <div class="controls">
                                                    <input id="Email" name="Email" class="form-control" type="text" placeholder="Vansonict@gmail.com" class="input-large" required="">
                                                  </div>
                                                </div>

                                                <!-- Text input-->
                                                <div class="control-group">
                                                  <label class="control-label" for="userid">Alias:</label>
                                                  <div class="controls">
                                                    <input id="userid" name="userid" class="form-control" type="text" placeholder="Vansonict" class="input-large" required="">
                                                  </div>
                                                </div>

                                                <!-- Password input-->
                                                <div class="control-group">
                                                  <label class="control-label" for="password">Password:</label>
                                                  <div class="controls">
                                                    <input id="password" name="password" class="form-control" type="password" placeholder="********" class="input-large" required="">
                                                    <em>1-8 Characters</em>
                                                  </div>
                                                </div>

                                                <!-- Text input-->
                                                <div class="control-group">
                                                  <label class="control-label" for="reenterpassword">Re-Enter Password:</label>
                                                  <div class="controls">
                                                    <input id="reenterpassword" class="form-control" name="reenterpassword" type="password" placeholder="********" class="input-large" required="">
                                                  </div>
                                                </div>

                                                <!-- Multiple Radios (inline) -->
                                                <br>
                                                <div class="control-group">
                                                  <label class="control-label" for="humancheck">Humanity Check:</label>
                                                  <div class="controls">
                                                    <label class="radio inline" for="humancheck-0">
                                                      <input type="radio" name="humancheck" id="humancheck-0" value="robot" checked="checked">I'm a Robot</label>
                                                    <label class="radio inline" for="humancheck-1">
                                                      <input type="radio" name="humancheck" id="humancheck-1" value="human">I'm Human</label>
                                                  </div>
                                                </div>

                                                <!-- Button -->
                                                <div class="control-group">
                                                  <label class="control-label" for="confirmsignup"></label>
                                                  <div class="controls">
                                                    <button id="confirmsignup" name="confirmsignup" class="btn btn-success">Sign Up</button>
                                                  </div>
                                                </div>
                                                </fieldset>
                                                </form>
                                          </div>
                                        </div>
                                          </div>
                                          <div class="modal-footer">
                                          <center>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </center>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                              </li>
                            </ul>
                        </div><!--/.nav-collapse -->
                    </div>
                </div> <!-- ./Navbar -->

                <div class="container_16">
                    <div class="item rounded dark">
                        <div id="map_canvas" class="map rounded" 
                             style="position: relative; background-color: rgb(229, 227, 223); overflow: hidden;">
                        </div>
                        <div id="hidden-value">
                            <input type="hidden" id="login-status" value="<?php echo $loginStatus ?>" />
                            <input type="hidden" id="login-username" value="<?php echo $username ?>" />
                            <input type="hidden" id="login-token" value="<?php echo $token ?>" />	
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <!--Maps Javascript-->
        <script src="http://maps.google.com/maps/api/js?sensor=false" type="text/javascript"></script>
<!--        <script type="text/javascript"
                accesskey="" src="http://maps.googleapis.com/maps/api/js?key=AIzaSyA6SR6rqZNy7z65x3Da-_vWm6d_l2Nc5PA&sensor=false">
        </script>-->
        <script type="text/javascript" src="js/jquery.ui.map/jquery.ui.map.js"></script>
        <script type="text/javascript" src="js/jquery.ui.map/jquery.ui.map.services.js"></script>
        <script type="text/javascript" src="js/jquery.ui.map/jquery.ui.map.extensions.js"></script>
        <script type="text/javascript" src="js/jquery.ui.map/jquery.ui.map.overlays.js"></script>
        <script type="text/javascript" src="js/map.js"></script>
        <!--./maps-->
        <script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
        <script src="js/jquery-ui-1.8.16.custom.min.js" type="text/javascript"></script>
        <script src="js/jquery.spritely-0.5.js"></script>
        <script src="js/taxi_spritely.js" type="text/javascript"></script>
        <script src="js/slide.js" type="text/javascript"></script>
        <script type="text/javascript"> jQuery.noConflict(); </script>
</html>
<?php ob_end_flush() ?>