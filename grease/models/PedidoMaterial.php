<?php


/**
 * Classe PedidosMaterial
 * 
 * Essa classe representa o registro de Pedidos de Material no sistema e gerencia suas operações.
 */
class PedidoMaterial
{
    private $mysqli;
    private $tabela = "pedidosmateriais";

    /**
     * Método construtor da classe
     *
     * @param  mysqli $mysqli É a conexão com o banco de dados
     * @return void
     */
    public function __construct(mysqli $mysqli)
    {
        $this->mysqli = $mysqli;
    }

    /**
     * Cadastra um novo pedido de material no sistema
     * 
     * @param array $dados Dados do pedido a ser cadastrado
     * @return int|false ID do pedido cadastrado ou false em caso de erro
     */
    public function cadastrarPedido($dados = [])
    {
        $query = "
            INSERT INTO {$this->tabela} (
                material_id,
                usuario_id,
                data_pedido,
                data_entrega,
                qtde_material,
                status_pedido,
                descricao
            ) 
            VALUES (?, ?, ?, ?, ?, ?, ?)
        ";

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param(
            "iisssss",
            $dados['material_id'],
            $dados['usuario_id'],
            $dados['data_pedido'],
            $dados['data_entrega'],
            $dados['qtde_material'],
            $dados['status_pedido'],
            $dados['descricao']
        );  
        
        if ($stmt->execute()) {
            return $stmt->insert_id;
        } else {
            return false;
        }

        $stmt->close();
    }

    /**
     * Atualiza o status de um pedido de material
     * 
     * @param int $pedido_id ID do pedido a ser atualizado
     * @param string $novo_status Novo status do pedido
     * @return bool True se a atualização foi bem sucedida, False caso contrário
     */
    public function atualizarStatusPedido($pedido_id, $novo_status)
    {
        $query = "
            UPDATE {$this->tabela}
            SET status_pedido = ?
            WHERE pedido_id = ?
        ";

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param("si", $novo_status, $pedido_id);

        if ($stmt->execute()) {
            return true;
        } else {
            return false;
        }

        $stmt->close();
    }

    /**
     * Obtém os dados de um pedido de material pelo ID
     * 
     * @param int $pedido_id ID do pedido a ser buscado
     * @return array|null Array contendo os dados do pedido ou null se não encontrado
     */
    public function obterPedidoPorId($pedido_id)
    {
        $sql = $this->mysqli->query("
            SELECT *
            FROM {$this->tabela}
            WHERE pedido_id = '{$pedido_id}'
        ");

        if ($sql->num_rows === 0) {
            return null;
        }

        $row = $sql->fetch_assoc();

        return $row;
    }
    /**
     * Deleta um pedido de material pelo ID
     * 
     * @param int $pedido_id ID do pedido a ser deletado
     * @return bool True se a exclusão foi bem sucedida, False caso contrário
     */
    public function deletarPedido($pedido_id)
    {
        $query = "
            DELETE FROM {$this->tabela}
            WHERE pedido_id = ?
        ";

        $stmt = $this->mysqli->prepare($query);
        $stmt->bind_param('i', $pedido_id);

        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }

        $stmt->close();
    }

    /**
     * Busca todos os pedidos de material cadastrados no sistema
     * 
     * @return array|null Array contendo todos os pedidos de material ou null em caso de erro
     */
    public function buscarTodosPedidos()
    {
        $stmt = $this->mysqli->query("
            SELECT *
            FROM {$this->tabela}
            ORDER BY pedido_id DESC
        ");

        if ($stmt->num_rows === 0) {
            return null;
        }

        $pedidos = array();
        while ($linha = mysqli_fetch_array($stmt, MYSQLI_ASSOC)) {
            $pedidos[] = $linha;
        }

        return $pedidos;
    }
}

?>
