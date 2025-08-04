<?php

namespace App;

class FakeAiService
{
    /**
     * Simula una respuesta de un servicio de IA.
     *
     * @param string $pregunta La pregunta del usuario.
     * @return string La respuesta simulada del servicio de IA.
     */
    public function getResponse(string $pregunta): string
    {
        if (strtolower($pregunta) === 'salir' || strtolower($pregunta) === 'exit') {
            return "Saliendo del programa, gracias por usar a Oraculo.";
        } elseif (empty($pregunta)) {
            return "Por favor, escribe una pregunta, con mucho gusto la respondere.";
        } elseif (strtolower($pregunta) === 'hola') {
            return "¡Hola! ¿Cómo puedo ayudarle hoy?";
        } elseif (strpos($pregunta, 'PHP') !== false) {
            return "Oraculo: PHP es un lenguaje de programación ampliamente utilizado para el desarrollo web.";
        } else {
            return "Oraculo: No tengo una respuesta específica para eso, pero puedo ayudarte con más información.";
        }

        sleep(2); // Simula un tiempo de procesamiento

        return "Oraculo: " . $pregunta . " es interesante.";
    }
}