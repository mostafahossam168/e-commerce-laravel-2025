@extends('admin.layouts.admin', [
    'title' => 'العملاء',
])
@section('content')
    <div class="main-side">
        <div class="main-title">
            <div class="small">الرئيسية</div>
            <div class="large">العملاء</div>
        </div>
        <x-alert-admin />
        <div class="bar-options d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
            <div class="btn-holder d-flex align-items-center justify-content-start gap-1 mb-2">
                @can('create_users')
                    <a href="{{ route('admin.users.create') }}" class="main-btn">
                        اضافة
                        <i class="fa-solid fa-plus"></i>
                    </a>
                @endcan

                <a href="{{ route('admin.users.index') }}" type="button" class="main-btn btn-main-color">الكل:
                    {{ App\Models\User::users()->count() }}</a>
                <a href="{{ route('admin.users.index', ['status' => 'yes']) }}" type="button" class="btn btn-success">مفعل
                    :
                    {{ App\Models\User::users()->active()->count() }}</a>
                <a href="{{ route('admin.users.index', ['status' => 'no']) }}" type="button" class="btn btn-danger">غير
                    مفعل :
                    {{ App\Models\User::users()->inactive()->count() }}</a>
            </div>
            <div class="box-search">
                <form action="">
                    <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
                    <input type="search" id="" value="{{ request('search') }}" name="search"
                        placeholder="@lang('Search')" />
                </form>
            </div>

        </div>
        <div class="table-responsive">
            <table class="main-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الصوره</th>
                        <th>الاسم </th>
                        <th>الهاتف </th>
                        <th>البريد الالكتروني</th>
                        <th>الطلبات</th>
                        <th>الحالة</th>
                        <th>@lang('Actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <img src="{{ $item->image ? display_file($item->image->path) : asset('admin-asset/img/no-image.jpeg') }}"
                                    class="img-thumbnail img-preview" alt="" width="50">
                            </td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->email }}</td>
                            <td>
                                <a href="{{ route('admin.orders.index', ['user' => $item->id]) }}"
                                    class="btn btn-info btn-sm text-white mx-1">
                                    {{ $item->orders->count() }}
                                </a>
                            </td>
                            <td>
                                <span class="badge bg-{{ $item->status->color() }}">{{ $item->status->name() }}</span>
                            </td>
                            <td>
                                <div class="btn-holder d-flex align-items-center gap-3">
                                    @can('update_users')
                                        <a href="{{ route('admin.users.edit', $item->id) }}"
                                            class="btn btn-primary btn-sm text-white mx-1">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                    @endcan
                                    @can('delete_users')
                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#delete{{ $item->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    @endcan
                                </div>
                                @include('admin.users.delete-modal', ['item' => $item])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
