const copy = value => {
    navigator.clipboard.writeText(value).then(function () {
        alert('Значение скопировано в буфер обмена: ' + value);
    }).catch(function (err) {
        console.error('Не удалось скопировать значение: ', err);
    });
};
export default copy;
