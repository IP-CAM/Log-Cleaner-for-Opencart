# OpenCart Log Cleaner

![Screenshot](img/log_cleaner_large.png?raw=true "OpenCart Log Cleaner")

This extension **cleans OpenCart logs** if they are larger than the configured size.  
**OpenCart 3 & 4 supported.**

- Install the extension via the provided log_cleaner.ocmod.zip or log_cleaner_simple.ocmod.zip
- Refresh the modifications (needed for OpenCart 3 both variant, and OpenCart 4 Simple variant)
- Enable the extension and change the settings if you need (needed for Normal variant)

### Normal variant:
This version is a module. You have to enable it after installing. There you can set the maximum file size and clean chance.  
Upon page load, if the cleaning condition is met (clean chance), it will check storage/logs folder for every .log & .txt file if they are larger than the maximum file size, and it will truncate it.

### Simple variant: 
This version consists of only one modification file.  
The Log class's constructor has been modified so that when it is called on a given file (for example error.log), it always checks if the file is larger than the specified maximum file size. Default maximum file size for this version is 50mb. If you want to change it, you can do so in the config.php (both catalog and admin), just insert `define('MAX_LOG_SIZE', 50); // In MB`.

**Note:** OCMOD for current version of  Opencart 4 is broken, please use the Normal variant for OpenCart 4 for now.

[**Opencart Marketplace Link**](https://www.opencart.com/index.php?route=marketplace/extension/info&extension_id=47250)
