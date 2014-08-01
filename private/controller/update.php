<?php
require_once("../private/model/homework_model_functions.php");


$course="UPDATE_NONE_A";


if (isset($_GET["course"])) {
   $course = htmlspecialchars($_GET["course"]);

   if (isset($_GET["assignment_id"]) && isset($_GET["assignment_version"])) {
      
       $assignment_id = htmlspecialchars($_GET["assignment_id"]);
       $assignment_version = htmlspecialchars($_GET["assignment_version"]);
       $assignment_config = get_assignment_config($_SESSION["id"], $assignment_id);
       if (!can_edit_assignment($_SESSION["id"], $assignment_id, $assignment_config)) {
           header ("Location: index.php?course=".$course."&assignment_id=".$assignment_id."&assignment_version=".$assignment_version."&error=assignment_closed");
           exit();
       }
       change_assignment_version($_SESSION["id"], $assignment_id, $assignment_version, $assignment_config);
       header ("Location: index.php?course=".$course."&assignment_id=".$assignment_id."&assignment_version=".$assignment_version);
       exit();
    } else {
    header ("Location: index.php?course=".$course);
    }
} else {
    header ("Location: index.php?course=UPDATE_NONE_B");
    exit();
}
