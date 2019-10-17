window.ucfirst = e => e.trim().charAt(0).toUpperCase() + e.slice(1)
window.ucwords = e => e.trim().split(/\s+/igm).map(ucfirst).join(' ')
window.notify = e => {
    $.notify({
        icon: e.icon,
        message: `${e.message}.`,
    },{
        element: 'body',
        position: e.position,
        type: e.type ? e.type : 'info',
        allow_dismiss: false,
        newest_on_top: e.newest_on_top ? e.newest_on_top : true,
        showProgressbar: e.showProgressbar,
        placement: {
            from: e.from ? e.from : 'bottom',
            align: e.align ? e.align : 'right',
        },
        offset: e.offset ? e.offset : 20,
        spacing: e.spacing ? e.spacing : 2,
        z_index: e.z_index ? e.z_index : 1031,
        delay: e.delay ? e.delay : 3000,
        timer: e.timer ? e.timer : 500,
        url_target: e.url_target ? e.url_target : '_blank',
        mouse_over: e.mouse_over,
        animate: {
            enter: e.enter ? e.enter : 'animated fadeInRight',
            exit: e.exit ? e.exit : 'animated fadeOutUp',
        },
        onShow: e.onShow,
        onShown: e.onShown,
        onClose: e.onClose,
        onClosed: e.onClosed,
        icon_type: 'class',
        template: e.template ? e.template :
        `
            <div data-notify="container" class="col-xs-11 col-sm-3 alert alert-{0}" role="alert">
                <button type="button" aria-hidden="true" class="close" data-notify="dismiss">×</button>
                <p class="m-0 p-0" data-notify="message"><i data-notify="icon"></i>{2}</p>
                <div class="progress" data-notify="progressbar">
                    <div class="progress-bar progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>
                </div>
                <a href="{3}" target="{4}" data-notify="url"></a>
            </div>
        `
        // <h6 class="m-0 p-0" data-notify="title" style="font-weight: bold;">{1}</h6>
    })
}
