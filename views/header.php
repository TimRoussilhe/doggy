<!doctype html>
<html class="no-js" lang="">
  <head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dog Agency Index</title>

    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <!-- Place favicon.ico in the root directory -->

    <!-- build:css styles/vendor.css -->
    <!-- bower:css -->
    <!-- endbower -->
    <!-- endbuild -->

    <!-- build:css styles/main.css -->
    <link rel="stylesheet" href="/styles/ionicons.min.css">
    <link rel="stylesheet" href="/styles/main.css">
    <!-- endbuild -->
    
    <!-- build:js scripts/vendor/modernizr.js -->
    <script src="/bower_components/modernizr/modernizr.js"></script>
    <!-- endbuild -->

<?php 


    $BASE_URL = "http://" . $_SERVER['SERVER_NAME'];

    // gets the current URI, remove the left / and then everything after the / on the right
    $directory = explode('/',ltrim($_SERVER['REQUEST_URI'],'/'));
    $extension = '.php';

    $trimmed = str_replace($extension, '', $directory);


    // loop through each directory, check against the known directories, and add class   
    $directories = array("index", "success-stories","solutions","insights","connect","search","events","resources","support"); 
    foreach ($directories as $folder){

      $active[$folder] = ($trimmed[count($trimmed)-2]  == $folder || $trimmed[count($trimmed)-3]  == $folder)? "active":"noactive";
    
    }
    
?>
  </head>
  <body>
  
  <!--[if lt IE 10]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
    <![endif]-->
    

    <div class="header">
    <ul class="nav left-nav pull-left">
        <li><i class="icon ion-ios-paw"></i><h1><a href="<?php echo $BASE_URL;?>" title="">Dog Agency Index</a></h1></li>
      </ul>
      <ul class="nav right-nav pull-right ">
        <li><a href="<?php echo $BASE_URL."/agencies/"; ?>" class="link">Agencies</a></li>
        <li><a href="#" class="link">Testimonials</a></li>
        <li><a href="#" class="link cta">Add an agency</a></li>
        <li><a href="#" class="icon facebook"><i class="icon ion-social-facebook"></i></a></li>
        <li><a href="#" class="icon twitter"><i class="icon ion-social-twitter"></i></a></li>
      </ul>
    </div>
    