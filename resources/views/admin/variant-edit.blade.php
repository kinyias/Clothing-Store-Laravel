@extends('layouts.admin')
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Edit Variant</h3>
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
                    <a href="{{route('admin.variants')}}">
                        <div class="text-tiny">Variants</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Edit Variant</div>
                </li>
            </ul>
        </div>
        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{route('admin.variants.update', ['id' => $variant->id])}}" method="POST">
                @csrf
                @method('POST')
                <fieldset class="name">
                    <div class="body-title">Product <span class="tf-color-1">*</span></div>
                    <select name="product_id" class="flex-grow" required>
                        <option value="">Select Product</option>
                        @foreach($products as $product)
                            <option value="{{$product->id}}" {{ $variant->product_id == $product->id ? 'selected' : '' }}>{{$product->name}}</option>
                        @endforeach
                    </select>
                </fieldset>
                @error('product_id') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                <fieldset class="name">
                    <div class="body-title">Color</div>
                    <select name="color_id" class="flex-grow">
                        <option value="">Select Color</option>
                        @foreach($colors as $color)
                            <option value="{{$color->id}}" {{ $variant->color_id == $color->id ? 'selected' : '' }}>{{$color->name}}</option>
                        @endforeach
                    </select>
                </fieldset>
                @error('color_id') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                <fieldset class="name">
                    <div class="body-title">Size</div>
                    <select name="size_id" class="flex-grow">
                        <option value="">Select Size</option>
                        @foreach($sizes as $size)
                            <option value="{{$size->id}}" {{ $variant->size_id == $size->id ? 'selected' : '' }}>{{$size->name}}</option>
                        @endforeach
                    </select>
                </fieldset>
                @error('size_id') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                <fieldset class="name">
                    <div class="body-title">Material</div>
                    <select name="material_id" class="flex-grow">
                        <option value="">Select Material</option>
                        @foreach($materials as $material)
                            <option value="{{$material->id}}" {{ $variant->material_id == $material->id ? 'selected' : '' }}>{{$material->name}}</option>
                        @endforeach
                    </select>
                </fieldset>
                @error('material_id') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                <fieldset class="name">
                    <div class="body-title">Variant Name</div>
                    <input class="flex-grow" type="text" placeholder="Variant name" name="name"
                        tabindex="0" value="{{$variant->name ?? ''}}">
                </fieldset>
                @error('name') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
