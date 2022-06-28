$(function () {

    $('.js-like-toggle').on('click', function () {
        var likeItemId = $('.js-like-toggle').data('item_id'); //.data は data-◯◯ で書かれたものを認識する
        console.log(likeItemId);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            dataType: 'json',
            url:'likes/',  //routeの記述
            type: 'POST', //受け取り方法の記述（GETもある）
            data: {
                "id": likeItemId, //コントローラーに渡すパラメーター  
            },
        })

        // Ajaxリクエストが成功した場合
        .done(function (data) {
            console.log(data);
            //lovedクラスを追加
            $this.toggleClass('loved');

            //.likesCountの次の要素のhtmlを「data.postLikesCount」の値に書き換える
            $this.next('.likesCount').html(data.itemLikesCount);
        })
        // Ajaxリクエストが失敗した場合
        .fail(function (data, xhr, err) {
            //ここの処理はエラーが出た時にエラー内容をわかるようにしておく。
            //とりあえず下記のように記述しておけばエラー内容が詳しくわかります。笑
            console.log('エラー');
            console.log(err);
            console.log(xhr);
        });
    });
});