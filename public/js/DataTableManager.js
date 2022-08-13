var baseElement = null;
var table = null;
var filters = [];
var values = {};

function dataTableInit(element, order, type, url, columns, footerFunction, definitions = [], serverSide = true){
    // $(document).ready(function(){
    //     baseElement = element;
    //     if(typeof footerFunction === 'undefined'){ footerFunction = function(){}; }
    //     table = $(baseElement).DataTable({
    //         responsive: true,
    //         processing: true,
    //         serverSide: serverSide,
    //         scrollX: true,
    //         order:[order],
    //         lengthMenu:[[1,5,10,15,20,-1],[1,5,10,15,20,"All"]],
    //         pageLength:10,
    //         ajax: {"url": url, "type": type, "data": function(data){ return $.extend(data, values); }},
    //         columnDefs : definitions,
    //         columns: columns,
    //         oLanguage: {
    //             info: "",
    //             sZeroRecords: 'recordsNotFound',
    //             sEmptyTable: 'recordsAreEmpty',
    //             sSearch: "<span>"+ 'search' +":</span> _INPUT_",
    //             sLengthMenu: "<span>"+ 'records' +":</span> _MENU_",
    //         },
    //         footerCallback: footerFunction
    //     });
    //     $(baseElement + ' tbody').on('click', 'tr', function () {
    //         if($(this).hasClass('selected')){ $(this).removeClass('selected'); }
    //         else{ table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
    //     });
    // });
    $(document).ready(function() {
        baseElement = element;
        table = $(baseElement).DataTable({
            ajax: {"url": url, "type": type, "data": function(data){ return $.extend(data, values); }},
            columnDefs : definitions,
            rowReorder: {
                selector: 'td:nth-child(2)'
            },
            responsive: true,    
            columns: columns
            // drawCallback: function() {
            // $(baseElement).remove();
            // }
        } );
            $(baseElement + ' tbody').on('click', 'tr', function () {
            if($(this).hasClass('selected')){ $(this).removeClass('selected'); }
            else{ table.$('tr.selected').removeClass('selected'); $(this).addClass('selected'); }
        });
    } );
}

function editButton(wildcard, field = 'id'){
    $(document).ready(function(){
        $(baseElement + ' tbody').on('click', '.edit-button', function (){
            var data = table.row( $(this).parents('tr') ).data();
            var url = wildcard;
            url = url.replace('{' + field +'}', data[field]);
            window.location.href = url;
        });
    });
}


function detailsButton(wildcard, field = 'id'){
    $(document).ready(function(){
        $(baseElement + ' tbody').on('click', '.details-button', function (){
            var data = table.row( $(this).parents('tr') ).data();
            var url = wildcard;
            url = url.replace('{' + field +'}', data[field]);
            window.location.href = url;
        });
    });
}

function updateFilter(element, type){
    if(table !== null){
        var data = null;
        if(type == 'dateFrom'){ data = $(element).val().split('/')[2] + '-' + $(element).val().split('/')[1] + '-' + $(element).val().split('/')[0] + ' 00:00:00' }
        if(type == 'dateTo'){ data = $(element).val().split('/')[2] + '-' + $(element).val().split('/')[1] + '-' + $(element).val().split('/')[0] + ' 23:59:59' }
        if(type == 'integer'){ data = parseInt($(element).val()); }
        if(type == 'float'){ data = parseFloat($(element).val()); }
        if(type == 'string'){ data = $(element).val(); }
        filters[$(element).data().filter] = data;
        updateTable();
    }
}

function resetFilters(){
    filters = [];
    values = {};
    updateTable();
}

function updateTable(){
    for(var key in filters){ if(filters.hasOwnProperty(key)){ values[key] = filters[key]; } }
    table.ajax.reload();
}