$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('change', '.tabCheckbox', function () {
    let elm = $(this),
        action = elm.val(),
        url = elm.data('url');

    elm.closest('.tab-item').addClass('active').siblings().removeClass('active');

    loadContent(url, action);
});


function loadContent(url, action) {
    $.ajax({
        method: "GET",
        url: url,
        data: {
            action: action
        },
    }).done( response => {
        $('#content').html(response);
        history.pushState(null, null, url);
    }).fail(function (response) {

    });
}
