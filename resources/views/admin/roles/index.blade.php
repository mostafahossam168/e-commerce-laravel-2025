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
        <div class="bar-options d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
            <div class="btn-holder d-flex align-items-center justify-content-start gap-1 mb-2">
                @can('create_roles')
                    <a href="{{ route('admin.roles.create') }}" class="main-btn">
                        اضافة
                        <i class="fa-solid fa-plus"></i>
                    </a>
                @endcan
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
                        <th>الاسم </th>
                        <th>@lang('Actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>

                            <td>{{ $item->name }}</td>
                            <td>
                                <div class="btn-holder d-flex align-items-center gap-3">
                                    <a href="{{ route('admin.roles.show', $item->id) }}"
                                        class="btn btn-info btn-sm text-white mx-1">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                    @can('update_roles')
                                        <a href="{{ route('admin.roles.edit', $item->id) }}"
                                            class="btn btn-primary btn-sm text-white mx-1">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                    @endcan
                                    @can('delete_roles')
                                        @if ($item->id != 1)
                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#delete{{ $item->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                            @include('admin.roles.delete-modal', ['item' => $item])
                                        @endif
                                    @endcan
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
