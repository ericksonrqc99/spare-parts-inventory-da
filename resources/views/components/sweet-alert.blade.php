<div x-data="{open: false}" x-show="open" @sweet-alert.window="
    Swal.mixin({
        toast: true,
        position: 'top-end', 
        showConfirmButton: false,
        timer: 5000, 
        timerProgressBar: true, 
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer);
            toast.addEventListener('mouseleave', Swal.resumeTimer);
        }
    }).fire({
        title: event.detail.title,
        icon: event.detail.icon,
        text: event.detail.text,
    });
    open = true;
    ">
</div>