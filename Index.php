<?php
    include("Database.php");
    $lists = getLists();
    $cards = getCards();
    $states = getStates();
?>

<!DOCTYPE html>
<html>
<head>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" integrity="sha512-P5MgMn1jBN01asBgU0z60Qk4QxiXo86+wlFahKrsQf37c9cro517WzVSPPV1tDKzhku2iJ2FVgL67wG03SGnNA==" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.min.js" integrity="sha512-XKa9Hemdy1Ui3KSGgJdgMyYlUg1gM+QhL6cnlyTe2qzMCYm4nAZ1PsVerQzTTXzonUR+dmswHqgJPuwCq1MaAg==" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
    <script src="Script.js"></script>
	<title>back-end opdracht 2 to-do list</title>
</head>
<body class="container" style="overflow-x: auto;  max-width: 960px;">
<header class="header">
    <h1 id="header-text">veel leuker dan trello</h1>
</header>
<div style="width: 100%; background-color: white; font-weight: bold; margin-left: 0px; margin-bottom: 15px;">
    <h5 style=" margin-left: 15px; display: inline-block;">filters:</h5>
    <button class="btn btn-success" style="display: inline-block; float: right;">filteren</button>
    <div class="row" style="margin: 15px;">
        <div class="col-md-6">
            <label style="inline-block">status:</label>
            <select style="inline-block" class="form-control" id="">
                <option value="false">Geen filter</option>
                <? foreach($states as $state): ?>
                    <option value="<?= $state["Id"]?>"><?= $state["Name"] ?></option>
                <? endforeach; ?>
            <select>
        </div>
        <div class="col-md-6">
            <label style="inline-block">minuten:</label>
            <input type="number" style="inline-block" class="form-control" id="minutes-filter" placeholder="minuten"/>
        </div>
    </div>
</div>

            
            <div id="lists-div" style="maxwidth: 400px; overflow-x: scroll; display: flex ;">

                <?php foreach($lists as $list): ?>
                    <div class="lijst" style="display:inline-block; height: fit-content;">
                        <h5 style="display: inline-block ;"><?= $list['Name']; ?></h5>
                        <button style="display: inline-block ;float:right;" class="btn btn-danger" id="list-delete" data-id="<?= $list['Id']; ?>">x</button>
                        <div class="newcontent" data-id="<?= $list['Id']?>">
                        <?if($_GET['state_filter'] != null):?>
                            <?foreach($cards as $card):?>
                                <?php if($card['List_Id'] == $list['Id']): ?>
                                    <div style="background-color: white;width: 229px;border: solid 1px #000;padding: 5px;" class="card-info" data-id="<?= $card['Id']?>">
                                        <p style="font-weight: bold; text-align: center;"><?= $card['Title'] ?></p>
                                        <p style="font-weight: bold; text-align: center;"><?= $card['Name'] ?></p>
                                    </div>
                                <?php endif; ?>
                            <? endforeach; ?>
                        <??>
                        </div>
                        <button data-id="<?= $list['Id'] ?>" type="button" class="btnnewcontent" id="newcard-btn" data-toggle="modal" data-target="#new-card-modal"><i class="fas fa-plus-square"></i> add new content </button>
                    </div>
                <?php endforeach; ?>

                <button type="button" class="btn btn-primary" id="newlist-btn" data-toggle="modal" data-target="#new-list-modal">
                    Nieuwe lijst
                </button>
            </div>
            

            <div class="modal fade" id="new-list-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <label for="fname">What is the title of your new list?</label>
                        </div>
                        <div class="modal-body">
                            <form id="newlist-form">
                                <input type="text" id="listName" name="listName">
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="save-newlist" class="btn btn-success">Save</button>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal fade" id="card-info-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 id='card-info-title'></h2>
                            <button id='card-edit-btn' class="btn btn-warning">Bewerken</button>
                        </div>
                        <div class="modal-body">
                            <input type='hidden' value='' id='card-info-id'>
                            <label>status</label>
                            <select id='card-info-status' class="form-control card-edit-enabled" disabled>
                                <?php foreach($states as $state): ?>
                                    <option value="<?= $state['Id']?>"><?= $state['Name']?></option>
                                <?php endforeach; ?>
                            </select>
                            <label>duur(Minuten)</label>
                            <input id='card-info-minutes' type='text' class="form-control card-edit-enabled" disabled/>
                            <label>beschrijving</label>
                            <textarea id='card-info-description' class='card-edit-enabled' disabled style='width:100%;'></textarea>
                        </div>
                        <div class="modal-footer">
                            <button id="card-delete" class="btn btn-danger">verwijderen</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            <button type="button" id='card-save-btn' class="btn btn-success" id="" style="display: none;"><i class="fas fa-edit"></i>Opslaan</button>
                        </div>
                    </div>

                </div>
            </div>

            <div class="modal fade" id="new-card-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h2 for="fname">Kaart toevoegen</label>
                        </div>
                        <div class="modal-body">
                            <form id="newcard-form">
                                <label style="width: 100%;">
                                    Titel:
                                    <input type="text" class="form-control" id="cardName" name="cardName" placeholder="Titel">
                                </label>
                                <label style="width: 100%;">
                                    Duur(minuten):
                                    <input type="number" class="form-control" id="minutes" name="minutes" placeholder="Duur">
                                </label>
                                <label style="width: 100%;">
                                    Beschrijving:
                                    <textarea type="text" id="cardDescription" class="form-control" name="cardDescription" placeholder="Beschrijving"></textarea>
                                </label>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="button" id="save-newcard" class="btn btn-success">Save</button>
                        </div>
                    </div>

                </div>
            </div>
            
            

<div id="lists-div">

</div>
</body>
</html>


