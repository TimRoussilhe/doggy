<?php 

include_once "header.php"; // this will include a.php


 ?>

    <section id="main-intro">

      <div class="main-logo">
        
        <div class="logo"></div>
        <div class="index"></div>
        <div class="doghead"></div>
        <div class="dogtail"></div>

      </div>

      <div class="intro-text">Humans are good but ugly. Pick your next agency based on something that really matters: cute dogs.</div>
      
      <div class="down"></div>
      <div class="corgi"></div>

    </section>

    <div class="container" id="main-container">
      <section class="search-form">
        <h2>Find out what agencies in New York that loves dogs </h2>
        <h3>Use our database to find out if your next agency is dog loving or not.</h3>

        <form>
         <input type="text" name="search" placeholder="">
         <input type="submit" value="Search" disabled>
        </form>

        <div class='autocomplete-container'>
        </div>

        <p class="subtitle"> <span class="bold">200 Agencies</span> in our Database. Is your agency not on the list? Shoot us an email.</p>

        <section class="doge-options clearfix">
          <div class="col-md-4 col-xs-12 option">
            <img src="images/doge.png">
            <h4>DOGES CHOICE</h4>
            <p>This is an extremely, extra ordinary place for dogs.</p>
          </div>
          <div class="col-md-4 col-xs-12 v">
            <img src="images/yes.png">
            <h4>YES</h4>
            <p>This is an office where your dog is welcome and loved.</p>
          </div>
          <div class="col-md-4 col-xs-12 option">
            <img src="images/no.png">
            <h4>NO</h4>
            <p>This is a place that does not like dogs :(.</p>
          </div>
        </section>
        
      </div>

      <section class="form-container">
          
        <?php 

        include_once "form.php"; // this will include a.php

        ?>

      </section>

      <!-- section id="main-questions" class="clearfix">
        <div class="question-container">
          <div class="question">
            <p>We are an agency hiring a new <span class="line">dog</span> employee</p>
          </div>
        </div>
        <div class="question-container">
          <div class="question">
            <p>Me <span class="line">and my dog</span> are looking for a new job. </p>
          </div>
        </div>
      </section>
 -->
      <section id="agency-form">
        
      </section>
      
<?php 

    include_once "footer.php"; // this will include a.php

 ?>
