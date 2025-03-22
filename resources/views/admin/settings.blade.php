@extends('admin.layouts.admin', [
    'title' => 'الاعدادات',
])
@section('content')
    <div class="main-side">
        <div class="main-title">
            <div class="small">
                الرئيسية
            </div>
            <div class="large">
                الإعدادات العامة
            </div>
        </div>
        <x-alert-admin></x-alert-admin>
        <h6 class="main-head">
            البيانات الاساسية
        </h6>

        <form class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-5 mb-2 g-3"
            action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('POST')
            <div class="col">
                <div class="inp-holder">
                    <label class="special-input">
                        <span>إسم الموقع</span>
                        <input type="text" name="website_name" value="{{ Setting('website_name') }}" id="website_name"
                            class="form-control">
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="inp-holder">
                    <label class="special-input">
                        <span>رابط الموقع</span>
                        <input type="url" name="website_url" value="{{ Setting('website_url') }}" id="website_url"
                            class="form-control">
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="inp-holder">
                    <label class="special-input">
                        <span>الرقم الضريبي</span>
                        <input type="text" name="tax_number" value="{{ Setting('tax_number') }}" id="tax_number"
                            class="form-control">
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="inp-holder">
                    <label class="special-input">
                        <span>العنوان</span>
                        <input type="text" name="address" value="{{ Setting('address') }}" id="address"
                            class="form-control">
                    </label>
                </div>
            </div>


            <div class="col">
                <div class="inp-holder">
                    <label class="special-input">
                        <span>الجوال</span>
                        <input type="tel" name="phone" value="{{ Setting('phone') }}" id="phone"
                            class="form-control">
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="inp-holder">
                    <label class="special-input">
                        <span> البريد الالكترونى</span>
                        <input type="email" name="email" class="form-control" value="{{ Setting('email') }}"
                            id="email">
                    </label>
                </div>
            </div>

            <div class="col">
                <div class="inp-holder">
                    <label class="special-input">
                        <span> الضريبة</span>
                        <input type="number" class="form-control" name="tax" value="{{ Setting('tax') }}"
                            id="tax">
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="inp-holder">
                    <label class="special-label" for="tax">تفعيل الضريبة</label>
                    <select value="{{ Setting('is_tax') }}" name="is_tax" id="is_tax" class="form-select">
                        <option value="">اختر</option>
                        <option @selected(Setting('is_tax') == 1) value="1">مفعل</option>
                        <option @selected(Setting('is_tax') == 0) value="0">غير مفعل</option>
                    </select>
                </div>
            </div>

            <div class="col">
                <div class="inp-holder">
                    <label class="special-input">
                        <span> رمز العمله</span>
                        <input type="text" class="form-control" name="currency" value="{{ Setting('currency') }}"
                            id="currency">
                    </label>
                </div>
            </div>


            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <label class="special-label" for="description">وصف الموقع</label>
                <textarea id="description" rows="6" name="description" class="form-control" placeholder="نص  .....">{{ Setting('description') }}</textarea>
            </div>

            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <hr>
                <h6 class="main-head m-0">
                    التواصل الاجتماعي
                </h6>
            </div>



            <div class="col">
                <div class="inp-holder">
                    <label class="special-input">
                        <span>واتساب</span>
                        <input type="text" name='whatsapp' value="{{ Setting('whatsapp') }}" class="form-control"
                            id="whatsapp">
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="inp-holder">
                    <label class="special-input">
                        <span> سناب شات</span>
                        <input type="text" name='snapchat' value="{{ Setting('snapchat') }}" class="form-control"
                            id="snapchat">
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="inp-holder">
                    <label class="special-input">
                        <span> تويتر</span>
                        <input type="text" name='twitter' class="form-control" value="{{ Setting('twitter') }}"
                            id="twitter">
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="inp-holder">
                    <label class="special-input">
                        <span> فيسبوك</span>
                        <input type="text" name='facebook' value="{{ Setting('facebook') }}" class="form-control"
                            id="facebook">
                    </label>
                </div>
            </div>
            <div class="col">
                <div class="inp-holder">
                    <label class="special-input">
                        <span> انستغرام</span>
                        <input type="text" class="form-control" name='instagram' value="{{ Setting('instagram') }}"
                            id="instagram">
                    </label>
                </div>
            </div>







            <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                <hr>
            </div>


            <div class="col">
                <div class="inp-holder">
                    <label class="special-label" for="siteStatus">حالة الموقع</label>
                    <select value="{{ Setting('website_status') }}" name='website_status' id="website_status"
                        class="form-select">
                        <option value="">اختر</option>
                        <option @selected(Setting('website_status') == 1) value="1">مفعل</option>
                        <option @selected(Setting('website_status') == 0) value="0">غير مفعل</option>
                    </select>
                </div>
            </div>
            <div class="col-12 col-md-12 col-lg-12 col-xl-4 transform-up-xl">
                <label class="special-label" for="siteLogo">رسالة تعطيل الموقع</label>
                <textarea id="maintainance_message" rows="4" name="maintainance_message" class="form-control"
                    placeholder="نعتذر الموقع مغلق للصيانة ...">{{ Setting('maintainance_message') }}</textarea>
            </div>
            <div class="col">
                <div class="inp-holder">
                    <label class="special-input mb-1">
                        <span>صورة الشعار </span>
                        <input type="file" name="logo" value="{{ Setting('logo') }}" id="logo"
                            class="form-control">
                    </label>
                    @if (setting('logo'))
                        <img src="{{ display_file(setting('logo')) }}" alt="" width='50'>
                    @endif
                </div>
            </div>

            <div class="col">
                <div class="inp-holder">
                    <label class="special-input mb-1">
                        <span>صورة أيقونة المتصفح</span>
                        <input type="file" name="fav" value="{{ Setting('fav') }}" id="fav"
                            class="form-control">
                    </label>
                    @if (setting('fav'))
                        <img src="{{ display_file(setting('fav')) }}" alt="" width='50'>
                    @endif
                </div>
            </div>






            @can('update_settings')
                <div class="col-12 col-md-12 col-lg-12 col-xl-12">
                    <div class=" d-flex justify-content-center mt-4">
                        <button type="submit" class="main-btn">حفظ التعديلات</button>
                    </div>
                </div>
            @endcan


        </form>
    </div>

    {{-- </div> --}}
@endsection
