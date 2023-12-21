$(document).ready(() => {
  $('.phone').inputmask('(99) 99999-9999');
  $('.cnpj').inputmask({
    mask: '99.999.999/9999-99',
    keepStatic: true
  });
});  