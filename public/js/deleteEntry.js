/**
 * Shows a popup and deletes a specific database entry if desired
 * @param type string - only used in the user-prompt
 * @param id string or number - only used in the user-prompt (can be undefined if no number is necessary)
 * @param urlToDelete string - the full urlToDelete to delete the resource
 * @param successURL string - this url will be visited on a successful deletion if not null
 */
function deleteEntry(type, id, urlToDelete, successURL) {
    Swal.fire({
        icon: 'warning',
        title: 'Attention',
        text: `Are you absolutely sure that you want to delete ${type} ${id} ?`,
        confirmButtonText: 'Yes 👍',
        cancelButtonText: 'No 😱',
        showCancelButton: true
    }).then((result) => {
        if (!result.isConfirmed)
            return;
        axios.delete(urlToDelete, {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }).then(() => Swal.fire({
            title: 'Success!',
            icon: 'success',
            html: 'The item was deleted successfully',
            timer: 2000,
            timerProgressBar: true,
            willOpen: () => {
                Swal.showLoading()
            },
        }).then(() => {
            if(successURL!=null)
                window.location.replace(successURL);
        })).catch((error)=>{
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Something went wrong!',
                footer: error
            })
        });
    });
}
