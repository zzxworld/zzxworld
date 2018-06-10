import swal from 'sweetalert';

export function successAlert(message) {
    swal('', message, 'success');
}

export function warningAlert(message) {
    swal('', message, 'warning');
}

export function errorAlert(message) {
    swal('', message, 'error');
}

export function confirmAlert(message, callback) {
    swal({
        title: '',
        text: message,
        buttons: ['取消', '确定'],
        dangerMode: true,
    }).then(confirmed => {
        if (confirmed) {
            callback();
        }
    });
}

export function closeAlert() {
    swal.close();
}
