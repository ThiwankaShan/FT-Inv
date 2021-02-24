
document.addEventListener("DOMContentLoaded", event => {

    const createForm = document.querySelector('#create_item_form');
    const submitButton = document.querySelector('#btn_submit');
    const showCodesButton = document.querySelector('#preview');

    pristineCreateForm = new Pristine(createForm);


    new AutoNumeric('#gross_price', {
        decimalCharacter: '.',
        digitGroupSeparator: ',',
        unformatOnSubmit: true
    });

    new AutoNumeric('#tax', {
        decimalCharacter: '.',
        digitGroupSeparator: ',',
        unformatOnSubmit: true
    });

    submitButton.addEventListener("click", async function () {

        var valid = pristineCreateForm.validate();

        if (valid) {
            createForm.submit();
        }

    })

    showCodesButton.addEventListener("click", async function () {

        var valid = pristineCreateForm.validate();

        if (valid) {
            showCodes();
        }

    })

})


