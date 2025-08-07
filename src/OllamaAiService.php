<?php

namespace App;

use ArdaGnsrn\Ollama\Ollama; // Importa la clase Ollama para interactuar con el servicio de IA

class OllamaAiService
{
    protected $client; // Cliente para interactuar con Ollama

    /**
     * Constructor que inicializa el cliente de Ollama.
     */
    public function __construct()
    {
        $this->client = Ollama::client();
    }

    /**
     * Método para obtener una respuesta del servicio de IA.
     *
     * @param string $question La pregunta que se le hace al servicio de IA.
     * @return string La respuesta del servicio de IA.
     */
    public function getResponse(string $question) : string {
       
        if (strtolower($question) === 'salir' || strtolower($question) === 'exit') {
            return "Saliendo del programa, gracias por usar a Oraculo.";
        } elseif (empty($question)) {
            return "Por favor, escribe una pregunta, con mucho gusto la respondere.";
        } elseif (strtolower($question) === 'hola') {
            return "¡Hola! ¿Cómo puedo ayudarle hoy?";
        }

        // Realiza una solicitud al modelo de IA especificado
        $result = $this->client->chat()->create([
            'model' => 'deepseek-r1:1.5b',
            'messages' => [
                ['role' => 'user', 'content' => $question],
            ]
        ]);

        return $result->message->content;
    }
}