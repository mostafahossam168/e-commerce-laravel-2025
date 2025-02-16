<div class="modal fade" id="canceled{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">الغاء طلب</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.orders.canceled', $item->id) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('PATCH')
                    هل أنت متأكد من الغاء الطلب رقم {{ $item->number }} ؟

                    <div class="col-12">
                        <div class="form-group mb-3">
                            <label for="">سبب الرفض</label>
                            <textarea name="resone_canceled" id="" cols="30" class="form-control" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">نعم</button>
                </div>
            </form>
        </div>
    </div>
</div>
