<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8"/>
	<title>Cornell ACM ICPC</title>
	<link rel="stylesheet" type="text/css" href="style/style.css" />
	<link rel="stylesheet" type="text/css" href="style/team.css" />
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Noticia+Text' rel='stylesheet' type='text/css'>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
	<script type="text/javascript" src="js/script.js"></script>
	<script type="text/javascript" src="js/smooth_scroll.js"></script>
</head>
<body>
	<?php
	$seniors = array();
	$juniors = array();
	$sophomores = array();
	$freshmen = array();

	class Member {
	  public $name = '';
	  public $major = '';
	  public $cs = '';
	  public $interests = '';

	  public function __construct($name, $major, $cs, $interests) {
	    $this->name = $name;
	    $this->major = $major;
	    $this->cs = $cs;
	    $this->interests = $interests;
	  }

	  function printDetails() {
	    echo '<li class="member">';
	    if (file_exists("files/" . $this->name . ".pdf")) {
	      echo '<h2><a href="' . "files/" . $this->name . ".pdf" . '">' . $this->name . '</a></h2>';
	    }
	    else {
	      echo '<h2>' . $this->name . '</h2>';
	    }

	    if ($this->major !== "") {
	      echo '<p>Major: ' . $this->major . '</p>';
	    }

	    if ($this->cs !== "") {
	      echo '<p>Concentration: ' . $this->cs . '</p>';
	    }

	    if ($this->interests !== "") {
	      echo '<p>Interests: ' . $this->interests . '</p>';
	    }

	    echo '</li>';
	  }
	}

	function usortTest($a, $b) {
	  return strcmp($a->name, $b->name);
	} 

	function printYear($id, $label, $members) {
	  echo '<div id="' . $id . '" class="group">';
	  echo '<div class="subTitle">
	        <h3>' . $label . '</h3>
	      </div>
	      <div class="contentArea">
	        <ul>';
	  //add members
	        foreach ($members as $m) {
	          $m->printDetails();
	        }

	  echo  '</ul>
	      </div>
	    </div>';
	}  

	function printMembers() {
	  global $seniors, $juniors, $sophomores, $freshmen;
	  $row = 1;

	  $today = getdate();

	  $oldest = $today["year"];

	  if ($today["mon"] >= 8) {
	    $oldest++;
	  }

	  if (($handle = fopen("files/members.csv", "r")) !== FALSE) {
	      while (!feof($handle)) {
	          $data = fgetcsv($handle, 0, "\r");

	          for ($x = 1; $x < count($data); $x++) {
	            $person = explode(",", $data[$x]);

	            $name = "";
	            $year = "";
	            $major = "";
	            $cs = "";
	            $interests = "";

	            if (count($person) >= 1) {
	              $name = $person[0];
	            }
	            if (count($person) >= 2) {
	              $year = $person[1];
	            }
	            if (count($person) >= 3) {
	              $major = $person[2];
	            }
	            if (count($person) >= 4) {
	              $cs = $person[3];
	            }
	            if (count($person) >= 5) {
	              $interests = $person[4];
	            }

	            $member = new Member($name, $major, $cs, $interests);

	            //Find out which year the member is in
	            //Add to correct class
	            switch ($year) {
	              case strval($oldest):
	                  array_push($seniors, $member);
	                  break;
	              case strval($oldest + 1):
	                  array_push($juniors, $member);
	                  break;
	              case strval($oldest + 2):
	                  array_push($sophomores, $member);
	                  break;
	              case strval($oldest + 3):
	                  array_push($freshmen, $member);
	                  break;
	          } 


	          }
	      }
	      fclose($handle);
	  }
	  
	  //sort
	  usort($seniors, "usortTest");
	  usort($juniors, "usortTest");
	  usort($sophomores, "usortTest");
	  usort($freshmen, "usortTest");

	  //print
	  printYear("seniors", "Seniors", $seniors);
	  printYear("juniors", "Juniors", $juniors);
	  printYear("sophomores", "Sophomores", $sophomores);
	  printYear("freshmen", "Freshmen", $freshmen);
	}
	?>

	<?php include("header.html"); ?>
	<div id="content">
		<div id="subNav">
          <ul>
          	<li id="coachButton"><a href="#group1">Coaches</a></li>
            <li id="seniorButton"><a href="#seniors">Seniors</a></li>
            <li id="juniorButton"><a href="#juniors">Juniors</a></li>
            <li id="sophButton"><a href="#sophomores">Sophomores</a></li>
            <li id="freshButton"><a href="#freshmen">Freshmen</a></li>
          </ul>
      	</div>
      	<hr>
		<div id="group1" class="sec">
			<h2>Coaches</h2>
			<div id="coach1" class="coach">
        	  <h3>Daniel Fleischman</h3>
        	  <div class="details">
        		<p>I am a PhD student in the ORIE department with minors in CS and Applied Math.
          			I started competing on ACM in 2005, when I was in college and was hooked up on competitions since then.
          			I had to retire from ACM-ICPC after my second world final in 2007 (you can't compete after two WF), so I started to coach in 2009,
          			still in my home university, in Brazil. I've been the coach for Cornell since 2012, and I love it!
          			<br><br>
          			Even being retired from ACM-ICPC I can (and do) still compete on other programming competitions like Google CodeJam,
          			Facebook HackerCup and Topcoder Open. Other competitions that interest me are Mathematics competitions (like the IMC)
         			and puzzle competitions (like the Microsoft Puzzle Challenge).</p>
         	  </div>
      		</div>
			<div id="coach2" class="coach">
        	  <h3>Saketh Are</h3>
        	  <div class="details">
        		<p>I am a PhD student in the ORIE department with minors in CS and Applied Math.
          			I started competing on ACM in 2005, when I was in college and was hooked up on competitions since then.
          			I had to retire from ACM-ICPC after my second world final in 2007 (you can't compete after two WF), so I started to coach in 2009,
          			still in my home university, in Brazil. I've been the coach for Cornell since 2012, and I love it!
          			<br><br>
          			Even being retired from ACM-ICPC I can (and do) still compete on other programming competitions like Google CodeJam,
          			Facebook HackerCup and Topcoder Open. Other competitions that interest me are Mathematics competitions (like the IMC)
         			and puzzle competitions (like the Microsoft Puzzle Challenge).</p>
      		  </div>
      		</div>
		</div>

		<div id="group2" class="sec">
			<br>
			<hr>
			<h2>Members</h2>
			<?php printMembers(); ?>
		</div>
	</div>
</body>