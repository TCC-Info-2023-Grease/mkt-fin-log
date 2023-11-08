<?php

/**
 * Class Mascara
 *
 * This class provides methods for masking CPF, phone numbers, and CEPs.
 *
 * @since 2023-11-08
 * @author MrNullus <gustavojs417@gmail.com>
 */
class Mascara
{
    /**
     * Masks a CPF.
     *
     * @param string $cpf The CPF to be masked.
     *
     * @return string The masked CPF.
     */
    public static function mascararCPF($cpf): string
    {
        // Removes any non-numeric characters from the CPF
        $cpf = preg_replace('/\D/', '', $cpf);

        // Applies the mask to the CPF (format: XXX.XXX.XXX-XX)
        return substr($cpf, 0, 3) . '.' . substr($cpf, 3, 3) . '.' . substr($cpf, 6, 3) . '-' . substr($cpf, 9, 2);
    }

    /**
     * Masks a phone number.
     *
     * @param string $telefone The phone number to be masked.
     *
     * @return string The masked phone number.
     */
    public static function mascararTelefone($telefone): string
    {
        $telefone = preg_replace('/\D/', '', $telefone);

        if (strlen($telefone) == 10) {
            return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 4) . '-' . substr($telefone, 6, 4);
        } elseif (strlen($telefone) == 11) {
            return '(' . substr($telefone, 0, 2) . ') ' . substr($telefone, 2, 5) . '-' . substr($telefone, 7, 4);
        } else {
            return $telefone;
        }
    }

    /**
     * Masks a CEP.
     *
     * @param string $cep The CEP to be masked.
     *
     * @return string The masked CEP.
     */
    public static function mascararCEP($cep): string
    {
        $cep = preg_replace('/\D/', '', $cep);
        return substr($cep, 0, 5) . '-' . substr($cep, 5, 3);
    }
}

