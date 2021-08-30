-- MySQL Script generated by MySQL Workbench
-- Sun Apr 25 19:25:06 2021
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema miEmpresa
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema miEmpresa
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `miEmpresa` DEFAULT CHARACTER SET utf8 ;
USE `miEmpresa` ;

-- -----------------------------------------------------
-- Table `miEmpresa`.`ROLES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `miEmpresa`.`ROLES` (
  `id_rol` INT NOT NULL,
  PRIMARY KEY (`id_rol`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `miEmpresa`.`USUARIOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `miEmpresa`.`USUARIOS` (
  `id_usuario` INT NOT NULL,
  `id_roles` INT NOT NULL,
  PRIMARY KEY (`id_usuario`),
  INDEX `fk_id_usuario_idx` (`id_roles` ASC) VISIBLE,
  CONSTRAINT `fk_id_usuarios_roles`
    FOREIGN KEY (`id_roles`)
    REFERENCES `miEmpresa`.`ROLES` (`id_rol`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `miEmpresa`.`CLIENTES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `miEmpresa`.`CLIENTES` (
  `id_cliente` INT NOT NULL,
  PRIMARY KEY (`id_cliente`),
  CONSTRAINT `pk_id_cliente`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `miEmpresa`.`USUARIOS` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `miEmpresa`.`VENDEDORES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `miEmpresa`.`VENDEDORES` (
  `id_vendedor` INT NOT NULL,
  PRIMARY KEY (`id_vendedor`),
  CONSTRAINT `pk_id_empleado`
    FOREIGN KEY (`id_vendedor`)
    REFERENCES `miEmpresa`.`USUARIOS` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `miEmpresa`.`PEDIDOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `miEmpresa`.`PEDIDOS` (
  `id_pedido` INT NOT NULL,
  `id_cliente` INT NOT NULL,
  `id_vendedor` INT NOT NULL,
  PRIMARY KEY (`id_pedido`),
  INDEX `fk_id_cliente` (`id_cliente` ASC) INVISIBLE,
  INDEX `fk_id_vendedor_idx` (`id_vendedor` ASC) VISIBLE,
  CONSTRAINT `fk_id_cliente`
    FOREIGN KEY (`id_cliente`)
    REFERENCES `miEmpresa`.`CLIENTES` (`id_cliente`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_id_vendedor`
    FOREIGN KEY (`id_vendedor`)
    REFERENCES `miEmpresa`.`VENDEDORES` (`id_vendedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `miEmpresa`.`CATEGORIAS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `miEmpresa`.`CATEGORIAS` (
  `id_categoria` INT NOT NULL,
  PRIMARY KEY (`id_categoria`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `miEmpresa`.`PRODUCTOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `miEmpresa`.`PRODUCTOS` (
  `id_producto` INT NOT NULL,
  `id_categoria` INT NULL,
  PRIMARY KEY (`id_producto`),
  INDEX `fk_productos_categorias_idx` (`id_categoria` ASC) VISIBLE,
  CONSTRAINT `fk_productos_categorias`
    FOREIGN KEY (`id_categoria`)
    REFERENCES `miEmpresa`.`CATEGORIAS` (`id_categoria`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `miEmpresa`.`LISTA_PRODUCTOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `miEmpresa`.`LISTA_PRODUCTOS` (
  `id_pedido` INT NOT NULL,
  `id_producto` INT NOT NULL,
  `cantidad` VARCHAR(45) NOT NULL,
  CONSTRAINT `fk_lista_productos_orden_pedido`
    FOREIGN KEY ()
    REFERENCES `miEmpresa`.`PEDIDOS` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lista_productos_productos`
    FOREIGN KEY ()
    REFERENCES `miEmpresa`.`PRODUCTOS` ()
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `miEmpresa`.`ORDEN_PRODUCCION`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `miEmpresa`.`ORDEN_PRODUCCION` (
  `id_orden_produccion` INT NOT NULL,
  PRIMARY KEY (`id_orden_produccion`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `miEmpresa`.`ESTADO_PRODUCCIÓN`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `miEmpresa`.`ESTADO_PRODUCCIÓN` (
  `id_orden_produccion` INT NOT NULL,
  `id_producto` INT NOT NULL,
  `id_usuario` INT NOT NULL,
  INDEX `fk_estado_produccion_orden_produccion_idx` (`id_orden_produccion` ASC) VISIBLE,
  INDEX `fk_estado_produccion_productos_idx` (`id_producto` ASC) VISIBLE,
  INDEX `fk_estado_produccion_usuario_idx` (`id_usuario` ASC) VISIBLE,
  CONSTRAINT `fk_estado_produccion_orden_produccion`
    FOREIGN KEY (`id_orden_produccion`)
    REFERENCES `miEmpresa`.`ORDEN_PRODUCCION` (`id_orden_produccion`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_estado_produccion_productos`
    FOREIGN KEY (`id_producto`)
    REFERENCES `miEmpresa`.`PRODUCTOS` (`id_producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_estado_produccion_usuario`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `miEmpresa`.`USUARIOS` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `miEmpresa`.`INSUMOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `miEmpresa`.`INSUMOS` (
  `id_insumo` INT NOT NULL,
  PRIMARY KEY (`id_insumo`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `miEmpresa`.`PROVEEDORES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `miEmpresa`.`PROVEEDORES` (
  `id_proveedor` INT NOT NULL,
  `nombre_Empresa` VARCHAR(45) NULL,
  PRIMARY KEY (`id_proveedor`),
  CONSTRAINT `fk_proveedores`
    FOREIGN KEY (`id_proveedor`)
    REFERENCES `miEmpresa`.`USUARIOS` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `miEmpresa`.`CREDENCIALES`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `miEmpresa`.`CREDENCIALES` (
  `id_usuario` INT NOT NULL,
  `pass` VARCHAR(45) NULL,
  `estado` INT NULL,
  PRIMARY KEY (`id_usuario`),
  CONSTRAINT `fk_credenciales`
    FOREIGN KEY (`id_usuario`)
    REFERENCES `miEmpresa`.`USUARIOS` (`id_usuario`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `miEmpresa`.`COMPRAS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `miEmpresa`.`COMPRAS` (
  `id_compra` INT NOT NULL,
  PRIMARY KEY (`id_compra`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `miEmpresa`.`LISTA_INSUMOS`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `miEmpresa`.`LISTA_INSUMOS` (
  `id_proveedor` INT NOT NULL,
  `id_insumos` INT NOT NULL,
  `id_productos` INT NOT NULL,
  `id_compra` INT NULL,
  INDEX `fk_lista_insumos_proveedores_idx` (`id_proveedor` ASC) VISIBLE,
  INDEX `fk_lista_insumos_insumos_idx` (`id_insumos` ASC) VISIBLE,
  INDEX `fk_lista_insumos_productos_idx` (`id_productos` ASC) VISIBLE,
  INDEX `fk_lista_insumos_compras_idx` (`id_compra` ASC) VISIBLE,
  CONSTRAINT `fk_lista_insumos_proveedores`
    FOREIGN KEY (`id_proveedor`)
    REFERENCES `miEmpresa`.`PROVEEDORES` (`id_proveedor`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lista_insumos_insumos`
    FOREIGN KEY (`id_insumos`)
    REFERENCES `miEmpresa`.`INSUMOS` (`id_insumo`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lista_insumos_productos`
    FOREIGN KEY (`id_productos`)
    REFERENCES `miEmpresa`.`PRODUCTOS` (`id_producto`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_lista_insumos_compras`
    FOREIGN KEY (`id_compra`)
    REFERENCES `miEmpresa`.`COMPRAS` (`id_compra`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
