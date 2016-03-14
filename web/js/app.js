var app = {
    _baseUrl: null,
    init: function() {
        this._baseUrl =  $('meta[name=baseUrl]').attr("content");
    },
    getUrl: function(url) {
        return this._baseUrl + url;
    },
    t: function(category, message) {
        return message;
    }
};

var modal = {
    isLoading: false,
    showWithUrl: function(url) {
        var $modal = $('#modal'),
            that = this,
            loaderHtml = '<div class="modal-loader"><div class="spinner">' +
                '<div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div></div>';

        $modal.find('#modal-content').html(loaderHtml);
        if (!$modal.data('bs.modal').isShown) {
            $modal.modal('show');
        }
        if (this.isLoading) {
            return;
        }
        this.isLoading = true;
        $.ajax({
            url: url,
            success: function(data) {
                $modal.find('#modal-content').html(data);
                that.isLoading = false;
            }
        });
    },
    close: function() {
        this.isLoading = false;
        $('#modal').modal('hide');
    }
};

$(document).ready(function() {

    var $body = $('body');

    app.init();

    $body.tooltip({
        selector: '[rel=tooltip]'
    });

    /**
     * Messenger plugin
     */
    Messenger.options = {
        extraClasses: 'messenger-fixed messenger-on-bottom messenger-on-left',
        theme: 'flat'
    };
    $(document).ajaxError(function(event, jqXHR, ajaxSettings, thrownError) {
        var data = eval("(" + jqXHR.responseText + ")");
        Messenger().post({
            message: data.message,
            type: 'error',
            hideAfter: 5,
            hideOnNavigate: true
        });

    });

    /**
     * Modals/Forms in modals
     */

    $body.on('click', '.btn-modal', function(event) {
        modal.showWithUrl($(this).attr('href'));
        event.preventDefault();
        return false;
    });

    $body.on('click', '.modal-form .btn-modal-close', function(event) {
        modal.close();
        event.preventDefault();
        return false;
    });
    $body.on('submit', '.modal-form form', function(event) {
        event.preventDefault();
        var $form = $(this),
            $buttons = $form.find('.btn');
        $.ajax({
            url: $form.attr('action'),
            data: $form.serialize(),
            type: 'post',
            beforeSend: function() {
                $buttons.attr('disabled', 'disabled');
            },
            success: function(response) {
                $buttons.attr('disabled', false);
                if (response.success) {
                    $('.modal.in').modal('hide');
                    Messenger().post({message: response.message, type: 'success'});
                }
                $form.trigger('afterSubmit', event);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                $buttons.attr('disabled', false);
                Messenger().post({message: jqXHR.data, type: 'error'});
            }
        });
        return false;
    });

});
