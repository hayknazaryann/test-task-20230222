window.onpopstate = function () {
    history.go(0);
};

$(document)
    .on('change', '.tabCheckbox', function () {
        let elm = $(this),
            url = elm.data('url');

        console.log('w');
        elm.closest('.tab-item').addClass('active').siblings().removeClass('active');
        loadContent(url);
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
            console.log('ddd');
            $('#tab-data').trigger('click');
        }

    }).fail(function (response) {

    });
}

function loadContent(url) {
    $.ajax({
        method: "GET",
        url: url,
        data: {
            loadContent: true
        },
    }).done( response => {
        $('#content').html(response);
        history.pushState(null, null, url);
    }).fail(function (response) {

    });
}
