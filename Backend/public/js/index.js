function deletItem(link) {
    Swal.fire({
        title: `<span style='color: var(--blue)'>Are you sure?</span>`,
        text: "If you delet this now you can't go back !",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: 'var(--blue)',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, I\'m sure to remove there !'
    }).then((result) => {
        if (result.isConfirmed) {
            location.href = link;
        }
    })
}