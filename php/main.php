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

    if(isset($_POST['id'])){
        // alert($_POST['po']);
        IncreaseLike($_POST['id']);
    }

    function CalculateDate($timeLast){ 
        $one = new DateTime($timeLast);
        $two = new DateTime(date("y-m-d"));
        $interval = $one->diff($two);
        if($interval->days >= 30){
            return $interval->m." months";
        }
        return $interval->d." days";
    }

    
    function TotalVocab(){
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

        $sql = "SELECT COUNT(*) FROM newword";
        // $result = $conn->query($sql);
        $count = $conn->query($sql)->fetch_row()[0];
        echo $count;
        $conn->close();
    }

    function CreateVocab($id, $vocb, $spelling, $type, $mean, $example, $meanExample, $totalLike, $timeLast){
        $value = array($type, '/'.$spelling.'/', $mean);
        $valueMid = array($example, $meanExample);
        
        $classNameDiv = array('container-vocab-top', 'container-vocab-mid', 'container-vocab-bottom');
        $classNameP = array('typevocab', 'speling', 'mean');

        $classNamePMid = array('example', 'mean-example');

        $dom = new DOMDocument('1.0');//Create new document with specified version number
        $div = $dom->createElement('div');//Create new <br> tag
        $divClass = $dom->createAttribute('class');
        $divClass->value = 'container-vocab';
        $div->appendChild($divClass);

        for ($i=0; $i < 3; $i++) {
            $divTop = $dom->createElement('div');
            $divTopClass = $dom->createAttribute('class');
            $divTopClass->value = $classNameDiv[$i];
            $divTop->appendChild($divTopClass);
            switch ($i) {
                case 0:
                    $h2 = $dom->createElement('h2', $vocb);
                    $h2ClassName = $dom->createAttribute('class');
                    $h2ClassName->value = 'vocabulary';
                    $h2->appendChild($h2ClassName);
                    $divTop->appendChild($h2);
                    for ($j=0; $j < 3; $j++) { 
                        $p = $dom->createElement('p', $value[$j]);
                        $pClassName = $dom->createAttribute('class');
                        $pClassName->value = $classNameP[$j];
                        $p->appendChild($pClassName);

                        $divTop->appendChild($p);
                    }
                    break;
                case 1:
                    for ($j=0; $j < 2; $j++) { 
                        $p = $dom->createElement('p', $valueMid[$j]);
                        $pClassName = $dom->createAttribute('class');
                        $pClassName->value = $classNamePMid[$j];
                        $p->appendChild($pClassName);
                        $divTop->appendChild($p);
                    }
                    break;
                case 2:
                    $divInBottom = $dom->createElement('div');
                    $divInBottomClass = $dom->createAttribute('class');
                    $divInBottomClass->value = 'like';
                    $divInBottom->appendChild($divInBottomClass);

                    
                    $divInBottomClass = $dom->createAttribute('onclick');
                    $divInBottomClass->value = 'SelectVocab('.$id.')';
                    $divInBottom->appendChild($divInBottomClass);
                    $divTop->appendChild($divInBottom);

                    $divInBottomChild = $dom->createElement('div');
                    $divInBottomClassIcon = $dom->createAttribute('class');
                    $divInBottomClassIcon->value = 'icon';
                    $divInBottomChild->appendChild($divInBottomClassIcon);

                    
                    $divInBottomClassIcon = $dom->createAttribute('icon');
                    $divInBottomClassIcon->value = 'like';
                    $divInBottomChild->appendChild($divInBottomClassIcon);
                    $divInBottom->appendChild($divInBottomChild);

                    $spanInBottomLike = $dom->createElement('span', $totalLike);
                    $divInBottom->appendChild($spanInBottomLike);
                    
                    $spanInBottom = $dom->createElement('span', CalculateDate($timeLast));
                    $spanInBottomClass = $dom->createAttribute('class');
                    $spanInBottomClass->value = 'date';
                    $spanInBottom->appendChild($spanInBottomClass);
                    $divTop->appendChild($spanInBottom);
                    break;
            }
            $div->appendChild($divTop);

        }
        $dom->appendChild($div);
        echo $dom->saveHTML();
    }

    function CreateElementInClass($i,$elementParent){
        $dom = new DOMDocument('1.0');
        switch ($i) {
            case 0:
                $h2 = $dom->createElement('h2');
                // $elementParent->appendChild($h2);
                for ($j=0; $j < 3; $j++) { 
                    $p = $dom->createElement('p');
                    $elementParent->appendChild($p);
                }
                break;
            case 1:
                break;
            case 2:
                break;
        }
    }

    
function Select(){
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
            // echo $row;
            CreateVocab($row["ID"], $row["Vocb"], $row["Spelling"], $row["TypeVocb"], $row["Means"], $row["Example"], $row["MeanExample"], $row["TotalLike"], $row["TimeLast"]);
        }
    }else {
        echo "False";
    }
    $conn->close();
}

    
function Select2(){
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
            // echo $row;
            $obj = new Vocab($row["ID"], $row["Vocb"], $row["Spelling"], $row["TypeVocb"], $row["Means"], $row["Example"], $row["MeanExample"], $row["TotalLike"], $row["TimeLast"]);
            array_push($stack, $obj);
        }
    }else {
        echo "False";
    }
    $conn->close();

    shuffle($stack);
    foreach ($stack as $obj) {
        CreateVocab($obj->Id, $obj->Vocb, $obj->Spelling, $obj->TypeVocb, $obj->Means, $obj->Example, $obj->MeanExample, $obj->TotalLike, $obj->TimeLast);
    }

}

function IncreaseLike($Id){
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
    $dateNow = date("ymd");
    $sql = "UPDATE newword SET TotalLike=TotalLike + 1, TimeLast=$dateNow WHERE Id=$Id";
    if (mysqli_query($conn, $sql)) {
        // echo "Record updated successfully";
      } else {
        // echo "Error updating record: " . mysqli_error($conn);
      }
      
      mysqli_close($conn);
}

?>