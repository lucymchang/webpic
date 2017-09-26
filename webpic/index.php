<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title></title>
<script type="text/javascript" src="scripts/jquery-2.1.3.min.js"></script>
<script type="text/javascript" src="scripts/fabric-1.5.0.min.js"></script>

<meta name="google-signin-client_id" content="293296716081-f2180t6k54oe6sg368jh4fmk02fnf9rd.apps.googleusercontent.com">

<link href='https://fonts.googleapis.com/css?family=Bitter|Open+Sans' rel='stylesheet' type='text/css'>
<link href='style.css' rel='stylesheet' type='text/css'>

<?php
// generate file list
$dir = 'images/';
$images = array();
function imageList(){
  foreach(glob('images/*.*') as $filename){
    $images[] = basename($filename);
  }
  return $images;
}
$image_data = serialize(imageList());

// if remaining.txt does not exist, create and populate
if(!file_exists('remaining.txt')){
	file_put_contents("remaining.txt",$image_data);
}
?>

<script>

// store file list as javascript object
// var bg = <?php echo json_encode(imageList()); ?>

// Load in the framework for workflow
var map = mapBuild = [];


var formName, pageName, about, contact, bgName, resizeName, entererName;
var enterer = "NA";
// Un-nest framework
function unnest(map,build){
	var mapItems = [];
	formName = map[0].form;
	pageName = map[0].page;
	about = map[0].about;
	contact = map[0].contact;
	for(var i=1; i<map.length; i++){
		if(build==true && (map[i].type != "line" && map[i].type != "point" && map[i].type != "count")){
			switch (map[i].type){
				case 'bgimg':
					bgName = map[i].name;
					break;
				case 'resize':
					resizeName = map[i].name;
					break;
				case 'entererGoogle':
					enterer = 'google';
					entererName = map[i].name;
					break;
				case 'entererText':
					enterer = 'textbox';
					entererName = map[i].name;
					break;
			}
			continue;
		}
		var temp = map[i];
		temp.parent = "";
		mapItems.push(temp);
		if(typeof map[i].children === "object"){
			for(var j=0; j<map[i].children.length; j++){
				if(build==true && (map[i].children[j].type != "line" && map[i].children[j].type != "point" && map[i].children[j].type != "count")){
					continue;
				}
				var temp2 = map[i].children[j];
				temp2.parent = map[i].name;
				mapItems.push(temp2);
			}
		}
	}
	return mapItems;
};

</script>

</head>

<body>

<div id="cover">

<div id="expanded">
<span id="close">[x]</span>
</div>

<div id="summary">
<h3>What is Project Ammonite?</h3>
<p>Ammonites are ancient squid-like organisms that lived in the oceans over 66 million years ago.  Project Ammonite is a website built to collect measurements of the fossil shells of ammonites, using the measurments to describe how to shell is built as the organism grows larger.  Because ammonites are so numerous, widespread, and well preserved, they are popular among collectors and make great organisms with which to test large scale evolutionary hypotheses.</p>

<div id="signin"></div>

</div>

</div>

<div id="content">

<nav><span>About</span><span>Contact</span></nav>

<div id="signedIn">Signed in as: <span class="tooltips"><span id="signOut" onclick="signOut()">TEST</span>
<span class="tip">Click to sign out.</span></span></div>

<div class="panel" id="panel1">

</div>
<div class="panel" id="panel2">

</div>

<h1></h1>

<div id="description">

<div id="steps">


</div>

<div id="buttons">
<button id="prev" onclick="prevstep()" disabled>< previous</button>
<button id="next" onclick="nextstep()" disabled>next ></button>
<p>Feature not visible?  <a href="" name="skip" onclick="skipstep()" target="hidden_iframe">Skip it ></a></p>
</div>

</div>
<div id="canvasWrap">

<canvas id="canvas" width="600" height="500"></canvas>

<div class="counts">
</div>
</div>

<footer>
Web applet built by <a href="https://github.com/lucymchang/">Lucy M. Chang</a>.
</footer>

</div>

<div id="form" style="clear:both">
<iframe name="hidden_iframe" id="hidden_iframe"></iframe>
<form action="" method="post"
target="hidden_iframe" onsubmit="submitForm()" name="measurements" id="measurements">

</form>
</div>

<script type="text/javascript" src="scripts/script.js"></script>

</body>
</html>
