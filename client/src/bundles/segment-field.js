window.jQuery.entwine('ss', ($) => {
  $('.field.segment:not(.readonly)').entwine({
    MaxPreviewLength: 55,

    Ellipsis: '...',

    onmatch() {
      if (this.find(':text').length) {
        this.toggleEdit(false);
      }

      this.redraw();
      this._super();
    },

    redraw() {
      const field = this.find(':text');
      // @todo these aren't used, should they be? Otherwise, remove
      // const value = field.val();

      // let preview = value;

      // if (value.length > this.getMaxPreviewLength()) {
      //   preview = this.getEllipsis()
      //    + value.substr(value.length - this.getMaxPreviewLength(), value.length);
      // }

      this.find('.preview').text(field.data('preview'));
    },

    toggleEdit(toggle) {
      const field = this.find(':text');

      this.find('.preview-holder')[toggle ? 'hide' : 'show']();
      this.find('.edit-holder')[toggle ? 'show' : 'hide']();

      if (toggle) {
        field.data('original', field.val());
        field.focus();
      }
    },

    update() {
      const field = this.find(':text');
      const current = field.data('original');
      const updated = field.val();

      if (current !== updated) {
        this.addClass('loading');

        this.suggest(updated, (data, el) => {
          $(el).removeClass('loading');

          field.val(data.suggestion);
          field.data('preview', data.preview);

          this.toggleEdit(false);
          this.redraw();
        });
      } else {
        this.toggleEdit(false);
        this.redraw();
      }
    },

    cancel() {
      const field = this.find(':text');
      field.val(field.data('original'));
      this.toggleEdit(false);
    },

    suggest(val, callback) {
      const field = this.find(':text');
      const parts = this.closest('form').attr('action').split('?');

      let url = `${parts[0]}/field/${field.attr('name')}/suggest/?value=${encodeURIComponent(val)}`;

      if (parts[1]) {
        url += `&${parts[1].replace(/^\?/, '')}`;
      }

      $.ajax({
        url,
        dataType: 'json',
        success(data) {
          callback(data, this);
        },
        error(xhr) {
          /* eslint no-param-reassign: ["error", { "props": false }]*/
          xhr.statusText = xhr.responseText;
        },
        complete() {
          field.removeClass('loading');
        },
      });
    },
  });

  $('.field.segment .edit').entwine({
    onclick(event) {
      event.preventDefault();
      this.closest('.field').toggleEdit(true);
    },
  });

  $('.field.segment .update').entwine({
    onclick(event) {
      event.preventDefault();
      this.closest('.field').update();
    },
  });

  $('.field.segment .cancel').entwine({
    onclick(event) {
      event.preventDefault();
      this.closest('.field').cancel();
    },
  });

  $('.field.segment :text').entwine({
    onkeydown(event) {
      const code = event.keyCode || event.which;

      if (code === 13) {
        event.stop();
        this.closest('.field').update();
      }
    },
  });
});
