<?php
class Vocab{
    public $Id;
    public $Vocb;
    public $Spelling;
    public $TypeVocb;
    public $Means;
    public $Example;
    public $MeanExample;
    public $TotalLike;
    public $TimeLast;

    public function __construct($Id, $Vocb, $Spelling, $TypeVocb, $Means, $Example, $MeanExample, $TotalLike, $TimeLast)
    {
        $this->Id = $Id;
        $this->Vocb = $Vocb;
        $this->Spelling = $Spelling;
        $this->TypeVocb = $TypeVocb;
        $this->Means = $Means;
        $this->Example = $Example;
        $this->MeanExamp = $MeanExample;
        $this->TotalLike = $TotalLike;
        $this->TimeLast = $TimeLast;
    }

}
function Select(){
    $stack = array();
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "vocabulary";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "SELECT ID, Vocb, Spelling, TypeVocb, Means, Example, MeanExample, TotalLike, TimeLast FROM newword";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
    // output data of each row
        while($row = $result->fetch_assoc()) {
            // echo $row["ID"].$row["Vocb"].$row["Spelling"].$row["TypeVocb"].$row["Means"].$row["Example"].$row["TotalLike"].$row["TimeLast"];
            // shuffle($row["ID"]);
            $t = new Vocab($row["ID"], $row["Vocb"], $row["Means"]);
            array_push($stack, $t);
            // echo $t->id;
            
            // foreach ($row as $number) {
            //     echo "$number ";
            // }
            // CreateVocab($row["ID"], $row["Vocb"], $row["Spelling"], $row["TypeVocb"], $row["Means"], $row["Example"], $row["MeanExample"], $row["TotalLike"], $row["TimeLast"]);
        }
    }else {
        echo "False";
    }
    $conn->close();
    shuffle($stack);
    foreach ($stack as $number) {
            echo $number->id;
            echo $number->Vocb;
    }

}

?>