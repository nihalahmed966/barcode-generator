<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
        integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Barcode Generator</title>
</head>

<body>
    <div class="container d-flex flex-column vh-100 justify-content-center align-items-center">

        <div class="row justify-content-center  w-100">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title text-center">
                            Barcode Generator
                        </h5>
                        <form id="barcodeForm">
                            <div class="form-group">
                                <label for="barcodeSymbology" class="form-label"><strong>Barcode
                                        Symbology</strong>( If Not selected then by default code128 used)</label>
                                <select name="symbology" class="form-select">
                                    <option value="">Select Symbology</option>
                                    <option value="code128">Code 128</option>
                                    <option value="codabar">Codabar</option>
                                    <option value="code25">Code 25</option>
                                    <option value="code39">Code 39</option>
                                </select>
                            </div>
                            <div class="form-group mt-2">
                                <label for="barcodeText" class="form-label"><strong>Text</strong></label>

                                <div class="input-group mb-3">

                                    <input type="text" id="barcodeText" name="text" class="form-control">
                                    <button class="btn btn-outline-dark" id="generateCode" type="button"
                                        id="button-addon1"><i class="fa fa-sync"></i></button>
                                </div>
                            </div>
                            <div class="form-group text-center mt-3">
                                <button type="button" id="generateBarcode" class="btn btn-dark">Generate</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6" style="display: none;" id="imagePrint">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title text-center">Barcode</h4>
                        <div class="row">
                            <div class="col-md-12 text-center" id="showImage">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.5.4/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-beta1/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-center",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    $("#generateCode").on('click', function(event) {
        event.preventDefault();
        $.post('<?='http://' . $_SERVER['HTTP_HOST']?>/CPU/Barcode/generate.php', function(data) {
            $('#barcodeText').val(data);
        })
    });
    $('#generateBarcode').on('click', function(e) {
        e.preventDefault();
        $.ajax({
            url: '<?='http://' . $_SERVER['HTTP_HOST']?>/CPU/Barcode/barcode.php',
            type: "POST",
            data: $('#barcodeForm').serialize(),
            success: function(data) {
                if (data == 'failed') {
                    toastr.error('Text Field can not be empty ');
                } else {
                    $("#showImage").html(data);
                    $("#imagePrint").css('display',
                        'block');
                    toastr.success('Barcode Generated');

                }
            }
        });
    });

    function base64encode(binary) {
        return btoa(unescape(encodeURIComponent(binary)));
    }
    </script>
</body>

</html>