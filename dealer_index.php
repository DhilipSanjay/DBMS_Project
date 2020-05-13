<?php

session_start();

if(!isset($_SESSION['logged_in'])) //user not logged in
{
    header('location:index.php');
}

include("dbconnect.php");

$dealerid = $_SESSION['userid']; //getting the dealer id
$dealername = $_SESSION['username'];

//first query to select all the cars that the dealer owns
$query1 = "select car.carid,dealerid from car inner join owns where owns.carid=car.carid and dealerid = $dealerid order by uploadedtime desc";
$result1 = mysqli_query($conn,$query1);

?>

<!DOCTYPE html>
<html>
<head>
<title><?php echo $dealername."'s " ?> Dashboard - Rustom</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="UTF-8">
<link rel="icon" href="icon.ico">
<!--Google Fonts-->
    
<!--BOOTSTRAP CDN-->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<link rel="stylesheet" href="dealerstyles.css">

<!--<script src="https://kit.fontawesome.com/yourcode.js"></script>-->

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

</head>
<style>

form.example input[type=text] {
  padding: 10px;
  font-size: 17px;
  border: 1px solid darkblue;
  float: left;
  width: 80%;
  background: #f1f1f1;

}

form.example button {
  float: left;
  width: 20%;
  padding: 10px;
  background: #2196F3;
  color: white;
  font-size: 17px;
  border: 1px solid darkblue;
  border-left: none;
  cursor: pointer;
}

form.example button:hover {
  background: #0b7dda;
}

form.example::after {
  content: "";
  clear: both;
  display: table;
}

.open-button {
  background-color: #2196F3;
  border: 1px solid darkblue;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  width: 220px;
}


.bg-modal {
    background-color: rgba(0, 0, 0, 0.8);
    width: 100%;
    height: 100%;
    position: fixed;
    top: 0;
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 50;
}

.modal-contents {
    height: 350px;
    width: 800px;
    padding: 50px;
    background-color:white;
    text-align: center;
    position: relative;
    border-radius: 4px;
}



.close {
    position: absolute;
    top: 0;
    right: 10px;
    font-size: 42px;
    color: #333;
    transform: rotate(45deg);
    cursor: pointer;
}

.close:hover {
        color: #666;
    }

.button {
    background-color: #2196F3;
    border: 2px solid white;
    border-radius: 30px;
    text-decoration: none;
    padding: 10px 28px;
    color: white;
    float: right;
    margin-top: 10px;
    display: inline-block;
}

.button:hover {
      text-decoration: none;
        background-color: white;
        color: #2196F3;
        border: 2px solid #2196F3;
    }

.column {
  float: left;
  width: 33.33%;
  padding: 5px;
}




#listicon
{
    position:absolute;
    left:20px;
    margin-top:1px;
    cursor:pointer;
}


#title
{
    font-family: 'Open Sans', sans-serif;
    margin:auto;
    margin-bottom:0.5px;
    text-align:center;   
    font-weight:300;
    font-size:1.5rem;
}

#header #logout
{
    position:absolute;
    right:20px;
    cursor:pointer;
}

#list
{
    position:fixed;
    top:0;
    height:100%;
    z-index:20;
    left:0;
    background-color:#C39BD3;
    width:0;
    overflow:hidden;
    display:flex;
    flex-direction:column;
    align-items:center;
    justify-content:center;
    transition:width 0.15s ease-in-out;
}

#list a
{
    font-weight:350;
    text-align:center;
    color:white;
    font-size:1.5rem;
    margin:5px 0;
    transition:color 0.15s ease-in-out;
}

#list #active
{
    cursor:default;
    color:#76448A;
}

#list a:hover
{
    color:#76448A;
    text-decoration:none;
}

#list #closelist
{
    cursor:pointer;
    background-color:#76448A;
    width:fit-content;
    position:absolute;
    top:10px;
    padding:5px;
    display:flex;
    align-items:center;
    right:10px;
}




