@extends('admin.layouts.admin', [
    'title' => 'عرض منتج',
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
                    عرض منتج : {{ $item->name }}
                </div>
            </div>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">المنتجات <i
                    class="fas fa-arrow-left-long"></i></a>
        </div>
        <div class="row g-3">
            <div class="col-12 col-md-4 col-lg-3">
                <div class="inp-holder">
                    <label class="special-input">
                        <span>الاسم</span>
                        <input type="text" name="name" disabled value="{{ $item->name }}" class="form-control">
                    </label>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <label class="special-input">
                    <span>القسم</span>
                    <select class="form-select" name="category_id" disabled>
                        <option value="{{ $item->category_id }}">{{ $item->category->name }}</option>
                    </select>
                </label>
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <label class="special-input">
                    <span>الحالة</span>
                    <select class="form-select" name="status" disabled>
                        <option>--- اختر ---</option>
                        @foreach (collect(\App\enums\Status::cases())->toArray() as $status)
                            <option value="{{ $status }}" @selected($item->status == $status)>
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
                        <input type="number" name="price" disabled value="{{ $item->price }}" class="form-control">
                    </label>
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-3">
                <div class="inp-holder">
                    <label class="special-input">
                        <span>تخفيض</span>
                        <input type="number" name="price_offer" disabled value="{{ $item->price_offer }}"
                            class="form-control">
                    </label>
                </div>
            </div>
            <div class="col-12 ">
                <div class="inp-holder">
                    <label class="special-label">
                        الوصف
                    </label>
                    <textarea name="description" disabled class="ckeditor form-control" rows="8">{{ $item->description }}</textarea>
                </div>
            </div>
            <div class="col-12 col-md-4 col-lg-3">
                <label class="special-input">
                    <span>الصوره الاساسية</span>
                    <img src="{{ display_file($item->main_image) }}" alt="" class="img-thumbnail img-preview"
                        width="60px">
                </label>
            </div>
            <div class="col-12 col-md-4 col-lg-3">
                <label class="special-input">
                    <span>الصور</span>
                    @forelse ($item->images as $image)
                        <img src="{{ display_file($image->path) }}" alt="" class="img-thumbnail img-preview"
                            width="60px">
                    @empty
                    @endforelse
                </label>
            </div>
            <div class="col-12 m-0">
                <hr class="m-0 border-0">
            </div>
        </div>
    </div>
@endsection
