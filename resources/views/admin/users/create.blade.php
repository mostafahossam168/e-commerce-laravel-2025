@extends('admin.layouts.admin', [
    'title' => 'اضافة عميل',
])
@section('content')
    <div class="main-side">
        <x-alert-admin />

        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
            <div class="main-title">
                <div class="small">
                    الرئيسية
                </div>
                <div class="large">
                    اضافة عميل
                </div>
            </div>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">العملاء <i
                    class="fas fa-arrow-left-long"></i></a>
        </div>

        <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                @csrf
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>الاسم</span>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>البريد الالكتروني</span>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>الهاتف</span>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <label class="special-input">
                        <span>الحالة</span>
                        <select class="form-select" name="status">
                            <option value="">--- اختر ---</option>
                            @foreach (collect(\App\enums\Status::cases())->toArray() as $status)
                                <option value="{{ $status }}" @selected(old('status') == $status)>
                                    {{ $status->name() }}
                                </option>
                            @endforeach
                        </select>
                    </label>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>الباسورد</span>
                            <input type="password" name="password" class="form-control">
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>تاكيد الباسورد</span>
                            <input type="password" name="password_confirmation" class="form-control">
                        </label>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-input">
                        <span>الصوره </span>
                        <input class="form-control" name="image" type="file" accept="image/*">
                    </label>
                </div>
                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                    <div class="btn-holder mt-2">
                        <button type="submit" class="main-btn">@lang('Save')</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
