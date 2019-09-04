/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50614
Source Host           : localhost:3306
Source Database       : control_reservaciones

Target Server Type    : MYSQL
Target Server Version : 50614
File Encoding         : 65001

Date: 2019-09-01 20:33:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for addgastos
-- ----------------------------
DROP TABLE IF EXISTS `addgastos`;
CREATE TABLE `addgastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `gastos` int(11) NOT NULL,
  `cant` double(11,2) NOT NULL,
  `importe` double(11,2) NOT NULL,
  `fecha` date NOT NULL,
  `unidad` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gastos` (`gastos`),
  KEY `unidad` (`unidad`),
  CONSTRAINT `gastos` FOREIGN KEY (`gastos`) REFERENCES `gastos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `unidad` FOREIGN KEY (`unidad`) REFERENCES `unidad` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=423 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of addgastos
-- ----------------------------
INSERT INTO `addgastos` VALUES ('1', '19', '1.00', '5.00', '2019-04-23', '5');
INSERT INTO `addgastos` VALUES ('2', '35', '3.00', '10.00', '2019-04-23', '30');
INSERT INTO `addgastos` VALUES ('3', '36', '22.00', '18.00', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('4', '37', '8.00', '22.80', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('5', '38', '8.00', '22.00', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('6', '39', '1.00', '11.00', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('7', '40', '4.00', '11.00', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('8', '41', '4.00', '13.60', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('9', '5', '4.00', '7.80', '2019-04-23', '27');
INSERT INTO `addgastos` VALUES ('10', '42', '1.00', '15.00', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('11', '43', '1.00', '5.00', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('12', '44', '2.00', '4.10', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('13', '45', '2.00', '5.00', '2019-04-23', '4');
INSERT INTO `addgastos` VALUES ('14', '46', '1.00', '1.90', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('15', '47', '7.00', '7.40', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('16', '48', '1.00', '14.40', '2019-04-23', '4');
INSERT INTO `addgastos` VALUES ('17', '29', '1.00', '5.00', '2019-04-23', '27');
INSERT INTO `addgastos` VALUES ('18', '28', '1.00', '4.00', '2019-04-23', '27');
INSERT INTO `addgastos` VALUES ('19', '20', '4.00', '96.00', '2019-04-23', '19');
INSERT INTO `addgastos` VALUES ('20', '16', '2.00', '30.00', '2019-04-23', '19');
INSERT INTO `addgastos` VALUES ('21', '27', '1.00', '46.00', '2019-04-23', '19');
INSERT INTO `addgastos` VALUES ('22', '49', '2.00', '40.00', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('23', '50', '6.00', '12.00', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('24', '17', '1.00', '2.40', '2019-04-23', '27');
INSERT INTO `addgastos` VALUES ('25', '51', '2.00', '11.00', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('26', '52', '20.00', '60.00', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('27', '23', '1.00', '12.00', '2019-04-23', '19');
INSERT INTO `addgastos` VALUES ('28', '22', '2.00', '24.00', '2019-04-23', '19');
INSERT INTO `addgastos` VALUES ('29', '3', '72.00', '32.40', '2019-04-23', '12');
INSERT INTO `addgastos` VALUES ('30', '3', '36.00', '25.20', '2019-04-23', '27');
INSERT INTO `addgastos` VALUES ('31', '6', '40.00', '13.00', '2019-04-23', '1');
INSERT INTO `addgastos` VALUES ('32', '53', '1.00', '48.00', '2019-04-23', '30');
INSERT INTO `addgastos` VALUES ('33', '34', '40.00', '2.30', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('34', '54', '3.00', '3.60', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('35', '55', '2.00', '4.00', '2019-04-23', '27');
INSERT INTO `addgastos` VALUES ('36', '56', '2.00', '4.00', '2019-04-23', '27');
INSERT INTO `addgastos` VALUES ('37', '24', '3.00', '21.60', '2019-04-23', '19');
INSERT INTO `addgastos` VALUES ('38', '57', '1.00', '3.00', '2019-04-23', '27');
INSERT INTO `addgastos` VALUES ('39', '58', '3.00', '7.90', '2019-04-23', '27');
INSERT INTO `addgastos` VALUES ('40', '59', '68.00', '7.80', '2019-04-23', '27');
INSERT INTO `addgastos` VALUES ('41', '12', '1.00', '2.00', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('42', '60', '3.00', '1.00', '2019-04-23', '1');
INSERT INTO `addgastos` VALUES ('43', '61', '1.00', '1.00', '2019-04-23', '1');
INSERT INTO `addgastos` VALUES ('44', '33', '7.00', '15.85', '2019-04-23', '19');
INSERT INTO `addgastos` VALUES ('45', '63', '1.00', '12.30', '2019-04-23', '4');
INSERT INTO `addgastos` VALUES ('46', '9', '1.00', '23.00', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('47', '10', '1.00', '11.00', '2019-04-23', '9');
INSERT INTO `addgastos` VALUES ('48', '14', '6.00', '2.00', '2019-04-24', '9');
INSERT INTO `addgastos` VALUES ('49', '62', '3.00', '0.50', '2019-04-24', '9');
INSERT INTO `addgastos` VALUES ('50', '13', '15.00', '5.33', '2019-04-24', '1');
INSERT INTO `addgastos` VALUES ('51', '64', '2.00', '1.25', '2019-04-24', '23');
INSERT INTO `addgastos` VALUES ('52', '65', '2.00', '2.41', '2019-04-24', '9');
INSERT INTO `addgastos` VALUES ('54', '35', '20.00', '30.00', '2019-04-24', '30');
INSERT INTO `addgastos` VALUES ('55', '66', '1.00', '100.00', '2019-04-30', '9');
INSERT INTO `addgastos` VALUES ('56', '1', '1.00', '2.00', '2019-04-24', '1');
INSERT INTO `addgastos` VALUES ('57', '1', '1.00', '2.00', '2019-04-24', '1');
INSERT INTO `addgastos` VALUES ('58', '1', '1.00', '2.00', '2019-04-25', '1');
INSERT INTO `addgastos` VALUES ('59', '1', '1.00', '2.00', '2019-04-26', '1');
INSERT INTO `addgastos` VALUES ('60', '1', '1.00', '2.00', '2019-04-27', '1');
INSERT INTO `addgastos` VALUES ('61', '1', '1.00', '2.00', '2019-04-27', '1');
INSERT INTO `addgastos` VALUES ('62', '1', '1.00', '2.40', '2019-04-27', '1');
INSERT INTO `addgastos` VALUES ('63', '1', '1.00', '1.08', '2019-04-27', '1');
INSERT INTO `addgastos` VALUES ('64', '2', '1.00', '3.00', '2019-04-25', '1');
INSERT INTO `addgastos` VALUES ('65', '2', '1.00', '1.00', '2019-04-25', '1');
INSERT INTO `addgastos` VALUES ('66', '2', '1.00', '2.00', '2019-04-26', '1');
INSERT INTO `addgastos` VALUES ('67', '2', '1.00', '2.00', '2019-04-27', '1');
INSERT INTO `addgastos` VALUES ('68', '66', '1.00', '120.00', '2019-04-27', '9');
INSERT INTO `addgastos` VALUES ('69', '67', '4.00', '3.50', '2019-05-03', '9');
INSERT INTO `addgastos` VALUES ('70', '69', '4.00', '5.83', '2019-05-03', '9');
INSERT INTO `addgastos` VALUES ('71', '70', '1.00', '15.00', '2019-05-03', '30');
INSERT INTO `addgastos` VALUES ('72', '1', '1.00', '2.00', '2019-05-02', '1');
INSERT INTO `addgastos` VALUES ('73', '1', '1.00', '2.00', '2019-05-03', '1');
INSERT INTO `addgastos` VALUES ('74', '1', '1.00', '2.00', '2019-05-04', '1');
INSERT INTO `addgastos` VALUES ('75', '71', '1.00', '6.00', '2019-05-06', '9');
INSERT INTO `addgastos` VALUES ('76', '1', '1.00', '4.00', '2019-05-01', '1');
INSERT INTO `addgastos` VALUES ('77', '1', '1.00', '2.00', '2019-05-07', '1');
INSERT INTO `addgastos` VALUES ('78', '1', '1.00', '2.00', '2019-05-09', '1');
INSERT INTO `addgastos` VALUES ('79', '1', '1.00', '1.20', '2019-05-09', '1');
INSERT INTO `addgastos` VALUES ('80', '1', '1.00', '1.20', '2019-05-09', '1');
INSERT INTO `addgastos` VALUES ('81', '1', '1.00', '2.00', '2019-05-11', '1');
INSERT INTO `addgastos` VALUES ('82', '1', '1.00', '2.00', '2019-05-06', '1');
INSERT INTO `addgastos` VALUES ('83', '1', '1.00', '2.00', '2019-05-08', '1');
INSERT INTO `addgastos` VALUES ('84', '1', '1.00', '4.00', '2019-05-10', '1');
INSERT INTO `addgastos` VALUES ('85', '1', '1.00', '2.00', '2019-05-11', '1');
INSERT INTO `addgastos` VALUES ('86', '1', '1.00', '2.00', '2019-05-13', '1');
INSERT INTO `addgastos` VALUES ('87', '1', '1.00', '2.00', '2019-05-14', '1');
INSERT INTO `addgastos` VALUES ('88', '1', '1.00', '1.20', '2019-05-14', '1');
INSERT INTO `addgastos` VALUES ('89', '1', '1.00', '0.15', '2019-05-14', '1');
INSERT INTO `addgastos` VALUES ('90', '1', '1.00', '1.00', '2019-05-14', '1');
INSERT INTO `addgastos` VALUES ('91', '1', '1.00', '1.00', '2019-05-15', '1');
INSERT INTO `addgastos` VALUES ('92', '1', '1.00', '2.00', '2019-05-15', '1');
INSERT INTO `addgastos` VALUES ('93', '1', '1.00', '2.80', '2019-05-15', '1');
INSERT INTO `addgastos` VALUES ('94', '1', '1.00', '1.05', '2019-05-15', '1');
INSERT INTO `addgastos` VALUES ('95', '1', '1.00', '2.00', '2019-05-17', '1');
INSERT INTO `addgastos` VALUES ('96', '1', '1.00', '2.00', '2019-05-18', '1');
INSERT INTO `addgastos` VALUES ('97', '1', '1.00', '1.20', '2019-05-18', '1');
INSERT INTO `addgastos` VALUES ('98', '1', '1.00', '0.15', '2019-05-18', '1');
INSERT INTO `addgastos` VALUES ('99', '2', '1.00', '1.50', '2019-05-14', '1');
INSERT INTO `addgastos` VALUES ('100', '2', '1.00', '1.00', '2019-05-15', '1');
INSERT INTO `addgastos` VALUES ('101', '2', '1.00', '1.00', '2019-05-15', '1');
INSERT INTO `addgastos` VALUES ('102', '2', '1.00', '1.00', '2019-05-16', '1');
INSERT INTO `addgastos` VALUES ('103', '2', '1.00', '1.00', '2019-05-17', '1');
INSERT INTO `addgastos` VALUES ('104', '2', '1.00', '1.00', '2019-05-18', '1');
INSERT INTO `addgastos` VALUES ('105', '2', '1.00', '1.00', '2019-05-19', '1');
INSERT INTO `addgastos` VALUES ('106', '2', '1.00', '1.00', '2019-05-15', '1');
INSERT INTO `addgastos` VALUES ('107', '72', '2.00', '8.00', '2019-05-22', '4');
INSERT INTO `addgastos` VALUES ('108', '8', '1.00', '0.60', '2019-05-22', '4');
INSERT INTO `addgastos` VALUES ('109', '19', '1.00', '6.00', '2019-05-13', '5');
INSERT INTO `addgastos` VALUES ('110', '10', '1.00', '5.00', '2019-05-13', '4');
INSERT INTO `addgastos` VALUES ('111', '15', '6.00', '1.60', '2019-05-13', '9');
INSERT INTO `addgastos` VALUES ('112', '14', '4.00', '2.20', '2019-05-13', '9');
INSERT INTO `addgastos` VALUES ('113', '12', '2.00', '2.60', '2019-05-13', '9');
INSERT INTO `addgastos` VALUES ('114', '13', '5.00', '2.00', '2019-05-13', '1');
INSERT INTO `addgastos` VALUES ('115', '62', '2.00', '1.60', '2019-05-21', '9');
INSERT INTO `addgastos` VALUES ('116', '15', '4.00', '1.00', '2019-05-21', '9');
INSERT INTO `addgastos` VALUES ('117', '19', '1.00', '5.00', '2019-05-21', '5');
INSERT INTO `addgastos` VALUES ('118', '10', '1.00', '3.00', '2019-05-21', '4');
INSERT INTO `addgastos` VALUES ('119', '9', '1.00', '3.00', '2019-05-21', '4');
INSERT INTO `addgastos` VALUES ('120', '18', '10.00', '10.00', '2019-05-22', '9');
INSERT INTO `addgastos` VALUES ('121', '73', '1.00', '1.25', '2019-05-22', '9');
INSERT INTO `addgastos` VALUES ('122', '74', '1.00', '56.20', '2019-05-17', '30');
INSERT INTO `addgastos` VALUES ('123', '53', '1.00', '40.00', '2019-05-22', '30');
INSERT INTO `addgastos` VALUES ('125', '30', '6.00', '18.00', '2019-05-03', '6');
INSERT INTO `addgastos` VALUES ('126', '1', '1.00', '1.00', '2019-05-21', '1');
INSERT INTO `addgastos` VALUES ('127', '1', '1.00', '2.00', '2019-05-21', '1');
INSERT INTO `addgastos` VALUES ('128', '1', '1.00', '1.60', '2019-05-21', '1');
INSERT INTO `addgastos` VALUES ('129', '1', '1.00', '0.60', '2019-05-21', '1');
INSERT INTO `addgastos` VALUES ('130', '1', '1.00', '2.00', '2019-05-22', '1');
INSERT INTO `addgastos` VALUES ('131', '1', '1.00', '2.00', '2019-05-22', '1');
INSERT INTO `addgastos` VALUES ('132', '1', '1.00', '2.20', '2019-05-22', '1');
INSERT INTO `addgastos` VALUES ('133', '1', '1.00', '0.90', '2019-05-22', '1');
INSERT INTO `addgastos` VALUES ('134', '1', '1.00', '2.00', '2019-05-24', '1');
INSERT INTO `addgastos` VALUES ('135', '28', '1.00', '4.00', '2019-06-10', '27');
INSERT INTO `addgastos` VALUES ('136', '75', '1.00', '20.00', '2019-06-14', '30');
INSERT INTO `addgastos` VALUES ('137', '15', '2.00', '0.50', '2019-06-23', '9');
INSERT INTO `addgastos` VALUES ('138', '14', '3.00', '1.80', '2019-06-23', '9');
INSERT INTO `addgastos` VALUES ('139', '12', '1.00', '1.50', '2019-06-23', '9');
INSERT INTO `addgastos` VALUES ('140', '9', '1.00', '3.00', '2019-06-23', '9');
INSERT INTO `addgastos` VALUES ('141', '10', '1.00', '3.00', '2019-06-23', '9');
INSERT INTO `addgastos` VALUES ('142', '57', '1.00', '2.00', '2019-06-23', '27');
INSERT INTO `addgastos` VALUES ('143', '1', '1.00', '2.00', '2019-06-10', '1');
INSERT INTO `addgastos` VALUES ('144', '1', '1.00', '10.00', '2019-06-23', '1');
INSERT INTO `addgastos` VALUES ('145', '1', '1.00', '0.40', '2019-06-23', '1');
INSERT INTO `addgastos` VALUES ('146', '28', '1.00', '4.00', '2019-06-23', '27');
INSERT INTO `addgastos` VALUES ('147', '5', '2.00', '3.90', '2019-07-05', '27');
INSERT INTO `addgastos` VALUES ('148', '11', '1.00', '3.00', '2019-07-05', '1');
INSERT INTO `addgastos` VALUES ('149', '10', '2.00', '6.10', '2019-07-05', '1');
INSERT INTO `addgastos` VALUES ('150', '63', '1.00', '12.30', '2019-07-05', '4');
INSERT INTO `addgastos` VALUES ('151', '76', '1.00', '0.50', '2019-07-05', '35');
INSERT INTO `addgastos` VALUES ('152', '77', '2.00', '4.00', '2019-07-05', '1');
INSERT INTO `addgastos` VALUES ('153', '34', '30.00', '1.25', '2019-07-05', '9');
INSERT INTO `addgastos` VALUES ('154', '13', '4.00', '1.00', '2019-07-05', '1');
INSERT INTO `addgastos` VALUES ('156', '30', '4.00', '10.00', '2019-07-05', '6');
INSERT INTO `addgastos` VALUES ('157', '2', '1.00', '2.00', '2019-05-22', '1');
INSERT INTO `addgastos` VALUES ('160', '14', '3.00', '1.00', '2019-07-06', '9');
INSERT INTO `addgastos` VALUES ('161', '15', '3.00', '0.75', '2019-07-06', '9');
INSERT INTO `addgastos` VALUES ('162', '12', '1.00', '0.50', '2019-07-06', '9');
INSERT INTO `addgastos` VALUES ('163', '18', '4.00', '1.00', '2019-07-07', '9');
INSERT INTO `addgastos` VALUES ('164', '74', '1.00', '2.00', '2019-06-12', '30');
INSERT INTO `addgastos` VALUES ('165', '14', '5.00', '3.00', '2019-07-10', '9');
INSERT INTO `addgastos` VALUES ('166', '15', '2.00', '0.50', '2019-07-10', '9');
INSERT INTO `addgastos` VALUES ('167', '18', '5.00', '1.05', '2019-07-10', '9');
INSERT INTO `addgastos` VALUES ('168', '72', '2.00', '0.50', '2019-07-10', '4');
INSERT INTO `addgastos` VALUES ('169', '65', '2.00', '2.50', '2019-07-10', '9');
INSERT INTO `addgastos` VALUES ('171', '57', '4.00', '7.60', '2019-07-10', '27');
INSERT INTO `addgastos` VALUES ('172', '2', '1.00', '1.00', '2019-07-05', '1');
INSERT INTO `addgastos` VALUES ('173', '2', '1.00', '1.00', '2019-07-06', '1');
INSERT INTO `addgastos` VALUES ('174', '2', '1.00', '1.00', '2019-07-07', '1');
INSERT INTO `addgastos` VALUES ('175', '2', '1.00', '1.00', '2019-07-08', '1');
INSERT INTO `addgastos` VALUES ('176', '2', '1.00', '2.00', '2019-05-22', '1');
INSERT INTO `addgastos` VALUES ('177', '2', '1.00', '1.00', '2019-06-24', '1');
INSERT INTO `addgastos` VALUES ('178', '2', '1.00', '1.00', '2019-06-25', '1');
INSERT INTO `addgastos` VALUES ('179', '2', '1.00', '1.00', '2019-06-25', '1');
INSERT INTO `addgastos` VALUES ('180', '2', '1.00', '1.00', '2019-06-26', '1');
INSERT INTO `addgastos` VALUES ('181', '2', '1.00', '1.00', '2019-06-27', '1');
INSERT INTO `addgastos` VALUES ('182', '2', '1.00', '1.00', '2019-07-09', '1');
INSERT INTO `addgastos` VALUES ('183', '2', '1.00', '1.00', '2019-07-10', '1');
INSERT INTO `addgastos` VALUES ('184', '19', '2.00', '10.00', '2019-07-10', '5');
INSERT INTO `addgastos` VALUES ('185', '19', '1.00', '6.00', '2019-04-22', '5');
INSERT INTO `addgastos` VALUES ('187', '15', '2.00', '0.50', '2019-07-11', '9');
INSERT INTO `addgastos` VALUES ('188', '12', '1.00', '1.40', '2019-07-11', '9');
INSERT INTO `addgastos` VALUES ('189', '14', '1.00', '0.75', '2019-07-11', '9');
INSERT INTO `addgastos` VALUES ('190', '34', '16.00', '4.00', '2019-07-11', '9');
INSERT INTO `addgastos` VALUES ('191', '1', '1.00', '2.00', '2019-07-01', '1');
INSERT INTO `addgastos` VALUES ('192', '1', '1.00', '2.00', '2019-07-03', '1');
INSERT INTO `addgastos` VALUES ('193', '1', '1.00', '2.00', '2019-07-04', '1');
INSERT INTO `addgastos` VALUES ('194', '1', '1.00', '2.00', '2019-07-05', '1');
INSERT INTO `addgastos` VALUES ('195', '1', '1.00', '10.00', '2019-06-24', '1');
INSERT INTO `addgastos` VALUES ('196', '1', '1.00', '4.00', '2019-06-28', '1');
INSERT INTO `addgastos` VALUES ('197', '1', '1.00', '1.00', '2019-06-26', '1');
INSERT INTO `addgastos` VALUES ('198', '1', '1.00', '2.10', '2019-06-28', '1');
INSERT INTO `addgastos` VALUES ('199', '1', '1.00', '0.60', '2019-07-05', '1');
INSERT INTO `addgastos` VALUES ('200', '1', '1.00', '1.00', '2019-07-05', '1');
INSERT INTO `addgastos` VALUES ('201', '1', '1.00', '2.00', '2019-07-06', '1');
INSERT INTO `addgastos` VALUES ('202', '1', '1.00', '0.45', '2019-07-06', '1');
INSERT INTO `addgastos` VALUES ('203', '1', '1.00', '1.00', '2019-07-06', '1');
INSERT INTO `addgastos` VALUES ('204', '1', '1.00', '1.00', '2019-07-10', '1');
INSERT INTO `addgastos` VALUES ('205', '1', '1.00', '2.00', '2019-07-10', '1');
INSERT INTO `addgastos` VALUES ('206', '1', '1.00', '0.80', '2019-07-10', '1');
INSERT INTO `addgastos` VALUES ('207', '1', '1.00', '0.60', '2019-07-10', '1');
INSERT INTO `addgastos` VALUES ('208', '1', '1.00', '2.00', '2019-07-11', '1');
INSERT INTO `addgastos` VALUES ('209', '1', '1.00', '2.00', '2019-07-08', '1');
INSERT INTO `addgastos` VALUES ('210', '1', '1.00', '0.60', '2019-07-08', '1');
INSERT INTO `addgastos` VALUES ('211', '1', '1.00', '1.20', '2019-07-08', '1');
INSERT INTO `addgastos` VALUES ('212', '1', '1.00', '2.00', '2019-07-09', '1');
INSERT INTO `addgastos` VALUES ('213', '1', '1.00', '0.60', '2019-07-09', '1');
INSERT INTO `addgastos` VALUES ('214', '1', '1.00', '0.80', '2019-07-09', '1');
INSERT INTO `addgastos` VALUES ('215', '1', '1.00', '2.00', '2019-07-13', '1');
INSERT INTO `addgastos` VALUES ('216', '1', '1.00', '2.20', '2019-07-13', '1');
INSERT INTO `addgastos` VALUES ('217', '1', '1.00', '1.00', '2019-07-13', '1');
INSERT INTO `addgastos` VALUES ('218', '1', '1.00', '1.05', '2019-07-13', '1');
INSERT INTO `addgastos` VALUES ('219', '1', '1.00', '2.00', '2019-07-15', '1');
INSERT INTO `addgastos` VALUES ('220', '1', '1.00', '2.20', '2019-07-15', '1');
INSERT INTO `addgastos` VALUES ('221', '1', '1.00', '0.60', '2019-07-15', '1');
INSERT INTO `addgastos` VALUES ('222', '1', '1.00', '2.00', '2019-07-16', '1');
INSERT INTO `addgastos` VALUES ('223', '1', '1.00', '2.40', '2019-07-16', '1');
INSERT INTO `addgastos` VALUES ('224', '1', '1.00', '1.35', '2019-07-16', '1');
INSERT INTO `addgastos` VALUES ('225', '1', '1.00', '2.00', '2019-07-16', '1');
INSERT INTO `addgastos` VALUES ('226', '1', '1.00', '2.00', '2019-07-17', '1');
INSERT INTO `addgastos` VALUES ('227', '1', '1.00', '2.00', '2019-07-18', '1');
INSERT INTO `addgastos` VALUES ('228', '1', '1.00', '2.60', '2019-07-18', '1');
INSERT INTO `addgastos` VALUES ('229', '1', '1.00', '0.90', '2019-07-18', '1');
INSERT INTO `addgastos` VALUES ('230', '1', '1.00', '1.00', '2019-07-19', '1');
INSERT INTO `addgastos` VALUES ('231', '1', '1.00', '2.00', '2019-07-20', '1');
INSERT INTO `addgastos` VALUES ('232', '1', '1.00', '1.20', '2019-07-19', '1');
INSERT INTO `addgastos` VALUES ('233', '1', '1.00', '0.75', '2019-07-19', '1');
INSERT INTO `addgastos` VALUES ('234', '1', '1.00', '1.00', '2019-07-20', '1');
INSERT INTO `addgastos` VALUES ('235', '1', '1.00', '2.00', '2019-07-20', '1');
INSERT INTO `addgastos` VALUES ('236', '1', '1.00', '2.20', '2019-07-20', '1');
INSERT INTO `addgastos` VALUES ('237', '1', '1.00', '1.20', '2019-07-20', '1');
INSERT INTO `addgastos` VALUES ('238', '10', '1.00', '7.70', '2019-07-16', '28');
INSERT INTO `addgastos` VALUES ('239', '3', '48.00', '21.60', '2019-07-13', '27');
INSERT INTO `addgastos` VALUES ('240', '14', '6.00', '4.40', '2019-07-25', '9');
INSERT INTO `addgastos` VALUES ('241', '13', '2.00', '0.64', '2019-07-25', '1');
INSERT INTO `addgastos` VALUES ('242', '63', '2.00', '6.20', '2019-07-25', '4');
INSERT INTO `addgastos` VALUES ('243', '78', '3.00', '3.60', '2019-07-25', '4');
INSERT INTO `addgastos` VALUES ('244', '65', '17.00', '4.00', '2019-07-25', '9');
INSERT INTO `addgastos` VALUES ('245', '18', '5.00', '1.00', '2019-07-25', '9');
INSERT INTO `addgastos` VALUES ('246', '34', '68.00', '3.20', '2019-07-25', '9');
INSERT INTO `addgastos` VALUES ('247', '79', '1.00', '3.50', '2019-07-25', '4');
INSERT INTO `addgastos` VALUES ('248', '2', '1.00', '1.50', '2019-07-11', '1');
INSERT INTO `addgastos` VALUES ('249', '2', '1.00', '1.50', '2019-07-12', '1');
INSERT INTO `addgastos` VALUES ('250', '2', '1.00', '1.50', '2019-07-13', '1');
INSERT INTO `addgastos` VALUES ('251', '2', '1.00', '1.00', '2019-07-26', '1');
INSERT INTO `addgastos` VALUES ('252', '2', '1.00', '2.00', '2019-07-26', '1');
INSERT INTO `addgastos` VALUES ('253', '2', '1.00', '2.00', '2019-07-27', '1');
INSERT INTO `addgastos` VALUES ('254', '2', '1.00', '2.00', '2019-07-28', '1');
INSERT INTO `addgastos` VALUES ('255', '1', '1.00', '2.00', '2019-07-22', '1');
INSERT INTO `addgastos` VALUES ('256', '1', '1.00', '2.00', '2019-07-23', '1');
INSERT INTO `addgastos` VALUES ('257', '1', '1.00', '2.00', '2019-07-24', '1');
INSERT INTO `addgastos` VALUES ('258', '1', '1.00', '2.00', '2019-07-25', '1');
INSERT INTO `addgastos` VALUES ('259', '1', '1.00', '2.00', '2019-07-26', '1');
INSERT INTO `addgastos` VALUES ('260', '1', '1.00', '1.00', '2019-07-27', '1');
INSERT INTO `addgastos` VALUES ('261', '1', '1.00', '2.00', '2019-07-26', '1');
INSERT INTO `addgastos` VALUES ('262', '1', '1.00', '1.80', '2019-07-27', '1');
INSERT INTO `addgastos` VALUES ('263', '1', '1.00', '0.90', '2019-07-27', '1');
INSERT INTO `addgastos` VALUES ('264', '2', '1.00', '2.00', '2019-07-14', '1');
INSERT INTO `addgastos` VALUES ('265', '2', '1.00', '2.00', '2019-07-15', '1');
INSERT INTO `addgastos` VALUES ('266', '2', '1.00', '2.00', '2019-07-16', '1');
INSERT INTO `addgastos` VALUES ('267', '2', '1.00', '2.00', '2019-07-17', '1');
INSERT INTO `addgastos` VALUES ('268', '2', '1.00', '3.00', '2019-07-18', '1');
INSERT INTO `addgastos` VALUES ('269', '2', '1.00', '2.00', '2019-07-19', '1');
INSERT INTO `addgastos` VALUES ('270', '2', '1.00', '2.00', '2019-07-20', '1');
INSERT INTO `addgastos` VALUES ('271', '9', '1.00', '5.00', '2019-07-30', '28');
INSERT INTO `addgastos` VALUES ('272', '10', '1.00', '5.00', '2019-07-31', '28');
INSERT INTO `addgastos` VALUES ('273', '12', '1.00', '2.00', '2019-08-01', '9');
INSERT INTO `addgastos` VALUES ('274', '15', '4.00', '1.15', '2019-07-30', '9');
INSERT INTO `addgastos` VALUES ('275', '14', '4.00', '2.00', '2019-07-30', '9');
INSERT INTO `addgastos` VALUES ('276', '14', '5.00', '2.50', '2019-08-01', '9');
INSERT INTO `addgastos` VALUES ('277', '80', '1.00', '1.00', '2019-07-31', '9');
INSERT INTO `addgastos` VALUES ('278', '80', '13.00', '0.80', '2019-08-01', '9');
INSERT INTO `addgastos` VALUES ('280', '63', '1.00', '12.00', '2019-08-01', '4');
INSERT INTO `addgastos` VALUES ('281', '37', '4.00', '4.00', '2019-08-01', '9');
INSERT INTO `addgastos` VALUES ('282', '81', '5.00', '2.00', '2019-08-01', '1');
INSERT INTO `addgastos` VALUES ('283', '82', '1.00', '2.00', '2019-07-03', '30');
INSERT INTO `addgastos` VALUES ('284', '82', '1.00', '2.00', '2019-07-09', '30');
INSERT INTO `addgastos` VALUES ('285', '82', '1.00', '2.00', '2019-07-30', '30');
INSERT INTO `addgastos` VALUES ('286', '83', '4.00', '1.90', '2019-08-01', '1');
INSERT INTO `addgastos` VALUES ('287', '65', '1.00', '2.00', '2019-07-31', '9');
INSERT INTO `addgastos` VALUES ('288', '34', '20.00', '2.00', '2019-08-01', '9');
INSERT INTO `addgastos` VALUES ('289', '2', '1.00', '3.50', '2019-07-31', '1');
INSERT INTO `addgastos` VALUES ('290', '2', '1.00', '3.50', '2019-08-01', '1');
INSERT INTO `addgastos` VALUES ('291', '2', '1.00', '1.00', '2019-08-02', '1');
INSERT INTO `addgastos` VALUES ('292', '2', '1.00', '1.00', '2019-08-03', '1');
INSERT INTO `addgastos` VALUES ('293', '2', '1.00', '1.00', '2019-08-04', '1');
INSERT INTO `addgastos` VALUES ('294', '2', '1.00', '1.00', '2019-08-05', '1');
INSERT INTO `addgastos` VALUES ('295', '2', '1.00', '3.50', '2019-08-06', '1');
INSERT INTO `addgastos` VALUES ('296', '2', '1.00', '3.50', '2019-08-07', '1');
INSERT INTO `addgastos` VALUES ('297', '2', '1.00', '1.00', '2019-08-08', '1');
INSERT INTO `addgastos` VALUES ('298', '1', '1.00', '1.00', '2019-07-29', '1');
INSERT INTO `addgastos` VALUES ('299', '1', '1.00', '2.00', '2019-07-29', '1');
INSERT INTO `addgastos` VALUES ('300', '1', '1.00', '2.20', '2019-07-29', '1');
INSERT INTO `addgastos` VALUES ('301', '1', '1.00', '1.65', '2019-07-29', '1');
INSERT INTO `addgastos` VALUES ('302', '1', '1.00', '2.00', '2019-07-30', '1');
INSERT INTO `addgastos` VALUES ('303', '1', '1.00', '2.00', '2019-07-31', '1');
INSERT INTO `addgastos` VALUES ('304', '1', '1.00', '1.00', '2019-08-01', '1');
INSERT INTO `addgastos` VALUES ('305', '1', '1.00', '2.00', '2019-08-01', '1');
INSERT INTO `addgastos` VALUES ('306', '1', '1.00', '1.00', '2019-08-01', '1');
INSERT INTO `addgastos` VALUES ('307', '1', '1.00', '0.75', '2019-08-01', '1');
INSERT INTO `addgastos` VALUES ('308', '1', '1.00', '1.80', '2019-08-02', '1');
INSERT INTO `addgastos` VALUES ('309', '1', '1.00', '1.20', '2019-08-02', '1');
INSERT INTO `addgastos` VALUES ('310', '1', '1.00', '1.00', '2019-08-02', '1');
INSERT INTO `addgastos` VALUES ('311', '1', '1.00', '2.00', '2019-08-02', '1');
INSERT INTO `addgastos` VALUES ('312', '1', '1.00', '1.00', '2019-08-04', '1');
INSERT INTO `addgastos` VALUES ('313', '1', '1.00', '2.00', '2019-08-04', '1');
INSERT INTO `addgastos` VALUES ('314', '1', '1.00', '0.80', '2019-08-04', '1');
INSERT INTO `addgastos` VALUES ('315', '1', '1.00', '0.60', '2019-08-04', '1');
INSERT INTO `addgastos` VALUES ('316', '29', '1.00', '4.00', '2019-08-01', '26');
INSERT INTO `addgastos` VALUES ('317', '29', '1.00', '6.00', '2019-08-07', '26');
INSERT INTO `addgastos` VALUES ('318', '9', '1.00', '4.00', '2019-08-07', '28');
INSERT INTO `addgastos` VALUES ('319', '10', '1.00', '4.00', '2019-08-07', '28');
INSERT INTO `addgastos` VALUES ('320', '29', '1.00', '3.60', '2019-08-07', '6');
INSERT INTO `addgastos` VALUES ('321', '12', '1.00', '2.50', '2019-08-06', '9');
INSERT INTO `addgastos` VALUES ('322', '15', '5.00', '1.05', '2019-08-06', '9');
INSERT INTO `addgastos` VALUES ('323', '19', '1.00', '4.00', '2019-08-05', '5');
INSERT INTO `addgastos` VALUES ('324', '19', '15.00', '1.50', '2019-08-07', '9');
INSERT INTO `addgastos` VALUES ('325', '18', '5.00', '1.00', '2019-08-01', '9');
INSERT INTO `addgastos` VALUES ('326', '18', '5.00', '1.00', '2019-08-02', '9');
INSERT INTO `addgastos` VALUES ('327', '18', '5.00', '1.00', '2019-08-03', '9');
INSERT INTO `addgastos` VALUES ('328', '18', '5.00', '1.00', '2019-08-05', '9');
INSERT INTO `addgastos` VALUES ('329', '18', '5.00', '1.00', '2019-08-06', '9');
INSERT INTO `addgastos` VALUES ('330', '18', '5.00', '1.00', '2019-08-07', '9');
INSERT INTO `addgastos` VALUES ('331', '18', '5.00', '1.00', '2019-08-09', '9');
INSERT INTO `addgastos` VALUES ('332', '12', '2.00', '2.00', '2019-08-09', '9');
INSERT INTO `addgastos` VALUES ('333', '15', '5.00', '1.00', '2019-08-09', '9');
INSERT INTO `addgastos` VALUES ('334', '14', '5.00', '2.40', '2019-08-09', '9');
INSERT INTO `addgastos` VALUES ('335', '76', '7.00', '1.00', '2019-08-06', '9');
INSERT INTO `addgastos` VALUES ('336', '84', '2.00', '1.00', '2019-08-09', '1');
INSERT INTO `addgastos` VALUES ('337', '82', '1.00', '2.00', '2019-08-09', '9');
INSERT INTO `addgastos` VALUES ('338', '34', '30.00', '2.00', '2019-08-05', '9');
INSERT INTO `addgastos` VALUES ('339', '34', '30.00', '2.00', '2019-08-09', '9');
INSERT INTO `addgastos` VALUES ('340', '65', '9.00', '2.20', '2019-08-01', '9');
INSERT INTO `addgastos` VALUES ('341', '65', '9.00', '2.20', '2019-08-06', '9');
INSERT INTO `addgastos` VALUES ('342', '1', '1.00', '2.00', '2019-08-05', '1');
INSERT INTO `addgastos` VALUES ('343', '1', '1.00', '0.60', '2019-08-05', '1');
INSERT INTO `addgastos` VALUES ('344', '1', '1.00', '0.15', '2019-08-05', '1');
INSERT INTO `addgastos` VALUES ('345', '1', '1.00', '0.15', '2019-08-05', '1');
INSERT INTO `addgastos` VALUES ('346', '1', '1.00', '2.00', '2019-08-06', '1');
INSERT INTO `addgastos` VALUES ('347', '1', '1.00', '1.00', '2019-08-06', '1');
INSERT INTO `addgastos` VALUES ('348', '1', '1.00', '0.40', '2019-08-06', '1');
INSERT INTO `addgastos` VALUES ('349', '1', '1.00', '2.00', '2019-08-07', '1');
INSERT INTO `addgastos` VALUES ('350', '1', '1.00', '2.00', '2019-08-07', '1');
INSERT INTO `addgastos` VALUES ('351', '1', '1.00', '2.80', '2019-08-07', '1');
INSERT INTO `addgastos` VALUES ('352', '1', '1.00', '1.35', '2019-08-07', '1');
INSERT INTO `addgastos` VALUES ('353', '1', '1.00', '2.00', '2019-08-08', '1');
INSERT INTO `addgastos` VALUES ('354', '1', '1.00', '0.80', '2019-08-08', '1');
INSERT INTO `addgastos` VALUES ('355', '1', '1.00', '0.60', '2019-08-08', '1');
INSERT INTO `addgastos` VALUES ('356', '1', '1.00', '2.00', '2019-08-09', '1');
INSERT INTO `addgastos` VALUES ('357', '1', '1.00', '2.00', '2019-08-10', '1');
INSERT INTO `addgastos` VALUES ('358', '1', '1.00', '1.00', '2019-08-10', '1');
INSERT INTO `addgastos` VALUES ('359', '1', '1.00', '0.75', '2019-08-10', '1');
INSERT INTO `addgastos` VALUES ('360', '1', '1.00', '1.60', '2019-08-10', '1');
INSERT INTO `addgastos` VALUES ('361', '1', '1.00', '2.00', '2019-08-11', '1');
INSERT INTO `addgastos` VALUES ('362', '1', '1.00', '1.00', '2019-08-11', '1');
INSERT INTO `addgastos` VALUES ('363', '1', '1.00', '1.20', '2019-08-11', '1');
INSERT INTO `addgastos` VALUES ('364', '1', '1.00', '1.05', '2019-08-11', '1');
INSERT INTO `addgastos` VALUES ('365', '2', '1.00', '2.50', '2019-08-09', '1');
INSERT INTO `addgastos` VALUES ('366', '2', '1.00', '2.50', '2019-08-10', '1');
INSERT INTO `addgastos` VALUES ('367', '2', '1.00', '1.50', '2019-08-11', '1');
INSERT INTO `addgastos` VALUES ('368', '34', '50.00', '2.00', '2019-08-11', '9');
INSERT INTO `addgastos` VALUES ('369', '11', '4.00', '4.00', '2019-08-11', '1');
INSERT INTO `addgastos` VALUES ('370', '77', '1.00', '5.00', '2019-08-12', '9');
INSERT INTO `addgastos` VALUES ('371', '79', '1.00', '3.50', '2019-08-01', '9');
INSERT INTO `addgastos` VALUES ('372', '79', '1.00', '3.50', '2019-08-12', '9');
INSERT INTO `addgastos` VALUES ('373', '31', '2.00', '2.70', '2019-08-12', '19');
INSERT INTO `addgastos` VALUES ('374', '5', '2.00', '4.20', '2019-08-12', '27');
INSERT INTO `addgastos` VALUES ('375', '63', '4.00', '24.80', '2019-08-12', '9');
INSERT INTO `addgastos` VALUES ('376', '85', '1.00', '4.00', '2019-08-12', '18');
INSERT INTO `addgastos` VALUES ('377', '1', '1.00', '2.00', '2019-08-12', '1');
INSERT INTO `addgastos` VALUES ('378', '1', '1.00', '2.00', '2019-08-13', '1');
INSERT INTO `addgastos` VALUES ('379', '1', '1.00', '2.00', '2019-08-14', '1');
INSERT INTO `addgastos` VALUES ('380', '1', '1.00', '2.00', '2019-08-14', '1');
INSERT INTO `addgastos` VALUES ('381', '1', '1.00', '3.00', '2019-08-14', '1');
INSERT INTO `addgastos` VALUES ('382', '1', '1.00', '1.50', '2019-08-14', '1');
INSERT INTO `addgastos` VALUES ('383', '1', '1.00', '2.00', '2019-08-15', '1');
INSERT INTO `addgastos` VALUES ('384', '1', '1.00', '0.60', '2019-08-15', '1');
INSERT INTO `addgastos` VALUES ('385', '1', '1.00', '0.30', '2019-08-15', '1');
INSERT INTO `addgastos` VALUES ('386', '1', '1.00', '2.00', '2019-08-16', '1');
INSERT INTO `addgastos` VALUES ('387', '1', '1.00', '2.00', '2019-08-17', '1');
INSERT INTO `addgastos` VALUES ('388', '1', '1.00', '0.40', '2019-08-17', '1');
INSERT INTO `addgastos` VALUES ('389', '1', '1.00', '0.15', '2019-08-17', '1');
INSERT INTO `addgastos` VALUES ('390', '1', '1.00', '1.00', '2019-08-17', '1');
INSERT INTO `addgastos` VALUES ('391', '19', '3.00', '8.00', '2019-08-16', '5');
INSERT INTO `addgastos` VALUES ('392', '18', '4.00', '0.80', '2019-08-10', '9');
INSERT INTO `addgastos` VALUES ('393', '18', '4.00', '0.80', '2019-08-12', '9');
INSERT INTO `addgastos` VALUES ('395', '18', '4.00', '0.80', '2019-08-13', '9');
INSERT INTO `addgastos` VALUES ('396', '18', '2.00', '0.80', '2019-08-14', '9');
INSERT INTO `addgastos` VALUES ('397', '18', '4.00', '0.80', '2019-08-15', '9');
INSERT INTO `addgastos` VALUES ('398', '18', '4.00', '0.80', '2019-08-16', '9');
INSERT INTO `addgastos` VALUES ('399', '12', '1.00', '1.50', '2019-08-13', '9');
INSERT INTO `addgastos` VALUES ('400', '14', '4.00', '2.00', '2019-08-13', '9');
INSERT INTO `addgastos` VALUES ('401', '15', '4.00', '0.80', '2019-08-13', '9');
INSERT INTO `addgastos` VALUES ('402', '2', '1.00', '2.50', '2019-08-12', '1');
INSERT INTO `addgastos` VALUES ('403', '2', '1.00', '2.50', '2019-08-13', '1');
INSERT INTO `addgastos` VALUES ('404', '2', '1.00', '2.50', '2019-08-14', '1');
INSERT INTO `addgastos` VALUES ('405', '2', '1.00', '2.00', '2019-08-15', '1');
INSERT INTO `addgastos` VALUES ('406', '2', '1.00', '2.00', '2019-08-16', '1');
INSERT INTO `addgastos` VALUES ('407', '2', '1.00', '2.00', '2019-08-17', '1');
INSERT INTO `addgastos` VALUES ('408', '75', '1.00', '283.00', '2019-08-14', '30');
INSERT INTO `addgastos` VALUES ('409', '53', '1.00', '40.00', '2019-08-24', '30');
INSERT INTO `addgastos` VALUES ('410', '11', '1.00', '3.00', '2019-08-22', '9');
INSERT INTO `addgastos` VALUES ('411', '86', '1.00', '80.00', '2019-08-26', '30');
INSERT INTO `addgastos` VALUES ('412', '74', '1.00', '100.00', '2019-08-28', '30');
INSERT INTO `addgastos` VALUES ('413', '79', '1.00', '3.50', '2019-08-22', '9');
INSERT INTO `addgastos` VALUES ('414', '77', '1.00', '3.00', '2019-08-27', '9');
INSERT INTO `addgastos` VALUES ('415', '16', '1.00', '15.00', '2019-08-27', '19');
INSERT INTO `addgastos` VALUES ('416', '9', '1.00', '3.00', '2019-08-27', '9');
INSERT INTO `addgastos` VALUES ('417', '14', '4.00', '2.00', '2019-08-22', '9');
INSERT INTO `addgastos` VALUES ('418', '12', '2.00', '2.00', '2019-08-22', '9');
INSERT INTO `addgastos` VALUES ('419', '2', '1.00', '1.00', '2019-08-24', '1');
INSERT INTO `addgastos` VALUES ('420', '2', '1.00', '1.00', '2019-08-26', '1');
INSERT INTO `addgastos` VALUES ('421', '2', '1.00', '1.00', '2019-08-27', '1');
INSERT INTO `addgastos` VALUES ('422', '2', '1.00', '2.00', '2019-08-28', '1');

-- ----------------------------
-- Table structure for agencia
-- ----------------------------
DROP TABLE IF EXISTS `agencia`;
CREATE TABLE `agencia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `pago` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=85 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of agencia
-- ----------------------------
INSERT INTO `agencia` VALUES ('1', 'NOVELA CUBA', '0');
INSERT INTO `agencia` VALUES ('2', 'BATIDA TRAVEL', '0');
INSERT INTO `agencia` VALUES ('3', 'BB VIÑALES', '0');
INSERT INTO `agencia` VALUES ('4', 'BESPOKE NEW YORK', '0');
INSERT INTO `agencia` VALUES ('5', 'BEST CASAS IN CUBA', '0');
INSERT INTO `agencia` VALUES ('6', 'CALEDONIA', '0');
INSERT INTO `agencia` VALUES ('7', 'CUBA  SELECT  TRAVEL', '0');
INSERT INTO `agencia` VALUES ('8', 'CUBA ACCOMMODATION', '0');
INSERT INTO `agencia` VALUES ('9', 'CUBA AUTREMENT', '0');
INSERT INTO `agencia` VALUES ('10', 'CUBA DIRECT', '0');
INSERT INTO `agencia` VALUES ('11', 'CUBA FOR TRAVEL', '0');
INSERT INTO `agencia` VALUES ('12', 'CUBA INCENTIVES', '0');
INSERT INTO `agencia` VALUES ('13', 'CUBA REAL TOURS', '0');
INSERT INTO `agencia` VALUES ('14', 'CUBA ROCKS', '0');
INSERT INTO `agencia` VALUES ('15', 'CUBATUR', '0');
INSERT INTO `agencia` VALUES ('16', 'DAIQUIRI TOURS', '0');
INSERT INTO `agencia` VALUES ('17', 'DIRECTA', '1');
INSERT INTO `agencia` VALUES ('18', 'DISTANT HORIZONS', '0');
INSERT INTO `agencia` VALUES ('19', 'ETURIA ROMANIA', '0');
INSERT INTO `agencia` VALUES ('20', 'GRAND SLAM', '0');
INSERT INTO `agencia` VALUES ('21', 'GREEN ALLIGATOR', '0');
INSERT INTO `agencia` VALUES ('22', 'GUIA PETIT FUTE', '0');
INSERT INTO `agencia` VALUES ('23', 'HAVANA VIP TOURS', '0');
INSERT INTO `agencia` VALUES ('24', 'HAVANA HOLDING', '0');
INSERT INTO `agencia` VALUES ('25', 'HOLIDAY PLACE', '0');
INSERT INTO `agencia` VALUES ('26', 'HUWANS', '0');
INSERT INTO `agencia` VALUES ('27', 'LATITUD CUBA', '0');
INSERT INTO `agencia` VALUES ('28', 'LOCALLY SOURCED', '0');
INSERT INTO `agencia` VALUES ('29', 'NUEVOS HORIZONTES', '0');
INSERT INTO `agencia` VALUES ('30', 'ONLY ONE TRAVEL', '0');
INSERT INTO `agencia` VALUES ('31', 'P&G TRAVEL', '0');
INSERT INTO `agencia` VALUES ('32', 'SAN CRISTOBAL UK', '0');
INSERT INTO `agencia` VALUES ('33', 'TRANSAT', '0');
INSERT INTO `agencia` VALUES ('34', 'TRANSNICO', '0');
INSERT INTO `agencia` VALUES ('35', 'TRAVEL WELCOME', '0');
INSERT INTO `agencia` VALUES ('36', 'UMBRELLA TRAVEL', '0');
INSERT INTO `agencia` VALUES ('37', 'WILD CARIBE', '0');
INSERT INTO `agencia` VALUES ('38', 'WOW CUBA', '0');
INSERT INTO `agencia` VALUES ('39', 'ROOTS TRAVEL', '0');
INSERT INTO `agencia` VALUES ('40', 'AC JOURNEYS', '0');
INSERT INTO `agencia` VALUES ('41', 'CASA PLUS', '0');
INSERT INTO `agencia` VALUES ('42', 'CONTINENTE INSOLITO', '0');
INSERT INTO `agencia` VALUES ('43', 'SANDRA VAZQUEZ', '0');
INSERT INTO `agencia` VALUES ('44', 'CUBA PRIVATE TRAVEL', '0');
INSERT INTO `agencia` VALUES ('45', 'SERGIO', '0');
INSERT INTO `agencia` VALUES ('46', 'AMY & MARION TOURS', '0');
INSERT INTO `agencia` VALUES ('47', 'FABIANA', '0');
INSERT INTO `agencia` VALUES ('48', 'CUBA HOLIDAY', null);
INSERT INTO `agencia` VALUES ('49', 'Destination Cuba', null);
INSERT INTO `agencia` VALUES ('50', 'INCLOUD-9', null);
INSERT INTO `agencia` VALUES ('51', 'R-EVOLUTIONS', null);
INSERT INTO `agencia` VALUES ('52', 'EL CHINO', null);
INSERT INTO `agencia` VALUES ('53', 'MICHEL LIBANO', null);
INSERT INTO `agencia` VALUES ('54', 'MARC ALTEA', null);
INSERT INTO `agencia` VALUES ('55', 'AirBnB', '0');
INSERT INTO `agencia` VALUES ('56', 'MIKE MIRECKI', null);
INSERT INTO `agencia` VALUES ('57', 'CUBA UNIQUE', null);
INSERT INTO `agencia` VALUES ('58', 'CAPTIVATING CUBA', null);
INSERT INTO `agencia` VALUES ('59', 'CUBARIZON', null);
INSERT INTO `agencia` VALUES ('60', 'HOLIPLUS', null);
INSERT INTO `agencia` VALUES ('61', 'SENSES OF CUBA', null);
INSERT INTO `agencia` VALUES ('62', 'TOURCOM CUBA', null);
INSERT INTO `agencia` VALUES ('63', 'MALECON 663', null);
INSERT INTO `agencia` VALUES ('64', 'LLOICA', null);
INSERT INTO `agencia` VALUES ('65', 'ROYAL TROPICAL TOUR', null);
INSERT INTO `agencia` VALUES ('66', 'CARIBBEAN TOURS', null);
INSERT INTO `agencia` VALUES ('67', 'BARAKA BARCELONA', null);
INSERT INTO `agencia` VALUES ('68', 'EMRE ', null);
INSERT INTO `agencia` VALUES ('69', 'BESPOKE TRIPS TO CUBA', null);
INSERT INTO `agencia` VALUES ('70', 'ALLWAYS', null);
INSERT INTO `agencia` VALUES ('71', 'CTTOUR TRAVEL', null);
INSERT INTO `agencia` VALUES ('72', 'TRAVEL AGE', null);
INSERT INTO `agencia` VALUES ('73', 'LE COMPTOIR DES CARAIBES', null);
INSERT INTO `agencia` VALUES ('74', 'RELAX HAVANA', null);
INSERT INTO `agencia` VALUES ('75', 'HOSTAL LA RESERVA', null);
INSERT INTO `agencia` VALUES ('76', 'CUBA CANDELA', null);
INSERT INTO `agencia` VALUES ('77', 'VENTAS ZONA NORTE', null);
INSERT INTO `agencia` VALUES ('78', 'LATIN AMERICA TRAVEL', null);
INSERT INTO `agencia` VALUES ('79', 'CUBA BUDDY', null);
INSERT INTO `agencia` VALUES ('80', 'CUBA TRAVEL NETWORK (CTN)', null);
INSERT INTO `agencia` VALUES ('81', 'ROBERTO CARLOS', null);
INSERT INTO `agencia` VALUES ('82', 'EXPERIENCE CUBA LLC', null);
INSERT INTO `agencia` VALUES ('83', 'RENT.CU', null);
INSERT INTO `agencia` VALUES ('84', 'TERRE AUTENTIK', null);

