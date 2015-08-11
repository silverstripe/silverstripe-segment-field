(function ($) {
	$.entwine('ss', function ($) {
		$('.field.silverstripe\\\\forms\\\\segment:not(.readonly)').entwine({
			'MaxPreviewLength': 55,

			'Ellipsis': '...',

			'onmatch': function () {
				if (this.find(':text').length) {
					this.toggleEdit(false);
				}

				this.redraw();
				this._super();
			},

			'redraw': function () {
				var field = this.find(':text');
				var value = field.val();

				var preview = value;

				if (value.length > this.getMaxPreviewLength()) {
					preview = this.getEllipsis() + value.substr(value.length - this.getMaxPreviewLength(), value.length);
				}

				this.find('.preview').text(field.data('preview'));
			},

			'toggleEdit': function (toggle) {
				var field = this.find(':text');

				this.find('.preview-holder')[toggle ? 'hide' : 'show']();
				this.find('.edit-holder')[toggle ? 'show' : 'hide']();

				if (toggle) {
					field.data('original', field.val());
					field.focus();
				}
			},

			'update': function () {
				var field = this.find(':text');
				var current = field.data('original');
				var updated = field.val();

				if (current != updated) {
					this.addClass('loading');

					this.suggest(updated, (data) => {
						this.removeClass('loading');

						field.val(data['suggestion']);
						field.data('preview', data['preview']);

						this.toggleEdit(false);
						this.redraw();
					});
				} else {
					this.toggleEdit(false);
					this.redraw();
				}
			},

			'cancel': function () {
				var field = this.find(':text');
				field.val(field.data("original"));
				this.toggleEdit(false);
			},

			'suggest': function (val, callback) {
				var field = this.find(':text');
				var parts = $.path.parseUrl(this.closest('form').attr('action'));

				var url = parts.hrefNoSearch + '/field/' + field.attr('name') + '/suggest/?value=' + encodeURIComponent(val);

				if (parts.search) {
					url += '&' + parts.search.replace(/^\?/, '');
				}

				$.ajax({
					'url': url,
					'dataType': 'json',
					'success': (data) => {
						callback(data);
					},
					'error': (xhr, status) => {
						xhr.statusText = xhr.responseText;
					},
					'complete': () => {
						this.removeClass('loading');
					}
				});
			}
		});

		$('.field.silverstripe\\\\forms\\\\segment .edit').entwine({
			'onclick': function (event) {
				event.preventDefault();
				this.closest('.field').toggleEdit(true);
			}
		});

		$('.field.silverstripe\\\\forms\\\\segment .update').entwine({
			'onclick': function (event) {
				event.preventDefault();
				this.closest('.field').update();
			}
		});

		$('.field.silverstripe\\\\forms\\\\segment .cancel').entwine({
			'onclick': function (event) {
				event.preventDefault();
				this.closest('.field').cancel();
			}
		});

		$('.field.silverstripe\\\\forms\\\\segment :text').entwine({
			'onkeydown': function (event) {
				var code = event.keyCode || event.which;

				if(code == 13) {
					event.stop();
					this.closest('.field').update();
				}
			}
		});
	});

}(jQuery));
