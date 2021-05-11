<?php
include("Database.php");

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

            <? 
                $array = getLists();
            ?>

            <?php foreach($array as $key): ?>
                <div class="lijst" style="display:inline-block;">
                    <h5><?= $key['Name']; ?></h5>
                    <div class="newcontent">
                    </div>
                    <button data-id="<?= $key['Id'] ?>" type="button" class="btnnewcontent" id="newcard-btn" data-toggle="modal" data-target="#new-card-modal"><i class="fas fa-plus-square"></i> add new content </button>
                </div>
            <?php endforeach; ?>

            <button type="button" class="btn btn-primary" id="newlist-btn" data-toggle="modal" data-target="#new-list-modal">
                click me!
            </button>

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

            <div class="modal fade" id="new-card-modal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <label for="fname">What is the title of your new list?</label>
                        </div>
                        <div class="modal-body">
                            <form id="newcard-form">
                                <input type="text" class="form-control" id="cardName" name="cardName">
                                <input type="text" class="form-control" id="minutes" name="minutes">
                                <textarea type="text" id="cardDescription" class="form-control" name="cardDescription"></textarea>
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