-- ----------------------------
-- Table structure for aux
-- ----------------------------
DROP TABLE IF EXISTS `aux`;
CREATE TABLE `aux` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `fecha_entrada` varchar(255) NOT NULL,
  `fecha_salida` varchar(255) NOT NULL,
  `agencia` int(11) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agenc` (`agencia`),
  CONSTRAINT `agenc` FOREIGN KEY (`agencia`) REFERENCES `agencia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of aux
-- ----------------------------

-- ----------------------------
-- Table structure for dpto
-- ----------------------------
DROP TABLE IF EXISTS `dpto`;
CREATE TABLE `dpto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `gastos` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `gastos2` (`gastos`),
  CONSTRAINT `gastos2` FOREIGN KEY (`gastos`) REFERENCES `gastos` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dpto
-- ----------------------------
INSERT INTO `dpto` VALUES ('1', 'LIMPIEZA', '1');
INSERT INTO `dpto` VALUES ('2', 'COCINA', '2');

-- ----------------------------
-- Table structure for dpto_funciones
-- ----------------------------
DROP TABLE IF EXISTS `dpto_funciones`;
CREATE TABLE `dpto_funciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dpto` int(11) NOT NULL,
  `func` int(11) NOT NULL,
  `precio` double NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dpto1` (`dpto`) USING BTREE,
  KEY `func1` (`func`) USING BTREE,
  CONSTRAINT `dpto_funciones_ibfk_1` FOREIGN KEY (`dpto`) REFERENCES `dpto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `dpto_funciones_ibfk_2` FOREIGN KEY (`func`) REFERENCES `funciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of dpto_funciones
