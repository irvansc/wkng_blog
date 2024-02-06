<div>
    @if (categories())

    <div class="col-lg-12 col-md-6">
        <div class="widget">
            <h2 class="section-title mb-3">Categories</h2>
            <div class="widget-body">
                @include('front.layouts.inc.categories_list')
            </div>
        </div>
    </div>
    @endif
</div>
