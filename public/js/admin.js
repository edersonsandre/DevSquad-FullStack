$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

function getUri() {
    var path = window.location.pathname.split('/');
    return "/" + path[1] + "/" + path[2];
}

function loadingMask() {
    $(".decimal").maskMoney({prefix: 'R$ ', allowNegative: true, thousands: '.', decimal: ',', affixesStay: false});
}

function loadingLibs() {
    loadingMask();
    formAjax();
}

$("a.novo-registro").on('click', function (e) {
    e.preventDefault();

    var uri = getUri();
    document.location.href = uri + "/registro";
});

$("a.listagem").on('click', function (e) {
    e.preventDefault();

    document.location.href = getUri();
});

$("a.delete").on('click', function (e) {
    e.preventDefault();

    var line = $(this).parents('tr');

    Swal.fire({
        title: 'Você tem certeza?',
        text: "Você está preste a remover um registro, caso opte por remover não será possivel reveter!",
        type: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim, delete registro!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                url: $(this).attr('href'),
                type: 'DELETE',
                success: function (response) {
                    if (response.status) {
                        line.remove();
                    }
                }
            });
        }
    })
});

$("a.visualizar").on('click', function (e) {
    e.preventDefault();

    $.ajax({
        url: $(this).attr('href'),
        type: 'GET',
        success: function (response) {
            Swal.fire({
                html: response,
                width: 600
            })
        }
    });
});

var vue;

var showModal = function () {
    Swal.fire({
        html: "<squad-upload-produto></squad-upload-produto>",
        width: 600,
        showCancelButton: false,
        showConfirmButton: false
    })

    vue = new Vue({
        el: Swal.getContent()
    })
}

document.getElementById("upload-file-produtos").addEventListener("click", showModal);

$("a.upload-file-produtos").on('click', function (e) {
    e.preventDefault();

    Swal.fire({
        html: "a<squad-button-upload></squad-button-upload>a<component :is='squad-button-upload'></component>\n" +
            " ",
        width: 600
    })
});

function clearErrorInputs() {
    $("form input").parent().removeClass('has-error');
    $("form textarea").parent().removeClass('has-error');
    $("form select").parent().removeClass('has-error');

    $(".form-input-error").remove();
    $("div.box-error-message").html("");
}

function setError(xhr) {
    if (xhr.status == 422) {
        var _errors = $.parseJSON(xhr.responseText);
        setErrorInputs(_errors.errors);
    }

    if (xhr.status == 500) {
        var _errors = $.parseJSON(xhr.responseText);
        alert(_errors.message);
    }
}

function setErrorInputs(errors) {
    clearErrorInputs();

    $.each(errors, function (key, value) {
        $.each(['input', 'textarea', 'select'], function (_key, field) {
            var obj = $("form " + field + "[name='" + key + "']").parent();
            if (obj.length) {
                obj.addClass('has-error');
                obj.append("<div class='invalid-feedback form-input-error'>" + value + "</div>");
            }
        });
    });

    if ($("div.box-error-message").size()) {
        var box_errors = $("div.box-error-message");
        var _errors = "";
        $.each(errors, function (key, error) {
            _errors += error + '<br />';
        });

        box_errors.html('<div class="alert alert-danger">' + _errors + '</div>');
    }

}

function formAjax() {
    $(document).ready(function () {
        clearErrorInputs();

        var options = {
            type: 'post',
            error: function (xhr, status, error) {
                setError(xhr);
            },
            success: function (response, status, error) {

                if (status == 'success') {
                    if (response.url) {
                        if (response.url == 'function') {
                            // reloadFunctionPage();
                        } else {
                            window.location.href = response.url;
                        }
                    } else {
                        window.location.href = getUri();
                    }
                } else {
                    alert('ERRO não esperado!');
                }

                return true;
            }
        };

        return $(".frm-ajax").ajaxForm(options);
    });
}

loadingLibs();
