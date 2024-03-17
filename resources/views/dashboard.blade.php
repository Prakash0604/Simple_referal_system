@extends('layout.dashboard')
@section('content')
<div class="container">
         <h6 style="cursor: pointer" class="copy" data-code="{{ Auth::user()->referal_code }}"><span class="fa fa-copy mr-1"></span>Copy Referal Link</h6>
        <h1 class="mb-4" style="float: left">Dashboard</h1>
        <h1 class="mb-4" style="float: right">{{ $networks*10 }} Points</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>S.No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Verified</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $n=1;
                @endphp
                @if (count($networkdata) >0)
                @foreach ($networkdata as $data)    
                <tr>
                    <td>{{ $n }}</td>
                    <td>{{ $data->user->name }}</td>
                    <td>{{ $data->user->email }}</td>
                    <td>
                        @if($data->user->is_verified!=1)
                        <span class="badge badge-pill bg-danger">No verified</span>
                        @else
                        <span class="badge badge-pill bg-success">Veified</span>
                        @endif
                    </td>
                </tr>
                @php
                    $n=$n+1;
                @endphp
                @endforeach
                @else
                <tr>
                    <th colspan="4" class="text-center">No data found</th>
                </tr>
                @endif
            </tbody>
        </table>
        <script>
            $(document).ready(function(){
                $('.copy').click(function(){
                    $(this).parent().prepend('<span class="copied_text">Copied</span>');
                    var code=$(this).attr('data-code');
                    var url="{{ URL::to('/') }}/referal-code?ref="+code;
                    var $temp=$("<input>");
                    $("body").append($temp);
                    $temp.val(url).select();
                    document.execCommand("copy");
                    $temp.remove();
                    setTimeout(() => {
                        $('.copied_text').remove();
                    }, 2000);
                });

            });
        </script>
</div>
    
@endsection