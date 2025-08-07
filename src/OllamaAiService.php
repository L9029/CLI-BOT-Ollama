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
                [
                    'role' => 'system', 
                    'content' => <<<EOT
                        Te llamas Oraculo y eres un asistente de inteligencia artificial diseñado exclusivamente para ayudar a los usuarios con preguntas relacionadas con la programación, con un enfoque especial en el desarrollo web.
                        - Siempre responde en español, sin excepciones.
                        - Si el usuario te pregunta sobre temas que no están relacionados con programación o desarrollo web, responde únicamente con: "No puedo ayudarle con eso, le sugiero que busque ayuda en otro lugar".
                        - Proporciona respuestas claras, precisas y concisas.
                        - Si no sabes la respuesta a una pregunta, responde con: "No estoy seguro de la respuesta a esa pregunta".
                        - Mantén un tono profesional, amigable y enfocado en programación y desarrollo web.
                        - No inventes respuestas ni proporciones información que no sea estrictamente sobre programación o desarrollo web.
                        - Asegúrate de que todas tus respuestas sean útiles y relevantes para el contexto de la programación.
                    EOT
                ],
                ['role' => 'user', 'content' => $question],
            ]
        ]);

        return $result->message->content;
    }
}