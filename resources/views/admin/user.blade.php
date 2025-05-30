@extends('layouts.admin')
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Users</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="index.html">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">All User</div>
                </li>
            </ul>
        </div>

        <div class="wg-box">
            <div class="flex items-center justify-between gap10 flex-wrap">
                <div class="wg-filter flex-grow">
                    <form class="form-search">
                        <fieldset class="name">
                            <input type="text" placeholder="Search here..." class="" name="name"
                                tabindex="2" value="" aria-required="true" required="">
                        </fieldset>
                        <div class="button-submit">
                            <button class="" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
                
            </div>
            <div class="wg-table table-all-user">

                <div class="table-responsive">
                    @if(Session::has('status'))
                    <p class="alert alert-success">{{Session::get('status')}}</p>
                @endif
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>User</th>
                                <th>Phone</th>
                                <th>Email</th>
                                {{-- <th class="text-center">Total Orders</th> --}}
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $u)
                            <tr>
                                <td>{{$u->id}}</td>
                                <td class="pname">
                                    {{-- <div class="image">
                                        <img src="user-1.html" alt="" class="image">
                                    </div> --}}
                                    <div class="name">
                                        <a href="#" class="body-title-2">{{$u->name}}</a>
                                        <div class="text-tiny mt-3">{{$u->utype}}</div>
                                    </div>
                                </td>
                                <td>{{$u->mobile}}</td>
                                <td>{{$u->email}}</td>
                                {{-- <td class="text-center"><a href="#" target="_blank">0</a></td> --}}
                                <td>
                                    <div class="list-icon-function">
                                        <a href="#">
                                            <div class="item edit">
                                                <i class="icon-edit-3"></i>
                                            </div>
                                        </a>
                                        @if ($u->utype == 'AGENCY' && $u->agency_status == 'pending')
                                       
                                        <form action="{{route('admin.agency.store')}}" method="POST">
                                            @csrf
                                            @method('POST')
                                            <div class="item edit delete">
                                                <input type="hidden" name="id" value="{{$u->id}}">
                                                    <div class="item edit">
                                                        Duyệt tài khoản
                                                    </div>
                                            </div>
                                        </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="divider"></div>
            <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    $(function(){
        $('.delete').on('click', function(e){
            e.preventDefault();
            var form = $(this).closest('form');
            swal({
                title: "Bạn có muốn duyệt tài khoản agency?",
                text: "Chắc chắn duyệt tài khoản này?",
                type:"warning",
                buttons:["Không","Có"],
                confirmButtonColor:'#dc3545',
            }).then(function(result){
                if(result){
                    form.submit();
                }
            })
        })
    })
</script>
@endpush