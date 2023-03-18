$(document).ready(function () {
    $(document).on("click", ".delete-btn", function (e) {
        e.preventDefault();
        let href = $(this).data("href"),
            entityId = $(this).data("entity_id"),
            token = $(this).data("token"),
            csrfToken = jQuery('[name="csrf-token"]').attr("content");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes Delete it!",
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    type: "post",
                    url: href,
                    data: {
                        _token: token,
                        id: entityId,
                    },
                    success: function (response) {
                        if (response.status == true) {
                            jQuery(".alert-success").removeClass("d-none");
                            jQuery(".alert-success").text(response.message);
                            setTimeout(function () {
                                jQuery(".alert-success").addClass("d-none");
                            }, 5000);
                            $(".deleted-row-" + response.id).remove();
                            Swal.fire(
                                "Deleted ",
                                "Delete Successfully",
                                "success"
                            );

                            // location.reload();
                        }
                    },
                    error: function (response) {},
                });
            }
        });
    });

    $(document).on("click", ".btn-save", function (event) {
        $(".btn-save").attr('disabled', true);
        event.preventDefault();
        let form = jQuery(this).parents("form"),
            formAction = form.attr("action"),
            // formData = new FormData($('.formAction')[0]);
            formData = new FormData($(this).parents("form")[0]);

        jQuery(".is-invalid").removeClass("is-invalid");
        jQuery.ajax({
            type: "post",
            url: formAction,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $(".btn-save").removeAttr("disabled")
                if (response.status) {
                    $(".formAction")[0].reset();
                    $("img").removeAttr("src");
                    jQuery(".alert-success").removeClass("d-none");
                    jQuery(".invalid-response").remove();
                    jQuery(".field_wrapper .row").remove();
                    jQuery(".field_wrapper_rep .row").remove();
                    jQuery(".field_wrapper_fac .row .col-lg-4").remove();
                    jQuery(".dz-preview").remove();
                    jQuery("#show").attr("src", "");

                    jQuery(".wizard-step").attr("data-wizard-state", "current");
                    jQuery(".wizard-step")
                        .first()
                        .attr("data-wizard-state", "pending");

                    jQuery(".alert-success").text(response.message);
                    setTimeout(function () {
                        jQuery(".alert-success").addClass("d-none");
                    }, 5000);
                    if (response.status) {
                        jQuery(".alert-success").removeClass("d-none");
                        jQuery(".invalid-response").remove();
                        jQuery(".alert-success").text(response.message);

                        Swal.fire(
                            "Operation Successful",
                            response.message,
                            "success"
                        );

                        setTimeout(function () {
                            jQuery(".alert-success").addClass("d-none");
                        }, 5000);
                    }
                    if (response.type == 3) {
                        location.reload();
                    }
                } else {
                    jQuery(".alert-success").text(response.message);
                    setTimeout(function () {
                        jQuery(".alert-danger").addClass("is-invalid");
                    }, 5000);
                }
            },
            error: function (response) {
                $(".btn-save").removeAttr("disabled")
                /* let myErrors = Object.values(response.responseJSON.errors)[0][0] */
                console.log(response);
                let error = response.responseJSON;
                jQuery(".invalid-response").remove();
                for (let index in error.errors) {
                    form.find('[name="' + index + '"]').addClass("is-invalid");
                    form.find('[name="' + index + '"]')
                        .parents(".form-group")
                        .append(
                            '<div class="invalid-response mt-2" style="color: #f64e60">' +
                                error.errors[index][0] +
                                "</div>"
                        );
                }
                jQuery(".alert-danger").removeClass("d-none");
                jQuery(".alert-danger").text(response.message);
                setTimeout(function () {
                    jQuery(".alert-danger").addClass("d-none");
                }, 5000);
                Swal.fire({
                    title: " Something went wrong!",
                    icon: "error",
                    text: error.message,
                    showClass: {
                        popup: "animate__animated animate__fadeInDown",
                    },
                    hideClass: {
                        popup: "animate__animated animate__fadeOutUp",
                    },
                });
            },
        });
    });

    $(document).on("click", ".btn-update", function (event) {
        event.preventDefault();
        $(".btn-update").attr('disabled', true);
        let form = jQuery(this).parents("form"),
            formAction = form.attr("action");
        formData = new FormData($(".formAction")[0]);
        jQuery(".is-invalid").removeClass("is-invalid");
        jQuery.ajax({
            type: "post",
            url: formAction,
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                $(".btn-update").removeAttr("disabled")
                if (response.status) {
                    jQuery(".alert-success").removeClass("d-none");
                    jQuery(".invalid-response").remove();
                    jQuery(".alert-success").text(response.message);

                    Swal.fire(
                        "Operation Successful",
                        response.message,
                        "success"
                    );

                    setTimeout(function () {
                        jQuery(".alert-success").addClass("d-none");
                    }, 5000);
                }
            },
            error: function (response) {
                $(".btn-update").removeAttr("disabled")
                jQuery(".alert-danger").removeClass("d-none");
                jQuery(".alert-danger").text("Something went wrong");
                let error = response.responseJSON;

                Swal.fire({
                    title: "  Something went wrong!",
                    icon: "error",
                    text: response.message,
                    showClass: {
                        popup: "animate__animated animate__fadeInDown",
                    },
                    hideClass: {
                        popup: "animate__animated animate__fadeOutUp",
                    },
                });
                jQuery(".invalid-response").remove();
                for (let index in error.errors) {
                    form.find('[name="' + index + '"]').addClass("is-invalid");
                    form.find('[name="' + index + '"]')
                        .parents(".form-group")
                        .append(
                            '<div class="invalid-response mt-2" style="color: #f64e60">' +
                                error.errors[index][0] +
                                "</div>"
                        );
                }
                setTimeout(function () {
                    jQuery(".alert-danger").addClass("d-none");
                }, 5000);
            },
        });
    });
    $(document).on("click", ".pagination a", function (event) {
        event.preventDefault();
        let page = $(this).attr("href").split("page=")[1];
        fetch_data(page);
    });
    function fetch_data(page) {
        $.ajax({
            url: window.location.href + "?page=" + page,
            success: function (data) {
                $("#table_data").html(data);
            },
        });
    }
});
