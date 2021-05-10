<?php
if (isset($_POST['action'])) {
    switch ($_POST['action']) {
        case 'getCardById':
            getCardById();
            break;
        case 'newList':
            $result = newList();
            echo $result;
            break;
    }
}
function createDatabaseConnection (){
    $servername = "localhost";
    $username = "root";
    $password = "mysql";
    $dbname = "year2week3_4";

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

function getData(){
    $dbconnection = createDatabaseConnection();
    $stmt = $dbconnection->prepare("SELECT * FROM cards");
    $stmt->execute();
    $result = $stmt->fetchAll();
    $dbconnection = NULL;
    return $result;
}

function getCardById(){
    $dbconnection = createDatabaseConnection();
    $stmt = $dbconnection->prepare("SELECT * FROM cards Where Id = :id", );
    $stmt->bindParam(":id", $_POST["id"]);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $dbconnection = NULL;
    return $result;
}

function newList(){
    $dbconnection = createDatabaseConnection();
    $stmt = $dbconnection->prepare("INSERT INTO lists (name) VALUES (:listName);");
    $stmt->bindParam(":listName", $_POST['listName']);
    $stmt->execute();
    $result = $dbconnection->lastInsertId();
    $dbconnection = NULL;
    return $result;
}

function newCard(){
    $dbconnection = createDatabaseConnection();
    $stmt = $dbconnection->prepare("INSERT INTO cards (name) VALUES (:cardName, :cardDescription);");
    $stmt->bindParam(":cardName", $_POST["cardName"]);
    $stmt->bindParam(":cardDescription", $_POST["cardDescription"]);
    $stmt->execute();
    $stmt->lastInsertId();
    $result = $stmt->fetch();
    $dbconnection = NULL;
    return $result;
}

function insertData(){
    $name = "jaaaa";
    // $name = $_POST["name"];
    $date = $_POST["date"];
    $length = $_POST["length"];
    $explain = $_POST["explain"];
    $players = $_POST["players"];
    $dbconnection = createDatabaseConnection();
    $stmt = $dbconnection->prepare("INSERT INTO planned (name, date, length, explainer, players) VALUES (:ja, :nee, :zeker, :denk, :ik);");
    $stmt->bindParam(":ja", $name);
    $stmt->bindParam(":nee", $date);
    $stmt->bindParam(":zeker", $length);//datum colom
    $stmt->bindParam(":denk", $explain);
    $stmt->bindParam(":ik", $players);
    $stmt->execute();
    $stmt->lastInsertId();
    $result = $stmt->fetch();
    $dbconnection = NULL;
    return $result;
}

?>