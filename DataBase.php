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
        case 'newCard':
            $result = newCard();
            echo json_encode($result);
            break;
        case 'GetCardInfo':
            $result = getCardById($_POST['card_id']);
            echo json_encode($result);
            break;
        case 'updateCard':
            $result = updateCard();
            echo json_encode($result);
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

function getCards(){
    $dbconnection = createDatabaseConnection();
    $stmt = $dbconnection->prepare("SELECT cards.*, states.Name FROM cards left join states on cards.State_Id=states.Id");
    $stmt->execute();
    $result = $stmt->fetchAll();
    $dbconnection = NULL;
    return $result;
}

function getLists(){
    $dbconnection = createDatabaseConnection();
    $stmt = $dbconnection->prepare("SELECT * FROM lists");
    $stmt->execute();
    $result = $stmt->fetchAll();
    $dbconnection = NULL;
    return $result;
}

function getStates(){
    $dbconnection = createDatabaseConnection();
    $stmt = $dbconnection->prepare("SELECT * FROM states");
    $stmt->execute();
    $result = $stmt->fetchAll();
    $dbconnection = NULL;
    return $result;
}

function getCardById($id){
    $dbconnection = createDatabaseConnection();
    $stmt = $dbconnection->prepare("SELECT cards.*, states.Name FROM cards left join states on cards.State_Id=states.Id Where cards.Id = :id LIMIT 1", );
    $stmt->bindParam(":id", $id);
    $stmt->execute();
    $result = $stmt->fetch();
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
    $stmt = $dbconnection->prepare("INSERT INTO cards (title, description, list_id, state_id, minutes) VALUES (:cardName, :cardDescription, :list_id, 1, :minutes);");
    $stmt->bindParam(":cardName", $_POST["cardName"]);
    $stmt->bindParam(":cardDescription", $_POST["cardDescription"]);
    $stmt->bindParam(":minutes", $_POST["minutes"]);
    $stmt->bindParam(":list_id", $_POST["list_id"]);
    $stmt->execute();
    $id = $dbconnection->lastInsertId();
    $result = getCardById($id);
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

function updateCard(){
    $dbconnection = createDatabaseConnection();
    $stmt = $dbconnection->prepare("UPDATE cards SET State_Id=:state_id, Description=:cardDescription, Minutes=:minutes WHERE id=:id");                                    
    $stmt->bindParam(":cardDescription", $_POST["cardDescription"]);
    $stmt->bindParam(":minutes", $_POST["cardMinutes"]);
    $stmt->bindParam(":id", $_POST["cardId"]);
    $stmt->bindParam(":state_id", $_POST["cardState_Id"]);
    $stmt->execute();
    $dbconnection = NULL;
    return $result;
}

?>