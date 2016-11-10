# Basic News Module
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/purplespider/silverstripe-basic-news/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/purplespider/silverstripe-basic-news/?branch=master)

## Introduction

Provides basic "news page" functionality to a SilverStripe site. 

Designed to provide a simple, fool-proof way for users to add news articles to their website.

This module has been designed to have just the minimum required features, to avoid bloat, but can be easily extended to add new fields if required.

## Maintainer Contact ##
 * James Cocker (ssmodulesgithub@pswd.biz)
 
## Requirements
 * Silverstripe 3.1+
 
## Installation Instructions

1. Place the contents of this repository in a directory named *basic-news* at the root of your SilverStripe install.
2. Visit yoursite.com/dev/build to rebuild the database.
3. Log in the CMS, and create a new News Holder page.

## Features

* A News Article has a Headline, Date, Article & Image (optional)
* *Add New News Article* button on Holder CMS page.
* Articles listed on holder page, with summary, date, image
* News Articles are automatically moved to a News Holder if created elsewhere in the sitetree accidentally.
* Lightbox compatability
* RSS feed of articles
* Articles are paginated on the News Holder

## Screenshots


**News Article Page**

![Screenshot](http://www.pswd.biz/ssmodules/basic-news/a1.png) 
![Screenshot](http://www.pswd.biz/ssmodules/basic-news/a2.png)

**News Holder Page**

![Screenshot](http://www.pswd.biz/ssmodules/basic-news/b1.png)
![Screenshot](http://www.pswd.biz/ssmodules/basic-news/b2.png)