# coronadenktank.be

## Overview

een snel itererende website rond de resources voor de bestrijding van Corona

## Install

* Clone repository
* Update the .env values
* Run command `composer install`
  * Some plugin downloads are protected.
    * Username (= API-key) : Zie Slack channel
    * Password : satispress 

## Development workflow
### Deployment
- On push to the staging branch, a deployment is triggered to our staging environment
- Updated files are pulled by git on Plesk 
