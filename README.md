# Magento2 Engraving Module — Technical Task Example

This module serves as a demonstration of how to build a Magento 2 extension for the purpose of a technical task.
The task aimed to introduce an engraving feature for products, allowing customers to opt for custom text engravings when purchasing.
This README will outline the features implemented and provide guidance on how the module operates.

## Features Demonstrated
 - **Backend Configuration**: Implementation of a configuration toggle in the Magento backoffice for activating the engraving feature on products.
 - **Dynamic UI Elements on Product Page**: Enabling the engraving feature will display a checkbox on product pages. If selected by a customer, a textarea for custom engraving text input is revealed.
 - **Cart Engraving Data**: Demonstrates how to capture and save custom engraving details when a product is added to the cart.
 - **Order Metadata Extension**: Orders with products that have engraving details are flagged and the engraving text is retained.
 - **Sales Grid Custom Column**: Introduction of a new column in the sales grid in the backoffice to reflect engraving information.
 - **CLI Command (Bonus)**: An added CLI command that fetches a count of orders containing engraved products which haven't been dispatched.

## Prerequisites

- PHP 8.1 or higher
- Magento 2.4.5 EE/CE

## Dependencies
composer.json includes:
```        
        "php": "^8.1",
        "magento/framework": "103.0.*",
        "magento/module-store": "101.1.*",
        "magento/module-sales": "103.0.*",
        "magento/module-catalog": "104.0.*"
```

## Installation Steps
Please follow the instruction:

- Unzip the zip file `module.zip` in `path/to/your/project/app/code/`
- Run `bin/magento setup:upgrade`

## Usage Guide
- Go to the admin panel
- Go to Stores -> Configuration -> Catalog -> Catalog -> Product Engraving
- Enable the "Display engraving option" option
- Clear the cache
- Go to the product page
- Check the "Add engraving text?" checkbox
- Add engraving text
- Add the product to the cart
- Place an order
- To check amount of engraving orders run `php bin/magento labofgood:statistic:orders --is_engraved=1 --is_not_shipped=1`
- Check `bin/cli bin/magento labofgood:statistic:orders --help` for more information

## Uninstallation
Run the following command `php bin/magento module:uninstall Labofgood_EngraveProduct`

## Support and Feedback
Being an example for a technical task, this module is not meant for production use.
However, constructive feedback or queries related to its implementation can be directed to
Anton Abramchenko <anton.abramchenko@labofgood.com>

## License
Open Software License 3.0 (https://opensource.org/licenses/OSL-3.0)
