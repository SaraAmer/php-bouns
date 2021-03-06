<html>
    
    <body>
    <div class="container">
    <center>
        <h2> Exam End! </h2>
      <h3> <?php echo "Your Score is : ".$score ."/" .$exam->getQuestion_number(); ?></h3>
      <div id="tryagain" > <a type="submit" href="<?php echo $_SERVER['PHP_SELF']?>" class="btn btn-primary"> 
       Try Again
        </a>
     
      <?php
             
           for($i=0;$i<$exam->getQuestion_number();$i++)
           {
            $current_question = $exam->load_exam_page($i+1);
          echo' <div class="container mt-sm-5 my-1"> 
            <div class="py-2 h5"><b> '.$current_question->get_question();' ></b></div>
            <div class="ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3"\>
          
            </div></div>';
        
        $correct_answer = preg_replace("/\s+/","",$correct[$i]);   
        $client_answer = preg_replace("/\s+/","",$_SESSION["clientAnswer"][$i]);
        
        //compare the client answer by the model answer
         if($exam->checkQuestion($i))   
         {
          echo "</br>"."</br>". "Correct Answer is: " .$correct[$i] . "</br>" ."</br>";
         
          echo "Your answer is: ".$_SESSION["clientAnswer"][$i]."</br>"."</br>" ;
         }
         else
         {
          echo "</br>"."</br>". "Correct Answer is: " .$correct[$i] . "</br>" ."</br>";
          echo "Your Answer is : " .'<mark>'.$_SESSION["clientAnswer"][$i].'</mark>'."</br>";
       
       
         }
          

           }
         
        
      ?>
   
    </center>
    </div>
    </body>
    
    <script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</html>

