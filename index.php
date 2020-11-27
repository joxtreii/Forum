<!doctype html>
<html>
<head>
	  <title> Save The Life</title>
	  <meta charset="utf-8">
  	<meta name="viewport" content="width=device-width, initial-scale=1">
 	  <link rel="stylesheet" href="bootstrap.min.css">
    <script src="Function.js"></script>
 	  <script src="jquery.min.js"></script>
  	<script src="bootstrap.min.js"></script>
  	<style>
      html {
        scroll-behavior: smooth;
      }
  		body {
  			background: linear-gradient(#ccc,#666);
        background-size:100%;
        background-repeat: no-repeat;
        background-attachment:fixed ;
  		}
  		ul, button {
  			cursor:pointer;
  		}
  		.grey {
  			color:grey;
        font-size:10px;
  		}
  		h4{
  			font-weight:900;
  		}
      .actives {
        background:#0066ff;
        color:#fff;
      }
      #plussign, #minussign {
        text-decoration:none;
      }
      .buttdes {
        position:fixed;
        background:#04a;
        border:none;

      }
      .datedes {
        color:#444;
        font-size:10px;
      }
    </style>
</head>
<body>
	
    <div id="Top" class="jumbroton navbar navbar-default" style="position:fixed;z-index:1">
            <h2 class="container"> Save The Life </h2>
		  <div  class=" navbar">
				<ul class="nav nav-pills nav-justified">
    				<li class="active"><a data-toggle="pill" href="#home">Home</a></li>
    				<li><a data-toggle="pill" href="#menu1">Post</a></li>
    				<li><a data-toggle="pill" href="#menu2">About</a></li>
  			</ul>
  		</div>
    </div>
  	<div class="container" style="float:right">
  		<div class="tab-content">
  		 	<div id="home" class="tab-pane fade in active">

