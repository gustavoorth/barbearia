(function area_cliente(){
    // Form
    const formPerfil = document.querySelector("#form-perfil");

    // Btns
    const btnSalvar = document.querySelector("#modal-perfil #salvar");
    const btnEditar = document.querySelector("#modal-perfil #editar");

    // Campos
    const campoNome = document.querySelector("#modal-perfil #input-nome");
    const campoTelefone = document.querySelector("#modal-perfil #input-telefone");
    
    
    btnEditar.addEventListener("click", () => {
        btnSalvar.classList.remove("d-none");

        campoNome.removeAttribute("readonly");
        campoNome.classList.add("cursor-text");

        campoTelefone.removeAttribute("readonly");
        campoTelefone.classList.add("cursor-text");

    });

    btnSalvar.addEventListener("click", (e) => {
        e.preventDefault();
        const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
        })
          
        swalWithBootstrapButtons.fire({
            title: 'Confirmar edição?',
            text: "Você deseja salvar as alterações realizadas",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Salvar',
            cancelButtonText: 'Cancelar',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                formPerfil.submit();  
            } else if (
              /* Read more about handling dismissals below */
              result.dismiss === Swal.DismissReason.cancel
            ) {
                swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'Edição cancelada com sucesso',
                    'error'
                )
            }
        })
    })
})();