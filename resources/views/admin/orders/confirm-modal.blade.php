<div class="modal fade" id="confirm{{ $item->id }}" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">تاكيد الطلب</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.orders.confirm', $item->id) }}" method="POST">
                <div class="modal-body">
                    @csrf
                    @method('PUT')
                    هل أنت متأكد من تاكيد الطلب رقم {{ $item->number }} ؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                    <button type="submit" class="btn btn-success" data-bs-dismiss="modal">تاكيد</button>
                </div>
            </form>
        </div>
    </div>
</div>
