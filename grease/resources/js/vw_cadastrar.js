$(document).ready(() => {
  //------- FUNC AUXILIARES  
  function mudarCampo(campos) {
    campos.forEach((campo) => {
      console.log('====================================');
      const elemento = document.querySelector(campo[0]);
      if (elemento) {
        elemento.style.display = campo[1];
        console.log(`document.querySelector('${campo[0]}').style.display = '${campo[1]}'`);
      }
      console.log('====================================');
    });
  }
  function esconderCampos(campos) {
    mudarCampo(campos.map(campo => [campo, 'none']))
  }
  function alternarCamposDo(usuario) {
    const USER_TYPES = {
      VISITANTE: 'vis',
      FIGURINO: 'fig',
      CENARIO: 'cen',
      ENCENACAO: 'enc',
      ADMIN: 'adm'
    }

    switch (usuario) {
      case USER_TYPES.VISITANTE:
        mudarCampo([
          ["input[name=age]", "block"],
          ["input[name=genrer-select]", "block"],
        ]);
        esconderCampos(["cpf", "profile_picture"])
        break;

      case USER_TYPES.FIGURINO:
      case USER_TYPES.CENARIO:
      case USER_TYPES.ENCENACAO:
        mudarCampo([
          ["input[name=genrer-select]", "block"],
        ]);
        esconderCampos(["age", "cpf", "profile_picture"])
        break;

      case USER_TYPES.ADMIN:
        mudarCampo([
          ["input[name=age]", "block"],
          ["input[name=genrer-select]", "block"],
          ["input[name=cpf]", "block"],
          ["input[name=profile_picture]", "block"],
        ]);
        break;

      default:
        console.log("Tipo de usuário inválido");
    }
  }

  $("#tipo-usuario-select").on("change", manipularTipoUsuarioSelect);
});