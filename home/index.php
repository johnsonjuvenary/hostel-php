<?php include('includes/header.php') ?>
<!-- END nav -->

<div class="hero-wrap js-fullheight" style="background-image: url('images/bg_1.jpg');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
			<div class="col-md-7 ftco-animate">
				<h2 class="subheading">Welcome to Hostel Rental</h2>
				<h1 class="mb-4">Rent Hostel of your Choice</h1>
				<p><a href="blog.php" class="btn btn-primary">Learn more</a> <a href="contact.php" class="btn btn-white">Contact us</a></p>
			</div>
		</div>
	</div>
</div>
<section class="ftco-section ftco-book ftco-no-pt ftco-no-pb">
	<div class="container">
		<?php book_hostel(); ?>
		<div class="row justify-content-end">
			<div class="col-lg-4">
				<form action="" class="appointment-form" action="" method="POST">
					<h3 class="mb-3">Book your Hostel</h3>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<input type="text" name="full_name" class="form-control" <?php echo $full_name; ?> placeholder="Full Name">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" name="university" class="form-control" <?php echo $university; ?> placeholder="University">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="form-field">
									<div class="select-wrap">
										<div class="icon"><span class="fa fa-chevron-down"></span></div>
										<select name="gender" id="" class="form-control">
											<option value="">Select Your Gender</option>
											<option value="Male">Male</option>
											<option value="Female">Female</option>								
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="email" name="email" class="form-control" <?php echo $email; ?> id="" placeholder="Email Address">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<input type="text" name="phone_number" class="form-control" <?php echo $phone_number; ?> id="" placeholder="Phone Number">
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<div class="form-field">
									<div class="select-wrap">
										<div class="icon"><span class="fa fa-chevron-down"></span></div>
										<select name="hostel" id="" class="form-control">
											<option value="">Select Hostel of Your Choice</option>
											<?php
											$hostel = query("SELECT hostel_id,hostel_name,hostel_location FROM hostel");
											confirm($hostel);
											while ($row = fetch_array($hostel)) : ?>
												<option value="<?php echo $row['hostel_id']; ?>"><?php echo $row['hostel_name']; ?> ~ <?php echo $row['hostel_location']; ?></option>
											<?php endwhile; ?>
										</select>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<span class="form-group small">Hostel Duration</span>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="input-wrap">
									<div class="icon"><span class="ion-md-calendar"></span></div>
									<input type="text" name="check_in" class="form-control appointment_date-check-in" placeholder="Check-In">
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<div class="input-wrap">
									<div class="icon"><span class="ion-md-calendar"></span></div>
									<input type="text" name="check_out" class="form-control appointment_date-check-out" placeholder="Check-Out">
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<input type="submit" name="book_hostel" value="Book Hostel Now" class="btn btn-primary py-3 px-4">
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section ftco-services">
	<div class="container">
		<div class="row">
			<div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate">
				<div class="d-block services-wrap text-center">
					<div class="img" style="background-image: url(images/services-1.jpg);"></div>
					<div class="media-body py-4 px-3">
						<h3 class="heading">Map Direction</h3>
						<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
						<p><a href="#" class="btn btn-primary">Read more</a></p>
					</div>
				</div>
			</div>
			<div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate">
				<div class="d-block services-wrap text-center">
					<div class="img" style="background-image: url(images/services-2.jpg);"></div>
					<div class="media-body py-4 px-3">
						<h3 class="heading">Accomodation Services</h3>
						<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
						<p><a href="#" class="btn btn-primary">Read more</a></p>
					</div>
				</div>
			</div>
			<div class="col-md-4 d-flex services align-self-stretch px-4 ftco-animate">
				<div class="d-block services-wrap text-center">
					<div class="img" style="background-image: url(images/services-3.jpg);"></div>
					<div class="media-body py-4 px-3">
						<h3 class="heading">Great Experience</h3>
						<p>Even the all-powerful Pointing has no control about the blind texts it is an almost unorthographic.</p>
						<p><a href="#" class="btn btn-primary">Read more</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section bg-light">
	<div class="container-fluid px-md-0">
		<div class="row no-gutters justify-content-center pb-5 mb-3">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<h2>Hostels</h2>
			</div>
		</div>
		<div class="row no-gutters">
		<?php hostels();?>
		</div>
	</div>
</section>


