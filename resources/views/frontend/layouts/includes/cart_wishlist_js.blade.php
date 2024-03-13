<script>
    // $(document).ready(function() {
    // Login validation msg
    if ({{ $errors->count() }}) {
        Swal.fire({
            title: 'Error',
            icon: 'error',
            html: jQuery("#error_msg").html(),
            showCloseButton: true,
        })
    }

    // cartShow()
    cartMenu()
    // wishlistShow()

    // function cartShow() {
    //     $.ajax({
    //         url: '{{ route('frontend.cart.show') }}',
    //         method: 'get',
    //         success: function(res) {
    //             if (res.status == 'success') {
    //                 $('#cart').html(res.html);
    //             }
    //         }
    //     });
    // }

    function cartMenu() {
        $.ajax({
            url: '{{ route('frontend.cart.cartMenu') }}',
            method: 'get',
            success: function(res) {
                if (res.status == 'success') {
                    $('#cartMenu').html(res.html);
                }
            }
        });
    }

    function cart(e, product_id) {
        e.preventDefault();
        $.ajax({
            url: '{{ route('frontend.cart.store') }}',
            type: 'POST',
            data: {
                "_token": "{{ csrf_token() }}",
                'product_id': product_id,
            },
            success: res => {
                // cartShow()
                cartMenu()
                $('#add_to_cart_modal').modal('show')
                toast('success', res.message)
            },
            error: err => {}
        });
    }

    function cartDelete(e, cart_id) {
        e.preventDefault();
        $.ajax({
            url: '{{ route('frontend.cart.destroy') }}',
            type: 'delete',
            data: {
                id: cart_id,
            },
            success: res => {
                // cartShow()
                cartMenu()
                toast('success', res.message)
            },
            error: err => {}
        });
    }
</script>
