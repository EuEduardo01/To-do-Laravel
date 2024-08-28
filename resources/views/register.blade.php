<x-layout page="Criar Task">
    <x-slot:btn>
        <a href="{{route('login')}}" class="btn btn-primary">
            Ja tem uma Conta?
        </a>
    </x-slot:btn>

    <section id="task-section">
        <h1>Registrar-se</h1>

        @if ($errors->any())
            <ul class="alert alert-error">
                @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                @endforeach
            </ul>
        @endif
        <form method="POST" action="{{route('user.register_action')}}">
            @csrf

            <x-form.text_input 
             name="name" 
             label="Seu Nome" 
             placeholder="Seu Nome..."
             required="required" 
            />

           <x-form.text_input 
             type="email"
             name="email" 
             label="Seu email" 
             placeholder="Seu email..."
             required="required"
           />

           <x-form.text_input 
             type="password"
             name="password" 
             label="Sua senha" 
             placeholder="Sua senha..."
             required="required"
           />

           <x-form.text_input 
             type="password"
             name="password_confirmation" 
             label="Confirme a sua senha" 
             placeholder="Confirme a sua senha..."
             required="required"
           />

            <div class="input-area">
                <x-form.button
                 type="reset"
                 description="Limpar"
                />

                <x-form.button
                type="submit"
                classStyleName="btn-primary"
                description="Rgistrar-se"
               />
            </div>
        </form>
    </section>
</x-layout>