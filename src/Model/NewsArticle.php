<?php

namespace PurpleSpider\BasicNews;

use Page;





use SilverStripe\Assets\Image;
use SilverStripe\ORM\FieldType\DBDate;
use SilverStripe\Forms\DateField;
use SilverStripe\AssetAdmin\Forms\UploadField;
use PurpleSpider\BasicNews\NewsHolder;
use SilverStripe\Control\Director;
use SilverStripe\View\Requirements;
use PageController;



    class NewsArticle extends Page
    {
    
        private static $db = array(
            'Date' => DBDate::class
        );
        
        private static $has_one = array(
            'AttachedImage' => Image::class
        );
        
        private static $defaults = array(
            'ShowInMenus' => false
        );
        
        private static $summary_fields = array(
            "Date.Nice" => "Date",
            "Title" => "Title"
        );
        
        private static $owns = [
          "AttachedImage"
        ];
        
        private static $default_sort = "Date DESC, Created DESC";
        private static $default_parent = "news";
        private static $description = 'An individual news item displayed on a News holder page';
        private static $singular_name = 'News Article';
        private static $plural_name = 'News Articles';
        private static $icon = "purplespider/basic-news:client/dist/images/newspaper-file.gif";
        private static $icon_class = 'font-icon-p-news-item';
        private static $allowed_children = array();
        private static $can_be_root = false;
        private static $table_name = "NewsArticle";
        
        public function populateDefaults()
        {
            $this->Date = date('Y-m-d');
            parent::populateDefaults();
        }
                    
        public function getCMSFields()
        {
            $this->beforeUpdateCMSFields(function ($fields) {

                $datefield = new DateField('Date', 'Article Date');
                $fields->addFieldToTab('Root.Main', $datefield, 'Content');
                
                $image = UploadField::create('AttachedImage', 'Featured Image');
                $image->setAllowedExtensions(array('jpg', 'jpeg', 'png', 'gif'));
                $image->setFolderName('Managed/NewsImages');
                $image->setDescription("Displayed to the right of the content in the main article, where it can be clicked to enlarge. <br />A thumbnail also appears next to the article summary on the main News page.");
                $fields->addFieldToTab('Root.Main', $image, "Content");

             });

            $fields = parent::getCMSFields();
            
            $fields->renameField("Title", "Headline");
            $fields->removeFieldFromTab("Root.Main", "MenuTitle");

            return $fields;
        }
       
        public function onBeforeWrite()
        {
            
            // Change MenuTitle, so date appears in CMS SiteTree
            $this->MenuTitle = $this->Date.": ".$this->Title;
            
            // Move to News holder if created under something else
            if ($this->Parent()->ClassName != "PurpleSpider\BasicNews\NewsHolder") {
                $this->ParentID = NewsHolder::get()->first()->ID;
            }

            // Add Today's Date if None
            if (!$this->Date) {
                $this->Date = date('Y-m-d');
            }
                        
            parent::onBeforeWrite();
        }
    }
    
    
    class NewsArticle_Controller extends PageController
    {
      
       
       // Provides a resized image with the max width provided
       public function ArticleImageSized($maxwidth = 250)
       {
           if ($this->AttachedImage()->getWidth() < $maxwidth) {
               return $this->AttachedImage();
           } else {
               return $this->AttachedImage()->setWidth($maxwidth);
           }
       }
    }
