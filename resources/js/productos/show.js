const form_delete = document.getElementById("form_delete");
const submit_delete = document.getElementById("submit_delete");

const deleteProduct = (e) => {
    
    e.preventDefault();

    Swal.fire({
        title: "Está segura/o?",
        text: "Este registro no se podrá recuperar",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#198754",
        cancelButtonColor: "#d33",
        confirmButtonText: "Aceptar",
        cancelButtonText: "Cancelar",
    }).then((result) => {
        if (result.isConfirmed) {
            //Cuando el usuario confirma.
            form_delete.submit();
        }
    });
};

//Eventos
submit_delete.addEventListener("click", deleteProduct);
