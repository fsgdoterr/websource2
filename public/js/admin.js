$('document').ready(function() {
    $('#ssetings').click(function() {
        $('.ssetings').css('display', 'block');
        $('.messages').css('display', 'none');
    });
    $('#messages').click(function() {
        $('.messages').css('display', 'block');
        $('.ssetings').css('display', 'none');
    });
})