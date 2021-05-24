<?php

	$dbhost = "localhost";
	$dbuser = "root"; 
	$dbpass = "root";  
	$dbname = "contactsdb";   
	                      
	$con = new mysqli($dbhost, $dbuser, $dbpass, $dbname) ;
     if (!$con){
        die("Connection Failed : " . mysqli_connect_error());
    }
    return $con;


// create button click
if(isset($_POST['create'])){
    createData();
}
// update button click
if(isset($_POST['update'])){
    UpdateData();
}
// delete button clicked from edit option in table for 1 entry delte
if(isset($_POST['delete'])){
    deleteRecord();
}
// delete button click for delete all
if(isset($_POST['deleteall'])){
    deleteAll();

}


// get data from mysql database
function getData(){
    $sql1 = "SELECT C.contact_id,
					C.first_name,
					C.middle_name,
					C.last_name,
					H.address as home_address,
					H.city as home_city,
					H.state as home_state,
					H.zip as home_zip,
					W.address as work_address,
					W.city as work_city,
					W.state as work_state,
					W.zip as work_zip,
					P.number as home_phone,
					M.number as cell_phone,
					O.number as work_phone,
					D.date as birth_date
					FROM CONTACT C INNER JOIN ADDRESS H ON C.contact_id=H.contact_id and H.Address_Type='Home'
								   INNER JOIN ADDRESS W ON C.contact_id=W.contact_id and W.Address_Type='Work'
								   INNER JOIN PHONE P ON C.contact_id=P.contact_id and P.Phone_Type='Home'
								   INNER JOIN PHONE M ON C.contact_id=M.contact_id and M.Phone_Type='Cell'
								   INNER JOIN PHONE O ON C.contact_id=O.contact_id and O.Phone_Type='Work'
					               INNER JOIN DATE D ON C.contact_id=D.contact_id";
    $result1 = mysqli_query($GLOBALS['con'], $sql1);

    if(mysqli_num_rows($result1) > 0){
        return $result1;
    }
}
// get search table data for matches
function getSearchData(){
    $search = textboxValue("data_search");
   
   $query = " SELECT C.contact_id,
					C.first_name,
					C.middle_name,
					C.last_name,
					H.address as home_address,
					H.city as home_city,
					H.state as home_state,
					H.zip as home_zip,
					W.address as work_address,
					W.city as work_city,
					W.state as work_state,
					W.zip as work_zip,
					P.number as home_phone,
					M.number as cell_phone,
					O.number as work_phone,
					D.date as birth_date
					FROM CONTACT C INNER JOIN ADDRESS H ON C.contact_id=H.contact_id and H.Address_Type='Home'
								   INNER JOIN ADDRESS W ON C.contact_id=W.contact_id and W.Address_Type='Work'
								   INNER JOIN PHONE P ON C.contact_id=P.contact_id and P.Phone_Type='Home'
								   INNER JOIN PHONE M ON C.contact_id=M.contact_id and M.Phone_Type='Cell'
								   INNER JOIN PHONE O ON C.contact_id=O.contact_id and O.Phone_Type='Work'
					               INNER JOIN DATE D ON C.contact_id=D.contact_id
								   WHERE C.first_name LIKE '%" . $search ."%' 
									  OR C.middle_name LIKE '%" . $search ."%' 
									  OR C.last_name LIKE '%" . $search ."%' 
									  OR D.date LIKE '%" . $search ."%' 
									  OR P.number LIKE '%" . $search ."%' 
									  OR M.number LIKE '%" . $search ."%'  
									  OR O.number LIKE '%" . $search ."%' 
									  OR H.address LIKE '%" . $search ."%' 
									  OR H.city LIKE '%" . $search ."%'  
									  OR H.state LIKE '%" . $search ."%' 
									  OR H.zip LIKE '%" . $search ."%' 
									  OR W.address LIKE '%" . $search ."%' 
									  OR W.city LIKE '%" . $search ."%' 
									  OR W.state LIKE '%" . $search ."%' 
									  OR W.zip LIKE '%" . $search ."%'"; 
   


$result2=mysqli_query($GLOBALS['con'], $query);

  if(mysqli_num_rows($result2) > 0)
  { 
    
     return $result2;
}
}




