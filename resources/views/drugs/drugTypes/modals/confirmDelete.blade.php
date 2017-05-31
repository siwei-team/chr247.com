<div class="modal fade" id="confirmDeleteDrugTypeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">×</span></button>
                <h4 class="modal-title">删除数量类型</h4>
            </div>

            <form class="form-horizontal" method="post" action="#">
                <div class="modal-body">
                    {{csrf_field()}}

                    <div class="container-fluid">
                       确定要从系统中删除此数量类型吗？
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="reset" class="btn btn-default pull-left" data-dismiss="modal">取消</button>
                    <button type="submit" class="btn btn-danger pull-right">删除</button>
                </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div>