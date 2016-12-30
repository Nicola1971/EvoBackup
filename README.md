# EvoBackup 1.2 beta 4.1
Backup Evo files and compress into .zip for easy download

Based on modbak by stempy
https://modx.com/extras/package/modbak

# What's New in EvoBackup

* Added checkbox options to choose which folder and files add to archive
* 3 preselected templates of Backup: Light, Medium, Full
* You can add up to 5 custom folder or files to backup (ie: assets/galleries)
* Moved most hardcoded parameters to the module configuration
* Updated code to work with Evo 1+
* Mysql to Mysqli
* Removed header.php
* MODxRE2 styles
* Font Awesome
* Complete restyle for Evo 1.2.1
* Evolution installer for Package Manager and Extras module
* Help
* various mods

![evobackup](https://github.com/Nicola1971/training-materials/blob/master/Images/backupb4.1.png)

# Setup
1. Create directory named "_evobackup_archives"  on your root webserver to hold modx .zip archives, and set read/write permissions to 777
2. Install EvoBackup with Package Manager or Extras module
3. Run EvoBackup module
4. Select additional folders and files to include in the archive
5. Click Backup, if it works there should be a .zip link containing your modx site.

## Change Backup directory
1. Edit /assets/modules/modbak/settings.php, and set $modx_backup_dir to backup dir in new directory
2. Set Module configuration > **Backup Directory** to your new backup dir

# troubleshooting
#### 1) module does not complete backup, stops with a temp file of 50M

**Solution**
Remove some folders from backup or increase "ZIP memory limit" value in module configuration page

# to do

* **change backup folder path**: avoid edit hardcoded path in settings.php
* multi language
* option to add custom assets folders - ie: assets/galleries (done in beta 4.1)
* support for custom/renamed manager folder
