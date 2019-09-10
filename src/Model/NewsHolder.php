<?php

namespace PurpleSpider\BasicNews;

use Page;
use PageController;
use SilverStripe\Forms\Tab;
use SilverStripe\Control\Director;
use SilverStripe\Forms\FieldGroup;
use SilverStripe\ORM\PaginatedList;
use SilverStripe\View\Requirements;
use SilverStripe\Forms\NumericField;
use SilverStripe\Control\RSS\RSSFeed;
use SilverStripe\Forms\CheckboxField;
use PurpleSpider\BasicNews\NewsArticle;
use SilverStripe\SiteConfig\SiteConfig;

class NewsHolder extends Page
{

    private static $db = array(
        "DisplayFullPosts" => "Boolean",
        "PostsPerPage" => "Int",
    );

    private static $defaults = [
        "PostsPerPage" => 10,
    ];

    public function getCMSFields()
    {

        $this->beforeUpdateCMSFields(function ($fields) {
            $fields->renameField("Content", "Intro Content");
        });

        $fields = parent::getCMSFields();

        $fields->dataFieldByName("Content")->setDescription("This content appears at the top of the main " . $this->Title . " page, above the list of news articles.");

        return $fields;
    }

    function getSettingsFields()
    {
        $fields = parent::getSettingsFields();
        $fields->addFieldToTab("Root.Settings", FieldGroup::create(CheckboxField::create('DisplayFullPosts', 'Display full articles?'))->setTitle("News articles"));
        $fields->addFieldToTab("Root.Settings", NumericField::create('PostsPerPage', 'Articles per page'));
        return $fields;
    }

    public function getLumberjackTitle()
    {
        return "News Articles";
    }

    public function getLumberjackPagesForGridfield($excluded = array())
    {
        return NewsArticle::get()->filter(array(
            'ParentID' => $this->ID,
            'ClassName' => $excluded,
        ));
    }

    // Only allows certain children to be created
    private static $allowed_children = array(NewsArticle::class);
    private static $icon_class = 'font-icon-news';
    private static $table_name = "NewsHolder";
    private static $description = 'Displays multiple News Articles';


    public function stageChildren($showAll = false)
    {
        return $this->__call('stageChildren', array($showAll))->sort(array('MenuTitle' => 'DESC', "Created" => 'DESC'));
    }

    public function init()
    {
        RSSFeed::linkToFeed($this->Link("rss"), "News RSS Feed");
        parent::init();
    }
}


class NewsHolder_Controller extends PageController
{

    private static $allowed_actions = array(
        "rss"
    );

    public function rss()
    {
        $config = SiteConfig::current_site_config();
        // Creates a new RSS Feed list
        $rss = new RSSFeed(
            $list = NewsArticle::get(), // an SS_List containing your feed items
            $link = $this->Link("rss"), // a HTTP link to this feed
            $title = $config->Title . " News", // title for this feed, displayed in RSS readers
            $description = "All the latest news from " . $config->Title . "." // description
        );
        // Outputs the RSS feed to the user.
        return $rss->outputToBrowser();
    }

    // Provides Paginated List of NewsArticles
    public function PaginatedPages()
    {
        $list = new PaginatedList(NewsArticle::get()->filter("ParentID", $this->ID), $this->request);
        if ($this->PostsPerPage) {
            $list->setPageLength($this->PostsPerPage);
        } else {
            $list->setPageLength(10);
        }
        return $list;
    }
}
