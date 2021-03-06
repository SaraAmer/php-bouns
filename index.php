<?php
require_once "autoload.php";
try {
    $exam = new Exam();   //object from exam class
 
    $current_page = $exam->getPage();  
    $correct=$exam->get_answers();
    if ($current_page == $exam->getQuestion_number()+1) {
        $score =$exam->checkScore();
        include "views/header.php";
        include_once("views/End.php");
        session_unset();
        session_destroy();
      
        exit();
    } else {
        $current_question = $exam->load_exam_page($current_page);
    }
   
    // ***************************************************************************************************************//
    
} catch (Exception $ex) {
    if (mode === "production") {
        include("views/error.php");
        exit();
    } else {
        echo $ex->getMessage();
        echo $ex->getTraceAsString();
        exit();
    }
}
?>
<html>
    <?php include "views/header.php"; ?>
    <body>
        <?php include "views/questions.php"; ?>
    </body>
</html>