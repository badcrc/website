# Our Community Website

## Technology stack:

- PHP with some components
- Vue2 and webpack
- Zurb Foundation 3

## Setup

### Install php dependencies

    composer install
    
### Install js dependencies

    npm install

### Assets build

    ./node_modules/webpack/bin/webpack.js --config config/webpack.config.js 
    
**You can minimize your assets with the --optimize-minimize option**
    
    ./node_modules/webpack/bin/webpack.js --config config/webpack.config.js --optimize-minimize
    
### Set write permissions to the cache directory

    chmod -R 777 var/cache
    
    
## Configuration files

All files are written in YAML format:

**Background image**

  /data/heros.yml
  
**Medium, Meetup and social links**

  /data/integrations.yml
  
**Sponsors**

  /data/sponsors.yml