@media screen and (max-width:1000px)
{

#carname
{
  font-size:40px;
}

}

@media screen and (max-width:769px)
{
    #explore
    {
        text-align:center;
        padding:20px 0;
        border-bottom:1px solid #C39BD3;
    }

    .card
    {
      padding-bottom:15px;
    }

    .carousel-inner,.carousel-inner img
    {
      height:320px;
    }
}

</style>




<body>


<div id="list">
<div id="closelist" onclick="openlist()">
<svg class="bi bi-chevron-left" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M11.354 1.646a.5.5 0 010 .708L5.707 8l5.647 5.646a.5.5 0 01-.708.708l-6-6a.5.5 0 010-.708l6-6a.5.5 0 01.708 0z" clip-rule="evenodd"/>
</svg>
</div>

<a id="active">Home</a>
<a href="#">Profile</a>
<!--<a href="#">My Purchases</a>
<a href="#">Rented cars</a>-->

</div>

<div class="container-fluid text-white py-3" id="header" style="background-color:black;position:fixed;z-index:5;top:0;display:flex;align-items:center">

<div id="listicon" onclick="openlist()">
<svg class="bi bi-list" width="2em" height="2em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" d="M2.5 11.5A.5.5 0 013 11h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 7h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5zm0-4A.5.5 0 013 3h10a.5.5 0 010 1H3a.5.5 0 01-.5-.5z" clip-rule="evenodd"/>
</svg>
</div>

<a id="logout" href="logout.php">
<svg class="bi bi-x-square" width="1.5em" height="1.5em" viewBox="0 0 16 16" fill="white" xmlns="http://www.w3.org/2000/svg">
  <path fill-rule="evenodd" d="M14 1H2a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V2a1 1 0 00-1-1zM2 0a2 2 0 00-2 2v12a2 2 0 002 2h12a2 2 0 002-2V2a2 2 0 00-2-2H2z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M11.854 4.146a.5.5 0 010 .708l-7 7a.5.5 0 01-.708-.708l7-7a.5.5 0 01.708 0z" clip-rule="evenodd"/>
  <path fill-rule="evenodd" d="M4.146 4.146a.5.5 0 000 .708l7 7a.5.5 0 00.708-.708l-7-7a.5.5 0 00-.708 0z" clip-rule="evenodd"/>
</svg>
</a>


<img src="logow.png" height="50px" style="margin:auto">

</div>




<!-- this is the add entry modal -->

<div class="bg-modal">
    <div class="modal-contents">

        <div class="close">+</div>
        <br>
        
        <div class="row">
            <div class="column">
            <a href="new_form.php">
            <img src="car2.jpg" style="width:100%;height: 85%;margin-bottom:5px">
            <h4>New Car</h4>
            </a>
          </div>

          <div class="column">
            <a href="resale_form.php">
            <img src="car1.jpg" style="width:100%;height: 85%;margin-bottom:5px">
            <h4>Pre-Owned Car</h4>
            </a>
          </div>
          
          <div class="column">
            <a href="rental_from.php">
            <img src="car3.jpg" style="width:100%;height: 85%;margin-bottom:5px">
            <h4>Rental Car</h4>
            </a>
          </div>

        </div>

        

    </div>
</div>



<div class="container py-3">

  <!-- 
  
  search bar hidden for now 
  <form class="example" action="/action_page.php">
  <input type="text" placeholder="Search.." name="search">
  <button type="submit"><i class="fa fa-search"></i></button>
  </form>

--> 

<div class="container" style="width:80%;margin:auto;margin-top:135px;margin-bottom:35px">

<h2 id="carname" class="display-4 text-center"><?php echo "Welcome ".$dealername."!" ?></h2>
</div>

<?php 

if(isset($_SESSION['newcaradded'])&&$_SESSION['newcaradded']===true)
{

?>

<div class="alert alert-info alert-dismissible fade show" role="alert">
New Car has been added!
</div>

<?php 
unset($_SESSION['newcaradded']); //destroying the session variable
}

