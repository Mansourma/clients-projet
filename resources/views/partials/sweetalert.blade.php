<head>
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.10.5/dist/sweetalert2.min.css" rel="stylesheet">
</head>
<body>
    <script src="{{ 'https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.10.5/sweetalert2.all.min.js' }}"></script>
</body>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
  const deleteButtons = document.querySelectorAll('.delete-btn');

  deleteButtons.forEach(button => {
    button.addEventListener('click', event => {
      event.preventDefault();
      const formId = button.getAttribute('data-form-id');

      Swal.fire({
        title: 'Are you sure?',
        text: 'You won\'t be able to revert this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel'
      }).then((result) => {
        if (result.isConfirmed) {
          // Submit the form using its ID
          document.getElementById('delete-form-' + formId).submit();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
          Swal.fire(
            'Cancelled',
            'Your record is safe :)',
            'error'
          );
        }
      });
    });
  });
});

      </script>

        <script>
            @if(session('mixin'))
            {
                const toast = window.Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000,
                    padding: '2em',
                });
                toast.fire({
                    icon: 'success',
                    title: 'Signed in successfully',
                    padding: '2em',
                });
            }
            @endif
        </script>

      <script>
        @if(session('success'))
          Swal.fire({
            title: 'Success!',
            text: '{{ session('success') }}',
            icon: 'success',
            position: 'center',
            timer: 2000,
            showConfirmButton: false
          });
        @endif
      </script>
        <script>
            @if(session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                position: 'center',
                timer: 2000,
                showConfirmButton: false
            });
            @endif
        </script>
        <script>
            @if(session('oops'))
            Swal.fire({
                title: 'Oops...',
                text: '{{ session('oops') }}',
                icon: 'error',
                position: 'center',
                timer: 2000,
                showConfirmButton: false
            });
            @endif
        </script>
        <script>
            @if(session('warning'))
            Swal.fire({
                title: 'Warning!',
                text: '{{ session('warning') }}',
                icon: 'warning',
                position: 'center',
                timer: 2000,
                showConfirmButton: false
            });
            @endif
        </script>
        <script>
            @if(session('info'))
            Swal.fire({
                title: 'Info!',
                text: '{{ session('info') }}',
                icon: 'info',
                timer: 2000,
                showConfirmButton: false
            });
            @endif
        </script>
        <script>
            @if(session('payment-error'))
            Swal.fire({
                title: 'Payment Error!',
                text: '{{ session('payment-error') }}',
                icon: 'error',
                timer: 2000,
                showConfirmButton: false
            });
            @endif
        </script>
        <script>
            @if(session('payment-success'))
            Swal.fire({
                title: 'Payment Success!',
                text: '{{ session('payment-success') }}',
                icon: 'success',
                timer: 2000,
                showConfirmButton: false
            });
            @endif
        </script>
        <script>
            @if(session('secondary'))
            Swal.fire({
                title: 'Secondary!',
                text: '{{ session('
                secondary ') }}',
                icon: 'secondary',
                timer: 2000,
                showConfirmButton: false
            });
            @endif
        </script>
        <script>
            @if(session('light'))
            Swal.fire({
                title: 'Light!',
                text: '{{ session('
                light ') }}',
                icon: 'light',
                timer: 2000,
                showConfirmButton: false
            });
            @endif
        </script>
        <script>
            @if(session('dark'))
            Swal.fire({
                title: 'Dark!',
                text: '{{ session('
                dark ') }}',
                icon: 'dark',
                timer: 2000,
                showConfirmButton: false
            });
            @endif
        </script>
        <script>
            @if(session('primary'))
            Swal.fire({
                title: 'Primary!',
                text: '{{ session('
                primary ') }}',
                icon: 'primary',
                position: 'center',
                timer: 2000,
                showConfirmButton: false
            });
            @endif
        </script>
        <script>
            @if(session('message'))
            Swal.fire({
                title: 'Message!',
                text: '{{ session('message') }}',
                icon: 'message',
                position: 'center',
                timer: 2000,
                showConfirmButton: false
            });
            @endif
        </script>
        <script>
            @if ($errors->any())
            Swal.fire({
                title: 'Error!',
                text: '{{$errors->first()}}',
                icon: 'error',
                position: 'center',
                timer: 2000,
                showConfirmButton: false
            });
            @endif
        </script>
        <script>
            @if(session('toast_success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('toast_success') }}',
                icon: 'success',
                position: 'center',
                timer: 2000,
                showConfirmButton: false
            });
            @endif
        </script>
        <script>
            @if(session('toast_error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session('toast_error') }}',
                icon: 'error',
                position: 'center',
                timer: 2000,
                showConfirmButton: false
            });
            @endif
        </script>
        <script>
            @if(session('toast_warning'))
            Swal.fire({
                title: 'Warning!',
                text: '{{ session('toast_warning') }}',
                icon: 'warning',
                position: 'center',
                timer: 2000,
                showConfirmButton: false
            });
            @endif
        </script>      
</body>