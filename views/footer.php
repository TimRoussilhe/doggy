<!--       <div class="footer">
        <p>♥ from the TimboLinbo team</p>
      </div> -->
    
      <section class="pop-up-container">
          <div class="overlay"></div>
          <section class="pop-up faq">

            <div class="faq-container">
              
              <i class="icon ion-happy"></i>


              <h2>FREQUENTLY ASKED QUESTIONS</h2>
            
              <ul id="questions" class"list-unstyled"="">
              <li>
                <h3>What is this?</h3>
                <p>This is Cards Against Humanity’s <em>Eight Sensible Gifts for Hanukkah</em>, a seasonal promotion that we’ve created to capture your attention and money. You give us $15 right now, and we’ll send you eight gifts over the month of December.</p>
              </li>

              <li>
                <h3>Is this really the last time you’re doing a big holiday thing?</h3>
                <p>Yes, thank G-d. If you want in on the fun, this is your last chance.</p>
              </li>

              <li>
                <h3>When will the gifts start to ship?</h3>
                <p>Early December. There’s no strict date, they’ll arrive throughout the month.</p>
              </li>

              <li>
                <h3>Why sensible gifts?</h3>
                <p>You’re a grown woman now. It’s time you acted like one.</p>
              </li>

            </ul>
            </div>

        </section>

      </section>
        <form>
         <input type="text" name="search" placeholder="">
         <input type="submit" value="Filter List" disabled>
        </form>
        <h3>Use our database to find out if your next agency is dog loving or not.</h3>

        <div class='autocomplete-container'>
          
          <ul>

            <li class="introduction">Explore results between <a href="" class="agency-number">26 agencies</a> located in <a href="">New York City</a></li>
            <?php 

              foreach ($agencies as $key => $value) {
                
                $agencyUrl = $BASE_URL . '/agencies/' . $value["Name_slug"];

                echo '<li class="autocomplete-result"><a href="'.$agencyUrl.'">'.$value["Name"].'</a></li>';

              }

             ?>

           </ul>
        </div>
      </section>

      <div class="corgi"></div>

    </section>

    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script>
      (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
      function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
      e=o.createElement(i);r=o.getElementsByTagName(i)[0];
      e.src='https://www.google-analytics.com/analytics.js';
      r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
      ga('create','UA-XXXXX-X');ga('send','pageview');
    </script>


    <script>
      window.fbAsyncInit = function() {
        FB.init({
          appId      : '1646368355652410',
          xfbml      : true,
          version    : 'v2.5'
        });
      };

      (function(d, s, id){
         var js, fjs = d.getElementsByTagName(s)[0];
         if (d.getElementById(id)) {return;}
         js = d.createElement(s); js.id = id;
         js.src = "//connect.facebook.net/en_US/sdk.js";
         fjs.parentNode.insertBefore(js, fjs);
       }(document, 'script', 'facebook-jssdk'));
    </script>

    <script src="/bower_components/jquery/dist/jquery.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.0/TweenMax.min.js"></script>

    <script src="/scripts/agency.js"></script>
    <script src="/scripts/main.js"></script>
  </body>
</html>
