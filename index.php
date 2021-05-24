<?php

require_once ("../sxr190067_Prj1/crud.php");

?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<meta name="description" content="Sql Contact List WebApp">
	<meta name="author" content="Srivastchavan">
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">
</head>
	<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
		<a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Company name</a>
		<button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
				<a class="nav-link" href="#">Sign out</a>
			</li>
		</ul>
	</nav>
	
	<div class="container-fluid">
	<main role="main" class="col-md-9 ml-sm-auto col-lg-12">
      <div class="d-flex justify-content-center flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Dashboard</h1>
        
      </div>
	
	<h2>Section title</h2>
      <div class="table-responsive">
        <table class="table table-dark table-sm">
	
  <thead>
    <tr>
	  <th scope="col">ID</th>
	  <th scope="col">Fname</th>
      <th scope="col">Mname</th>
      <th scope="col">Lname</th>
      <th scope="col">Birthday</th>
      
      <th scope="col">Home Phone</th>
      <th scope="col">Cell Phone</th>
	  <th scope="col">Work Phone</th>
	  
      <th scope="col">Home Address</th>
      <th scope="col">Home City</th>
      <th scope="col">Home State</th>
      <th scope="col">Home Zip</th>
      
      <th scope="col">Work Address</th>
      <th scope="col">Work City</th>
      <th scope="col">Work State</th>
      <th scope="col">Work Zip</th>
      <th scope="col">Edit</th>
    </tr>
  </thead>
  <tbody id="tbody">    
                <?php

                    //read button clicked
                   if(isset($_POST['read'])){
                       $result = getData();

                       if($result){

                           while ($row = mysqli_fetch_assoc($result)){ ?>

                               <tr>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['contact_id']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['first_name']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['middle_name']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['last_name']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['birth_date']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['home_phone']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['cell_phone']; ?></td>
								   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['work_phone']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['home_address']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['home_city']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['home_state']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['home_zip']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['work_address']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['work_city']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['work_state']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['work_zip']; ?></td>
								   <td></td>
                               </tr>

                   <?php
                        }

                       }
                   }


                   ?>
                   <?php

                    //search button clicked
                   if(isset($_POST['Esearch'])){
                    
                       $result_search = getSearchData();

                       if($result_search){
                        
                           while ($row = mysqli_fetch_assoc($result_search)){ ?>

                               <tr>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['contact_id']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['first_name']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['middle_name']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['last_name']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['birth_date']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['anni_date']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['home_phone']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['cell_phone']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['home_address']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['home_city']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['home_state']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['home_zip']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['work_phone']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['work_address']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['work_city']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['work_state']; ?></td>
                                   <td data-id="<?php echo $row['contact_id']; ?>"><?php echo $row['work_zip']; ?></td>
                                   <td ><i class="fas fa-edit btnedit" data-id="<?php echo $row['contact_id']; ?>"></i></td>
                               </tr>

                   <?php
                       }
                          
                       }
                   }
                     ?>
                </tbody>
</table>
  

<body>
</body>

</html>