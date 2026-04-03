<?php

namespace App\Ai\Agents;

use App\Ai\Tools\CalculatorTool;
use App\Ai\Tools\CurrentDateTimeTool;
use App\Ai\Tools\RandomNumberTool;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\Conversational;
use Laravel\Ai\Contracts\HasTools;
use Laravel\Ai\Contracts\Tool;
use Laravel\Ai\Messages\Message;
use Laravel\Ai\Promptable;
use Stringable;

// Serve para definir o provedor, modelo e outras configurações específicas para este agente
use Laravel\Ai\Attributes\MaxSteps;
use Laravel\Ai\Attributes\Model;
use Laravel\Ai\Attributes\Provider;
use Laravel\Ai\Enums\Lab;

#[Provider(Lab::Ollama)]
#[Model('qwen2.5:3b')]
#[MaxSteps(5)]
class AssistenteLocal implements Agent, Conversational, HasTools
{
    use Promptable;

    /**
     * Get the instructions that the agent should follow.
     */
    public function instructions(): Stringable|string
    {
        return <<<PROMPT
Você é um assistente local de testes para uma API Laravel.

Regras:
- Responda de forma objetiva.
- Quando a pergunta envolver data ou hora atual, use a tool de data e hora.
- Quando o usuário pedir sorteio ou número aleatório entre dois valores, use a tool de número aleatório.
- Quando o usuário pedir um cálculo simples com dois números, use a tool de calculadora.
- Não invente resultados se houver uma tool apropriada.
PROMPT;
    }

    /**
     * Get the list of messages comprising the conversation so far.
     *
     * @return Message[]
     */
    public function messages(): iterable
    {
        return [];
    }

    /**
     * Get the tools available to the agent.
     *
     * @return Tool[]
     */
    public function tools(): iterable
    {
        return [
            new CalculatorTool(),
            new CurrentDateTimeTool(),
            new RandomNumberTool()
        ];
    }
}
