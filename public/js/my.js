$(document).ready(function(){
    const productImage = $("#productImage");
    const productFileName = $("#productFileName");

    productImage.change(function(e){
        var fileName = e.target.files[0].name;
        productFileName.html('<i class="fa fa-camera"></i> ' + fileName);
    });
});

function dropdown() {
    return {
        show: false,
        open() { this.show = true },
        close() { this.show = false },
        isOpen() { return this.show === true },
    }
}

function modal() {
    return {
        open: false,
        trigger: {
            ['@click']() {
                this.open = true
            },
        },
        close: {
            ['@click']() {
                this.open = false
            },
        },
        content: {
            ['x-show']() {
                return this.open
            },
            ['@click.away']() {
                this.open = false
            },
        }
    }
}

/*
$('#profileInfoForm').submit(function(e){
    e.preventDefault();
    let firstName = $('#firstName').val();
    let middleName = $('#middleName').val();
    let lastName = $('#lastName').val();
    let contactNumber = $('#contactNumber').val();
    let email = $('#email').val();
    let city = $('#city').val();
    let address = $('#address').val();
    let _token = $('input[name=_token]').val();

    $.ajax({
        url: $(this).attr('action'),
        type: 'PUT',
        data: $(this).serialize(),
        success:function(response)
        {
            if(response)
            {
                console.log(response);
            }
        },
        error:function(data)
        {
            console.log(data.responseJSON);
        }
    });
});
 */