function createData(){
    $contact_id = textboxValue("contact_id");
    $first_name = textboxValue("first_name");
    $middle_name = textboxValue("middle_name");
    $last_name = textboxValue("last_name");
    $birth_date = textboxValue("birth_date");
    $anni_date = textboxValue("anni_date");
    $home_phone = textboxValue("home_phone");
    $cell_phone = textboxValue("cell_phone");
    $home_address = textboxValue("home_address");
    $home_city = textboxValue("home_city");
    $home_state = textboxValue("home_state");
    $home_zip = textboxValue("home_zip");
    $work_phone = textboxValue("work_phone");
    $work_address = textboxValue("work_address");
    $work_city = textboxValue("work_city");
    $work_state = textboxValue("work_state");
    $work_zip = textboxValue("work_zip");
    
     if($first_name || $middle_name || $last_name ||$birth_date || $anni_date ||$home_phone || $cell_phone || $work_phone ||$home_address || $home_city || $home_state || $home_zip || $work_address || $work_city || $work_state || $work_zip){
        $sql1 = "INSERT INTO CONTACT (first_name, middle_name, last_name) 
                        VALUES ('$first_name','$middle_name','$last_name')";
        $execute=mysqli_query($GLOBALS['con'], $sql1);
  
 
        $sql2 = "INSERT INTO DATES (contact_id,birth_date, anni_date) 
                        VALUES ('$contact_id','$birth_date','$anni_date')";
         
        $execute2=mysqli_query($GLOBALS['con'], $sql2);
   
        $sql3 = "INSERT INTO PHONE (contact_id,home_phone, cell_phone, work_phone) 
                        VALUES ('$contact_id','$home_phone','$cell_phone','$work_phone')";
        $execute3=mysqli_query($GLOBALS['con'], $sql3);
    

        $sql4 = "INSERT INTO ADDRESS (contact_id,home_address, home_city, home_state, home_zip, work_address, work_city, work_state, work_zip) 
        VALUES ('$contact_id','$home_address','$home_city','$home_state','$home_zip','$work_address','$work_city','$work_state','$work_zip')";
            $execute4=mysqli_query($GLOBALS['con'], $sql4);
  

}
else{
           TextNode("error", "Provide Data in the Textbox");
    }

}

function textboxValue($value){
    $textbox = mysqli_real_escape_string($GLOBALS['con'], trim($_POST[$value]));
    if(empty($textbox)){
            return false;
    }else{
        return $textbox;
        
    }
}


// messages for alerts
function TextNode($classname, $msg){
    $element = "<h6 class='$classname'>$msg</h6>";
    echo $element;
}


