$(function (goodbutton) {
    $('#goodbutton').on('click', function() {
        $this = $(this);
        const $data = $this.children('hidden').val();

        $.ajax({
            Type:'POST',
            url:'/good',
            dataType:'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{ "id":$data }
        }).done(function () {
            $this.children('i').toggleClass("active");
        }).fail(function () {
            alert("通信に失敗しました。");
        });
    })
});