# EvoBackup
Backup Evo files and compress into .zip for easy download

Based on modbak by stempy
https://modx.com/extras/package/modbak

# What's New in EvoBackup

* Added checkbox options to choose which folder and files add to archive
* Moved most hardcoded parameters to the module configuration
* Updated to work with Evo 1+
* Mysql to Mysqli
* Removed header.php
* MODxRE2 styles
* Font Awesome
* Complete restyle for Evo 1.2.1
* Evolution installer for Package Manager and Extras module
* various mods

![evobackup](https://github.com/Nicola1971/training-materials/blob/master/Images/evobackup-beta3.png)

# Setup
1. Create a  "backup" directory on your root webserver to hold modx .zip archives, and set read/write permissions to 777
2. Install EvoBackup with Package Manager or Extras module
3. Run EvoBackup module
4. Select additional folders and files to include in the archive
5. Click Backup, if it works there should be a .zip link containing your modx site.

## Change Backup directory
1. Edit /assets/modules/modbak/settings.php, and set $modx_backup_dir to backup dir in new directory
2. Set Module configuration > **Backup Directory** to your new backup dir


# to do

* **change backup folder path**: avoid edit hardcoded path in settings.php
* multi language
* option to add custom assets folders - ie: assets/galleries
* support for custom/renamed manager folder
