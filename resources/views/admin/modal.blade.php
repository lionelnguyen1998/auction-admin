 <!-- /.modal -->
 <div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title" style="color:#F70202"><b>本当に削除しますか？</b></h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"></span>&times;</span>
            </button>
        </div>
        <form action="{{ route('deleteCategory', ['categoryId' => $category["category_id"]]) }}" method="GET">
            <!-- /.card-body -->
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">キャンセル</button>
            <button type="submit" class="btn btn-danger">確認</button>
            </div>
            @csrf
        </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>