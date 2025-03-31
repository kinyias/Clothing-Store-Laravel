@extends('layouts.app')

@section('content')
<style>
   .pt-90 {
      padding-top: 90px !important;
    }

    .pr-6px {
      padding-right: 6px;
      text-transform: uppercase;
    }

    .my-account .page-title {
      font-size: 1.5rem;
      font-weight: 700;
      text-transform: uppercase;
      margin-bottom: 40px;
      border-bottom: 1px solid;
      padding-bottom: 13px;
    }

    .my-account .wg-box {
      display: -webkit-box;
      display: -moz-box;
      display: -ms-flexbox;
      display: -webkit-flex;
      display: flex;
      padding: 24px;
      flex-direction: column;
      gap: 24px;
      border-radius: 12px;
      background: var(--White);
      box-shadow: 0px 4px 24px 2px rgba(20, 25, 38, 0.05);
    }

    .bg-success {
      background-color: #40c710 !important;
    }

    .bg-danger {
      background-color: #f44032 !important;
    }

    .bg-warning {
      background-color: #f5d700 !important;
      color: #000;
    }

    .table-transaction>tbody>tr:nth-of-type(odd) {
      --bs-table-accent-bg: #fff !important;

    }

    .table-transaction th,
    .table-transaction td {
      padding: 0.625rem 1.5rem .25rem !important;
      color: #000 !important;
    }

    .table> :not(caption)>tr>th {
      padding: 0.625rem 1.5rem .25rem !important;
      background-color: #6a6e51 !important;
    }

    .table-bordered>:not(caption)>*>* {
      border-width: inherit;
      line-height: 32px;
      font-size: 14px;
      border: 1px solid #e1e1e1;
      vertical-align: middle;
    }

    .table-striped .image {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 50px;
      height: 50px;
      flex-shrink: 0;
      border-radius: 10px;
      overflow: hidden;
    }

    .table-striped td:nth-child(1) {
      min-width: 250px;
      padding-bottom: 7px;
    }

    .pname {
      display: flex;
      gap: 13px;
    }

    .table-bordered> :not(caption)>tr>th,
    .table-bordered> :not(caption)>tr>td {
      border-width: 1px 1px;
      border-color: #6a6e51;
    }
  </style>
<main class="pt-90" style="padding-top: 0px;">
    <div class="mb-4 pb-4"></div>
    <section class="my-account container">
        <h2 class="page-title">Chi tiết đơn hàng</h2>
        <div class="row">
            <div class="col-lg-2">
                @include('user.account-nav')
            </div>

            <div class="col-lg-10">
                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap">

                        <div class="row">
                            <div class="col-6">
                                <h5>Chi tiết đơn hàng</h5>
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-sm btn-danger" href="{{route('user.orders')}}">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID đơn hàng</th>
                                    <td>{{$order->id}}</td>
                                    <th>Điện thoại</th>
                                    <td>{{$order->phone}}</td>
                                    <th>Zip code</th>
                                    <td>{{$order->zip}}</td>
                                </tr>
                                <tr>
                                    <th>Ngày đặt</th>
                                    <td>{{$order->created_at}}</td>
                                    <th>Ngày giao hàng</th>
                                    <td>{{$order->delivered_date}}</td>
                                    <th>Ngày huỷ đơn</th>
                                    <td>{{$order->cancaled_date}}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td colspan="5">
                                        @if($order->status == 'delivered')
                                            <span class="badge bg-success">Đã giao</span>
                                        @elseif($order->status == 'canceled')
                                            <span class="badge bg-danger">Đã huỷ</span>
                                        @else
                                        <span class="badge bg-warning">Đã đặt</span>
                                        @endif
                                    </td>
                                </tr>
                            </thead>
                        </table>
                    </div>
                    </div>
                </div>
                <div class="wg-box">
                    <div class="flex items-center justify-between gap10 flex-wrap">
                        <div class="wg-filter flex-grow">
                            <h5>Ordered Items</h5>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên</th>
                                    <th class="text-center">Giá</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-center">Đơn vị</th>
                                    <th class="text-center">Danh mục</th>
                                    <th class="text-center">Thương hiệu</th>
                                    <th class="text-center">Ghi chú</th>
                                    <th class="text-center">Hoàn trả</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($orderItems as $item)

                                <tr>
                                    <td class="pname">
                                        <div class="image">
                                            <img src="{{asset('uploads/products/thumbnails')}}/{{$item->product->image}}" alt="{{$item->product->name}}" class="image">
                                        </div>
                                        <div class="name">
                                            <a href="{{route('shop.product.details', ['product_slug'=>$item->product->slug])}}" target="_blank"
                                            class="body-title-2">{{$item->product->name}}</a>
                                        </div>
                                    </td>
                                    <td class="text-center">{{$item->price}}</td>
                                    <td class="text-center">{{$item->quantity}}</td>
                                    <td class="text-center">{{$item->product->category->name}}</td>
                                    <td class="text-center">{{$item->product->brand->name}}</td>
                                    <td class="text-center">{{$item->options}}</td>
                                    <td class="text-center">{{$item->rstatus == 0 ? 'Không':"Có"}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                        {{$orderItems->links('pagination::bootstrap-5')}}
                    </div>
                </div>

                <div class="wg-box mt-5">
                    <h5>Địa chỉ giao hàng</h5>
                    <div class="my-account__address-item col-md-6">
                        <div class="my-account__address-item__detail">
                            <p>{{$order->name}}</p>
                            <p>{{$order->address}}</p>
                            <p>{{$order->locality}}</p>
                            <p>{{$order->city}}, {{$order->country}}</p>
                            <p>{{$order->landmark}}</p>
                            <p>{{$order->zip}}</p>
                            <br>
                            <p>Điện thoại : {{$order->phone}}</p>
                        </div>
                    </div>
                </div>

                <div class="wg-box mt-5">
                    <h5>Thanh toán</h5>
                    <table class="table table-striped table-bordered table-transaction">
                        <tbody>
                            <tr>
                                <th>Tạm tính</th>
                                <td>{{$order->subtotal}}</td>
                                <th>Thuế</th>
                                <td>{{$order->tax}}</td>
                                <th>Giảm giá</th>
                                <td>{{$order->discount}}</td>
                            </tr>
                            <tr>
                                <th>Tổng cộng</th>
                                <td>{{$order->total}}</td>
                                <th>Phương thức thanh toán</th>
                                <td>{{$order->transaction->mode}}</td>
                                <th>Trạng thái</th>
                                <td>
                                    @if($transaction->status == 'approved')
                                        <span class="badge bg-success">Chấp nhận</span>
                                    @elseif($transaction->status == 'declinded')
                                        <span class="badge bg-danger">Từ chối</span>
                                    @elseif($transaction->status == 'refuned')
                                        <span class="badge bg-secondary">Hoàn trả</span>
                                    @else
                                        <span class="badge bg-warning">Đang chờ</span>
                                    @endif
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</main>
@endsection
