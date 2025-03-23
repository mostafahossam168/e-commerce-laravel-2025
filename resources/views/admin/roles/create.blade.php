@extends('admin.layouts.admin', [
    'title' => 'الصلاحيات',
])
@section('content')
    <div class="main-side">
        <div class="main-title">
            <div class="small">الرئيسية</div>
            <div class="large">الصلاحيات</div>
        </div>
        <x-alert-admin />


        <div class="row w-100 mx-0 p-3 mb-5 mt-5  bg-white">
            <a class="main-btn btn-main-color" href="{{ route('admin.roles.index') }}">عرض كل الصلاحيات</a>

            <form action="{{ route('admin.roles.store') }}" method="POST">
                @csrf

                <div class="col-md-12 mb-2">
                    <div class="form-group ">
                        <label for="" class="mb-2">الاسم</label>
                        <div class="d-flex">
                            <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                        </div>
                        @error('name')
                            <p class="text-danger" style="font-size: 12px">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-12">
                    <input type="checkbox" name="" id="select-all">
                    <label for="select-all">تحديد الكل </label>
                </div>
                <div class="table-responsive">
                    <table class="table-role table table-bordered">
                        @foreach ($permissions as $name => $model_permissions)
                            <tr>
                                <th> @lang($name) </th>
                                @foreach ($model_permissions as $model_permission)
                                    <td>
                                        <div class="toggle">
                                            <label class="switch">
                                                <input type="checkbox" name="permission[]" class='single-select'
                                                    value="{{ $model_permission . '_' . $name }}"
                                                    id="{{ $model_permission . '_' . $name }}">
                                                <span class="slider round"></span>
                                            </label>
                                            <label for="{{ $model_permission . '_' . $name }}"
                                                class='title'>{{ __($model_permission) }}</label>
                                        </div>
                                    </td>
                                @endforeach
                            </tr>
                        @endforeach
                    </table>
                </div>
                <div class="btn-holder mt-3 d-flex justify-content-end ">
                    <button type="submit" class="btn btn-primary">حفظ</button>
                </div>
            </form>

        </div>

    </div>

    <script>
        $(document).ready(function() {
            $("#select-all").click(function() {
                $(".single-select").attr('checked', this.checked);
            });
        });
    </script>
@endsection
