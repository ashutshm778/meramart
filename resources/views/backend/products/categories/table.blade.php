<div class="card-body">
    <div id="items" class="todo-list" data-widget="todo-list" style="height:500px">
        <input type="hidden" id="type" @if(isset($type))value="{{$type}}"@endif>
        @foreach($list as $data)
            <div @if(isset($priority)) id="{{$data->$priority}}" @endif class="list-group-item" style="cursor: move;margin: 0 5px;">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>&nbsp
                {{$data->name}}
            </div>
        @endforeach
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Sortable/1.10.1/Sortable.min.js"></script>
<script>
    var originalList;
    var sortable = new Sortable(document.getElementById('items'),
    {
        onStart: function(evt)
        {
            originalList = [...document.querySelectorAll("#items > div")].map(el => el.id);
        },
        onEnd: function(evt)
        {
            var type = $('#type').val();
            $.get("{{route('admin.categorywise.priorty',['','',''])}}"+"/"+evt.oldIndex+"/"+evt.newIndex+"/"+type, function(data)
            {
                $('#table').html(data);
                toastr.success('Category Priority Updated Successfully!')
            });
        }
    });
</script>
