@extends('admin.layouts.admin', [
    'title' => 'المنتجات',
])
@section('content')
    <div class="main-side">
        <x-alert-admin />
        <div class="main-title">
            <div class="small">
                الرئيسية
            </div>
            <div class="large">
                المنتجات
            </div>

        </div>
        <div class="bar-options d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
            <div class="btn-holder d-flex align-items-center justify-content-start gap-1 mb-2">
                @can('create_products')
                    <a href="{{ route('admin.products.create') }}" class="main-btn">
                        اضافة
                        <i class="fa-solid fa-plus"></i>
                    </a>
                @endcan

                <a href="{{ route('admin.products.index') }}" type="button" class="main-btn btn-main-color">الكل:
                    {{ App\Models\Product::count() }}</a>
                <a href="{{ route('admin.products.index', ['status' => 'yes']) }}" type="button"
                    class="btn btn-success">مفعل:
                    {{ App\Models\Product::active()->count() }}</a>
                <a href="{{ route('admin.products.index', ['status' => 'no']) }}" type="button" class="btn btn-danger">غير
                    مفعل:
                    {{ App\Models\Product::inactive()->count() }}</a>
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
            <table class="main-table mb-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>القسم</th>
                        <th>السعر</th>
                        <th>الباركود</th>
                        <th>الصوره</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>{{ $item->price }}</td>
                            <td> {!! DNS1D::getBarcodeHTML($item->id . '', 'C128') !!}</td>
                            <td>
                                <img src="{{ display_file($item->main_image) }}" alt=""
                                    class="img-thumbnail img-preview" width="50">
                            </td>
                            <td>
                                <span class="badge bg-{{ $item->status->color() }}">{{ $item->status->name() }}</span>
                            </td>
                            <td class="d-flex gap-2">

                                <a class="btn btn-info btn-sm text-white mx-1"
                                    href="{{ route('admin.products.show', $item->id) }}">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                @can('update_products')
                                    <a class="btn btn-primary btn-sm text-white mx-1"
                                        href="{{ route('admin.products.edit', $item->id) }}">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                @endcan

                                @can('delete_products')
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $item->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    @include('admin.products.delete-modal', ['item' => $item])
                                @endcan
                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $items->links() }}
        </div>
    </div>
@endsection
