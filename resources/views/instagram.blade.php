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
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
     <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="shortcut icon" href="{{asset('public/favicon.ico')}}" type="image/x-icon">
</head>
<body>
    <h1 style="text-align: center;">List Unfollow IG</h1>
    <div style="padding: 25px 100px;">
        <table id="table" style="width: 100%;" class="table table-striped">
            <thead>
                <th style="width: 7%;">No</th>
                <th>Username</th>
                <th>Action</th>
            </thead>
            <tbody>
                @foreach($data as $key => $list)
                    <tr>
                        <td style="text-align: center;">{{$key+1}}</td>
                        <td><a href="https://www.instagram.com/{{$list}}" class="" target="_blank">{{$list}}</a></td>
                        <td style="text-align: center; width: 10%;"><input type="checkbox" name="akunHide[]" id="" value="{{$list}}" class="form-check-input acc"></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div style="text-align: right; margin-top: 25px;">
            <button class="btn btn-success" id="tandai" type="button"><i class="bi bi-bookmark-check-fill"></i> Tandai atau Lepas Semua</button>
            <button class="btn btn-primary" id="save"><i class="bi bi-floppy"></i> Save</button>
        </div>
    </div>

    <script>
        let data = []

        $(document).ready(()=>{
            let initTandai = false

            $('#table').DataTable({
                lengthMenu: [ [7, 10, 12, 25, 50, 100, -1], [7, 10, 12, 25, 50, 100, "All"] ]
            })


            $('table').on('change', '.acc', function(){
                let val = $(this).val()
                let idx = data.indexOf(val)
                if(this.checked){                    
                    idx < 0 ? data.push(val) : false
                }
                else{
                    idx >= 0 ? data.splice(idx, 1) : false
                }
            })

            $('#save').click(function(){
                swal.fire({
                    title : 'Info',
                    text : 'Are you sure to save this data ?',
                    showCancelButton : true,
                    cancelButtonColor: "#d33",
                    icon : 'question'
                }).then((res)=>{
                    if(res.isConfirmed){
                        $.ajax({
                            url : `{{route('ig.save')}}`,
                            method : 'post',
                            data : {
                                _token : `{{csrf_token()}}`,
                                account : data
                            },
                            success : (result)=>{
                                if(result.result){
                                    swal.fire('Success', result.message, 'success')
                                }
                                else{
                                    swal.fire('Error', result.message, 'error')
                                }
                            },
                            error(){
                                swal.fire('Error', 'Something went wrong :(', 'error')
                            }
                        })
                    }                    
                })
            })

            $('#tandai').click(()=>{
                $('table .acc').each((k, v)=>{
                    v.checked = !initTandai
                    $(v).trigger('change')
                })
                initTandai = !initTandai
            })
        })
    </script>
</body>
</html>