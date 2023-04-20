console.log("sadsa");

ajaxPromise("module/shopCart/ctrl/ctrl_shopCart.php?op=checkStock", 'POST', 'JSON', { 'id_car': 1 })
        .then(function (data) {
            console.log(data);
        }).catch(function() {
            console.log("error ajaxForSearch CheckStock");
        });