$(document).ready(function(){
    $('#new-list-modal').on('click', '#save-newlist', function () {
        var data = { action: "newList", listName: $('#listName').val() }
        $.post('DataBase.php', data ,function(data){
            console.log(data);
            $('#lists-div').append('<div class="lijst" style="display:inline-block;"><h5>'+ $('#listName').val() + '</h5><div class="newcontent"></div><button data-id="'+ data +'" type="button" class="btnnewcontent" id="newcard-btn" data-toggle="modal" data-target="#new-card-modal"><i class="fas fa-plus-square"></i> add new content </button></div></label>')   
            $('#new-list-modal').modal('hide')        
        })
    })
    
    $(document).on('click', '#newcard-btn', function(e){
        console.log($(this).data('id'))
        $('#save-newcard').attr('data-id', $(this).data('id'))
    })

    $('#new-card-modal').on('click', '#save-newcard', function () {
        var data = { action: "newCard", cardName: $('#cardName').val(), cardDescription: $('#cardDescription').val(), list_id: $(this).data('id'), minutes: $('#minutes').val()}
        $.post('DataBase.php', data ,function(data){
            console.log(data);
            $('#card-div').append('<div><p class="cardName"></p><p class="cardState">' + data.Name + '</p></div>')   
            $('#new-card-modal').modal('hide')        
        })
    })

})
