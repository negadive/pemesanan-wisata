<?php
session_start();
include "koneksi.php";
$db = new database();
$con = $db->mysqli;
?>
<!--
Author: W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html>

<head>
	<title>Mangkujo :: w3layouts</title>
	<!--for-mobile-apps-->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="keywords" content="Joy AmusementPark Responsive Website Template, Web Templates, Flat Web Templates, Android Compatible web template,
		Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, Sony Ericsson, Motorola web design" />
	<script type="application/x-javascript">
		addEventListener("load", function() {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<!--//for-mobile-apps-->

	<!-- Custom-Theme-Files -->
	<!-- Bootstrap-CSS -->
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<!-- JQuery -->
	<script src="assets/js/jquery.min.js"></script>
	<!-- Bootstrap-Main -->
	<script src="assets/js/bootstrap.min.js"> </script>
	<!-- Index-Page-Styling -->
	<link rel="stylesheet" href="assets/css/style.css" type="text/css" media="all">

	<script type="text/javascript" src="assets/js/tabulous.js"></script>
	<script type="text/javascript" src="assets/js/flip.js"></script>

	<!-- Gallery effect CSS -->
	<link rel="stylesheet" href="assets/css/swipebox.css">

	<!--JS for animate-->
	<link href="assets/css/animate.css" rel="stylesheet" type="text/css" media="all">
	<script src="assets/js/wow.min.js"></script>
	<script>
		new WOW().init();
	</script>
	<!--//end-animate-->

	<!--startsmothscrolling-->
	<script type="text/javascript" src="assets/js/move-top.js"></script>
	<script type="text/javascript" src="assets/js/easing.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$(".scroll").click(function(event) {
				event.preventDefault();
				$('html,body').animate({
					scrollTop: $(this.hash).offset().top
				}, 1200);
			});
		});
	</script>
	<!--endsmothscrolling-->

</head>

