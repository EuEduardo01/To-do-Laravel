<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{$page ?? "Pagina"}}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap" rel="stylesheet">
    <link href="{{ asset('vendor/bladewind/css/animate.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('vendor/bladewind/css/bladewind-ui.min.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="/assets/css/style.css">
</head>
<body>
    <div class="containerr">
        <div class="sidebar">
            <img src="/assets/images/logo.png" alt="logo da Adonis">
        </div>
        <div class="content">
            <nav>
                <h2 style="margin-left: 2%">
                    Seja bem-vindo{{ Auth::check() ? ', ' . Auth::user()->name : '' }}
                </h2>
                {{$btn ?? null}}
            </nav>
            <main>
             {{$slot}}
            </main>
        </div>
    </div>
    <script>
        function showModal(modalName) {
            const modal = document.querySelector(`x-bladewind\\:modal[name="${modalName}"]`);
            if (modal) {
                modal.show(); // Use o método apropriado para mostrar o modal
            }
        }

        document.getElementById('create').addEventListener('click', (e) => {
            e.preventDefault();
            showModal('createModal');
        });

        document.getElementById('edit').addEventListener('click', (e) => {
            e.preventDefault();
            showModal('editModal');
        });

        function saveEditProfile() {
            if (validateForm('.profile-form')) {
                document.getElementById('edit-form').submit();
            } else {
                return false;
            }
        }

        function saveCreateProfile() {
            if (validateForm('.profile-form')) {
                document.getElementById('create-form').submit();
            } else {
                return false;
            }
        }
        </script>
    <script src="{{ asset('vendor/bladewind/js/helpers.js') }}"></script>
</body>
</html>