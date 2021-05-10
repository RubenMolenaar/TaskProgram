<?php
include("Database.php");
$cards = getData();
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
<body class="container">
<header class="header">
    <h1 id="header-text">veel leuker dan trello</h1>
</header>
<div class="row">
    <div class="col-md-3">
        
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
            
            

    </div>
</div>
<div id="lists-div">

</div>
</body>
</html>


