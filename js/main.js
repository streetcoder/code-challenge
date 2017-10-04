(function ($) {

    $("#form_find_book").submit(function(){
        if($('#find_book').val() == ''){
            alert('Write something on the textbox');
            return false;
        }
    });

    $('.wl-add-btn').click(function(){

        var $this = $(this);
        var id = $(this).data( "id" );
        var title = $(this).data( "title" );
        var author = $(this).data( "author" );
        var thumb = $(this).data( "thumb" );
        var description = $(this).data( "description" );
        var pageCount = parseInt($(this).attr('data-pageCount'));

        $.ajax({
            url : '/ajax-request.php',
            type: "POST",
            data:  {id: id, title: title, author: author, thumb: thumb, description: description, pageCount: pageCount, action: 'add_item' },
            success: function(data) {

                if( $( ".no-books-info" ).hasClass('no-books-info') ){
                   $( ".no-books-info" ).remove();
                }

                $("#wishlist-item-container").append(data);

                $('#wishlist-item-container').animate({scrollTop: $('#wishlist-item-container').prop("scrollHeight")}, 500);

                $this.text('Added');


            }
        });

    });

})(jQuery);