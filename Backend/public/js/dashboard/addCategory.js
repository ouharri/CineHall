class FormValidation {
    item = document;
    formValues = {
        category: "",
        desc: "",
    }
    formInput = {
        category: "",
        desc: "",
    }
    errorValues = {
        categoryErr: "",
        descErr: ""
    }

    showErrorMsg(item, index, msg) {
        const form_group = item.getElementsByClassName('form-group')[index]
        console.log(form_group)
        form_group.classList.add('error');
        form_group.getElementsByTagName('span')[0].textContent = msg;
    }
    showSuccessMsg(item,index) {
        const form_group = item.getElementsByClassName('form-group')[index]
        form_group.classList.remove('error')
        form_group.classList.add('success')
    }


    getInputs(item) {
        this.formInput.category = item.getElementById('category')
        this.formInput.desc = item.getElementById('desc')
    }

    getInputsValue(item) {
        this.formValues.category = item.getElementById('category').value.trim()
        this.formValues.desc = item.getElementById('desc').value.trim()
    }

    validateCategory(item) {
        if (this.formValues.category === "") {
            this.errorValues.categoryErr = "* Please Enter Category"
            this.showErrorMsg(item, 0, this.errorValues.categoryErr)
        } else if (this.formValues.category.length <= 4) {
            this.errorValues.categoryErr = "* Category must be atleast 5 Characters"
            this.showErrorMsg(item, 0, this.errorValues.categoryErr)
        } else if (this.formValues.category.length > 50) {
            this.errorValues.categoryErr = "* Category should not exceeds 30 Characters"
            this.showErrorMsg(item, 0, this.errorValues.categoryErr)
        } else {
            this.errorValues.categoryErr = ""
            this.showSuccessMsg(item,0)
        }
    }

    validateDesc(item) {
        if (this.formValues.desc === "") {
            this.errorValues.descErr = "* Please Enter a Description"
            this.showErrorMsg(item, 1, this.errorValues.descErr)
        } else if (this.formValues.desc.length <= 4) {
            this.errorValues.descErr = "* Description must be atleast 5 Characters"
            this.showErrorMsg(item, 1, this.errorValues.descErr)
        } else if (this.formValues.desc.length > 100) {
            this.errorValues.descErr = "* Description should not exceeds 100 Characters"
            this.showErrorMsg(item, 1, this.errorValues.descErr)
        } else {
            this.errorValues.descErr = ""
            this.showSuccessMsg(item,1)
        }
    }

    alertMessage() {
        const {categoryErr, descErr} = this.errorValues
        if (categoryErr === "" && descErr === "") {
            document.getElementsByClassName('form')[0].submit()
        } else {
            Swal.fire(
                'Give Valid Inputs!',
                'Click ok to Continue!',
                'error'
            )
        }
    }

    removeInputs(item) {
        const form_groups = item.getElementsByClassName('form-group')
        Array.from(form_groups).forEach(element => {
            element.getElementsByTagName('input')[0].value = ""
            element.getElementsByTagName('span')[0].textContent = ""
            element.classList.remove('success')
        })
    }

}

function renderValidation() {

    const ValidateUserInputs = new FormValidation()
    document.getElementsByClassName('form')[0].addEventListener('submit', event => {
        const addCategoryBox = document.getElementsByClassName('addCategoryBox');
        event.preventDefault()
        for (let i = 0; i < addCategoryBox.length; i++) {
            const itemBox = addCategoryBox[i];
            ValidateUserInputs.formInput.category = itemBox.getElementsByClassName('category')[0]
            ValidateUserInputs.formInput.desc = itemBox.getElementsByClassName('desc')[0]

            ValidateUserInputs.item = itemBox;
            ValidateUserInputs.formValues.category = itemBox.getElementsByClassName('category')[0].value.trim()
            ValidateUserInputs.formValues.desc = itemBox.getElementsByClassName('desc')[0].value.trim()
            ValidateUserInputs.validateCategory(itemBox)
            ValidateUserInputs.validateDesc(itemBox)
            ValidateUserInputs.alertMessage()

            $(ValidateUserInputs.formInput.category).on("change keyup paste", function(e){
                let elem = e.target;
                ValidateUserInputs.formValues.category = elem.value.trim()
                ValidateUserInputs.validateCategory(elem.parentElement.parentElement.parentElement);
            })
            $(ValidateUserInputs.formInput.desc).on("change keyup paste", function(e){
                let elem = e.target;
                ValidateUserInputs.formValues.desc = elem.value.trim()
                console.log('nnn',elem.parentElement.parentElement)
                ValidateUserInputs.validateDesc(elem.parentElement.parentElement.parentElement)
            })
        }
    })
}
window.addEventListener('load', () => {
    renderValidation();
})


document.getElementById('addNewType').addEventListener('click', () => {
    const html = document.createElement('div');
    html.classList = 'box-border addCategoryBox border-radius-2xl p-3 mt-4 position-relative';
    html.innerHTML = `
        <i class="removeCategory fa-solid fa-x cursor-pointer p-2 text-danger position-absolute" style="right:7px;top: 7px;z-index: 10 "></i>
        <div class="form-group">
                <label for="category" class="form-control-label">
                Libel
                <input class="category form-control" type="text" placeholder="Type Product Name"
                       name="productType[]"
                       id="category">
                </label>
                <i class="ion-ios-checkmark"></i>
                <i class="ion-android-alert"></i>
                <span></span>
        </div>
        <div class="form-group">
            <label for="desc">
                Description
                <textarea class="desc form-control" id="desc" rows="1"
                          placeholder="Add description for this Type"
                          name="desc[]"></textarea>
            </label>
            <i class="ion-ios-checkmark"></i>
            <i class="ion-android-alert"></i>
            <span></span>
        </div>`;
    const tmp = document.getElementById('addBox').appendChild(html);
    tmp.scrollIntoView();
    const category = document.getElementsByClassName('removeCategory');
    for (let i = 0; i < category.length; i++) {
        category[i].addEventListener('click', (e) => {
            const elem = e.target;
            const parent = elem.parentElement;
            parent.remove();
        });
    }
    renderValidation();
});