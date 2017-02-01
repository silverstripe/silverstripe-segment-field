<div class="preview-holder">
    <span class="preview">
        $Preview
    </span>
    <button class="btn btn-warning btn-sm edit">
        <% _t('SegmentField.Edit', 'Edit') %>
    </button>
</div>
<div class="edit-holder">
    <input $AttributesHTML />
    <button class="update btn btn-primary btn-sm">
        <% _t('SegmentField.OK', 'Save') %>
    </button>
    <button class="cancel btn btn-secondary btn-sm">
        <% _t('SegmentField.Cancel', 'Cancel') %>
    </button>
    <% if $HelpText %><p class="help">$HelpText</p><% end_if %>
</div>
