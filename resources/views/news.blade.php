@include('layouts.header')
<style>
a:hover {
    text-decoration: none;
}
</style>
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>News</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{route('add_news')}}" class="btn btn-info">Add News</a>
        </div>
    </div>

    <div class="container_fluid mt-2 px-3">
        <table class="table mt-2 table-responsive-sm">
            <thead>
                <tr>
                    <th width="2%">#</th>
                    <th width="10%">Image</th>
                    <th width="18%">News Title</th>
                    <th width="15%">Category</th>
                    <th width="20%">Author</th>
                    <th width="15%">Listed In</th>
                    <th width="10%">Posted On</th>
                    <th width="2%">Status</th>
                    <th width="8%">Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($news)<=0)
                <tr>
                    <td colspan="9" class="text-center"> No records found </td>
                </tr> 
                @endif
                @foreach($news as $newsDetails)
                    @php 
                        $selection_types = '';
                        $imgsrc = $newsDetails -> image;
                        $dateArray = json_decode(@$newsDetails->newsType,true);
                    @endphp
                    @foreach(config('constant.news_type') as $key=>$newstype)
                        @if (!empty($dateArray[$key]['start_date']) && !empty($dateArray[$key]['end_date']))
                            @php
                                $selection_types .= $newstype.', ';
                            @endphp                            
                        @endif                        
                    @endforeach
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>@if($imgsrc != null)<img src="{{asset('uploads/').'/'.$imgsrc}}" width="100">@endif</td>
                    <td>{{$newsDetails->title}}</td>
                    <td>{{$newsDetails->category}}</td>
                    <td>{{$newsDetails->author->name}}</td>
                    <td>
                        {{ rtrim( $selection_types, ', ') }}
                    </td>
                    <td>{{ $newsDetails->created_at }}</td>
                    <td align="center">
                        @if ($newsDetails->fld_status=='Active')
                            <a href="#" class="text-success"><span class="fa fa-check"></span></a>
                        @else
                            <a href="#" class="text-danger"><span class="fa fa-times"></span></a>
                        @endif
                    </td>
                    <td>
                        <a title="Edit" href="{{ route('add_news',$newsDetails->id)}}" class="text-success mr-2">
                            <span class="fa fa-edit fa-lg"></span>
                        </a> 
                        <a href="javascript:;" onclick="deleteNews('{{$newsDetails->id}}')" title="Delete" class="text-danger mr-2">
                            <span class="fa fa-trash-o fa-lg"></span>
                        </a> 
                        <a href="{{ route('news_detail',$newsDetails->id)}}" title="View Info." class="text-success fancybox fancybox.iframe" id="fancybox-manual-b" >
                            <span class="fa fa-eye fa-lg"></span>
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
    {{ $news->links('vendor.pagination.custom') }}
</div>
@include('layouts.footer')
<script>
    function deleteNews(id) {
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
                    url: "{{ url('delete_news') }}",
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