if(isset($_SESSION['deletedcar'])&&$_SESSION['deletedcar']===true)
{
?>

<div class="alert alert-danger" role="alert">
Car has been deleted!
</div>


<?php 
unset($_SESSION['deletedcar']); //destroying the session variable
}
?>

<h3 id="explore" style="font-weight:lighter;padding:20px 0;border-bottom:1px solid #C39BD3;border-width:90%">My Cars</h3>

    <a href="#" id="button" class="button">Add Entry</a>


<div class="container" style="display:flex;flex-direction:column;align-items:center">
  <?php 
  
  
  while($row= mysqli_fetch_assoc($result1))
  {

  //query to get all car details
  $mainquery = "select carid,name,status,cartype from car where carid=".$row["carid"];
  $mainresult = mysqli_query($conn,$mainquery);
  $cardet = mysqli_fetch_assoc($mainresult);
  
    
  ?>
  <!-- Card Start -->




  <div style="float: left;" class="card">
    <div class="row ">
    
    <div class="col-md-5">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">

                <!--<ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>-->

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block w-100" src="car1.jpg" height="275px" alt="First slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="car2.jpg" height="275px"  alt="Second slide">
                </div>
                <div class="carousel-item">
                    <img class="d-block w-100" src="car3.jpg" height="275px"  alt="Third slide">
                </div>
            </div>


            <!--<a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>-->


            </div>
      </div>

      <div class="col-md-7 px-3">
        <div class="card-block px-6">
    
          <div class="pull-right" >   

                <div style="float:right!important;" class="btn-group"> 

                         <button class="btn btn-success"> 
                            Options 
                        </button> 
                        <button class="btn btn-success dropdown-toggle" 
                                data-toggle="dropdown"> 
                            <span class="caret"></span> 
                        </button> 
                        <ul class="dropdown-menu" style="padding:10px"> 
                            <!--<li> 
                                <a href="#">Edit</a> 
                            </li> -->
                            <li> 
                                <a href="<?php echo "deletedealercar.php?carid=".$cardet["carid"]."&cartype=".$cardet["cartype"] ?>">Delete</a> 
                            </li> 
                        </ul> 
                </div> 
                
          
          
                    
            </div> 
            <h4 class="card-title" style="height:35px;margin-top:2.5px;width:60%;overflow:hidden;white-space:nowrap;text-overflow:ellipsis"><?php echo $cardet["name"]?></h4>
            <hr style="margin-top:10px;min-width:90%">
           <div style="float:left"> 
           <p class="card-text">
            <b>Car Type - </b> <?php echo $cardet["cartype"];?>
          </p>

          <p class="card-text">
            <b>Availability - </b> <?php echo $cardet["status"];?>
          </p>

          
          <p class="card-text">
          <?php if ($cardet["cartype"]==="new")
          {
          ?>

            <a href="<?php echo "newcar.php?carid=".$cardet["carid"] ?>">More details</a>

          <?php 
          }

          else if($cardet["cartype"]==="resale")
          {
          ?>

            <a href="<?php echo "resalecar.php?carid=".$cardet["carid"] ?>">More details</a>

          <?php 
          }
           
          else
          {
          ?>
            <a href="<?php echo "rentalcar.php?carid=".$cardet["carid"] ?>">More details</a>
          <?php
          }

          ?>
          </p>
          

          <!--<p class="card-text">Made for usage, commonly searched for. Fork, like and use it. 
            Just move the carousel div above the col containing the text for left alignment of images
          </p>-->
          
          
      </div>
        </div>
      </div>
    
    </div>
  </div>

  <?php
  }
  ?>

</div>
  <!-- End of card -->



</div>



</body>

<script>

document.getElementById('button').addEventListener("click", function() {
    document.querySelector('.bg-modal').style.display = "flex";
});

document.querySelector('.close').addEventListener("click", function() {
    document.querySelector('.bg-modal').style.display = "none";
});

</script>

<script type="text/javascript" src="JS/list.js"></script>

</html>