# EvoBackup 1.2
Backup Evo files and compress into .zip for easy download

# EvoBackup Features

* Checkbox options to choose which folder and files add to archive
* 3 preselected templates of Backup: Light, Medium, Full
* You can add up to 5 custom folder or files to backup (ie: assets/galleries)
* Manage Backups from AutoEvoBackups and MODX Snapshots/Backups (default evo backup sql folder)
* Extract Backup Archives
* Restore .sql backups
* Multilanguage
* Help
* Support for custom/renamed manager folder
* Evolution installer for Package Manager and Extras module

## Credits
* Based on modbak by stempy https://modx.com/extras/package/modbak
* styles improvements and various fixes by  [@pmfx] (https://github.com/pmfx)

## Available Languages
* english
* italian
* nederlands by [@fourroses666] (https://github.com/fourroses666)
* spanish by [@risingisland] (https://github.com/risingisland)

video: https://youtu.be/UfpgFIBOxrg

for automatic backups check https://github.com/Nicola1971/AutoEvoBackup

![evobackup](https://github.com/Nicola1971/training-materials/blob/master/Images/evobackup-rc3-tab1.png)
![evobackup](https://github.com/Nicola1971/training-materials/blob/master/Images/evobackup-rc3-tab2.png)
![evobackup](https://github.com/Nicola1971/training-materials/blob/master/Images/evobackup-rc3-tab3.png)

# Setup
1. Create directory named "_evobackup_archives"  on your root webserver to hold modx .zip archives, and set read/write permissions to 777
2. Install EvoBackup with Package Manager or Extras module
3. Run EvoBackup module
4. Select additional folders and files to include in the archive
5. Click Backup, if it works there should be a .zip link containing your modx site.

## Change Backup directory (not required)
1. Edit /assets/modules/evobackup/settings.php, and set $modx_backup_dir to backup dir in new directory
2. Set Module configuration > **Backup Directory** to your new backup dir

# troubleshooting
#### 1) module does not complete backup, stops with a temp file

**Solution**
Remove some folders from backup or increase "ZIP memory limit" value in module configuration page

# to do

* **change backup folder path**: avoid edit hardcoded path in settings.php

