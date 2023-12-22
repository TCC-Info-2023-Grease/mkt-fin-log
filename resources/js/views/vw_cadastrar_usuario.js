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
  function alternarCamposDo(usuario) {
    switch (usuario) {
      // VISITANTE
      case "vis":
        mudarCampo([
          ["input[name=age]", "block"],
          ["input[name=genrer-select]", "block"],
          ["input[name=cpf]", "none"],
          ["#profile_picture", "none"],
        ]);

        mudarCampo([
          ["label[for=age]", "block"],
          ["label[for=genrer-select]", "block"],
          ["label[for=cpf]", "none"],
          ["label[for=profile_picture]", "none"],
        ]);
        break;
  
      case "fig":
      case "cen":
      case "enc":
        mudarCampo([
          ["input[name=age]", "none" ],
          ["input[name=genrer-select]", "block" ],
          ["input[name=cpf]", "none" ],
          ["#profile_picture", "none" ],
        ]);

        mudarCampo([
          ["label[for=age]", "none" ],
          ["label[for=genrer-select]", "none" ],
          ["label[for=cpf]", "none" ],
          ["label[for=profile_picture]", "none" ],
        ]);
        break;

      // ADMIN
      case "adm":
        mudarCampo([
          ["input[name=age]", "block" ],
          ["input[name=genrer-select]", "block" ],
          ["input[name=cpf]", "block" ],
          ["#profile_picture", "block" ],
        ]);
        
        mudarCampo([
          ["label[for=age]", "block" ],
          ["label[for=genrer-select]", "block" ],
          ["label[for=cpf]", "block" ],
          ["label[for=profile_picture]", "block" ],
        ]);
        break;

      default:
        console.log("DEU RUIM AQUI EM ENVIO ERRADO");
        break;
      }
    }
  function manipularTipoUsuarioSelect(e) {
    let usuario = e.currentTarget.value;

    alternarCamposDo(usuario);
  }
  
  $("#tipo-usuario-select").on("change", manipularTipoUsuarioSelect);
});