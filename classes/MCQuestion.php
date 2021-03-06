<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of question
 *
 * @author memad
 */
 //class to add new questions to the quiz //
class MCQuestion {
    private $question;
    private $options;
    
    public function __construct($question){   //set Question //parameterize constructor
        $this->question = $question;
    }
    
    
    
    function get_question() {
        return $this->question;
    }

    function get_options() {
        return $this->options;
    }
  
    
    function Add_an_Option($option) {   //add a new option to the array
        $this->options[] = $option;       
    }


   
}
