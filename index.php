<?php
// <!-- saved from url=(0055)http://gugggly.com/templates/doc-web/index.html#welcome --
session_start();

if(isset($_GET['logout'])){
	unset($_SESSION['login']);
	session_destroy();
	header('Location: /docs/batcave.php');
}
else if(isset($_POST) and isset($_POST['user']) and isset($_POST['passwd']) and $_POST['user'] == 'batcave' and $_POST['passwd'] == 'sk@foodtalk'){

	$_SESSION['login'] = 'yes';
}

if (isset($_SESSION['login']) and $_SESSION['login'] == 'yes'){
	$allow = true;
}else 
	$allow = false;

?><!DOCTYPE html>
<html><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<meta name="description" content="">
<meta name="HandheldFriendly" content="True">
<meta name="MobileOptimized" content="320">
<meta name="viewport" content="initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
<title>Batcave API Documentation</title>

<link href="resource/css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="resource/style.css">
<link rel="stylesheet" href="resource/prettify.css">
<link rel="stylesheet" type="text/css" href="resource/sunburst.css"><style id="style-1-cropbar-clipper">/* Copyright 2014 Evernote Corporation. All rights reserved. */
.en-markup-crop-options {
    top: 18px !important;
    left: 50% !important;
    margin-left: -100px !important;
    width: 200px !important;
    border: 2px rgba(255,255,255,.38) solid !important;
    border-radius: 4px !important;
}

.en-markup-crop-options div div:first-of-type {
    margin-left: 0px !important;
}
</style></head>
<body>
<div class="wrapper">
<nav>
 
  	<div class="pull-left">
    	<h1><a href="javascript:"><img src="resource/icon.png" alt="Free Documentation Template Icon"> <span>Web Doc </span></a></h1>
    </div>
    
    <div class="pull-right">
<!--     	<a href="#" target="_blank" class="btn btn-download"><img src="resource/download.png" width="25" alt="Download Free Documentation Template"> Download Now</a> -->
    </div>

</nav>
<header>
  <div class="container">
      <h2 class="lone-header">Batcave API Documentation  
<?php if($allow){ ?>
    <a class="btn1" href="?logout=true"> logout </a>
<?php 
}
else{
?>
	</h2>
	<br>Please login to access
    <form method="post">    
	    <input placeholder="username" type="text" name="user">
    	<input placeholder="password" type="password" name="passwd">
    	<input type="submit" value="login" style="width:100px; right:20px float: right; border-radius: 7px;" >
    </form>
    <br>
  </div>
</header>
<footer>
  <div class="">
    <p> © Copyright Digital Food talk Pvt Ltd. All Rights Reserved.</p>
  </div>
</footer>
</div>
</body></html>
<?php 
exit();
}
?>
	</h2>
  </div>
</header>
<section>
  <div class="container">
    <ul class="docs-nav" style="top: 0px;">    
<?php  
	$open_api = json_decode(file_get_contents('open_api.json'),true);
	if(isset($open_api['data']) && !empty($open_api['data'])){
	echo '<li><a href="#open"><strong>Open API</strong></a></li>';	
		foreach ($open_api['data'] as $key=> $val){
			
			if(isset($val['title']))
				$title = $val['title'];
			else{
				$title = explode(',', $val['desc'])[0];
			}
				
			echo '<li><a href="#open_'.$key.'" class="cc-active">'.$key.'. '.$title.'</a></li>'."\n";
		}
	}
?>  
      <li class="separator"></li>
      
		</ul>
         <ul class="docs-nav" style="position:fixed; right: 80px;">
    
      <li class="separator"></li>

<?php  
	$authorised_api = json_decode(file_get_contents('authorised_api.json'),true);
// 	var_dump($authorised_api);
	if(isset($authorised_api['data']) && !empty($authorised_api['data'])){
	echo '<li><a href="#closed"><strong> Authorised API</strong></a></li>';	
		foreach ($authorised_api['data'] as $key=> $val){
			
			if(isset($val['title']))
				$title = $val['title'];
			else{
				$title = explode(',', $val['desc'])[0];
			}
				
			echo '<li><a href="#closed_'.$key.'" class="cc-active">'.$title.'</a></li>'."\n";
		}
	}
