
### Reqirements
# VirtualBox
# Vagrant


### Configuration 

Run the terminal open the hosts file.
```
sudo vim /etc/hosts
```
Then add the IP & Hostname to the file

192.168.102.102 plistatask.com

Then again run the terminal and after that

Run the vagrant up and vagrant provision
```
vagrant up
vagrant provision

```
### How to access to the Database
# To see the database and tables
```
vagrant ssh
sudo -i
mysql -u dbuser -p123
show databases;
use plista;
show tables;
```

### How to see  mysql queries 
## First go to root website
```
cd /var/www/plistatask/
```
## Then run following commands
# All campaigns of advertiser #1 that have more than 50 ads
```
php database/queries/getAdsOfAnAdvertiser.php arg1=1 arg2=50
```
# All campaigns that do not have any ads
php database/queries/getAllNullCampaigns.php

### Web Page Url
# This page shows some info about the device
http://plistatask.com/

### APIs 
## Advertiser
# Gets the advertiser by id
Url GET http://plistatask.com/api/advertisers/$id

# Saves the given data to the advertiser table
Url POST http://plistatask.com/api/advertisers
param:
```
{ "name" : "Dariush"}
```
# Updates the given data to the advertiser table
Url PUT http://plistatask.com/api/advertisers/$id
param:
```
{ "name" : "Dariush"}
```

# Gets advertiser list
Url GET http://plistatask.com/api/advertisers

# Delete advertiser by id
Url DELETE http://plistatask.com/api/advertisers/$id

# Gets advertisers and their campaigns
Url GET http://plistatask.com/api/advertisers/campaigns

# Gets an advertiser and its Ads
Url GET http://plistatask.com/api/advertisers/$id/ads

# Gets an advertiser and its Ads when a total number of Ads is more than the given number
Url GET http://plistatask.com/api/advertisers/$id/ads/$limit

## campaign
# Gets the campaign by id
Url GET http://plistatask.com/api/campaigns/$id

# Adds campaign
Url POST http://plistatask.com/api/campaigns 
param:
```
{ "name" : "test", "advertiser_id": 1}
```
# Edits campaign
Url PUT http://plistatask.com/campaigns/$id
param:
```
{ "name" : "test", "advertiser_id": 1}
```

# Gets campaign list
Url GET http://plistatask.com/campaigns

# Deletes campaign by id
Url DELETE http://plistatask.com/campaigns/$id

# Shows  banners belong to Campaigns
Url POST http://plistatask.com/campaign/banners

# Gets campaign by id and shows all its ads
Url GET http://plistatask.com/api/campaigns/$id/ads

# Gets campaigns which doen't have any ads
Url GET http://plistatask.com/api/campaigns/with/no/ads


## Ads
# Gets the ads by id
Url GET http://plistatask.com/api/ads/$id

# Adds ads
Url POST http://plistatask.com/api/ads
param:
```
{
	"title" : "Manoal added", 
    "text"  : "Manoal added" , 
    "image" : "https://lorempixel.com/640/480", 
    "sponsored_by" : "test", 
    "tracking_url" : "http://plistatask.com/ads", 
    "campaign_id" : "1"
}
```
# Edits ads
Url PUT http://plistatask.com/api/ads/$id
param:
```
{
	"title" : "Manoal added", 
    "text"  : "Manoal added" , 
    "image" : "https://lorempixel.com/640/480", 
    "sponsored_by" : "test", 
    "tracking_url" : "http://plistatask.com/ads", 
    "campaign_id" : "1"
}
```

# Gets banner list
Url GET http://plistatask.com/api/ads

# Delete ad by id
Url DELETE http://plistatask.com/api/ads/$id

### Error
Database commad **If there was any arror regarding to database missing** 
```
cd /var/www/plistatask/
php database/migration/db.php
php database/faker/faker.php
```
