DELIMITER //
CREATE TRIGER before_insert_generar_boleta BEFORE INSERT ON usuarios FOR EACH ROW
BEGIN
  SET @year = YEAR(NOW())-2000;
  SET @consecutivo = (SELECT COUNT(boleta) FROM usuarios WHERE LEFT(boleta,2) = @year);
  SET NEW.boleta  = CONCAT(@YEAR,LPAD(@consecutivo,3,'0'),2);
END
//
DELIMITER ;
