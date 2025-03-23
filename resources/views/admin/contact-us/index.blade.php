@extends('admin.layouts.admin', [
    'title' => ' تواصل معنا',
])
@section('content')
    <div class="main-side">
        <div class="main-title">
            <div class="small">
                @lang('Home')
            </div>
            <div class="large">
                تواصل معنا
            </div>
        </div>
        <div class="btn-holder d-flex align-items-center justify-content-start gap-1 mb-2">
            <div class="box-search">
                <form action="">
                    <img src="{{ asset('admin-asset/img/icons/search.png') }}" alt="icon" />
                    <input type="search" id="" value="{{ request('search') }}" name="search"
                        placeholder="@lang('Search')" />
                </form>
            </div>
        </div>
        <x-alert-admin />
        <div class="table-responsive">
            <table class="main-table mb-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>الهاتف</th>
                        <th>الايميل</th>
                        <th>الرساله</th>
                        <th>الوقت</th>
                        <th>@lang('Actions')</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <th>{{ $loop->iteration }}</th>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->message }}</td>
                            <td>{{ $item->created_at }}</td>

                            <td>

                                <a class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#show{{ $item->id }}">
                                    <i class="fa fa-eye"></i>
                                </a>
                                @include('admin.contact-us.show-modal', ['item' => $item])

                                @can('delete_contact-us')
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $item->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                @endcan
                                @include('admin.contact-us.delete-modal', [
                                    'item' => $item,
                                ])
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{ $items->links() }}
        </div>
    </div>
@endsection
