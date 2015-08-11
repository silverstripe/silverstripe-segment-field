<div class="preview-holder">
	<span class="preview">
		$Preview
	</span>
	<button class="ss-ui-button ss-ui-button-small edit">
		<% _t('SegmentField.Edit', 'Edit') %>
	</button>
</div>
<div class="edit-holder">
	<input $AttributesHTML />
	<button class="update ss-ui-button-small">
		<% _t('SegmentField.OK', 'Save') %>
	</button>
	<button class="cancel ss-ui-button-small ss-ui-action-minor">
		<% _t('SegmentField.Cancel', 'Cancel') %>
	</button>
	<% if $HelpText %><p class="help">$HelpText</p><% end_if %>
</div>