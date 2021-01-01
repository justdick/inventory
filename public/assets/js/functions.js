function message(type, content){
    MsgPop.closeAll();
    MsgPop.displaySmall = true;
    MsgPop.open({
    Type: type,
        Content: content
    });
}

function ajax(url, formName){
    var data = $(formName).serializeArray();
    
    $.post(url, data, function(status){
        if(status == 1){
            console.log('1');
            return 1;
        }else{
            console.log('2');

          return status;
        }
        // alert("Data: " + data + "\nStatus: " + status);
    });

    // $.ajax({
    //     type: "POST",
    //     url: url,
    //     data: $(formName).serialize(),
    //     success: function(status) {
    //         if(status == 1){
    //             console.log('1');
    //             return 1;
    //         }else{
    //             console.log('2');

    //           return status;
    //         }
    //     }
    // });
}