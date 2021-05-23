<?php
include("DBConnection.php");
class Student 
{
  private $db;
  public $_id;
  public $_name;
  public $_surname;
  public $_sidiCode;
  public $_taxCode;
  function __construct() 
  {
    $this->db = new DBConnection();
    $this->db = $this->db->returnConnection();
  }
  function find($id)
  {
    $sql = "SELECT * FROM student WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    $data = [
      'id' => $id
    ];
    $stmt->execute($data);
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $result;
  }
  function all()
  {
    $sql = "SELECT * FROM student";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
  }
  function addStudent($student)
  {
    $sql = "INSERT INTO student VALUES ($student)";
    $stmt = $this->db->prepare($sql);
    $data = [
      'student' => $student
    ];
    $stmt->execute($data);
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $result;
  }
  function remStudent($id)
  {
    $sql = "DELETE * FROM student WHERE id=:id";
    $stmt = $this->db->prepare($sql);
    $data = [
      'id' => $id
    ];
    $stmt->execute($data);
    $result = $stmt->fetch(\PDO::FETCH_ASSOC);
    return $result;
  }
  function updatestudent ($student)
  {
    $sql = "UPDATE student SET name='".$student->_name."', surname='".$student->_surname."', sidi_code='".$student->_sidiCode."', tax_code='".$student->_taxCode."' WHERE id='".$student->_id."'";
    $stmt = $this->db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
    return $result;
  }
}
?>
