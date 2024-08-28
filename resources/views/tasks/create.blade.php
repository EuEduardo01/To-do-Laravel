<x-layout page="Criar Task">
    <x-slot:btn>
        <a href="{{route('home')}}" class="btn btn-primary">
            Voltar
        </a>
    </x-slot:btn>

    <section id="task-section">
        <h1>Criar tarefa</h1>

        @if ($errors->any())
        <x-bladewind::alert type="warning" shade="dark">
                @foreach ($errors->all() as $error)
                    {{$error}}
                @endforeach
        </x-bladewind::alert> 
        @endif
        
        <x-form.wind_create_modal
            action="tasks.create_categories"
        />
        <x-form.wind_edit_modal
            action="tasks.edit"
        />

        <form method="POST" action="{{route('tasks.create_action')}}">
            @csrf

            <x-form.text_input 
             name="title" 
             label="Titulo da Task" 
             required="required" 
             placeholder="Digite o titulo da tarefa..."
            />

           <x-form.text_input 
             type="datetime-local"
             name="due_date" 
             label="Data de realização" 
             required="required"
           />
        
            <div style="display: flex;">
                <x-form.select_input 
                  name="category_id" 
                  label="Categoria" 
                  required="required"
                >
                    @foreach($categories as $categorie)
                        <option value="{{$categorie->id}}" style="color:{{$categorie->color}}">{{$categorie->title}}</option>
                    @endforeach
                </x-form.select_input>

                <button id="create" style="background-color:rgb(10, 128, 224); height: 2rem; width: 2.6rem; margin-top:10%; margin-left:2%; display:flex;align-items: center; justify-content:center; border-radius:50%" onclick="showModal('cadastro')">
                    <x-bladewind::icon name='<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="white" class="size-6">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                        </svg>' 
                    />
                </button>
            </div>

            <x-form.textarea_input
                label="Descrição da tarefa"
                name="description"
                placeholder="Digite a descrição da tarefa..."
            />

            <div class="input-area">
                <x-form.button
                 type="reset"
                 description="Resetar"
                />

                <x-form.button
                type="submit"
                classStyleName="btn-primary"
                description="Criar tarefa"
               />
            </div>
        </form>
    </section>
</x-layout>
