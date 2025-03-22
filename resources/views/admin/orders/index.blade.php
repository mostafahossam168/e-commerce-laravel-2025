@extends('admin.layouts.admin')
@section('title', 'الطلبات')
@section('content')
    <div class="main-side">
        <x-alert-admin />
        <div class="main-title">
            <div class="small">
                الرئيسية
            </div>
            <div class="large">
                الطلبات
            </div>
        </div>
        <div class="bar-options d-flex align-items-center justify-content-between flex-wrap gap-1 mb-2">
            <div class="btn-holder d-flex align-items-center justify-content-start gap-1 mb-2">

                <a href="{{ route('admin.orders.index') }}" type="button" class="main-btn btn-main-color">الكل:
                    {{ App\Models\Order::count() }}</a>
                @foreach (App\enums\OrderStatus::cases() as $status)
                    <a href="{{ route('admin.orders.index', ['status' => $status]) }}" type="button"
                        class="btn btn-{{ $status->color() }}"> {{ $status->name() }} :
                        {{ App\Models\Order::where('status', $status->value)->count() }}</a>
                @endforeach
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
                        <th>رقم الطلب</th>
                        <th>المستخدم</th>
                        <th>الهاتف</th>
                        <th>الحالة</th>
                        <th>التكلفة</th>
                        <th>الضريبه</th>
                        <th>الاجمالى</th>
                        <th>العمليات</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->number }}</td>
                            <td>{{ $item->user->name }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>
                                <span class="badge bg-{{ $item->status->color() }}">{{ $item->status->name() }}</span>
                                @if ($item->status->name() == 'ملغى')
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        title="سبب الرفض" data-bs-target="#resone{{ $item->id }}">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    @include('admin.orders.resone-modal', ['item' => $item])
                                @endif

                            </td>
                            <td>{{ $item->subtotal }}</td>
                            <td>{{ $item->tax }}</td>
                            <td>{{ $item->total }}</td>

                            <td class="d-flex gap-2">

                                @can('update_orders')
                                    @if ($item->status->name() == 'بالانتظار')
                                        <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal"
                                            title="تاكيد الطلب" data-bs-target="#confirm{{ $item->id }}">
                                            <i class="fa-solid fa-check"></i>
                                        </button>
                                        @include('admin.orders.confirm-modal', ['item' => $item])

                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                            title="الغاء الطلب" data-bs-target="#canceled{{ $item->id }}">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                        @include('admin.orders.canceled-modal', ['item' => $item])
                                    @endif


                                    @if ($item->status->name() == 'تحت التجهيز')
                                        <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                            title="اكتمال الطلب" data-bs-target="#completed{{ $item->id }}">
                                            <i class="fa-solid fa-check-double"></i>
                                        </button>
                                        @include('admin.orders.completed-modal', ['item' => $item])
                                    @endif
                                @endcan
                                <a class="btn btn-info btn-sm text-white mx-1"
                                    href="{{ route('admin.orders.show', $item->id) }}">
                                    <i class="fa-solid fa-eye"></i>
                                </a>

                                @can('delete_orders')
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $item->id }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    @include('admin.orders.delete-modal', ['item' => $item])
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
