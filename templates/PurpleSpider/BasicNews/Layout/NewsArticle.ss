<% require css("purplespider/basic-news: client/dist/css/basic-news.css") %>

<div class="NewsArticle">

	<h1>$Title</h1>
	<p class="date">$Date.Long</p>
	
	<% if AttachedImage %>
		<% if AttachedImage.Width >= '250' %><a href="$AttachedImage.FitMax(1200,1200).URL" class="lightbox"><% end_if %>
			<img class="right" src="$AttachedImage.ScaleMaxWidth(250).URL" />
		<% if AttachedImage.Width >= '250' %></a><% end_if %>
	<% end_if %>
	
	$Content
	
	<p class="back"><a href="$Parent.Link">Back to News</a></p>
	
</div>