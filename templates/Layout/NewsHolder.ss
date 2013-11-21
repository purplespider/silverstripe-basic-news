<h1>$Title</h1>

$Content
	
<div class="NewsHolder">
	
	<% if PaginatedPages %>
		
		<% loop PaginatedPages %>
			<div class="hr"></div>
			<% if AttachedImage %>
				<a href="$Link">
					<% loop AttachedImage.setWidth(150) %><img class="right" src="$URL" width="$Width" height="$Height" alt="$Title" /><% end_loop %>
				</a>
			<% end_if %>
			<h2><a href="$Link">$Title</a></h2>
			<p class="date">$Date.Long</p>
			<% if Content.Summary %><p class="summary">$Content.Summary <a class="more" href="$Link">Read&nbsp;more</a></p><% end_if %>
			
		<% end_loop %>
		
		<% if PaginatedPages.MoreThanOnePage %>
				<p class="pageNumbers">
				
				<% if PaginatedPages.NextLink %>
					<a class="newsolder" href="$PaginatedPages.NextLink">&lt;&lt; older articles </a>
				<% end_if %>
				
				<% if PaginatedPages.PrevLink %>
					<a class="newsnewer" href="$PaginatedPages.PrevLink"> newer articles &gt;&gt;</a>
				<% end_if %>
	
				</p>
				
			<% end_if %>
	
	<% else %>
		<div class="contenttext">
			<p><strong>No News Articles.</strong></p>
		</div>
	<% end_if %>
	
</div>