-- ----------------------------
INSERT INTO `dpto_funciones` VALUES ('1', '1', '54', '1');
INSERT INTO `dpto_funciones` VALUES ('2', '1', '55', '1');
INSERT INTO `dpto_funciones` VALUES ('3', '1', '30', '1');
INSERT INTO `dpto_funciones` VALUES ('4', '1', '18', '1');
INSERT INTO `dpto_funciones` VALUES ('5', '1', '63', '1');
INSERT INTO `dpto_funciones` VALUES ('6', '1', '36', '0');
INSERT INTO `dpto_funciones` VALUES ('7', '1', '11', '2');
INSERT INTO `dpto_funciones` VALUES ('8', '1', '37', '0');
INSERT INTO `dpto_funciones` VALUES ('9', '2', '54', '1');
INSERT INTO `dpto_funciones` VALUES ('10', '2', '55', '1');
INSERT INTO `dpto_funciones` VALUES ('11', '2', '30', '1');
INSERT INTO `dpto_funciones` VALUES ('12', '2', '62', '1');
INSERT INTO `dpto_funciones` VALUES ('13', '2', '18', '1');
INSERT INTO `dpto_funciones` VALUES ('14', '2', '63', '1');
INSERT INTO `dpto_funciones` VALUES ('15', '2', '36', '0');
INSERT INTO `dpto_funciones` VALUES ('16', '2', '11', '2');
INSERT INTO `dpto_funciones` VALUES ('17', '2', '37', '0');
INSERT INTO `dpto_funciones` VALUES ('18', '1', '64', '0.25');
INSERT INTO `dpto_funciones` VALUES ('19', '1', '65', '0.15');
INSERT INTO `dpto_funciones` VALUES ('20', '2', '64', '0.25');
INSERT INTO `dpto_funciones` VALUES ('21', '2', '65', '0.15');

-- ----------------------------
-- Table structure for funciones
-- ----------------------------
DROP TABLE IF EXISTS `funciones`;
CREATE TABLE `funciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `precio` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of funciones
-- ----------------------------
INSERT INTO `funciones` VALUES ('7', 'CENA', '1');
INSERT INTO `funciones` VALUES ('11', 'LIMPIEZA DE CASA', '2');
INSERT INTO `funciones` VALUES ('18', 'EXTRAS', '1');
INSERT INTO `funciones` VALUES ('24', 'CAFE', '0.5');
INSERT INTO `funciones` VALUES ('30', 'DESAYUNO', '0.5');
INSERT INTO `funciones` VALUES ('36', 'LAVADO CLIENTES', '0');
INSERT INTO `funciones` VALUES ('37', 'PROPINAS', '0');
INSERT INTO `funciones` VALUES ('54', 'ALMUERZO DE LA CASA', '1');
INSERT INTO `funciones` VALUES ('55', 'COMIDA DE LA CASA', '1');
INSERT INTO `funciones` VALUES ('62', 'DULCES Y PANETELA', '1');
INSERT INTO `funciones` VALUES ('63', 'HAB DE SALIDA', '1');
INSERT INTO `funciones` VALUES ('64', 'LAVADO PIEZAS GRANDES', '0.2');
INSERT INTO `funciones` VALUES ('65', 'LAVADO PIEZAS PEQUEÑAS', '0.15');

-- ----------------------------
-- Table structure for gastos
-- ----------------------------
DROP TABLE IF EXISTS `gastos`;
CREATE TABLE `gastos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=87 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of gastos
-- ----------------------------
INSERT INTO `gastos` VALUES ('1', 'SALARIO LIMPIEZA');
INSERT INTO `gastos` VALUES ('2', 'SALARIO COCINA');
INSERT INTO `gastos` VALUES ('3', 'AGUA');
INSERT INTO `gastos` VALUES ('4', 'AGUA GASEADA');
INSERT INTO `gastos` VALUES ('5', 'ACEITE');
INSERT INTO `gastos` VALUES ('6', 'AZUCAR');
INSERT INTO `gastos` VALUES ('7', 'ARROZ');
INSERT INTO `gastos` VALUES ('8', 'SAL');
INSERT INTO `gastos` VALUES ('9', 'JAMON');
INSERT INTO `gastos` VALUES ('10', 'QUESO GOUDA');
INSERT INTO `gastos` VALUES ('11', 'QUESO BLANCO');
INSERT INTO `gastos` VALUES ('12', 'FRUTA BOMBA');
INSERT INTO `gastos` VALUES ('13', 'GUAYABA');
INSERT INTO `gastos` VALUES ('14', 'PIÑA');
INSERT INTO `gastos` VALUES ('15', 'MANGO');
INSERT INTO `gastos` VALUES ('16', 'MANTEQUILLA');
INSERT INTO `gastos` VALUES ('17', 'VINAGRE');
INSERT INTO `gastos` VALUES ('18', 'PAN');
INSERT INTO `gastos` VALUES ('19', 'HUEVO');
INSERT INTO `gastos` VALUES ('20', 'CERVEZA CRISTAL');
INSERT INTO `gastos` VALUES ('21', 'CERVEZA BUCANERO');
INSERT INTO `gastos` VALUES ('22', 'REFRESCO COLA');
INSERT INTO `gastos` VALUES ('23', 'REFRESCO NARANJA');
INSERT INTO `gastos` VALUES ('24', 'REFRESCO LIMON');
INSERT INTO `gastos` VALUES ('25', 'JUGO LIMON');
INSERT INTO `gastos` VALUES ('26', 'JUGO NARANJA');
INSERT INTO `gastos` VALUES ('27', 'JABON DE BAÑO');
INSERT INTO `gastos` VALUES ('28', 'JABON DE LAVAR');
INSERT INTO `gastos` VALUES ('29', 'DETERGENTE');
INSERT INTO `gastos` VALUES ('30', 'LECHE EN POLVO');
INSERT INTO `gastos` VALUES ('31', 'LECHE EVAPORADA');
INSERT INTO `gastos` VALUES ('32', 'MIEL DE ABEJA');
INSERT INTO `gastos` VALUES ('33', 'TE');
INSERT INTO `gastos` VALUES ('34', 'DULCES DUROS');
INSERT INTO `gastos` VALUES ('35', 'LIMPIEDA DE CASA');
INSERT INTO `gastos` VALUES ('36', 'LLAVES COPIA');
INSERT INTO `gastos` VALUES ('37', 'PLATOS');
INSERT INTO `gastos` VALUES ('38', 'COPAS');
INSERT INTO `gastos` VALUES ('39', 'SARTENES');
INSERT INTO `gastos` VALUES ('40', 'TOALLAS DE MANO');
INSERT INTO `gastos` VALUES ('41', 'CENICERO');
INSERT INTO `gastos` VALUES ('42', 'LECHERA');
INSERT INTO `gastos` VALUES ('43', 'ABRIDOR BOTELLA');
INSERT INTO `gastos` VALUES ('44', 'PINZA PARA ENSALADA');
INSERT INTO `gastos` VALUES ('45', 'BOLSA PARA BASURA');
INSERT INTO `gastos` VALUES ('46', 'PLUMERO');
INSERT INTO `gastos` VALUES ('47', 'TOALLA COCINA');
INSERT INTO `gastos` VALUES ('48', 'PAPEL SANITARIO');
INSERT INTO `gastos` VALUES ('49', 'LAMPARAS');
INSERT INTO `gastos` VALUES ('50', 'CANCHANCHARA');
INSERT INTO `gastos` VALUES ('51', 'PORTA CERVILLETAS');
INSERT INTO `gastos` VALUES ('52', 'FOTOS');
INSERT INTO `gastos` VALUES ('53', 'INTERNET');
INSERT INTO `gastos` VALUES ('54', 'ESTOPAS');
INSERT INTO `gastos` VALUES ('55', 'KETCHUP');
INSERT INTO `gastos` VALUES ('56', 'MOSTAZA');
INSERT INTO `gastos` VALUES ('57', 'MERMELADA');
INSERT INTO `gastos` VALUES ('58', 'SPRAY MOSQUITOS');
INSERT INTO `gastos` VALUES ('59', 'SHAMPOO');
INSERT INTO `gastos` VALUES ('60', 'TOMATE');
INSERT INTO `gastos` VALUES ('61', 'AJI');
INSERT INTO `gastos` VALUES ('62', 'PEPINO');
INSERT INTO `gastos` VALUES ('63', 'CAFE');
INSERT INTO `gastos` VALUES ('64', 'LIMON');
INSERT INTO `gastos` VALUES ('65', 'FLORES');
INSERT INTO `gastos` VALUES ('66', 'antena wifi');
INSERT INTO `gastos` VALUES ('67', 'MERIENDA ALBAÑILES');
INSERT INTO `gastos` VALUES ('69', 'ALMUERZO ALBAÑILES');
INSERT INTO `gastos` VALUES ('70', 'ARREGLO MUEBLE');
INSERT INTO `gastos` VALUES ('71', 'escoba ');
INSERT INTO `gastos` VALUES ('72', 'SERVILLETA');
INSERT INTO `gastos` VALUES ('73', 'FRASADA DE PISO');
INSERT INTO `gastos` VALUES ('74', 'ELECTRICIDAD');
INSERT INTO `gastos` VALUES ('75', 'PATENTE');
INSERT INTO `gastos` VALUES ('76', 'PLATANO');
INSERT INTO `gastos` VALUES ('77', 'CHORIZO VELA');
INSERT INTO `gastos` VALUES ('78', 'Cereal');
INSERT INTO `gastos` VALUES ('79', 'SALCHICHON');
INSERT INTO `gastos` VALUES ('80', 'COL');
INSERT INTO `gastos` VALUES ('81', 'NARANJA');
INSERT INTO `gastos` VALUES ('82', 'BICITAXI');
INSERT INTO `gastos` VALUES ('83', 'PAPA');
INSERT INTO `gastos` VALUES ('84', 'MALANGA');
INSERT INTO `gastos` VALUES ('85', 'cebolla');
INSERT INTO `gastos` VALUES ('86', 'EQUIPO PARA INTERNET');

