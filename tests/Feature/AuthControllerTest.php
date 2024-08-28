<?php

namespace Tests\Feature;

use App\Http\Controllers\AuthController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Illuminate\Support\Str;

// php artisan test --filter=AuthControllerTest
class AuthControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

// php artisan test --filter=AuthControllerTest::test_checked_end_point
    public function test_checked_end_point(): void {
        $response = $this->get('/register');

        $response->assertStatus(200);
    }

// php artisan test --filter=AuthControllerTest::test_create_user_with_valid_data
    public function test_create_user_with_valid_data() {
        // Arrange (preparação)
        $name = $this->faker->name();
        $email = $this->faker->unique()->safeEmail();
        $password = Hash::make('password123456');
        $remember_token = Str::random(10);

        $request = Request::create('/register', 'POST', [
            'name' => $name,
            'email' => $email,
            'password' => $password,
            'password_confirmation' => $password,
            'remember_token' => $remember_token
        ]);

        // Act (ação)
        $controller = new AuthController;
        $response = $controller->register_action($request);
        
        // Assert (afirmação)
        
        //Verifica se esta redirecionando para a area de login apos a criação do usuario
        $this->assertEquals(
            redirect(route('login'))->getTargetUrl(),
            $response->getTargetUrl(),
            'Não esta levando para a pagina de login!'
        );

        // Verifica se o usuário foi criado no banco de dados
        $this->assertDatabaseHas('users', [
            'email' => $email
        ]);

        // Verifica se a senha foi armazenada de forma criptografada e corresponde à senha fornecida
        $this->assertTrue(hash_equals($password,
            User::where('email', $email)->first()->password)
        );
    }

// php artisan test --filter=AuthControllerTest::test_register_page_redirects_to_home_when_logged_in
    public function test_register_page_redirects_to_home_when_logged_in() {
        // Arrange (preparação)
        $user = User::factory()->create();
        // Este método define o usuário autenticado para a duração deste teste.
        $this->actingAs($user);

        // Act (ação)
        $response = $this->get(route('register'));

        // Assert (afirmação)
        $response->assertRedirect(route('home'));
    }

// php artisan test --filter=AuthControllerTest::test_user_cannot_register_with_existing_email
    public function test_user_cannot_register_with_existing_email() {
        //Cria um usuario com o email john@example.com
        $existingUser = User::factory()->create(['email' => 'john@example.com']);

        //Cria outro usuario com o mesmo email john@example.com
        $response = $this->post(route('register'), [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
        ]);

        //Verifica se falhou na hora de criar o usuarios com emails iguais
        $response->assertSessionHasErrors(['email']);

        //Verifica que o usuário não está autenticado
        $this->assertGuest();
    }

// php artisan test --filter=AuthControllerTest::test_user_is_redirected_to_login_after_logout
    public function test_user_is_redirected_to_login_after_logout(){
        // Arrange (preparação)
        $newUser = User::factory()->create();
        $this->actingAs($newUser);

        // Action
        $response = $this->get(route('logout'));

        // Assert (afirmação)
        $response->assertRedirect(route('login'));
        $this->assertGuest();
    }
    
}
