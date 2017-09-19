module.exports = {
    init(){
        if(window.Laravel.userId !== null) {
            window.Echo.private(`CodeEdu.User.Models.User.${window.Laravel.userId}`)
                .notification((notification) => {
                    console.log(notification);
                    window.$.notify({message:'O livro ' + notification.book.title + ' foi exportado!' }, {type: 'success'});
                    //window.$.notify({message:'O livro foi exportado!' }, {type: 'success'});
                })
        }
    }
};