// update data
function UpdateData(){
    $contact_id = textboxValue("contact_id");
    $first_name = textboxValue("first_name");
    $middle_name = textboxValue("middle_name");
    $last_name = textboxValue("last_name");
    $birth_date = textboxValue("birth_date");
    $anni_date = textboxValue("anni_date");
    $home_phone = textboxValue("home_phone");
    $cell_phone = textboxValue("cell_phone");
    $home_address = textboxValue("home_address");
    $home_city = textboxValue("home_city");
    $home_state = textboxValue("home_state");
    $home_zip = textboxValue("home_zip");
    $work_phone = textboxValue("work_phone");
    $work_address = textboxValue("work_address");
    $work_city = textboxValue("work_city");
    $work_state = textboxValue("work_state");
    $work_zip = textboxValue("work_zip");

   if($first_name || $middle_name || $last_name ||$birth_date || $anni_date ||$home_phone || $cell_phone || $work_phone ||$home_address || $home_city || $home_state || $home_zip || $work_address || $work_city || $work_state || $work_zip){
        $sql1 = "
                UPDATE CONTACT SET first_name='$first_name', middle_name='$middle_name', last_name='$last_name' WHERE contact_id='$contact_id'";
    
        $execute=mysqli_query($GLOBALS['con'], $sql1); 
        $sql2 = "UPDATE DATES SET birth_date='$birth_date', anni_date='$anni_date' WHERE contact_id='$contact_id' ";
    
        $execute2=mysqli_query($GLOBALS['con'], $sql2);
    
        $sql3 = " UPDATE PHONE SET  home_phone='$home_phone', cell_phone='$cell_phone', work_phone='$work_phone' WHERE contact_id='$contact_id'";
     
    
        $execute3=mysqli_query($GLOBALS['con'], $sql3);
    
        $sql4 = "UPDATE ADDRESS SET home_address='$home_address', home_city='$home_city', home_state='$home_state', home_zip='$home_zip', work_address='$work_address', work_city='$work_city', work_state='$work_state', work_zip='$work_zip' WHERE contact_id='$contact_id'";
    
        $execute4=mysqli_query($GLOBALS['con'], $sql4);
   
}
else{
           TextNode("error", "Provide Data in the Textbox");
    }
   }


function deleteRecord(){
    $contact_id = textboxValue("contact_id");

    
    $sql2 = "DELETE FROM ADDRESS WHERE contact_id=$contact_id";
    $sql3 = "DELETE FROM PHONE WHERE contact_id=$contact_id";
    $sql4 = "DELETE FROM DATES WHERE contact_id=$contact_id";
    $sql1 = "DELETE FROM CONTACT WHERE contact_id=$contact_id";

    if((mysqli_query($GLOBALS['con'], $sql1))|| (mysqli_query($GLOBALS['con'], $sql2)) ||(mysqli_query($GLOBALS['con'], $sql3)) || (mysqli_query($GLOBALS['con'], $sql4))){
        TextNode("success","Record Deleted Successfully...!");
    }else{
        TextNode("error","Unable to Delete Record...!");
    }

}


function deleteBtn(){
    $result = getData();
    $i = 0;
    if($result){
        while ($row = mysqli_fetch_assoc($result)){
            $i++;
            if($i > 1){
                buttonElement("btn-deleteall", "btn btn-danger" ,"<i class='fas fa-trash'></i> Delete All", "deleteall", "");
                return;
            }
        }
    }
}


function deleteAll(){
    
    $sql2 = "TRUNCATE TABLE ADDRESS";
     $execute2=mysqli_query($GLOBALS['con'], $sql2); 
    $sql3 = "TRUNCATE TABLE PHONE";
     $execute3=mysqli_query($GLOBALS['con'], $sql3); 
    $sql4 = "TRUNCATE TABLE DATES";
     $execute4=mysqli_query($GLOBALS['con'], $sql4); 
    $sql5 = "SET FOREIGN_KEY_CHECKS=0;";
     $execute5=mysqli_query($GLOBALS['con'], $sql5);
    $sql1 = "TRUNCATE TABLE CONTACT";
     $execute=mysqli_query($GLOBALS['con'], $sql1); 

    if(( $execute >=1)&&( $execute2 >=1)&&( $execute3 >=1)&&( $execute4 >=1)){
        TextNode("success","All Record deleted Successfully...!");
        $sql6 = "SET FOREIGN_KEY_CHECKS=1;";
        $execute6=mysqli_query($GLOBALS['con'], $sql6);
        createconnection();
    }else{
        TextNode("error","Something Went Wrong Record cannot deleted...!");
    }
}
 
function setID(){
    $getid = getData();
    $id = 0;
    if($getid){
        while ($row = mysqli_fetch_assoc($getid)){
            $id = $row['contact_id'];
        }
    }
    return ($id + 1);
}

?>