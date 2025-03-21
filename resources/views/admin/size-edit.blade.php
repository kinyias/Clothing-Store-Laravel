@extends('layouts.admin')
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Edit Size</h3>
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
                    <a href="{{route('admin.sizes')}}">
                        <div class="text-tiny">Sizes</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Edit Size</div>
                </li>
            </ul>
        </div>
        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{route('admin.size.update', ['id' => $size->id])}}" method="POST">
                @csrf
                @method('POST')
                <fieldset class="name">
                    <div class="body-title">Size Name <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Size name" name="name"
                        tabindex="0" value="{{$size->name}}" aria-required="true" required="">
                </fieldset>
                @error('name') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                <fieldset class="name">
                    <div class="body-title">Size Code <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Size Code (e.g., S, M, L)" name="code"
                        tabindex="0" value="{{$size->code}}" aria-required="true" required="">
                </fieldset>
                @error('code') <span class="alert alert-danger text-center">{{$message}}</span>@enderror
                <div class="bot">
                    <div></div>
                    <button class="tf-button w208" type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
