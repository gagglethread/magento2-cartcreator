# Magento2 Cart Link Creator

### Features
- Admin product add to cart functionality through product mass action
    - Simple product add to cart
    - Configurable product add to cart
- Cart link generation functionality

### Upcoming Features
- Add/Update/Delete generated links
- Send Link on specific email


### Mannual Installation process

  - Create Directory name 'Gaggle' in app/code directory
  - Paste Copy Package in Gaggle directory
  - Make sure file structure app/code/Gaggle/Cartcreator
  - Open Terminal And run below commands
  
        php bin/magento setup:upgrade
        php bin/magento static:content-deploy
        php bin/magento cache:flush

