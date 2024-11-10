<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IG</title>
    <link rel="stylesheet" href="{{url('node_modules\bootstrap\dist\css\bootstrap.css')}}">
    <script src="{{url('node_modules\bootstrap\dist\js\bootstrap.js')}}"></script>

    <script src="{{url('node_modules\jquery\dist\jquery.js')}}"></script>

    <!-- select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- datatable -->
     <!-- <script src="{{url('node_modules\datatables.net-dt\js\dataTables.dataTables.js')}}"></script>
     <link rel="stylesheet" href="{{url('node_modules\datatables.net-dt\css\dataTables.dataTables.css')}}">

     <script src="{{url('node_modules\datatables.net\js\dataTables.js')}}"></script> -->

     <style>
        table th{
            text-align: center !important;
        }
     </style>
     <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
     <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css">
     <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>
</head>
<body>
    <h1 style="text-align: center;">List Unfollow IG</h1>
    <div style="padding: 25px 100px;">
        <table id="table" style="width: 100%;" class="table table-striped">
            <thead>
                <th style="width: 7%;">No</th>
                <th>Username</th>
            </thead>
            <tbody>
                @foreach($data as $key => $list)
                    <tr>
                        <td style="text-align: center;">{{$key+1}}</td>
                        <td>{{$list}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(()=>{
            $('#table').DataTable({
                lengthMenu: [ [7, 10, 12, 25, 50, 100, -1], [7, 10, 12, 25, 50, 100, "All"] ]
            })
        })
    </script>
</body>
</html>