-- ----------------------------
-- Table structure for habitacion
-- ----------------------------
DROP TABLE IF EXISTS `habitacion`;
CREATE TABLE `habitacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `color` varchar(255) DEFAULT NULL,
  `codigo` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of habitacion
-- ----------------------------
INSERT INTO `habitacion` VALUES ('10', 'HAB 1', null, '1');
INSERT INTO `habitacion` VALUES ('11', 'HAB 2', null, '0');
INSERT INTO `habitacion` VALUES ('12', 'HAB 3', null, '1');

-- ----------------------------
-- Table structure for notificaciones
-- ----------------------------
DROP TABLE IF EXISTS `notificaciones`;
CREATE TABLE `notificaciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipo` varchar(255) NOT NULL,
  `titulo` varchar(255) NOT NULL,
  `notificacion` varchar(255) NOT NULL,
  `estado` int(255) DEFAULT '0',
  `fecha` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=178 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of notificaciones
-- ----------------------------
INSERT INTO `notificaciones` VALUES ('1', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  EMDIN Nadine   con fecha del 2017-12-08 al 2017-12-11 esta proxima a activarse', '1', 'ba434efad6202298172d1d461b288603');
INSERT INTO `notificaciones` VALUES ('2', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Michael Maier    con fecha del 2017-12-11 al 2017-12-13 esta proxima a activarse', '1', 'acdc4303eba12c35e500a5967fd2aece');
INSERT INTO `notificaciones` VALUES ('3', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  James Glasbey   con fecha del 2017-12-11 al 2017-12-13 esta proxima a activarse', '1', 'edc3689068cef5edd94d94f7abaa7a88');
INSERT INTO `notificaciones` VALUES ('4', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: M. Collard con fecha del 2017-12-12 al 2017-12-14 esta proxima a activarse', '1', '30a10a0e9f3605224e67e710809d872c');
INSERT INTO `notificaciones` VALUES ('5', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  dsfd con fecha del 2017-12-19 al 2017-12-22 esta proxima a activarse', '1', 'fa6c432b51cdb6e5a41b915502cae9f7');
INSERT INTO `notificaciones` VALUES ('6', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  dsfds  con fecha del 2017-12-20 al 2017-12-23 esta proxima a activarse', '1', '89e9b85e9fbc824b744932558888dd55');
INSERT INTO `notificaciones` VALUES ('7', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: denys  con fecha del 2017-12-19 al 2017-12-22 esta proxima a activarse', '1', '5a68da1fda768c8a42da2952e2a08bdc');
INSERT INTO `notificaciones` VALUES ('8', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  dsfd 33333  con fecha del 2017-12-19 al 2022-12-16 esta proxima a activarse', '1', '4760e116fa8aa94e37a142cf03c90fd8');
INSERT INTO `notificaciones` VALUES ('9', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  dsfds   con fecha del 2017-12-21 al 2017-12-25 esta proxima a activarse', '1', '9348109a94f26f6325c53e25a0aa89e6');
INSERT INTO `notificaciones` VALUES ('10', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  dsfd 33333  con fecha del 2017-12-19 al 2017-12-28 esta proxima a activarse', '1', '241f107b86202cd83fe1a13ca260d799');
INSERT INTO `notificaciones` VALUES ('11', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:   Marie-Claire GAT   con fecha del 2017-12-20 al 2017-12-22 esta proxima a activarse', '1', '0d5a7df71c199e701dbae2d7f73dc5bb');
INSERT INTO `notificaciones` VALUES ('12', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Larissa  Ickx con fecha del 2017-12-20 al 2017-12-23 esta proxima a activarse', '1', '2338a6bbef6040d9ae3e06b30ebe38d0');
INSERT INTO `notificaciones` VALUES ('13', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Dr Ian Glendinning x2  con fecha del 2017-12-21 al 2017-12-25 esta proxima a activarse', '1', 'b3d7994c942ceeb2805da31283815faf');
INSERT INTO `notificaciones` VALUES ('14', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Julie  con fecha del 2017-12-21 al 2017-12-22 esta proxima a activarse', '1', '62c93fb08852c9a37e707754277afd83');
INSERT INTO `notificaciones` VALUES ('15', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Joanne con fecha del 2017-12-22 al 2017-12-24 esta proxima a activarse', '1', '8a11b4c3d853830ef9c733aa7170cf20');
INSERT INTO `notificaciones` VALUES ('16', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Joanne  con fecha del 2017-12-22 al 2017-12-24 esta proxima a activarse', '1', 'b858b1b5642c2994a359b016bdfc9699');
INSERT INTO `notificaciones` VALUES ('17', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: Joanne con fecha del 2017-12-22 al 2017-12-24 esta proxima a activarse', '1', 'bf07d9eb4b5e5db3bd39cd9dcf8d3375');
INSERT INTO `notificaciones` VALUES ('18', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  MALAQUAIS Dominique con fecha del 2017-12-24 al 2017-12-26 esta proxima a activarse', '1', '706c14a8a44dfd5d452edfac98857693');
INSERT INTO `notificaciones` VALUES ('19', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Sandage x 4  con fecha del 2017-12-24 al 2017-12-27 esta proxima a activarse', '1', 'da63f853632bea00aee5fd8c7a2de9e6');
INSERT INTO `notificaciones` VALUES ('20', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Sara x 3 con fecha del 2017-12-25 al 2017-12-28 esta proxima a activarse', '1', '91403c7f2023bf28f2875e099862c6c0');
INSERT INTO `notificaciones` VALUES ('21', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Michael Tremege con fecha del 2017-12-25 al 2017-12-28 esta proxima a activarse', '1', 'b467e1d9109e22c6fb17bcb0bc314f32');
INSERT INTO `notificaciones` VALUES ('22', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Tracey Seagal  con fecha del 2017-12-26 al 2017-12-28 esta proxima a activarse', '1', '008e900bc3a4814a89e0c913eecbeb43');
INSERT INTO `notificaciones` VALUES ('23', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  DAVID & SEAL con fecha del 2017-12-26 al 2017-12-28 esta proxima a activarse', '1', 'ab543429cbf1acac465893d461309396');
INSERT INTO `notificaciones` VALUES ('24', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  BONCHRISTIANO con fecha del 2017-12-27 al 2017-12-31 esta proxima a activarse', '1', '22bcea8b0dfb8b8b9f8741b32c18223c');
INSERT INTO `notificaciones` VALUES ('25', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  ISON X4  con fecha del 2017-12-28 al 2017-12-31 esta proxima a activarse', '1', '64a8d70a876dd027b5e6d9959417e282');
INSERT INTO `notificaciones` VALUES ('26', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Victor Hofmann  con fecha del 2017-12-28 al 2017-12-29 esta proxima a activarse', '1', '999e709abcb6356dcda73217f25f1aad');
INSERT INTO `notificaciones` VALUES ('27', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Ron Zeelens x 4 con fecha del 2017-12-28 al 2017-12-31 esta proxima a activarse', '1', '53e3714ec86ff1e45756c1ee1bd82150');
INSERT INTO `notificaciones` VALUES ('28', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Aurelia con fecha del 2017-12-29 al 2017-12-31 esta proxima a activarse', '1', 'e9fd8939ca194ef3ee1c1dbbf59dbefd');
INSERT INTO `notificaciones` VALUES ('29', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Aria Dasbach  con fecha del 2017-12-26 al 2017-12-27 esta proxima a activarse', '1', '927e67dc852eb1a7b9f6b4225fd35048');
INSERT INTO `notificaciones` VALUES ('30', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  JOHN MACLEAN con fecha del 2017-12-29 al 2017-12-30 esta proxima a activarse', '1', '1ec5ce19df074064443651b2f3ad4662');
INSERT INTO `notificaciones` VALUES ('31', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: JOHN MACLEAN con fecha del 2017-12-29 al 2017-12-30 esta proxima a activarse', '1', 'aa97e6a199dc00f16571f49c88c1e4e1');
INSERT INTO `notificaciones` VALUES ('32', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Dominique x 2 con fecha del 2017-12-31 al 2019-01-02 esta proxima a activarse', '1', '5ddfd643e1d370c9e8b2f14dfaf1b2e2');
INSERT INTO `notificaciones` VALUES ('33', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Jose Pineda con fecha del 2018-01-01 al 2018-01-03 esta proxima a activarse', '1', '95f27de824011f29a956996943006e0d');
INSERT INTO `notificaciones` VALUES ('34', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Stefani y bea con fecha del 2018-01-01 al 2018-01-03 esta proxima a activarse', '1', 'ad61bd81593206de87221719867b99b7');
INSERT INTO `notificaciones` VALUES ('35', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Katerine Lopez   con fecha del 2018-01-01 al 2018-01-04 esta proxima a activarse', '1', '1a308226809c7eed6056a8698d5e130a');
INSERT INTO `notificaciones` VALUES ('36', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Martina Sanna con fecha del 2018-01-02 al 2018-01-04 esta proxima a activarse', '1', 'd1e665d1026cdec544ef3ce7cc8c1b02');
INSERT INTO `notificaciones` VALUES ('37', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:   Antin x 3 con fecha del 2018-01-02 al 2018-01-04 esta proxima a activarse', '1', 'd8dc2bec3da6e85d41b234ab5718ce1a');
INSERT INTO `notificaciones` VALUES ('38', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  LAURA KELLY X 2 con fecha del 2018-01-02 al 2018-01-05 esta proxima a activarse', '1', '25e0cf9ff6eb169ffcf4da0fbc92fdc4');
INSERT INTO `notificaciones` VALUES ('39', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: Stefani y bea con fecha del 2018-01-01 al 2018-01-02 esta proxima a activarse', '1', 'f835ba9464acedaa1d73aa42e7bad115');
INSERT INTO `notificaciones` VALUES ('40', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: Stefani y bea con fecha del 2018-01-02 al 2018-01-03 esta proxima a activarse', '1', '8b0ead2ce36cfbe3586d340c34233a5d');
INSERT INTO `notificaciones` VALUES ('41', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Henry x 4 con fecha del 2018-01-02 al 2018-01-04 esta proxima a activarse', '1', '163ef64eb74e5ec4e3ad9644c57e112a');
INSERT INTO `notificaciones` VALUES ('42', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  CICLOTURISMO MAQUEENS con fecha del 2018-01-04 al 2018-01-06 esta proxima a activarse', '1', 'ef964e370759c9b911c588bc3a3d8fe6');
INSERT INTO `notificaciones` VALUES ('43', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  VAN LIERDE con fecha del 2018-01-04 al 2018-01-06 esta proxima a activarse', '1', '6a56c6d047026f2bfa1e4fd31750fd14');
INSERT INTO `notificaciones` VALUES ('44', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Andrew Lane con fecha del 2018-01-05 al 2018-01-08 esta proxima a activarse', '1', 'c6386c4818e1e8980aa553741cc9062e');
INSERT INTO `notificaciones` VALUES ('45', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Katherine López Rojas con fecha del 2018-01-03 al 2018-01-05 esta proxima a activarse', '1', '02b1605d7cbc9046192e755b5b3d1d4f');
INSERT INTO `notificaciones` VALUES ('46', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Marie-Christine con fecha del 2018-01-06 al 2018-01-10 esta proxima a activarse', '1', '624efbfeb625b9040f48467821d96e69');
INSERT INTO `notificaciones` VALUES ('47', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Susan Stuehrk  con fecha del 2018-01-06 al 2018-01-09 esta proxima a activarse', '1', '429b32f358b93719ae7666747d1c8bc6');
INSERT INTO `notificaciones` VALUES ('48', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: Abdou y Cristina  con fecha del 2018-01-05 al 2018-01-07 esta proxima a activarse', '1', 'd1efb28c9a01777d3feed1ae6793313f');
INSERT INTO `notificaciones` VALUES ('49', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  QUENTIN VANDEGUCHT con fecha del 2018-01-07 al 2018-01-09 esta proxima a activarse', '1', '1cf1ec4b21cc3b0049565a28d9f2f2be');
INSERT INTO `notificaciones` VALUES ('50', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Mrs. Wendy Balmer x 2 con fecha del 2018-01-07 al 2018-01-10 esta proxima a activarse', '1', 'faa8444d6878ab0304d91f9955da2ffd');
INSERT INTO `notificaciones` VALUES ('51', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Anne y guy Mendenoff con fecha del 2018-01-07 al 2018-01-10 esta proxima a activarse', '1', 'f62c4b2fbea39c677fdd7ab96f19665d');
INSERT INTO `notificaciones` VALUES ('52', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: ANDRES GONZALES hopla con fecha del 2018-01-09 al 2018-01-11 esta proxima a activarse', '1', 'c35be4f7dd0845a7b4ae77280697fcf0');
INSERT INTO `notificaciones` VALUES ('53', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  camila clez con fecha del 2018-01-09 al 2018-01-11 esta proxima a activarse', '1', 'fab0388a99f3787d0c85e75dc8e2ea57');
INSERT INTO `notificaciones` VALUES ('54', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: ANDRES GONZALES hopla  con fecha del 2018-01-09 al 2018-01-12 esta proxima a activarse', '1', 'daba1a0dfa00c8b0d3b83ccd040568e6');
INSERT INTO `notificaciones` VALUES ('55', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: ANDRES GONZALES hopla   con fecha del 2018-01-09 al 2018-01-13 esta proxima a activarse', '1', 'd8e5a4f13578ec18edc5924b5f87495a');
INSERT INTO `notificaciones` VALUES ('56', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  camila clez  con fecha del 2018-01-09 al 2018-01-13 esta proxima a activarse', '1', 'f8a4648e51d2844808e7561ea3a3978a');
INSERT INTO `notificaciones` VALUES ('57', 'salida', 'Reserva Pendiente a salida', 'La reserva del Cliente:  Marie-Christine  con fecha del 2018-01-31 al 2018-01-10 esta proxima a terminarse', '1', '23bb0b156b6543645f5dff42142b3831');
INSERT INTO `notificaciones` VALUES ('58', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  jacqueline Date  X 2 con fecha del 2018-01-09 al 2018-01-11 esta proxima a activarse', '1', '5c3e8d8d6062aca353f63a6fbc949510');
INSERT INTO `notificaciones` VALUES ('59', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  jacqueline Date  X 2  con fecha del 2018-01-09 al 2018-01-11 esta proxima a activarse', '1', '8b703aaf710c5d268d2901bb5a34ca47');
INSERT INTO `notificaciones` VALUES ('60', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  David Steele x1 con fecha del 2018-01-09 al 2018-01-12 esta proxima a activarse', '1', 'a924e0136e9c014a0876d6b0ff5822e5');
INSERT INTO `notificaciones` VALUES ('61', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  MARTEAU X 2 con fecha del 2018-01-09 al 2018-01-11 esta proxima a activarse', '1', '0ad1acdbb7e92c7fadc304fda8abc38a');
INSERT INTO `notificaciones` VALUES ('62', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Familia Ayme con fecha del 2018-01-11 al 2018-01-13 esta proxima a activarse', '1', '00673034677a0f8aa405e3ccd18eca23');
INSERT INTO `notificaciones` VALUES ('63', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Juris Petrobon y Max Zubler con fecha del 2018-01-11 al 2018-01-15 esta proxima a activarse', '1', '6ec548e59feed75de5402c4787102ad6');
INSERT INTO `notificaciones` VALUES ('64', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: ronny suarez rosdildo con fecha del 2018-01-12 al 2018-01-20 esta proxima a activarse', '1', '075ad6880c5d6a861e35ef4b6d50c4be');
INSERT INTO `notificaciones` VALUES ('65', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: Carol y Anthony Jordan   con fecha del 2018-01-12 al 2018-01-13 esta proxima a activarse', '1', 'efc26f7dde65a2f4375a7eeb122d7d95');
INSERT INTO `notificaciones` VALUES ('66', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:   Fam. De Vreede x 2 con fecha del 2018-01-14 al 2018-01-17 esta proxima a activarse', '1', 'e8cdac4f9f9684725dbf3918d771d8a9');
INSERT INTO `notificaciones` VALUES ('67', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  NAAR con fecha del 2018-01-14 al 2018-01-16 esta proxima a activarse', '1', '74d106b57178611167f8a41891355656');
INSERT INTO `notificaciones` VALUES ('68', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: RASMUSSEN  con fecha del 2018-01-16 al 2018-01-18 esta proxima a activarse', '1', '16eed6cecad736d5adbb5a63cc3923f8');
INSERT INTO `notificaciones` VALUES ('69', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  AKHCHINE Hicham con fecha del 2018-01-16 al 2018-01-19 esta proxima a activarse', '1', '567475f7560a3854368557380447d743');
INSERT INTO `notificaciones` VALUES ('70', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: RONNY SUAREZ ROSILDO con fecha del 2018-01-16 al 2018-01-18 esta proxima a activarse', '1', 'f03e317a11c72c64ac3fbac3c39e46f0');
INSERT INTO `notificaciones` VALUES ('71', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: PRUEBA con fecha del 2018-01-15 al 2018-01-17 esta proxima a activarse', '1', '7b8dea0529e455993d0253f76c6d4350');
INSERT INTO `notificaciones` VALUES ('72', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  HOLA MUNDO con fecha del 2018-01-15 al 2018-01-17 esta proxima a activarse', '1', '18b213e0b17aa51f814d849c6364eaac');
INSERT INTO `notificaciones` VALUES ('73', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: ANDRES GONZALES con fecha del 2018-01-15 al 2018-01-17 esta proxima a activarse', '1', 'fc38404632d4038d2c2a9fccbd160bcb');
INSERT INTO `notificaciones` VALUES ('74', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Cornolle con fecha del 2018-01-17 al 2018-01-19 esta proxima a activarse', '1', 'd1bfdd5d8b3b62748d33f0405c4fbd76');
INSERT INTO `notificaciones` VALUES ('75', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: AKHCHINE Hicham con fecha del 2018-01-16 al 2018-01-19 esta proxima a activarse', '1', '9610b466ca25d3dfe5baa419dcf4fb86');
INSERT INTO `notificaciones` VALUES ('76', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: RASMUSSEN con fecha del 2018-01-16 al 2018-01-18 esta proxima a activarse', '1', '8c7831dedbfd432c7691cff4a6200cf3');
INSERT INTO `notificaciones` VALUES ('77', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Marinus  van Lambalgen x 3 con fecha del 2018-01-18 al 2018-01-20 esta proxima a activarse', '1', '3c47b8b78545199406285be928ee5479');
INSERT INTO `notificaciones` VALUES ('78', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Janette Harwick con fecha del 2018-01-19 al 2018-01-21 esta proxima a activarse', '1', '28f460de0b4fbe737943bfa2a1086b00');
INSERT INTO `notificaciones` VALUES ('79', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Angela x 3  con fecha del 2018-01-19 al 2018-01-21 esta proxima a activarse', '1', '0f680e6475e6c791ed0faca788e1289d');
INSERT INTO `notificaciones` VALUES ('80', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  MR & MRS FARRAR-HOCKLEY con fecha del 2018-01-19 al 2018-01-22 esta proxima a activarse', '1', '54eb2dbc764c87b648f61fab16a21ed9');
INSERT INTO `notificaciones` VALUES ('81', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Nicholas Hodges con fecha del 2018-01-19 al 2018-01-22 esta proxima a activarse', '1', '5d127f9d1367da7bf9aa4f88252b3609');
INSERT INTO `notificaciones` VALUES ('82', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: Donner x 4 con fecha del 2018-01-19 al 2018-01-22 esta proxima a activarse', '1', 'f3e8fc394e51b7925e35d42234d17ccd');
INSERT INTO `notificaciones` VALUES ('83', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Patricia LETU con fecha del 2018-01-24 al 2018-01-28 esta proxima a activarse', '1', '6e6051885870c29ca601eaf6b400343d');
INSERT INTO `notificaciones` VALUES ('84', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Marcos Pedraza x 4 con fecha del 2018-01-21 al 2018-01-23 esta proxima a activarse', '1', 'ff5cb1432c308ad349440de026c3d83e');
INSERT INTO `notificaciones` VALUES ('85', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: CICLOTURISMO MAQUEENS con fecha del 2018-01-22 al 2018-01-24 esta proxima a activarse', '1', '94ce590d56bf8d930fdea8dbc3f4e605');
INSERT INTO `notificaciones` VALUES ('86', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  MEISTER x 2 con fecha del 2018-01-22 al 2018-01-24 esta proxima a activarse', '1', 'b9c0313df09e7de243ae137146dbd55f');
INSERT INTO `notificaciones` VALUES ('87', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Jean GOUBATIAN con fecha del 2018-01-23 al 2018-01-24 esta proxima a activarse', '1', 'd6157d29bb8ed71f947f0f7914f41b9a');
INSERT INTO `notificaciones` VALUES ('88', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  LUKAS PIETROBON con fecha del 2018-01-23 al 2018-01-26 esta proxima a activarse', '1', '876f9affaf35f6091545b7df8f9cce41');
INSERT INTO `notificaciones` VALUES ('89', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  VOS X2 con fecha del 2018-01-23 al 2018-01-26 esta proxima a activarse', '1', '927259fc3e86dc9a2f1bc68ec2aa47ea');
INSERT INTO `notificaciones` VALUES ('90', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Patricia LETU con fecha del 2018-01-25 al 2018-01-27 esta proxima a activarse', '1', 'e9e5e2f4dfc205515b343848ebe1a4b5');
INSERT INTO `notificaciones` VALUES ('91', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Guillaume Claude con fecha del 2018-01-24 al 2018-01-27 esta proxima a activarse', '1', '2322e795007f5bb576ce9d441f32c786');
INSERT INTO `notificaciones` VALUES ('92', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: RIM  DE KUWAIT   con fecha del 2018-01-24 al 2018-01-26 esta proxima a activarse', '1', 'b537b49e8c6a53a23c05fe4398607f44');
INSERT INTO `notificaciones` VALUES ('93', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: COCAGNE Antoine con fecha del 2018-01-28 al 2018-01-31 esta proxima a activarse', '1', 'a9e227ed805ca54c679a5b266e1332ed');
INSERT INTO `notificaciones` VALUES ('94', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Lori Harmon x 2  con fecha del 2018-01-25 al 2018-01-28 esta proxima a activarse', '1', '188a0ccaa911f0c13a9a12b7b2407eaa');
INSERT INTO `notificaciones` VALUES ('95', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Ghislaine con fecha del 2018-01-28 al 2018-01-30 esta proxima a activarse', '1', '3128ba0e1f15328ff2d1c53f01ae56fc');
INSERT INTO `notificaciones` VALUES ('96', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Christine and Jon con fecha del 2018-01-30 al 2018-02-02 esta proxima a activarse', '1', 'bfceac8f68fca22c28fd4561c63920e5');
INSERT INTO `notificaciones` VALUES ('97', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Mr. A elphick con fecha del 2018-01-30 al 2018-02-03 esta proxima a activarse', '1', '671506100d8c0535f102041e8aa3ed6e');
INSERT INTO `notificaciones` VALUES ('98', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  CELINE BUARD con fecha del 2018-01-30 al 2018-02-01 esta proxima a activarse', '1', 'c47892c2e6e4ffcad429ffc123cfa561');
INSERT INTO `notificaciones` VALUES ('99', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Dr Eric Ahlquist con fecha del 2018-01-31 al 2018-02-02 esta proxima a activarse', '1', '637b3ea4f722484c1beb4bf0a38efb67');
INSERT INTO `notificaciones` VALUES ('100', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Julia Hammond Johnson con fecha del 2018-02-01 al 2018-02-04 esta proxima a activarse', '1', '08e2f388f8b04dcd1ddd7ca2cba8504d');
INSERT INTO `notificaciones` VALUES ('101', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Robert Jones con fecha del 2018-02-01 al 2018-02-04 esta proxima a activarse', '1', '4b4e9c5f755725fda15f3b9d8cf96964');
INSERT INTO `notificaciones` VALUES ('102', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  RICARDO  con fecha del 2018-02-01 al 2018-02-03 esta proxima a activarse', '1', '675c83849ab86a77e9e1d45c04750eaf');
INSERT INTO `notificaciones` VALUES ('103', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  John Morgan  con fecha del 2018-02-02 al 2018-02-04 esta proxima a activarse', '1', '5fe16adc59a420482ec86883c7d6579d');
INSERT INTO `notificaciones` VALUES ('104', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  David Brewer  con fecha del 2018-02-03 al 2018-02-06 esta proxima a activarse', '1', '712c5396966da8f09d139ed31a597fe7');
INSERT INTO `notificaciones` VALUES ('105', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Mr. John Hodges X2 con fecha del 2018-02-06 al 2018-02-09 esta proxima a activarse', '1', '4499f9b3dba776da97f7ea2ac6674bfe');
INSERT INTO `notificaciones` VALUES ('106', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Mr Allan Thomas Ridley con fecha del 2018-02-06 al 2018-02-09 esta proxima a activarse', '1', '433037ad377c0656af13d53b502e9d20');
INSERT INTO `notificaciones` VALUES ('107', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Jocelyn Glebocki con fecha del 2018-02-08 al 2018-02-11 esta proxima a activarse', '1', 'dda9859dd297938d9a92b2280a42cdf9');
INSERT INTO `notificaciones` VALUES ('108', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Anne Urban con fecha del 2018-02-09 al 2018-02-12 esta proxima a activarse', '1', 'c3500e95d52eafae424647332ed64548');
INSERT INTO `notificaciones` VALUES ('109', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Debra Smerdon con fecha del 2018-02-09 al 2018-02-12 esta proxima a activarse', '1', 'f1ef4b0882192b2feeef63e8656da759');
INSERT INTO `notificaciones` VALUES ('110', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Julia Roberts con fecha del 2018-02-10 al 2018-02-13 esta proxima a activarse', '1', 'beb52230ec93c08ee8d68a91891c7a0b');
INSERT INTO `notificaciones` VALUES ('111', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Christine Skube con fecha del 2018-02-09 al 2018-02-11 esta proxima a activarse', '1', '65bf895d7727fde5b9f42740a155953c');
INSERT INTO `notificaciones` VALUES ('112', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Henrietta Seymour con fecha del 2018-02-11 al 2018-02-14 esta proxima a activarse', '1', 'cecd07ba2114cf5ce159fd292d85cfca');
INSERT INTO `notificaciones` VALUES ('113', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: RONNY SUAREZ ROSILDO con fecha del 2018-02-12 al 2018-02-15 esta proxima a activarse', '1', '7941116c71a447534c5e0d4ac4b75f36');
INSERT INTO `notificaciones` VALUES ('114', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:   Mr Peter James x 2 con fecha del 2018-02-12 al 2018-02-14 esta proxima a activarse', '1', 'e06322e2e4c5dc8144954360bba81577');
INSERT INTO `notificaciones` VALUES ('115', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  David Turrent x 2 con fecha del 2018-02-12 al 2018-02-15 esta proxima a activarse', '1', 'f491beac528af2262734bde5e53159f6');
INSERT INTO `notificaciones` VALUES ('116', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Nuria con fecha del 2018-02-17 al 2018-02-18 esta proxima a activarse', '1', '1c42e215867a699ea4ca7da428f95352');
INSERT INTO `notificaciones` VALUES ('117', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Pauline con fecha del 2018-02-17 al 2018-02-18 esta proxima a activarse', '1', '35519f3d83b1cbb02f75a4fb7fd23d86');
INSERT INTO `notificaciones` VALUES ('118', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Susana Urquia-Markus con fecha del 2018-02-18 al 2018-02-21 esta proxima a activarse', '1', 'ffc7c76f1b2701d1acf815e8bc90aa75');
INSERT INTO `notificaciones` VALUES ('119', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Neil Reynolds con fecha del 2018-02-18 al 2018-02-21 esta proxima a activarse', '1', 'a53124ae2e875ae5483971bdaa773f12');
INSERT INTO `notificaciones` VALUES ('120', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Mrs Philippa Turner & Mr David Turner con fecha del 2018-02-18 al 2018-02-20 esta proxima a activarse', '1', '42b47f2c390a0f678957f57ee7dfd261');
INSERT INTO `notificaciones` VALUES ('121', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  CYNTHIA LEE X 4   con fecha del 2018-02-18 al 2018-02-20 esta proxima a activarse', '1', '3cd5c20566d4857b9ca86f50159ad094');
INSERT INTO `notificaciones` VALUES ('122', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  LOU PETIT-LAGRANGE con fecha del 2018-02-19 al 2018-02-21 esta proxima a activarse', '1', 'c7f234b97fa4a14b6d1b8b18749a362d');
INSERT INTO `notificaciones` VALUES ('123', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Jody & Gary Lyons  con fecha del 2018-02-20 al 2018-02-22 esta proxima a activarse', '1', '86bab5f11483f2e49f1d6178df7c2cde');
INSERT INTO `notificaciones` VALUES ('124', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  MICKWITZ X2  con fecha del 2018-02-20 al 2018-02-25 esta proxima a activarse', '1', '7d3e6e7293ec76e3a48bbb3830f9007b');
INSERT INTO `notificaciones` VALUES ('125', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Miss Krishna Anand & Mr Timothy Williams con fecha del 2018-02-21 al 2018-02-25 esta proxima a activarse', '1', 'c1ae0b70019113344a2f7b68833fe76a');
INSERT INTO `notificaciones` VALUES ('126', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  CHAILLY X 4  con fecha del 2018-02-22 al 2018-02-24 esta proxima a activarse', '1', '8240d18e83d52400c92789bda5d57220');
INSERT INTO `notificaciones` VALUES ('127', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Mr Elfyn Tudur Jones & Ms Linda  Williams con fecha del 2018-02-22 al 2018-02-25 esta proxima a activarse', '1', 'f5ba640ec74de82ea7638373b882f626');
INSERT INTO `notificaciones` VALUES ('128', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  VILASéCA Ariane  con fecha del 2018-02-22 al 2018-02-24 esta proxima a activarse', '1', 'b2bfbb7ead6fa6466efe026180783512');
INSERT INTO `notificaciones` VALUES ('129', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:   James Steele con fecha del 2018-02-26 al 2018-02-28 esta proxima a activarse', '1', '71a91780a7919e1d2870d45979f3d90e');
INSERT INTO `notificaciones` VALUES ('130', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Katrina Trotter   con fecha del 2018-02-26 al 2018-03-01 esta proxima a activarse', '1', '2a0109ed39210b3baa368e55da295561');
INSERT INTO `notificaciones` VALUES ('131', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Cliente CAVALIE con fecha del 2018-02-27 al 2018-03-01 esta proxima a activarse', '1', '79b23cda40e5b2f40ba50eee82770c12');
INSERT INTO `notificaciones` VALUES ('132', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:   Iñigo Central   con fecha del 2018-02-27 al 2018-03-01 esta proxima a activarse', '1', '985ecd089866d3422ec816ef41b15a45');
INSERT INTO `notificaciones` VALUES ('133', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  NIVARD Florence con fecha del 2018-02-27 al 2018-03-01 esta proxima a activarse', '1', '79d1f0f9dbe661339c7ec6765907640b');
INSERT INTO `notificaciones` VALUES ('134', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  COURTIEU Philippe  con fecha del 2018-02-28 al 2018-03-02 esta proxima a activarse', '1', '49f8136d9bad7fedebc3e6d81d196cc2');
INSERT INTO `notificaciones` VALUES ('135', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  ROUSSEAU X4 con fecha del 2018-02-28 al 2018-03-02 esta proxima a activarse', '1', '60a45ec9bcd27dc39ab3e3f0e35f7334');
INSERT INTO `notificaciones` VALUES ('136', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Margarite Corcoran con fecha del 2018-03-01 al 2018-03-03 esta proxima a activarse', '1', 'cf1127c67f4b8e846190417e01ecb617');
INSERT INTO `notificaciones` VALUES ('137', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Erwin Steinmann con fecha del 2018-03-01 al 2018-03-03 esta proxima a activarse', '1', '5e13e85807fd2c814ecf0d6a947c48a0');
INSERT INTO `notificaciones` VALUES ('138', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Mrs. Olivia Eley x 3 con fecha del 2018-03-02 al 2018-03-04 esta proxima a activarse', '1', '70f3fc3fb16d7fc66b94057cf2a3bd17');
INSERT INTO `notificaciones` VALUES ('139', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  ARVIND AMIGO DE MICHEL con fecha del 2018-03-01 al 2018-03-03 esta proxima a activarse', '1', 'c592f9afc34934a77b2a405a3293a8db');
INSERT INTO `notificaciones` VALUES ('140', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  MATTEI Isabelle con fecha del 2018-03-02 al 2018-03-04 esta proxima a activarse', '1', 'ef66cbe89f004176961ffe456769ae75');
INSERT INTO `notificaciones` VALUES ('141', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: CHRISTINA X 2 con fecha del 2018-03-03 al 2018-03-04 esta proxima a activarse', '1', 'c2ce79699476ce3a5598b212059f5769');
INSERT INTO `notificaciones` VALUES ('142', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Simone Collings con fecha del 2018-03-04 al 2018-03-06 esta proxima a activarse', '1', 'ad60df6bc6759bab97f56440a1ae2419');
INSERT INTO `notificaciones` VALUES ('143', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  PETIT Jean con fecha del 2018-03-05 al 2018-03-08 esta proxima a activarse', '1', 'a0bd4b04217b412b317b9368658c91c0');
INSERT INTO `notificaciones` VALUES ('144', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Henry & Gail Shepherd con fecha del 2018-03-06 al 2018-03-08 esta proxima a activarse', '1', '44723c6e18b35afa9090c4b42e17dee0');
INSERT INTO `notificaciones` VALUES ('145', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Cicloturismo Macqueens  con fecha del 2018-03-06 al 2018-03-08 esta proxima a activarse', '1', '5c90f210384de753f495b0ec00995ce1');
INSERT INTO `notificaciones` VALUES ('146', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Tabea y Matthias Kannenberg con fecha del 2018-03-08 al 2018-03-10 esta proxima a activarse', '1', 'c8db7489840c1b9d097864822f265904');
INSERT INTO `notificaciones` VALUES ('147', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:             Francois + Fabienne CAVAILLON con fecha del 2018-03-08 al 2018-03-10 esta proxima a activarse', '1', '464d4521c7c4362dfe93a45f59ddb54c');
INSERT INTO `notificaciones` VALUES ('148', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  ROSEMARY con fecha del 2018-03-08 al 2018-03-11 esta proxima a activarse', '1', '35ee7f7fc88acc1b3d82f950e731d9c5');
INSERT INTO `notificaciones` VALUES ('149', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:      HALONEN con fecha del 2018-03-08 al 2018-03-10 esta proxima a activarse', '1', 'ef9ad18229f626eb9fcda6f3f9c4d9ee');
INSERT INTO `notificaciones` VALUES ('150', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: RENS/SANDRA con fecha del 2018-03-09 al 2018-03-11 esta proxima a activarse', '1', 'bd8ae0e694ecf8f9724f81da77328a2a');
INSERT INTO `notificaciones` VALUES ('151', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Barbara Van Den  con fecha del 2018-03-09 al 2018-03-11 esta proxima a activarse', '1', 'd540caa93e5327a9af124b96538187b1');
INSERT INTO `notificaciones` VALUES ('152', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Big Journey con fecha del 2018-03-11 al 2018-03-14 esta proxima a activarse', '1', '92f2496b5a617449a67871121b80f8c7');
INSERT INTO `notificaciones` VALUES ('153', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  ASTRID TRIAEN X 4 con fecha del 2018-03-12 al 2018-03-13 esta proxima a activarse', '1', '545da7ffbf52884be1b9bfdd9300fe79');
INSERT INTO `notificaciones` VALUES ('154', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente: Chantal Muller con fecha del 2018-03-12 al 2018-03-16 esta proxima a activarse', '1', '9094219793be95b73a367236857599d0');
INSERT INTO `notificaciones` VALUES ('155', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Cpt885-Ms Tatiana Akhmedova con fecha del 2018-03-12 al 2018-03-15 esta proxima a activarse', '1', '08fb363dc89c91d4eb5f067f0f2bfd23');
INSERT INTO `notificaciones` VALUES ('156', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Rob con fecha del 2018-03-13 al 2018-03-16 esta proxima a activarse', '1', 'de7b9908ad7bb9903ed7fffd3a8ffa7a');
INSERT INTO `notificaciones` VALUES ('157', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  LAURA con fecha del 2018-03-13 al 2018-03-14 esta proxima a activarse', '1', 'e3873c8f11d28bf306331a1530dcc7e6');
INSERT INTO `notificaciones` VALUES ('158', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Gwendoline Sutton con fecha del 2018-03-14 al 2018-03-16 esta proxima a activarse', '1', 'a69101e5723fc320064ab0ae003b2c63');
INSERT INTO `notificaciones` VALUES ('159', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  LE FOL Karine con fecha del 2018-03-14 al 2018-03-17 esta proxima a activarse', '1', 'cc353d0b4bd8d6309858d03cc1cba796');
INSERT INTO `notificaciones` VALUES ('160', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  LANDAIS Jean-claude con fecha del 2018-03-15 al 2018-03-18 esta proxima a activarse', '1', '886cb9055a7d445cf6228c2316e68e20');
INSERT INTO `notificaciones` VALUES ('161', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  WISNIAK Alain con fecha del 2018-03-16 al 2018-03-19 esta proxima a activarse', '1', '3673aa29776ab9451ffe4e82a0c1c039');
INSERT INTO `notificaciones` VALUES ('162', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  MONIN con fecha del 2018-03-16 al 2018-03-21 esta proxima a activarse', '1', '38f9532afba3ed573a7eb6f1aabfbfb8');
INSERT INTO `notificaciones` VALUES ('163', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Juliet Tattum con fecha del 2018-03-16 al 2018-03-19 esta proxima a activarse', '1', '9448c412d8da81a3080b99ff16865376');
INSERT INTO `notificaciones` VALUES ('164', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  POUVEROUX Marie con fecha del 2018-03-17 al 2018-03-20 esta proxima a activarse', '1', 'fe7105304f66f8a79aca803bfe9947f9');
INSERT INTO `notificaciones` VALUES ('165', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:   Pierre 1 prja x 5 nches con fecha del 2018-03-19 al 2018-03-23 esta proxima a activarse', '1', '28659bcbbe96dc0333495cef15f1c7f5');
INSERT INTO `notificaciones` VALUES ('166', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Caroline Grayburn x 3 con fecha del 2018-03-19 al 2018-03-22 esta proxima a activarse', '1', '3062bdbd9cf665fc873b4d8357de3b05');
INSERT INTO `notificaciones` VALUES ('167', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Emanuel DAUGUET con fecha del 2018-03-19 al 2018-03-20 esta proxima a activarse', '1', 'e2e2b99c372dbf43618536619a100723');
INSERT INTO `notificaciones` VALUES ('168', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  CASENAVE X2 con fecha del 2018-03-19 al 2018-03-21 esta proxima a activarse', '1', 'b90d1edd60262ec7c6c7794f2c1a01a5');
INSERT INTO `notificaciones` VALUES ('169', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Anne Dinning x4 con fecha del 2018-03-20 al 2018-03-22 esta proxima a activarse', '1', '91de96c44690f6767f70b6f75a4efa40');
INSERT INTO `notificaciones` VALUES ('170', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  BARETTI con fecha del 2018-03-20 al 2018-03-22 esta proxima a activarse', '1', 'df94fb634656ba306902a90f11601eaa');
INSERT INTO `notificaciones` VALUES ('171', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  MARCH Legit Trip  con fecha del 2018-03-22 al 2018-03-24 esta proxima a activarse', '1', '96311db0178bcad8baf8facae96fe723');
INSERT INTO `notificaciones` VALUES ('172', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Stanley Lee con fecha del 2018-03-22 al 2018-03-25 esta proxima a activarse', '1', '5741dd89ef5a428001df2040de8fb9a6');
INSERT INTO `notificaciones` VALUES ('173', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Raymond Wilkinson con fecha del 2018-03-23 al 2018-03-26 esta proxima a activarse', '1', '37d3417a3bfa4596e4c365da43b6921a');
INSERT INTO `notificaciones` VALUES ('174', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Fanny Saulay  con fecha del 2018-03-24 al 2018-03-26 esta proxima a activarse', '1', '3eb7be76d8d133778a0a89931081d44e');
INSERT INTO `notificaciones` VALUES ('175', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:   Fanny Saulay  con fecha del 2018-03-24 al 2018-03-26 esta proxima a activarse', '1', '11d23a5fb6ec1b91462c0799a0ed7fed');
INSERT INTO `notificaciones` VALUES ('176', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Mrs Karen  Neale x 4 con fecha del 2018-04-01 al 2018-04-04 esta proxima a activarse', '1', '23130b30ce69c695718a086a17ad9d88');
INSERT INTO `notificaciones` VALUES ('177', 'entrada', 'Reserva Pendiente a entrada', 'La reserva del Cliente:  Lisa Newton con fecha del 2018-04-01 al 2018-04-04 esta proxima a activarse', '1', '49f8e5515b268d1fdb7c5894f31f27d6');

-- ----------------------------
-- Table structure for ocupacion
-- ----------------------------
DROP TABLE IF EXISTS `ocupacion`;
CREATE TABLE `ocupacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ocupacion
-- ----------------------------
INSERT INTO `ocupacion` VALUES ('3', 'SENCILLA');
INSERT INTO `ocupacion` VALUES ('4', 'DOBLE');
INSERT INTO `ocupacion` VALUES ('5', 'TRIPLE');
INSERT INTO `ocupacion` VALUES ('7', 'DOBLE + SUP');
INSERT INTO `ocupacion` VALUES ('8', 'TRIPLE + SUP');
INSERT INTO `ocupacion` VALUES ('12', 'CUADRUPLE');

