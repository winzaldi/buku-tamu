$(function () {
    $('.remove').click(function (event) {
        if (!confirm('Are you sure you want to delete this record?')) {
            return;
        }
        var id = $(this).data('id');
        $.ajax({
            url: "index.php",
            type: "get",
            data: 'action=remove' + '&id=' + id,
            success: function (data) {
                $('#record' + id).hide("fast", function () {
                    $(this).remove();
                });
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                // alert('Error removing data!');
            }
        });
    });

    var editing = false;
    var editable_object = null;
    var editable_text = '';

    $(".editable").click(function() {
        if (editing) {
            return;
        }
        editing = true;
        $(this).removeClass("success");
        $(this).removeClass("fail");
        editable_object = this;
        editable_text = $(this).text();
        $(this).attr("contenteditable", "true");
        $(this).focus();
    });

    $(".editable").blur(function () {
        var column = $(this).data('column');
        var value = $(this).text();
        var id = $(this).data('id');

        $(this).addClass("loading");
        $(this).attr("contenteditable", "false");

        $.ajax({
            url: "index.php",
            type: "get",
            data: 'action=edit' + '&column=' + column + '&value=' + value + '&id=' + id + '&type=ajax',
            success: function (response) {
                if (response.error) {
                    $(editable_object).text(editable_text);
                    $(editable_object).addClass("fail");
                    // alert(response.error.msg);
                } else {
                    $(editable_object).addClass("success");
                }
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                $(editable_object).text(editable_text);
                $(editable_object).addClass("fail");
                // alert('Error! Changes not saved!');
            },
            complete: function (response) {
                $(editable_object).removeClass("loading");
                editing = false;
                editable_object = null;
            }
        });
    });
});