?>        
    </ul>
    <div class="docs-content">

<?php
echo '<h3 id="open" > Open API </h3><p>'.nl2br($open_api['text']).'</p>';
if(isset($open_api['data']) && !empty($open_api['data'])){
	foreach ($open_api['data'] as $key=> $val){
			
		if(isset($val['title']))
			$title = $val['title'];
		else{
			$title = explode(',', $val['desc'])[0];
		}

		echo '<h3 id="open_'.$key.'"> '.$title.'</h3>
     	 <p> '.$val['desc'].'.</p>'."\n";
		echo '<h4>API Route</h3>';
		echo '<ul><li>'.$val['route'].'</li></ul>';
		
		echo '<h4>Method Allowed</h3>';
		echo '<ul><li>'.$val['method'].'</li></ul>';
		if(isset($val['urls']) && !empty($val['urls'])){
			echo '<h4>End points</h3>';
			echo '<ul>';
			foreach ($val['urls'] as $url){
				echo '<li>'.$url.'</li>';		
			}
			echo '</ul>';
		}
		if(isset($val['body'])){
			echo '<h4>Request Body</h3>';
// 			var_dump($val['body']);
			echo '<pre class="prettyprint prettyprinted">'.print_json(json_decode($val['body'],true)).'</pre>';
		}
		
		if(isset($val['response'])){
			echo '<h4>Response</h3>';
			// 			var_dump($val['body']);
			echo '<pre class="prettyprint prettyprinted">'.print_json(json_decode($val['response'],true)).'</pre>';
		}

	}
}

echo '<h3 id="closed" > Authorised API </h3><p>'.nl2br($authorised_api['text']).'</p>';
	

if(isset($authorised_api['data']) && !empty($authorised_api['data'])){
	
	foreach ($authorised_api['data'] as $key=> $val){
		if(isset($val['title']))
			$title = $val['title'];
		else{
			$title = explode(',', $val['desc'])[0];
		}

		echo '<h3 id="closed_'.$key.'"> '.$title.'</h3>
         <p> '.$val['desc'].'.</p>'."\n";
		echo '<h4>API Route</h3>';
		echo '<ul><li>'.$val['route'].'</li></ul>';

		echo '<h4>Method Allowed</h3>';
		echo '<ul><li>'.$val['method'].'</li></ul>';
		if(isset($val['urls']) && !empty($val['urls'])){
			echo '<h4>End points</h3>';
			echo '<ul>';
			foreach ($val['urls'] as $url){
				echo '<li>'.$url.'</li>';
			}
			echo '</ul>';
		}
		if(isset($val['body'])){
			echo '<h4>Request Body</h3>';
			//          var_dump($val['body']);
			echo '<pre class="prettyprint prettyprinted">'.print_json(json_decode($val['body'],true)).'</pre>';
		}

		if(isset($val['response'])){
			echo '<h4>Response</h3>';
			//          var_dump($val['body']);
			echo '<pre class="prettyprint prettyprinted">'.print_json(json_decode($val['response'],true)).'</pre>';
		}

	}
}

?>

    </div>
  </div>
</section>
<section class="vibrant centered">
  <div class="">
   
  </div>
</section>
<footer>
  <div class="">
    <p> © Copyright Digital Food talk Pvt Ltd. All Rights Reserved.</p>
  </div>
</footer>
</div>
<script src="resource/jquery.min.js"></script> 
<script type="text/javascript" src="resource/prettify.js"></script> 
<script src="resource/layout.js"></script>


</body></html>
<?php

function print_json($arr, $space=''){
	
	$str = '<span class="tag">{</span>';
	$strarr=array();
	foreach ($arr as $k=>$v){
		if(is_array($v))
			$strarr[] =	'<br>'.$space.'    <span class="pun">"'.$k.'"</span><span class="pln">:</span>'.print_json($v, '    ');
		else
			$strarr[] = '<br>'.$space.'    <span class="pun">"'.$k.'"</span><span class="pln">:</span><span class="str">"'.$v.'"</span>';
	}
	
	$str .= implode('<span class="pln">,</span>', $strarr);
	$str .= '<br>'.$space.'<span class="tag">}</span>';
	return $str;
	
}