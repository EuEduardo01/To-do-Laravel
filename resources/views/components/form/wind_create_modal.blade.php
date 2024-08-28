@props(['categories'])

<!-- Modal para Criação -->
<x-bladewind::modal
    size="big"
    title="Cadastro de Categoria"
    name="createModal"
    ok_button_action="saveCreateProfile()"
    ok_button_label="Salvar"
    backdrop_can_close="true"
>
    <form id="create-form" method="POST" action="{{ route('tasks.create_categories') }}" class="profile-form">
        @csrf
        <x-bladewind::input required="true" name="title" error_message="Por favor insira um título" label="Título" />
        <x-bladewind::input required="true" name="color" type="color" error_message="Por favor selecione a cor" label="Cor" />
    </form>
</x-bladewind::modal>
