
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>CMM 007 Stories</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="" />
	<meta name="author" content="" />

  <!-- Facebook and Twitter integration -->
	<meta property="og:title" content=""/>
	<meta property="og:image" content=""/>
	<meta property="og:url" content=""/>
	<meta property="og:site_name" content=""/>
	<meta property="og:description" content=""/>
	<meta name="twitter:title" content="" />
	<meta name="twitter:image" content="" />
	<meta name="twitter:url" content="" />
	<meta name="twitter:card" content="" />

	<link href="https://fonts.googleapis.com/css?family=Quicksand:300,400,500,700" rel="stylesheet">
	
	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Flexslider  -->
	<link rel="stylesheet" href="css/flexslider.css">

	<!-- Owl Carousel -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">
	
	<!-- Date Picker -->
	<link rel="stylesheet" href="css/bootstrap-datepicker.css">
	<!-- Flaticons  -->
	<link rel="stylesheet" href="fonts/flaticon/font/flaticon.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
		
	
		<?php
session_start();
include "dbconnect.php";

if (isset($_GET['Message'])) {
    print '<script type="text/javascript">
               alert("' . $_GET['Message'] . '");
           </script>';
}

if (isset($_GET['response'])) {
    print '<script type="text/javascript">
               alert("' . $_GET['response'] . '");
           </script>';
}

