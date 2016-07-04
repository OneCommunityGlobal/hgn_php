SET FOREIGN_KEY_CHECKS = 0; TRUNCATE system_modules; ALTER TABLE system_modules AUTO_INCREMENT = 1; INSERT INTO system_modules VALUES

("1","project","Project Module","Project","project_model","project","projects","id","tasks","projectId"),
("2","community","Community Module","Community","community_model","community","communities","id","",""),
("3","user","User Module","User","user_model","user","users","id","",""),
("4","user_preference","User Preference Module","Preference","user_model","user_preference","user_preferences","id","",""),
("5","system_lookup","System Lookup Module","Lookup","system_model","system_lookup","system_lookups","id","system_lookup_values","systemLookupId"),
("6","system_table","System Table Module ","Table","database_model","system_table","system_tables","id","system_table_columns","systemTableId"),
("7","system_setting","System Settings Module","Setting","system_model","system_setting","system_settings","id",""," ")
("8","team","Team Module","Team","team_model","team","teams","id",""," ")