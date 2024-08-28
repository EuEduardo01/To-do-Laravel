<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

use App\Models\Category;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_done')->default(false);
            $table->string('title');
            $table->dateTime('due_date');
            $table->string('description')->nullable();

            // Chave estrangeira para o usuário
            $table->foreignIdFor(User::class)
                ->references('id')
                ->on('users')
                ->onDelete('CASCADE');

            // Chave estrangeira para a categoria
            $table->foreignIdFor(Category::class)
                ->nullable()->references('id')
                ->on('categories')
                ->onDelete('SET NULL');
                
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function(Blueprint $table) {
            $table->dropForeignIdFor(User::class);
            $table->dropForeignIdFor(Category::class);
        });
        Schema::dropIfExists('tasks');
    }
};
