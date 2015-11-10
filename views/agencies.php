<?php 

include_once "header.php"; // this will include a.php


 ?>


<div class="container" id="main-container">
  <section class="agencies-header">

  	<h2><?php echo count($agencies); ?></h2>

  </section>

  <section class="agency-list clearfix text-left">
  			
	  	
	      	<?php foreach ($agencies as $key => $value) {
	      		
	      		$agencyUrl ="http://" . $_SERVER['SERVER_NAME'] . '/agencies/' . $value["Name_slug"];

	      		echo '<div class="agency-listing">';
	      		echo '<a href="'. $agencyUrl .'" title="">';
	      		echo $value['Name'];
	      		echo '</a></div>';
	      		echo "<br>";

	      	}  ?>

	    </div>


   </section>

   
</div>


<?php 

    include_once "footer.php"; // this will include a.php

 ?>