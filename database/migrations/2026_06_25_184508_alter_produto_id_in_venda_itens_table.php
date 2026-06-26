<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('venda_itens', function (Blueprint $table) {
            // 1. Remove a chave estrangeira antiga baseada no produto
            $table->dropForeign(['produto_id']);

            // 2. Modifica a coluna para aceitar NULL (caso o produto seja deletado)
            $table->foreignId('produto_id')->nullable()->change();

            // 3. Aplica a nova regra: se o produto sumir, o item da venda fica com produto_id = NULL
            $table->foreign('produto_id')
                  ->references('id')
                  ->on('produtos')
                  ->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('venda_itens', function (Blueprint $table) {
            $table->dropForeign(['produto_id']);

            // Reverte para obrigatório (pode falhar se existirem nulos na BD durante o rollback)
            $table->foreignId('produto_id')->nullable(false)->change();

            // Restaura o comportamento original cascade
            $table->foreign('produto_id')
                  ->references('id')
                  ->on('produtos')
                  ->cascadeOnDelete();
        });
    }
};