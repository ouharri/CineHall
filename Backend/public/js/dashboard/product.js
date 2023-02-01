const icon = document.getElementById('sortByDir').getElementsByTagName('i')[0];
document.getElementById('sortByDir').addEventListener('click', () => {
    icon.classList.toggle('bx-sort-down');
    icon.classList.toggle('bx-sort-up');
    SortProduct();
})
document.getElementById('sortBy').addEventListener('change', () => {
    SortProduct();
})

function HtmlSetter(data){
    return `
    <td>
        <div class="d-flex px-2 py-1">
            <div>
                <img src="${data.img}"
                     class="avatar avatar-sm me-3" alt="user1"
                     style="position: relative;">
            </div>
            <div class="d-flex flex-column justify-content-center">
                <h6 class="mb-0 text-sm">${data.libel}</h6>
            </div>
        </div>
    </td>
    <td>
        <p class="text-xs font-weight-bold mb-0 text-center">${data.category}</p>
    </td>
    <td>
        <p class="text-xs font-weight-bold mb-0 text-center">${data.qnt}</p>
    </td>
    <td>
        <p class="text-xs font-weight-bold text-center mb-1"
           style="min-width: 100px;max-width: 150px">${data.price}</p>
    </td>
    <td>
        <p class="text-xs font-weight-bold text-center mb-1 text-truncate"
           style="min-width: 100px;max-width: 150px">${data.desc}</p>
    </td>
    <td>
        <p class="text-xs font-weight-bold mb-0 text-center">${data.codeBar}</p>
    </td>
    <td>
        <p class="text-xs font-weight-bold mb-0 text-center mb-1">${data.expirationDate}</p>
    </td>
    <td>
        <p class="text-xs text-secondary text-center mb-0">${data.company}</p>
    </td>
    <td class="align-middle">
        <a href="http://cureco.com/dashboard/editproduct/${data.id}"
           class="text-secondary font-weight-bold text-xs">
            Edit
        </a>
    </td>
    <td class="align-middle">
        <a onclick="deletItem('http://cureco.com/dashboard/deletproduct/${data.id}')"
           class="text-secondary font-weight-bold text-xs cursor-pointer"
           data-toggle="tooltip" data-original-title="Edit user">
            Delete
        </a>
    </td>`;
}
function SortProduct() {
    const sortingBy = document.getElementById('sortBy').value;
    const sortingDir = (icon.classList.contains("bx-sort-down")) ? 'DESC' : 'ASC';
    const searchValue = document.getElementById('seachBox')?.value.trim();

    $.ajax(
        {
            type: "POST",
            url: `http://cureco.com/dashboard/Sortproduct/${sortingBy}/${sortingDir}`,
            data: {
                send: true,
                value : searchValue
            },
            datatype: "json",
            success: function (data) {
                const productTable = document.getElementById('tbodyProduct');
                productTable.innerHTML = "";
                for (let i = 0; i < data.length; i++) {
                    let item = document.createElement("tr");
                    item.innerHTML += HtmlSetter(data[i])
                    productTable.appendChild(item);
                }
            }
        }
    );
}

$('#seachBox')?.on("change keyup paste", function (e) {
    const value = this.value.trim();
    $.ajax(
        {
            type: "POST",
            url: `http://cureco.com/dashboard/search/`,
            data: {
                send: true,
                value: value
            },
            datatype: "json",
            success: function (data) {
                const productTable = document.getElementById('tbodyProduct');
                productTable.innerHTML = ""
                for (let i = 0; i < data.length; i++) {
                    let item = document.createElement("tr");
                    item.innerHTML += HtmlSetter(data[i])
                    productTable.appendChild(item);
                }
            }
        }
    );
})