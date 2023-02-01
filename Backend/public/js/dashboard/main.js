// add hovered class to selected list item
let list = document.querySelectorAll(".navigation-dash li");

function activeLink() {
    list.forEach((item) => {
        item.classList.remove("hovered");
    });
    this.classList.add("hovered");
    (this.id !== '') ? localStorage.setItem("activePage", JSON.stringify(this.id)) : undefined;
}

list.forEach((item) => item.addEventListener("click", activeLink));

// Menu Toggle
let toggle = document.querySelector(".toggle");
let navigation = document.querySelector(".navigation-dash");
let box = document.querySelectorAll(".box");
let boxShow = document.querySelectorAll(".boxShow");
let main = document.querySelector(".main");

function dashShow() {
    box.forEach((item) => item.classList.toggle('mx-4'));
    boxShow.forEach((item) => item.classList.toggle('border-start'));
    navigation.classList.toggle("active");
    main.classList.toggle("active");
    if (main.classList.contains("active")) {
        localStorage.setItem('dash', '1');
    } else {
        localStorage.setItem('dash', '0');
    }
}

toggle.onclick = function () {
    dashShow();
};

window.addEventListener("load", () => {
    if (localStorage.getItem('dash') === '1') {
        dashShow();
    }
    document.getElementById(JSON.parse(localStorage.getItem("activePage"))).classList.add("hovered");
    switch (JSON.parse(localStorage.getItem("activePage"))) {
        case "table":
            document.getElementById('tableShow').classList.remove('d-none');
            break;
        case "add":
            document.getElementById('addShow').classList.remove('d-none');
            break;
    }
});
document.getElementById('table').addEventListener('click', () => {
    document.getElementById('tableShow').classList.toggle('d-none');
    document.getElementById('addShow').classList.add('d-none');
})
document.getElementById('add').addEventListener('click', () => {
    document.getElementById('addShow').classList.toggle('d-none');
    document.getElementById('tableShow').classList.add('d-none');
})

function printTicket() {
    Swal.fire({
        title: `<p style='color: var(--blue)'>Print your Ticket</p>`,
        text: "You are about to take your receipt for an unforgettable experience !",
        icon: 'question',
        showCancelButton: true,
        confirmButtonColor: 'var(--blue)',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Let\'s go'
    }).then((result) => {
            if (result.isConfirmed) {
                const anchor = document.createElement('a');
                anchor.href = `http://cureco.com/dashboard/receiptPdf`;
                document.body.appendChild(anchor);
                anchor.click();
                document.body.removeChild(anchor);
                Swal.fire(
                    'are you excited?',
                    'collect your things now and join us on the cruise !',
                    'success'
                )
            }
        }
    )
}