@props(['categories'])

<style>
    #category_modal_id{
        width: 100%;
    }
    #colorInput {
        width: 90%;
    }
    .custom-color-input{
        display: flex;
        gap: 10%;
    }
</style>


<!-- Modal para Edição -->
<x-bladewind::modal
    size="big"
    title="Edição de Categoria"
    name="editModal"
    ok_button_action="saveEditProfile()"
    ok_button_label="Salvar"
    backdrop_can_close="true"
>
@isset($categories) 

    <form id="edit-form" method="post" action="{{ route('tasks.update_categories') }}" class="profile-form">
        @csrf
        @method('put')

        <x-form.select_input
            name="category_modal_id" 
            label="Categoria" 
            required="required"
        >
            @foreach($categories as $category)
                <option value="{{ $category->id }}" style="color:{{ $category->color }}">
                    {{ $category->title }}
                </option>
            @endforeach
        </x-form.select_input>

        <div class="custom-text-input">
            <x-bladewind::input
                required="true"
                name="title"
                selected_value=""
                error_message="Por favor insira um título"
                label="Título"
                id="titleInput"
            />
        </div>

        <div class="custom-color-input">
            <input type="color" name="color" id="colorInput">
            <button type="button" id="deleteButton" style="display:none;" onclick="confirmDelete()">
                <svg xmlns="http://www.w3.org/2000/svg" width="30" height="25" fill="#fd4141" class="bi bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                  </svg>
            </button>
        </div>
        
        <input type="hidden" name="delete_category_id" id="deleteCategoryId">

        
    </form>
    @endisset
</x-bladewind::modal>


<script>
    document.getElementById('category_modal_id').addEventListener("change", (e) => {
        let selectedOption = e.target.selectedOptions[0];
        let text = selectedOption.text;
        let color = selectedOption.style.color;
        let value = selectedOption.value;
        let hexColor = rgbToHex(color);

        document.getElementById('titleInput').value = text;
        document.getElementById('colorInput').value = hexColor;
        document.getElementById('deleteCategoryId').value = value;

        // Mostrar o botão de deletar
        document.getElementById('deleteButton').style.display = 'block';
    });

    function rgbToHex(color) {
        color = color.replace(/[^\d,]/g, "").split(",");
        return "#" + ((1 << 24) + (+color[0] << 16) + (+color[1] << 8) + +color[2]).toString(16).slice(1);
    }

    function confirmDelete() {
        let categoryId = document.getElementById('deleteCategoryId').value;

        if (confirm('Tem certeza que deseja deletar esta categoria?')) {
            window.location.href = '{{ route('tasks.delet_categories', ['id' => '']) }}' + categoryId;
        }
    }
</script>
