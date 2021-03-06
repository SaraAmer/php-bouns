<?php
require_once "autoload.php";
function get_answers() {
    $answers=array();
    $lines = file(answer_file);
    $questions = array();
    foreach ($lines as $line) {
   array_push($answers,$line);
    }
    print_r($answers);
    // return $answers; //array contain all questions


}