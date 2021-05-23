<?php
$method = $_SERVER["REQUEST_METHOD"];
include('./class/Student.php');
$student = new Student();
switch($method) {
  case 'GET':
    if (isset($_GET['id']))
    {
      $id = $_GET['id'];
      $student = $student->find($id);
      $js_encode = json_encode(array('state'=>TRUE, 'student'=>$student),true);
    }
    else
    {
      $students = $student->all();
      $js_encode = json_encode(array('state'=>TRUE, 'students'=>$students),true);
    }
    header("Content-Type: application/json");
    echo($js_encode);
    break;
  case 'POST':
    $body = file_get_contents("php://input");
    $js_decoded = json_decode($body, true);
    $student = new Student();
    $student->_name = $js_decoded["_name"];
    $student->_surname = $js_decoded["_surname"];
    $student->_sidiCode = $js_decoded["_sidiCode"];
    $student->_taxCode = $js_decoded["_taxCode"];
    $student->addStudent($student);
    $js_encode = json_encode(array('state'=>TRUE, 'student'=>$student),true);
    header("Content-Type: application/json");
    echo($js_encode);
    break;
  case 'DELETE':
    $id = $_GET['id'];
    if(isset($id))
    {
      if($student->remStudent($id) >= 1)
      {
        $js_encode = json_encode(array('state'=>TRUE, 'student'=>$student),true);
        header("Content-Type: application/json");
        echo($js_encode);
      }
      else
      {
        echo ("No student removed");
      }
    }
    break;
  case 'PUT':
    $body = file_get_contents("php://input");
    $js_decoded = json_decode($body, true);
    $student = new Student();
    $student->_name = $js_decoded["_name"];
    $student->_surname = $js_decoded["_surname"];
    $student->_sidiCode = $js_decoded["_sidiCode"];
    $student->_taxCode = $js_decoded["_taxCode"];
    $student->_id = $js_decoded["_id"];
    if($student->updatestudent($student) == 1)
    {
      $js_encode = json_encode(array('state'=>TRUE,'student'=>$student),true);
      header("Content-Type: application/json");
      echo($js_encode);
    }
    else
    {
      echo("No student updated");
    }
    break;
}
?>
