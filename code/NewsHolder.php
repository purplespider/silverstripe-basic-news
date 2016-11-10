<?php

class NewsHolder extends Page
{

    public function getCMSFields()
    {
        $intro = null;

        $this->beforeUpdateCMSFields(function ($fields) {
            $fields->renameField("Content", "Intro Content");
      $fields->insertBefore(new Tab($this->getLumberjackTitle()), 'Main');
        });

        $fields = parent::getCMSFields();

        if ($intro) {
            $intro->setRightTitle("Appears at the top of the main ".$this->Title." page, above the list of articles.");
        }

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
    private static $allowed_children = array('NewsArticle');
    private static $description = 'Holds News Article pages';
    private static $icon = "basic-news/images/newspaper-page";
    
    public function stageChildren($showAll = false)
    {
        return $this->__call('stageChildren', array($showAll))->sort(array('MenuTitle'=>'DESC', "Created"=>'DESC'));
    }

    public function init()
    {
        RSSFeed::linkToFeed($this->Link("rss"), "News RSS Feed");
        parent::init();
    }
}


class NewsHolder_Controller extends Page_Controller
{

    private static $allowed_actions = array(
        "rss"
    );

    public function init()
    {
        RSSFeed::linkToFeed($this->Link() . "rss");
        if (Director::fileExists(project() . "/css/news.css")) {
            Requirements::css(project() . "/css/news.css");
        } else {
            Requirements::css("basic-news/css/news.css");
        }

        parent::init();
    }
    
    public function rss()
    {
        $config = SiteConfig::current_site_config();
        // Creates a new RSS Feed list
        $rss = new RSSFeed(
            $list = NewsArticle::get(), // an SS_List containing your feed items
            $link = $this->Link("rss"), // a HTTP link to this feed
            $title = $config->Title . " News", // title for this feed, displayed in RSS readers
            $description = "All the latest news from ". $config->Title . "." // description
        );
        // Outputs the RSS feed to the user.
        return $rss->outputToBrowser();
    }
    
    // Provides Paginated List of NewsArticles
    public function PaginatedPages()
    {
        $list = new PaginatedList(NewsArticle::get()->filter("ParentID", $this->ID), $this->request);
        $list->setPageLength(10);
        return $list;
    }
}
