$(document).ready( function () {
    let table = $('#table_posts').DataTable({
        "responsive": true,
        "processing": true,
        "serverSide": true,
        "searching": false,
        "info": true,
        "pageLength": 25,
        "ajax": { 
            'type': 'GET',
            'url': '/posts/search',
            'data': function(d){
                d.fullname = $('#search_fullname').val();
                d.title = $('#search_title').val();
            }
        }
    });
/*
    $("#search_fullname").on('keyup', function(){
        table.columns(0)
             .search( this.value )
             .draw();   
    });

    $("#search_title").on('keyup', function(){
        table.columns(4)
             .search( this.value )
             .draw();   
    });*/

    $("#submit_search").on("click", function(){
        table.search('').draw(); 
    });
});