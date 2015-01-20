@extends(Config::get('pragmarx/tracker::stats_layout'))

@section('page-contents')
	<table id="table_div" class="display" cellspacing="0" width="100%"></table>
@stop

@section('inline-javascript')
    @include(
        'pragmarx/tracker::_datatables',
        array(
            'datatables_ajax_route' => route('tracker.stats.api.eventlogs'),
            'datatables_columns' =>
            '
                { "data" : "id",  "title" : "Event ID", "orderable": true, "searchable": false },
                { "data" : "email",  "email" : "User", "orderable": true, "searchable": false },
                { "data" : "name",  "title" : "Name", "orderable": true, "searchable": true },
                { "data" : "updated_at",  "title" : "Date", "orderable": true, "searchable": false },
                { "data" : "method",  "title" : "Method", "orderable": true, "searchable": false },
                { "data" : "path",  "title" : "URL", "orderable": true, "searchable": false },
            '
        )
    )
@stop
