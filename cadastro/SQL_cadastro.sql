-- ----------------------------
-- Table structure for `confirmar_accounts`
-- ----------------------------
DROP TABLE IF EXISTS `confirmar_accounts`;
CREATE TABLE `confirmar_accounts` (
  `nome_completo` varchar(95) NOT NULL DEFAULT '',
  `email` varchar(55) DEFAULT NULL,
  `login` varchar(45) DEFAULT NULL,
  `senha` varchar(45) DEFAULT NULL,
  `codigo_seguranca` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`nome_completo`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of confirmar_accounts
-- ----------------------------
