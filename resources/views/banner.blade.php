@include('layouts.header')
<style>
a:hover {
    text-decoration: none;
}
</style>
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>Banner</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{ route('add_banner') }}" class="btn btn-info">Add Banner</a>
        </div>
    </div>

    <div class="container_fluid mt-2 px-3">
        {{ $data->links('vendor.pagination.custom') }}
        <table class="table mt-2 table-responsive-sm">
            <thead>
                <tr>
                    <th width="2%">#</th>
                    <th width="10%">Image</th>
                    <th width="74%">Size</th>
                    <th width="4%">URL</th>
                    <th width="10%">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($data)<=0)
                <tr>
                    <td colspan="7" class="text-center"> No records found </td>
                </tr> 
                @endif
                @foreach($data as $row)
                    @php 
                        $selection_types = '';
                        $imgsrc = $row->image;
                    @endphp
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>@if($imgsrc != null)<img src="{{asset('uploads/banner/').'/'.$imgsrc}}" width="100">@endif</td>
                    <td>{{$row->size}}</td>
                    <td><a href="{{$row->url}}" class="btn btn-primary" target="_blank">VIEW URL</a></td>
                    <td>
                        <a title="Edit" href="{{ route('add_banner',$row->id)}}" class="text-success mr-2">
                            <span class="fa fa-edit fa-lg"></span>
                        </a> 
                        <a title="Delete" href="javascript:;" onclick="deleteBanner('{{$row->id}}')" class="text-danger mr-2">
                            <span class="fa fa-trash-o fa-lg"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
    {{ $data->links('vendor.pagination.custom') }}
</div>
@include('layouts.footer')
<script>
    function deleteBanner(id) {
        swal({
            title: "Warning!",
            text: "Are you sure? You want to delete it",
            icon: "warning",
            buttons: ['No,cancel it','Yes,delete it'],
        }).then(function(isConfirm) {
            if (isConfirm) {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "{{ url('delete_banner') }}",
                    type: "POST",
                    data: {
                        id: id
                    },
                    success: function(result) {
                        var data = JSON.parse(result);
                        if (data.success) {
                            swal({
                                title: "Success!",
                                text: data.message + " :)",
                                icon: "success",
                                buttons: 'OK'
                            }).then(function(isConfirm) {
                                if (isConfirm) {
                                    location.reload();
                                }
                            });
                        }
                    },
                    error: function(xhr, status, error) {}
                });
            }
        });
    }
</script>