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

    app.init();

    $('body').tooltip({
        selector: '[rel=tooltip]'
    });

    $(document).on('click', '.btn-modal', function(event) {
        modal.showWithUrl($(this).attr('href'));
        event.preventDefault();
        return false;
    });

    $(document).on('click', '.modal-form .btn-modal-close', function(event) {
        modal.close();
        event.preventDefault();
        return false;
    });

});