-- ----------------------------
-- Table structure for ocupacion_hab
-- ----------------------------
DROP TABLE IF EXISTS `ocupacion_hab`;
CREATE TABLE `ocupacion_hab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ocupacion` int(255) NOT NULL,
  `hab` int(255) NOT NULL,
  `precio` double(255,0) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hab` (`hab`) USING BTREE,
  KEY `ocupacion` (`ocupacion`) USING BTREE,
  CONSTRAINT `ocupacion_hab_ibfk_1` FOREIGN KEY (`hab`) REFERENCES `habitacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ocupacion_hab_ibfk_2` FOREIGN KEY (`ocupacion`) REFERENCES `ocupacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of ocupacion_hab
-- ----------------------------
INSERT INTO `ocupacion_hab` VALUES ('52', '3', '11', '70');
INSERT INTO `ocupacion_hab` VALUES ('53', '4', '11', '70');
INSERT INTO `ocupacion_hab` VALUES ('62', '3', '10', '120');
INSERT INTO `ocupacion_hab` VALUES ('63', '4', '10', '120');
INSERT INTO `ocupacion_hab` VALUES ('64', '5', '10', '120');
INSERT INTO `ocupacion_hab` VALUES ('65', '3', '12', '25');
INSERT INTO `ocupacion_hab` VALUES ('66', '4', '12', '30');

-- ----------------------------
-- Table structure for pasadia
-- ----------------------------
DROP TABLE IF EXISTS `pasadia`;
CREATE TABLE `pasadia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `fecha` date NOT NULL,
  `estado` int(11) NOT NULL,
  `agencia` int(11) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agen` (`agencia`),
  CONSTRAINT `agen` FOREIGN KEY (`agencia`) REFERENCES `agencia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pasadia
-- ----------------------------

-- ----------------------------
-- Table structure for pasadia_servicio
-- ----------------------------
DROP TABLE IF EXISTS `pasadia_servicio`;
CREATE TABLE `pasadia_servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pasadia` int(11) NOT NULL,
  `servicio` int(11) NOT NULL,
  `cant` int(11) NOT NULL,
  `precio` double(255,2) NOT NULL,
  `incluir` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pasadia` (`pasadia`),
  KEY `serv` (`servicio`),
  CONSTRAINT `pasadia` FOREIGN KEY (`pasadia`) REFERENCES `pasadia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `serv` FOREIGN KEY (`servicio`) REFERENCES `subservicios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of pasadia_servicio
-- ----------------------------

-- ----------------------------
-- Table structure for plan
-- ----------------------------
DROP TABLE IF EXISTS `plan`;
CREATE TABLE `plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of plan
-- ----------------------------
INSERT INTO `plan` VALUES ('1', 'CP');
INSERT INTO `plan` VALUES ('3', 'MAP');

-- ----------------------------
-- Table structure for reservacion
-- ----------------------------
DROP TABLE IF EXISTS `reservacion`;
CREATE TABLE `reservacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(255) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `agencia` int(255) NOT NULL,
  `estado` int(255) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  `conjunto` int(255) DEFAULT NULL,
  `codigo` varchar(255) DEFAULT NULL,
  `plan` int(11) NOT NULL,
  `canthab` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `agencia` (`agencia`),
  KEY `plan` (`plan`),
  CONSTRAINT `agencia` FOREIGN KEY (`agencia`) REFERENCES `agencia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `plan` FOREIGN KEY (`plan`) REFERENCES `plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=685 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of reservacion
-- ----------------------------
INSERT INTO `reservacion` VALUES ('683', 'KENIA', '2019-09-01', '2019-09-03', '67', '0', 'DESAYUNO INCLUIDO', '0', '19521', '1', '1');
INSERT INTO `reservacion` VALUES ('684', ' ROONY SUAREZ', '2019-09-07', '2019-09-09', '46', '2', 'SDASDSA', '0', ' 19521', '1', '1');

-- ----------------------------
-- Table structure for reservaciones_denegadas
-- ----------------------------
DROP TABLE IF EXISTS `reservaciones_denegadas`;
CREATE TABLE `reservaciones_denegadas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(255) NOT NULL,
  `fecha_solicitud` date NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `simple` int(11) DEFAULT NULL,
  `doble` int(11) DEFAULT NULL,
  `twins` int(11) DEFAULT NULL,
  `triple` int(11) DEFAULT NULL,
  `agencia` int(11) NOT NULL,
  `obs` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `age` (`agencia`),
  CONSTRAINT `age` FOREIGN KEY (`agencia`) REFERENCES `agencia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of reservaciones_denegadas
-- ----------------------------

