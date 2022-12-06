@include('layouts.header')
<style>
a:hover {
    text-decoration: none;
}
</style>
<div class="main my-0">
    <div class="row mt-3 mx-0">
        <div class="col-md-6">
            <h3>Drop Management</h3>
        </div>
        <div class="col-md-6 text-right">
            <a href="{{route('add_dropManagement')}}" class="btn btn-info">Add Drop Management</a>
        </div>
    </div>

    <div class="container_fluid mt-2 px-3">
        <table class="table mt-2 table-responsive-sm">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Token</th>
                    <th>Block-Chain</th>
                    <th>Price Of Sale</th>
                    <th>Sale Date</th>
                    <!-- <th>Discord Link</th>
                    <th>Twitter Link</th>
                    <th>Website Link</th> -->
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @if (count($dropManagement)<=0)
                <tr>
                    <td colspan="11" class="text-center"> No records found </td>
                </tr> 
                @endif
                @foreach($dropManagement as $dropManagementDetails)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td>{{$dropManagementDetails->name}}</td>
                    <td>{{$dropManagementDetails->category}}</td>
                    <td>{{$dropManagementDetails->token}}</td>
                    <td>{{$dropManagementDetails->blockChain}}</td>
                    <td>{{$dropManagementDetails->priceOfSale}}</td>
                    <td>{{$dropManagementDetails->saleDate}}</td>
                    <!-- <td>{{$dropManagementDetails->discordLink}}</td>
                    <td>{{$dropManagementDetails->twitterLink}}</td>
                    <td>{{$dropManagementDetails->websiteLink}}</td> -->
                    <td>
                        <a title="Edit" href="{{ route('add_dropManagement',$dropManagementDetails->id)}}" class="text-success mr-2">
                            <span class="fa fa-edit fa-lg"></span>
                        </a> 
                        <a href="javascript:;" onclick="deleteNews('{{$dropManagementDetails->id}}')" title="Delete" class="text-danger mr-2">
                            <span class="fa fa-trash-o fa-lg"></span>
                        </a> 
                        <!-- <a href="{{ route('news_detail',$dropManagementDetails->id)}}" title="View Info." class="text-success fancybox fancybox.iframe" id="fancybox-manual-b" >
                            <span class="fa fa-eye fa-lg"></span>
                        </a> -->
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="clearfix"></div>
    </div>
    {{ $dropManagement->links('vendor.pagination.custom') }}
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
                    url: "{{ url('delete_dropManagement') }}",
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