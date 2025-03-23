@extends('admin.layouts.admin', ['title' => 'اضافة منتج'])
@section('content')
    <div class="main-side">
        <x-alert-admin />

        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
            <div class="main-title">
                <div class="small">
                    الرئيسية
                </div>
                <div class="large">
                    اضافة منتج
                </div>
            </div>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">المنتجات <i
                    class="fas fa-arrow-left-long"></i></a>
        </div>

        <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
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
                    <label class="special-input">
                        <span>الصوره الاساسية</span>
                        <input class="form-control" name="main_image" type="file" accept="image/*">
                    </label>
                </div>
                <div class="col-12 col-md-6 col-lg-3">
                    <label class="special-input">
                        <span>القسم</span>
                        <select class="form-select" name="category_id">
                            <option value="">--- اختر ---</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </label>
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

                <div class="col-12 m-0">
                    <hr class="m-0 border-0">
                </div>

                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>السعر</span>
                            <input type="number" name="price" value="{{ old('price') }}" class="form-control">
                        </label>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3">
                    <div class="inp-holder">
                        <label class="special-input">
                            <span>تخفيض</span>
                            <input type="number" name="price_offer" value="{{ old('price_offer', 0) }}"
                                class="form-control">
                        </label>
                    </div>
                </div>

                <div class="col-12 col-md-4 col-lg-3">
                    <label class="special-input">
                        <span>الصور</span>
                        <input class="form-control" name="images[]" type="file" multiple accept="image/*">
                    </label>
                </div>

                <div class="col-12 ">
                    <div class="inp-holder">
                        <label class="special-label">
                            الوصف
                        </label>
                        <textarea name="description" class="ckeditor form-control" rows="8">{{ old('description') }}</textarea>
                    </div>
                </div>
                <div class="col-12 m-0">
                    <hr class="m-0 border-0">
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
