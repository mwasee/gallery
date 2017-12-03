
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <title></title>
        
                <!-- Add jQuery library -->
 <script src="js/jquery-3.2.1.js" type="text/javascript"></script>
<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="fancybox-2.1.7/lib/jquery.mousewheel.pack.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="fancybox-2.1.7/source/jquery.fancybox.css?v=2.1.7" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox-2.1.7/source/jquery.fancybox.pack.js?v=2.1.7"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="fancybox-2.1.7/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox-2.1.7/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="fancybox-2.1.7/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="fancybox-2.1.7/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="fancybox-2.1.7/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>
    <script type="text/javascript">
	$(document).ready(function() {
		$(".fancybox").fancybox();
	});
</script>
    </head>
    <body>
        <form id="myphotoform" enctype="multipart/form-data">
            <div class="container">
                <div class="form-group">
                    <label for="caption">CAPTION</label>
                    <input type="text" class="form-control" name="caption">
                    
                </div>
                <div class="form-group">
                    <label for="photo">PHOTO</label>
                    <input type="file" class="form-control" name="photo">
                </div>
                <button type="submit" class="btn btn-success">UPLOAD</button>
            </div>
        </form>
        
        <div id="result" style="height: 100px;border:2px solid #000;">
            
        </div>
        <div class="container">
             <?php
        $hostname="localhost";
        $username="root";
        $password="";
        $databasename="gallery";
        
        $conn=new mysqli ($hostname,$username,$password,$databasename);
        $q="select * from gallerytable";
        $result=$conn->query($q);
        ?>

    
<?php
        while ($row = mysqli_fetch_assoc($result)){
     ?>      

    
    
    <?php //echo $row ['caption'];  ?>
  
  <a class="fancybox" rel="group" href="<?php echo $row ['photo'];  ?>"><img src="<?php echo $row ['photo'];  ?>" alt="" /></a>  

       
<?php
}
        ?>
        </div>
        
       
        <script src="js/popper.min.js" type="text/javascript"></script>
        <script src="js/bootstrap.js" type="text/javascript"></script>
        
        <script>
            $("#myphotoform").submit(function(event)
{
     var ajaxRequest;
    /* Stop form from submitting normally */
    event.preventDefault();

    /* Clear result div*/
    $("#result").html('');

    /* Get from elements values */
  //  var values = $(this).serialize();
 var formData = new FormData(this);
    /* Send the data using post and put the results in a div */
    /* I am not aborting previous request because It's an asynchronous request, meaning 
       Once it's sent it's out there. but in case you want to abort it  you can do it by  
       abort(). jQuery Ajax methods return an XMLHttpRequest object, so you can just use abort(). */
       ajaxRequest= $.ajax({
            url: "photoupload.php",
            type: "post",
            
            data: formData,
             cache: false,
        contentType: false,
        processData: false
        });

      /*  request cab be abort by ajaxRequest.abort() */

     ajaxRequest.done(function (response, textStatus, jqXHR){
          // show successfully for submit message
          //$("#result").html('Submitted successfully');
          $("#result").html(response);
     });

     /* On failure of request this function will be called  */
     ajaxRequest.fail(function (){
       // show error
       $("#result").html('There is error while submit');
     });
 });
        </script>
        

    </body>
</html>
