使用的是tp5.1框架，运行需要mysql+apache+php环境
下载后即可通过相应url访问
采用多控制器模式，
但对于本项目来说，代码都在Index控制器下；
首页访问路径：
index/user/login.html
sql数据如下：
----------
SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`  (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  `password` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_estonian_ci NULL DEFAULT NULL,
  `create_time` int(11) NULL DEFAULT NULL,
  `update_time` int(11) NULL DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = MyISAM AUTO_INCREMENT = 21 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES (5, 'root', 'root', '123@qq.com', 123, NULL, NULL);
INSERT INTO `user` VALUES (6, 'admin', 'admin', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (7, 'root1', 'root', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (8, 'root', 'root', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (9, 'xiaochi', 'txh2002', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (10, 'root', 'rootu', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (11, 'rootg', 'root', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (12, 'root', 'rooteeee', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (13, 'root', 'root99', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (14, 'root', 'rootsdsds', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (15, 'rootgfgfo', 'root', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (16, 'root1', 'txh2002424', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (17, 'US_A', 'txh2002424', NULL, NULL, NULL, NULL);
INSERT INTO `user` VALUES (20, 'zhangsan', NULL, NULL, NULL, NULL, '星期五');

SET FOREIGN_KEY_CHECKS = 1;

----------