if(isset($_POST['submit']))
{
  if($_POST['submit']=="login")
  { 
        $username=$_POST['login_username'];
        $password=$_POST['login_password'];
        $query = "SELECT * from users where UserName ='$username' AND Password='$password'";
        $result = mysqli_query($con,$query)or die(mysql_error());
        if(mysqli_num_rows($result) > 0)
        {
             $row = mysqli_fetch_assoc($result);
             $_SESSION['user']=$row['UserName'];
             print'
                <script type="text/javascript">alert("successfully logged in!!!");</script>
                  ';
        }
        else
        {    print'
              <script type="text/javascript">alert("Incorrect Username Or Password!!");</script>
                  ';
        }
  }
  else if($_POST['submit']=="register")
  {
        $username=$_POST['register_username'];
        $password=$_POST['register_password'];
        $query="select * from users where UserName = '$username'";
        $result=mysqli_query($con,$query) or die(mysql_error);
        if(mysqli_num_rows($result)>0)
        {   
               print'
               <script type="text/javascript">alert("username is taken");</script>
                    ';

        }
        else
        {
          $query ="INSERT INTO users VALUES ('$username','$password')";
          $result=mysqli_query($con,$query);
          print'
                <script type="text/javascript">
                 alert("Successfully Registered!!!");
                </script>
               ';
        }
  }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Books">
    <meta name="author" content="Shivangi Gupta">
    <title>CMM 007 Bookstore</title>
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/my.css" rel="stylesheet">
    <style>
      .modal-header {background:#D67B22;color:#fff;font-weight:800;}
      .modal-body{font-weight:800;}
      .modal-body ul{list-style:none;}
      .modal .btn {background:#D67B22;color:#fff;}
      .modal a{color:#D67B22;}
      .modal-backdrop {position:inherit !important;}
       #login_button,#register_button{background:none;color:#D67B22!important;}       
       #query_button {position:fixed;right:0px;bottom:0px;padding:10px 80px;
                      background-color:#D67B22;color:#fff;border-color:#f05f40;border-radius:2px;}
  	@media(max-width:767px){
        #query_button {padding: 5px 20px;}
  	}
    </style>
</head>
<body>
  <nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
      <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="story.php" style="padding: 20px; color:orange;">Home</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
         <ul class="nav navbar-nav navbar-right">
        <?php
        if(!isset($_SESSION['user']))
          {
            echo'
            <li>
                <button type="button" id="login_button" class="btn btn-lg" data-toggle="modal" data-target="#login">Login</button>
                  <div id="login" class="modal fade" role="dialog">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title text-center">Login Form</h4>
                            </div>
                            <div class="modal-body">
                                          <form class="form" role="form" method="post" action="story.php" accept-charset="UTF-8">
                                              <div class="form-group">
                                                  <label class="sr-only" for="username">Username</label>
                                                  <input type="text" name="login_username" class="form-control" placeholder="Username" required>
                                              </div>
                                              <div class="form-group">
                                                  <label class="sr-only" for="password">Password</label>
                                                  <input type="password" name="login_password" class="form-control"  placeholder="Password" required>
                                              </div>
                                              <div class="form-group">
                                                  <button type="submit" name="submit" value="login" class="btn btn-block">
                                                      Sign in
                                                  </button>
                                              </div>
                                          </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                  </div>
            </li>
            <li>
              <button type="button" id="register_button" class="btn btn-lg" data-toggle="modal" data-target="#register">Sign Up</button>
                <div id="register" class="modal fade" role="dialog">
                  <div class="modal-dialog">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title text-center">Member Registration Form</h4>
                          </div>
                          <div class="modal-body">
                                        <form class="form" role="form" method="post" action="story.php" accept-charset="UTF-8">
                                            <div class="form-group">
                                                <label class="sr-only" for="username">Username</label>
                                                <input type="text" name="register_username" class="form-control" placeholder="Username" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="sr-only" for="password">Password</label>
                                                <input type="password" name="register_password" class="form-control"  placeholder="Password" required>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" name="submit" value="register" class="btn btn-block">
                                                    Sign Up
                                                </button>
                                            </div>
                                        </form>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                          </div>
                      </div>
                  </div>
                </div>
            </li>';
          } 
        else
          {   echo' <li> <a href="#" class="btn btn-lg"> Hello ' .$_SESSION['user']. '.</a></li>
                    <li> <a href="library.php" class="btn btn-lg"> Library </a> </li>; 
                    <li> <a href="destroy.php" class="btn btn-lg"> LogOut </a> </li>';
               
          }
?>

          </ul>
        </div><!-- /.navbar-collapse -->
      </div><!-- /.container-fluid -->
    </nav>
  <div id="top" >
      <div id="searchbox" class="container-fluid" style="width:112%;margin-left:-6%;margin-right:-6%;">
          <div>
              <form role="search" method="POST" action="Result.php">
                  <input type="text" class="form-control" name="keyword" style="width:80%;margin:20px 10% 20px 10%;" placeholder="Search for a Book , Author Or Category">
              </form>
          </div>
      </div>

      <div class="container-fluid" id="header">
          <div class="row">
              <div class="col-md-3 col-lg-3" id="category">
                  <div style="background:#D67B22;color:#fff;font-weight:800;border:none;padding:15px;"> Stories </div>
                  <ul>
                     
                      <li> <a href="Product.php?value=History"> History </a> </li>
                      <li> <a href="Product.php?value=Guidebooks"> Guidebooks </a> </li>
                      <li> <a href="Product.php?value=Tourism"> Travel </a> </li>
                  
                  </ul>
              </div>
              <div class="col-md-6 col-lg-6">
                  <div id="myCarousel" class="carousel slide carousel-fade" data-ride="carousel">
                      <!-- Indicators -->
                      <ol class="carousel-indicators">
                          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                          <li data-target="#myCarousel" data-slide-to="1"></li>
                          <li data-target="#myCarousel" data-slide-to="2"></li>
                          <li data-target="#myCarousel" data-slide-to="3"></li>
                          <li data-target="#myCarousel" data-slide-to="4"></li>
                          <li data-target="#myCarousel" data-slide-to="5"></li>
                      </ol>
                      
                        <!-- Wrapper for slides -->
                      <div class="carousel-inner" role="listbox">
                          <div class="item active">
                            <img class="img-responsive" src="img/new/images.jpeg">
                          </div>

                          <div class="item">
                            <img class="img-responsive "src="img/carousel/otr.jpg">
                          </div>

                          <div class="item">
                            <img class="img-responsive" src="img/carousel/vagabonding.jpg">
                          </div>

                          <div class="item">
                            <img class="img-responsive"src="img/carousel/art-of-travel.jpg">
                          </div>

                          <div class="item">
                            <img class="img-responsive" src="img/carousel/18144590.jpg">
                          </div>

                          <div class="item">
                            <img class="img-responsive" src="img/new/images (1).jpeg">
                          </div>
                      </div>
                  </div>
              </div>
              <div class="col-md-3 col-lg-3" id="offer">
                  <a href="Product.php?value=History%20Books">              <img class="img-responsive center-block" src="img/new/images (1).jpeg"></a>
                  
                  
              </div>
          </div>
      </div>
  </div>

  <div class="container-fluid text-center" id="new">
      <div class="row">
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=EPL&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="book block-center img-responsive" src="img/new/epl.jpg" width="150px" height="200px">
                  <hr>
                 Eat, Pray, Love
                 
                  <p>Around the time Elizabeth Gilbert turned thirty, she went through an early-onslaught midlife 
                    crisis. <br>She had everything an educated, ambitious American woman was supposed to want—a husband, <br>
                    a house, a successful career. But instead of feeling happy and fulfilled, she was consumed with panic, grief, and confusion. She went through a divorce, a crushing depression, another failed love, and the eradication of everything she ever thought she was supposed to be........"
							</p>
                  <span class="label label-warning">More Details</span>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=OTR&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/new/otr.jpg"width="150px" height="200px">
                  <hr>
                 All over the map
                 <p>On a trip to Oaxaca, Mexico, to celebrate her fortieth birthday, <br>
                   Laura Fraser confronts the unique trajectory of her life. Divorced and childless in her thirties, she found solace in the wanderlust that had always directed her heart—and found love and comfort in the arms of a dashing Frenchman. Their Italian affair brought her back to herself—but now she wonders if her passion for travel (and for short-lived romantic rendezvous)
                    has deprived her of what she secretly wants most from life: a husband, a family, a home...."
							</p>
                  <span class="label label-warning">More Details</span>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=ROAD&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/new/road.jpg" width="150px" height="200px">
                  <hr>
                On The Road
                  <p>On the Road chronicles Jack Kerouac’s years traveling the N. American continent with his friend Neal Cassady,<br>
                     “a sideburned hero of the snowy West.” As “Sal Paradise” & “Dean Moriarty,” the two roam the country in a quest for self-knowledge & experience. <br>Kerouac’s love of America, 
                    compassion for humanity & sense of language as jazz combine to make On the Road an inspirational work of lasting importance"
							</p>
                  <span class="label label-warning">More Details</span>
              </div>
            </a>
          </div>
          <div class="col-sm-6 col-md-3 col-lg-3">
           <a href="description.php?ID=ATR&category=new">
              <div class="book-block">
                  <div class="tag">New</div>
                  <div class="tag-side"><img src="img/tag.png"></div>
                  <img class="block-center img-responsive" src="img/new/atr.jpg" width="150px" height="200px">
                  <hr>
                  The Art Of Travel
                  <p>Any Baedeker will tell us where we ought to travel, but only Alain de Botton will tell us how and why. <br>
                    With the same intelligence and insouciant charm he brought to How Proust Can Save Your Life, de Botton considers the pleasures of anticipation; the allure of the exotic,<br>
                     and the value of noticing everything from a seascape in Barbados to the takeoffs at Heathrow."
							</p>
                  <span class="label label-warning">More Details</span>
              </div>
            </a>
          </div>
      </div>
  </div>

  <div id="colorlib-testimony" class="colorlib-light-grey">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3 text-center colorlib-heading animate-box">
						<h2>Some of our Trending Authors</h2>
						<p>We love to tell our successful far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
					</div>
				</div>
				<div class="row">
					<div class="col-md-8 col-md-offset-2 animate-box">						
						<div class="owl-carousel2">
							<div class="item">
								<div class="testimony text-center">
									<span class="img-user" style="background-image: url(images/elizabeth.jpg);"></span>
									<span class="user">Elizabeth Gilbert</span>
									<small>Connectiut, United States</small>
									<blockquote>
										<p>" Still, despite all this, traveling is the great true love of my life.</p>
									</blockquote>
								</div>
							</div>
							<div class="item">
								<div class="testimony text-center">
									<span class="img-user" style="background-image: url(images/Bill_Bryson.jpg);"></span>
									<span class="user">Bill_Bryson</span>
									<small>Lowa, United States</small>
									<blockquote>
										<p>I love the feeling of being anonymous in a city I've never been before.</p>
									</blockquote>
								</div>
							</div>
							<div class="item">
								<div class="testimony text-center">
									<span class="img-user" style="background-image: url(images/alain.jpg);"></span>
									<span class="user">Alain De Botton</span>
									<small>Zurich, Switzerland</small>
									<blockquote>
										<p>Journey are the midwives of thoughts.</p>
									</blockquote>
								</div>
							</div>
						</div>
					</div>
				</div>	
			</div>
		</div>
		


  <footer style="margin-left:-6%;margin-right:-6%;">
      <div class="container-fluid">
          <div class="row">
              <div class="col-sm-1 col-md-1 col-lg-1">
              </div>
              <div class="col-sm-7 col-md-5 col-lg-5">
                  <div class="row text-center">
                      <h2>Contact Us</h2>
                      <hr class="primary">
                      <p>Still Confused? Give us a call or send us an email and we will get back to you as soon as possible!</p>
                  </div>
                  <div class="row">
                      <div class="col-md-6 text-center">
                          <span class="glyphicon glyphicon-earphone"></span>
                          <p>123-456-6789</p>
                      </div>
                      <div class="col-md-6 text-center">
                          <span class="glyphicon glyphicon-envelope"></span>
                          <p>CMM007@gmail.com</p>
                      </div>
                  </div>
              </div>
              <div class="hidden-sm-down col-md-2 col-lg-2">
              </div>
              <div class="col-sm-4 col-md-3 col-lg-3 text-center">
                  <h2 style="color:#D67B22;">Follow Us At</h2>
                  <div>
                      <a href="https://twitter.com/strandbookstore">
                      <img title="Twitter" alt="Twitter" src="img/social/twitter.png" width="35" height="35" />
                      </a>
                      <a href="https://www.linkedin.com/company/strand-book-store">
                      <img title="LinkedIn" alt="LinkedIn" src="img/social/linkedin.png" width="35" height="35" />
                      </a>
                      <a href="https://www.facebook.com/strandbookstore/">
                      <img title="Facebook" alt="Facebook" src="img/social/facebook.png" width="35" height="35" />
                      </a>
                      <a href="https://plus.google.com/111917722383378485041">
                      <img title="google+" alt="google+" src="img/social/google.jpg" width="35" height="35" />
                      </a>
                      <a href="https://www.pinterest.com/strandbookstore/">
                      <img title="Pinterest" alt="Pinterest" src="img/social/pinterest.jpg" width="35" height="35" />
                      </a>
                  </div>
              </div>
          </div>
      </div>
  </footer>

<div class="container">
  <!-- Trigger the modal with a button -->
  <button type="button" id="query_button" class="btn btn-lg" data-toggle="modal" data-target="#query">Ask query</button>
  <!-- Modal -->
  <div class="modal fade" id="query" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header text-center">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Ask your query here</h4>
          </div>
          <div class="modal-body">           
                    <form method="post" action="query.php" class="form" role="form">
                        <div class="form-group">
                             <label class="sr-only" for="name">Name</label>
                             <input type="text" class="form-control"  placeholder="Your Name" name="sender" required>
                        </div>
                        <div class="form-group">
                             <label class="sr-only" for="email">Email</label>
                             <input type="email" class="form-control" placeholder="abc@gmail.com" name="senderEmail" required>
                        </div>
                        <div class="form-group">
                             <label class="sr-only" for="query">Message</label>
                             <textarea class="form-control" rows="5" cols="30" name="message" placeholder="Your Query" required></textarea>
                        </div>
                        <div class="form-group">
                              <button type="submit" name="submit" value="query" class="btn btn-block">
                                                              Send Query
                               </button>
                        </div>
                    </form>
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
      </div>
    </div>  
  </div>
</div>

  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
</body>
</html>	
  <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <!-- Include all compiled plugins (below), or include individual files as needed -->
  <script src="js/bootstrap.min.js"></script>
</body>
</html>	
	
				<div class="row">
					<div class="col-md-12 text-center">
						<p>
							<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is Brought To You By <i class="icon-heart2" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Code-Projects.Org</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></span> 
							<span class="block">Demo Images and write up: <a href="http://unsplash.co/" target="_blank">Unsplash</a> , <a href="http://pexels.com/" target="_blank">Pexels.com</a>, <a href="http://scribd.com/" target="_blank">Scribd.com</a></span>
						</p>
					</div>
				</div>
			</div>
		</footer>
	</div>

	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up2"></i></a>
	</div>
	
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Owl carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Date Picker -->
	<script src="js/bootstrap-datepicker.js"></script>
	<!-- Stellar Parallax -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>

