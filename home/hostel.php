<?php include('includes/header.php') ?>
<!-- END nav -->

<section class="hero-wrap hero-wrap-2" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row no-gutters slider-text align-items-center justify-content-center">
			<div class="col-md-9 ftco-animate text-center">
				<p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home <i class="fa fa-chevron-right"></i></a></span> <span>Hostels <i class="fa fa-chevron-right"></i></span></p>
				<h1 class="mb-0 bread">Hostels </h1>
			</div>
		</div>
	</div>
</section>

<section class="ftco-section bg-light ftco-no-pt ftco-no-pb">
	<div class="container-fluid px-md-0">
		<div class="row no-gutters">
			<?php hostels(); ?>
		</div>
	</div>
</section>
<?php include('includes/footer.php'); ?>