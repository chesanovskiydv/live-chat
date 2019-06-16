<div class="row">
    <div class="col-sm-5 pagination-info">
        @lang('macros.paginator.info', [
            'first' => $paginator->firstItem(),
            'last' => $paginator->lastItem(),
            'total' => $paginator->total()
         ])
    </div>
    <div class="col-sm-7 pagination-container">
        {{ $paginator->links() }}
    </div>
</div>