<section class="ftco-section testimony-section bg-light">
	<div class="container">
		<div class="row justify-content-center pb-5 mb-3">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<h2>Happy Clients &amp; Feedbacks</h2>
			</div>
		</div>
		<div class="row ftco-animate">
			<div class="col-md-12">
				<div class="carousel-testimony owl-carousel">
					<div class="item">
						<div class="testimony-wrap d-flex">
							<div class="user-img" style="background-image: url(images/person_1.jpg)">
							</div>
							<div class="text pl-4">
								<span class="quote d-flex align-items-center justify-content-center">
									<i class="fa fa-quote-left"></i>
								</span>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
								<p class="name">Racky Henderson</p>
								<span class="position">Father</span>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap d-flex">
							<div class="user-img" style="background-image: url(images/person_2.jpg)">
							</div>
							<div class="text pl-4">
								<span class="quote d-flex align-items-center justify-content-center">
									<i class="fa fa-quote-left"></i>
								</span>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
								<p class="name">Henry Dee</p>
								<span class="position">Businesswoman</span>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap d-flex">
							<div class="user-img" style="background-image: url(images/person_3.jpg)">
							</div>
							<div class="text pl-4">
								<span class="quote d-flex align-items-center justify-content-center">
									<i class="fa fa-quote-left"></i>
								</span>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
								<p class="name">Mark Huff</p>
								<span class="position">Businesswoman</span>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap d-flex">
							<div class="user-img" style="background-image: url(images/person_4.jpg)">
							</div>
							<div class="text pl-4">
								<span class="quote d-flex align-items-center justify-content-center">
									<i class="fa fa-quote-left"></i>
								</span>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
								<p class="name">Rodel Golez</p>
								<span class="position">Businesswoman</span>
							</div>
						</div>
					</div>
					<div class="item">
						<div class="testimony-wrap d-flex">
							<div class="user-img" style="background-image: url(images/person_1.jpg)">
							</div>
							<div class="text pl-4">
								<span class="quote d-flex align-items-center justify-content-center">
									<i class="fa fa-quote-left"></i>
								</span>
								<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
								<p class="name">Ken Bosh</p>
								<span class="position">Businesswoman</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<section class="ftco-intro" style="background-image: url(images/bg_1.jpg);" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row justify-content-center">
			<div class="col-md-9 text-center">
				<h2>Ready to get started</h2>
				<p class="mb-4">It’s safe to book online with us! Get your dream stay in clicks or drop us a line with your questions.</p>
				<p class="mb-0"><a href="index.php" class="btn btn-primary px-4 py-3">Book now</a> <a href="contact.php" class="btn btn-white px-4 py-3">Contact us</a></p>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section bg-light">
	<div class="container">
		<div class="row justify-content-center pb-5 mb-3">
			<div class="col-md-7 heading-section text-center ftco-animate">
				<h2>Latest news from our blog</h2>
				<span class="subheading">News &amp; Blog</span>
			</div>
		</div>
		<div class="row d-flex">
			<div class="col-md-4 d-flex ftco-animate">
				<div class="blog-entry align-self-stretch">
					<a href="blog-single.html" class="block-20 rounded" style="background-image: url('images/image_1.jpg');">
					</a>
					<div class="text p-4 text-center">
						<h3 class="heading"><a href="#">Work Hard, Party Hard in a Luxury Chalet in the Alps</a></h3>
						<div class="meta mb-2">
							<div><a href="#">January 30, 2020</a></div>
							<div><a href="#">Admin</a></div>
							<div><a href="#" class="meta-chat"><span class="fa fa-comment"></span> 3</a></div>
						</div>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 d-flex ftco-animate">
				<div class="blog-entry align-self-stretch">
					<a href="blog-single.html" class="block-20 rounded" style="background-image: url('images/image_2.jpg');">
					</a>
					<div class="text p-4 text-center">
						<h3 class="heading"><a href="#">Work Hard, Party Hard in a Luxury Chalet in the Alps</a></h3>
						<div class="meta mb-2">
							<div><a href="#">January 30, 2020</a></div>
							<div><a href="#">Admin</a></div>
							<div><a href="#" class="meta-chat"><span class="fa fa-comment"></span> 3</a></div>
						</div>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
					</div>
				</div>
			</div>
			<div class="col-md-4 d-flex ftco-animate">
				<div class="blog-entry align-self-stretch">
					<a href="blog-single.html" class="block-20 rounded" style="background-image: url('images/image_3.jpg');">
					</a>
					<div class="text p-4 text-center">
						<h3 class="heading"><a href="#">Work Hard, Party Hard in a Luxury Chalet in the Alps</a></h3>
						<div class="meta mb-2">
							<div><a href="#">January 30, 2020</a></div>
							<div><a href="#">Admin</a></div>
							<div><a href="#" class="meta-chat"><span class="fa fa-comment"></span> 3</a></div>
						</div>
						<p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php include('includes/footer.php'); ?>