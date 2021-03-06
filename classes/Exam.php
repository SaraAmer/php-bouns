<?php
class Exam implements Exam_interface {
    private $url;
    private $page;
    private $questions;      //array contains all the questions from the file
    private $question_number;
    private $answers;   

    function getQuestion_number() {   //to get the  number of questions
        return count($this->questions);       //count the number of questions 
    }
    function getPage() {
        return $this->page;
    }
 
    
    public function __construct() {
        $this->url = Helper::get_current_Page_URL();
        $this->page = (isset($_SESSION["page"])) ? $_SESSION["page"]:1 ;    // ($this->get_current_page_index() > 0) ? (int) $this->get_current_page_index() : 1;  //integer equal the no of page
        $_SESSION["page"]=$this->page;
        $this->questions = $this->get_questions();   
        $this->answers=$this->get_answers();
        $this->move_previous();
        $this->move_next();
    }


    public function load_exam_page($page) {
    
        if (isset($this->questions[$page - 1])) {  //if the index is exist return the question 
            return $this->questions[$page - 1];
        } else {

            throw new Exception("Question doesn't exist");
            session_unset();
            session_destroy();
        }
    }

    public function move_previous() {
       
        if(isset($_POST["previous"]) && $this->page >1)
            {
            $this->page--;
            $_SESSION["page"]=$this->page;
            }
       
    }

    public function move_next() {
        if(isset($_POST["next"]) && $this->page <= $this->getQuestion_number())
        {
             
            if(!empty($_POST['radio'])) {
               if(!isset($_SESSION["clientAnswer"]))
               {
                $_SESSION["clientAnswer"]=array();  // to save the client answers  
               
               } 
              
               $_SESSION["clientAnswer"][ $_SESSION["page"]-1] =$_POST['radio'] ;     
            }

            $this->page++;
            $_SESSION["page"]=$this->page;
            echo $this->page;
        }
    }

    public function get_questions() {
        $lines = file(exam_file);
        $questions = array();
        foreach ($lines as $line) {

            if (substr($line, 0, 1) === "Q") {
                if (isset($new_mcquestion)) {
                    $questions[] = $new_mcquestion;
                }
                $new_mcquestion = new MCQuestion($line);
            } elseif (substr($line, 0, 1) === "*") {
                $new_tofquestion = new TrueOrFalseQuestion(str_replace("*", "", $line));
                $questions[] = $new_tofquestion;
            } else {
                $new_mcquestion->Add_an_Option($line);
            }
        } 
        return $questions; //array contain all questions
    }
    public function get_answers() {   
        $answers=  array();
        $lines = file(answer_file);
        foreach ($lines as $line) {
            str_replace(" ", "", $line);
            array_push($answers,$line);
    
        }
         return $answers; //array contain all the correct answers 
    

}
public function checkScore()     //public to use it in the end exam page
{
    $score=0;
     for($i=0;$i<$this->getQuestion_number();$i++)
{
   
    if($this->checkQuestion($i))   
    {
             $score++;

    }
   
}    
    return $score;
    
}
public function checkQuestion($i)
{
   
    $correct=array();
    $correct=$this->get_answers();
     //to make sure there are no spaces at the end of the line in file and get wrong score 
    //it will make a problem if the choices are for examples is set and isset  //you need to change it to tirm
    $correct_answer = preg_replace("/\s+/","",$correct[$i]);   
    $client_answer = preg_replace("/\s+/","",$_SESSION["clientAnswer"][$i]);
    
    //compare the client answer by the model answer
     if($correct_answer==$client_answer)   
     {
        $this->score++;
     
         return true;
         
     }
     else
     
     {
         
         return false;
     }

}

}
