<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-end">
        <h5 class="m-0 font-weight-bold text-primary">{{ $title }}</h5>
        <button {{ $btnAttr }} class="btn btn-primary">{{ $btnName }}</button>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" {{ $tableAttr}} width="100%" cellspacing="0">
                <thead class="">
                <tr>
                    {{ $tableHeaders }}
                </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
