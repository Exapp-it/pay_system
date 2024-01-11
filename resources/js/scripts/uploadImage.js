export default function uploadImage() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    const errorMessageElement = document.getElementById('errorMessage');
    errorMessageElement.textContent = ''

    const formData = new FormData();
    formData.append('order', this.image);

    fetch(this.url, {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': csrfToken,
            'Accept': 'application/json',
        },
    })
        .then(response => {
            this.formActive = false;
            if (!response.ok) {
                return response.json().then(errorData => {
                    if (errorData.order && errorData.order.length > 0) {
                        throw new Error(errorData.order[0]);
                    } else {
                        throw new Error('Произошла ошибка валидации');
                    }
                });
            }
            return response.json();
        })
        .then(data => {
            console.log(data);
            setInterval(sendRepeatRequest, 1000);
        })
        .catch(error => {
            errorMessageElement.textContent = error.message;
            this.formActive = true;
        });
};

