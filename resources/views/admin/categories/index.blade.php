@extends('admin.layouts.admin')
@section('title', 'الاقسام')
@section('content')
    <div class="main-side">
        <x-alert-admin />
        <div class="main-title">
            <div class="small">
                الرئيسية
            </div>
            <div class="large">
                الاقسام
            </div>
        </div>
        <div class="btn-holder d-flex align-items-center justify-content-start gap-1 mb-2">
            <button type="button" class="main-btn" data-bs-toggle="modal" data-bs-target="#create">
                اضافة
                <i class="fa-solid fa-plus"></i>
            </button>
            @include('admin.categories.create-modal')
            <a href="{{ route('admin.categories.index') }}" type="button" class="main-btn btn-main-color">الكل:
                {{ App\Models\Category::count() }}</a>
            <a href="{{ route('admin.categories.index', ['status' => 'yes']) }}" type="button"
                class="btn btn-success">مفعل:
                {{ App\Models\Category::active()->count() }}</a>
            <a href="{{ route('admin.categories.index', ['status' => 'no']) }}" type="button" class="btn btn-danger">غير
                مفعل:
                {{ App\Models\Category::inactive()->count() }}</a>


        </div>
        <div class="table-responsive">
            <table class="main-table mb-2">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>الاسم</th>
                        <th>الحالة</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <span class="badge bg-{{ $item->status->color() }}">{{ $item->status->name() }}</span>
                            </td>
                            <td class="d-flex gap-2">
                                <button type="button" class="btn btn-info btn-sm text-white mx-1" data-bs-toggle="modal"
                                    data-bs-target="#edit{{ $item->id }}">
                                    <i class="fa-solid fa-pen"></i>
                                </button>
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#delete{{ $item->id }}">
                                    <i class="fa-solid fa-trash"></i>
                                </button>
                                @include('admin.categories.delete-modal', ['item' => $item])
                                @include('admin.categories.edit-modal', ['item' => $item])

                            </td>
                        </tr>
                    @endforeach

                </tbody>
            </table>
            {{ $items->links() }}
        </div>
    </div>
@endsection
