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

	<div class="main-container"> 
		<div class="navcontainer"> 
			<nav class="nav"> 
				<div class="nav-upper-options"> 
					<div class="nav-option option1"> 
						<img src= 
"https://media.geeksforgeeks.org/wp-content/uploads/20221210182148/Untitled-design-(29).png"
							class="nav-img"
							alt="dashboard"> 
						<h3> Dashboard</h3> 
					</div> 

					<div class="option2 nav-option"> 
						<img src= 
"https://media.geeksforgeeks.org/wp-content/uploads/20221210183322/9.png"
							class="nav-img"
							alt="articles"> 
						<h3> Import</h3> 
					</div> 

					<div class="nav-option option3"> 
						<img src= 
"https://media.geeksforgeeks.org/wp-content/uploads/20221210183320/5.png"
							class="nav-img"
							alt="report"> 
						<h3>Export</h3> 
					</div> 

					<div class="nav-option option4"> 
						<img src= 
"https://media.geeksforgeeks.org/wp-content/uploads/20221210183321/6.png"
							class="nav-img"
							alt="institution"> 
						<h3> Report</h3> 
					</div> 

					<div class="nav-option option5"> 
						<img src= 
"https://media.geeksforgeeks.org/wp-content/uploads/20221210183323/10.png"
							class="nav-img"
							alt="blog"> 
						<h3> Profile</h3> 
					</div> 

					<div class="nav-option option6"> 
						<img src= 
"https://media.geeksforgeeks.org/wp-content/uploads/20221210183320/4.png"
							class="nav-img"
							alt="settings"> 
						<h3> Settings</h3> 
					</div> 

					<div class="nav-option logout"> 
						<img src= 
"https://media.geeksforgeeks.org/wp-content/uploads/20221210183321/7.png"
							class="nav-img"
							alt="logout"> 
						<h3>Logout</h3> 
					</div> 

				</div> 
			</nav> 
		</div> 
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


<div class="report-container"> 
				<div class="report-header"> 
					<h1 class="recent-Articles">Current stock</h1> 
					<button class="view">View All</button> 
				</div> 
                <?php
include_once "conn.php";

// Fetch furniture data
$stmt1 = $pdo->query("SELECT * FROM furniture");
$furnitureData = $stmt1->fetchAll(PDO::FETCH_ASSOC);

?>

<div class="report-body"> 
    <div class="report-topic-heading"> 
        <h3 class="t-op">Furniture Id</h3> 
        <h3 class="t-op">Furniture Name</h3> 
        <h3 class="t-op">Quantity</h3> 
        <h3 class="t-op">Operation</h3> 
    </div> 

    <?php foreach ($furnitureData as $furniture): ?>
        <div class="report-topic-data"> 
            <h3 class="t-op"><?php echo $furniture['FurnitureId']; ?></h3> 
            <h3 class="t-op"><?php echo $furniture['FurnitureName']; ?></h3> 

            <?php
            // Fetch quantity from import table for each furniture
            $stmt = $pdo->prepare("SELECT SUM(Quantity) AS totalQuantity FROM `import` WHERE FurnitureId = ?");
            $stmt->execute([$furniture['FurnitureId']]);
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            $quantity = $row['totalQuantity'];
            ?>

            <h3 class="t-op"><?php echo $quantity; ?></h3> 
            <h3 class="t-op">
                <!-- Add operation buttons or links here -->
                <!-- For example, edit and delete buttons -->
                <button>Edit</button>
                <button>Delete</button>
            </h3> 
        </div>
    <?php endforeach; ?>
</div>



      
			
		</div> 
	</div> 

	<script src="main.js"></script> 
</body> 
</html>
