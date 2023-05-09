<<<<<<< HEAD
/*
* Classe para Validação 
*/ 
export default class Validacao {

    campoObrigatorioPreenchido( campo ) {
        return campo !== '' ? true : false;
    }

    isNumerico( campo ) {
        return isNaN(campo) ? false : true;
    }

    isTexto( campo ) {
        return typeof campo == string ? true : false;
    }

    /**
    * Método que verifica se um CPF é válido e não possui todos os dígitos iguais
    *
    * @param string cpf CPF a ser validado
    * @returns boolean `true` se o CPF é válido, `false` caso contrário
    */
    cpf( cpf ) {
      // ----- Validações
      // remove caracteres não numéricos
      cpf = cpf.replace(/[^\d]+/g,''); 

      // CPF deve ter 11 dígitos
      if (cpf.length !== 11) return false; 

      // não pode ter todos os dígitos iguais
      if (/^(\d)\1{10}$/.test(cpf)) return false; 

      let sum = 0;
      let resto;

      //----- Calcula o primeiro dígito verificador
      for (let i = 1; i <= 9; i++) {
        sum += parseInt(cpf.substring(i-1, i)) * (11 - i);
      }
      resto = (sum * 10) % 11;
      if (resto === 10 || resto === 11) resto = 0;
      if (resto !== parseInt(cpf.substring(9, 10))) return false;

      //----- Calcula o segundo dígito verificador
      sum = 0;
      for (let i = 1; i <= 10; i++) {
        sum += parseInt(cpf.substring(i-1, i)) * (12 - i);
      }
      resto = (sum * 10) % 11;
      if (resto === 10 || resto === 11) resto = 0;
      if (resto !== parseInt(cpf.substring(10, 11))) return false;

      return true;
    }

    /**
    * Valida um endereço de e-mail
    *
    * @param string email - O endereço de e-mail a ser validado
    * @return boolean true se o e-mail for válido, false caso contrário
    */
    email( email ) {
      const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      return regex.test(email);
    }

    /*
    * Método para validar uma senha
    * @param string senha - A senha a ser validada
    * @return boolean True se a senha é válida, False caso contrário
    */
    senha( senha ) {
      const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
      return regex.test(senha);
    }

  /**
  * Método para validar telefone com 11 dígitos no formato (11) 11111-1111
  *
  * @param {string} telefone O telefone a ser validado
  * @returns {boolean} true se o telefone for válido, false caso contrário
  */
  telefone(telefone) {
    // Remove todos os caracteres que não são dígitos
  const numeroLimpo = telefone.replace(/\D/g, '');

  // Verifica se o número possui 11 dígitos
  if (numeroLimpo.length !== 11) {
    return false;
  }

  // Verifica se todos os dígitos são iguais (ex: 11111111111)
  if (/^(\d)\1+$/.test(numeroLimpo)) {
    return false;
  }

  // Verifica se o número está no padrão (11) 11111-1111
  const regex = /^\((\d{2})\)\s*(\d{5})\-(\d{4})$/;
  return regex.test(telefone);
  }

}
=======
/*
* Classe para Validação 
*/ 
export default class Validacao {

    campoObrigatorioPreenchido( campo ) {
        return campo !== '' ? true : false;
    }

    isNumerico( campo ) {
        return isNaN(campo) ? false : true;
    }

    isTexto( campo ) {
        return typeof campo == string ? true : false;
    }

    /**
    * Método que verifica se um CPF é válido e não possui todos os dígitos iguais
    *
    * @param string cpf CPF a ser validado
    * @returns boolean `true` se o CPF é válido, `false` caso contrário
    */
    cpf( cpf ) {
      // ----- Validações
      // remove caracteres não numéricos
      cpf = cpf.replace(/[^\d]+/g,''); 

      // CPF deve ter 11 dígitos
      if (cpf.length !== 11) return false; 

      // não pode ter todos os dígitos iguais
      if (/^(\d)\1{10}$/.test(cpf)) return false; 

      let sum = 0;
      let resto;

      //----- Calcula o primeiro dígito verificador
      for (let i = 1; i <= 9; i++) {
        sum += parseInt(cpf.substring(i-1, i)) * (11 - i);
      }
      resto = (sum * 10) % 11;
      if (resto === 10 || resto === 11) resto = 0;
      if (resto !== parseInt(cpf.substring(9, 10))) return false;

      //----- Calcula o segundo dígito verificador
      sum = 0;
      for (let i = 1; i <= 10; i++) {
        sum += parseInt(cpf.substring(i-1, i)) * (12 - i);
      }
      resto = (sum * 10) % 11;
      if (resto === 10 || resto === 11) resto = 0;
      if (resto !== parseInt(cpf.substring(10, 11))) return false;

      return true;
    }

    /**
    * Valida um endereço de e-mail
    *
    * @param string email - O endereço de e-mail a ser validado
    * @return boolean true se o e-mail for válido, false caso contrário
    */
    email( email ) {
      const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      return regex.test(email);
    }

    /*
    * Método para validar uma senha
    * @param string senha - A senha a ser validada
    * @return boolean True se a senha é válida, False caso contrário
    */
    senha( senha ) {
      const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
      return regex.test(senha);
    }

  /**
  * Método para validar telefone com 11 dígitos no formato (11) 11111-1111
  *
  * @param {string} telefone O telefone a ser validado
  * @returns {boolean} true se o telefone for válido, false caso contrário
  */
  telefone(telefone) {
    // Remove todos os caracteres que não são dígitos
  const numeroLimpo = telefone.replace(/\D/g, '');

  // Verifica se o número possui 11 dígitos
  if (numeroLimpo.length !== 11) {
    return false;
  }

  // Verifica se todos os dígitos são iguais (ex: 11111111111)
  if (/^(\d)\1+$/.test(numeroLimpo)) {
    return false;
  }

  // Verifica se o número está no padrão (11) 11111-1111
  const regex = /^\((\d{2})\)\s*(\d{5})\-(\d{4})$/;
  return regex.test(telefone);
  }

}
>>>>>>> 286a4901e05e7d84006a15f932d5b2227f5e0c7a
