@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="/save_task" method="post" id="task_form" name="task_form">
                        @csrf
                        <label>New Task</label>
                        <div class="input-group">
                            <input type="text" name="task_name" id="task_name" class="form-control" />
                            <button class="btn btn-primary" id="add_form" type="submit">Add</button>
                            <button class="btn btn-primary d-none" id="update_form" type="submit">Update</button>
                        </div>
                    </form>

                    <div id="show_data"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
        function load_data()
        {
            $.ajax({
                url: "/list",
                method: "GET",
                dataType: "json",
                success: function(response)
                {
                    $.each(response.task_title, function(index, value)
                    {
                        $('#show_data').append('<div class="card mt-3"><div class="card-body"><h5 class="card-title">'+value.task_title+'</h5><p class="card-text">'+value.created_at+'</p><button type="button" class="btn btn-sm btn-info px-3" onclick="edit_task('+value.id+')">Edit</button><button type="button" class="btn btn-sm btn-danger ms-2 px-3" onclick="delete_task('+value.id+')">Delete</button></div></div>');
                    });
                }
            });
        }
        load_data();

        function edit_task(id){
            $.ajax({
                url: "/edit/"+id,
                method: "GET",
                dataType: "json",
                success: function(response)
                {
                    $('#task_name').val(response.task_title.task_title);
                    $('#task_form').attr('action', '/update/'+id);
                    $('#add_form').addClass('d-none');
                    $('#update_form').removeClass('d-none');                    
                }
            });
        }

        function delete_task(id){
            $.ajax({
                url: "/delete/"+id,
                method: "GET",
                success: function(response)
                {
                    $('#show_data').html('');
                    load_data();
                }
            });
        }
</script>
@endsection

