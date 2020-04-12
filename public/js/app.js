function logoutClick() {
    $('#logout-form').submit();
}

$('.clickable').click(function(){
    window.location.href = $(this).data('url');
});
