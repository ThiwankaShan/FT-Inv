document.addEventListener("DOMContentLoaded", event => {
const createForm = document.querySelector('#create_item_form');
const submitButton = document.querySelector('#btn_submit');
const showCodesButton = document.querySelector('#preview');

pristineCreateForm = new Pristine(createForm);


new AutoNumeric('#gross_price', {
    decimalCharacter : '.',
    digitGroupSeparator : ',',
});

new AutoNumeric('#tax', {
    decimalCharacter : '.',
    digitGroupSeparator : ',',
});

submitButton.addEventListener("click", async function () {

    var valid = pristineCreateForm.validate();

    if (valid){
        createForm.submit();
    }

})
})


