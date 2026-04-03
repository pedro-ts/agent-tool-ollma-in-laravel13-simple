<?php

namespace App\Ai\Tools;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Illuminate\Support\Facades\Log;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Tools\Request;
use Stringable;

class CalculatorTool implements Tool
{
    /**
     * Get the description of the tool's purpose.
     */
    public function description(): Stringable|string
    {
        return 'Use esta ferramenta quando o usuário pedir um cálculo matemático simples com dois números e uma operação: add, subtract, multiply ou divide.';
    }

    /**
     * Execute the tool.
     */
    public function handle(Request $request): Stringable|string
    {
        $a = (float) ($request['a'] ?? 0);
        $b = (float) ($request['b'] ?? 0);
        $operation = strtolower((string) ($request['operation'] ?? ''));

        Log::info('[IA][CalculatorTool] Tool executada', [
            'a' => $a,
            'b' => $b,
            'operation' => $operation,
        ]);

        return match ($operation) {
            'add' => (string) ($a + $b),
            'subtract' => (string) ($a - $b),
            'multiply' => (string) ($a * $b),
            'divide' => $b == 0.0 ? 'Erro: divisão por zero.' : (string) ($a / $b),
            default => 'Erro: operação inválida.',
        };
    }

    /**
     * Get the tool's schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'a' => $schema->number()->required(),
            'b' => $schema->number()->required(),
            'operation' => $schema->string()->required(),
        ];
    }
}
