<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>To Do - Laravel Ajax</title>
    <link rel="stylesheet" href="{{asset('inc/css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('inc/css/bootstrap-theme.css')}}">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</head>
<body>
<br>
<div class="container">
    <div class="row">
        <div class="col-lg-offset-2 col-lg-8 col-of">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Ajax Todo List <a href="" data-toggle="modal" id="addNew" data-target="#myModal" class="pull-right"><p><i class="fa fa-plus"></i></p></a> </h3>
                </div>
                <div class="panel-body" id="items">
                    <ul class="list-group">
                        @foreach($items as $item)
                            <li class="list-group-item ourItem" data-toggle="modal" data-target="#myModal" >{{$item->item}}
                                <input type="hidden" id="itemId" value="{{$item->id}}">
                            </li>

                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="title"></h4>
                    </div>
                    <div class="modal-body">
                        <p>
                            <input type="text" class="form-control" placeholder="Enter To Do Here" id="addItem" name="text">
                            <input type="hidden" id="id">
                        </p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-warning" id="delete" data-dismiss="modal" >Delete</button>
                        <button type="button" class="btn btn-info" id="saveChanges" >Save changes</button>
                        <button type="button" class="btn btn-primary" id="addButton">Add Item</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div>
    </div>
    {{csrf_field()}}
</div>


    <script src="{{asset('inc/js/jquery-3.2.1.js')}}"></script>
    <script src="{{asset('inc/js/bootstrap.js')}}"></script>
    <script>
        $(document).ready(function () {
            $(document).on('click','.ourItem',function (event) {
                var id = $(this).find('#itemId').val();
                $('#title').text("Edit Item");
                var text  = $(this).text();
                $('#addItem').val(text);
                $('#addButton').hide();
                $('#delete').show();
                $('#saveChanges').show();
                $('#id').val(id);
            });
            $(document).on('click','#addNew',function (event) {
                $('#title').text('Add New Item');
                $('#delete').hide();
                $('#saveChanges').hide();
                $('#addButton').show();
                $('#addItem').val("");
            });


           $('#addButton').click(function (event) {
                var text = $('#addItem').val();
                $.post('list',{"text": text,'_token': $('input[name=_token]').val()},function (data) {
                    $('#myModal').modal('hide');
                    $('#items').load(location.href + ' #items');

                });
           });
            $('#delete').click(function (event) {
                var id = $('#id').val();
                $.post('delete',{'id':id,'_token': $('input[name=_token]').val()},function (data) {
                    $('#items').load(location.href + ' #items');
                    $('#myModal').modal('hide');
                });
            });
        });
    </script>
</body>
</html>
