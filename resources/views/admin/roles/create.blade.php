@extends('admin.layouts.admin')
@section('title', 'الصلاحيات')
@section('content')
    <div class="main-side">
        <div class="main-title">
            <div class="small">الرئيسية</div>
            <div class="large">الصلاحيات</div>
        </div>
        <x-alert-admin />


        <div class="row w-100 mx-0 p-3 mb-5 mt-5  bg-white">
            <a class="main-btn btn-main-color" href="{{ route('admin.roles.index') }}">عرض كل الصلاحيات</a>
            {{-- <div class="col-md-12 mb-3">
                @if ($role_id == false)
                    <h3 class="mb-3">@lang('admin.Add a group')</h3>
                @else
                    <h3 class="mb-3">@lang('admin.Edit group')</h3>
                @endif
            </div> --}}
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
                <div class="table-responsive">
                    <table class="table-role table table-bordered">
                        @foreach ($permissions as $name => $model_permissions)
                            <tr>
                                <th> @lang($name) </th>
                                @foreach ($model_permissions as $model_permission)
                                    <td>
                                        <div class="toggle">
                                            <label class="switch">
                                                <input type="checkbox" name="permission[]"
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
@endsection
