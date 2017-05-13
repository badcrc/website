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

**Onboard projects** (projects crafted in #comite days)

  /config/data_onboard_projects.yml

**Background image**

  /config/data_heros.yml
  
**Medium, Meetup**

  /config/data_integrations.yml
  
**Social links**

  /config/data_social_links.yml
  
**Sponsors**

  /config/data_sponsors.yml
