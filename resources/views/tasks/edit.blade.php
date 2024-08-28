<x-layout page="Editar Task">
    <x-slot:btn>
        <a href="{{ route('home') }}" class="btn btn-primary">
            Voltar
        </a>
    </x-slot:btn>

    <x-form.wind_edit_modal
        action="tasks.update_categories"
        :categories="$categories"
    />

    <x-form.wind_create_modal
        action="tasks.create_categories"
    />
    
    <section id="task-section">
        <h1>Editar tarefa</h1>

        <form method="POST" action="{{ route('tasks.edit_action') }}">
            @csrf
            @method('put')

            <input type="hidden" name="id" value="{{ $task->id }}">

            <x-form.checkbox_input
                name="is_done"
                label="Tarefa Realizada?"
                checked="{{ $task->is_done }}"
            />

            <x-form.text_input
                name="title"
                label="Titulo da Task"
                required="required"
                value="{{ $task->title }}"
            />

            <x-form.text_input
                type="datetime-local"
                name="due_date"
                label="Data de realização"
                required="required"
                value="{{ $task->due_date }}"
            />
            <div style="display: flex">
                <x-form.select_input
                    name="category_id"
                    label="Categoria"
                    required="required"
                >
                    @foreach($categories as $categorie)
                        <option value="{{ $categorie->id }}" style="color:{{ $categorie->color }}"
                            @if ($categorie->id == $task->category_id)
                                selected
                            @endif
                        >{{ $categorie->title }}</option>
                    @endforeach
                </x-form.select_input>
     
                <button id="create" style="background-color:rgb(10, 128, 224); height: 2rem; width: 2.6rem; margin-top:10%; margin-left:2%; display:flex;align-items: center; justify-content:center; border-radius:50%" onclick="showModal('createModal')">
                    <x-bladewind::icon name='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>' 
                    />
                </button>

                <button id="edit" style="background-color:rgb(10, 128, 224); height: 2rem; width: 2.6rem; margin-top:10%; margin-left:2%; display:flex;align-items: center; justify-content:center; border-radius:50%" onclick="showModal('editModal')">
                    <x-bladewind::icon name='<svg width="23px" height="23px" viewBox="0 0 24 24" id="_24x24_On_Light_Edit" data-name="24x24/On Light/Edit" xmlns="http://www.w3.org/2000/svg" fill="#000000">
                    <g id="SVGRepo_bgCarrier" stroke-width="0"/>
                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="0.048"/>
                    <g id="SVGRepo_iconCarrier"> <rect id="view-box" width="24" height="24" fill="none"/> <path id="Shape" d="M.75,17.5A.751.751,0,0,1,0,16.75V12.569a.755.755,0,0,1,.22-.53L11.461.8a2.72,2.72,0,0,1,3.848,0L16.7,2.191a2.72,2.72,0,0,1,0,3.848L5.462,17.28a.747.747,0,0,1-.531.22ZM1.5,12.879V16h3.12l7.91-7.91L9.41,4.97ZM13.591,7.03l2.051-2.051a1.223,1.223,0,0,0,0-1.727L14.249,1.858a1.222,1.222,0,0,0-1.727,0L10.47,3.91Z" transform="translate(3.25 3.25)" fill="#ffffff"/> </g>
                    </svg>' 
                    />
                </button>
            </div>

            <x-form.textarea_input
                label="Descrição da tarefa"
                name="description"
                value="{{ $task->description }}"
            />

            <div class="input-area">
                <x-form.button
                    type="reset"
                    description="Resetar"
                />

                <x-form.button
                    type="submit"
                    classStyleName="btn-primary"
                    description="Atualizar Tarefa"
                />
            </div>
        </form>
    </section>
</x-layout>
