# Listformat (Drupal)

Listformat is a plugin system for list rendering, based on:
- The [UniPlugin](https://github.com/donquixote/drupal-uniplugin) API.
- The [ListFormatInterface](https://github.com/donquixote/drupal-renderkit/blob/7.x-1.x/src/ListFormat/ListFormatInterface.php) in [Renderkit](https://github.com/donquixote/drupal-renderkit).

Existing plugins (so far, all defined in Renderkit):
- Separator: Specify a separator, e.g. ", " or "\<hr/>".
- HTML list: Choose a tag name ("ul" or "ol") and set the class attribute.

Integration:
- A views style plugin.
- (planned) A display suite field theme function, to render field items with a list format.
