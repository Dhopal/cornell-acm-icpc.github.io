<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8"/>
    <title>Cornell ACM ICPC</title>
    <link rel="stylesheet" type="text/css" href="style/style.css" />
    <link rel="stylesheet" type="text/css" href="style/about.css" />
    <link href='http://fonts.googleapis.com/css?family=Droid+Sans' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Noticia+Text' rel='stylesheet' type='text/css'>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js"></script>
    <script type="text/javascript" src="js/member_control.js"></script>
    <script type="text/javascript" src="js/script.js"></script>
  </head>

  <?php
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
          echo '<h1><a href="' . "files/" . $this->name . ".pdf" . '">' . $this->name . '</a></h1>';
        }
        else {
          echo '<h1>' . $this->name . '</h1>';
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
            <h2>' . $label . '</h2>
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
      $row = 1;
      $seniors = array();
      $juniors = array();
      $sophomores = array();
      $freshmen = array();

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
      } else {
        echo 'handle is false';
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

  <body>
    <?php include("header.html"); ?>

    <div id="members">
      <div id="subNav">
        <ul>
          <li id="seniorButton"><a href="#seniors">Seniors</a></li>
          <li id="juniorButton"><a href="#juniors">Juniors</a></li>
          <li id="sophButton"><a href="#sophomores">Sophomores</a></li>
          <li id="freshButton"><a href="#freshmen">Freshmen</a></li>
        </ul>
      </div>

      <?php printMembers(); ?>
    </div>
  </body>
</html>