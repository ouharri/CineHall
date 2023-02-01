class FormValidation {
    item = document;
    formValues = {
        Libel: "",
        Image: "",
        Description: "",
        Quantity: "",
        Price: "",
        BarCode: "",
        Company: "",
    }
    formInput = {
        Libel: "",
        Image: "",
        Description: "",
        Quantity: "",
        Price: "",
        BarCode: "",
        Company: "",
    }
    errorValues = {
        LibelErr: "",
        ImageErr: "",
        DescriptionErr: "",
        QuantityErr: "",
        PriceErr: "",
        BarCodeErr: "",
        CompanyErr: "",
    }

    showErrorMsg(item, index, msg) {
        const form_group = item.getElementsByClassName('form-group')[index]
        // console.log(form_group)
        form_group.classList.add('error');
        form_group.getElementsByTagName('span')[0].textContent = msg;
    }

    showSuccessMsg(item, index) {
        const form_group = item.getElementsByClassName('form-group')[index]
        form_group.classList.remove('error')
        form_group.classList.add('success')
    }

    getInputs(item) {
        this.formInput.Libel = item.getElementById('Libel')
        this.formInput.Image = item.getElementById('image')
        this.formInput.Description = item.getElementById('desc')
        this.formInput.Quantity = item.getElementById('qty')
        this.formInput.Price = item.getElementById('price')
        this.formInput.BarCode = item.getElementById('barCode')
        this.formInput.Company = item.getElementById('company')
    }

    getInputsValue(item) {
        this.formValues.Libel = item.getElementById('Libel').value.trim()
        this.formValues.Image = item.getElementById('image').size
        this.formValues.Description = item.getElementById('desc').value.trim()
        this.formValues.Quantity = item.getElementById('qty').value.trim()
        this.formValues.Price = item.getElementById('price').value.trim()
        this.formValues.BarCode = item.getElementById('barCode').value.trim()
        this.formValues.Company = item.getElementById('company').value.trim()
    }

    validateLibel(item) {
        if (this.formValues.Libel === "") {
            this.errorValues.LibelErr = "* Please Enter Libel"
            this.showErrorMsg(item, 0, this.errorValues.LibelErr)
        } else if (this.formValues.Libel.length <= 4) {
            this.errorValues.LibelErr = "* Libel must be atleast 5 Characters"
            this.showErrorMsg(item, 0, this.errorValues.LibelErr)
        } else if (this.formValues.Libel.length > 50) {
            this.errorValues.LibelErr = "* Libel should not exceeds 30 Characters"
            this.showErrorMsg(item, 0, this.errorValues.LibelErr)
        } else {
            this.errorValues.LibelErr = ""
            this.showSuccessMsg(item, 0)
        }
    }

    validateDesc(item) {
        if (this.formValues.Description === "") {
            this.errorValues.DescriptionErr = "* Please Enter a Description"
            this.showErrorMsg(item, 2, this.errorValues.DescriptionErr)
        } else if (this.formValues.Description.length <= 4) {
            this.errorValues.DescriptionErr = "* Description must be atleast 5 Characters"
            this.showErrorMsg(item, 2, this.errorValues.DescriptionErr)
        } else if (this.formValues.Description.length > 100) {
            this.errorValues.DescriptionErr = "* Description should not exceeds 100 Characters"
            this.showErrorMsg(item, 2, this.errorValues.DescriptionErr)
        } else {
            this.errorValues.DescriptionErr = ""
            this.showSuccessMsg(item, 2)
        }
    }
    validateImage(item) {
        let max = 5;
        if (!this.formValues.Image.value) {
            this.errorValues.ImageErr = "* Please Enter a Image"
            this.showErrorMsg(item, 1, this.errorValues.ImageErr)
        } else if (this.formValues.Image.files[0].size / 1024 / 1024 > max) {
            this.errorValues.ImageErr = "* size image too big !"
            this.showErrorMsg(item, 1, this.errorValues.ImageErr)
            // this.formValues.Image.value = "";
        } else {
            this.errorValues.ImageErr = ""
            this.showSuccessMsg(item, 1)
        }
    }
    validateCompany(item) {
        if (this.formValues.Company === "") {
            this.errorValues.CompanyErr = "* Please Enter a Company"
            this.showErrorMsg(item, 7, this.errorValues.CompanyErr)
        } else if (this.formValues.Company.length <= 4) {
            this.errorValues.CompanyErr = "* Company must be atleast 5 Characters"
            this.showErrorMsg(item, 7, this.errorValues.CompanyErr)
        } else if (this.formValues.Company.length > 50) {
            this.errorValues.CompanyErr = "* Company should not exceeds 100 Characters"
            this.showErrorMsg(item, 7, this.errorValues.CompanyErr)
        } else {
            this.errorValues.CompanyErr = ""
            this.showSuccessMsg(item, 7)
        }
    }
    validateQuantity(item) {
        if (this.formValues.Quantity === "") {
            this.errorValues.QuantityErr = "* Please Enter a Quantity"
            this.showErrorMsg(item, 3, this.errorValues.QuantityErr)
        } else if (this.formValues.Quantity < 0) {
            this.errorValues.QuantityErr = "* Quantity must be Positive"
            this.showErrorMsg(item, 3, this.errorValues.QuantityErr)
        } else {
            this.errorValues.QuantityErr = ""
            this.showSuccessMsg(item, 3)
        }
    }
    validatePrice(item) {
        if (this.formValues.Price === "") {
            this.errorValues.PriceErr = "* Please Enter a Price"
            this.showErrorMsg(item, 5, this.errorValues.PriceErr)
        } else if (this.formValues.Price < 0) {
            this.errorValues.PriceErr = "* Price must be Positive"
            this.showErrorMsg(item, 5, this.errorValues.PriceErr)
        } else {
            this.errorValues.PriceErr = ""
            this.showSuccessMsg(item, 5)
        }
    }
    validateBarCode(item) {
        if (this.formValues.BarCode === "") {
            this.errorValues.BarCodeErr = "* Please Enter a Bar Code"
            this.showErrorMsg(item, 6, this.errorValues.BarCodeErr)
        } else if (this.formValues.BarCode < 0) {
            this.errorValues.BarCodeErr = "* Bar Code must be Positive"
            this.showErrorMsg(item, 6, this.errorValues.BarCodeErr)
        } else {
            this.errorValues.BarCodeErr = ""
            this.showSuccessMsg(item, 6)
        }
    }

    alertMessage() {
        const {LibelErr, ImageErr,DescriptionErr,QuantityErr,PriceErr,BarCodeErr,CompanyErr} = this.errorValues
        if (LibelErr === "" && ImageErr === "" && DescriptionErr === "" && QuantityErr === "" && PriceErr === "" && BarCodeErr === "" && CompanyErr === "") {
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
        event.preventDefault()
        const addProductBox = document.getElementsByClassName('addProductBox');
        for (let i = 0; i < addProductBox.length; i++) {
            const itemBox = addProductBox[i];
            ValidateUserInputs.formInput.Libel = itemBox.getElementsByClassName('Libel')[0]
            ValidateUserInputs.formInput.Image = itemBox.getElementsByClassName('image')[0]
            ValidateUserInputs.formInput.Description = itemBox.getElementsByClassName('desc')[0]
            ValidateUserInputs.formInput.Quantity = itemBox.getElementsByClassName('qty')[0]
            ValidateUserInputs.formInput.Price = itemBox.getElementsByClassName('price')[0]
            ValidateUserInputs.formInput.BarCode = itemBox.getElementsByClassName('barCode')[0]
            ValidateUserInputs.formInput.Company = itemBox.getElementsByClassName('company')[0]

            ValidateUserInputs.item = itemBox;
            ValidateUserInputs.formValues.Libel = itemBox.getElementsByClassName('Libel')[0].value.trim()
            ValidateUserInputs.formValues.Image = itemBox.getElementsByClassName('image')[0]
            ValidateUserInputs.formValues.Description = itemBox.getElementsByClassName('desc')[0].value.trim()
            ValidateUserInputs.formValues.Quantity = itemBox.getElementsByClassName('qty')[0].value.trim()
            ValidateUserInputs.formValues.Price = itemBox.getElementsByClassName('price')[0].value.trim()
            ValidateUserInputs.formValues.BarCode = itemBox.getElementsByClassName('barCode')[0].value.trim()
            ValidateUserInputs.formValues.Company = itemBox.getElementsByClassName('company')[0].value.trim()

            ValidateUserInputs.validateLibel(itemBox)
            ValidateUserInputs.validateDesc(itemBox)
            ValidateUserInputs.validateImage(itemBox)
            ValidateUserInputs.validateCompany(itemBox)
            ValidateUserInputs.validateQuantity(itemBox)
            ValidateUserInputs.validatePrice(itemBox)
            ValidateUserInputs.validateBarCode(itemBox)
            ValidateUserInputs.alertMessage()

            $(ValidateUserInputs.formInput.Libel).on("change keyup paste", function (e) {
                let elem = e.target;
                ValidateUserInputs.formValues.Libel = elem.value.trim()
                ValidateUserInputs.validateLibel(elem.parentElement.parentElement.parentElement);
            })
            $(ValidateUserInputs.formInput.Image).on("change keyup paste", function (e) {
                let elem = e.target;
                ValidateUserInputs.formValues.Image = elem
                ValidateUserInputs.validateImage(elem.parentElement.parentElement.parentElement)
            })
            $(ValidateUserInputs.formInput.Description).on("change keyup paste", function (e) {
                let elem = e.target;
                ValidateUserInputs.formValues.Description = elem.value.trim()
                ValidateUserInputs.validateDesc(elem.parentElement.parentElement.parentElement)
            })
            $(ValidateUserInputs.formInput.Quantity).on("change keyup paste", function (e) {
                let elem = e.target;
                ValidateUserInputs.formValues.Quantity = elem.value.trim()
                ValidateUserInputs.validateQuantity(elem.parentElement.parentElement.parentElement)
            })
            $(ValidateUserInputs.formInput.Price).on("change keyup paste", function (e) {
                let elem = e.target;
                ValidateUserInputs.formValues.Price = elem.value.trim()
                ValidateUserInputs.validatePrice(elem.parentElement.parentElement.parentElement)
            })
            $(ValidateUserInputs.formInput.BarCode).on("change keyup paste", function (e) {
                let elem = e.target;
                ValidateUserInputs.formValues.BarCode = elem.value.trim()
                ValidateUserInputs.validateBarCode(elem.parentElement.parentElement.parentElement)
            })
            $(ValidateUserInputs.formInput.Company).on("change keyup paste", function (e) {
                let elem = e.target;
                ValidateUserInputs.formValues.Company = elem.value.trim()
                ValidateUserInputs.validateCompany(elem.parentElement.parentElement.parentElement)
            })
        }
    })
}

window.addEventListener('load', () => {
    renderValidation();
})

document.getElementById('addNewProduct').addEventListener('click', () => {
    const html = document.createElement('div');
    html.classList = 'box-border border-radius-2xl addProductBox p-3 mt-4 position-relative';
    html.innerHTML = `<i class="removeCategory fa-solid fa-x cursor-pointer p-2 text-danger position-absolute" style="right:7px;top: 7px;z-index: 10 "></i>`
    html.innerHTML += document.getElementById('productContainer').innerHTML;
    const tmp = document.getElementById('addNewProductBox').appendChild(html);
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