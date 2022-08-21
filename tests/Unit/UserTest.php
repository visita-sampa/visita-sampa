<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use App\Models\User;

class UserTest extends TestCase
{
    /** @test */
    public function check_if_user_colums_is_correct()
    {
        $user = new User;

        $expected = [
            'nome',
            'nome_usuario',
            'email',
            'senha',
            'descricao',
            'fk_classificacao_perfil_roteiro_id_classificacao',
            'email_verified_at',
            'chave_confirmacao',
            'situacao_cadastro',
            'recuperar_senha'
        ];

        $arrayCompared = array_diff($expected, $user->getFillable());

        // dd($arrayCompared);

        $this->assertEquals(0, count($arrayCompared));
    }
}
