<?php 
require "./vendor/gump.class.php";
// require "./utils/imageupload.class.php";

// var_dump($_FILES);
// var_dump($_POST);
// echo $_FILES['f_file']['name']; 

$validator = new GUMP();

// Set the data
$postData = array(
  'newsletter' => $_POST['f_newsletter'],
);

// $files = array(
//   'file' => $_FILES['f_file'],
// ); 

// // You don't have to sanitize, but it's safest to do so.
$postData = $validator->sanitize($postData); 
// $postData = $validator->sanitize(array_merge($postData,$files)); 


// Let's define the rules and filters
$rules = array(
  // 'email' => 'required|valid_email',
  // 'file' => 'required_file|extension,png;jpg'
);

$filters = array(
  'newsletter' => 'trim',
);

$postData = $validator->filter($postData, $filters);

// You can run filter() or validate() first
$validated = $validator->validate(
  $postData, $rules
);

// Check if validation was successful
if($validated === TRUE) {
  echo "Successful Validation\n\n";
  // print_r($postData); // You can now use POST data safely
  // echo $postData['newsletter'];
    
  // todo:
  // $postData['newsletter'] = explode(",", $postData['newsletter']);
  // print_r($postData['newsletter']);
  // exit;  

} else {
  echo "invalid"; 
  print_r($postData); 
    
  print_r($validated); // Shows all the rules that failed along with the data
}

// insert...

?>