<!-- Compare Products Modal -->
<div class="modal fade" id="compareModal" tabindex="-1" aria-labelledby="compareModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="compareModalLabel">{{ __('Compare Products') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="compare-table-wrapper">
                    <div id="compare-products-container" class="row">
                        <!-- Compare products will be dynamically inserted here by JavaScript -->
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-danger" id="clearCompareList">{{ __('Clear All') }}</button>
            </div>
        </div>
    </div>
</div>

<!-- Recently Viewed Products Modal -->
<div class="modal fade" id="recentlyViewedModal" tabindex="-1" aria-labelledby="recentlyViewedModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="recentlyViewedModalLabel">{{ __('Recently Viewed Products') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="recently-viewed-container" class="row">
                    <!-- Recently viewed products will be dynamically inserted here by JavaScript -->
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('Close') }}</button>
                <button type="button" class="btn btn-danger" id="clearRecentlyViewed">{{ __('Clear History') }}</button>
            </div>
        </div>
    </div>
</div>