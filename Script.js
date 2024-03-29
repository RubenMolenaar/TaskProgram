$(document).ready(function(){
    $('#new-list-modal').on('click', '#save-newlist', function () {
        var senddata = { action: "newList", listName: $('#listName').val() }
        $.post('DataBase.php', senddata ,function(data){
            $('<div class="lijst" style="display:inline-block;  height: fit-content;"><h5 style="display:inline-block;">'+ $('#listName').val() + '</h5><button style="display: inline-block ;float:right;" class="btn btn-danger" id="list-delete" data-id="'+ data +'">x</button><div data-id="'+ data +'" class="newcontent"></div><button data-id="'+ data +'" type="button" class="btnnewcontent" id="newcard-btn" data-toggle="modal" data-target="#new-card-modal"><i class="fas fa-plus-square"></i> add new content </button></div></label>').insertBefore('#newlist-btn')  
            $('#new-list-modal').modal('hide')        
        })
    })
    
    $(document).on('click', '#newcard-btn', function(e){
        $('#save-newcard').attr('data-id', $(this).data('id'))
    })


    $(document).on('click','.card-info', function(){
        console.log($(this).data('id'));
        var senddata = { action: "GetCardInfo", card_id: $(this).data('id')}
        $.ajax({
            type: 'POST',
            url: 'DataBase.php',
            data: senddata, 
            dataType: "json",
            success: function(data){
                console.log(data);
                $('#card-info-modal').modal('show');
                $('#card-info-title').html('' +  data['Title'])
                $('#card-info-description').html('' +  data['Description'])
                $('#card-info-minutes').val('' +  data['Minutes'])
                $('#card-info-id').val('' +  data['Id'])
                $('#card-info-status option').each(function(){
                    $(this).removeAttr('selected');
                    if($(this).val() == data['State_Id']){
                        $(this).attr('selected','selected');
                    }
                })
                $('#card-delete').data('id', data['Id']);
                console.log($('#card-delete').data('id'))
            }      
        })
    })


    $('#new-card-modal').on('click', '#save-newcard', function () {
        var senddata = { action: "newCard", cardName: $('#cardName').val(), cardDescription: $('#cardDescription').val(), list_id: $(this).data('id'), minutes: $('#minutes').val()}
        $.ajax({
            type: 'POST',
            url: 'DataBase.php',
            data: senddata, 
            dataType: "json",
            error: function(data){
                console.log(data)
            },  
            success: function(data){
                $('.newcontent[data-id="'+ data['List_Id'] +'"]').append('<div style="background-color: white;width: 229px;border: solid 1px #000;padding: 5px;" class="card-info" data-id="'+ data['Id'] +'"><p style="font-weight: bold; text-align: center;">' + data['Title'] + '</p><p style="font-weight: bold; text-align: center;">' +  data['Name'] + '</p></div>')
                $('#new-card-modal').modal('hide')
            }      
        })
    })

    $('#new-card-modal').on('hidden.bs.modal', function(){
        $('#new-card-modal :input').each(function(){
            $(this).val('')
        });
    })
    

    $('#card-info-modal').on('hidden.bs.modal', function(){
        $('#card-save-btn').css('display','none')
        $('.card-edit-enabled').each(function(){
            $(this).prop("disabled", true);
        })
    })

    $('#new-list-modal').on('hidden.bs.modal', function(){
        $('#new-list-modal :input').each(function(){
            $(this).val('')
        });
    })

    $(document).on('click', '#card-edit-btn', function(){
        $('#card-save-btn').css('display','block')
        $('.card-edit-enabled').each(function(){
            $(this).prop("disabled", false);
        })
    })

    $(document).on('click', '#card-save-btn', function(){
        var senddata = { 
            action: "updateCard", 
            cardId: $('#card-info-id').val(), 
            cardDescription: $('#card-info-description').val(), 
            cardMinutes: $('#card-info-minutes').val(), 
            cardState_Id: $('#card-info-status').val()
        }
        $.ajax({
            type: 'POST',
            url: 'DataBase.php',
            data: senddata, 
            dataType: "json",
            error: function(data){
                console.log(data)
            },  
            success: function(){
                window.location.reload();
            }    
        })
    })

    $(document).on('click', '#card-delete', function(){
        console.log($(this).data('id'));
        var senddata = { action: "deleteCard", cardId: $(this).data('id')}
        $.ajax({
            type: 'POST',
            url: 'DataBase.php',
            data: senddata, 
            dataType: "json",
            error: function(data){
                console.log(data)
            },  
            success: function(){
                window.location.reload();
            }    
        })
    })
    
    $(document).on('click', '#list-delete', function(){
        console.log($(this).data('id'));
        var senddata = { action: "deleteList", listId: $(this).data('id')}
        $.ajax({
            type: 'POST',
            url: 'DataBase.php',
            data: senddata, 
            dataType: "json",
            error: function(data){
                console.log(data)
            },  
            success: function(data){
                window.location.reload();
            }
        })
    })

    $('#state-filter').on('change', function(){
        window.location.href = window.location.pathname + "?status=" + $(this).val();
    })


})
