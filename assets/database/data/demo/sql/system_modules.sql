SET FOREIGN_KEY_CHECKS = 0; TRUNCATE system_modules; ALTER TABLE system_modules AUTO_INCREMENT = 1; INSERT INTO system_modules VALUES

("1","project","Project Module","project_model","project","projects","id","tasks","projectId"),
("2","community","Community Module","community_model","community","communities","id","",""),
("3","user","User Module","user_model","user","users","id","",""),
("4","user_preference","User Preference Module","user_model","user_preference","user_preferences","id","",""),
("5","system_lookup","System Lookup Module","system_model","system_lookup","system_lookups","id","system_lookup_values","systemLookupId"),
("6","system_table","System Table Module ","database_model","system_table","system_tables","id","system_table_columns","systemTableId"),
("7","system_setting","System Settings Module","system_model","system_setting","system_settings","id","","")
