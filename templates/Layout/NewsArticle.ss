<div class="NewsArticle">

	<h1>$Title</h1>
	<p class="date">$Date.Long</p>
	
	<% if AttachedImage %>
		<% if AttachedImage.WidthGT(250) %><a href="$ArticleImageSized(900).URL" class="lightbox"><% end_if %>
			<% loop AttachedImage.setMaxWidth(250) %><img class="right" src="$URL" width="$Width" height="$Height" /><% end_loop %>
		<% if AttachedImage.WidthGT(250) %></a><% end_if %>
	<% end_if %>
	
	$Content
	
	<p class="back"><a href="$Parent.Link">Back to News</a></p>
	
</div>