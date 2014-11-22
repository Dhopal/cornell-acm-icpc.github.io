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
        echo '<h1>' . $this->name . '</h1>';

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
      return strcmp($a->$name, $b->name);
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

      if (($handle = fopen("files/members.csv", "r")) !== FALSE) {
          while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
              if ($row === 1) {
                $row++;
                continue;
              }
              $row++;
              //Find out which year the member is in
              //Add to correct class
              $member = new Member($data[0], $data[2], $data[3], $data[4]);

              switch ($data[1]) {
                case "2015":
                    array_push($seniors, $member);
                    break;
                case "2016":
                    array_push($juniors, $member);
                    break;
                case "2017":
                    array_push($sophomores, $member);
                    break;
                case "2018":
                    array_push($freshmen, $member);
                    break;
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

  <body>
    <?php include("header.html"); ?>

    <div id="members">
      <div id="subNav">
        <ul>
          <li id="seniorButton"><a href="#seniors">Seniors</a></li>
          <li id="seniorButton"><a href="#juniors">Juniors</a></li>
          <li id="sophButton"><a href="#sophomores">Sophomores</a></li>
          <li id="freshButton"><a href="#freshmen">Freshmen</a></li>
        </ul>
      </div>

      <?php printMembers(); ?>
  </body>
</html>