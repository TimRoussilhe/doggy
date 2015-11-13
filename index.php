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
	    $params['agencies'] = collection("Agencies")->find()->toArray();;

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

	  static public function getAgencies()
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