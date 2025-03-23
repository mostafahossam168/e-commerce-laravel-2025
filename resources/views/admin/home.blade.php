@extends('admin.layouts.admin')

@section('content')
    <style>
        .box-online {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            /* width: -moz-fit-content; */
            width: fit-content;
            padding: 6px;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        .box-online .user-holder {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .box-online .user-holder .img-holder {
            border-radius: 50%;
            width: 30px;
            height: 30px;
        }

        .box-online .user-holder .img-holder img {
            width: 100%;
            height: 100%;
            -o-object-fit: cover;
            object-fit: cover;
        }

        .box-online .user-holder .title {
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 0;
        }

        .box-online .icon-holder i,
        .box-online .icon-holder svg {
            font-size: 11px;
            color: rgb(3, 173, 3);
        }
    </style>
    <div class="main-side">
        <div class="d-flex align-items-center flex-warp gap-4 mb-3">
            <div class="main-title mb-0">
                <div class="small">
                    الرئيسية </div>
                <div class="large">
                    لوحة التحكم </div>
            </div>

            @can('show-room_home')
                <div class="holder-boxs d-flex align-items-center flex-wrap flex-grow-1 gap-1 admin-online">
                </div>
            @endcan

        </div>

        @can('show_statistics_home')
            <div class="row g-3 mb-2">
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="box-statistic">
                        <div class="right-side">
                            <h6 class="name">العملاء</h6>
                            <h3 class="amount"><span class="num-stat"
                                    data-goal="{{ \App\Models\User::where('type', 'client')->count() }}">0</span></h3>
                            <a href="{{ route('admin.users.index') }}" class="link-view">عرض جميع العملاء</a>
                        </div>
                        <div class="left-side">
                            <p class="status-number up"> </i></p>
                            <div class="icon-holder green">
                                <i class="fa-regular fa-circle-user"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="box-statistic blue">
                        <div class="right-side">
                            <h6 class="name">المشرفين</h6>
                            <h3 class="amount"><span class="num-stat"
                                    data-goal="{{ \App\Models\User::where('type', 'admin')->count() }}">0</span></h3>
                            <a href="{{ route('admin.admins.index') }}" class="link-view">عرض جميع المشرفين</a>
                        </div>
                        <div class="left-side">
                            <p class="status-number down"></i></p>
                            <div class="icon-holder blue">
                                <i class="fa-solid fa-user-tie"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="box-statistic purple">
                        <div class="right-side">
                            <h6 class="name">الاقسام</h6>
                            <h3 class="amount num-stat" data-goal="{{ \App\Models\Category::count() }}">0</h3>
                            <a href="{{ route('admin.categories.index') }}" class="link-view">عرض جميع الاقسام</a>
                        </div>
                        <div class="left-side">
                            <p class="status-number up"> </i></p>
                            <div class="icon-holder yellow">
                                <i class="fa-solid fa-list"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-4 col-xl-3">
                    <div class="box-statistic green">
                        <div class="right-side">
                            <h6 class="name">المنتجات</h6>
                            <h3 class="amount"><span class="num-stat" data-goal="{{ \App\Models\Product::count() }}">0</span>
                            </h3>
                            <a href="{{ route('admin.products.index') }}" class="link-view">عرض جميع المنتجات</a>
                        </div>
                        <div class="left-side">
                            <p class="status-number"></p>
                            <div class="icon-holder">
                                <i class="fa-solid fa-bag-shopping"></i>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-12">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <div class="card">
                                <div class="card-header bg-white">
                                    الاحصائيات
                                </div>
                                <div class="card-body">
                                    <canvas class="w-100" id="myChartDate" height="160"></canvas>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 col-md-6">
                            <div class="row g-3">
                                <div class="col-12 col-md-6">
                                    <div class="box-statistic yellow">
                                        <div class="right-side">
                                            <h6 class="name">الصلاحيات</h6>
                                            <h3 class="amount num-stat"
                                                data-goal="{{ Spatie\Permission\Models\Role::count() }}">0
                                            </h3>
                                            <a href="{{ route('admin.roles.index') }}" class="link-view">عرض جميع الصلاحيات</a>
                                        </div>
                                        <div class="left-side">
                                            <p class="status-number up"> </p>
                                            <div class="icon-holder green">
                                                <i class="fa-regular fa-newspaper"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="box-statistic ">
                                        <div class="right-side">
                                            <h6 class="name">الطلبات</h6>
                                            <h3 class="amount num-stat" data-goal="{{ App\Models\Order::count() }}">0</h3>
                                            <a href="{{ route('admin.orders.index') }}" class="link-view">عرض جميع الطلبات</a>
                                        </div>
                                        <div class="left-side">
                                            <p class="status-number up"></p>
                                            <div class="icon-holder blue">
                                                <i class="fa-solid fa-bars-progress"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="box-statistic blue">
                                        <div class="right-side">
                                            <h6 class="name">الاعدادات</h6>
                                            <a href="{{ route('admin.settings.show') }}" class="link-view">عرض الاعدادات</a>
                                        </div>
                                        <div class="left-side">
                                            <p class="status-number"> </p>
                                            <div class="icon-holder">
                                                <i class="fa-solid fa-headset"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6">
                                    <div class="box-statistic purple">
                                        <div class="right-side">
                                            <h6 class="name"> تواصل معنا</h6>
                                            <h3 class="amount num-stat" data-goal="{{ \App\Models\ContactUs::count() }}">0
                                            </h3>
                                            <a href="{{ route('admin.contacts') }}" class="link-view">عرض جميع الرسائل </a>
                                        </div>
                                        <div class="left-side">
                                            <p class="status-number up"></p>
                                            <div class="icon-holder yellow">
                                                <i class="fa-solid fa-handshake-angle"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endcan
    </div>
@endsection
@push('js')
    <script>
        let xValues = ["January", "February", "March", "April", "May", "June", "July"];
        new Chart("myChartDate", {
            type: "bar", // الرسم البياني من نوع الأعمدة
            data: {
                labels: xValues,
                datasets: [{
                        type: 'line',
                        label: 'العملاء',
                        data: [0, 50, 500, 200, 400, 300, 100],
                        borderWidth: 2,
                        pointRadius: 1,
                        borderColor: "#405189",
                        backgroundColor: "rgb(64 81 137 / 10%)",
                        fill: true
                    },
                    {
                        label: 'الطلبات',
                        data: [100, 200, 700, 800, 500, 600, 300],
                        type: 'line',
                        borderWidth: 2,
                        pointRadius: 1,
                        borderColor: "#f06548",
                        fill: true
                    }
                ],
                options: {
                    responsive: true,
                    legend: {
                        display: true
                    },
                    tooltips: {
                        mode: 'index',
                        intersect: false
                    },
                    hover: {
                        mode: 'index',
                        intersect: false
                    }
                }
            },
        });


        if (document.querySelectorAll(".num-stat")) {
            let numStats = document.querySelectorAll(".num-stat");
            let started = false;
            document.addEventListener("DOMContentLoaded", function() {
                numStats.forEach((num) => startCount(num));
            });

            function startCount(el) {
                let goal = el.dataset.goal;
                let duration = 2000; // تحديد المدة الزمنية
                let start = null;

                function updateCount(timestamp) {
                    if (!start) start = timestamp;
                    let progress = timestamp - start;
                    let increment = Math.floor((progress / duration) * goal);
                    el.textContent = increment > goal ? goal : increment;
                    if (progress < duration) {
                        requestAnimationFrame(updateCount);
                    }
                }
                requestAnimationFrame(updateCount);
            }
        }
    </script>
@endpush
