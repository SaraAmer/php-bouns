<div class="container mt-sm-5 my-1">
<form method="post" action="<?php echo $_SERVER['PHP_SELF']?>">
    <div class="question ml-sm-5 pl-sm-5 pt-2">
        <div class="py-2 h5"><b><?php echo $current_question->get_question();   ?> ?</b></div>
        <div class="ml-md-3 ml-sm-3 pl-md-5 pt-sm-0 pt-3" id="options">
            <?php foreach($current_question->get_options() as $option) {?>
            <label class="options"><?php echo $option;?> 
            <input type="radio" name="radio" value="<?php echo $option; ?>" <?php echo ($_SESSION["clientAnswer"][ $_SESSION["page"]-1] == $option)?"checked":"" ?> >
             <span class="checkmark"></span> </label>
            <?php }  
            ?>
        </div>
       
    </div>
        <div class="d-flex align-items-center pt-3">
     
        <div id="prev" > <input type="submit" href="<?php echo $_SERVER['PHP_SELF']."?previous"?>" class="btn btn-primary" name="previous" value="previous"> 
       
        </div>
        <div class="ml-auto mr-sm-5"> 
        <input type="submit" class="btn btn-success"  name="next" value="Next"/>
        </div>
        
    </div>
    </form>


</div>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>