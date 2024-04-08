<!DOCTYPE html> 
<html lang="en"> 

<head> 
	<meta charset="UTF-8"> 
	<meta http-equiv="X-UA-Compatible"
		content="IE=edge"> 
	<meta name="viewport"
		content="width=device-width, 
				initial-scale=1.0"> 
	<title>Cargo</title> 
	<link rel="stylesheet"
		href="styles/style.css"> 
	<link rel="stylesheet"
		href="styles/responsive.css"> 
      
</head> 

<body> 
	
	<!-- for header part -->
	<header> 

		<div class="logosec"> 
			<div class="logo">CARGO SYSTEM</div> 
			<img src= 
"https://media.geeksforgeeks.org/wp-content/uploads/20221210182541/Untitled-design-(30).png"
				class="icn menuicn"
				id="menuicn"
				alt="menu-icon"> 
		</div> 

		<div class="searchbar"> 
			<input type="text"
				placeholder="Search"> 
			<div class="searchbtn"> 
			<img src= 
"https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
					class="icn srchicn"
					alt="search-icon"> 
			</div> 
		</div> 

		<div class="message"> 
			<div class="circle"></div> 
			<img src= 
"https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/8.png"
				class="icn"
				alt=""> 
			<div class="dp"> 
			<img src= 
"https://media.geeksforgeeks.org/wp-content/uploads/20221210180014/profile-removebg-preview.png"
					class="dpicn"
					alt="dp"> 
			</div> 
		</div> 

	</header> 
	<?php include_once "sidebar.php"; ?>
 
		<div class="main"> 

			<div class="searchbar2"> 
				<input type="text"
					name=""
					id=""
					placeholder="Search"> 
				<div class="searchbtn"> 
				<img src= 
"https://media.geeksforgeeks.org/wp-content/uploads/20221210180758/Untitled-design-(28).png"
						class="icn srchicn"
						alt="search-button"> 
				</div> 
			</div> 


            <!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

<h3>Add New Furniture</h3>

<div class="container">
  <form action="add_import.php?action=import" method="POST">
    <label for="fname">Furniture_Name</label>
    <input type="text" id="fname" name="name" placeholder="Enter the Furniture name..">

    <label for="lname">Owner_Name</label>
    <input type="text" id="lname" name="ownername" placeholder="Enter the Owner name..">


    <label for="lname">Quantity</label>
    <input type="text" id="lname" name="quantity" placeholder="Enter the quantity..">

    

    <input type="submit" name="save" value="Submit">
  </form>
</div>

</body>
</html>

<?php


include_once "conn.php";


if(isset($_POST["save"])){
    $fname = $_POST["name"];
    $own = $_POST["ownername"];
    
    $quantity = $_POST["quantity"];


    $insert = $pdo->prepare("INSERT INTO furniture(FurnitureName,FurnitureOwnerName) VALUES(?,?)");

    $insert->execute([$fname,$own]);

    $stmt = $pdo->query("SELECT FurnitureId FROM furniture ORDER BY FurnitureId DESC LIMIT 1");

    $row = $stmt->fetch();

    $id = $row["FurnitureId"];

    $insert2 = $pdo->prepare("INSERT INTO `import`( `FurnitureId`, `ImportDate`, `Quantity`) VALUES (?,current_timestamp,?)");



    $insert2->execute([$id,$quantity]);
   


    if($insert==1 and $insert2==1){

        echo "<div class='success'>Insert Success</div>";
    }

    else{
        echo "<div class='error'>Insert Failed</div>";
    }




}





?>


      
			
		</div> 
	</div> 

	<script src="./main.js"></script> 
	<script src="./jquery.js"></script> 
</body> 
</html>
