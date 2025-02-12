<ul class="account-nav">
    <li><a href="{{route('user.index')}}" class="menu-link menu-link_us-s">Tổng quan</a></li>
    <li><a href="account-orders.html" class="menu-link menu-link_us-s">Đơn hàng</a></li>
    <li><a href="account-address.html" class="menu-link menu-link_us-s">Địa chỉ</a></li>
    <li><a href="account-details.html" class="menu-link menu-link_us-s">Chi tiết tài khoản</a></li>
    <li>
    <form method="POST" action="{{route('logout')}}" id="logout-form">
        @csrf
        <a href="{{route('logout')}}" class="" onclick="event.preventDefault();document.getElementById('logout-form').submit()">Đăng xuất</a>
    </form>
</li>
</ul>