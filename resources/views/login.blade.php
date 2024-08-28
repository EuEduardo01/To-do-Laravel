<x-layout page="Criar Task">
    <x-slot:btn>
        <a href="{{route('register')}}" class="btn btn-primary">
            Não tem uma conta? Click aqui
        </a>
    </x-slot:btn>
    <section id="task-section">
        <h1>Autenticar-se</h1>

      

        <form method="POST" action="{{route('user.login_action')}}">
            @csrf
            
            @if (isset($notExist))
                <ul>
                    <li>{{$notExist}}</li>
                </ul>
            @endif
            @if ($errors->any())
                <ul class="alert alert-error">
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            @endif
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

            <div class="input-area">
                <x-form.button
                 type="reset"
                 description="Limpar"
                />

                <x-form.button
                type="submit"
                classStyleName="btn-primary"
                description="Login"
               />
            </div>
        </form>
    </section>
</x-layout>