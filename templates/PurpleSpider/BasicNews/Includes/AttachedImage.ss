<% if AttachedImage %>
  <% if AttachedImage.Width >= '250' %><a href="$AttachedImage.FitMax(1200,1200).URL" class="lightbox"><% end_if %>
    <img class="right" src="$AttachedImage.ScaleMaxWidth(250).URL" />
  <% if AttachedImage.Width >= '250' %></a><% end_if %>
<% end_if %>