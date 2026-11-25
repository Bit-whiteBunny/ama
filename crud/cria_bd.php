<?php
include 'conecta.php';

//cria BD
$sql = "-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema AMA
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema AMA
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `AMA` DEFAULT CHARACTER SET utf8 ;
USE `AMA` ;

-- -----------------------------------------------------
-- Table `AMA`.`jogador`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AMA`.`jogador` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `email` VARCHAR(150) NOT NULL,
  `senha` VARCHAR(45) NOT NULL,
  `userneme` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AMA`.`casa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AMA`.`casa` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(50) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AMA`.`personagem`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AMA`.`personagem` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `idade` VARCHAR(3) NULL,
  `serie` VARCHAR(2) NULL,
  `descricao` TEXT NULL,
  `casa_id` INT NOT NULL,
  `attr_cafe` VARCHAR(2) NULL,
  `attr_imaginario` VARCHAR(2) NULL,
  `attr_caos` VARCHAR(2) NULL,
  `attr_amor` VARCHAR(2) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_personagem_casa1_idx` (`casa_id` ASC) VISIBLE,
  CONSTRAINT `fk_personagem_casa1`
    FOREIGN KEY (`casa_id`)
    REFERENCES `AMA`.`casa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AMA`.`ficha`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AMA`.`ficha` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `personagem_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Ficha_Personagem1_idx` (`personagem_id` ASC) VISIBLE,
  CONSTRAINT `fk_Ficha_Personagem1`
    FOREIGN KEY (`personagem_id`)
    REFERENCES `AMA`.`personagem` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AMA`.`habilidade`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AMA`.`habilidade` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `ativa` CHAR(2) NOT NULL,
  `personagem_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_habilidade_personagem1_idx` (`personagem_id` ASC) VISIBLE,
  CONSTRAINT `fk_habilidade_personagem1`
    FOREIGN KEY (`personagem_id`)
    REFERENCES `AMA`.`personagem` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AMA`.`equipamento`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AMA`.`equipamento` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` TEXT NULL,
  `personagem_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_equipamento_personagem1_idx` (`personagem_id` ASC) VISIBLE,
  CONSTRAINT `fk_equipamento_personagem1`
    FOREIGN KEY (`personagem_id`)
    REFERENCES `AMA`.`personagem` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AMA`.`arma`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AMA`.`arma` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `descricao` TEXT NULL,
  `personagem_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_arma_personagem1_idx` (`personagem_id` ASC) VISIBLE,
  CONSTRAINT `fk_arma_personagem1`
    FOREIGN KEY (`personagem_id`)
    REFERENCES `AMA`.`personagem` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AMA`.`aula`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AMA`.`aula` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nome` VARCHAR(100) NOT NULL,
  `ativa` CHAR(2) NOT NULL,
  `personagem_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_aula_personagem1_idx` (`personagem_id` ASC) VISIBLE,
  CONSTRAINT `fk_aula_personagem1`
    FOREIGN KEY (`personagem_id`)
    REFERENCES `AMA`.`personagem` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `AMA`.`registro`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `AMA`.`registro` (
  `jogador_id` INT NOT NULL,
  `ficha_id` INT NOT NULL,
  `tipo-acesso` INT NOT NULL,
  PRIMARY KEY (`jogador_id`, `ficha_id`),
  INDEX `fk_jogador_has_ficha_ficha1_idx` (`ficha_id` ASC) VISIBLE,
  INDEX `fk_jogador_has_ficha_jogador1_idx` (`jogador_id` ASC) VISIBLE,
  CONSTRAINT `fk_jogador_has_ficha_jogador1`
    FOREIGN KEY (`jogador_id`)
    REFERENCES `AMA`.`jogador` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_jogador_has_ficha_ficha1`
    FOREIGN KEY (`ficha_id`)
    REFERENCES `AMA`.`ficha` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
";

if (mysqli_multi_query($conexao, $sql)) {
    do {
        if ($result = mysqli_store_result($conexao)) {
            mysqli_free_result($result);
        }
    } while (mysqli_more_results($conexao) && mysqli_next_result($conexao));

    echo "Banco criado com sucesso!";
} else {
    echo "Erro ao criar BD: " . mysqli_error($conexao);
}
mysqli_close($conexao);
?>