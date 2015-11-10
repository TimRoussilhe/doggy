<?php 

include_once "header.php"; // this will include a.php


 ?>

<div id="dog" class="page">
	
	<section class="dog-header">

		<div class="dog-content">
			<h3>Dog</h3>	
			<h2><?php echo $dog["name"]; ?></h2>	
		</div>
	</section>

<div class="container" id="main-container">
  
	<section class="dog-content clearfix text-left">

		<section class="dog-content-left col-md-6 col-xs-12">
			<div class="friendly-container">
				

				<?php 

				        $image = $dog['pictures'][0]['path'];
				        $imgurl = cockpit('mediamanager:thumbnail', $image, 400, 400);
				        $img['cache']=$imgurl;
				        
				        $path=$img['path'];
					    $url="http://" . $_SERVER['SERVER_NAME'] . $imgurl;

					    echo '<img src="'.$url.'" alt="">';


				 ?>

				 <span class="shadow-right shadow"></span>
				 <span class="shadow-bottom shadow"></span>

			</div>
		</section>

		<section class="dog-content-right col-md-6 col-xs-12">
			
			<h1><?php echo $dog["name"]; ?></h1>

		<p>
			<?php echo $dog["Description"]; ?>
		</p>

		<div class="stats clearfix">
			
			<div class="stat col-md-4">
				<p>Total Cuteness </p>
				<p class="big"><?php echo $dog["likes"]; ?></p>
				<i class="icon ion-android-favorite-outline"></i>
			</div>

		</div>

		<div class="actions">
			
			<a class="button" href="" target="_blank">
				Like
			</a>
			<?php 

				$agency = collection("Agencies")->findOne(["_id"=>$dog["agency"]]); 
				$agencyUrl = $BASE_URL . '/agencies/' . $agency["Name_slug"];

			?>
			<a class="button" href="<? echo $agencyUrl; ?>" target="_blank">
				Explore <?php echo $dog["name"]; ?> agency
			</a>

			<p>Spread the love :</p>
			<i class="icon ion-social-facebook"></i>
			<i class="icon ion-social-twitter"></i>
			
		</div>


		</section>
		</section>
	</div>
   
</div>

<?php 

    include_once "footer.php"; // this will include a.php

 ?>
