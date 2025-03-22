<!DOCTYPE html>
<html lang="ar" dir="rtl">

@include('admin.layouts.parts.head')

<body>
    <!-- Start layout -->
    @include('admin.layouts.parts.navbar')
    <div class="app">
        @include('admin.layouts.parts.sidebar')
        @yield('content')
        <footer class="main-footer">
            جميع الحقوق محفوظة لـ <a href="https://www.const-tech.org/">كوكبة التقنية</a> . © {{ date('Y') }}
        </footer>
    </div>
    <!-- End layout -->
    <!-- Js Files -->
    @include('admin.layouts.parts.footer')
</body>

</html>
