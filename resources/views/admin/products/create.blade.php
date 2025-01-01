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
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">المنتجات<i
                    class="fas fa-arrow-left-long"></i></a>
        </div>

        <div class="row g-3">
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
                    <span>@lang('Image')</span>
                    <input class="form-control" wire:model="image" type="file" accept="image/*">
                </label>
            </div>
            <div class="col-12 m-0">
                <hr class="m-0 border-0">
            </div>
            <div class="col-12 col-md-6 col-lg-3">
                <label class="special-input">
                    <span>@lang('Category')</span>
                    <select class="form-select" wire:model="category_id">
                        <option>---@lang('Select category') ---</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </label>
            </div>

            <div class="col-12 col-md-8 col-lg-6">
                <div class="inp-holder">
                    <label class="special-label">
                        الوصف
                    </label>
                    <textarea name="description" class="ckeditor form-control" rows="4">{{ old('description') }}</textarea>
                </div>
            </div>
            <div class="col-12 m-0">
                <hr class="m-0 border-0">
            </div>

            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <div class="btn-holder mt-2">
                    <button wire:click="submit" class="main-btn">@lang('Save')</button>
                </div>
            </div>
        </div>
    </div>
@endsection
