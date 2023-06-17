<?php

class DataJamur {
  private $conn;
  private $table = "data_jamur";

  public $tanggal;
  public $jam;
  public $suhu;
  public $kelembapan;

  public function __construct($db) {
    $this->conn = $db;
  }

  function create() {
    $query = "INSERT INTO " . $this->table . "(tanggal, jam, suhu, kelembapan) VALUES (:tanggal, :jam, :suhu, :kelembapan)";
    $stmt = $this->conn->prepare($query);

    $stmt->bindParam(":jam", $this->jam);
    $stmt->bindParam(":tanggal", $this->tanggal);
    $stmt->bindParam(":suhu", $this->suhu);
    $stmt->bindParam(":kelembapan", $this->kelembapan);

    if($stmt->execute()){
      return $this->conn->lastInsertId();
    }

    return false;
  }

  function read() {
    $query = "SELECT * FROM " . $this->table . " ORDER BY id DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->execute();

    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $data;

    // return $stmt;
  }

  function readById($id) {
    $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(":id", $id);
    $stmt->execute();

    $data = $stmt->fetch(PDO::FETCH_ASSOC);
    return $data;
  }

  // function delete()
  // {
  //   $query = "DELETE FROM " . $this->table ." WHERE id = :user_id";
  //   $stmt = $this->conn->prepare($query);
  //   $stmt->bindParam(":user_id", $this->user_id);
  //   $stmt->execute();

  //   return $stmt;
  // }
}
?>

