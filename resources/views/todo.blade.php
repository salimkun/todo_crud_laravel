<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <title>Todo CRUD Laravel </title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>
  </head>
  <body>
    <div class="container">
        @if (empty($todoedit))
        <h2>Todo List Menu</h2><br/>
        <form method="post" action="{{url('todo')}}" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-12"></div>
                <div class="form-group col-md-4">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"></div>
                <div class="form-group col-md-4" style="margin-top:10px">
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </form>
        @else
        <h2>Edit todo List</h2><br/>
        <form method="post" action="{{action('TodoController@update', $todoedit['id'])}}">
            @csrf
            <input name="_method" type="hidden" value="PATCH">
            <div class="row">
                <div class="col-md-12"></div>
                <div class="form-group col-md-4">
                    <label for="title">Title:</label>
                    <input type="text" class="form-control" name="title" value="{{$todoedit['title']}}">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12"></div>
                <div class="form-group col-md-3" style="margin-top:10px">
                    <button type="submit" class="btn btn-success">Update</button>
                </div>
                <div class="form-group col-md-3" style="margin-top:10px">
                    <a href="{{url('todo')}}"class="btn btn-danger">
                        Cancel
                    </a>
                </div>
            </div>
        </form>
        @endif

        @if (!empty($todolist))
        <div>
            @if (\Session::has('success'))
            <div class="alert alert-success">
                <p>{{ \Session::get('success') }}</p>
            </div><br />
            @endif
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $id = 1
                    @endphp
                    @foreach($todolist as $todo)
                    <tr>
                        <td>{{$id}}</td>
                        <td>{{$todo['title']}}</td>
                
                        <td align="right">
                            <a href="{{action('TodoController@edit', $todo['id'])}}" 
                                class="btn btn-warning">
                                <span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
                            </a>
                        </td>
                        <td align="left">
                            <a href="{{action('TodoController@destroy', $todo['id'])}}" 
                                class="btn btn-danger">
                                <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                            </a>
                        </td>
                    </tr>
                    @php
                        $id++ 
                    @endphp                    
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
  </body>
</html>
