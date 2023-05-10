<<<<<<< HEAD
import Validacao from "../utils/Validacao.js"; 

$(document).ready(() => {
  let validacao = new Validacao();

  //-------# Validações dos Campos 
  // Nome
  $('input[name=nome]').blur(({ currentTarget }) => { 
    let erro = '';

    if (!validacao.campoObrigatorioPreenchido(currentTarget.value)) {
      $('#btn-register').prop('disabled', true);
      erro = '* Campo Obrigatorio';
    } else {
      $('#btn-register').prop('disabled', false);
      erro = '';
    } 

    $('#lblErroNome').text(erro);    
  });

  // Email
  $('input[name=email]').blur(({ currentTarget }) => { 
    let erro = '';  

    if (!validacao.campoObrigatorioPreenchido(currentTarget.value)) {
      $('#btn-register').prop('disabled', true);
      erro = '* Campo Obrigatorio';
    } else if (!validacao.email(currentTarget.value)) {
      $('#btn-register').prop('disabled', true);
      erro = '* Email Invalido';
    } else {
      $('#btn-register').prop('disabled', false);
      erro = '';
    }

    $('#lblErroEmail').text(erro);    
  });

  // Senha
  $('input[name=password]').blur(({ currentTarget }) => { 
    let erro = '';   

    if (!validacao.campoObrigatorioPreenchido(currentTarget.value)) {
      $('#btn-register').prop('disabled', true);
      erro = '* Campo Obrigatorio';
    } else if (!validacao.senha(currentTarget.value)) {
      $('#btn-register').prop('disabled', true);
      erro = '* A senha deve ter entre 8 e 16 caracteres, conter pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial';
    } else {
      $('#btn-register').prop('disabled', false);
      erro = '';
    }

    console.log(!validacao.senha(currentTarget.value));
    $('#lblErroSenha').text(erro);    
  });

  // Age
  $('input[name=age]').blur(({ currentTarget }) => { 
    let erro = '';   

    if (!validacao.campoObrigatorioPreenchido(currentTarget.value)) {
      erro = '* Campo Obrigatorio';
    } else if (!validacao.isNumerico(currentTarget.value)) {
      erro = '* Insira um número';
    } else {
      erro = '';
    }

    $('#lblErroAge').text(erro);    
  });

  // Celular
  $('input[name=phone]').blur(({ currentTarget }) => { 
    let erro = '';  

    if (!validacao.campoObrigatorioPreenchido(currentTarget.value)) {
      erro = '* Campo Obrigatorio';
    } else if (!validacao.telefone(currentTarget.value)) {
      erro = '* Celular incorreto';
    } else {
      erro = '';
    }

    $('#lblErroCelular').text(erro);    
  });

  // CPF
  $('input[name=cpf]').blur(({ currentTarget }) => {
    console.log("-------------------------");
    console.log(currentTarget.value);
    console.log(validacao.cpf(currentTarget.value));
    console.log("-------------------------");

    let erro = validacao.cpf(currentTarget.value) ? '' : '* CPF Invalido';
    $('#lblErroCpf').text(erro);
  });

});
=======
import Validacao from "../utils/Validacao.js"; 

$(document).ready(() => {
  let validacao = new Validacao();

  //-------# Validações dos Campos 
  // Nome
  $('input[name=nome]').blur(({ currentTarget }) => { 
    let erro = '';

    if (!validacao.campoObrigatorioPreenchido(currentTarget.value)) {
      $('#btn-register').prop('disabled', true);
      erro = '* Campo Obrigatorio';
    } else {
      $('#btn-register').prop('disabled', false);
      erro = '';
    } 

    $('#lblErroNome').text(erro);    
  });

  // Email
  $('input[name=email]').blur(({ currentTarget }) => { 
    let erro = '';  

    if (!validacao.campoObrigatorioPreenchido(currentTarget.value)) {
      $('#btn-register').prop('disabled', true);
      erro = '* Campo Obrigatorio';
    } else if (!validacao.email(currentTarget.value)) {
      $('#btn-register').prop('disabled', true);
      erro = '* Email Invalido';
    } else {
      $('#btn-register').prop('disabled', false);
      erro = '';
    }

    $('#lblErroEmail').text(erro);    
  });

  // Senha
  $('input[name=password]').blur(({ currentTarget }) => { 
    let erro = '';   

    if (!validacao.campoObrigatorioPreenchido(currentTarget.value)) {
      $('#btn-register').prop('disabled', true);
      erro = '* Campo Obrigatorio';
    } else if (!validacao.senha(currentTarget.value)) {
      $('#btn-register').prop('disabled', true);
      erro = '* A senha deve ter entre 8 e 16 caracteres, conter pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial';
    } else {
      $('#btn-register').prop('disabled', false);
      erro = '';
    }

    console.log(!validacao.senha(currentTarget.value));
    $('#lblErroSenha').text(erro);    
  });

  // Age
  $('input[name=age]').blur(({ currentTarget }) => { 
    let erro = '';   

    if (!validacao.campoObrigatorioPreenchido(currentTarget.value)) {
      erro = '* Campo Obrigatorio';
    } else if (!validacao.isNumerico(currentTarget.value)) {
      erro = '* Insira um número';
    } else {
      erro = '';
    }

    $('#lblErroAge').text(erro);    
  });

  // Celular
  $('input[name=phone]').blur(({ currentTarget }) => { 
    let erro = '';  

    if (!validacao.campoObrigatorioPreenchido(currentTarget.value)) {
      erro = '* Campo Obrigatorio';
    } else if (!validacao.telefone(currentTarget.value)) {
      erro = '* Celular incorreto';
    } else {
      erro = '';
    }

    $('#lblErroCelular').text(erro);    
  });

  // CPF
  $('input[name=cpf]').blur(({ currentTarget }) => {
    console.log("-------------------------");
    console.log(currentTarget.value);
    console.log(validacao.cpf(currentTarget.value));
    console.log("-------------------------");

    let erro = validacao.cpf(currentTarget.value) ? '' : '* CPF Invalido';
    $('#lblErroCpf').text(erro);
  });

});
>>>>>>> 286a4901e05e7d84006a15f932d5b2227f5e0c7a
