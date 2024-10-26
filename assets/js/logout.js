$(document).ready(function(){
    borrowedCounter();
    approvedCounter();
    deliveredCounter();
    pendingCounter();
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

const approvedCounter = () =>{
    $.ajax({
        url: "count-approved-request",
        method: "GET",
        dataType: "json",
        cache: false,
        success:function(data){
            $('#notif_counter').html(data.result);
            $('#for_pickup').html(data.result);
        }
    })
}

const deliveredCounter = () =>{
    $.ajax({
        url: "count-delivered-request",
        method: "GET",
        dataType: "json",
        cache: false,
        success:function(data){
            $('#delivered').html(data.result);
        }
    })
}

const pendingCounter = () =>{
    $.ajax({
        url: "count-pending-request",
        method: "GET",
        dataType: "json",
        cache: false,
        success:function(data){
            $('#processing').html(data.result);
        }
    })
}