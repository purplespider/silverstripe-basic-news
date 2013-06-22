<?php

class NewsHolder extends Page {

	function getCMSFields() {
		$fields = parent::getCMSFields();
		
		$fields->addFieldToTab(
			'Root.Main',
			new LiteralField("addnew",
				"<p><a href='/admin/pages/add/AddForm?action_doAdd=1&ParentID=".$this->ID."&PageType=NewsArticle&SecurityID=".SecurityToken::getSecurityID()."' class='ss-ui-button ss-ui-action-constructive ui-button' style='font-size:130%' data-icon=add''>Add New News Item</span></a></p>"),'Title');
						
		$fields->renameField("Content","Introductory Text");
				
		return $fields;
	}
	
	// Only allows certain children to be created
	private static $allowed_children = array('NewsArticle');
	private static $description = 'Holds News Article pages';	   		   
   	private static $icon = "basic-news/images/newspaper-page";
}


class NewsHolder_Controller extends Page_Controller {

	function init() {
  		RSSFeed::linkToFeed($this->Link() . "rss");	
  		if(Director::fileExists(project() . "/css/news.css")) {
	         Requirements::css(project() . "/css/news.css");
	      }else{
	         Requirements::css("basic-news/css/news.css");
	      }

   		parent::init();	
	}
	
	// Provides News Article RSS Feed
	function rss() {
  		$rss = new RSSFeed(DataObject::get("NewsArticle", null, "Date DESC"), $this->Link(), "Latest News");
  		$rss->outputToBrowser();
	}
	
	// Provides Paginated List of NewsArticles
	function PaginatedPages() {
		$list = new PaginatedList(NewsArticle::get(), $this->request);
		$list->setPageLength(10);
		return $list;
	}
}

?>