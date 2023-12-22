<?

# Interface para os Models
#
#

interface IModel {

  public function __construct($mysqli);
  public function cadastrar();
  public function obterTodos();
  public function obter($id);
  public function atualizar($dados);
  public function deletar($id);

}