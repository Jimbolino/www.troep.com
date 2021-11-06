<html>
<head>
    <style>
        .datagrid table {
            border-collapse: collapse;
            text-align: left;
            width: 100%;
        }

        .datagrid {
            font: normal 12px/150% Arial, Helvetica, sans-serif;
            background: #fff;
            overflow: hidden;
            border: 1px solid #006699;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
        }

        .datagrid table td, .datagrid table th {
            padding: 3px 10px;
        }

        .datagrid table thead th {
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F));
            background: -moz-linear-gradient(center top, #006699 5%, #00557F 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');
            background-color: #006699;
            color: #FFFFFF;
            font-size: 15px;
            font-weight: bold;
            border-left: 1px solid #0070A8;
        }

        .datagrid table thead th:first-child {
            border: none;
        }

        .datagrid table tbody td {
            color: #00496B;
            border-left: 1px solid #E1EEF4;
            font-size: 12px;
            font-weight: normal;
        }

        .datagrid table tbody .alt td {
            background: #E1EEF4;
            color: #00496B;
        }

        .datagrid table tbody td:first-child {
            border-left: none;
        }

        .datagrid table tbody tr:last-child td {
            border-bottom: none;
        }

        .datagrid table tfoot td div {
            border-top: 1px solid #006699;
            background: #E1EEF4;
        }

        .datagrid table tfoot td {
            padding: 0;
            font-size: 12px
        }

        .datagrid table tfoot td div {
            padding: 2px;
        }

        .datagrid table tfoot td ul {
            margin: 0;
            padding: 0;
            list-style: none;
            text-align: right;
        }

        .datagrid table tfoot li {
            display: inline;
        }

        .datagrid table tfoot li a {
            text-decoration: none;
            display: inline-block;
            padding: 2px 8px;
            margin: 1px;
            color: #FFFFFF;
            border: 1px solid #006699;
            -webkit-border-radius: 3px;
            -moz-border-radius: 3px;
            border-radius: 3px;
            background: -webkit-gradient(linear, left top, left bottom, color-stop(0.05, #006699), color-stop(1, #00557F));
            background: -moz-linear-gradient(center top, #006699 5%, #00557F 100%);
            filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#006699', endColorstr='#00557F');
            background-color: #006699;
        }

        .datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover {
            text-decoration: none;
            border-color: #006699;
            color: #FFFFFF;
            background: none;
            background-color: #00557F;
        }

        div.dhtmlx_window_active, div.dhx_modal_cover_dv {
            position: fixed !important;
        }
    </style>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"></script>
</head>
<body>



@foreach ($items as $item)

<div class="datagrid">
    <table>
        <thead>
        <tr>
            <th>{{ $item['name'] }}</th>
            <th>file</th>
            <th>size</th>
            <th>date</th>
        </tr>
        </thead>

        <tbody>

        @foreach ($item['kbs'] as $kb)
        <tr class="{{ $kb['alt'] }}">
            <td>{{ $kb['name'] }}</td>
            <td><a href="{{ $kb['items'][$bit]['url'] ?? null }}">{{ $kb['items'][$bit]['filename'] ?? null }}</a></td>
            <td>{{ $kb['items'][$bit]['size'] ?? null }}</td>
            <td>{{ date('d-M-Y', $kb['items'][1]['date'] ?? null )}}</td>
        </tr>
        @endforeach

        </tbody>
    </table>
</div>
<a href="" onclick="$('#install{{$loop->index}}').dialog();return false;">install.cmd</a>
-
<a href="" onclick="$('#extract{{$loop->index}}').dialog();return false;">extract.cmd</a>
<br />
<br />

<div id="extract{{$loop->index}}" title="extract.cmd" hidden>
<pre>
cd /d %~dp0
mkdir c:\updates
@foreach ($item['kbs'] as $kb)
{{ $kb['items'][$bit]['filename'] ?? null }} /extract:c:\updates /passive
@endforeach
</pre>
</div>

<div id="install{{$loop->index}}" title="install.cmd" hidden>
<pre>
cd /d %~dp0
@foreach ($item['kbs'] as $kb)
{{ $kb['items'][$bit]['filename'] ?? null }} /quiet /passive /norestart
@endforeach
</pre>
</div>

@endforeach



</body>
</html>