-- ----------------------------
-- Table structure for reservacion_hab
-- ----------------------------
DROP TABLE IF EXISTS `reservacion_hab`;
CREATE TABLE `reservacion_hab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservacion` int(255) DEFAULT NULL,
  `hab` int(255) DEFAULT NULL,
  `precio` double(255,2) NOT NULL,
  `ocupacion` int(255) DEFAULT NULL,
  `fecha_entrada` date DEFAULT NULL,
  `fecha_salida` date DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  `agencia` int(255) NOT NULL,
  `plan` int(255) NOT NULL,
  `conjunto` int(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reservacionhab` (`reservacion`),
  KEY `habhab` (`hab`),
  KEY `ocupacionhab` (`ocupacion`),
  KEY `res_agencia` (`agencia`),
  KEY `res_plan` (`plan`),
  CONSTRAINT `habhab` FOREIGN KEY (`hab`) REFERENCES `habitacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ocupacionhab` FOREIGN KEY (`ocupacion`) REFERENCES `ocupacion_hab` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reservacionhab` FOREIGN KEY (`reservacion`) REFERENCES `reservacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `res_agencia` FOREIGN KEY (`agencia`) REFERENCES `agencia` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `res_plan` FOREIGN KEY (`plan`) REFERENCES `plan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of reservacion_hab
-- ----------------------------
INSERT INTO `reservacion_hab` VALUES ('9', '683', '10', '120.00', '64', '2019-09-01', '2019-09-03', '0', '67', '1', '0');
INSERT INTO `reservacion_hab` VALUES ('10', '684', '12', '25.00', '65', '2019-09-07', '2019-09-09', '0', '46', '1', '0');

-- ----------------------------
-- Table structure for reservacion_servicios
-- ----------------------------
DROP TABLE IF EXISTS `reservacion_servicios`;
CREATE TABLE `reservacion_servicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reservacion` int(255) NOT NULL,
  `servicio` int(255) NOT NULL,
  `cant` int(255) NOT NULL,
  `precio` double(255,2) NOT NULL,
  `fecha` date DEFAULT NULL,
  `hab` int(255) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `re` (`reservacion`),
  KEY `ser` (`servicio`),
  KEY `ha` (`hab`),
  CONSTRAINT `ha` FOREIGN KEY (`hab`) REFERENCES `habitacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `re` FOREIGN KEY (`reservacion`) REFERENCES `reservacion` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ser` FOREIGN KEY (`servicio`) REFERENCES `subservicios` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6613 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of reservacion_servicios
-- ----------------------------

-- ----------------------------
-- Table structure for servicio
-- ----------------------------
DROP TABLE IF EXISTS `servicio`;
CREATE TABLE `servicio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `ingles` varchar(255) DEFAULT NULL,
  `frances` varchar(255) DEFAULT NULL,
  `prioridad` int(11) NOT NULL,
  `estado` int(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of servicio
-- ----------------------------
INSERT INTO `servicio` VALUES ('1', 'ALMUERZOS', 'LUNCHES', 'DÉJEUNER', '4', '0');
INSERT INTO `servicio` VALUES ('2', 'CENAS', 'DINNERS', 'DÎNER', '6', '0');
INSERT INTO `servicio` VALUES ('3', 'BEBIDAS', 'DRINKS', 'BOISSON', '7', '0');
INSERT INTO `servicio` VALUES ('4', 'EXCURSIONES', 'EXCURSIONS', 'EXCURSION', '8', '0');
INSERT INTO `servicio` VALUES ('5', 'OPCIONALES', 'OPTIONALS', 'OPTIONNEL', '10', '0');
INSERT INTO `servicio` VALUES ('6', 'ENTRANTES', 'STARTER', 'ENTREÉ', '3', '0');
INSERT INTO `servicio` VALUES ('7', 'LAVANDERIA', 'LAUNDRY', 'BLANCHISSERIE', '11', '0');
INSERT INTO `servicio` VALUES ('8', 'DESCUENTOS', 'DISCOUNTS', 'RÉDUCTIONS', '13', '0');
INSERT INTO `servicio` VALUES ('9', 'ALOJAMIENTO', 'LODGING', 'LOGEMENT', '1', '0');
INSERT INTO `servicio` VALUES ('10', 'DESAYUNO', 'BREAKFAST', 'PETIT DÉJEUNER', '2', '0');
INSERT INTO `servicio` VALUES ('11', 'EXTRAS', 'EXTRAS', 'EXTRAS', '12', '0');
INSERT INTO `servicio` VALUES ('12', 'ronny', 'rtrt', 'retr', '14', '1');

-- ----------------------------
-- Table structure for subservicios
-- ----------------------------
DROP TABLE IF EXISTS `subservicios`;
CREATE TABLE `subservicios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `servicio` int(255) NOT NULL,
  `nombre` varchar(255) NOT NULL,
  `ingles` varchar(255) DEFAULT NULL,
  `frances` varchar(255) DEFAULT NULL,
  `precio` double(255,2) NOT NULL,
  `fecha` date DEFAULT NULL,
  `estado` int(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `servicio` (`servicio`),
  CONSTRAINT `servicio` FOREIGN KEY (`servicio`) REFERENCES `servicio` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=196 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of subservicios
-- ----------------------------
INSERT INTO `subservicios` VALUES ('1', '5', 'Taxi', 'Taxi', 'Taxi', '0.00', '1717-12-08', '0');
INSERT INTO `subservicios` VALUES ('2', '5', 'Renta de Bicicleta', 'Bicycle Rental', 'Location de Vélo', '8.00', '1717-12-08', '0');
INSERT INTO `subservicios` VALUES ('3', '5', 'Masaje', 'Massage', 'Massage', '30.00', '1717-12-08', '0');
INSERT INTO `subservicios` VALUES ('4', '5', 'Clases de Salsa', 'Dancing Lessons', 'Leçon de Danse', '10.00', '1717-12-08', '0');
INSERT INTO `subservicios` VALUES ('5', '1', 'ENSALADA  DE  FRUTAS', 'FRUIT  SALAD', 'SALADE DE FRUIT', '4.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('6', '1', 'ENSALADA   DE  VEGETALES  DE  LA  CASA', 'VEGETABLE  SALAD  OF  THE  HOUSE', 'SALADE VÉGÉTALE DE LA MAISON', '6.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('7', '1', 'ENSALADA  DE  VEGETALES  CON  QUESO  AZUL ', 'VEGETABLE  SALAD   WITH  BLUE  CHEESE', 'SALADE DE LÉGUMES AU FROMAGE BLEU', '7.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('8', '1', 'ENSALADA  DE  VEGETALES  CON  ATÚN', 'VEGETABLE  SALAD  WITH  TUNA', 'SALADE DE LEGUMES AU THON', '7.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('9', '1', 'ENSALADA  DE  VEGETALES  CON  MIXTA  DE  QUESO', 'VEGETABLE  SALAD  WITH  MIXED  OF  CHEESE', 'SALADE DE LEGUMES AVEC MELANGE DE FROMAGE', '10.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('10', '1', 'SANDWICH  CON    JAMON  Y  QUESO', 'SANDWICH  WITH   HAM  AND  CHEESE', 'SANDWICH AU JAMBON ET FROMAGE', '5.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('11', '1', 'COCTEL  DE  CAMARONES', 'SHRIMPS   IN  TOMATO  SAUCE', 'CREVETTES EN SAUCE TOMATE', '7.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('12', '1', 'CREPES  RELLENAS ', 'FILLED  CREPES ', 'CREPES GARNIES ', '8.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('13', '1', 'POLLO A LA PLANCHA', 'GRILLED CHICKEN', 'Poulet grillé', '9.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('14', '1', 'PESCADO A LA PLANCHA', 'GRILLED FISH', 'Poisson grillé', '10.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('15', '1', 'CAMARONES  A  LA  PLANCHA', 'GRILLED  SHRIMPS', 'CREVETTES GRILLÉES', '12.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('16', '1', 'HELADO', 'ICE  CREAM', 'Crème glacée', '2.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('17', '1', 'Papas fritas', 'Potato chips', 'Papes frites', '2.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('18', '1', 'Sopa', 'Soup', 'Soupe', '2.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('19', '1', 'Arroz con frijoles', 'Rice and beans', 'Riz et haricots', '3.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('20', '1', 'PLATOS VEGETARIANOS ', 'VEGETARIAN DISHES ', 'PLATS VÉGÉTARIENS', '12.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('21', '1', 'CERDO A LA PLANCHA', 'GRILLED PORK ', 'PORC GRILLEÉ', '19.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('23', '1', 'MASA DE CANGREJO ', 'CRAB  STEW', 'CRABE STEW', '20.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('24', '1', 'CORDERO', 'LAMB', 'Agneau', '22.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('25', '1', 'LANGOSTA ', 'LOBSTER', 'Langouste', '25.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('26', '1', 'RES', 'BEEF', 'BOEUF', '25.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('27', '1', 'MARISCADA', 'MIXED SEAFOOD ', 'FRUITS DE MER MIXTES', '26.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('28', '6', 'CRUDO  DE  PESCADO ', 'MARINATED   FRESH  FISH  ', 'RAW DE POISSON ', '6.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('29', '6', 'JAMON  SERRANO  CON  ACEITUNAS', 'SERRANO   HAM   WITH  OLIVES', 'JAMBON SERRANO AUX OLIVES', '8.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('30', '6', 'GAZPACHO  ANDALUZ ', 'GAZPACHO  ANDALUZ ', 'GAZPACHO  ANDALUZ ', '8.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('31', '6', 'CEVICHE  DE  CAMARONES', 'SHRIMP  CEVICHE', 'Céviche de crevettes', '9.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('32', '6', 'SALMON  AHUMADO  ', 'SMOKED  SALMON  ', 'SAUMON FUMÉ ', '9.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('33', '6', 'SURTIDO  DE  QUESO', 'ASSORTMENT   OF  CHEESE  ', 'Assortiment de fromages', '10.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('34', '6', 'CARPACCIO  DE  RES', 'BEEF  CARPACCIO', 'CARPACCIO DE BŒUF', '10.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('35', '6', 'SALAMI - TUNA', 'SALAMI - TUNA', 'SALAMI - TUNA', '4.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('36', '6', 'CHORIZO ESPAÑOL ', 'CHORIZO ESPAÑOL ', 'CHORIZO ESPAÑOL ', '4.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('37', '2', 'POLLO ', 'CHICKEN', 'POULET', '18.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('38', '2', 'CERDO', 'PORK', 'PORC', '19.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('39', '2', 'PESCADO ', 'FISH', 'Poisson', '20.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('40', '2', 'CAMARONES', 'SHRIMPS', 'Crevettes', '20.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('41', '2', 'POLLO ENTERO ', 'WHOLE CHICKEN', 'POULET ENTIER ', '40.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('42', '2', 'CERDO ENTERO ASADO ', 'WHOLE PIG ', 'COCHON ENTIER ', '40.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('43', '3', 'AGUA NATURAL  500 ml', 'NATURAL WATER 500 ml', 'EAU NATUREL 500 ml', '1.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('44', '3', 'AGUA NATURAL  1500 ml', 'NATURAL WATER 1500 ml', 'EAU NATUREL 1500 ml', '2.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('45', '3', 'AGUA GASEADA  ', 'SPARKLING WATER ', 'EAU PÉTILLANTE', '1.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('46', '3', 'JUGO  NATURAL', 'NATURAL  JUICE', 'JUS NATUREL', '2.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('47', '3', 'REFRESCO', 'SOFTDRINK', 'Rafraîchissement', '1.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('48', '3', 'CAFÉ ', 'COFFEE', 'CAFÉ ', '1.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('49', '3', 'TE', 'TEA', 'THÉ', '1.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('51', '3', 'Cerveza Nacional', 'National  Beer', 'BIÈRE Nationale', '2.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('52', '3', 'Cerveza Importada', 'Imported Beer', 'BIÈRE Importeé', '3.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('53', '3', 'HAVANA  CLUB  “AÑEJO  BLANCO”', 'HAVANA  CLUB  “AÑEJO  BLANCO”', 'HAVANA  CLUB  “AÑEJO  BLANCO”', '1.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('54', '3', 'HAVANA  CLUB  “AÑEJO  3  AÑOS”', 'HAVANA  CLUB  “AÑEJO  3  AÑOS”', 'HAVANA  CLUB  “AÑEJO  3  AÑOS”', '2.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('55', '3', 'HAVANA  CLUB  “AÑEJO  ESPECIAL”', 'HAVANA  CLUB  “AÑEJO  ESPECIAL”', 'HAVANA  CLUB  “AÑEJO  ESPECIAL”', '2.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('56', '3', 'HAVANA  CLUB  “AÑEJO  RESERVA”', 'HAVANA  CLUB  “AÑEJO  RESERVA”', 'HAVANA  CLUB  “AÑEJO  RESERVA”', '3.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('57', '3', 'HAVANA  CLUB  “AÑEJO  7  AÑOS”', 'HAVANA  CLUB  “AÑEJO  7  AÑOS”', 'HAVANA  CLUB  “AÑEJO  7  AÑOS”', '3.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('58', '3', 'SANTIAGO  DE  CUBA  ', 'SANTIAGO  DE  CUBA  ', 'SANTIAGO  DE  CUBA  ', '2.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('59', '3', 'SANTERO  (AGUARDIENTE)', 'SANTERO  (AGUARDIENTE)', 'SANTERO  (AGUARDIENTE)', '1.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('60', '3', 'MOJITO', 'MOJITO', 'MOJITO', '3.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('61', '3', 'CUBA  LIBRE', 'CUBA  LIBRE', 'CUBA  LIBRE', '3.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('62', '3', 'CANCHANCHARA', 'CANCHANCHARA', 'CANCHANCHARA', '3.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('63', '3', 'TRINIDAD  COLONIAL', 'TRINIDAD  COLONIAL', 'TRINIDAD  COLONIAL', '3.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('64', '3', 'DAIQUIRI', 'DAIQUIRI', 'DAIQUIRI', '3.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('65', '3', 'RON  COLLINS', 'RON  COLLINS', 'RON  COLLINS', '3.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('66', '3', 'PIÑA  COLADA', 'PIÑA  COLADA', 'PIÑA  COLADA', '3.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('67', '3', 'SCREW - DRIVER', 'SCREW - DRIVER', 'SCREW - DRIVER', '3.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('68', '3', 'CAIPIRÍSIMA', 'CAIPIRÍSIMA', 'CAIPIRÍSIMA', '3.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('69', '3', 'CAIPIRIÑA', 'CAIPIRIÑA', 'CAIPIRIÑA', '3.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('70', '3', 'CUBANITO', 'CUBANITO', 'CUBANITO', '3.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('71', '3', 'GIN  –  TONIC', 'GIN  –  TONIC', 'GIN  –  TONIC', '3.50', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('72', '3', 'CHISPA', 'CHISPA', 'CHISPA', '5.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('73', '4', 'VALLE DE LOS INGENIOS', 'SUGAR MILLS VALLEY TOUR', 'TOUR DE LA VALLEE DES MOULES À SUCRE', '40.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('74', '4', 'TRINITOPES', 'TRINITOPES', 'TRINITOPES', '90.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('75', '4', 'PARQUE NATURAL “EL CUBANO”', '“EL CUBANO” NATURAL PARK ', 'PARC NATUREL \"EL CUBANO\"', '70.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('76', '4', 'JEEP SAFARI GUANAYARA', 'JEEP SAFARI GUANAYARA', 'JEEP SAFARI GUANAYARA', '55.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('77', '4', 'EXCURSION A “EL  NICHO”', '“EL NICHO”  TOUR', 'TOUR AU “EL NICHO”  ', '150.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('78', '4', 'CAMINANDO TRINIDAD', 'WALKING TRINIDAD', 'TRINIDAD DE MARCHE', '20.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('79', '4', 'EXCURSION A CABALLO', 'HORSEBACK RIDING ', 'TOUR À CHEVAL', '40.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('80', '4', 'PASEO EN COCHE COLONIAL ', 'HORSE-DRAWN CARRIAGE TOUR', 'TOUR DANS UNE VOITURE À CHEVAL', '25.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('81', '4', 'BUCEO', 'SCUBA DIVING', 'PLONGÉE', '25.00', '1717-12-11', '0');
INSERT INTO `subservicios` VALUES ('83', '2', 'BROCHETAS', 'SKEWERS', 'BROCHETTES', '20.00', '1717-12-19', '0');
INSERT INTO `subservicios` VALUES ('86', '2', 'LANGOSTA', 'LOBSTER', 'Langouste', '25.00', '1717-12-19', '0');
INSERT INTO `subservicios` VALUES ('87', '2', 'PLATOS VEGETARIANOS', 'VEGETARIAN DISHES', 'PLATS VÉGÉTARIENS', '12.00', '1717-12-19', '0');
INSERT INTO `subservicios` VALUES ('88', '2', 'MASA DE CANGREJO', 'CRAB  STEW', 'CRABE STEW', '20.00', '1717-12-19', '0');
INSERT INTO `subservicios` VALUES ('89', '2', 'CORDERO', 'LAMB', 'Agneau', '22.00', '1717-12-19', '0');
INSERT INTO `subservicios` VALUES ('90', '2', 'RES', 'BEEF', 'BOEUF', '25.00', '1717-12-19', '0');
INSERT INTO `subservicios` VALUES ('91', '2', 'MARISCADA', 'MIXED SEAFOOD', 'FRUITS DE MER MIXTES', '26.00', '1717-12-19', '0');
INSERT INTO `subservicios` VALUES ('93', '1', 'SURTIDO  DE  QUESO', 'ASSORTMENT   OF  CHEESE', 'Assortiment de fromages', '10.00', '1717-12-26', '0');
INSERT INTO `subservicios` VALUES ('94', '3', 'LIMONADA', 'LEMONADE', 'CITRONNADE', '2.00', '1717-12-26', '0');
INSERT INTO `subservicios` VALUES ('95', '3', 'COCTEL', 'COCKTAIL', 'COCKTAIL', '3.50', '1717-12-26', '0');
INSERT INTO `subservicios` VALUES ('96', '2', 'PAVO', 'TURKEY', 'DINDON', '20.00', '1717-12-26', '0');
INSERT INTO `subservicios` VALUES ('97', '2', 'ENSALADA   DE  VEGETALES  DE  LA  CASA', 'NATURAL SALAD ', 'SALADE VÉGÉTALE DE LA MAISON', '6.50', '1717-12-26', '0');
INSERT INTO `subservicios` VALUES ('98', '2', 'PULPO', 'OCTOPUS', 'POULPE', '20.00', '1717-12-26', '0');
INSERT INTO `subservicios` VALUES ('99', '3', 'Copa de vino \"Estacion\"', 'Wineglass \"Estacion\"', 'Coupe de vin \"Estacion\"', '8.00', '1717-12-31', '0');
INSERT INTO `subservicios` VALUES ('100', '3', 'Copa de vino \"Frontera\"', 'Wineglass \"Frontera\"', 'Coupe de vin \"Frontera\"', '6.50', '1717-12-31', '0');
INSERT INTO `subservicios` VALUES ('101', '3', 'Copa de vino \"Viña Maipo\"', 'Wineglass \"Viña Maipo\"', 'Coupe de vin \"Viña Maipo\"', '5.50', '1717-12-31', '0');
INSERT INTO `subservicios` VALUES ('102', '3', 'Copa de vino \"Sunrise\"', 'Wineglass \"Sunrise\"', 'Coupe de vin \"Sunrise\"', '8.00', '1717-12-31', '0');
INSERT INTO `subservicios` VALUES ('103', '3', 'Copa de vino \"Santa Digna\"', 'Wineglass \"Santa Digna\"', 'Coupe de vin \"Santa Digna\"', '10.00', '1717-12-31', '0');
INSERT INTO `subservicios` VALUES ('104', '3', 'Copa de vino \"Legitimo\"', 'Wineglass \"Legitimo\"', 'Coupe de vin \"Legitimo\"', '4.00', '1717-12-31', '0');
INSERT INTO `subservicios` VALUES ('105', '3', 'Copa de vino \"Gato Negro\"', 'Wineglass \"Gato Negro\"', 'Coupe de vin \"Gato Negro\"', '7.00', '1717-12-31', '0');
INSERT INTO `subservicios` VALUES ('107', '3', 'Vino Tinto \"FRONTERA\"', '\"FRONTERA\" Red Wine', 'Vin Rouge \"FRONTERA\"', '18.00', '1818-01-04', '0');
INSERT INTO `subservicios` VALUES ('108', '3', 'Vino Tinto \"ESTACIÓN\"', '\"ESTACIÓN\" Red Wine', 'Vin Rouge \"ESTACIÓN\"', '22.00', '1818-01-04', '0');
INSERT INTO `subservicios` VALUES ('109', '3', 'Vino Tinto \"SUNRISE\"', '\"SUNRISE\" Red Wine', 'Vin Rouge \"SUNRISE\"', '22.00', '1818-01-04', '0');
INSERT INTO `subservicios` VALUES ('110', '3', 'Vino Tinto \"SANTA  DIGNA\"', '\"SANTA  DIGNA\" Red Wine', 'Vin Rouge \"SANTA  DIGNA\"', '24.00', '1818-01-04', '0');
INSERT INTO `subservicios` VALUES ('111', '3', 'Vino Blanco \"FRONTERA\"', '\"FRONTERA\" White Wine', 'Vin Blanc \"FRONTERA\"', '18.00', '1818-01-04', '0');
INSERT INTO `subservicios` VALUES ('112', '3', 'Vino Blanco \"GATO NEGRO\"', '\"GATO NEGRO\" White Wine', 'Vin Blanc \"GATO NEGRO\"', '20.00', '1818-01-04', '0');
INSERT INTO `subservicios` VALUES ('113', '3', 'Vino Blanco \"SUNRISE\"', '\"SUNRISE\" White Wine', 'Vin Blanc \"SUNRISE\"', '22.00', '1818-01-04', '0');
INSERT INTO `subservicios` VALUES ('114', '3', 'Vino Blanco \"ESTACIÓN\"', '\"ESTACIÓN\" White Wine', 'Vin Blanc \"ESTACIÓN\"', '22.00', '1818-01-04', '0');
INSERT INTO `subservicios` VALUES ('115', '7', 'Ropa interior', 'Underwear', 'Sous-vêtements', '0.50', '1818-01-09', '0');
INSERT INTO `subservicios` VALUES ('116', '7', 'Ropa exterior', 'Outerwear', 'Vêtements d\'extérieur', '1.00', '1818-01-09', '0');
INSERT INTO `subservicios` VALUES ('117', '8', 'Pagado', 'Paid out', 'Payé', '0.00', '1818-01-09', '0');
INSERT INTO `subservicios` VALUES ('118', '8', 'Promoción', 'Promotion', 'Promotion', '0.00', '1818-01-09', '0');
INSERT INTO `subservicios` VALUES ('119', '8', 'Depósito', 'Deposit', 'Dépôt', '0.00', '1818-01-09', '0');
INSERT INTO `subservicios` VALUES ('120', '2', 'Sopa', 'Soup', 'Soupe', '3.50', '1818-01-09', '0');
INSERT INTO `subservicios` VALUES ('121', '2', 'Arroz blanco', ' White rice', 'Riz blanc', '1.50', '1818-01-09', '0');
INSERT INTO `subservicios` VALUES ('122', '2', 'Frijoles', 'Beans', 'Haricots', '2.50', '1818-01-09', '0');
INSERT INTO `subservicios` VALUES ('123', '2', 'Spaghettis con camarones', 'Spaghettis with shrimps', 'Spaghetti aux crevettes', '16.00', '1818-01-13', '0');
INSERT INTO `subservicios` VALUES ('125', '2', 'Spaghettis', 'Spaghettis', 'Spaghettis', '12.00', '1818-01-13', '0');
INSERT INTO `subservicios` VALUES ('126', '5', 'Tarjeta de Internet', 'Internet Card', 'Carte d´internet', '2.00', '1818-01-13', '0');
INSERT INTO `subservicios` VALUES ('127', '2', 'Cena con menu completo', 'Cena con menu completo', 'Cena con menu completo', '25.00', '1818-01-14', '0');
INSERT INTO `subservicios` VALUES ('128', '2', 'Cena con menu reducido', 'Cena con menu reducido', 'Cena con menu reducido', '20.00', '1818-01-14', '0');
INSERT INTO `subservicios` VALUES ('129', '1', 'Spaghettis', 'Spaghettis', 'Spaghettis', '12.00', '1818-01-14', '0');
INSERT INTO `subservicios` VALUES ('130', '1', 'Spaghettis con camarones', 'Spaghettis with shrimps', 'Spaghetti aux crevettes', '16.00', '1818-01-14', '0');
INSERT INTO `subservicios` VALUES ('131', '1', 'Spaghettis con jamón y queso', 'Spaghettis with ham & cheese', 'Spaghetti aux jambon et fromage', '12.00', '1818-01-14', '0');
INSERT INTO `subservicios` VALUES ('132', '2', 'Spaghettis con jamón y queso', 'Spaghettis with ham & cheese', 'Spaghetti aux jambon et fromage', '12.00', '1818-01-14', '0');
INSERT INTO `subservicios` VALUES ('133', '9', 'HAB 1', 'ROOM 1', 'CHAMBRE 1', '100.00', '1818-01-18', '0');
INSERT INTO `subservicios` VALUES ('134', '9', 'HAB 2', 'ROOM 2', 'CHAMBRE 2', '100.00', '1818-01-18', '0');
INSERT INTO `subservicios` VALUES ('135', '9', 'HAB 3', 'ROOM 3', 'CHAMBRE 3', '100.00', '1818-01-18', '0');
INSERT INTO `subservicios` VALUES ('136', '9', 'HAB 4', 'ROOM 4', 'CHAMBRE 4', '100.00', '1818-01-18', '0');
INSERT INTO `subservicios` VALUES ('137', '9', 'HAB 5', 'ROOM 5', 'CHAMBRE 5', '100.00', '1818-01-18', '0');
INSERT INTO `subservicios` VALUES ('138', '9', 'HAB 6', 'ROOM 6', 'CHAMBRE 6', '100.00', '1818-01-18', '0');
INSERT INTO `subservicios` VALUES ('139', '9', 'HAB 7', 'ROOM 7', 'CHAMBRE 7', '300.00', '1818-01-18', '0');
INSERT INTO `subservicios` VALUES ('140', '9', 'HAB 8', 'ROOM 8', 'CHAMBRE 8', '150.00', '1818-01-18', '0');
INSERT INTO `subservicios` VALUES ('141', '3', 'Agua tonica', 'Tonic water', 'Eau tonique', '1.00', '1818-01-19', '0');
INSERT INTO `subservicios` VALUES ('142', '3', 'Vino Tinto \"VIÑA MAIPO\"', '\"VIÑA MAIPO\" Red Wine', 'Vin Rouge \"VIÑA MAIPO\"', '16.00', '1818-01-19', '0');
INSERT INTO `subservicios` VALUES ('143', '1', 'SALAMI - TUNA', 'SALAMI - TUNA', 'SALAMI - TUNA', '4.50', '1818-01-20', '0');
INSERT INTO `subservicios` VALUES ('144', '1', 'CHORIZO ESPAÑOL', 'CHORIZO ESPAÑOL', 'CHORIZO ESPAÑOL', '4.50', '1818-01-20', '0');
INSERT INTO `subservicios` VALUES ('145', '1', 'CRUDO  DE  PESCADO', 'MARINATED   FRESH  FISH', 'RAW DE POISSON', '6.00', '1818-01-20', '0');
INSERT INTO `subservicios` VALUES ('146', '1', 'JAMON  SERRANO  CON  ACEITUNAS', 'SERRANO   HAM   WITH  OLIVES', 'JAMBON SERRANO AUX OLIVES', '8.00', '1818-01-20', '0');
INSERT INTO `subservicios` VALUES ('147', '1', 'GAZPACHO  ANDALUZ', 'GAZPACHO  ANDALUZ', 'GAZPACHO  ANDALUZ', '8.00', '1818-01-20', '0');
INSERT INTO `subservicios` VALUES ('148', '1', 'CEVICHE  DE  CAMARONES', 'SHRIMP  CEVICHE', 'Céviche de crevettes', '9.00', '1818-01-20', '0');
INSERT INTO `subservicios` VALUES ('149', '1', 'SALMON  AHUMADO', 'SMOKED  SALMON', 'SAUMON FUMÉ', '9.00', '1818-01-20', '0');
INSERT INTO `subservicios` VALUES ('150', '1', 'SURTIDO  DE  QUESO', 'ASSORTMENT   OF  CHEESE', 'Assortiment de fromages', '10.00', '1818-01-20', '0');
INSERT INTO `subservicios` VALUES ('151', '1', 'CARPACCIO  DE  RES', 'BEEF  CARPACCIO', 'CARPACCIO DE BŒUF', '10.50', '1818-01-20', '0');
INSERT INTO `subservicios` VALUES ('152', '3', 'Sangría', 'Sangria', 'Sangria', '3.50', '1818-01-21', '0');
INSERT INTO `subservicios` VALUES ('153', '6', 'Crema de queso', 'Cheese cream', 'Fromage à la crème', '4.50', '1818-01-26', '0');
INSERT INTO `subservicios` VALUES ('154', '1', 'Crema de queso', 'Cheese cream', 'Fromage à la crème', '4.50', '1818-01-26', '0');
INSERT INTO `subservicios` VALUES ('155', '8', 'Cliente amigo', 'Guest-friend', 'Client ami', '0.00', '1818-01-26', '0');
INSERT INTO `subservicios` VALUES ('156', '8', 'Alojamiento', 'Lodging', 'Hébergement', '0.00', '1818-01-26', '0');
INSERT INTO `subservicios` VALUES ('157', '3', 'MEDIA BOTELLA DE VINO', 'Half a bottle of wine', 'Une demi-bouteille de vin', '8.00', '1818-01-28', '0');
INSERT INTO `subservicios` VALUES ('158', '3', 'Vino Blanco \"VIÑA MAIPO\"', '\"VIÑA MAIPO\" White Wine', 'Vin Blanc \"VIÑA MAIPO\"', '16.00', '1818-02-07', '0');
INSERT INTO `subservicios` VALUES ('159', '3', 'Cava \"Freixenet\"', 'Sparkling Wine \"Freixenet\"', 'Cava \"Freixenet\"', '28.00', '1818-03-14', '0');
INSERT INTO `subservicios` VALUES ('160', '2', 'SANDWICH  CON    JAMON  Y  QUESO', 'SANDWICH  WITH   HAM  AND  CHEESE', 'SANDWICH AU JAMBON ET FROMAGE', '5.00', '1818-03-14', '0');
INSERT INTO `subservicios` VALUES ('161', '2', 'Ensalada de frutas', 'Fruit salad', 'Salade de fruits', '4.00', '1818-03-27', '0');
INSERT INTO `subservicios` VALUES ('162', '5', 'Tabaco', 'Cigar', 'Cigare', '7.00', '1818-04-07', '0');
INSERT INTO `subservicios` VALUES ('163', '2', 'Helado', 'Ice Cream', 'Crème Glacée', '2.50', '1818-04-18', '0');
INSERT INTO `subservicios` VALUES ('164', '3', 'Vino Tinto \"GATO NEGRO\"', '\"GATO NEGRO\" Red Wine', 'Vin Rouge \"GATO NEGRO\"', '22.00', '1818-05-05', '0');
INSERT INTO `subservicios` VALUES ('165', '3', 'Whisky', 'Whisky', 'Whisky', '3.50', '1818-05-09', '0');
INSERT INTO `subservicios` VALUES ('166', '2', 'Crepes Rellenas', 'Filled Crepes', 'Crêpes Garnies', '8.50', '1818-05-10', '0');
INSERT INTO `subservicios` VALUES ('167', '7', 'Planchado', 'Ironing clothes', 'Repassage', '0.50', '1818-05-13', '0');
INSERT INTO `subservicios` VALUES ('168', '1', 'Almuerzo Ligero', 'Light Lunch', 'Déjeuner Léger', '7.00', '1818-05-17', '0');
INSERT INTO `subservicios` VALUES ('169', '5', 'Servicio Guia Local', 'Local Guide Service', 'Service de Guide Local', '0.00', '1818-05-17', '0');
INSERT INTO `subservicios` VALUES ('170', '4', 'Monta de Guia Local', 'Horse Riding from Local Guide', 'Équitation du Guide local', '15.00', '1818-05-17', '0');
INSERT INTO `subservicios` VALUES ('171', '1', 'Camaron al Ajillo', 'Garlic Shrimp', 'Camaron à l\'ail', '12.00', '1818-05-19', '0');
INSERT INTO `subservicios` VALUES ('172', '1', 'TORTILLA', 'OMELET', 'OMELETTE', '3.50', '1818-06-14', '0');
INSERT INTO `subservicios` VALUES ('173', '2', 'Tortilla', 'Omelet', 'Omelette', '3.50', '1818-06-19', '0');
INSERT INTO `subservicios` VALUES ('174', '1', 'Sandwich de Atún', 'Tuna Sandwich', 'Sandwich au Thon', '5.00', '1818-07-24', '0');
INSERT INTO `subservicios` VALUES ('175', '2', 'Ensalada de Vegetales con Atún', 'Vegetable Salad with Tuna', 'Salade de Légumes au Thon', '7.50', '1818-08-02', '0');
INSERT INTO `subservicios` VALUES ('176', '2', 'Ensalada de Vegetales con Queso Azul', 'Vegetable Salad with Blue Cheese', 'Salade de Légumes au Fromage Bleu', '7.50', '1818-08-02', '0');
INSERT INTO `subservicios` VALUES ('177', '2', 'Ensalada de Vegetales con Mixta de Queso', 'Vegetable Salad with Mixed Cheese', ' 40/5000 Salade de légumes au fromage mélangé', '10.00', '1818-08-02', '0');
INSERT INTO `subservicios` VALUES ('178', '2', 'Papas fritas', 'French fries', 'Frites', '2.50', '1818-08-08', '0');
INSERT INTO `subservicios` VALUES ('179', '10', 'Extra No Incluido', 'Extra Non-Included', 'Extra Non Compris', '6.00', '1818-08-24', '0');
INSERT INTO `subservicios` VALUES ('180', '3', 'VODKA', 'VODKA', 'VODKA', '2.50', '1818-08-27', '0');
INSERT INTO `subservicios` VALUES ('181', '7', 'Par de zapatos', 'Pair of shoes', 'Paire de chaussures', '2.00', '1818-10-12', '0');
INSERT INTO `subservicios` VALUES ('182', '1', 'CREPES SIMPLES', 'SIMPLE CREPES', 'CREPES SIMPLES', '5.00', '1818-10-18', '0');
INSERT INTO `subservicios` VALUES ('183', '4', 'Picnic de Playa', 'Beach Picnic', 'Pique-nique à la plage', '0.00', '1818-10-28', '0');
INSERT INTO `subservicios` VALUES ('184', '5', 'Niñera', 'Baby-sitter', 'Baby-sitter', '0.00', '1818-11-11', '0');
INSERT INTO `subservicios` VALUES ('185', '11', 'Consumo en monta a caballo', 'Consumed in horseback riding', 'Consommé dans le tour à cheval', '0.00', '1818-11-21', '0');
INSERT INTO `subservicios` VALUES ('186', '1', 'Estofado cangrejo ', 'Crab Stew', 'Crabe en Salade', '12.00', '1818-11-25', '0');
INSERT INTO `subservicios` VALUES ('187', '4', 'Excursion a caballo + almuerzo', 'Horse-back riding + lunch', 'Excursion à cheval + déjeuner', '55.00', '1818-12-29', '0');
INSERT INTO `subservicios` VALUES ('188', '4', 'Excursion a caballo + almuerzo + guia local', 'Horse-back riding + lunch + local guide', 'Excursion à cheval + déjeuner + guide local', '0.00', '1818-12-29', '0');
INSERT INTO `subservicios` VALUES ('189', '4', 'Paseo en coche colonial + guia local', 'Horse-drawn carriage tour + local guide', 'Tour dans une voiture á cheval + guide local', '0.00', '1818-12-29', '0');
INSERT INTO `subservicios` VALUES ('190', '5', 'Acceso a Internet', 'Internet Access', 'Accès Internet', '5.00', '1919-01-02', '0');
INSERT INTO `subservicios` VALUES ('194', '9', 'RONNY', 'RONN', 'RONN', '5.00', '1919-09-02', '1');
INSERT INTO `subservicios` VALUES ('195', '9', 'afdsf', 'dsfdsf', 'sdfdsf', '5.00', '1919-09-02', '1');

-- ----------------------------
-- Table structure for trabajador
-- ----------------------------
DROP TABLE IF EXISTS `trabajador`;
CREATE TABLE `trabajador` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  `dpto` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `dpto` (`dpto`) USING BTREE,
  CONSTRAINT `trabajador_ibfk_1` FOREIGN KEY (`dpto`) REFERENCES `dpto` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of trabajador
-- ----------------------------
INSERT INTO `trabajador` VALUES ('1', 'RABUJA', '2');
INSERT INTO `trabajador` VALUES ('2', 'YAMILKA', '1');

-- ----------------------------
-- Table structure for trab_funciones
-- ----------------------------
DROP TABLE IF EXISTS `trab_funciones`;
CREATE TABLE `trab_funciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trab` int(11) NOT NULL,
  `func` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL,
  `precio` double(255,2) NOT NULL,
  `estado` int(11) NOT NULL,
  `fecha` date DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trab` (`trab`) USING BTREE,
  KEY `func` (`func`) USING BTREE,
  CONSTRAINT `trab_funciones_ibfk_1` FOREIGN KEY (`func`) REFERENCES `funciones` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trab_funciones_ibfk_2` FOREIGN KEY (`trab`) REFERENCES `trabajador` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of trab_funciones
-- ----------------------------
INSERT INTO `trab_funciones` VALUES ('4', '1', '30', '3', '1.00', '1', '2019-04-25');
INSERT INTO `trab_funciones` VALUES ('5', '1', '54', '1', '1.00', '1', '2019-04-25');
INSERT INTO `trab_funciones` VALUES ('7', '2', '63', '2', '1.00', '1', '2019-04-24');
INSERT INTO `trab_funciones` VALUES ('9', '2', '11', '1', '2.00', '1', '2019-04-24');
INSERT INTO `trab_funciones` VALUES ('11', '2', '11', '1', '2.00', '1', '2019-04-25');
INSERT INTO `trab_funciones` VALUES ('12', '2', '11', '1', '2.00', '1', '2019-04-26');
INSERT INTO `trab_funciones` VALUES ('13', '2', '11', '1', '2.00', '1', '2019-04-27');
INSERT INTO `trab_funciones` VALUES ('14', '2', '63', '2', '1.00', '1', '2019-04-27');
INSERT INTO `trab_funciones` VALUES ('15', '1', '30', '4', '0.50', '1', '2019-04-26');
INSERT INTO `trab_funciones` VALUES ('16', '1', '30', '4', '0.50', '1', '2019-04-27');
INSERT INTO `trab_funciones` VALUES ('17', '2', '64', '12', '0.20', '1', '2019-04-27');
INSERT INTO `trab_funciones` VALUES ('18', '2', '65', '9', '0.12', '1', '2019-04-27');
INSERT INTO `trab_funciones` VALUES ('19', '2', '11', '1', '2.00', '1', '2019-05-02');
INSERT INTO `trab_funciones` VALUES ('20', '2', '11', '1', '2.00', '1', '2019-05-03');
INSERT INTO `trab_funciones` VALUES ('21', '2', '11', '1', '2.00', '1', '2019-05-04');
INSERT INTO `trab_funciones` VALUES ('22', '2', '11', '2', '2.00', '1', '2019-05-01');
INSERT INTO `trab_funciones` VALUES ('23', '2', '11', '1', '2.00', '1', '2019-05-07');
INSERT INTO `trab_funciones` VALUES ('24', '2', '11', '1', '2.00', '1', '2019-05-09');
INSERT INTO `trab_funciones` VALUES ('25', '2', '64', '6', '0.20', '1', '2019-05-09');
INSERT INTO `trab_funciones` VALUES ('26', '2', '65', '8', '0.15', '1', '2019-05-09');
INSERT INTO `trab_funciones` VALUES ('27', '2', '11', '1', '2.00', '1', '2019-05-11');
INSERT INTO `trab_funciones` VALUES ('28', '2', '11', '1', '2.00', '1', '2019-05-06');
INSERT INTO `trab_funciones` VALUES ('29', '2', '11', '1', '2.00', '1', '2019-05-08');
INSERT INTO `trab_funciones` VALUES ('30', '2', '11', '2', '2.00', '1', '2019-05-10');
INSERT INTO `trab_funciones` VALUES ('31', '2', '11', '1', '2.00', '1', '2019-05-11');
INSERT INTO `trab_funciones` VALUES ('32', '2', '11', '1', '2.00', '1', '2019-05-13');
INSERT INTO `trab_funciones` VALUES ('33', '2', '11', '1', '2.00', '1', '2019-05-14');
INSERT INTO `trab_funciones` VALUES ('34', '2', '64', '6', '0.20', '1', '2019-05-14');
INSERT INTO `trab_funciones` VALUES ('36', '2', '65', '1', '0.15', '1', '2019-05-14');
INSERT INTO `trab_funciones` VALUES ('37', '2', '63', '1', '1.00', '1', '2019-05-14');
INSERT INTO `trab_funciones` VALUES ('38', '2', '63', '1', '1.00', '1', '2019-05-15');
INSERT INTO `trab_funciones` VALUES ('39', '2', '11', '1', '2.00', '1', '2019-05-15');
INSERT INTO `trab_funciones` VALUES ('40', '2', '64', '14', '0.20', '1', '2019-05-15');
INSERT INTO `trab_funciones` VALUES ('41', '2', '65', '7', '0.15', '1', '2019-05-15');
INSERT INTO `trab_funciones` VALUES ('42', '2', '11', '1', '2.00', '1', '2019-05-17');
INSERT INTO `trab_funciones` VALUES ('43', '2', '11', '1', '2.00', '1', '2019-05-18');
INSERT INTO `trab_funciones` VALUES ('45', '2', '64', '6', '0.20', '1', '2019-05-18');
INSERT INTO `trab_funciones` VALUES ('46', '2', '65', '1', '0.15', '1', '2019-05-18');
INSERT INTO `trab_funciones` VALUES ('47', '2', '63', '1', '1.00', '1', '2019-05-21');
INSERT INTO `trab_funciones` VALUES ('48', '2', '11', '1', '2.00', '1', '2019-05-21');
INSERT INTO `trab_funciones` VALUES ('49', '2', '64', '8', '0.20', '1', '2019-05-21');
INSERT INTO `trab_funciones` VALUES ('50', '2', '65', '4', '0.15', '1', '2019-05-21');
INSERT INTO `trab_funciones` VALUES ('52', '2', '63', '2', '1.00', '1', '2019-05-22');
INSERT INTO `trab_funciones` VALUES ('53', '2', '11', '1', '2.00', '1', '2019-05-22');
INSERT INTO `trab_funciones` VALUES ('55', '2', '64', '11', '0.20', '1', '2019-05-22');
INSERT INTO `trab_funciones` VALUES ('56', '2', '65', '6', '0.15', '1', '2019-05-22');
INSERT INTO `trab_funciones` VALUES ('58', '1', '30', '3', '0.50', '1', '2019-05-14');
INSERT INTO `trab_funciones` VALUES ('59', '1', '30', '2', '0.50', '1', '2019-05-15');
INSERT INTO `trab_funciones` VALUES ('60', '1', '30', '2', '0.50', '1', '2019-05-15');
INSERT INTO `trab_funciones` VALUES ('61', '1', '30', '2', '0.50', '1', '2019-05-16');
INSERT INTO `trab_funciones` VALUES ('62', '1', '30', '2', '0.50', '1', '2019-05-17');
INSERT INTO `trab_funciones` VALUES ('63', '1', '30', '2', '0.50', '1', '2019-05-18');
INSERT INTO `trab_funciones` VALUES ('64', '1', '30', '2', '0.50', '1', '2019-05-19');
INSERT INTO `trab_funciones` VALUES ('65', '1', '54', '1', '1.00', '1', '2019-05-15');
INSERT INTO `trab_funciones` VALUES ('66', '1', '30', '4', '0.50', '1', '2019-05-22');
INSERT INTO `trab_funciones` VALUES ('67', '2', '11', '1', '2.00', '1', '2019-05-24');
INSERT INTO `trab_funciones` VALUES ('68', '2', '11', '1', '2.00', '1', '2019-06-10');
INSERT INTO `trab_funciones` VALUES ('70', '2', '11', '5', '2.00', '1', '2019-06-23');
INSERT INTO `trab_funciones` VALUES ('71', '2', '64', '2', '0.20', '1', '2019-06-23');
INSERT INTO `trab_funciones` VALUES ('74', '1', '30', '2', '0.50', '1', '2019-07-05');
INSERT INTO `trab_funciones` VALUES ('75', '2', '11', '1', '2.00', '1', '2019-07-01');
INSERT INTO `trab_funciones` VALUES ('76', '2', '11', '1', '2.00', '1', '2019-07-03');
INSERT INTO `trab_funciones` VALUES ('77', '2', '11', '1', '2.00', '1', '2019-07-04');
INSERT INTO `trab_funciones` VALUES ('78', '2', '11', '1', '2.00', '1', '2019-07-05');
INSERT INTO `trab_funciones` VALUES ('79', '2', '11', '5', '2.00', '1', '2019-06-24');
INSERT INTO `trab_funciones` VALUES ('80', '2', '64', '20', '0.20', '1', '2019-06-28');
INSERT INTO `trab_funciones` VALUES ('82', '2', '63', '1', '1.00', '1', '2019-06-26');
INSERT INTO `trab_funciones` VALUES ('83', '2', '65', '14', '0.15', '1', '2019-06-28');
INSERT INTO `trab_funciones` VALUES ('84', '2', '65', '4', '0.15', '1', '2019-07-05');
INSERT INTO `trab_funciones` VALUES ('85', '2', '64', '5', '0.20', '1', '2019-07-05');
INSERT INTO `trab_funciones` VALUES ('86', '2', '11', '1', '2.00', '1', '2019-07-06');
INSERT INTO `trab_funciones` VALUES ('87', '2', '65', '3', '0.15', '1', '2019-07-06');
INSERT INTO `trab_funciones` VALUES ('88', '2', '64', '5', '0.20', '1', '2019-07-06');
INSERT INTO `trab_funciones` VALUES ('89', '1', '30', '2', '0.50', '1', '2019-07-06');
INSERT INTO `trab_funciones` VALUES ('93', '1', '30', '2', '0.50', '1', '2019-07-07');
INSERT INTO `trab_funciones` VALUES ('94', '1', '30', '2', '0.50', '1', '2019-07-08');
INSERT INTO `trab_funciones` VALUES ('95', '1', '30', '4', '0.50', '1', '2019-05-22');
INSERT INTO `trab_funciones` VALUES ('96', '1', '30', '2', '0.50', '1', '2019-06-24');
INSERT INTO `trab_funciones` VALUES ('97', '1', '30', '2', '0.50', '1', '2019-06-25');
INSERT INTO `trab_funciones` VALUES ('98', '1', '30', '2', '0.50', '1', '2019-06-25');
INSERT INTO `trab_funciones` VALUES ('99', '1', '30', '2', '0.50', '1', '2019-06-26');
INSERT INTO `trab_funciones` VALUES ('100', '1', '30', '2', '0.50', '1', '2019-06-27');
INSERT INTO `trab_funciones` VALUES ('101', '1', '30', '2', '0.50', '1', '2019-07-09');
INSERT INTO `trab_funciones` VALUES ('102', '1', '30', '2', '0.50', '1', '2019-07-10');
INSERT INTO `trab_funciones` VALUES ('103', '2', '63', '1', '1.00', '1', '2019-07-10');
INSERT INTO `trab_funciones` VALUES ('104', '2', '11', '1', '2.00', '1', '2019-07-10');
INSERT INTO `trab_funciones` VALUES ('105', '2', '64', '4', '0.20', '1', '2019-07-10');
INSERT INTO `trab_funciones` VALUES ('106', '2', '65', '4', '0.15', '1', '2019-07-10');
INSERT INTO `trab_funciones` VALUES ('107', '2', '11', '1', '2.00', '1', '2019-07-11');
INSERT INTO `trab_funciones` VALUES ('108', '2', '11', '1', '2.00', '1', '2019-07-08');
INSERT INTO `trab_funciones` VALUES ('110', '2', '65', '4', '0.15', '1', '2019-07-08');
INSERT INTO `trab_funciones` VALUES ('111', '2', '64', '6', '0.20', '1', '2019-07-08');
INSERT INTO `trab_funciones` VALUES ('112', '2', '11', '1', '2.00', '1', '2019-07-09');
INSERT INTO `trab_funciones` VALUES ('113', '2', '65', '4', '0.15', '1', '2019-07-09');
INSERT INTO `trab_funciones` VALUES ('114', '2', '64', '4', '0.20', '1', '2019-07-09');
INSERT INTO `trab_funciones` VALUES ('115', '1', '30', '3', '0.50', '1', '2019-07-11');
INSERT INTO `trab_funciones` VALUES ('116', '1', '30', '3', '0.50', '1', '2019-07-12');
INSERT INTO `trab_funciones` VALUES ('117', '1', '30', '3', '0.50', '1', '2019-07-13');
INSERT INTO `trab_funciones` VALUES ('118', '2', '11', '1', '2.00', '1', '2019-07-13');
INSERT INTO `trab_funciones` VALUES ('119', '2', '64', '11', '0.20', '1', '2019-07-13');
INSERT INTO `trab_funciones` VALUES ('120', '2', '63', '1', '1.00', '1', '2019-07-13');
INSERT INTO `trab_funciones` VALUES ('121', '2', '65', '7', '0.15', '1', '2019-07-13');
INSERT INTO `trab_funciones` VALUES ('122', '2', '11', '1', '2.00', '1', '2019-07-15');
INSERT INTO `trab_funciones` VALUES ('123', '2', '64', '11', '0.20', '1', '2019-07-15');
INSERT INTO `trab_funciones` VALUES ('124', '2', '65', '4', '0.15', '1', '2019-07-15');
INSERT INTO `trab_funciones` VALUES ('125', '2', '63', '2', '1.00', '1', '2019-07-16');
INSERT INTO `trab_funciones` VALUES ('126', '2', '64', '12', '0.20', '1', '2019-07-16');
INSERT INTO `trab_funciones` VALUES ('127', '2', '65', '9', '0.15', '1', '2019-07-16');
INSERT INTO `trab_funciones` VALUES ('128', '2', '11', '1', '2.00', '1', '2019-07-16');
INSERT INTO `trab_funciones` VALUES ('129', '2', '11', '1', '2.00', '1', '2019-07-17');
INSERT INTO `trab_funciones` VALUES ('130', '2', '11', '1', '2.00', '1', '2019-07-18');
INSERT INTO `trab_funciones` VALUES ('131', '2', '64', '13', '0.20', '1', '2019-07-18');
INSERT INTO `trab_funciones` VALUES ('132', '2', '65', '6', '0.15', '1', '2019-07-18');
INSERT INTO `trab_funciones` VALUES ('133', '2', '63', '1', '1.00', '1', '2019-07-19');
INSERT INTO `trab_funciones` VALUES ('134', '2', '11', '1', '2.00', '1', '2019-07-20');
INSERT INTO `trab_funciones` VALUES ('135', '2', '64', '6', '0.20', '1', '2019-07-19');
INSERT INTO `trab_funciones` VALUES ('136', '2', '65', '5', '0.15', '1', '2019-07-19');
INSERT INTO `trab_funciones` VALUES ('137', '2', '63', '1', '1.00', '1', '2019-07-20');
INSERT INTO `trab_funciones` VALUES ('138', '2', '11', '1', '2.00', '1', '2019-07-20');
INSERT INTO `trab_funciones` VALUES ('139', '2', '64', '11', '0.20', '1', '2019-07-20');
INSERT INTO `trab_funciones` VALUES ('140', '2', '65', '8', '0.15', '1', '2019-07-20');
INSERT INTO `trab_funciones` VALUES ('141', '1', '30', '2', '0.50', '1', '2019-07-26');
INSERT INTO `trab_funciones` VALUES ('142', '1', '30', '4', '0.50', '1', '2019-07-26');
INSERT INTO `trab_funciones` VALUES ('145', '1', '30', '4', '0.50', '1', '2019-07-27');
INSERT INTO `trab_funciones` VALUES ('146', '1', '30', '4', '0.50', '1', '2019-07-28');
INSERT INTO `trab_funciones` VALUES ('147', '2', '11', '1', '2.00', '1', '2019-07-22');
INSERT INTO `trab_funciones` VALUES ('149', '2', '11', '1', '2.00', '1', '2019-07-23');
INSERT INTO `trab_funciones` VALUES ('150', '2', '11', '1', '2.00', '1', '2019-07-24');
INSERT INTO `trab_funciones` VALUES ('151', '2', '11', '1', '2.00', '1', '2019-07-25');
INSERT INTO `trab_funciones` VALUES ('152', '2', '11', '1', '2.00', '1', '2019-07-26');
INSERT INTO `trab_funciones` VALUES ('154', '2', '63', '1', '1.00', '1', '2019-07-27');
INSERT INTO `trab_funciones` VALUES ('155', '2', '11', '1', '2.00', '1', '2019-07-26');
INSERT INTO `trab_funciones` VALUES ('156', '2', '64', '9', '0.20', '1', '2019-07-27');
INSERT INTO `trab_funciones` VALUES ('157', '2', '65', '6', '0.15', '1', '2019-07-27');
INSERT INTO `trab_funciones` VALUES ('158', '2', '63', '1', '1.00', '1', '2019-07-29');
INSERT INTO `trab_funciones` VALUES ('159', '2', '11', '1', '2.00', '1', '2019-07-29');
INSERT INTO `trab_funciones` VALUES ('160', '2', '64', '11', '0.20', '1', '2019-07-29');
INSERT INTO `trab_funciones` VALUES ('161', '2', '65', '11', '0.15', '1', '2019-07-29');
INSERT INTO `trab_funciones` VALUES ('162', '2', '11', '1', '2.00', '1', '2019-07-30');
INSERT INTO `trab_funciones` VALUES ('163', '2', '11', '1', '2.00', '1', '2019-07-31');
INSERT INTO `trab_funciones` VALUES ('164', '2', '63', '1', '1.00', '1', '2019-08-01');
INSERT INTO `trab_funciones` VALUES ('165', '2', '11', '1', '2.00', '1', '2019-08-01');
INSERT INTO `trab_funciones` VALUES ('166', '2', '64', '5', '0.20', '1', '2019-08-01');
INSERT INTO `trab_funciones` VALUES ('167', '2', '65', '5', '0.15', '1', '2019-08-01');
INSERT INTO `trab_funciones` VALUES ('168', '2', '64', '9', '0.20', '1', '2019-08-02');
INSERT INTO `trab_funciones` VALUES ('169', '2', '65', '8', '0.15', '1', '2019-08-02');
INSERT INTO `trab_funciones` VALUES ('170', '2', '63', '1', '1.00', '1', '2019-08-02');
INSERT INTO `trab_funciones` VALUES ('171', '2', '11', '1', '2.00', '1', '2019-08-02');
INSERT INTO `trab_funciones` VALUES ('172', '1', '30', '4', '0.50', '1', '2019-07-14');
INSERT INTO `trab_funciones` VALUES ('173', '1', '30', '4', '0.50', '1', '2019-07-15');
INSERT INTO `trab_funciones` VALUES ('174', '1', '30', '4', '0.50', '1', '2019-07-16');
INSERT INTO `trab_funciones` VALUES ('175', '1', '30', '4', '0.50', '1', '2019-07-17');
INSERT INTO `trab_funciones` VALUES ('176', '1', '30', '6', '0.50', '1', '2019-07-18');
INSERT INTO `trab_funciones` VALUES ('177', '1', '30', '4', '0.50', '1', '2019-07-19');
INSERT INTO `trab_funciones` VALUES ('178', '1', '30', '4', '0.50', '1', '2019-07-20');
INSERT INTO `trab_funciones` VALUES ('179', '1', '30', '7', '0.50', '1', '2019-07-31');
INSERT INTO `trab_funciones` VALUES ('180', '1', '30', '7', '0.50', '1', '2019-08-01');
INSERT INTO `trab_funciones` VALUES ('181', '1', '30', '2', '0.50', '1', '2019-08-02');
INSERT INTO `trab_funciones` VALUES ('182', '1', '30', '2', '0.50', '1', '2019-08-03');
INSERT INTO `trab_funciones` VALUES ('183', '1', '30', '2', '0.50', '1', '2019-08-04');
INSERT INTO `trab_funciones` VALUES ('184', '1', '30', '2', '0.50', '1', '2019-08-05');
INSERT INTO `trab_funciones` VALUES ('185', '1', '30', '7', '0.50', '1', '2019-08-06');
INSERT INTO `trab_funciones` VALUES ('186', '1', '30', '7', '0.50', '1', '2019-08-07');
INSERT INTO `trab_funciones` VALUES ('187', '1', '30', '2', '0.50', '1', '2019-08-08');
INSERT INTO `trab_funciones` VALUES ('189', '2', '63', '1', '1.00', '1', '2019-08-04');
INSERT INTO `trab_funciones` VALUES ('190', '2', '11', '1', '2.00', '1', '2019-08-04');
INSERT INTO `trab_funciones` VALUES ('191', '2', '64', '4', '0.20', '1', '2019-08-04');
INSERT INTO `trab_funciones` VALUES ('192', '2', '65', '4', '0.15', '1', '2019-08-04');
INSERT INTO `trab_funciones` VALUES ('193', '2', '11', '1', '2.00', '1', '2019-08-05');
INSERT INTO `trab_funciones` VALUES ('194', '2', '64', '3', '0.20', '1', '2019-08-05');
INSERT INTO `trab_funciones` VALUES ('195', '2', '65', '1', '0.15', '1', '2019-08-05');
INSERT INTO `trab_funciones` VALUES ('196', '2', '65', '1', '0.15', '1', '2019-08-05');
INSERT INTO `trab_funciones` VALUES ('197', '2', '11', '1', '2.00', '1', '2019-08-06');
INSERT INTO `trab_funciones` VALUES ('198', '2', '63', '1', '1.00', '1', '2019-08-06');
INSERT INTO `trab_funciones` VALUES ('200', '2', '64', '2', '0.20', '1', '2019-08-06');
INSERT INTO `trab_funciones` VALUES ('201', '2', '63', '2', '1.00', '1', '2019-08-07');
INSERT INTO `trab_funciones` VALUES ('202', '2', '11', '1', '2.00', '1', '2019-08-07');
INSERT INTO `trab_funciones` VALUES ('203', '1', '30', '5', '0.50', '1', '2019-08-09');
INSERT INTO `trab_funciones` VALUES ('204', '1', '30', '5', '0.50', '1', '2019-08-10');
INSERT INTO `trab_funciones` VALUES ('205', '1', '30', '3', '0.50', '1', '2019-08-11');
INSERT INTO `trab_funciones` VALUES ('206', '2', '64', '14', '0.20', '1', '2019-08-07');
INSERT INTO `trab_funciones` VALUES ('207', '2', '65', '9', '0.15', '1', '2019-08-07');
INSERT INTO `trab_funciones` VALUES ('208', '2', '11', '1', '2.00', '1', '2019-08-08');
INSERT INTO `trab_funciones` VALUES ('209', '2', '64', '4', '0.20', '1', '2019-08-08');
INSERT INTO `trab_funciones` VALUES ('211', '2', '65', '4', '0.15', '1', '2019-08-08');
INSERT INTO `trab_funciones` VALUES ('212', '2', '11', '1', '2.00', '1', '2019-08-09');
INSERT INTO `trab_funciones` VALUES ('213', '2', '11', '1', '2.00', '1', '2019-08-10');
INSERT INTO `trab_funciones` VALUES ('214', '2', '63', '1', '1.00', '1', '2019-08-10');
INSERT INTO `trab_funciones` VALUES ('215', '2', '65', '5', '0.15', '1', '2019-08-10');
INSERT INTO `trab_funciones` VALUES ('216', '2', '64', '8', '0.20', '1', '2019-08-10');
INSERT INTO `trab_funciones` VALUES ('217', '2', '11', '1', '2.00', '1', '2019-08-11');
INSERT INTO `trab_funciones` VALUES ('218', '2', '63', '1', '1.00', '1', '2019-08-11');
INSERT INTO `trab_funciones` VALUES ('219', '2', '64', '6', '0.20', '1', '2019-08-11');
INSERT INTO `trab_funciones` VALUES ('220', '2', '65', '7', '0.15', '1', '2019-08-11');
INSERT INTO `trab_funciones` VALUES ('221', '2', '11', '1', '2.00', '1', '2019-08-12');
INSERT INTO `trab_funciones` VALUES ('222', '2', '11', '1', '2.00', '1', '2019-08-13');
INSERT INTO `trab_funciones` VALUES ('223', '2', '63', '2', '1.00', '1', '2019-08-14');
INSERT INTO `trab_funciones` VALUES ('224', '2', '11', '1', '2.00', '1', '2019-08-14');
INSERT INTO `trab_funciones` VALUES ('225', '2', '64', '15', '0.20', '1', '2019-08-14');
INSERT INTO `trab_funciones` VALUES ('226', '2', '65', '10', '0.15', '1', '2019-08-14');
INSERT INTO `trab_funciones` VALUES ('227', '2', '11', '1', '2.00', '1', '2019-08-15');
INSERT INTO `trab_funciones` VALUES ('230', '2', '64', '3', '0.20', '1', '2019-08-15');
INSERT INTO `trab_funciones` VALUES ('231', '2', '65', '2', '0.15', '1', '2019-08-15');
INSERT INTO `trab_funciones` VALUES ('232', '2', '11', '1', '2.00', '1', '2019-08-16');
INSERT INTO `trab_funciones` VALUES ('233', '2', '11', '1', '2.00', '1', '2019-08-17');
INSERT INTO `trab_funciones` VALUES ('234', '2', '64', '2', '0.20', '1', '2019-08-17');
INSERT INTO `trab_funciones` VALUES ('235', '2', '65', '1', '0.15', '1', '2019-08-17');
INSERT INTO `trab_funciones` VALUES ('236', '2', '63', '1', '1.00', '1', '2019-08-17');
INSERT INTO `trab_funciones` VALUES ('238', '1', '30', '5', '0.50', '1', '2019-08-12');
INSERT INTO `trab_funciones` VALUES ('239', '1', '30', '5', '0.50', '1', '2019-08-13');
INSERT INTO `trab_funciones` VALUES ('240', '1', '30', '5', '0.50', '1', '2019-08-14');
INSERT INTO `trab_funciones` VALUES ('246', '1', '30', '4', '0.50', '1', '2019-08-15');
INSERT INTO `trab_funciones` VALUES ('247', '1', '30', '4', '0.50', '1', '2019-08-16');
INSERT INTO `trab_funciones` VALUES ('248', '1', '30', '4', '0.50', '1', '2019-08-17');
INSERT INTO `trab_funciones` VALUES ('249', '1', '30', '2', '0.50', '1', '2019-08-24');
INSERT INTO `trab_funciones` VALUES ('250', '1', '30', '2', '0.50', '1', '2019-08-26');
INSERT INTO `trab_funciones` VALUES ('251', '1', '30', '2', '0.50', '1', '2019-08-27');
INSERT INTO `trab_funciones` VALUES ('252', '1', '30', '4', '0.50', '1', '2019-08-28');

-- ----------------------------
-- Table structure for unidad
-- ----------------------------
DROP TABLE IF EXISTS `unidad`;
CREATE TABLE `unidad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of unidad
-- ----------------------------
INSERT INTO `unidad` VALUES ('1', 'LIBRA');
INSERT INTO `unidad` VALUES ('2', 'KG');
INSERT INTO `unidad` VALUES ('3', 'LITRO');
INSERT INTO `unidad` VALUES ('4', 'PAQUETE');
INSERT INTO `unidad` VALUES ('5', 'CARTONES');
INSERT INTO `unidad` VALUES ('6', 'BOLSA');
INSERT INTO `unidad` VALUES ('7', 'POMO 4L');
INSERT INTO `unidad` VALUES ('8', 'POMO 5L');
INSERT INTO `unidad` VALUES ('9', 'UNIDADES');
INSERT INTO `unidad` VALUES ('10', 'BOTELLA 1L');
INSERT INTO `unidad` VALUES ('11', 'BOTELLA 750ML');
INSERT INTO `unidad` VALUES ('12', 'BOTELLA 500ML');
INSERT INTO `unidad` VALUES ('13', 'BOTELLA 1500ML');
INSERT INTO `unidad` VALUES ('14', 'ONZA');
INSERT INTO `unidad` VALUES ('15', 'SACO');
INSERT INTO `unidad` VALUES ('16', 'MASO');
INSERT INTO `unidad` VALUES ('17', 'RISTRA');
INSERT INTO `unidad` VALUES ('18', 'PATA');
INSERT INTO `unidad` VALUES ('19', 'CAJA');
INSERT INTO `unidad` VALUES ('20', 'BOTELLA 330ML');
INSERT INTO `unidad` VALUES ('21', 'LATA');
INSERT INTO `unidad` VALUES ('22', 'TUBO');
INSERT INTO `unidad` VALUES ('23', 'POTE');
INSERT INTO `unidad` VALUES ('24', 'CUBETA');
INSERT INTO `unidad` VALUES ('25', 'TINA');
INSERT INTO `unidad` VALUES ('26', 'BOTELLA');
INSERT INTO `unidad` VALUES ('27', 'POMO');
INSERT INTO `unidad` VALUES ('28', 'Barra');
INSERT INTO `unidad` VALUES ('29', 'KW POR HORA');
INSERT INTO `unidad` VALUES ('30', 'Pago');
INSERT INTO `unidad` VALUES ('33', 'METROS');
INSERT INTO `unidad` VALUES ('35', 'Manos');
INSERT INTO `unidad` VALUES ('36', 'RACIONES');
INSERT INTO `unidad` VALUES ('38', 'RASIMO');

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `nombre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `apellidos` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE,
  UNIQUE KEY `password_reset_token` (`password_reset_token`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'rsrosildo', 'T14pM_NhkO1zbCULZ7qNvU07sKq1qy0t', '$2y$13$wm8WmGr8/g2a5JD9Ir0sYOx1e1DtmdUzrdXXC3A2GzSZhUjSGHOgm', null, 'ronny@ronny.com', '10', '1453237121', '1453237121', 'Ronny', 'Suarez');
INSERT INTO `user` VALUES ('17', 'roxana', 'QdAMfKWxcjIVDjVA0AHCIeFYtc0FC3HH', '$2y$13$4UI7PNoSjvkjm4ghek1g/O3LsCCuvzwXkIMZ.PAZd0mB/umyPrEC.', null, 'rsrosildo@s5181.cu', '10', '1527701391', '1527701391', 'Roxana', ' Peres Hola');
INSERT INTO `user` VALUES ('18', 'casona', 'v76vsvfsGB4uMvZYvEXAMy5QIMObilrH', '$2y$13$b/eh1OHCvPmAFlJ0l7Ol9ORTfMxRLjH24CqolbMCbhn6q0pq8b5ji', null, 'casona@gmail.com', '10', '1527864962', '1527864962', 'ANDRES', 'PEREZ GARCIA');
