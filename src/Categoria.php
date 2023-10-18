<?php
namespace Microblog;
use PDO, Exception;

class Categoria {
    private int $id;
    private string $nome;
    private PDO $conexao;

    public function __construct() {
        $this->conexao = Banco::conecta();
    }

    public function ler():array {
        $sql = "SELECT * FROM categorias ORDER BY nome";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->execute();
            $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao exibir: ".$erro->getMessage());
        }
        return $resultado;
    }

    public function lerUm():array {
        $sql = "SELECT * FROM categorias WHERE id = :id";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":id", $this->id, PDO::PARAM_INT);
            $consulta->execute();
            $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $erro) {
            die("Erro ao exibir: ".$erro->getMessage());
        }
        return $resultado;
    }

    public function inserir():void {
        $sql = "INSERT INTO categorias(nome) VALUES(:nome)";

        try {
            $consulta = $this->conexao->prepare($sql);
            $consulta->bindValue(":nome", $this->nome, PDO::PARAM_STR);
            $consulta->execute();
        } catch (Exception $erro) {
            die("Erro ao inserir: ".$erro->getMessage());
        }
    }

    public function getId(): int{
        return $this->id;
    }
    public function setId(int $id): self{
        $this->id = $id;

        return $this;
    }

    public function getNome(): string{
        return $this->nome;
    }
    public function setNome(string $nome): self{
        $this->nome = $nome;

        return $this;
    }
}