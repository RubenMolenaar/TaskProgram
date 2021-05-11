$(document).ready(function(){
    $('#new-list-modal').on('click', '#save-newlist', function () {
        var senddata = { action: "newList", listName: $('#listName').val() }
        $.post('DataBase.php', senddata ,function(data){
            $('#lists-div').append('<div class="lijst" style="display:inline-block;"><h5>'+ $('#listName').val() + '</h5><div data-id="'+ data +'" class="newcontent"></div><button data-id="'+ data +'" type="button" class="btnnewcontent" id="newcard-btn" data-toggle="modal" data-target="#new-card-modal"><i class="fas fa-plus-square"></i> add new content </button></div></label>')   
            $('#new-list-modal').modal('hide')        
        })
    })
    
    $(document).on('click', '#newcard-btn', function(e){
        $('#save-newcard').attr('data-id', $(this).data('id'))
    })

    $('#new-card-modal').on('click', '#save-newcard', function () {
        var senddata = { action: "newCard", cardName: $('#cardName').val(), cardDescription: $('#cardDescription').val(), list_id: $(this).data('id'), minutes: $('#minutes').val()}
        $.ajax({
            type: 'POST',
            url: 'DataBase.php',
            data: senddata, 
            dataType: "json",
            success: function(data){
                $('.newcontent[data-id="'+ data['List_Id'] +'"]').append('<div style="background-color: white;width: 229px;border: solid 1px #000;padding: 5px;"><p style="font-weight: bold; text-align: center;">' + data['Title'] + '</p><p style="font-weight: bold; text-align: center;">' +  data['Name'] + '</p></div>')   
                $('#new-card-modal').modal('hide')
            }      
        })
    })

    $('#new-card-modal').on('hidden.bs.modal', function(){
        $('#new-card-modal :input').each(function(){
            $(this).val('')
        });
    })

})