<!-- Search codename -->
              

  			    <div class="col-sm-2 well" style="margin-top:150px;margin-left:-280px;position:fixed">
  			    		
  			    		<a href="#Top"><button class="buttdes"> sira na ako </button></a>
  			    </div>
  			    <div class="col-sm-8 well" style="margin-top:150px">
  			    		<h3>Timeline</h3>
  			    		<p> Welcome, share your experience about bullying and how did you resolved this.</p>
  			    		<ul class="list-group">
  			    			<?php 	

  			    				require_once("connectserver.php");

                    $get = "SELECT * FROM bully ORDER BY ID DESC";
                    $merge = mysqli_query($connect,$get);
                    while($row = mysqli_fetch_assoc($merge)){
                      $codename = $row['codename'];
                      $message = $row['message'];
                      $dates = $row['dates'];

                       echo '<li class="list-group-item">
                            <h4>'.$codename.'</h4>
                              <p>'.$message.'</p>
                            <p>----------------------------------------</p>
                              <p class="datedes">'.$dates.'</p>
                              
                              <button class="btn" id="bplus" onclick="Plus(this)">Up </button>&nbsp;
                              <button class="btn" id="bminus" onclick="Minus(this)">Down </button>&nbsp;&nbsp; 
                              <input style="width:15px;height:15px;border:none;cursor:pointer" id="plussign" value="0" disabled> | <input style="width:15px;height:15px;border:none;cursor:pointer" id="minussign" value="0" disabled><br><br>

                              <button class="btn btn-primary" name="hello" type="button" data-toggle="collapse" data-target="#'.$message.'">&nbsp;&nbsp;&nbsp;Comments&nbsp;</button><br><br>
                              <div class="collapse" id="'.$message.'">
                                <?php include("comments.php"); ?>
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <label for="usr">Name:</label>
                                        <input type="text" name="codename" class="form-control" id="usr" placeholder="Codename" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Paper:</label>
                                        <textarea name="message" class="form-control" rows="6" id="comment" placeholder="Type here..." required></textarea><br>
                                        <input type="submit" name="share" class="btn btn-success btn-block" value="Share"/>
                                    </div>
                                </form>
                              </div>
                          </li>';
                    }

                    if(isset($_POST['share'])){
                      $codename = $_POST['codename'];
                      $message = $_POST['message'];
                      $dates = date("h:i:sa l Y/m/d");

                      $qu = "INSERT INTO bully (codename,message,dates)
                              VALUES ('".$codename."','".$message."','".$dates."')";

                      if(mysqli_query($connect, $qu)){
                          $nt = "CREATE TABLE d".$message." (
                                            ID int,
                                            codename varchar(50),
                                            message text,
                                            dates text)";
                          if(mysqli_query($connect,$nt)){


                          echo '<li class="list-group-item">
                            <h4>'.$codename.'</h4>
                              <p>'.$message.'</p>
                            <p>----------------------------------------</p>
                              <p class="datedes">'.$dates.'</p>
                              
                              <button class="btn" id="bplus" onclick="Plus(this)">Up </button>&nbsp;<button class="btn" id="bminus" onclick="Minus(this)">Down </button>&nbsp;&nbsp; <input style="width:15px;height:15px;border:none;cursor:pointer" id="plussign" value="0" disabled> | <input style="width:15px;height:15px;border:none;cursor:pointer" id="minussign" value="0" disabled><br><br>
                              <button class="btn btn-primary" name="hello" type="button" data-toggle="collapse" data-target="#'.$message.'">&nbsp;&nbsp;&nbsp;Comments&nbsp;</button><br><br>
                              <div class="collapse" id="'.$message.'">
                                <?php include("comments.php"); ?>
                                <form role="form" method="post">
                                    <div class="form-group">
                                        <label for="usr">Name:</label>
                                        <input type="text" name="codenames" class="form-control" id="usr" placeholder="Codename" required/>
                                    </div>
                                    <div class="form-group">
                                        <label for="comment">Paper:</label>
                                        <textarea name="messages" class="form-control" rows="6" id="comment" placeholder="Type here..." required></textarea><br>
                                        <input type="submit" name="shares" class="btn btn-success btn-block" value="Share"/>
                                    </div>
                                </form>
                              </div><br><br>
                          </li>';
                          } else {
                            echo 'can\'t transfer to comment';
                          }
                      }else {
                        echo 'can\'t transfer to post';
                      }
                    }else {
                      echo "Next Share";
                    }


  			    		?>
  							<li class="list-group-item">
  								<h4>TrueFriend</h4>
  			    				<p> Hello! ako si TrueFriend ako ay mabait na tao pero lagi nila akong inaasar kinukuhaan ng gamit kaya nakakawalang gana makipagkaibigan.</p>
  			    				
  			    				<button class="btn" class="bplus" onclick="Plus(this)">Up </button>&nbsp;<button class="btn" class="bminus" onclick="Minus(this)">Down </button>&nbsp;&nbsp; <input style="width:15px;height:15px;border:none;cursor:pointer" id="plussign" value="0" disabled> | <input style="width:15px;height:15px;border:none;cursor:pointer" id="minussign" value="0" disabled><br><br>
  			    				<button class="btn btn-primary" name="hello" type="button" data-toggle="collapse" data-target="#commenting">&nbsp;&nbsp;&nbsp;Comments&nbsp;</button><br><br>
  			    				<div class="collapse" id="commenting">
  			    					<div class="well">
  			    						<h4> AdviserMo20 </h4>
  			    						<p>Lumaban ka para alam nilang dapat ka din galangin.</p>
  			    					</div>
  			    					<div class="well">
  			    							<h4> TrioTagaPayo </h4>
  			    							<p>Isumbong mo nalang.</p>
  			    					</div>
                      <?php
                          include("connectserver.php");

  $dates = date("h:ia l Y/m/d");

  if(isset($_POST['shares'])){
      $codenames = $_POST['codenames'];
      $messages = $_POST['messages'];
      date_default_timezone_set("Asia/Manila");
      $dates = date("h:ia l Y/m/d");

      $qu = "INSERT INTO d".$dates." (codename,message,dates)
                              VALUES ('".$codenames."','".$messages."','".$dates."')";

      if(mysqli_query($connectcom, $qu)){
          echo '<div class="well">
                          <h4>'.$codenames.'</h4>
                          <p>'.$messages.'</p>
                          <p class="grey">'.$dates.'</p>
                </div>';
      }
  }

    $do = "SELECT * FROM bully";
    $group = mysqli_query($connect,$do);
    while($ww = mysqli_fetch_assoc($group)){

          $message = $ww['message'];
          
                $get = "SELECT * FROM d".$message;
                    $merges = mysqli_query($connectcom,$get);
                    while($row = mysqli_fetch_assoc($merges)){
                      $codenames = $row['codenames'];
                      $messages = $row['messages'];
                      $dates = $row['dates'];

                      echo '<div class="well">
                          <h4>'.$codenames.'</h4>
                          <p>'.$messages.'</p>
                          <p class="grey">'.$dates.'</p>
                      </div>';
                    }
    } 
                      ?>
                      <form role="form" method="post">
                          <div class="form-group">
                              <label for="usr">Name:</label>
                              <input type="text" name="codenamesz" class="form-control" id="usr" placeholder="Codename" required/>
                          </div>
                          <div class="form-group">
                              <label for="comment">Paper:</label>
                              <textarea name="messages" class="form-control" rows="6" id="comment" placeholder="Type here..." required></textarea><br>
                              <input type="submit" name="shares" onclick="function(){window.location.assign('index.php');}" class="btn btn-success btn-block" value="Share"/>
                          </div>
                      </form>
  			    				</div>
  							</li>
						</ul>
  			    </div>
  			</div>

<!-- Next Page -->

  			<div id="menu1" class="tab-pane fade">
  			    	<div class="col-sm-1 container" style="margin-top:150px">
  			    		<img src="backPost.jpg" class="img-thumbnail" alt="Cinque Terre" width="auto" height="auto">
  			    	</div>
<!-- Make a new post -->

  			    	<div class="col-sm-9 well" style="margin-top:150px">
  			    		<form role="form" method="post">
  			    			<div class="form-group">
 								<label for="usr">Name:</label>
  								<input type="text" name="codename" class="form-control" id="usr" placeholder="Codename" required/>
							</div>
							<div class="form-group">
 								<label for="comment">Paper:</label>
  								<textarea name="message" class="form-control" rows="6" id="comment" placeholder="Type here..." required></textarea><br>
  								<input type="submit" name="share" class="btn btn-success btn-block" value="Share"/>
							</div>
  			    		</form>
  			    		
  			    	</div>			
  			</div>
        <div id="menu2" class="tab-pane fade">
            <p> Helloooooooooo everyone.</p>

        </div>
  		</div>
  	</div>
</body>
</html>