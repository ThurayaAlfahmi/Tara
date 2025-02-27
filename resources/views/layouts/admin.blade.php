<!DOCTYPE html>
<html lang="ar" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'لوحة تحكم المشرف')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div class="d-flex">
        <!-- الشريط الجانبي -->
        <div class="sidebar text-white">
            <h3>لوحة التحكم</h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="{{ route('admin.index') }}" class="nav-link text-white">الرئيسية</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.cars.index') }}" class="nav-link text-white">إدارة السيارات</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.location.index') }}" class="nav-link text-white">إدارة المواقع</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('bookings.index') }}" class="nav-link text-white">الحجوزات</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.payments.index') }}" class="nav-link text-white">المدفوعات</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('logout') }}" class="nav-link text-white" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">تسجيل الخروج</a>
                </li>
            </ul>
        </div>

        <!-- المحتوى الرئيسي -->
        <div class="main-content">
            

            <div class="container mt-4">
                @yield('content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>
</body>
</html>