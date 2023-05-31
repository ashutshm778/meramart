<div class="col-md-12">
    <div id="product_tables">
        @include('backend.products.product_stocks.product')
    </div>
</div>

<script type="text/javascript">

$(document).ready(function(){
        all_checked_data();
    });

    $("#selectAll").click(function(){
       $('input:checkbox').not(this).prop('checked', this.checked);
            $(".check_select").each(function ()
            {
                var thenum = $(this).attr("id").replace( /^\D+/g, '');
                save_local_data('product',thenum);
            });
   });


   $('.check_select').click(function() {
        if ($('.check_select:checked').length == $('.check_select').length) {
            $('#selectAll').prop('checked', true);
        } else {
            $('#selectAll').prop('checked', false);
        }
    });


</script>
