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
    <tr>
        <td>
            <div class="d-flex px-2 py-1">
                <div>
                    <img src="${data.img}"
                         class="avatar avatar-sm me-3" alt="user1"
                         style="position: relative;">
                </div>
                <div class="d-flex flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">${data.NAME}</h6>
                </div>
            </div>
        </td>
        <td>
            <p class="text-xs font-weight-bold mb-0 text-center">${data.action}</p>
        </td>
        <td>
            <p class="text-xs font-weight-bold mb-0 text-center">${data.role}</p>
        </td>
        <td>
            <p class="text-xs font-weight-bold mb-0 text-center">${data.item}</p>
        </td>
        <td>
            <p class="text-xs font-weight-bold text-center mb-1">${data.date}</p>
        </td>
    </tr>`;
}
function SortProduct() {
    const sortingBy = document.getElementById('sortBy').value;
    const sortingDir = (icon.classList.contains("bx-sort-down")) ? 'DESC' : 'ASC';
    const searchValue = document.getElementById('seachBox')?.value.trim();

    $.ajax(
        {
            type: "POST",
            url: `http://cureco.com/dashboard/sortHistory/${sortingBy}/${sortingDir}`,
            data: {
                send: true,
                value : searchValue
            },
            datatype: "json",
            success: function (data) {
                console.log(data)
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
            url: `http://cureco.com/dashboard/searchHistory/`,
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