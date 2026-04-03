<?php

namespace App\Http\Controllers\Api;

use App\Ai\Agents\AssistenteLocal;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use PHPUnit\Event\Code\Throwable;

class AiTestController extends Controller
{
    public function __invoke(Request $request): JsonResponse
    {
        $request->validate([
            'mensagem' => ['required', 'string', 'max:2000'],
        ]);

        try {
            $agent = new AssistenteLocal();
            $mensagemDoUsuario = $request->string('mensagem')->toString();

            $response = $agent->prompt($mensagemDoUsuario);

            return response()->json([
                'ok' => true,
                'mensagem_usuario' => $mensagemDoUsuario,
                'resposta_ia' => $response->text,
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'ok' => false,
                'erro' => $e->getMessage(),
            ], 500);
        }
    }
}
