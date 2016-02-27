$(document).ready(function() {
    
    var table         = $('#datatables');
    
    var pageLength    = 10;
    var processing    = true;
    var serverSide    = true;
    var requestType   = 'GET';
    
    var section       = $('div[data-section]').data('section');
    var baseURL       = $('div[data-base-url]').data('base-url');
    var route_create  = $('div[data-route-create]').data('route-create');
    var deleteManyURL = $('div[data-route-delete-many]').data('route-delete-many');

    window.oTable = table.DataTable({

        // Internationalisation. For more info refer to http://datatables.net/manual/i18n
        'language': {
            'aria': {
                'sortAscending': ': orderby asc',
                'sortDescending': ': orderby desc'
            },
            'emptyTable': 'There is no data to display',
            'info': 'Show from _START_ - _END_ in _TOTAL_ records',
            'infoEmpty': 'No record found',
            'infoFiltered': '(filtered from _MAX_ records)',
            'lengthMenu': '_MENU_',
            'search': '',
            'zeroRecords': 'No record found',
            'processing': 'Loading data from server'
        },

        'bStateSave': true,
        'aoColumnDefs': [
            {
                'bSortable': false,
                'aTargets': ['no-sort'] // <-- gets last column and turns off sorting
            },
            {
                'bSearchable': false,
                'aTargets': ['no-search'] // <-- gets last column and turns off sorting
            }
        ],

        'lengthMenu': [
            [10, 30, 50, -1],
            [10, 30, 50, 'All'] // change per page values here
        ],
        // set the initial value
        'pageLength': pageLength,
        'processing': processing,
        'serverSide': serverSide,
        'bServerSide': serverSide,
        'bDeferRender': true,
        'bProcessing': true,
        ajax: {
            url: laroute.route(section),
            type: requestType,
            data: function (d) {
                d.groupFilter = window.groupFilter;
            }
        },
        'fnInitComplete': function() {
            $('.checkboxes').uniform();
        },
        'fnDrawCallback': function( oSettings ) {
            $('.checkboxes').uniform();
        },
        dom: '<"datatable-header"Tfl>t<"datatable-footer"ip>'
    });

    window.oTable.on('draw.dt', function () {
        $('.tip').tooltip({ placement:'top' });
        if ($.fn.editable) {
            $('.editable').editable();
        }
    });

    var tableWrapper       = $('#datatables_wrapper'); // datatable creates the table wrapper by adding with id {your_table_jd}_wrapper
    var tableColumnToggler = $('#datatables_column_toggler');

    table.find('.group-checkable').change(function () {
        var set     = $(this).attr('data-set');
        var checked = $(this).prop('checked');
        $(set).each(function () {
            if (checked) {
                $(this).prop('checked', true);
            } else {
                $(this).prop('checked', false);
            }
        });
        $.uniform.update(set);
    });

    /* modify datatable control inputs */
    tableWrapper.find('.dataTables_length select').select2({
    	minimumResultsForSearch: Infinity,
        width: 85
    }); // initialize select2 dropdown

    $('.dataTables_filter input[type=search]').attr('placeholder', 'Type to filter...');

    /* Add event listener for opening and closing details
     * Note that the indicator for showing which row is open is not controlled by DataTables,
     * rather it is done here
     */
    table.on('click', ' tbody td .row-details', function () {
        var nTr = $(this).parents('tr')[0];
        if (window.oTable.fnIsOpen(nTr)) {
            /* This row is already open - close it */
            $(this).addClass('row-details-close').removeClass('row-details-open');
            window.oTable.fnClose(nTr);
        } else {
            /* Open this row */
            $(this).addClass('row-details-open').removeClass('row-details-close');
            window.oTable.fnOpen(nTr, null, 'details');
        }
    });

    $('div.dataTables_filter').append(
        '<a class="btn btn-primary pull-right" href="' + laroute.route(route_create) + '"><i class="fa fa-plus-circle"></i> Add New</a>' +
        '<div class="actions">' +
            '<div class="btn-group">' +
                '<a class="btn btn-primary" href="javascript:;" data-toggle="dropdown">' +
                '<span>Action <span class="caret"></span></span>' +
                '</a>' +
                '<ul class="dropdown-menu">' +
                    '<li>' +
                        '<a href="javascript:;" class="task-item" data-action="delete">' +
                        '<i class="fa fa-trash-o"></i> Delete </a>' +
                    '</li>' +
                '</ul>' +
            '</div>' +
        '</div>'
    );


    $(document).on('click', '.deleteDialog', function (event) {
        event.preventDefault();

        $('#delete-crud-entry').data('section', $(this).data('section'));
        $('#delete-crud-modal').modal('show');
    });

    $('#delete-crud-entry').on('click', function (event) {
        event.preventDefault();
        $('#delete-crud-modal').modal('hide');

        var deleteURL = $(this).data('section');

        $.ajax({
            url: deleteURL,
            type: 'GET',
            success: function(data, textStatus) {
                if (data.error) {
                    showNotice('error', data.message, 'Error!');
                } else {                    // no error proceed
                    window.oTable.row($('a[data-section="'+ deleteURL +'"]').closest('tr')).remove().draw();
                    showNotice('success', data.message, 'Success!');
                }
            },
            error: function(data) {
               showNotice('error', data.responseJSON.message, 'Error!');
            }
        });
    });

    $(document).on('click', '.task-item', function(event) {
        event.preventDefault();

        var action = $(this).data('action');
        if (action == 'delete') {
            $('#delete-many-modal').modal('show');
        }
        
    });

    $('#delete-many-entry').on('click', function (event) {
        event.preventDefault();
        $('#delete-many-modal').modal('hide');

        var ids = [];
        $('.checkboxes:checked').each(function(i){
            ids[i] = $(this).val();
        });

        $.ajax({
            url: laroute.route(deleteManyURL),
            type: 'POST',
            data: {'ids': ids},
            success: function(data, textStatus) {
                if (data.error) {
                    showNotice('error', data.message, 'Error!');
                } else {
                    $.each(ids, function (index, item) {
                        window.oTable.row($('.checkboxes[value="'+ item +'"]').closest('tr')).remove().draw();
                    });                  
                    showNotice('success', data.message, 'Success!');
                }
            },
            error: function(data) {
               showNotice('error', data.responseJSON.message, 'Error!');
            }
        });
    });

});
