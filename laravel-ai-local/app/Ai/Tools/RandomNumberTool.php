<?php

namespace App\Ai\Tools;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Illuminate\Support\Facades\Log;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Tools\Request;
use Stringable;

class RandomNumberTool implements Tool
{
    /**
     * Get the description of the tool's purpose.
     */
    public function description(): Stringable|string
    {
        return 'Use esta ferramenta quando o usuário pedir um número aleatório, sorteio ou um valor randômico entre dois números.';
    }

    /**
     * Execute the tool.
     */
    public function handle(Request $request): Stringable|string
    {
        $min = (int) ($request['min'] ?? 0);
        $max = (int) ($request['max'] ?? 100);

        Log::info('[IA] RandomNumberTool executada', [
            'min' => $min,
            'max' => $max,
        ]);

        if ($min > $max) {
            [$min, $max] = [$max, $min];
        }

        return (string) random_int($min, $max);
    }

    /**
     * Get the tool's schema definition.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'min' => $schema->integer()->required(),
            'max' => $schema->integer()->required(),
        ];
    }
}
