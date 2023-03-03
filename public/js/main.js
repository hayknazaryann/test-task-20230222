window.onpopstate = function () {
    history.go(0);
};

$(document)
    .on('change', '.tabCheckbox', function () {
        let elm = $(this);
        loadContent(elm);
    })
    .on('click', '#save', function (e) {
        e.preventDefault();
        let btn = $(this),
            form = btn.closest('form');
        saveData(form);
    })
    .on('click', '.tab-item.clickable label', function (e) {
        e.preventDefault();
        if (!$(this).hasClass('active')) {
            $(this).prev().trigger('change');
        }
    })
    .on('click', '.view-data', function () {
        let url = $(this).data('url');
        $('#tab-view').attr('data-url', url).trigger('change');
    })
    .on('click', '.show-item', function () {
        let elm = $(this).next();
        if (elm.hasClass('hide')) {
            elm.removeClass('hide');
        } else {
            elm.parent().find('ul').addClass('hide');
        }
    })
    .on('click', '.btn-delete', function () {
        confirm('Are you sure?');
        $(this).parent('form').submit();
    })
    .on('click', '#logout-btn', function () {
        $('form#logout-form').submit();
    })
    .on('click', '.pagination a.page-link', function (event) {
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    })
    .on('click', '#generate-token', function (e) {
        e.preventDefault();
        let form = $(this).closest('form');
        $.ajax({
            method: "POST",
            url: form.attr('action'),
            data: form.serialize(),
        }).done( response => {
            $('#output').html(response.output);
        }).fail(function (error) {
            let response = JSON.parse(error.responseText);
            notif({
                msg: response.message,
                type: "error"
            });
        });
    });


function fetch_data(page)
{
    $.ajax({
        url:"?page="+page,
        success:function(data)
        {
            $('#content').html(data);
        }
    });
}

function saveData(form) {
    let method = form.find('select#method').val(),
        token = form.find('input#token').val(),
        url = window.location.href,
        reqData = {
            data: form.find('textarea#data').val()
        },
        inputCode = form.find('input#code');

    if (inputCode.length) {
        reqData.code = inputCode.val();
    }

    $.ajax({
        method: method,
        url: url,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            'USER-TOKEN': token
        },
        data: reqData,
    }).done( response => {
        if (response.success === true) {
            notif({
                msg: response.message,
                type: "success"
            });
            loadContent($('#tab-data'));
        }

    }).fail(function (error) {
        let response = JSON.parse(error.responseText);

        if(error.status === 422) {
            let errors = response.errors;
            for (let key in errors) {
                notif({
                    msg: errors[key][0],
                    type: "error"
                });
            }
        } else {
            notif({
                msg: response.message,
                type: "error"
            });
        }
    });
}

function loadContent(elm) {
    let url = elm.data('url');
    $.ajax({
        method: "GET",
        url: url,
        data: {
            loadContent: true
        },
    }).done( response => {
        elm.closest('.tab-item').addClass('active').siblings().removeClass('active');
        $('#content').html(response);
        history.pushState(null, null, url);
    }).fail(function (response) {

    });
}
