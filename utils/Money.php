<?php
/**
 * Classe Money
 *
 * A classe Money é responsável por fornecer métodos relacionados à formatação de valores monetários.
 * Ela possui apenas um método estático, format(), que formata um valor numérico para o formato de moeda brasileira.
 *
 * Exemplo de uso:
 * echo Money::format(1000.50); // Resultado: R$ 1.000,50
 */
class Money {

    /**
     * Formata um valor numérico para o formato de moeda brasileira (Real).
     *
     * @param float $value O valor numérico a ser formatado.
     * @return string O valor formatado no formato de moeda brasileira (R$ 1.000,50).
     */
    public static function format($value)
    {
        return 'R$ ' . number_format($value, 2, ',', '.');
    }
}
