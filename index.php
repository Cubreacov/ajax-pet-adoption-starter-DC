<!doctype html>
<html>
<head>
 
   <meta name="robots" content="noindex,nofollow">
   <title>AJAX Pet Adoption Agency</title>
   <style>
       @import url('https://fonts.googleapis.com/css2?family=Balsamiq+Sans&family=Fredoka+One&display=swap');
      
       #myForm div{
        margin-bottom:2%;
        }  

        .petName {
          background-color: pink;
          font-size: 20px;
          
        }
     
   </style>
   <script src="https://code.jquery.com/jquery-latest.js"></script>
</head>
<body>
<h2>AJAX Pet Adoption Agency</h2>
<div id="output">
<p>This page  demonstrates a way to use jQuery AJAX to build a form for pet adoption. With AJAX to a server side page, jQuery library processes and transmits the data. This program takes data that the user inputs by clicking on the buttons as well as writing in the text box. After user submits data the page shows a picture of their pet they have chosen  with a picture and description or instructions of how to take care of their pet.</p>
<p>Make some choices and reveal your pet!</p>
<p>Choose below to pick a pet:</p>
<form id="myForm" action="" method="get">
   <div id="pet_feels">
       <h3>Feels</h3>
       <p>Please choose how you would like your pet to feel:</p>
       <input type="radio" name="feels" value="fluffy" required="required">fluffy <br />
       <input type="radio" name="feels" value="scaly">scaly <br />
   </div>
   <div id="pet_likes">
       <h3>Likes</h3>
       <p>Please tell us what your pet will like:</p>
       <input type="radio" name="likes" value="petted" required="required">to be petted <br />
       <input type="radio" name="likes" value="ridden">to be ridden <br />
   </div>
    <div id="pet_eats">
       <h3>Eats</h3>
       <p>Please tell us what your pet likes to eat:</p>
       <input type="radio" name="eats" value="carrots" required="required">carrots <br />
       <input type="radio" name="eats" value="pets">other people's pets <br />
   </div>
   <div id="pet_name">
       <h3>Name</h3>
       <p>Please name your pet:</p>
       <input type="text" name="petName" placeholder="Name" required="required" />
   </div>
  
   <div><input type="submit" value="submit it!" /></div>
</form>
</div>
<p><a href="index.php">RESET</a></p>
<script>
    //titleCase function
    function titleCase(str){
      str = str.toLowerCase().split(' ');
      for (var i = 0; i < str.length; i++) {
        str[i] = str[i].charAt(0).toUpperCase() + str[i].slice(1);
      }
      return str.join(' ');
    };
  
    $("document").ready(function(){
        
        //hide likes and eats
        $('#pet_likes').hide();
        $('#pet_eats').hide();
        $('#pet_name').hide();
      
        //click feels and show likes
        $('#pet_feels').click(function(e){
          $('#pet_likes').slideDown(200);
        });
        //click likes and show eats
        $('#pet_likes').click(function(e){
          $('#pet_eats').slideDown(200);
        });
        //click eats and show name
        $('#pet_eats').click(function(e){
          $('#pet_name').slideDown(200);
        });
               
        $('#myForm').submit(function(e){ //.submit is an event handler, just like .click
            e.preventDefault();//no need to submit as you'll be doing AJAX on this page
            let feels = $("input[name=feels]:checked").val();
            let likes = $("input[name=likes]:checked").val();
            let eats = $("input[name=eats]:checked").val();
            let petName = $("input[name=petName]:contains()").val()
            let pet = "ERROR";
            var output = ""; //a string that will capture all the information from AJAX page and from the form


            if(feels=="fluffy" && likes== "petted" && eats=="carrots"){
              pet ="rabbit";
            }
            if(feels=="scaly" && likes== "ridden" && eats=="pets"){
              pet ="velociraptor";
            }
            if(feels=="fluffy" && likes== "ridden" && eats=="pets"){
              pet ="greyhound";
            }
            if(feels=="fluffy" && likes== "petted" && eats=="pets"){
              pet ="pom";
            }
            if(feels=="fluffy" && likes== "ridden" && eats=="carrots"){
              pet ="hedgehog";
            }
            if(feels=="scaly" && likes== "ridden" && eats=="pets"){
              pet ="pig";
            }
            if(feels=="scaly" && likes== "petted" && eats=="pets"){
              pet ="lab";
            }
            if(feels=="scaly" && likes== "ridden" && eats=="carrots"){
              pet ="bird";
            }
            if(feels=="scaly" && likes== "petted" && eats=="carrots"){
              pet ="dane";
            }
            //this titleCases the output of the name of the pet that               the user inputted.
            petName = titleCase(petName);
            //the span class is created here, so that we can refer to it in the <style> tag for css
            output += `<p>Congrats, you have a ${pet} as a pet.Your pet's name is <span class="petName">${petName}</span>. ${petName} feels ${feels} and likes to be ${likes}.He loves all kinds of food that a ${pet} eats, especially ${eats}</p> 
            <p>Take good care of your pet!</p>`


            //alert(feels);
            
            $.get( "includes/get_pet.php", { critter: pet } )
               .done(function( data ) {
                 //alert( "Data Loaded: " + data );
                 
                 //output submitted info and replace form
                 $('#output').html(data + output);
                 
               })
              .fail(function(xhr, status, error) {
               //Ajax request failed.
               var errorMessage = xhr.status + ': ' + xhr.statusText
               alert('Error - ' + errorMessage); //404 is "file not found"
               });
                       
        });
    });
   </script>
</body>
</html>
