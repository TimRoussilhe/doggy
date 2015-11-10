<?php
    //include cockpit
    include_once('cms/bootstrap.php');

	include_once 'src/Epi.php';
	Epi::init('route','template');
	Epi::setSetting('exceptions', true);

	/*
	 * This is a sample page whch uses EpiCode.
	 * There is a .htaccess file which uses mod_rewrite to redirect all requests to index.php while preserving GET parameters.
	 * The $_['routes'] array defines all uris which are handled by EpiCode.
	 * EpiCode traverses back along the path until it finds a matching page.
	 *  i.e. If the uri is /foo/bar and only 'foo' is defined then it will execute that route's action.
	 * It is highly recommended to define a default route of '' for the home page or root of the site (yoursite.com/).
	 */

	getRoute()->get('/', array('MyClass', 'MyMethod'));
	getRoute()->get('/agencies/', array('MyClass', 'Agencies'));
	getRoute()->get('/agencies/(\S+)', array('MyClass', 'Agency'));
	getRoute()->get('/dogs/(\w+)', array('MyClass', 'Dog'));
	
	getRoute()->post('/updatelike/', array('MyClass', 'updateLike'));
	getRoute()->post('/getagencies/', array('MyClass', 'getAgencies'));
	getRoute()->post('/form-action/', array('MyClass', 'formAction'));

	getRoute()->run(); 


	/*
	 * ******************************************************************************************
	 * Define functions and classes which are executed by EpiCode based on the $_['routes'] array
	 * ******************************************************************************************
	 */
	class MyClass
	{
	  static public function MyMethod()
	  {

	    $template = new EpiTemplate();
	    $params = array();
	    $params['heading'] = 'This is a heading';
	    $params['imageSrc'] = 'https://github.com/images/modules/header/logov3-hover.png';
	    $params['content'] = str_repeat('Lorem ipsum ', 100);
	    $template->display('views/index.php', $params);

	  }

	  static public function Agencies()
	  {

	  	$item = collection("Agencies")->find()->toArray();
	  	//$items = collection()->find()->toArray();
	  	
	  	$template = new EpiTemplate();
    	$params = array();
    	$params['agencies'] = $item;
    	$template->display('views/agencies.php', $params);

	  }

	  static public function Agency($agency)
	  {

	  	$item = collection("Agencies")->findOne(["Name_slug"=>$agency]);
	  	
	  	$template = new EpiTemplate();
    	$params = array();
   		$params['agency'] = $item;

    	$template->display('views/agency.php', $params);

	  }

	  static public function Dog($dog)
	  {

	  $item = collection("Dogs")->findOne(["name_slug"=>$dog]);
	  	
	  	$template = new EpiTemplate();
    	$params = array();
   		$params['dog'] = $item;
    	$template->display('views/dog.php', $params);

	  }

	  static public function updateLike($data)
	  {

	  	$entry = ['Likes' => 1,'_id'=>'55c658c2d8cf2doc430339049'];

		cockpit('collections:save_entry', 'Dogs', $entry);
	  	
		echo $data;

	  }

	 	static public function formAction()
	  {


		// Pear library includes
		// You should have the pear lib installed

	  	require_once('includes/class.phpmailer.php');
	  	require_once('includes/class.smtp.php');


		//Settings 
		$max_allowed_file_size = 100; // size in KB 
		$allowed_extensions = array("jpg", "jpeg", "gif", "bmp");
		$upload_folder = './uploads/'; //<-- this folder must be writeable by the script
		$your_email = 'tom@amazing-designs.com';//<<--  update this to your email address

			$errors ='';

			var_dump($_FILES);

			//Get the uploaded file information
			$name_of_uploaded_file =  basename($_FILES['uploaded_file']["name"]);
			
			//get the file extension of the file
			$type_of_uploaded_file = substr($name_of_uploaded_file, 
									strrpos($name_of_uploaded_file, '.') + 1);

			var_dump($type_of_uploaded_file);
			var_dump($_FILES['uploaded_file']);
			
			$size_of_uploaded_file = $_FILES["uploaded_file"]["size"]/1024;
			
			// ///------------Do Validations-------------
			// if(empty($_POST['name'])||empty($_POST['email']))
			// {
			// 	$errors .= "\n Name and Email are required fields. ";	
			// }
			// if(IsInjected($visitor_email))
			// {
			// 	$errors .= "\n Bad email value!";
			// }
			
			// if($size_of_uploaded_file > $max_allowed_file_size ) 
			// {
			// 	$errors .= "\n Size of file should be less than $max_allowed_file_size";
			// }


			
			//------ Validate the file extension -----
			$allowed_ext = false;
			for($i=0; $i<sizeof($allowed_extensions); $i++) 
			{ 	
				if(strcasecmp($allowed_extensions[$i],$type_of_uploaded_file) == 0)
				{
					$allowed_ext = true;		
				}
			}
			
			if(!$allowed_ext)
			{
				$errors .= "\n The uploaded file is not supported file type. ".
				" Only the following file types are supported: ".implode(',',$allowed_extensions);
			}
			

			//send the email 
			if(empty($errors))
			{	

				//copy the temp. uploaded file to uploads folder
				$path_of_uploaded_file = $upload_folder . $name_of_uploaded_file;
				$tmp_path = $_FILES["uploaded_file"]["tmp_name"];
				
				if(is_uploaded_file($tmp_path))
				{
				    if(!copy($tmp_path,$path_of_uploaded_file))
				    {
				    	$errors .= '\n error while copying the uploaded file';
				    }
				}
				
				//send the email
				// $name = $_POST['name'];
				// $visitor_email = $_POST['email'];
				// $user_message = $_POST['message'];
				// $to = $your_email;
				// $subject="New form submission";
				// $from = $your_email;
				// $text = "A user  $name has sent you this message:\n $user_message";
				
				// $message = new Mail_mime(); 
				// $message->setTXTBody($text); 
				// $message->addAttachment($path_of_uploaded_file);
				// $body = $message->get();
				// $extraheaders = array("From"=>$from, "Subject"=>$subject,"Reply-To"=>$visitor_email);
				// $headers = $message->headers($extraheaders);
				// $mail = Mail::factory("mail");
				// $mail->send($to, $headers, $body);
				// //redirect to 'thank-you page
				// header('Location: thank-you.html');


				//Create a new PHPMailer instance
				$mail = new PHPMailer;
				//Tell PHPMailer to use SMTP
				$mail->isSMTP();
				$mail->SMTPDebug = 2;
				$mail->Debugoutput = 'html';

				//Set the hostname of the mail server
				$mail->Host = 'smtp.gmail.com';

				$mail->Port = 587;
				$mail->SMTPSecure = 'tls';

				//Whether to use SMTP authentication
				$mail->SMTPAuth = true;

				//Username to use for SMTP authentication - use full email address for gmail
				$mail->Username = "timothee.roussilhe@gmail.com";

				//Password to use for SMTP authentication
				$mail->Password = "";

				//Set who the message is to be sent from
				$mail->setFrom('timothee@stinkdigital.com', 'First Last');
				$mail->addAddress('linn@stinkdigital.com', 'John Doe');

				//Set the subject line
				$mail->Subject = 'PHPMailer GMail SMTP test';
				
				$mail->Body    = 'This is the HTML message body <b>in bold!</b>';
				$mail->addAttachment($path_of_uploaded_file, 'My uploaded file');

				//Read an HTML message body from an external file, convert referenced images to embedded,
				//convert HTML into a basic plain-text alternative body
				//$mail->msgHTML(file_get_contents('contents.html'), dirname(__FILE__));
				//Replace the plain text body with one created manually
				$mail->AltBody = 'This is a plain-text message body';

				//send the message, check for errors
				if (!$mail->send()) {
				    echo "Mailer Error: " . $mail->ErrorInfo;
				} else {
				    echo "Message sent!";
				}
			}
		
		///////////////////////////Functions/////////////////
		// Function to validate against any email injection attempts
		function IsInjected($str)
		{
		  $injections = array('(\n+)',
		              '(\r+)',
		              '(\t+)',
		              '(%0A+)',
		              '(%0D+)',
		              '(%08+)',
		              '(%09+)'
		              );
		  $inject = join('|', $injections);
		  $inject = "/$inject/i";
		  if(preg_match($inject,$str))
		    {
		    return true;
		  }
		  else
		    {
		    return false;
		  }
		}
	  	
	  }

	  static public function getAgencies($data)
	  {
	  	$posts =[];
	  	
	  	$items = collection("Agencies")->find()->toArray();

	  	foreach ($items as $key => $value) {
	  		//var_dump($value);
	  		if(stripos($value["Name"],$_POST["query"])!==false){
  			
  				array_push($posts,$value);
  			
  			}
	  	}

	  	echo(json_encode($posts));

	  }
	
	}

?>