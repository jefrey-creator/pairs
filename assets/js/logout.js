$(document).ready(function(){
    borrowedCounter();
});

const logOut = () =>{
    $('#logOutModal').modal('show');
}

const borrowedCounter = () =>{
    $.ajax({
        url: "count-pending-borrowed-item",
        method: "GET",
        dataType: "json",
        cache: false,
        success:function(data){
            $('#borrowed_counter').html(data.result)
        }
    })
}
