<div class="preview-holder">
    <span class="preview">
        $Preview
    </span>
    <button class="btn btn-outline-secondary btn-sm edit">
        <%t SegmentField.Edit 'Edit' %>
    </button>
</div>
<div class="edit-holder">
    <input $AttributesHTML />
    <button class="update btn btn-primary btn-sm">
        <%t SegmentField.OK 'Save' %>
    </button>
    <button class="cancel btn btn-secondary btn-sm">
        <%t SegmentField.Cancel 'Cancel' %>
    </button>
    <% if $HelpText %><p class="help">$HelpText</p><% end_if %>
</div>
