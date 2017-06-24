# Feature Toggle module for Magento 1

_by Opengento_
[See Magento 2 Module Version](https://github.com/opengento/feature-toggle2).

## How to use ?
- Add your custom feature inside feature.xml file, in your Module/feature.xml (see the features.xml.template format example on this module)
- Use your feature ID on your layout, only for the block or action, thanks to the toggle propriety :
```
<block type="page/html_topmenu" name="catalog.topnav" toggle="feature_id" template="page/html/topmenu.phtml"/>
```
- Or, you can use helper function ``showFeature($featureId)``


## Maintainers

See [Contributors list](https://github.com/opengento/feature-toggle/graphs/contributors).
