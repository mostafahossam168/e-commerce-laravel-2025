@extends('admin.layouts.admin', ['title' => 'تعديل مشرف'])
@section('content')
    <div class="main-side">
        <x-alert-admin />
        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
            <div class="main-title">
                <div class="small">
                    الرئيسية
                </div>
                <div class="large">
                    تعديل مشرف : {{ $item->name }}
                </div>
            </div>
            <a href="{{ route('admin.admins.index') }}" class="btn btn-secondary">المشرفيين <i
                    class="fas fa-arrow-left-long"></i></a>
        </div>
        <form action="{{ route('admin.admins.update', $item->id) }}" method="post" enctype="multipart/form-data">
            <div class="row g-3">
                @csrf
                @method('PUT')
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>الاسم</span>
                            <input type="text" name="name" value="{{ $item->name }}" class="form-control">
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>البريد الالكتروني</span>
                            <input type="email" name="email" value="{{ $item->email }}" class="form-control">
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>الهاتف</span>
                            <input type="text" name="phone" value="{{ $item->phone }}" class="form-control">
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <label class="special-input">
                        <span>الحالة</span>
                        <select class="form-select" name="status">
                            <option value="">--- اختر ---</option>
                            @foreach (collect(\App\enums\Status::cases())->toArray() as $status)
                                <option value="{{ $status }}" @selected($item->status == $status)>
                                    {{ $status->name() }}
                                </option>
                            @endforeach
                        </select>
                    </label>
                </div>

                <div class="col-12 col-md-6 col-lg-3">
                    <label class="special-input">
                        <span>الصلاحية</span>
                        <select class="form-select" name="role">
                            <option value="">--- اختر ---</option>
                            @foreach (Spatie\Permission\Models\Role::select('id', 'name')->get() as $role)
                                <option value="{{ $role->name }}" @selected($item->roles->first()?->pivot->role_id == $role->id)>
                                    {{ $role->name }}
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
                    <label class="special-input">
                        <span>الصوره </span>
                        <input class="form-control" name="image" type="file" accept="image/*">
                    </label>
                    @if ($item->image)
                        <img src="{{ display_file($item->image->path) }}" alt="" class="img-thumbnail img-preview"
                            width="60px">
                    @endif
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
