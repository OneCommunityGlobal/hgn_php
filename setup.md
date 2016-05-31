@Version: this is a preliminary version of this document.

This file describes how to setup your development environment.  The workflow for pulling files from the Github repository, modifying files and pushing them back to the repository is described in the file "docs/github workflow".

@TODO Describe setup in fuller detail

- If you want to be able to contribute to this project (ie be able to "Push" back to the repo), create a github account for yourself (if you haven't already done so) and then let the admins know your github user name.  You will be able to "Pull" or "Clone" or download a zip version without doing this, so you only need to do this step if/when you want to contribute mods to the project.

- "Clone" or "Pull" (or download the ZIP version) of the repository from github.  The admin will have created a "user_name" branch for you if you want to contribute to the code, and you can pull and push from this branch.

- You will notice an ".htaccess" file at the top level of the project.  This project utilizes mod_rewrite which is an apache module and it is necessary that you configure mod_rewrite to be enabled in your http config file for the site to work properly on your local machine.

- create a mysql database called hgn and import the sql file: "\assets\database\backup\hgn.sql".  If you use a different database name, change the name in the "application\config\development\database.php" file.

- Modify the configuration file "application\config\development/constants" file as follows:
--  modify the BASE_URL and BASE_SURL to reflect how you named the website.
