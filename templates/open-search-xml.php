<?php echo($xmlHeader); ?>
<OpenSearchDescription xmlns="http://a9.com/-/spec/opensearch/1.1/" xmlns:moz="http://www.mozilla.org/2006/browser/search/">
  <ShortName><?php echo(OpenSearch::getPostSearchTile()) ?></ShortName>
  <Description><?php bloginfo('description'); ?></Description>
  <InputEncoding><?php bloginfo('charset'); ?></InputEncoding>
  <Image width="16" height="16"><? echo($encodedIcon) ?></Image>
  <Url type="text/html" method="POST" template="<?php echo($searchUrl) ?>"></Url>
  <moz:SearchForm><?php bloginfo('home'); ?></moz:SearchForm>
</OpenSearchDescription>