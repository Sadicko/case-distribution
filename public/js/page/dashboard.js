if (typeof jQuery === "undefined") {
    throw new Error("jQuery plugins need to be before this file");
}


$(function () {

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(document).ready(function () {
        $("#initTable")
            .addClass("nowrap")
            .dataTable({
                responsive: false,
                stateSave: true,
                columnDefs: [{ targets: [-1, -3], className: "dt-body-right" }],
            });
    });

    $(document).ready(function () {
        $("table.display")
            .addClass("nowrap")
            .dataTable({
                responsive: false,
                stateSave: true,
                columnDefs: [{ targets: [-1, -3], className: "dt-body-right" }],
            });
    });

    $(document).ready(function () {
        $("#initResponsiveTable")
            .addClass("nowrap")
            .dataTable({
                responsive: true,
                stateSave: true,
                columnDefs: [{ targets: [-1, -3], className: "dt-body-right" }],
            });
    });


    // ==============SELECT 2=============
    $(".select2").select2({
        // theme: "bootstrap5",
        allowClear: true,
        placeholder: "Choose an option",
    });

    $(".select2-multiple").select2({
        // theme: 'bootstrap4',
        placeholder: "Choose options",
        allowClear: true,
    });

    $(".select2-tags").select2({
        // theme: 'bootstrap4',
        placeholder: "Choose options",
        allowClear: true,
        tags: true,
    });

    $(".select2-multiple-tags").select2({
        // theme: 'bootstrap4',
        placeholder: "Choose options",
        allowClear: true,
        tags: true,
        multiple: true,
    });

    // datetime
    $('.datetime').datetimepicker({
        format: 'd/m/Y H:i',
        maxDate: new Date(),
    });

    $('.date').datetimepicker({
        timepicker: false,
        format: 'd/m/Y',
        maxDate: new Date(),
    });

    $('.year').datetimepicker({
        timepicker: false,
        format: 'Y',
    });

    // Tooltip
    $('[data-bs-toggle="tooltip"]').tooltip();


    $(document).on('change', "#status", function () {

        if ($(this).val() == 'Move to trash') {
            $('.status-info').show();
        } else {
            $('.status-info').hide();
        }
    })


    // check image upload
    function checkFile(val) {
        let valid;
        switch (val.substring(val.lastIndexOf('.') + 1).toLowerCase()) {
            case 'jpeg': case 'jpg': case 'png': case 'pdf':
                valid = true;
                break;

            default:
                valid = false;
                break;
        }

        return valid;
    }


    $(document).on('change', '#court_type', function () {

        let options = ['<option></option>'];

        $.ajax({
            url: "/locations/fetch",
            type: "POST",
            dataType: "json",
            data: { court_type: $('#court_type').val() },
            success: function (response) {
                $.each(response, function (index, item) {

                    let option = '<option value="' + item.id + '">' + item.name + '</option>';

                    options.push(option);
                })

                $('#location').empty().append(options).trigger('change');
            },
            error: function () {
                toastr.error('An error occurred during request.');
            }
        });
    })

    $(document).on('change', '#location', function () {
        let options = ['<option></option>'];
        $.ajax({
            url: "/registry/fetch",
            type: "POST",
            dataType: "json",
            data: { location: $(this).val() },
            success: function (response) {
                $.each(response, function (index, item) {
                    let option = '<option value="' + item.id + '">' + item.name + '</option>';

                    options.push(option);
                })

                $('#registry').empty().append(options);
            },
            error: function () {
                toastr.error('An error occurred during request.');
            }
        });
    })

    $(document).on('change', '#registry', function () {
        let options = ['<option></option>'];
        $.ajax({
            url: "/courts/fetch",
            type: "POST",
            dataType: "json",
            data: { registry: $(this).val() },
            success: function (response) {
                $.each(response, function (index, item) {
                    let option = '<option value="' + item.id + '">' + item.name + '</option>';

                    options.push(option);
                })

                $('#court').empty().append(options);
            },
            error: function () {
                toastr.error('An error occurred during request.');
            }
        });
    })


    $(document).on('click', '#releaseBail', function () {

        if (confirm('Are you sure you want to RELEASE this bail?')) {
            let btn = $(this);

            let slug = btn.data('slug');

            btn.html('<i class="fas fa-spin fa-spinner"></i> Releasing...');

            $.post('/bail/release', { slug: slug }, function (data) {

                if (data.success) {
                    btn.hide();
                    $('.show_released').show()
                    toastr.success(data.success);

                    livewire.emit('reloadComponent');

                    window.location.reload();

                } else {
                    btn.html('<i class="fas fa-check"></i> Release bail').show();
                    toastr.error(data.error);
                }
            })
        }
    })


    $(document).on('click', '#releaseSurety', function () {

        if (confirm('Are you sure you want to RELEASE this surety document?')) {
            let btn = $(this);

            let slug = btn.data('slug');

            btn.html('<i class="fas fa-spin fa-spinner"></i> Releasing...');

            $.post('/surety/release', { slug: slug }, function (data) {

                if (data.success) {
                    toastr.success(data.success);
                    btn.html('<i class="fas fa-check"></i> Release Document');
                    window.location.reload();
                } else {
                    btn.html('<i class="fas fa-check"></i> Release Document');
                    toastr.error(data.error);
                }
            })
        }
    })


    $(document).on('click', '#checkAll', function () {
        if ($(this).is(':checked')) {
            $('.singleCheck').prop('checked', true);
        } else {
            $('.singleCheck').prop('checked', false);
        }
    })

    $(document).on('click', '.singleCheck', function () {
        enableCheckAll();
    })


    function getCheckedItemCount() {

        let checkboxes = $('.singleCheck');

        let totalChecked = 0;
        $.each(checkboxes, function (index, item) {
            // console.log()
            if (item.checked == true) {
                totalChecked++
            }
        })

        return totalChecked;
    }

    enableCheckAll();

    function enableCheckAll() {

        if (getCheckedItemCount() == $('.singleCheck').length) {
            $('#checkAll').prop('checked', true);
        } else {
            $('#checkAll').prop('checked', false);
        }
    }


    //clear input on audit trail page
    $(document).on("click", ".clear-search", function (e) {
        e.preventDefault();

        $("input").not('[name="_token"]').val("");
        $(".select2").val(null).trigger("change");

        var uri = window.location.href.toString();
        if (uri.indexOf("?") > 0) {
            var clean_uri = uri.substring(0, uri.indexOf("?"));
            window.history.replaceState({}, document.title, clean_uri);
        }
        // $("#cases_table").load(location.href + " #cases_table");
        window.location.reload();
    });


    $(document).on("click", "#is_expire", function (e) {
        if ($(this).is(":checked")) {
            $('.expire_date').show();
            $('#expire_date').attr('required', 'required');
        } else {
            $('.expire_date').hide();
            $('#expire_date').removeAttr('required');
        }
    })



    $(document).on('keydown', '#suit_number', function (event) {

        var allowedCharacters = /^[a-zA-Z0-9\/]*$/;
        var key = event.key;

        // Allow navigation keys (arrow keys, backspace, delete, etc.)
        if (event.ctrlKey || event.altKey || event.metaKey || event.key === 'ArrowLeft' || event.key === 'ArrowRight' || event.key === 'Backspace' || event.key === 'Delete') {
            return;
        }

        // Prevent input if the key is not allowed
        if (!allowedCharacters.test(key)) {
            event.preventDefault();
        }
    })

    // Gets today's date in YYYY-MM-DD format
    if ($('.date').length > 0) {
        const today = new Date().toISOString().split('T')[0];
        document.querySelector('.date').setAttribute('max', today);
    }

})
