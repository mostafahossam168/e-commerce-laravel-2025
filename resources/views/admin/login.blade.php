<!DOCTYPE html>
<html lang="ar" dir="rtl">

@include('admin.layouts.parts.head')

<body>
    <!-- Start layout -->
    <section class="login_page">
        <div class="box-col d-flex flex-column justify-content-center py-xl-0">
            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form action="{{ route('admin.login.post') }}" method="POST" class="form_content">
                @csrf
                <img src="{{ asset('admin-asset') }}/img/login/logo-icon.png" alt="logo" class="logo-form" />
                <h3 class="header_title">
                    <div class="title">مرحبا بك</div>
                    <div class="text">أدخل البريد الالكتروني وكلمة السر للدخول</div>
                </h3>
                <div class="row gap-3">
                    <div class="col-12">
                        <label for="" class="label">البريد الالكتروني</label>
                        <div class="group-inp">
                            <input type="email" placeholder="name@company.com" name="email" class="inp">
                            <div class="box">
                                <img src="{{ asset('admin-asset') }}/img/login/sms.svg" class="icon" alt="">
                            </div>
                        </div>
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-12 mb-4">
                        <label for="" class="label">كلمة السر</label>
                        <div class="group-inp">
                            <input type="password" placeholder="أدخل كلمة المرور" name="password" class="inp inp-pass">
                            <div class="box box-btn" onclick="showPsss('.inp-pass')">
                                <img src="{{ asset('admin-asset') }}/img/login/eye.svg" class="icon" alt="">
                            </div>
                        </div>
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-12 mb-4 d-flex align-items-center justify-content-between">
                        <div class="d-flex align-items-center gap-2">
                            <input type="checkbox" name="" id="">
                            تذكرني دائما
                        </div>
                        <a href="" class="reseat">نسيت كلمة المرور؟</a>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="sub_btn btn btn-primary w-100">دخول</button>
                    </div>
                </div>
            </form>
        </div>
        <div
            class="box-col box-bg d-flex flex-column justify-content-between align-items-center gap-5 align-items-xl-start">
            <img src="{{ asset('admin-asset') }}/img/login/login-bg.svg" alt="img-bg" class="bg" />
            <span class="logo-holder">
                <img src="{{ asset('admin-asset/img/login/footer-logo.png') }}" alt="" class="logo-bg">
                كوكبة التقنية
            </span>
            <div class="text-bg">
                <div class="title">
                    كوكبة التقنية
                </div>
                <div class="p">
                    خدمات مميزة وتجربة جديدة
                </div>
            </div>
            <div class="text-bg-2">
                بدئنا من حيث أنتهى الآخرون
            </div>
        </div>


    </section>
    <!-- End layout -->

    @include('admin.layouts.parts.footer')
</body>

</html>
