<% if $ClassName = 'PurpleSpider\BasicNews\NewsArticle' %>
  
  <meta property="og:type" content="article">
  <meta property="og:url" content="$AbsoluteLink">
  <meta property="og:title" content="$Title">
  <meta property="og:image" content="$AttachedImage.Fill(1200,630).AbsoluteURL">
  <meta property="og:description" content="$Content.LimitCharacters(200,'...')">
  <meta property="og:site_name" content="$SiteConfig.Title">
  <meta property="og:locale" content="$Top.ContentLocale">
  <meta property="og:image:width" content="1200">
  <meta property="og:image:height" content="630">

  <meta name="twitter:card" content="summary">
  <%-- <meta name="twitter:site" content="@site_account"> --%>
  <%-- <meta name="twitter:creator" content="@individual_account"> --%>
  <meta name="twitter:url" content="$AbsoluteLink">
  <meta name="twitter:title" content="$Title">
  <meta name="twitter:description" content="$Content.LimitCharacters(200,'...')">
  <% if $AttachedImage %>
    <meta name="twitter:image" content="$AttachedImage.Fill(1200,630).AbsoluteURL">
  <% end_if %>
  
<% end_if %>