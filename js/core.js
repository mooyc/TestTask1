$('.main-btn-submit').on("click", function() {
    $.ajax({ 
        type: "POST", 
        enctype: "multipart/form-data",
        processData: false,
        contentType: false,
        url: "/php/ajax.php", 
        //  dataType: "json", 
        data: new FormData($('#upload-form')[0]),
        success: function(data) {
            if ( data.status ) {
                toastr.success("Файл успешно загружен");
                $('.main-status_indicator').css('background-color', '#32a852');
                $('.main-status_indicator_text').html('Загружено');

                const output = $('.output-form');
                output.html('<h3>Полученные данные:</h3>');

                data.data.forEach(function(value, key) {
                    if (value.text && value.count) {
                        output.append(`<p>${value.text} - ${value.count}</p>`);
                    } else {
                        output.append(`<p>${value.text} = 0</p>`);
                    }
                });
                ;
                //const output = $('.output-form'); 
                //output.html('<h3>Полученные данные:</h3>');
                


            } else {
                toastr.error(data.message);
                $('.main-status_indicator').css('background-color', 'red');
                $('.main-status_indicator_text').html('Не загружено');
            }
        }
    });
});
