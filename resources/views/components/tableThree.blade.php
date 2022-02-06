<div class="card shadow mb-4">
    <div class="card-header py-3 d-flex justify-content-between align-items-end">
        <h5 class="m-0 font-weight-bold text-primary">{{ $title }}</h5>
        <a {{ $btnAttr }} class="btn btn-primary">{{ $btnName }}</a>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover" {{ $tableAttr}} style="width:100%">
                <thead>
                {{ $tableHeaders }}
                </thead>
                <tbody>
                {{ $tableBody }}
                </tbody>
            </table>
        </div>
    </div>
</div>