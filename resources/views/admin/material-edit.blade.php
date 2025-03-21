@extends('layouts.admin')
@section('content')
<div class="main-content-inner">
    <div class="main-content-wrap">
        <div class="flex items-center flex-wrap justify-between gap20 mb-27">
            <h3>Edit Material</h3>
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
                    <a href="{{route('admin.materials')}}">
                        <div class="text-tiny">Materials</div>
                    </a>
                </li>
                <li>
                    <i class="icon-chevron-right"></i>
                </li>
                <li>
                    <div class="text-tiny">Edit Material</div>
                </li>
            </ul>
        </div>
        <div class="wg-box">
            <form class="form-new-product form-style-1" action="{{route('admin.material.update', ['id' => $material->id])}}" method="POST">
                @csrf
                @method('POST')
                <fieldset class="name">
                    <div class="body-title">Material Name <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Material name" name="name"
                        tabindex="0" value="{{$material->name}}" aria-required="true" required="">
                </fieldset>
                @error('name') <span class="alert alert-danger text-center">{{$message}}</span> @enderror
                <fieldset class="name">
                    <div class="body-title">Material Code <span class="tf-color-1">*</span></div>
                    <input class="flex-grow" type="text" placeholder="Material Code (e.g., cotton, polyester)" name="code"
                        tabindex="0" value="{{$material->code}}" aria-required="true" required="">
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
