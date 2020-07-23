$(document).ready( function () {
    let table = $('#table_posts').on( 'init.dt', function () {
        $('#table_posts').css("display","block");
        //Here hide the loader.
        // $("#MessageContainer").html("Your Message while load Complete");
    }).DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "searching": false,
        "info": true,
        "pageLength": 25,
        "language": {
            "processing": "<img src='../loading.gif' / width='50%' height='50%'>"
        }, 
        columnDefs: [ 
        	{ targets:"_all", orderable: true },
        	{ targets:[0,1,2,3,4,5,6], className: "desktop" },
            { targets:[0,1,2,3,4,6], className: "tablet, mobile" },
        ],
        "ajax": { 
            'type': 'GET',
            'url': '/posts/search',
            'data': function(d){
                d.fullname = $('#search_fullname').val();
                d.title = $('#search_title').val();
            }
        }
    });

    $("#submit_search").on("click", function(){
        table.search('').draw(); 
    });

});