<body>

	<!-- Header Starts -->
	<!-- <script src="assets/js/jquery.vide.min.js"></script> -->
	<div class="head-menu">
		<div class="header" data-vide-bg="video/park" id="home">
			<div class="menu-w3l">
				<nav class="navbar navbar-inverse">
					<div class="container">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand logo" href="#"><img src="./assets/images/logo.png" alt="logo image"></a>
						</div>

						<div class="collapse navbar-collapse " id="myNavbar">
							<ul class="nav navbar-nav navbar-right">
								<li class="active"><a href="#home" class="scroll wow fadeInRight" data-wow-delay=".1s">Beranda</a></li>
								<li><a href="#about" class="scroll wow fadeInRight" data-wow-delay="0.3s">About Us</a></li>
								<li><a href="#timing" class="scroll wow fadeInRight" data-wow-delay="0.5s">Timings</a></li>
								<li><a href="#price" class="scroll wow fadeInRight" data-wow-delay="0.9s">Ticket Price</a></li>
								<li><a href="#gallery" class="scroll wow fadeInRight" data-wow-delay="1.1s">Gallery</a></li>
								<li><a href="#booking" class="scroll wow fadeInRight" data-wow-delay="1.3s">Pemesanan Online</a></li>
								<?php
								echo '<li><a href="costumer/" class="wow fadeInRight" data-wow-delay="1.5s">Halamanku</a></li>';
								?>
							</ul>
						</div>
					</div>
				</nav>
				<div class="clearfix"> </div>
			</div> <!-- Menu Ends -->
		</div>
	</div> <!-- Header Ends -->

	<!--  About Starts -->
	<div class="about" id="about">
		<div class="container">
			<div class="about-padding-w3ls">
				<h1> Tentang Mangkujo </h1>
				<div class="col-md-6 about-img">
					<div class="w3l-img1">
						<img src="./assets/images/about-img2.jpg" alt="logo">
						<div class="w3l-img2">
							<img src="./assets/images/2.jpg" alt="logo">
						</div>
						<div class="w3l-img3">
							<img src="./assets/images/1.jpg" alt="logo">
						</div>
					</div>
				</div>

				<div class="col-md-6 about-text">
					<div class="about-text-padding-agile">

						<h4> Enjoy Here </h4>
						<p> Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
							standard dummy text ever since the 1500s, when an unknown printer took and scrambled it to make a type specimen book.
							It has survived not only five centuries, but also the leap into electronic typesetting, remaining standard dummy text.
						</p>

					</div>
				</div>
				<div class="clearfix"> </div>
			</div>
		</div>
	</div><!--  About Ends -->

	<!--  Visiting-time Starts -->
	<div class="visiting-time" id="timing">
		<div class="container">
			<div class="visiting-padding">

				<div class="timings">
					<h2> Jam Buka</h2>
					<h5> <span> Monday - Friday </span> : 11.00 am - 08.00 pm </h5>
					<h5> <span> Saturday - Sunday </span> : 10.00 am - 09.00 pm </h5>
					<h5> <span>Holidays </span> : 10.00 am - 10.00 pm </h5>
				</div>
			</div>
		</div>
	</div><!--  Visiting-time Ends -->


	<!-- Tickets Starts here -->
	<div class="tickets" id="price">
		<div class="container">
			<div class="tickets-padding-w3agile">
				<h3> Ticket Price </h3>
				<!-- Tickets Tabs Starts -->
				<div id="wrapper">
					<div id="tabs4">
						<ul>
							<li><a href="#tabs-1" title="">Basic</a></li>
							<?php
							$paket = $con->query("SELECT * FROM paketwahana");
							while ($data = $paket->fetch_array(MYSQLI_ASSOC)) {
								echo "<li><a href='#tabs-" . $data["id"] . "' title=''>" . $data["nama"] . "</a></li>";
							}
							?>
						</ul>

						<div id="tabs_container">

							<div id="tabs-1">
								<!-- Tabs container Starts -->
								<section class="grida">
									<section class="para-a">
										<?php
										$wahanas = $con->query('SELECT * FROM wahana limit 1');
										$data =  $wahanas->fetch_array(MYSQLI_ASSOC);
										?>
										<h4 id="wahana_name"><?php echo $data["nama"]; ?></h4>
										<h5 id="wahana_price"> <span>Rp</span><?php echo $data["harga"]; ?></h5>
										<p id="wahana_desc"><?php echo $data["deskripsi"]; ?></p>
									</section>
								</section>

								<section class="gridb">
									<h3>Basic Ticket</h3>
									<section class="para">
										<?php
										$wahanas = $con->query('SELECT * FROM wahana');
										while ($data = $wahanas->fetch_array(MYSQLI_ASSOC)) {
											echo "<p onclick='detail(" . json_encode($data) . ")'>" . $data["nama"] . " </p>";
										}
										?>
									</section>
								</section>
							</div>
							<?php
							$query = $con->query("SELECT * FROM paketwahana");
							while ($paket = $query->fetch_array(MYSQLI_ASSOC)) {
							?>
								<div id="tabs-<?php echo $paket["id"]; ?>">
									<section class="grida">
										<section class="para-a">
											<h4>One Child</h4>
											<h5> <span>Rp</span><?php echo $paket["harga"] ?></h5>
											<p><?php echo $paket["deskripsi"] ?></p>
										</section>
									</section>

									<section class="gridb">
										<h3><?php echo $paket["nama"]; ?></h3>
										<section class="para">
											<?php
											$wahanas = $con->query('SELECT * FROM wahana join matchpw on wahana.id=matchpw.wahana_id WHERE matchpw.paketwahana_id = ' . $paket["id"]);
											while ($wahana = $wahanas->fetch_array(MYSQLI_ASSOC)) {
												echo "<p>" . $wahana["nama"] . " </p>";
											}
											?>
										</section>
									</section>
								</div>
							<?php
							}
							?>

						</div>
						<!--End tabs container-->
					</div>
					<!--End tabs-->
				</div>
				<!-- Ticket Tab Ends -->
			</div>
		</div>
	</div> <!-- Tickets Ends -->

	<!-- Gallery start -->
	<div id="gallery" class="gallery">
		<div class="container">
			<div class="gallery-padding">
				<div class="gallery-w3l-title">
					<h3>Photo Gallery</h3>
					<p>Duis euismod massa ut sem fringilla blandit. Proin vel enim nec ipsum finibus. </p>
				</div>

				<div class="gallery_gds">
					<ul class="simplefilter">
						<li class="active" data-filter="all">All</li>
						<li data-filter="1">Water-land</li>
						<li data-filter="2">Rides</li>
						<li data-filter="3">Games</li>
					</ul>

					<div class="filtr-container">
						<div class="col-md-4 filtr-item g-width" data-category="1, 4" data-sort="01">
							<div class="hover ehover14">
								<a href="assets/images/g10.jpg" class="swipebox" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis maximus tortor diam, ac lobortis justo rutrum quis. Praesent non purus fermentum, eleifend velit non">
									<img src="assets/images/g10.jpg" alt="" class="img-responsive" />
									<div class="overlay">
										<h4>Portfolio</h4>
										<div class="info nullbutton button" data-toggle="modal" data-target="#modal14">Show More</div>
									</div>
								</a>
							</div>
						</div>
						<div class="col-md-4 filtr-item g-width" data-category="2, 3" data-sort="02">
							<div class="hover ehover14">
								<a href="assets/images/g11.jpg" class="swipebox" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis maximus tortor diam, ac lobortis justo rutrum quis. Praesent non purus fermentum, eleifend velit non">
									<img src="assets/images/g11.jpg" alt="" class="img-responsive" />
									<div class="overlay">
										<h4>Portfolio</h4>
										<div class="info nullbutton button" data-toggle="modal" data-target="#modal14">Show More</div>
									</div>
								</a>
							</div>
						</div>
						<div class="col-md-4 filtr-item g-width" data-category="1, 4" data-sort="03">
							<div class="hover ehover14">
								<a href="assets/images/g12.jpg" class="swipebox" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis maximus tortor diam, ac lobortis justo rutrum quis. Praesent non purus fermentum, eleifend velit non">
									<img src="assets/images/g12.jpg" alt="" class="img-responsive" />
									<div class="overlay">
										<h4>Portfolio</h4>
										<div class="info nullbutton button" data-toggle="modal" data-target="#modal14">Show More</div>
									</div>
								</a>
							</div>
						</div>
						<div class="col-md-4 filtr-item g-width" data-category="3, 4" data-sort="04">
							<div class="hover ehover14">
								<a href="assets/images/g16.jpg" class="swipebox" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis maximus tortor diam, ac lobortis justo rutrum quis. Praesent non purus fermentum, eleifend velit non">
									<img src="assets/images/g16.jpg" alt="" class="img-responsive" />
									<div class="overlay">
										<h4>Portfolio</h4>
										<div class="info nullbutton button" data-toggle="modal" data-target="#modal14">Show More</div>
									</div>
								</a>
							</div>
						</div>
						<div class="col-md-4 filtr-item g-width" data-category="3" data-sort="05">
							<div class="hover ehover14">
								<a href="assets/images/g14.jpg" class="swipebox" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis maximus tortor diam, ac lobortis justo rutrum quis. Praesent non purus fermentum, eleifend velit non">
									<img src="assets/images/g14.jpg" alt="" class="img-responsive" />
									<div class="overlay">
										<h4>Portfolio</h4>
										<div class="info nullbutton button" data-toggle="modal" data-target="#modal14">Show More</div>
									</div>
								</a>
							</div>
						</div>
						<div class="col-md-4 filtr-item g-width" data-category="2, 4" data-sort="06">
							<div class="hover ehover14">
								<a href="assets/images/g15.jpg" class="swipebox" title="Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis maximus tortor diam, ac lobortis justo rutrum quis. Praesent non purus fermentum, eleifend velit non">
									<img src="assets/images/g15.jpg" alt="" class="img-responsive" />
									<div class="overlay">
										<h4>Portfolio</h4>
										<div class="info nullbutton button" data-toggle="modal" data-target="#modal14">Show More</div>
									</div>
								</a>
							</div>
						</div>
						<div class="clearfix"> </div>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- Gallery Ends -->


	<!-- Ticket Booking -->
	<div class="booking" id="booking">
		<div class="container">
			<div class="booking-padding">
				<h3>Online Ticket Booking </h3>
				<?php
				if (isset($_SESSION["user"])) {
				?>
					<div class="main">
						<div class="facts">
							<form action="act/pesan.php" method="post">
								<div>
									<div class="reservation-name">
										<h5>Pesan Wahana</h5>
										<select class="custom-select" name="pesan_wahana" id="select-4">
											<?php
											include "model/paket_wahana.php";
											$wahanas = PaketWahana::read($con);
											foreach ($wahanas as $data) {
												echo '<option value="P-' . $data["id"] . '">' . $data["nama"] . '</option>';
											}
											include "model/wahana.php";
											$wahanas = Wahana::read($con);
											foreach ($wahanas as $data) {
												echo '<option value="W-' . $data["id"] . '">' . $data["nama"] . '</option>';
											}

											$con->close();
											?>
										</select>
									</div>
									<div class="total_ticket">
										<h5>Jum Ticket</h5>
										<input class="ticket" type="text" name="jum_tiket">
									</div>
									<div class="clearfix"> </div>
								</div>
								<div>
									<div class="date-pike">
										<h5>Tanggal Pesan </h5>
										<input class="date" id="datepicker" name="tgl_pesan" type="text" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'dd/mm/yyyy';}" required="">
									</div>
									<div class="time">
										<h5>Jam</h5>
										<input type="time" required name="waktu">
									</div>
								</div>
								<div class="clearfix"></div>
								<div>
									<?php
									echo $_SESSION["err"];
									unset($_SESSION["err"]);
									?>
								</div>
								<div class="date_btn">
									<input type="submit" value="Book">
								</div>
							</form>
						</div>
					</div>
				<?php
				} else {
				?>
					<div class="row">
						<div class=col-sm-6>
							<div class="facts">
								<form action="act/login.php" method="post">
									<div>
										<h5 style="text-align: center;">Email</h5>
										<input type="email" name="email" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
									</div>
									<div>
										<h5 style="text-align: center;">Password </h5>
										<input type="password" name="password" value="" required="">
									</div>
									<div class="clearfix"> </div>
									<div class="date_btn">
										<input type="submit" value="Masuk">
									</div>
								</form>
							</div>
						</div>
						<div class=col-sm-6>
							<div class="facts">
								<form action="act/register.php" method="post">
									<div class="row">
										<div class="col-sm-6">
											<h5 style="text-align: center;">Email</h5>
											<input type="email" name="email" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
										</div>
										<div class="col-sm-6">
											<h5 style="text-align: center;">Nama</h5>
											<input type="text" name="nama" value="" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Email';}" required="">
										</div>
										<div class="col-sm-6">
											<h5 style="text-align: center;">Password </h5>
											<input type="password" name="password" value="" required="">
										</div>
										<div class="col-sm-6">
											<h5 style="text-align: center;">Password </h5>
											<input type="password" name="password2" value="" required="">
										</div>
										<div class="col-sm-6">
											<h5 style="text-align: center;">No Telepon </h5>
											<input type="text" name="no_hp" value="" required="">
										</div>
										<div class="col-sm-6">
											<h5 style="text-align: center;">Jenis Kelamin </h5>
											<input type="radio" name="jen_kel" id="male" value="M">
											<label for="male">Laki-laki</label>
											<input type="radio" name="jen_kel" id="female" value="F">
											<label for="female">Perempuan</label>
										</div>
										<div class="col-sm-12">
											<h5 style="text-align: center;">Alamat </h5>
											<textarea name="alamat" style="width: 100%;"></textarea>
										</div>
										<div class="clearfix"> </div>
										<div class="date_btn">
											<input type="submit" value="Daftar">
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				<?php
				}
				?>
			</div>
		</div>
	</div> <!-- Ticket Booking Ends -->


	<!-- Contact Starts -->
	<div class="contact" id="contact">
		<div class="container">
			<div class="contact-padding">
				<h3> Contact Us</h3>
				<div>
					<div class="col-md-4 address">
						<h4>Address</h4>
						<address>
							Lorem Ipsum<br>
							HTML5 Buildings,<br>
							Doctorville,<br>
							Great Britain<br>
							(123) 456-7890<br>
							<span>Phone : +123 4567 8900</span>
						</address>
					</div>

					<div class="col-md-4 contact-grids map map-grid">
						<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d24539.92663142791!2d-86.16046302812671!3d39.75108691096141!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sin!4v1463029882632" style="border:0"></iframe>
					</div>

					<div class="col-md-4 social-icons">
						<h4>Follow Us</h4>
						<ul class="social">
							<li><a href="#" class="facebook" title="Go to Our Facebook Page"></a></li>
							<li><a href="#" class="twitter" title="Go to Our Twitter Account"></a></li>
							<li><a href="#" class="googleplus" title="Go to Our Google Plus Account"></a></li>
							<li><a href="#" class="instagram" title="Go to Our Instagram Account"></a></li>
							<li><a href="#" class="youtube" title="Go to Our Youtube Channel"></a></li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div>

				<div class="footer">
					<p>© 2016 Joy AmusementPark. All Rights Reserved | Design by <a href="https://w3layouts.com/" target="_blank"> w3layouts </a></p>
				</div>

			</div>
		</div>
	</div> <!-- Contact Ends -->


	<!--gallery-->
	<!-- Include jQuery & Filterizr -->
	<script src="assets/js/jquery.filterizr.js"></script>
	<script src="assets/js/controls.js"></script>
	<!-- Kick off Filterizr -->
	<script type="text/javascript">
		$(function() {
			//Initialize filterizr with default options
			$('.filtr-container').filterizr();
		});

		function detail(item) {
			$('#wahana_name').html(item.nama)
			$('#wahana_price').html('<span>Rp</span>' + item.harga)
			$('#wahana_desc').html(item.deskripsi)
		}
	</script>

	<!-- swipe box js -->
	<script src="assets/js/jquery.swipebox.min.js"></script>
	<script type="text/javascript">
		jQuery(function($) {
			$(".swipebox").swipebox();
		});
	</script>
	<!-- //swipe box js -->
	<!--//gallery-->

	<!--strat-date-piker-->
	<link rel="stylesheet" href="assets/css/jquery-ui.css" />
	<script src="assets/js/jquery-ui.js"></script>
	<script>
		$(function() {
			$("#datepicker,#datepicker1").datepicker();
		});
	</script>
	<!--/End-date-piker-->

	<!-- Slide-To-Top JavaScript (No-Need-To-Change) -->
	<script type="text/javascript">
		$(document).ready(function() {
			$().UItoTop({
				easingType: 'easeOutQuart'
			});
		});
	</script>
	<a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
	<!-- //Slide-To-Top JavaScript -->

</body>

</html>