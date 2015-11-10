<?php 

include_once "header.php"; // this will include a.php

 ?>
<div id="agency" class="page">
	

	<section class="agency-header">

		<div class="agency-content">
			<h3>Agency</h3>	
			<h2><?php echo $agency["Name"]; ?></h2>	
		</div>
		
	</section>

	<div class="container" id="main-container">

	  <section class="agency-content clearfix text-left">

	  		<section class="agency-content-left col-md-6 col-xs-12">
	  			<div class="friendly-container">
	  				
	  				<h2>Yay! Hurray! <span class="bold"><?php echo $agency["Name"]; ?></span> <br> is a great place for dogs!</h2>

		  			<?php 
		  				if($agency["Dog_friendly"]=='yes' || $agency["Dog_friendly"] =='doge choice'){
		  					echo '<img src="../images/agency-yes.jpg">';
		  				}elseif ($agency["Dog_friendly"]=='no') {
		  					echo '<img src="../images/agency-no.jpg">';
		  				}

		  			?>

	  			</div>
	  		</section>

	  		<section class="agency-content-right col-md-6 col-xs-12">
	  		
	  			<h1 data-slug="<?php echo $agency['Name_slug']; ?>" class="name"><?php echo $agency["Name"]; ?></h1>
	  			<h2><?php echo $agency["Field"]; ?> - <?php echo $agency["City"]; ?></h2>
				<p>
					<?php echo $agency["Description"]; ?>
				</p>

				<a href="" title="">Visit Website</a>

				<div class="stats clearfix">
					
					<div class="stat col-md-4">
						<p>Number of dogs</p>
						<p class="big">
							<?php 
								echo (count($agency["Dog"]));
							 ?>
						</p>
						<i class="icon ion-ios-paw-outline"></i>

					</div>

					<div class="stat col-md-4">
						<p>Total Cuteness </p>
						<p class="big">200</p>
						<i class="icon ion-android-favorite-outline"></i>
					</div>
				</div>

				<div class="actions">
					
					<button type="">
						Apply here with your dog
					</button>
					<p class="informations">If some informations are wrong please <a href="" title="">report it to us</a></p>
					
					<p>Spread the love :</p>
					
					<a href="#" class="icon facebook"><i class="icon ion-social-facebook"></i></a>
					<a href="#" class="icon twitter"><i class="icon ion-social-twitter"></i></a>

				</div>


	  		</section>

	   </section>

	   <section class="related-dog clearfix text-left">
	   		<header>
	   			
	   			<h2>Check out those cutie faces</h2>	
	   			<h3><?php echo $agency["Name"]; ?> Dogs</h3>

	   		</header><!-- /header -->
			
			<div class="dogs">

				<?php 

					foreach ($agency["Dog"] as $key => $value) {

						$dog = collection("Dogs")->findOne(["_id"=>$value]); 
					    $dogUrl = $BASE_URL . '/dogs/' . $dog["name_slug"];

						echo '<div class="dog col-md-4">';
						echo '<div class="dog-content">';
						echo '<span class="overlay"></span>';
						echo '<a href="'. $dogUrl .'" title="">';
						echo '<h4>'.$dog['name'].'</h4>';
						echo '</a>';
						
						$img =[];
					    $image = $dog['pictures'][0]['path'];
				        $imgurl = cockpit('mediamanager:thumbnail', $image, 200, 200);
				        $img['cache']=$imgurl;
				        
				        $path=$img['path'];
				        $url=str_replace('site:', $BASE_URL.'/' , $dog['pictures'][0]['path']);

				        $img['url']=$url;

					    echo '<img src="'.$url.'" alt="">';
						echo '</div>';
						echo '</div>';

					}

				 ?>

			</div>

				
			</ul>

	   </section>

	   <!--  <section class="related-agency clearfix text-left">

		<h3>Agencies Related to <?php echo $heading; ?></h3>

		<ul class="agencies">
			<li class="agency">
				
				<h4>Agency Name</h4>
				<img src="../images/office02.jpg" alt="">

			</li>
		</ul>

   </section> -->
	</div>



</div>

<?php 

    include_once "footer.php"; // this will include a.php

 ?>
