-------------------------------------------------------------------
ModBak
MODX Module for 0.9.x
Backup modx file(s) and compress to .zip archive for easy download.
e: robinstemp@gmail.com
-------------------------------------------------------------------

**  ----------------------------------------
**  Uses PCLZIP Library for zip compression
**  Courtesy of http://www.phpconcept.net 
**  ----------------------------------------


Install:
---------
1. Create a directory on your webserver to hold modx .zip archives (ie /home/username/_backup ) and set read/write permissions to 777
2. Unzip modbak directory under /assets/modules/ directory. --> /assets/modules/modbak
3. Edit /assets/modules/modbak/settings.php, and set $modx_backup_dir to backup dir in new directory created in (1)
4. Create a new Module in MODx manager and copy contents of modBak.module.tpl into module code.
5. Now run module, click generate, if it works there should be a .zip link containing your modx site.


Notes:
-------
6-Mar-07 0.94 - Moved variable data to settings.php, used for download.php to
                gather paths.
              - Changed modBak.module.tpl in readme.txt
	      - Fixed sitenames with period . in name
                
4-Mar-07 0.9	Added table_prefix variable, restructured some code
                - db, and filename are set to sitename
13-Feb-06 0.7    Updated SQL dump to include all tables, however log data is not inserted
11-Feb-06 0.5    Added database sql dump, optionally include log tables(however increases sql somewhat)
11-Feb-06 0.4    Seems to work ok, need some testing.
