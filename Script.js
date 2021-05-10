$(document).ready(function(){
    $('#new-list-modal').on('click', '#save-newlist', function () {
        var data = { action: "newList", listName: $('#listName').val() }
        $.post('DataBase.php', data ,function(data){
            console.log(data);
            $('#lists-div').append('<div class="lijst"><h5>'+ $('#listName').val() + '</h5><button data-id="'+ data +'" type="button" class="btnnewcontent"><div class="newcontent"><i class="fas fa-plus-square"></i> add new content </div></button></div></label>')   
            $('#new-list-modal').modal('hide')        
        })
    })

})
