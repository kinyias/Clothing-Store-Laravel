@extends('layouts.admin')
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Variants</h3>
            <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                <li>
                    <a href="{{route('admin.index')}}">
                        <div class="text-tiny">Dashboard</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Variants</div>
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
                <div class="flex gap10">
                    <a class="tf-button style-1 w208" href="{{route('admin.color.add')}}"><i class="icon-plus"></i>Add Color</a>
                    <a class="tf-button style-1 w208" href="{{route('admin.size.add')}}"><i class="icon-plus"></i>Add Size</a>
                    <a class="tf-button style-1 w208" href="{{route('admin.material.add')}}"><i class="icon-plus"></i>Add Material</a>
                    <a class="tf-button style-1 w208" href="{{route('admin.variants.add')}}"><i class="icon-plus"></i>Add Variant</a>
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
                                <th>Product</th>
                                <th>Color</th>
                                <th>Size</th>
                                <th>Material</th>
                                <th>Regular Price</th>
                                <th>Sale Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($variants as $variant)
                            <tr>
                                <td>{{$variant->id}}</td>
                                <td>
                                    <div class="name">
                                        <a href="#" class="body-title-2">{{$variant->product->name}}</a>
                                    </div>
                                </td>
                                <td>
                                    @if($variant->color)
                                        <div style="width: 24px; height: 24px; background-color: {{$variant->color->code}};"></div>
                                        {{$variant->color->name}}
                                    @else
                                        N/A
                                    @endif
                                </td>
                                <td>{{$variant->size ? $variant->size->name : 'N/A'}}</td>
                                <td>{{$variant->material ? $variant->material->name : 'N/A'}}</td>
                                <td>${{$variant->regular_price ?? 'N/A'}}</td> 
                                <td>${{$variant->sale_price ?? 'N/A'}}</td>
                                <td>
                                    <div class="list-icon-function">
                                        <a href="{{route('admin.variants.edit',['id'=>$variant->id])}}">
                                            <div class="item edit">
                                                <i class="icon-edit-3"></i>
                                            </div>
                                        </a>
                                        <form action="{{route('admin.variants.delete',['id'=>$variant->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="item text-danger delete">
                                                <i class="icon-trash-2"></i>
                                            </div>
                                        </form>
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
                {{$variants->links('pagination::bootstrap-5')}}
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
                title: "Chắc chắn xoá?",
                text: "Bạn sẽ không thể khôi phục dữ liệu này",
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
