<script>



    function deleteProduct(productId){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });
        $.ajax({
            url:"{{ route('delete_from_cart') }}",
            type: "POST",
            data: {
                'product_id' : productId,
            },
            success: function (response){
                if(response[0] === 'info' ){
                    bootbox.alert(response[1]);
                    location.reload();


                    $('.dropdown').toggle();
                }

            },
        });
    }

    function updateProduct(productId, quantity){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            }
        });

        $.ajax({
            url:"{{ route('update_product_quantity') }}",
            type: "POST",
            data: {
                'product_id' : productId,
                'quantity' : quantity,
            },
            success: function (response){
                if(response[0] === 'info' ){
                    bootbox.alert(response[1]);
                    setTimeout(
                        function()
                        {
                            location.reload();

                        },
                        2000);
                }

            },
        });
    }

</script>